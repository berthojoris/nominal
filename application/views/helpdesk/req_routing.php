
<!-- jQuery CDN -->

<script src="<?php echo base_url(); ?>assets/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.0/jquery-ui.js"></script>

<script src="<?php echo base_url(); ?>assets/bootstrap-select.min.js"></script>
<link href="<?php echo base_url(); ?>assets/bootstrap-select.min.css" rel="stylesheet" />

<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>


<script>

</script>

<section style="margin-bottom: 30px">
    <div style="width:100%;height:38px;" class="panel panel-default">
    <ol class="breadcrumb"  style="background: white;">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li>Helpdesk</li>
	  <li class="active" style="color: #3C8DBC;">Request Routing</li>
    </ol>
  </div>   
</section>


<section class="content" style="margin-top:-30px;"> 
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Request Queue</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<td>No</td>
							<td>Req. ID</td>
							<td>Kode Uker</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>

  
    <div class="row">
        <div class="panel panel-default" style="width:49%;float: left;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Routing Progress Queue</div>
			<div class="panel-body">
				
			</div>			
        </div> 


		<div class="panel panel-default" style="width:49%;float: right;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">SIM Card verification Queue</div>
			<div class="panel-body">
				
			</div>			
        </div>  
    </div>
	
	
</section>
