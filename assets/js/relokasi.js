$(document).ready(function() {

    getProvider();
    loadDataTable();
    
    $("#form_add").validate({
        submitHandler: function(form) {
            form.submit();
        }
    });
    
    $("#add_form_btn").click(function (e) {
        resetForm();
        $("#add_form_relokasi").modal('show');
    });

    $("#live_target, #filter_order_date, #filter_live_target").datepicker({ 
        startDate: new Date(),
        todayHighlight: true,
        autoclose: true
    });

    $("#filter_form_btn").click(function (e) { 
        e.preventDefault();
        $("#filter_modal").modal('show');
        $("#filter_table_Data").empty();
    });

    $("#searchNow").click(function (e) { 
        e.preventDefault();
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
        dropdownParent: $("#add_form_relokasi"),
        minimumInputLength:5,
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
        dropdownParent: $("#add_form_relokasi"),
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

    $("#filter_ip").select2({
        dropdownParent: $("#filter_modal"),
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

    $("#filter_remote_name").select2({
        dropdownParent: $("#filter_modal"),
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

    $("#filter_doc_number").select2({
        dropdownParent: $("#filter_modal"),
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

    $("#filter_pic").select2({
        dropdownParent: $("#filter_modal"),
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
            $.each(response, function(i, o) {
                toAppend += '<option id="'+o.kode_provider+'">'+o.nama_provider+'</option>';
            });
            $('#filter_provider').append(toAppend);
        }
    });
}

function loadDataTable() {
    $('#filter_table_Data').DataTable({ 
        "processing": true,
        "serverSide": false,
        "paging": true,
        "responsive": false,
        "ajax": {
            "url": getBaseUrl()+"index.php/Api/getRelokasiData",
            "type": "POST"
        },
        "columns": [
            {
                "data": "ip_address_network_id",
                "name": "tb_relokasi.ip_address_network_id"
            },
            {
                "data": "reason",
                "name": "tb_relokasi.reason"
            },
            {
                "data": "doc_number",
                "name": "tb_relokasi.doc_number"
            },
            {
                "data": "file_upload",
                "name": "tb_relokasi.file_upload",
                "render": function(data, type, row, meta) {
                    var isian = ""
                    isian = '<a href="'+getBaseUrl()+'index.php/adm_operation/download/'+data+'">Download</a>';
                    return isian;
                 }
            },
            {
                "data": "pic",
                "name": "tb_relokasi.pic"
            },
            {
                "data": "live_target",
                "name": "tb_relokasi.live_target"
            },
            {
                "data": "ip_wan",
                "name": "tb_relokasi.ip_wan"
            },
            {
                "data": "remote_name",
                "name": "tb_relokasi.remote_name"
            },
            {
                "data": "remote_address",
                "name": "tb_relokasi.remote_address"
            }
        ],
    });
}