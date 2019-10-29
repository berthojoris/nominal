$(document).ready(function() {

    $( document ).on( 'focus', ':input', function(){
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
            "url": getBaseUrl()+"index.php/Api/getRelokasiDataFilter",
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
                     return '<button class="btn btn-success btn-xs" data-toggle="modal" data-id="'+row.id_relokasi+'" data-nama_remote_old="'+row.nama_remote_old+'" data-nama_remote_new="'+row.nama_remote_new+'" data-alamat="'+row.alamat+'" data-file_url="'+row.file_url+'" data-status="'+row.status+'" data-due_date="'+row.due_date+'" data-pic="'+row.pic+'" data-target="#open_detail_modal">View</button>'
                }
            },
            {
                "data": "id",
                "sortable": false,
                 "render": function(data, type, row) {
                     return '<button class="btn btn-warning btn-xs" data-toggle="modal" data-id="'+row.id_relokasi+'">Edit</button>'
                }
            },
        ],
    });

    $("#form_add").validate({
        rules: {
            file_upload: {
                required: true,
                extension: "pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv"
            }
        },
        messages: {
            file_upload: {
                required: 'This field is required.',
                extension: 'Only allowed ext (pdf,jpg,jpeg,png,doc,docx,zip,rar,pdf,xls,xlsx,csv)'
            }
        },
        success: function(label, element) {
            
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
      
    
    $("#add_form_btn").click(function (e) {
        resetForm();
        $("#add_form_relokasi").modal('show');
    });

    $("#live_target").datepicker({ 
        startDate: new Date(),
        todayHighlight: true,
        autoclose: true
    });

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
            url: getBaseUrl()+"index.php/Api/getremotebyname",
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
        $("#no_spk").val('');
        $("#network_type").val('');
        $("#ip_lan").val('');
        $("#ip_wan").val('');
        $("#remote_name").val('');
        $("#remote_type").val('');
        $("#region").val('');
        $("#remote_address").val('');
        $("#network_type_new").val('');
        $("#ip_lan_new").val('');
        $("#ip_wan_new").val('');
        $.ajax({
            type: "POST",
            url: getBaseUrl()+"index.php/Api/searchByIpAddress",
            dataType: "json",
            data: {
                ip_network: ip_network
            },
            success: function (response) {
                if(response.code == 200) {
                    $("#id_remote_old").val(response.data.id_remote);
                    $("#no_spk").val(response.data.no_spk);
                    $("#network_type").val(response.data.network_type);
                    $("#ip_lan").val(response.data.ip_lan);
                    $("#ip_wan").val(response.data.ip_wan);
                    $("#remote_name").val(response.data.remote_name);
                    $("#remote_type").val(response.data.remote_type);
                    $("#region").val(response.data.region);
                    $("#remote_address").val(response.data.remote_address);
                    $("#network_type_new").val(response.data.network_type);
                    $("#ip_lan_new").val(response.data.ip_lan);
                    $("#ip_wan_new").val(response.data.ip_wan);
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
        placeholder:"Type at least 5 charachter",
        ajax:{
            url:getBaseUrl()+"index.php/Api/searchByIpAddressSelect2",
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
            url:getBaseUrl()+"index.php/Api/getRemoteByNameSelect2",
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

function resetForm() {
    var validator = $("#form_add").validate();
    validator.resetForm();
    $("#id_jarkom").empty();
    $("#remote_name_new").empty();
    $("#no_spk").val('');
    $("#network_type").val('');
    $("#ip_lan").val('');
    $("#ip_wan").val('');
    $("#remote_name").val('');
    $("#remote_type").val('');
    $("#region").val('');
    $("#remote_address").val('');
    $("#network_type_new").val('');
    $("#ip_lan_new").val('');
    $("#ip_wan_new").val('');
    $("#doc_number").val('');
    $("#pic_in_charge").val('');
    $("#live_target").val('');
    $("#remote_address_new").val('');
    $("#remote_type_new").val('');
    $("#region_new").val('');
    $("#remote_address_new").val('');
}

function getBaseUrl() {
    return $('meta[name=baseURL]').attr("content");
}

function getProvider() {
    $.ajax({
        type: "GET",
        url: getBaseUrl()+"index.php/Api/getProvider",
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

$("#open_detail_modal").on('show.bs.modal', function (e) {
    var passData     = $(e.relatedTarget);
    var nama_remote_new = passData.data("nama_remote_new");
    var nama_remote_old = passData.data("nama_remote_old");
    var alamat = passData.data("alamat");
    var file_url = passData.data("file_url");
    var status = passData.data("status");
    var due_date = passData.data("due_date");
    var pic = passData.data("pic");
    $("#nama_remote_new").html(nama_remote_new);
    $("#nama_remote_old").html(nama_remote_old);
    $("#alamat").html(alamat);
    $("#file_url").html(file_url);
    $("#status_detail").html(status);
    $("#due_date").html(due_date);
    $("#pic").html(pic);
});