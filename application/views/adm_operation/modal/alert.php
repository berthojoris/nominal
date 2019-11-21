<div class="modal fade" id="notificationModal">
    <div class="modal-dialog" style="width: 500px;">
        <div class="modal-content" >
            <div class="modal-header" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Notification</h4>
            </div>
            <div class="modal-body"><?php echo $this->session->flashdata('notifMessage'); ?></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
 
<script type="text/javascript">
    <?php if($this->session->flashdata('notifMessage')) { ?>
        $("#notificationModal").modal('show');
    <?php } ?>
</script>