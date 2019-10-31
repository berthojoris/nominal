$(document).ready(function() {

    $( document ).on( 'focus', ':input', function() {
        $( this ).attr( 'autocomplete', 'off' );
    });

    getProvider();
    
    $('#filter_table_Data').DataTable({ 
        "processing": true,
        "serverSide": false,
        "paging": true,
        "responsive": true,
        "order": [[0, 'desc']],
        "ajax": {
            "url": getBaseUrl()+"index.php/Api_relokasi/getRelokasiData",
            "type": "POST"
        },
        "columns": [
            {
                "data": "id_relokasi",
                "visible": false,
                "searchable": false
            },
            {
                "data": "kode_jarkom",
            },
            {
                "data": "ip_wan",
                "visible": false,
            },
            {
                "data": "nama_remote_old",
            },
            {
                "data": "nama_remote_new",
            },
            {
                "data": "alamat",
                "render": function(data, type, row, meta) {
                    var str = data;
                    if(str.length > 30) str = str.substring(0, 30);
                    return str+"...";
                 }
            },
            {
                "data": "file_url",
                "render": function(data, type, row, meta) {
                    var isian = ""
                    isian = '<a href="'+getBaseUrl()+'index.php/adm_operation/download/'+data+'">Download</a>';
                    return isian;
                 }
            },
            {
                "data": "status",
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
                     return '<button class="btn btn-success btn-xs" data-toggle="modal" data-id="'+row.id_relokasi+'" data-nama_remote_old="'+row.nama_remote_old+'" data-nama_remote_new="'+row.nama_remote_new+'" data-alamat="'+row.alamat+'" data-file_url="'+row.file_url+'" data-status="'+row.status+'" data-due_date="'+row.due_date+'" data-pic="'+row.pic+'" data-ip_wan="'+row.ip_wan+'" data-target="#open_detail_modal">View</button>'
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

    $("#form_add").validate({
        rules: {
            rec_doc_file: {
                required: true,
                extension: "pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv"
            },
            work_order_file: {
                required: true,
                extension: "pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv"
            }
        },
        messages: {
            rec_doc_file: {
                required: 'This field is required.',
                extension: 'File extension not permitted.'
            },
            work_order_file: {
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

    $("#live_target").datepicker({ 
        startDate: new Date(),
        todayHighlight: true,
        autoclose: true
    });

    $("#edit_live_target").datepicker({ 
        startDate: new Date(),
        todayHighlight: true,
        autoclose: true
    })

    $("#filter_order_date, #filter_live_target").datepicker({ 
        todayHighlight: true,
        autoclose: true
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
                    $("#remote_type_new").val(response.data.tipe_uker);
                    $("#region_new").val(response.data.nama_kanwil);
                    $("#remote_address_new").val(response.data.alamat_uker);
                } else if(response.code == 404) {
                    swal("Oops", "Data not found for "+name, "success");
                }  else {
                    swal("Oops", "Search failed. Please reload the page", "error");
                }
            }
        });
    });

    $("#id_jarkom").change(function (e) {
        e.preventDefault();
        var ip_network = $(this).val();
        $.ajax({
            type: "POST",
            url: getBaseUrl()+"index.php/Api_relokasi/searchByIpAddress",
            dataType: "json",
            data: {
                ip_network: ip_network
            },
            success: function (response) {
                if(response.code == 200) {
                    $("#id_remote_old").val(response.data.id_remote);
                    $("#kode_jarkom").val(response.data.kode_jarkom);
                    $("#no_spk").val(response.data.no_spk);
                    $("#network_type_old").val(response.data.network_type);
                    $("#ip_lan_old").val(response.data.ip_lan);
                    $("#ip_wan_old").val(response.data.ip_wan);
                    $("#remote_name_old").val(response.data.remote_name);
                    $("#remote_type_old").val(response.data.remote_type);
                    $("#region_old").val(response.data.region);
                    $("#remote_address_old").val(response.data.remote_address);
                    $("#network_id_old").val(response.data.kode_jarkom);
                    $("#reason").focus();
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
        ajax:{
            url:getBaseUrl()+"index.php/Api_relokasi/searchByIpAddressSelect2",
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

    $("#edit_id_jarkom").select2({
        width: '100%',
        dropdownParent: $("#edit_form_relokasi"),
        minimumInputLength:2,
        placeholder:"Type at least 5 charachter",
        ajax:{
            url:getBaseUrl()+"index.php/Api_relokasi/searchByIpAddressSelect2",
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

    $("#edit_remote_name_new").select2({
        width: '100%',
        dropdownParent: $("#remotePanelEdit"),
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
                toAppend += '<option value="'+o.kode_provider+'">'+o.nama_provider+'</option>';
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
    var nama_remote_new = passData.data("nama_remote_new");
    var nama_remote_old = passData.data("nama_remote_old");
    var alamat = passData.data("alamat");
    var file_url = passData.data("file_url");
    var status = passData.data("status");
    var due_date = passData.data("due_date");
    var pic = passData.data("pic");
    var ip_wan = passData.data("ip_wan");
    $("#nama_remote_new").html(nama_remote_new);
    $("#nama_remote_old").html(nama_remote_old);
    $("#alamat").html(alamat);
    $("#file_url").html(file_url);
    $("#status_detail").html(status);
    $("#due_date").html(due_date);
    $("#pic").html(pic);
    $("#ip_wan_detail").html(ip_wan);
});

$("#edit_form_relokasi").on('show.bs.modal', function (e) {
    var passData    = $(e.relatedTarget);
    var id          = passData.data("id");
    $.ajax({
        type: "POST",
        url: getBaseUrl()+"index.php/Api_relokasi/searchById",
        dataType: "json",
        data: {
            id: id
        },
        success: function (response) {
            if(response.code == 200) {
                
                $('#edit_id_jarkom').select2({
                    width: '100%',
                    minimumInputLength:3,
                    placeholder:"Type at least 3 charachter",
                    initSelection : function (element, callback) {
                        var data = {id: response.data.kode_jarkom, text: response.data.ip_wan+" / "+response.data.kode_jarkom+" / "+response.data.nickname_provider};
                        callback(data);
                    }
                });

                $('#edit_remote_name_new').select2({
                    width: '100%',
                    minimumInputLength:3,
                    placeholder:"Type at least 3 charachter",
                    initSelection : function (element, callback) {
                        var data = {id: response.data.id_remote_new, text: response.data.nama_remote_new};
                        callback(data);
                    }
                });

                $("#edit_status").val(response.data.status).change();
                $("#edit_doc_number").val(response.data.no_doc);
                $("#edit_pic_in_charge").val(response.data.pic);
                $("#edit_live_target").val(response.data.due_date);
                $("#edit_file_upload_current").val(response.data.file_url);
                $("#edit_id_remote_old").val(response.data.id_remote);
                $("#edit_no_spk").val(response.data.no_spk);
                $("#edit_network_type").val(response.data.network_type);
                $("#edit_ip_lan").val(response.data.ip_lan);
                $("#edit_ip_wan").val(response.data.ip_wan);
                $("#edit_remote_name").val(response.data.remote_name);
                $("#edit_remote_type").val(response.data.remote_type);
                $("#edit_region").val(response.data.region);
                $("#edit_remote_address").val(response.data.remote_address);

                $("#edit_remote_type_new").val(response.data.tipe_uker_new);
                $("#edit_region_new").val(response.data.nama_kanwil_new);
                $("#edit_remote_address_new").val(response.data.alamat_uker_new);
                $("#edit_network_type_new").val(response.data.network_type);
                $("#edit_ip_lan_new").val(response.data.ip_lan);
                $("#edit_ip_wan_new").val(response.data.ip_wan);
                $("#edit_reason").val(response.data.reason);
                $("#update_form").val(response.data.id_relokasi);
            } else {
                swal("Oops", "Data not found for id "+id, "success");
            }
        }
    });
});