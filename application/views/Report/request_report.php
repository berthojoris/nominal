<section class="content">

<meta name="viewport" content="width=device-width, initial-scale=1">
 <h1>Report Request</h1>


 </br>
  <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Searching Option</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="form-group col-md-3">
				<select class="form-control">
					<option>-Change Status-</option>
                    <option>Online</option>
                    <option>Offlie</option>
                  </select>
             </div> 
			 
			 <div class="form-group col-md-3">
				<input class="form-control" type="text" placeholder="request by ...">
             </div> 
            </div>
			<div class="box-body">
			 <button type="submit" class="btn btn-primary">Submit</button>
			  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#request">
				  <i class="fa fa-plus-square"></i>Request Export
				</button>
			 </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


  <?php if(isset($found)){
	//var_dump($found);
	?>
	<div class="row">
  	<div class="col-md-10">
  	 <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Search Result by Keyword <i>"<?php echo $search;?>"</i></h3><br/>
			  About <?php echo $found_count;?> results (<?php echo $time;?>) 

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
			  <?php foreach($found as $row){ ?>
			  
				<li class="item">
                  <div class="product-img">
                    <img src="http://172.18.65.56/nominal/assets/dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <!--<a href="javascript:void(0)" class="product-title"><?php echo $row->tipe_uker.' '.$row->nama_remote.'('.$row->kode_uker.')';?>-->
                    
					<a href="<?php echo site_url('/Dashboard/detail_uker/'.$row->id_remote.'/'.$row->kode_tipe_uker);?>" class="product-title"><?php echo $row->tipe_uker.' '.$row->nama_remote.'('.$row->kode_uker.')';?>
					<span class="label label-info pull-right"><?php echo $row->jenis_jarkom.'/'.$row->nickname_provider;?></span></a>
                    <span class="product-description">
						  <?php echo 'Region : '.$row->nama_kanwil;?><br/>
						  <?php echo 'IP LAN : '.$row->ip_lan;?><br/>
                          <?php echo 'Address : '.$row->alamat_uker;?>
                        </span>
                  </div>
                </li>
				
			  <?php }?>
				
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="javascript:void(0)" class="uppercase">View All Results</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
		  </div>
    </div>
	<?php } ?>
	
	
	
<div class="modal fade" id="request">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Request</h4>
      </div>
    	  <form role="form" action="<?php echo base_url()."index.php/Request/add_request_report"; ?>" method='post'>
          <div class="modal-body">
            <div class="box-body">
              <div class="row"> 
                    
        		    <div class="form-group col-md-4">
                  <select name="change_status" class="form-control">
                    <option value="-">-Change Status-</option>
                    <option value="online">Online</option>
                    <option value="offline">Offlie</option>
                  </select>
                </div>
        				<div class="form-group col-md-3">
                  <select name="time" class="form-control">
                    <option value="-">-Time-</option>
                    <option value="30">30</option>
                    <option value="1">1</option>
                    <option value="3">3</option>
                    <option value="6">6</option>
          					<option value="7">7</option>
          					<option value="12">12</option>
          					<option value="18">18</option>
          					<option value="24">24</option>
                  </select>
                </div>
        				<div class="form-group col-md-3">
                  <select class="form-control">
                    <option value="-">-Time Unit-</option>
                    <option value="minute">Minutes</option>
                    <option value="hour">Hour(s)</option>
                    <option value="day">Day(s)</option>
                  </select>Ago
                </div>
        
    				  </div>
            </div>
          </div>
      	  <div class="modal-footer ">
      		  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      		  <button type="submit" name="submit" value="submit" class="btn btn-primary" >Request</button>
      		</div>
    	</form>
    </div>
    <!-- /.modal-content -->
  </div>
</div>

</section>


