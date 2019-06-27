<!DOCTYPE html>
<html style="background-color: #333333">
    <head>
        <meta charset="UTF-8">
        <title>BRI NOMINAL</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">  
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet">        
        <!-- iCheck -->
        <link href="<?php echo base_url('assets/js/plugins/iCheck/square/blue.css'); ?>" rel="stylesheet"> 

        <script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">

    </head>
    <body class="login-page"  style="background-color: #333333">
        <div class="login-box">
            <!-- <div class="login-logo" style="color:#0066cc"> -->
                <div align="center" style="font-size: 46px;color:#0066cc"><label style="text-align: center;">BRI NOMINAL</label></div>
                <div align="center" style="margin-top: -10px;margin-bottom: 20px"><label style="font-size:24px;color:#0066cc">Network Monitoring & Analytical</label></div>
            <!-- </div> -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session </p>
                <form action="<?php echo site_url('login/proses'); ?>" method="post" id="formid" onsubmit="enkrip()">
                    <?php
                    if (validation_errors() || $this->session->flashdata('result_login')) {
                        ?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning!</strong>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('result_login'); ?>
                        </div>    
                    <?php } ?>
                    <div class="form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="Username"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">    
                            <div class="checkbox icheck">
                                <!-- <label>
                                    <input type="checkbox"> Remember Me
                                </label> -->
                            </div>                        
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>                
                <div class="social-auth-links text-center" style="display: none;">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
                    <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
                </div><!-- /.social-auth-links -->

                <!-- <a href="#">I forgot my password</a><br>
                <a href="register.html" class="text-center">Register a new membership</a> -->

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script> 
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script> 
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/md5.min.js'); ?>"></script>       
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });

            function Login() {
                $.ajax({
                  url : url,
                  type: "POST",
                  data: $('#formid').serialize(),
                  dataType: "JSON",
                  success: function(data)
                  {
                    if (data==true) {
                      swal({
                          title:"Insert Data Success!", 
                          type: "success",
                          timer: 20000,   
                          confirmButtonText: "Ok"},
                        function(){
                        location.reload();
                      });
                    }else{
                      swal("Oops","Error Send Data", "error");
                    }
                      
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      //alert('Error Insert Data');
                      swal("Oops","Error Send Data", "error");

                  }
              });
            }

            function enkrip() {
                document.getElementById("password").value = md5(document.getElementById("password").value);
            }
        </script>
    </body>
</html>