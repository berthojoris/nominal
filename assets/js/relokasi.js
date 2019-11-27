function openPrint(url) {
    document.write('<body onload="window.print()"><iframe style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden;" src="'+url+'"></body>');
    document.close();
}

function Popup(url) {
    var mywindow = window.open(url, 'Print', 'height=400,width=600');
    mywindow.document.write($("#printPage").html());
    mywindow.print();
    mywindow.close();

    return true;
}

function upperCase(string) {
    return string.toUpperCase()
}

function OpenDetailPrint(url) {
    window.open(url);
}

$(document).ready(function() {

    $(document).on('click', '.print', function() {
        var id = $(this).data('open');
        var url = getBaseUrl()+"index.php/adm_operation/showdetail/"+id;
        OpenDetailPrint(url);
    });

    $(document).on('focus', ':input', function() {
        $( this ).attr( 'autocomplete', 'off' );
    });

    $(document).on('change', '#edit_id_jarkom',function (e) {
        $("#edit_id_jarkom_val").val(this.value);
    });

    $(document).on('change', '#edit_remote_name_new',function (e) {
        $("#edit_id_remote_new").val(this.value);
        $("#edit_remote_name_new_val").val(this.innerText);
        $("#remote_type_new").val('');
        $("#region_new").val('');
        $("#remote_address_new").val('');

        $.ajax({
            type: "POST",
            url: getBaseUrl()+"index.php/Api_relokasi/getremotebyname",
            dataType: "json",
            data: {
                name: this.value
            },
            success: function (response) {
                if(response.code == 200) {
                    $("#edit_ip_lan_new").val(response.data.ip_lan);
                    $("#edit_remote_type_new").val(response.data.tipe_uker);
                    $("#edit_region_new").val(response.data.nama_kanwil);
                    $("#edit_remote_address_new").val(response.data.alamat_uker);
                    $("#edit_remote_latitude_new").val(response.data.latitude);
                    $("#edit_remote_longitude_new").val(response.data.longitude);
                } else if(response.code == 404) {
                    swal("Oops", "Data not found for "+name, "success");
                }  else {
                    swal("Oops", "Search failed. Please reload the page", "error");
                }
            }
        });
    });

    getProvider();
    
    $('#filter_table_Data').DataTable({ 
        "processing": true,
        "serverSide": false,
        "paging": true,
        "responsive": true,
        "ajax": {
            "url": getBaseUrl()+"index.php/Api_relokasi/getRelokasiData",
            "type": "POST"
        },
        "columns": [
            {
                "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1+".";
                }
            },
            {
                "data": "id_relokasi",
                "visible": false,
                "searchable": false
            },
            {
                "data": "kode_jarkom",
            },
            {
                "data": "ip_wan_new",
                "visible": false,
            },
            {
                "data": "remote_name_old",
            },
            {
                "data": "remote_name_new",
            },
            {
                "data": "address_new",
                "render": function(data, type, row, meta) {
                    return (data.length >= 20) ? data.substring(0, 20)+"..." : data;
                }
            },
            {
                "data": "req_doc_file",
                "render": function(data, type, row, meta) {
                    var rowIndex = meta.col-1;
                    $('#filter_table_Data tbody td:nth-child('+rowIndex+')').addClass('centerText');
                    var img = getBaseUrl()+"assets/icon/office/download-icon.png";
                    isian = '<a href="'+getBaseUrl()+'index.php/adm_operation/download/'+data+'"><img src="'+img+'" width=20 /></a>';
                    return isian;
                }
            },
            {
                "data": "work_order_file",
                "render": function(data, type, row, meta) {
                    var rowIndex = meta.col-1;
                    $('#filter_table_Data tbody td:nth-child('+rowIndex+')').addClass('centerText');
                    var img = getBaseUrl()+"assets/icon/office/download-icon.png";
                    wo = '<a href="'+getBaseUrl()+'index.php/adm_operation/download/'+data+'"><img src="'+img+'" width=20 /></a>';
                    return wo;
                }
            },
            {
                "data": "status",
                "render": function(data, type, row, meta) {
                    return upperCase(data);
                }
            },
            {
                "data": "due_date",
            },
            {
                "data": "pic",
            },
            {
                "data": "id_relokasi",
                "sortable": false,
                 "render": function(data, type, row) {
                     return '<button class="btn btn-success btn-xs print" data-open="'+row.id_relokasi+'">View</button>'
                }
            },
            {
                "data": "id",
                "sortable": false,
                 "render": function(data, type, row) {
                     return '<button class="btn btn-warning btn-xs" data-toggle="modal" data-id="'+row.id_jarkom+'" data-target="#edit_form_relokasi">Edit</button>'
                }
            },
        ],
    });

    $(document).on("click", "#updateRelokasi", function (e) {
        var allowEmpty = ["Draft", "Pending Approval", "Cancel"];
        var activeValidate = ["in Progress", "Done"];
        $("#form_edit").validate({
            rules: {
                edit_file_upload_1: {
                    required: function(element) {
                        if(activeValidate.includes($("#edit_status").val()) && $("#valid_edit_reqdocfile").val() == "") {
                            return true;
                        }
                        if(activeValidate.includes($("#edit_status").val()) && $("#valid_edit_reqdocfile").val() != "") {
                            return false;
                        }
                        return false;
                    },
                    extension: "pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv"
                },
                edit_file_upload_2: {
                    required: function(element) {
                        if(activeValidate.includes($("#edit_status").val()) && $("#valid_edit_wofile").val() == "") {
                            return true;
                        }
                        if(activeValidate.includes($("#edit_status").val()) && $("#valid_edit_wofile").val() != "") {
                            return false;
                        }
                        return false;
                    },
                    extension: "pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv"
                }
            },
            messages: {
                edit_file_upload_1: {
                    required: 'This field is required.',
                    extension: 'File extension not permitted.'
                },
                edit_file_upload_2: {
                    required: 'This field is required.',
                    extension: 'File extension not permitted.'
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });

    $("#form_add").validate({
        rules: {
            file_upload_1: {
                required: function(element) {
                    if($("#status").val() == "in Progress") {
                        return true;
                    } else if($("#status").val() == "Done") {
                        return true;
                    } else {
                        return false;
                    }
                },
                extension: "pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv"
            },
            file_upload_2: {
                required: function(element) {
                    if($("#status").val() == "in Progress") {
                        return true;
                    } else if($("#status").val() == "Done") {
                        return true;
                    } else {
                        return false;
                    }
                },
                extension: "pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv"
            }
        },
        messages: {
            file_upload_1: {
                required: 'This field is required.',
                extension: 'File extension not permitted.'
            },
            file_upload_1: {
                required: 'This field is required.',
                extension: 'File extension not permitted.'
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
      
    $("#add_form_btn").click(function (e) {
        resetAllForm();
        $("#add_form_relokasi").modal('show');
    });

    $("#add_form_relokasi").on('show.bs.modal', function (e) {
        $("#live_target, #req_doc_date").datepicker({
            todayHighlight: true,
            autoclose: true,
            changeMonth: true,
            inline: false,
        });
    });

    $("#filter_order_date, #filter_live_target").datepicker({ 
        todayHighlight: true,
        autoclose: true,
        changeMonth: true,
        inline: false,
    });

    $("#filter_form_btn").click(function (e) {
        $("#panelFilter").toggle();
    });

    $("#remote_name_new").change(function (e) { 
        e.preventDefault();
        var name = $(this).val();
        $("#remote_type_new").val('');
        $("#region_new").val('');
        $("#remote_address_new").val('');

        $.ajax({
            type: "POST",
            url: getBaseUrl()+"index.php/Api_relokasi/getremotebyname",
            dataType: "json",
            data: {
                name: name
            },
            success: function (response) {
                if(response.code == 200) {
                    $("#ip_lan_new").val(response.data.ip_lan);
                    $("#remote_type_new").val(response.data.tipe_uker);
                    $("#region_new").val(response.data.nama_kanwil);
                    $("#remote_address_new").val(response.data.alamat_uker);
                    $("#remote_name_new_val").val(response.data.nama_remote);
                    $("#remote_latitude_new").val(response.data.latitude);
                    $("#remote_longitude_new").val(response.data.longitude);
                } else if(response.code == 404) {
                    swal("Oops", "Data not found for "+name, "success");
                }  else {
                    swal("Oops", "Search failed. Please reload the page", "error");
                }
                $("#distance").focus();
            }
        });
    });

    $("#id_jarkom").change(function (e) {
        e.preventDefault();
        var id_jarkom = $(this).val();
        $.ajax({
            type: "POST",
            url: getBaseUrl()+"index.php/Api_relokasi/searchByIpAddress",
            dataType: "json",
            data: {
                id_jarkom: id_jarkom
            },
            success: function (response) {
                if(response.code == 200) {
                    $("#id_remote_old").val(response.data.id_remote);
                    $("#kode_jarkom").val(response.data.kode_jarkom);
                    $("#no_spk").val(response.data.no_spk);
                    $("#ip_lan_old").val(response.data.ip_lan);
                    $("#ip_lan_new").val(response.data.ip_lan);
                    $("#ip_wan_old").val(response.data.ip_wan);
                    $("#ip_wan_new").val(response.data.ip_wan);
                    $("#remote_name_old").val(response.data.remote_name);
                    $("#remote_type_old").val(response.data.remote_type);
                    $("#region_old").val(response.data.region);
                    $("#remote_address_old").val(response.data.remote_address);
                    $("#network_id_old").val(response.data.kode_jarkom);
                    $("#network_id_new").val(response.data.kode_jarkom);
                    $("#no_serial_spk").val(response.data.id_contract);
                    $("#key_id_jarkom").val(response.data.id_jarkom);
                    $("#reason").focus();
                    $.ajax({
                        type: "POST",
                        url: getBaseUrl()+"index.php/Api_relokasi/findAllRemoteJarkom",
                        dataType: "json",
                        data: {
                            id_jarkom: id_jarkom
                        },
                        success: function (response_second) {
                            $("#network_type_old").val(response_second.data.jenis_jarkom);
                            $("#network_type_new").val(response_second.data.jenis_jarkom);
                            $("#remote_latitude_old").val(response_second.data.latitude);
                            $("#remote_longitude_old").val(response_second.data.longitude);
                        }
                    });
                } else {
                    swal("Oops", "Data not found for "+ip_network, "success");
                }
            }
        });
    });

    $("#id_jarkom").select2({
        width: '100%',
        dropdownParent: $("#add_form_relokasi"),
        minimumInputLength:2,
        placeholder:"Type at least 2 charachter",
        allowClear: true,
        ajax:{
            url:getBaseUrl()+"index.php/Api_relokasi/searchUpdate",
            type:"POST",
            dataType:"json",
            data: function(param) {
                return{ip_network:param.term}
            },
            processResults:function(data) {
                return{results:data}
            }
        }
    });

    $("#remote_name_new").select2({
        width: '100%',
        dropdownParent: $("#remotePanel"),
        minimumInputLength:3,
        placeholder:"Type at least 3 charachter",
        ajax:{
            url:getBaseUrl()+"index.php/Api_relokasi/getRemoteByNameSelect2",
            type:"POST",
            dataType:"json",
            data: function(param) {
                return{name:param.term}
            },
            processResults:function(data) {
                return{results:data}
            }
        }
    });

    $("#filter_remote_name").select2({
        width: '100%',
        dropdownParent: $("#filterPanelRemoteName"),
        minimumInputLength:3,
        placeholder:"Type at least 3 charachter",
        ajax:{
            url:getBaseUrl()+"index.php/Api_relokasi/getRemoteByNameFilter",
            type:"POST",
            dataType:"json",
            data: function(param) {
                return{name:param.term}
            },
            processResults:function(data) {
                return{results:data}
            }
        }
    });
});

function getBaseUrl() {
    return $('meta[name=baseURL]').attr("content");
}

function getProvider() {
    $.ajax({
        type: "GET",
        url: getBaseUrl()+"index.php/Api_relokasi/getProvider",
        dataType: "json",
        success: function (response) {
            var toAppend = '';
            toAppend += '<option value="">- Pilih -</option>';
            $.each(response, function(i, o) {
                toAppend += '<option value="'+o.nickname_provider+'">'+o.nickname_provider+'</option>';
            });
            $('#filter_provider').append(toAppend);
        }
    });
}

function resetAllForm() {
    $("input[type='text'], textarea, input[type='password']").each(
        function() {
            $(this).val('');
        }
    );
    $("label.error").hide();
    $("input.error").removeClass("error");
}

$("#open_detail_modal").on('show.bs.modal', function (e) {
    var passData     = $(e.relatedTarget);
    var id = passData.data("id");
    $("#loadingPanel").show();
    $("#dataPanel").hide();
    $("#notFoundPanel").hide();
    $("#id_jarkom").val('').trigger('change');
    $.ajax({
        type: "GET",
        url: getBaseUrl()+"index.php/Api_relokasi/getDetail/"+id,
        dataType: "json",
        success: function (response) {
            $("#loadingPanel").hide();
            if(response.code == 200) {
                $("#detail_kode_jarkom").html(response.data.kode_jarkom);
                $("#detail_reason").html(response.data.reason);
                $("#detail_status").html(response.data.status);
                $("#detail_due_date").html(response.data.due_date);
                $("#detail_pic").html(response.data.pic);
                $("#detail_ip_wan_old").html(response.data.ip_wan_old);
                $("#detail_ip_wan_new").html(response.data.ip_wan_new);
                $("#detail_req_doc_no").html(response.data.req_doc_no);
                $("#detail_req_date").html(response.data.req_doc_date);
                $("#detail_work_order_no").html(response.data.work_order_no);
                $("#detail_type_relocate").html(response.data.type_relocate);
                $("#detail_network_id_old").html(response.data.network_id_old);
                $("#detail_network_id_new").html(response.data.network_id_new);
                $("#detail_ip_lan_old").html(response.data.ip_lan_old);
                $("#detail_ip_lan_new").html(response.data.ip_lan_new);
                $("#detail_remote_name_old").html(response.data.remote_name_old);
                $("#detail_remote_name_new").html(response.data.remote_name_new);
                $("#detail_address_old").html(response.data.address_old);
                $("#detail_address_new").html(response.data.address_new);
                $("#detail_remote_type").html(response.data.remote_type);
                $("#detail_provider").html(response.data.nickname_provider);
                $("#dataPanel").show();
            } else {
                $("#notFoundPanel").show();
            }
        }
    });
});

$("#edit_form_relokasi").on('show.bs.modal', function (e) {
    var passData    = $(e.relatedTarget);
    var id          = passData.data("id");
    $("#valid_edit_reqdocfile").val('');
    $("#valid_edit_wofile").val('');

    $("#edit_live_target").datepicker({ 
        todayHighlight: false,
        autoclose: true,
        changeMonth: true,
        inline: false,
    });

    $.ajax({
        type: "POST",
        url: getBaseUrl()+"index.php/Api_relokasi/searchById",
        dataType: "json",
        data: {
            id: id
        },
        success: function (response) {
            if(response.code == 200) {

                $.ajax({
                    type: "POST",
                    url: getBaseUrl()+"index.php/Api_relokasi/findAllRemoteJarkom",
                    dataType: "json",
                    data: {
                        id_jarkom: id
                    },
                    success: function (response_second) {
                        $("#edit_network_type_old").val(response_second.data.jenis_jarkom);
                        $("#edit_network_type_new").val(response_second.data.jenis_jarkom);
                    }
                });

                $("#edit_req_doc_date").datepicker({ 
                    todayHighlight: false,
                    autoclose: true,
                    changeMonth: true
                });

                $("#edit_live_target").datepicker({ 
                    todayHighlight: false,
                    autoclose: true,
                    changeMonth: true
                });

                $("#edit_req_doc_date").datepicker("update", response.data.req_doc_date);
                $("#edit_live_target").datepicker("update", response.data.due_date);

                $("#edit_id_jarkom").val(response.data.ip_wan_new+" / "+response.data.kode_jarkom+" / "+response.data.nickname_provider +" / "+response.data.singkatan);
                $("#edit_id_jarkom_val").val(response.data.id_jarkom);

                $('#edit_remote_name_new').select2({
                    width: '100%',
                    dropdownParent: $("#remoteNamePanel"),
                    minimumInputLength:3,
                    placeholder:"Type at least 3 charachter",
                    ajax:{
                        url:getBaseUrl()+"index.php/Api_relokasi/getRemoteByNameSelect2",
                        type:"POST",
                        dataType:"json",
                        data: function(param) {
                            return{name:param.term}
                        },
                        processResults:function(data) {
                            return{results:data}
                        }
                    },
                    initSelection : function (element, callback) {
                        var data = {
                            id: response.data.remote_name_new, 
                            text: response.data.remote_name_new
                        };
                        callback(data);
                        $("#edit_remote_name_new_val").val(data.id);
                    }
                });

                $("#id_relokasi").val(response.data.id_relokasi);

                $("#edit_type").val(response.data.type_relocate).change();
                $("#edit_status").val(response.data.status).change();
                $("#edit_reason").val(response.data.reason);
                $("#edit_no_spk").val(response.data.no_spk);
                $("#edit_no_serial_spk").val(response.data.id_contract);
                $("#edit_req_doc_no").val(response.data.req_doc_no);
                $("#edit_pic").val(response.data.pic);
                $("#edit_work_order_no").val(response.data.work_order_no);
                $("#edit_network_id_old").val(response.data.kode_jarkom);
                $("#edit_network_id_new").val(response.data.kode_jarkom);
                $("#edit_ip_lan_old").val(response.data.ip_lan_old);
                $("#edit_ip_wan_old").val(response.data.ip_wan_old);
                $("#edit_remote_name_old").val(response.data.remote_name_old);
                $("#edit_remote_type_old").val(response.data.remote_type_old);
                $("#edit_region_old").val(response.data.region);
                $("#edit_remote_address_old").val(response.data.address_old);
                $("#edit_ip_lan_new").val(response.data.ip_lan_old);
                $("#edit_ip_wan_new").val(response.data.ip_wan_old);
                $("#edit_remote_type_new").val(response.data.remote_type_new);
                $("#edit_region_new").val(response.data.region);
                $("#edit_remote_address_new").val(response.data.address_old);
                $("#edit_distance").val(response.data.distance);
                $("#edit_key_id_jarkom").val(response.data.id_jarkom);
                $("#edit_id_remote_new").val(response.data.id_remote_new);
                $("#edit_id_remote_old").val(response.data.id_remote_old);
                $("#edit_remote_latitude_old").val(response.data.remote_latitude_old);
                $("#edit_remote_longitude_old").val(response.data.remote_longitude_old);
                $("#edit_remote_latitude_new").val(response.data.remote_latitude_new);
                $("#edit_remote_longitude_new").val(response.data.remote_longitude_new);

                $('#file_req_doc').empty();
                $('#file_work_order').empty();
                $('#file_req_doc').html(openViewOtf(response.data.req_doc_file));
                $('#file_work_order').html(openViewOtf(response.data.work_order_file));
                $("#valid_edit_reqdocfile").val(response.data.req_doc_file);
                $("#valid_edit_wofile").val(response.data.work_order_file);
            } else {
                swal("Oops", "Data not found for id "+id, "success");
            }
        }
    });
});

function openViewOtf(filename) {
    var parsing = filename.split('.').pop();
    var img = getBaseUrl()+"assets/icon/office/"+checkExt(filename);
    if(parsing == "pdf") {
        return "<img src='"+img+"' /><a href='"+getBaseUrl()+"index.php/adm_operation/viewpdf/"+filename+"' target='_blank'>"+filename+"</a>";
    } else {
        return "<img src='"+img+"' />"+filename;
    }
}

function download(data) {
    return getBaseUrl()+'index.php/adm_operation/download/'+data;
}

function checkExt(data) {
    var parsing = data.split('.').pop();
    var output = "";
    if(parsing == "png") {
        output = "icons8-png-30.png";
    } else if(parsing == "jpg" || parsing == "jpeg") {
        output = "icons8-jpg-30.png";
    } else if(parsing == "pdf") {
        output = "icons8-pdf-30.png";
    } else if(parsing == "xls" || parsing == "xlsx") {
        output = "icons8-xls-30.png";
    } else if(parsing == "doc" || parsing == "docs") {
        output = "icons8-doc-30.png";
    } else if(parsing == "csv") {
        output = "icons8-csv-30.png";
    } else if(parsing == "rar") {
        output = "icons8-rar-30.png";
    } else if(parsing == "zip") {
        output = "icons8-save-archive-30.png";
    } else if(parsing == "doc" || parsing == "docx") {
        output = "icons8-word-30.png";
    } else {
        output = "icons8-document-30.png";
    }
    return output;
}

function PopupCenter(url, title, w, h) {
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var systemZoom = width / window.screen.availWidth;
    var left = (width - w) / 2 / systemZoom + dualScreenLeft
    var top = (height - h) / 2 / systemZoom + dualScreenTop
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w / systemZoom + ', height=' + h / systemZoom + ', top=' + top + ', left=' + left);

    if (window.focus) newWindow.focus();
}