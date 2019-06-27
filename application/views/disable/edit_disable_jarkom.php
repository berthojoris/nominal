<script src="<?php echo base_url(); ?>assets/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.0/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap-select.min.js"></script>
<link href="<?php echo base_url(); ?>assets/bootstrap-select.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<section class="content" style="height: 1000px">   
    <div class="row">
        <div class="panel panel-default" style="float: left;width:45%;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Change Network to Remote</div>
			<div class="panel-body">
				<div class="col-md-12">
		            <form role="form" id="formid">
		              <div class="box-body">
		              	<input type="hidden" name="kode_jarkom" id="kode_jarkom" value="<?php echo $this->uri->segment(3);?>">
		              	<input type="hidden" name="ip_wan" id="ip_wan" value="<?php echo $data[0]->ip_wan;?>">
		              	<input type="hidden" name="kode_jenis_jarkom" value="<?php echo $data[0]->kode_jenis_jarkom;?>">
		              	<input type="hidden" name="kode_provider" value="<?php echo $data[0]->kode_provider;?>">
		              	<input type="hidden" name="bandwidth" value="<?php echo $data[0]->bandwidth;?>">
		              	<input type="hidden" name="brisat" value="<?php echo $data[0]->brisat;?>">
		              	<input type="hidden" name="id_spk" value="<?php echo $data[0]->id_spk;?>">
						<div class="form-group">
                  			<label>REMOTE</label>
							<select class="form-control select2" name="id_remote" id="remote">
								<option value=""> -- Change Remote --</option>
							</select>
						</div>
						<div class="form-group">
                  			<label>STATUS</label>
							<select class="form-control select" name="used_status" id="used_status">
								<option value="1" <?php echo $data[0]->used_status==1 ? 'selected' : '' ;?> >Active</option>
								<option value="0" <?php echo $data[0]->used_status==0 ? 'selected' : '' ;?> >Non Active</option>
							</select>
						</div>
		              </div>
		              <div class="box-footer">
		                <button type="button" class="btn btn-primary pull-right" onclick="SaveChange()">Save</button>
		              </div>
		            </form>
		        </div>
			</div>			
        </div>

        <div class="panel panel-default" style="float: right; width: 52%;">
	        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Detail Network</div>     
	          <div style="width:100%;height:100%;position:relative;">                          
	                <table class="table table-hover">
	                  <tr>
	                    <th>Remote</th>
	                    <td>:</td>
	                    <td><?php echo $data[0]->nama_remote;?></td>
	                  </tr>
	                  <tr>
	                    <th>IP LAN</th>
	                    <td>:</td>
	                    <td><?php echo $data[0]->ip_lan;?></td>
	                  </tr>
	                  <tr>
	                    <th>Provider</th>
	                    <td>:</td>
	                    <td><?php echo $data[0]->nama_provider;?></td>
	                  </tr>
	                  <tr>
	                    <th>Type Network</th>
	                    <td>:</td>
	                    <td><?php echo $data[0]->jenis_jarkom;?></td>
	                  </tr>
	                  <tr>
	                    <th>Bandwidth</th>
	                    <td>:</td>
	                    <td><?php echo $data[0]->bandwidth;?></td>
	                  </tr>
	                  <tr>
	                    <th>IP WAN</th>
	                    <td>:</td>
	                    <td><?php echo $data[0]->ip_wan;?></td>
	                  </tr>
	                  <tr>
	                    <th>Used Status</th>
	                    <td>:</td>
	                    <td><?php
	                    	if ($data[0]->used_status==1) {
	                    		echo "Active";
	                    	}else{
	                    		echo "Non Active";
	                    	}
	                    ?></td>
	                  </tr>
	                </table>            
	          </div>
	      </div>

    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        //initialize();
		
		$("#remote").select2({
		  minimumInputLength:5,
		  placeholder:'IP LAN Remote',
		  //allowClear:true,
		  ajax:{
			  url: "<?php echo base_url().'index.php/Configure/GetIdRemote';?>",
			  dataType: 'JSON',
			  type: "GET",
			  data: function (params) {
				console.log(params);
				 return{
				  ip:params.term
				 }
			  },
			  processResults: function (data) {
				console.log(data);
				return{
				  results:data
				}
			  }

		  }
		});
    });	


    function SaveChange(){
    	var url="<?php echo base_url()."index.php/Dashboard/SaveChangeRemote/"; ?>";

	    if($("#ip").val()!='' && $("#used_status").val()!=''){
	      //ajax adding data to database
	      $.ajax({
	          url : url,
	          type: "POST",
	          data: $('#formid').serialize(),
	          dataType: "JSON",
	          success: function(data)
	          {
	            if (data==true) {
	              swal({
	                  title:"Change Remote Success!", 
	                  type: "success",
	                  timer: 20000,   
	                  confirmButtonText: "Ok"},
	                function(){
	                location.reload();
	              });
	            }else{
	              swal("Oops","Error Change Remote", "error");
	            }
	              
	          },
	          error: function (jqXHR, textStatus, errorThrown)
	          {
	              //alert('Error Insert Data');
	              swal("Oops","Error Change Remote", "error");

	          }
	      });
	    }else{
	      swal("Oops","IP Empty", "error");
	    }
    }
</script>
