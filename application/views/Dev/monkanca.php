
<style>
a {color : #777777;}
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Kanca/'.$kode_kanwil; ?>">Main Branch</a></li>
        <li class="active" style="color: #3C8DBC;">Remote List</li>
      </ol>
    </div>
</section>
<section class="content">
<div class="row">
    <div class="panel panel-default " style="float: left;width:49%;">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Kanca Monitoring</div>
		<div class="panel-body">             
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="main_branch">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Remote Name</th>
                    <th>IP Address</th>
                    <th>Remote Status</th>
                    <th>Last Change Update</th>
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
      $('#submain_branch').DataTable( {
        "pageLength": 25
      } );
      getDataKanca();
      refresh();
  });

    function getDataKanca()
    {
    	//alert("called");
    	$.ajax({
	        type: "POST",
	        //url: "<?php echo site_url('Dev/dataMonitorKanca/'.$this->uri->segment(3)); ?>",
	        url: "<?php echo site_url('Dev/dataMonitorKanca'); ?>",
	        dataType:'JSON',
	        error:function()
	        {
	            alert("Error\nGagal retrieve data");
	        },
	        success: function(data)
	        {
	        	var html = "";
	        	for(var i=0 ; i<data["data"].length ; i++)
	        	{
	        		html += "<tr>";
	        		html += "<td>"+(i+1)+"</td>";
	        		html += "<td>"+(data["data"][i]["nama_remote"])+"</td>";
	        		html += "<td>"+(data["data"][i]["ip_lan"])+"</td>";
	        		html += "<td>"+(data["data"][i]["status"]==3 ? "UP" : "DOWN")+"</td>";
	        		html += "<td>"+(data["data"][i]["last_update"])+"</td>";
	        		html += "</tr>";
	        	}

	        	//alert(data["data"][i]["nama_remote"]);

	        	$("#main_branch tbody").html(html);
	        }
	    });
    }

  function refresh()
  {
      setTimeout(function(){
        //window.location.reload(1);
        getDataKanca();
        refresh();
      }, 60000);
  }

  
</script>