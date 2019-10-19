$(document).ready(function() {
    
    $("#add_form_btn").click(function (e) {
        resetForm();
    });

    $("#live_target").datepicker({ 
        startDate: new Date(),
        todayHighlight: true,
        autoclose: true
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

    $("#ip_address_network_id").change(function (e) { 
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

    $("#ip_address_network_id").select2({
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
});

function resetForm() {
    $("#ip_address_network_id").empty();
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
    $("#add_form_relokasi").modal('show');
}

function getBaseUrl() {
    return $('meta[name=baseURL]').attr("content");
}