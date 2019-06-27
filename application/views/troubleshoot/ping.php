
<style type="text/css">
.outer {
    width: 1250px;
    height: 100px;
    margin-left: : 0 auto;
    background: transparent;
    align-content: center;
}
.container {
    width: 200px;
    float: left;
    height: 200px;
    background: transparent;
    margin-right: -25px
}
.highcharts-yaxis-grid .highcharts-grid-line {
    display: none;
    background: transparent;
}

@media (max-width: 100%) {
    .outer {
        width: 100%;
        height: 100%;
        background: transparent;
    }
    .container {
        width: 100%;
        float: none;
        margin: 0 auto;
        background: transparent;
    }
}

#full.fullscreen{
    z-index: 9999; 
    width: 100%; 
    height: 100%; 
    position: absolute; 
    top: 0; 
    left: 0; 
    overflow: auto;
 }
  a {color : #777777;}

.blinking{
    animation:blinkingText 3s infinite;
}
@keyframes blinkingText{
    0%{     color: red;    }
    49%{    color: red    }
    50%{    color: transparent; }
    99%{    color: red;    }
    100%{   color: red;    }
}
</style>
<!-- jQuery CDN -->

<script src="<?php echo base_url(); ?>assets/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.0/jquery-ui.js"></script>

<script src="<?php echo base_url(); ?>assets/bootstrap-select.min.js"></script>
<link href="<?php echo base_url(); ?>assets/bootstrap-select.min.css" rel="stylesheet" />


<script>
    $(document).ready(function() {
        //initialize();
		var myForm = document.getElementById('form_ping');
		myForm.onsubmit = function() {
			//var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300,left = 312,top = 234');
			//this.target = 'Popup_Window';
			this.target = 'pingres';
		};
    });
	
	/*function getPing()
	{
		$("#result_ping").html(<?php include_once('Troubleshoot/ping');?>);
	}*/
	
	
</script>
<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>

<section style="margin-bottom: 30px">
    <div style="width:100%;height:38px;" class="panel panel-default">
    <ol class="breadcrumb"  style="background: white;">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li >Troubleshoot</li>
	  <li class="active" style="color: #3C8DBC;">Ping</li>
    </ol>
  </div>   
</section>
<section class="content" style="margin-top:-30px;">   
    <div class="row">
        <div class="panel panel-default" style="width:49%;float: left;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Test Ping Network</div>
			<div class="panel-body">
				<div class="form-group">
				<form action="<?php echo base_url();?>index.php/Troubleshoot/ping" method="post" id="form_ping" ">
				<table class="table table-hover">
					<tr>
						<th style="width: 100px">IP Address</th>
						<td style="width: 2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td style="width: 500px">
							
							<div class="input-group">
							  <div class="input-group-addon">
								<i class="fa fa-laptop"></i>
							  </div>
							  <input type="text" name="ip_address" class="form-control" data-inputmask="'alias': 'ip'" data-mask style="width: 200px;">
							</div>
						</td>
					</tr>
					
					<tr>
						<th style="width: 100px">Count</th>
						<td style="width: 2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td style="width: 500px">
							<input type="text" name="count" class="form-control" placeholder="4" style="width: 100px;">
						</td>
					</tr>
					
					<tr>
						<th style="width: 50px"></th>
						<td style="width: 2px"></td>			
					</tr>
					
				</table>
				<span class="input-group-btn" style="width: 0%;">
				<button type="submit" class="btn btn-block btn-primary" style="width:100px;">Ping</button>
				<!--<input type="button" value="Ping" onclick="getPing();" class="btn btn-primary" />-->
				</span>
				</form>
					</div>
			</div>			
        </div> 


		<div class="panel panel-default" style="width:49%;float: right;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Ping Result</div>
			<div class="panel-body">
				<div id="result_ping" style="width:100%;height:430px;">
					<iframe style="width:100%;height:100%;border:1px solid #cecece;" name="pingres" >
					</iframe>
				</div>
			</div>			
        </div>  
    </div>
	
	
	<?php if(isset($remote)){?>
	<!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
      </div>
      <!-- /.box -->
	<?php } ?>
</section>


<!-- InputMask -->
<script src="<?php echo base_url(); ?>/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
  })
</script>