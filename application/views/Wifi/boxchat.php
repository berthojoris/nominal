<?php foreach ($data as $datas) {
        if($this->session->userdata('username')==$datas->user_create){
?>
          <!-- Message to the right -->
          <div class="direct-chat-msg right">
            <div class="direct-chat-primary clearfix">
              <div class="direct-chat-name pull-right" style="margin-left: 5px"><?php echo $datas->nama?></div>
              <div class="direct-chat-timestamp pull-right"><?php echo $datas->create_at?></div>
            </div>
            <!-- /.direct-chat-info -->
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
              <?php echo $datas->comment?>
            </div>
            <!-- /.direct-chat-text -->
          </div>
          <!-- /.direct-chat-msg -->
<?php          
        }else{
?>
          <!-- Message. Default to the left -->
          <div class="direct-chat-msg">
            <div class="direct-chat-info clearfix">
              <div class="direct-chat-name pull-left" style="margin-right: 5px"><?php echo $datas->nama?></div>
              <div class="direct-chat-timestamp pull-left"><?php echo $datas->create_at?></div>
            </div>
            <!-- /.direct-chat-info -->
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
              <?php echo $datas->comment?>
            </div>
            <!-- /.direct-chat-text -->
          </div>
          <!-- /.direct-chat-msg -->

<?php
        }
?>

<?php }?>