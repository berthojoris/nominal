$(document).ready(function() {
    
    $("#add_form_btn").click(function (e) {
        $("#ip_address_network_id").val('');
        $("#add_form_relokasi").modal('show');
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
    });

    $('#live_target').datepicker({
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
            url: baseURL()+"/index.php/Api/getremotebyname",
            dataType: "json",
            data: {
                name: name
            },
            success: function (response) {
                if(response.code == 200) {
                    $("#remote_type_new").val(response.data[0].tipe_uker);
                    $("#region_new").val(response.data[0].nama_kanwil);
                    $("#remote_address_new").val(response.data[0].alamat_uker);
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
            url: baseURL()+"/index.php/Api/searchByIpAddress",
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

    $("#searchFilter").select2({
        minimumInputLength:6,
        placeholder:"Type at least 6 charachter",
        ajax:{
            url:baseURL()+"/index.php/ApiSimcard/findIccid",
            type:"post",
            dataType:"json",
            data: function(param) {
                return{search:param.term}
            },
            processResults:function(data) {
                return{results:data}
            }
        }
    });
});

function baseURL() {
    return window.location.protocol + "//" + window.location.host;
}