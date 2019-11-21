<?php if($this->session->flashdata('notifMessage')) { ?>
    <input type="hidden" id="notif" value="<?php echo $this->session->flashdata('notifMessage') ?>">
<?php } ?>
<script type="text/javascript">
    <?php if($this->session->flashdata('notifMessage')) { ?>
        swal("Notification", $("#notif").val(), "success");
    <?php } ?>
</script>