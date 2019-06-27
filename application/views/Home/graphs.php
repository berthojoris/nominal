<section class="content">

<meta name="viewport" content="width=device-width, initial-scale=1">
<style> 
input[type=text] {
  width: 130px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 100%;
}
</style>
 <h1>Nominal Quick Search</h1>
 <form action="<?php echo base_url();?>index.php/Home" method="post">
 <input type="text" name="search" placeholder="Search.. (Type Remote Name or IP LAN or Branch Code or IP WAN)" value="<?php if(isset($search)){echo $search;} ?>" >
</form>

 </br>
 
  <div class="row">
	<div class="col-lg-3 col-xs-6">


		<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $percentage_online_remote;?><sup style="font-size: 20px">%</sup></h3>
				  <p>REMOTE ONLINE PERCENTAGE</p>
				</div>
				<div class="icon">
				  <i class="ion ion-stats-bars"></i>
				</div>
				<?php echo $graphs;?>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
		
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-green">
			<div class="inner">
				<h3><?php echo $percentage_online_jarkom;?><sup style="font-size: 20px">%</sup></h3>

              <p>NETWORK ONLINE PERCENTAGE</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

</div>

</section>

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
