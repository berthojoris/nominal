<div class="modal fade" id="open_detail_modal">
    <div class="modal-dialog" style="width: 700px;">
        <div class="modal-content" >
            <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail</h4>
            </div>

            <div class="modal-body">
                <div id="notFoundPanel">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-5">
                            <strong>Data Not Found</strong>
                        </div>
                    </div>
                </div>
                <div id="loadingPanel">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-4">
                            <img src="<?php echo base_url()."/assets/loader/loading.gif" ?>" alt="" srcset="" width="150">
                        </div>
                    </div>
                </div>


                <div id="dataPanel" style="display: none;">
                    <table>
                        <tr>
                            <td>Kode Jarkom</td>
                            <td class="detail">:</td>
                            <td><label id="detail_kode_jarkom" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Reason</td>
                            <td class="detail">:</td>
                            <td><label id="detail_reason" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td class="detail">:</td>
                            <td><label id="detail_status" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Due Date</td>
                            <td class="detail">:</td>
                            <td><label id="detail_due_date" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>PIC</td>
                            <td class="detail">:</td>
                            <td><label id="detail_pic" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>IP WAN Old</td>
                            <td class="detail">:</td>
                            <td><label id="detail_ip_wan_old" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>IP WAN New</td>
                            <td class="detail">:</td>
                            <td><label id="detail_ip_wan_new" class="detail"></label></td>
                        </tr>

                        <tr>
                            <td>Rec Doc No</td>
                            <td class="detail">:</td>
                            <td><label id="detail_req_doc_no" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Rec Doc Date</td>
                            <td class="detail">:</td>
                            <td><label id="detail_req_date" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Work Order No</td>
                            <td class="detail">:</td>
                            <td><label id="detail_work_order_no" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Type Relocate</td>
                            <td class="detail">:</td>
                            <td><label id="detail_type_relocate" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Network ID Old</td>
                            <td class="detail">:</td>
                            <td><label id="detail_network_id_old" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Network ID New</td>
                            <td class="detail">:</td>
                            <td><label id="detail_network_id_new" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>IP LAN Old</td>
                            <td class="detail">:</td>
                            <td><label id="detail_ip_lan_old" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>IP LAN New</td>
                            <td class="detail">:</td>
                            <td><label id="detail_ip_lan_new" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Remote Name Old</td>
                            <td class="detail">:</td>
                            <td><label id="detail_remote_name_old" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Remote Name New</td>
                            <td class="detail">:</td>
                            <td><label id="detail_remote_name_new" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Address Old</td>
                            <td class="detail">:</td>
                            <td><label id="detail_address_old" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Address New</td>
                            <td class="detail">:</td>
                            <td><label id="detail_address_new" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Remote Type</td>
                            <td class="detail">:</td>
                            <td><label id="detail_remote_type" class="detail"></label></td>
                        </tr>
                        <tr>
                            <td>Provider</td>
                            <td class="detail">:</td>
                            <td><label id="detail_provider" class="detail"></label></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>