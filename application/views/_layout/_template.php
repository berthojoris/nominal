<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title;?></title>
    <!-- meta -->
    <?php echo @$_meta; ?>

    <!-- css --> 
    <?php echo @$_css; ?>

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <meta name="baseURL" content="<?php echo base_url(); ?>">
  </head>

  <body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <div class="wrapper">
      <!-- header -->
      <?php echo @$_header; ?> <!-- nav -->
      
      <!-- sidebar -->
      <?php echo @$_sidebar; ?>
      
      <!-- content -->
      <?php echo @$_content; ?> <!-- headerContent --><!-- mainContent -->
    
      <!-- footer -->
      <?php echo @$_footer; ?>
    
      <div class="control-sidebar-bg"></div>
    </div>

     <!-- Ajax loader process -->
    <div id="ajax_loader" class="container" align="center">
        <div id="icon_gif"></div>
        <div id="message">processing..</div>
    </div>

    <!-- js -->
    <?php echo @$_js; ?>
    <script src="<?php echo base_url(); ?>assets/js/relokasi.js"></script>
  </body>
</html>