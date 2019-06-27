
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


<script type="text/javascript">
    $(document).ready(function() {
        //initialize();
		
		$("#nama_remote").select2({
		  minimumInputLength:5,
		  placeholder:'IP LAN OR IP WAN',
		  //allowClear:true,
		  ajax:{

			url: "<?php echo base_url().'index.php/Configure/GetRemote';?>",
			  dataType: 'JSON',
			  type: "GET",
			  data: function (params) {
				console.log(params);
				 return{
				  nama_remote:params.term
				 }
			  },
			  processResults: function (data) {
				console.log(data)
				return{
				  results:data
				}
			  }

		  }
		});
    });
	
	
	
</script>
<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>

<section style="margin-bottom: 30px">
    <div style="width:100%;height:38px;" class="panel panel-default">
    <ol class="breadcrumb"  style="background: white;">
      <li><a href="<?php echo base_url();?>" ><i class="fa fa-home"></i> Home</a></li>
      <li >Troubleshoot</li>
	  <li class="active" style="color: #3C8DBC;">SpeedTest BRI</li>
    </ol>
  </div>   
</section>
<section class="content" style="margin-top:-30px;">   
    <div class="row">
        <div class="panel panel-default" style="width:100%;float: center;height:100%"> 
            <!--<div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Test Traceroute Network</div>-->
			<div class="panel-body">
				<embed style="width:100%;float: center;height:500px" src="http://nominal.bri.co.id/dev/speedtest/example-telemetry-resultSharing.html">
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
