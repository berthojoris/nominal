<style>
a {color : #777777;}
</style>

<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>   
        <li class="active" style="color: #3C8DBC;">Incidental Report</li>
      </ol>
    </div>
</section>
<section class="content" style="margin-top: -30px">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Network Monitoring - <span id="incident_name">Incidental</span></div>
        <div class="panel-body">
            <div style="width:100%;height:50px;">
								
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="uker">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Remote Name</th>
                    <th>Branch Code</th>
                    <th>IP Address</th>
                    <th>Remote Status</th>
                    <th>Last Change Update</th>
                    <th>Network</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                
                </tbody>
              </table>
            </div>
        </div>
    </div>        
</div>
</section>

<script type="text/javascript">
  $(document).ready(function() {
      $('#uker').DataTable();
  });
</script>