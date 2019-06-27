
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

<!--<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>-->

<!--<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>-->

<section style="margin-bottom: 30px">
    <div style="width:100%;height:38px;" class="panel panel-default">
    <ol class="breadcrumb"  style="background: white;">
      <li><a href="" ><i class="fa fa-home"></i> Home</a></li>
      <li class="active" style="color: #3C8DBC;">Dashboard Request Routing</li>
    </ol>
  </div>   
</section>
<section class="content" style="margin-top:-30px; height: 100%"> 
  <div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/newopen','mywindow');" style="cursor: pointer;width: 250px">
        <span class="info-box-icon bg-aqua"><i class="fa fa-arrow-down"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">New Open</span>
          <span class="info-box-number" id="newopen"><?php echo $newopen;?> Remotes</span>
        </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/newrout','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-aqua"><i class="fa fa-arrow-down"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">New Routing</span>
        <span class="info-box-number" id="newrout"><?php echo $newrout;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/newsim','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-aqua"><i class="fa fa-arrow-down"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">New SIM Card</span>
        <span class="info-box-number" id="newsim"><?php echo $newsim;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-3 col-sm-6 col-xs-12" >
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/reqroll','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-red"><i class="fa fa-exclamation-circle"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Request Rollback</span>
        <span class="info-box-number" id="reqroll"><?php echo $reqroll;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div> 


  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/checkopen','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-yellow"><i class="fa fa-hourglass "></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Checking Open</span>
        <span class="info-box-number" id="checkopen"><?php echo $checkopen;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/checkrout','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-yellow"><i class="fa fa-hourglass "></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Checking Routing</span>
        <span class="info-box-number" id="checkrout"><?php echo $checkrout;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/checksim','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-yellow"><i class="fa fa-hourglass "></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Checking SIM Card</span>
        <span class="info-box-number" id="checksim"><?php echo $checksim;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12" >
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/proroll','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-yellow"><i class="fa fa-hourglass"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Progress Rollback</span>
        <span class="info-box-number" id="reqroll"><?php echo $proroll;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div> 


  <div class="row">
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/veropen','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Verified</span>
        <span class="info-box-number" id="veropen"><?php echo $veropen;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/verrout','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Routing Ready</span>
        <span class="info-box-number" id="verrout"><?php echo $verrout;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/versim','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">SIM Card Ready</span>
        <span class="info-box-number" id="versim"><?php echo $versim;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12" >
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/rolldone','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-green"><i class="fa fa-check "></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Rollback Done</span>
        <span class="info-box-number" id="rolldone"><?php echo $rolldone;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div> 


  <div class="row">

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/rejopen','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-red"><i class="fa fa-close"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Reject Open</span>
        <span class="info-box-number" id="rejopen"><?php echo $rejopen;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/rejrout','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-red"><i class="fa fa-close"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Reject Routing</span>
        <span class="info-box-number" id="rejrout"><?php echo $rejrout;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/rejsim','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-red"><i class="fa fa-close"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Reject SIM Card</span>
        <span class="info-box-number" id="rejsim"><?php echo $rejsim;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div> 

  <div class="row" style="margin-top: 50px">

    <div class="col-md-3 col-sm-6 col-xs-12" >
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/new','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-aqua"><i class="fa fa-arrow-down"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">New Request Routing</span>
        <span class="info-box-number" id="new"><?php echo $new;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12" >
      <div class="info-box" onclick="window.open('<?php echo base_url();?>index.php/Req_Routing/List/done','mywindow');" style="cursor: pointer;width: 250px">
      <span class="info-box-icon bg-green"><i class="fa fa-check "></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Routing Done</span>
        <span class="info-box-number" id="done"><?php echo $done;?> Remotes</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    
  </div>

  <div class="row" style="margin-top: 50px">
    
  </div>

   <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List User NOC</div>
      <div class="panel-body">
        <div style="width:100%;height:50px;">
            <div align="left" style="float: left;">
              <button type="button" class="btn btn-block btn-primary btn-xs" style="width: 150px;height:30px" onclick="show_form()">
                <i class="fa fa-search"></i>&nbsp; Filter
              </button>
            </div>
        </div>

        <div class="box box-primary" style="width: 50%;display:none;" id="form">
          <div class="box-header with-border">
            <h3 class="box-title">Filter</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="formid">
            <div class="box-body">

              <!-- Date and time range -->
              <div class="form-group">
                <label>Date and time range:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservationtime">
                </div>
                <!-- /.input group -->
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeForm()">Close</button>
              <button type="button" name="submit" value="submit" class="btn btn-primary pull-right" onclick="save()">Save</button>
            </div>
          </form>
        </div>
        <div style="width:100%;height:50px;">
          <span style="float: right;">
            <button type="button" class="btn btn-primary btn-sm" style="width: 100px" onclick="cetak()">Export Excel</button>
          </span>
        </div>
        <div class="box-body table-responsive no-padding" style="width: 99%">
          <table class="table table-bordered table-striped table-hover" id="data_user">
            <thead>
              <tr>
                <th>No</th>
                <th>User</th>
                <th>Verified Open</th>
                <th>Routing Ready</th>
                <th>SIM Card Ready</th>
                <th>Request Rollback</th>
                <th>Rollback Done</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot align="right">
				<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
			</tfoot>
          </table>
        </div>
      </div>
    </div>      
  </div>

</section>

<script type="text/javascript">
  $(document).ready(function() {

      //alert();
    tampilkan_data();

    refresh();

    $('#reservationtime').daterangepicker({ 
      timePicker: true, 
      timePicker24Hour: true,
      timePickerIncrement: 1, 
      format: 'YYYY-MM-DD HH:mm:ss' 
    });

  });

  function tampilkan_data()
  {

    //alert();
    $("#data_user").DataTable({
      "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api(), data;

        // converting to interger to find total
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
            };

        // computing column Total of the complete result 
        var v_open = api
            .column( 2 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );
				
		    var routing_r = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
					
        var simcard_r = api
              .column( 4 )
              .data()
              .reduce( function (a, b) {
                  return intVal(a) + intVal(b);
              }, 0 );
					
		     var r_rollback = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
					
		     var rollback_d = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
					
		     var total = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			
				
            // Update footer by showing the total with the reference of the column index 
	    	$( api.column( 0 ).footer() ).html('Total');
            $( api.column( 1 ).footer() ).html('');
            $( api.column( 2 ).footer() ).html(v_open);
            $( api.column( 3 ).footer() ).html(routing_r);
            $( api.column( 4 ).footer() ).html(simcard_r);
            $( api.column( 5 ).footer() ).html(r_rollback);
            $( api.column( 6 ).footer() ).html(rollback_d);
            $( api.column( 7 ).footer() ).html(total);
        },
      orderMulti: true,
      pageLength: 100,
      processing:true,
      serverSide:true,
      columns:[

        {data:"No"},
        {data:"User"},
        {data:"Verified Open"},
        {data:"Routing Ready"},
        {data:"SIM Card Ready"},
        {data:"Request Rollback"},
        {data:"Rollback Done"},
        {data:"Total"}
      ],
      columnDefs:[
        {
          targets:[0,6],
          orderable:true
        }
      ],

      ajax:{
        url:"<?php echo base_url().'index.php/Req_Routing/GetUser';?>",
        type:"post",
        dataType:"json"

      }
    });
  

  }



  function show_form() {
    $("#form").toggle();
  }

  function closeForm() {
    $("#form").toggle();
  }

  function refresh()
  {
      setTimeout(function(){
         Refresh_dash();
         refresh();
      }, 10000);
  }

  function Refresh_dash() {
    $.ajax({
        url : "<?php echo site_url('Req_Routing/Refresh_dash') ?>",
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          //console.log(data.done); 
          document.getElementById("new").innerHTML = data.new+' Remotes';
          document.getElementById("done").innerHTML = data.done+' Remotes';
          document.getElementById("reqroll").innerHTML = data.reqroll+' Remotes';
          document.getElementById("rolldone").innerHTML = data.rolldone+' Remotes';
          document.getElementById("newopen").innerHTML = data.newopen+' Remotes';
          document.getElementById("checkopen").innerHTML = data.checkopen+' Remotes';
          document.getElementById("veropen").innerHTML = data.veropen+' Remotes';
          document.getElementById("rejopen").innerHTML = data.rejopen+' Remotes';
          document.getElementById("newrout").innerHTML = data.newrout+' Remotes';
          document.getElementById("checkrout").innerHTML = data.checkrout+' Remotes';
          document.getElementById("verrout").innerHTML = data.verrout+' Remotes';
          document.getElementById("rejrout").innerHTML = data.rejrout+' Remotes'; 
          document.getElementById("newsim").innerHTML = data.newsim+' Remotes';
          document.getElementById("checksim").innerHTML = data.checksim+' Remotes';
          document.getElementById("versim").innerHTML = data.versim+' Remotes';
          document.getElementById("rejsim").innerHTML = data.rejsim+' Remotes';           
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error Insert Data');
            swal("Oops","Error Get Data", "error");
 
        }
    });
  }

  function  save() {
      var a = $("#reservationtime").val();
      var arr = a.split(" ");
      var start = arr[0]+' '+arr[1];
      var end = arr[3]+' '+arr[4];

      //alert(a);

      $('#data_user').dataTable().fnClearTable();
      $('#data_user').dataTable().fnDestroy();

      $("#data_user").DataTable({
      	"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // computing column Total of the complete result 
            var v_open = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
		    var routing_r = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
					
	        var simcard_r = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
					
		     var r_rollback = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
					
		     var rollback_d = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
					
		     var total = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			
				
            // Update footer by showing the total with the reference of the column index 
	    	$( api.column( 0 ).footer() ).html('Total');
            $( api.column( 1 ).footer() ).html('');
            $( api.column( 2 ).footer() ).html(v_open);
            $( api.column( 3 ).footer() ).html(routing_r);
            $( api.column( 4 ).footer() ).html(simcard_r);
            $( api.column( 5 ).footer() ).html(r_rollback);
            $( api.column( 6 ).footer() ).html(rollback_d);
            $( api.column( 7 ).footer() ).html(total);
        },
        orderMulti: true,
        pageLength: 100,
        processing:true,
        serverSide:true,
        columns:[

          {data:"No"},
          {data:"User"},
          {data:"Verified Open"},
          {data:"Routing Ready"},
          {data:"SIM Card Ready"},
          {data:"Request Rollback"},
          {data:"Rollback Done"},
          {data:"Total"}
        ],
        columnDefs:[
          {
            targets:[0,6],
            orderable:true
          }
        ],

        ajax:{
          url:"<?php echo base_url().'index.php/Req_Routing/GetUser2/';?>"+start+'/'+end,
          type:"post",
          dataType:"json"
        }
      });
  }

  function cetak() {
    var time = $("#reservationtime").val();
    if(time==''){
      var start = 0;
      var end = 0;
    }else{
      var arr = time.split(" ");
      var start = arr[0]+' '+arr[1];
      var end = arr[3]+' '+arr[4];
    }
    var url = "<?php echo site_url('Req_Routing/CetakNoc/') ?>"+start+'/'+end;
    //var url = "<?php echo site_url('Req_Routing/Cetak_pdf/') ?>"+start+'/'+end;
    location.href = url;
    
  }

</script>