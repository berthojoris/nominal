
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

<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>

<!--<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>-->

<!--<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>-->

<section style="margin-bottom: 30px">
    <div style="width:100%;height:38px;" class="panel panel-default">
    <ol class="breadcrumb"  style="background: white;">
      <li><a href="" ><i class="fa fa-home"></i> Home</a></li>
      <li class="active" style="color: #3C8DBC;">Offline Dashboard</li>
    </ol>
  </div>   
</section>
<section class="content" style="margin-top:-30px;">   
    <div class="row">
        <!--<div class="panel panel-default" style="width:100%;"> 
            <!--<div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Dashboard All Region</div>-->
             <!--<div class="panel-body">-->
            <div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline','mywindow');" style="cursor: pointer;">
					<span class="info-box-icon bg-red"><i class="fa fa-arrow-down"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Total Offline</span>
					  <span class="info-box-number"><?php echo $total_remote_offline;?> Remotes</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box">
					<span class="info-box-icon bg-grey"><i class="fa fa-close "></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Total Remote Offline NOP</span>
					  <span class="info-box-number"><?php echo $total_remote_nop;?> Remotes</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
			</div>
	
			 <div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_less_1_hour','mywindow');" style="cursor: pointer;">
					<span class="info-box-icon bg-green"><i class="fa fa-arrow-down"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Offline Less 1 Hour</span>
					  <span class="info-box-number"><?php echo $total_remote_offline_less_1_hour;?> Remotes</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_1_4_hour','mywindow');" style="cursor: pointer;">
					<span class="info-box-icon bg-yellow"><i class="fa fa-arrow-down"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Offline 1-4 Hours</span>
					  <span class="info-box-number"><?php echo $total_remote_offline_1_4_hour;?> Remotes</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_4_12_hour','mywindow');" style="cursor: pointer;">
					<span class="info-box-icon bg-orange"><i class="fa fa-arrow-down"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Offline 4-12 Hours</span>
					  <span class="info-box-number"><?php echo $total_remote_offline_4_12_hour;?> Remotes</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_12_24_hour','mywindow');" style="cursor: pointer;">
					<span class="info-box-icon bg-red"><i class="fa fa-arrow-down"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Offline 12-24 Hours</span>
					  <span class="info-box-number"><?php echo $total_remote_offline_12_24_hour;?> Remotes</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_1_5_day','mywindow');" style="cursor: pointer;">
					<span class="info-box-icon bg-red"><i class="fa fa-exclamation-circle"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Offline 1-5 Days</span>
					  <span class="info-box-number"><?php echo $total_remote_offline_1_5_day;?> Remotes</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_more_5_day','mywindow');" style="cursor: pointer;">
					<span class="info-box-icon bg-red"><i class="fa fa-exclamation-circle"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Offline More 5 Days</span>
					  <span class="info-box-number"><?php echo $total_remote_offline_more_5_day;?> Remotes</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
				
			</div>
			<hr>
			
			<!--ALARM Remote-->
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-warning"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Total Remote Alarm</span>
					  <span class="info-box-number"><?php echo $total_remote_alarm;?> Alarms</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="fa fa-warning"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Unack Remote Alarm</span>
					  <span class="info-box-number"><?php echo $total_remote_unack_alarm;?> Alarms</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-warning"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Ack Remote Alarm</span>
					  <span class="info-box-number"><?php echo ($total_remote_ack_alarm+$total_remote_ack_alarm_define);?> Alarms</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->			
			</div>
			
			<!--ALARM Network-->
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-warning"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Total Network Alarm</span>
					  <span class="info-box-number"><?php echo $total_network_alarm;?> Alarms</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="fa fa-warning"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Unack Network Alarm</span>
					  <span class="info-box-number"><?php echo $total_network_unack_alarm;?> Alarms</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-warning"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">Ack Network Alarm</span>
					  <span class="info-box-number"><?php echo ($total_network_ack_alarm+$total_network_unack_alarm_define);?> Alarms</span>
					</div>
					<!-- /.info-box-content -->
				  </div>
				  <!-- /.info-box -->
				</div>
				<!-- /.col -->
								
			</div>

              <!--</div>-->
        <!--</div>-->
    </div>
</section>

<script type="text/javascript">


  function refresh()
  {
      setTimeout(function(){
        window.location.reload(1);
         refresh();
      }, 60000);
  }

</script>