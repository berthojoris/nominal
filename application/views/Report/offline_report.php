<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.0/jquery-ui.js"></script>
<!-- Select2 -->
<!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/plugins/select2/select2.min.css"> -->
<!-- Select2 -->
<!-- <script src="<?php //echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/bootstrap-select.min.js"></script>
<link href="<?php echo base_url(); ?>assets/bootstrap-select.min.css" rel="stylesheet" />

<!-- InputMask -->
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/timepicker/bootstrap-timepicker.min.css">
<!-- bootstrap time picker -->
<script src="<?php echo base_url(); ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker-bs3.css">
<!-- bootstrap time picker -->
<script src="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker.js"></script>

<section class="content">

<meta name="viewport" content="width=device-width, initial-scale=1">
 <h1>Offline Report Request</h1>


 </br>
  <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Searching Option</h3>
            </div>
            <!-- /.box-header -->
                          <form action="<?php echo base_url();?>index.php/Report/offline_report_result" method="post">

            <div class="box-body">

      			<!-- <div class="form-group col-md-3">
      				<select class="form-control">
      					<option>-Change Status-</option>
                    <option>Online</option>
                    <option>Offlie</option>
                  </select>
             </div> 
			 
			 <div class="form-group col-md-3">
				<input class="form-control" type="text" placeholder="request by ...">
             </div> -->
                <h3>Time Range</h3>
                <div class="input-group" style="width: 500px">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input type="text" class="form-control pull-left" name="time_range" id="reservationtime">
                </div>
                <hr>
                <h3>Remote Type</h3>
              <div class="form-group">

                <?php
                foreach ($remote_type as $value) {
                   echo "<label>
                  <input type='checkbox' name='".$value->singkatan."' value='".$value->tipe_uker."' class='minimal'>
                  ".$value->tipe_uker."
                </label>&nbsp &nbsp &nbsp";
                 } 
                ?>

              </div>
              <hr>
              <h3>Offline Cause</h3>
              <div class="form-group">

                <?php
                foreach ($alarm_type as $value) {
                   echo "<label>
                  <input type='checkbox' name='alarm_type_".$value->id."' value='".$value->id."' class='minimal'>
                  ".$value->alarm_type."
                </label>&nbsp &nbsp &nbsp";
                 } 
                ?>

              </div>

            </div>
			<div class="box-body">
			 <button type="submit" class="btn btn-primary">Submit</button>
			  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#request">
				  <i class="fa fa-plus-square"></i>Request Export
				</button> -->
			 </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</form>

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

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, 
      timePicker24Hour: true,
      timePickerIncrement: 1, 
      format: 'YYYY-MM-DD HH:mm:ss' })//h:mm A
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

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
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

