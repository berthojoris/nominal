
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
      <li><a href="" ><i class="fa fa-home"></i> Home</a></li>
      <li >Configure</li>
	  <li class="active" style="color: #3C8DBC;">New Configure</li>
    </ol>
  </div>   
</section>
<section class="content" style="margin-top:-30px;">   
    <div class="row">
        <div class="panel panel-default" style="width:75%;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">New Router Configuration</div>
			<div class="panel-body">
				<table class="table table-hover">
					<tr>
						<th style="width: 50px">IP LAN</th>
						<td style="width: 2px">:</td>
						<!--<td><input type="text" id="iplan" name="iplan" width="100px" maxlength="15"  style="width:110px;"/>&nbsp;/&nbsp;<input type="text" id="netmask" name="netmask" width="50px" maxlength="2" style="width:30px;"/>&nbsp;<input type="button" value="Go" style="width:50px;" /></td>-->
						<td style="width: 500px">
							<div class="form-group">
								<form action="<?php echo base_url();?>index.php/Configure/add" method="post">
									<select class="form-control select2" name="id_jarkom" id="nama_remote" style="width: 100%;">
										<option value="">
										  -----
										</option>
									</select>
									
									<span class="input-group-btn" style="width: 0%;">
									  <button type="submit" class="btn btn-block btn-primary">Lets Config</button>
									</span>
								</form>
							</div>
						</td>
					</tr>
				</table>
			</div>			
        </div>        
    </div>
	
	
	<?php if(isset($remote)){?>
	<!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Remote : <?php echo $remote->tipe_uker." ".$remote->nama_remote;?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
		<form action="<?php echo base_url();?>index.php/Configure/generate" method="post">
		<input type="text" class="form-control" name="id_jarkom" value="<?php echo $remote->id_jarkom;?>">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>IP LAN</label>
                <select class="form-control select2" name="ip_lan" style="width: 100%;">
                  <option selected="selected" value="<?php echo $remote->ip_lan;?>/24"><?php echo $remote->ip_lan."/".$remote->subnet;?></option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <?php if($remote->kode_jenis_jarkom==3) {?>
				<label>IP POOL</label>
                <select class="form-control select2" name="ip_pool" style="width: 100%;">
                  <option selected="selected" value="<?php echo $remote->ip_wan;?>/32"><?php echo $remote->ip_wan;?>/32</option>
                </select>
				<?php }else {?>
				<label>IP WAN</label>
                <select class="form-control select2" name="ip_wan" style="width: 100%;">
                  <option selected="selected" value="<?php echo $remote->ip_wan;?>/30"><?php echo $remote->ip_wan;?>/30</option>
                </select>
				<?php }?>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-2">
              <div class="form-group">
                <label>Provider</label>
                <select class="form-control select2" name="kode_provider" style="width: 100%;">
                  <option selected="selected" value="<?php echo $remote->kode_provider;?>"><?php echo $remote->nama_provider;?></option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Network Type</label>
                <select class="form-control select2" name="kode_jenis_jarkom" style="width: 100%;">
                  <option selected="selected" value="<?php echo $remote->kode_jenis_jarkom;?>"><?php echo $remote->jenis_jarkom;?></option>
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
			<div class="col-md-2">
				<?php if($remote->kode_jenis_jarkom!=3) {?>
				<div class="form-group">
					<label>Interface to WAN</label>
					<select class="form-control select2" name="interface_wan" style="width: 100%;">
					  <option selected="selected" value="">----</option>
				  <option value="ether1-<?php echo $remote->jenis_jarkom.'_'.$remote->nama_provider;?>">ether1</option>
				  <option value="ether2-<?php echo $remote->jenis_jarkom.'_'.$remote->nama_provider;?>">ether2</option>
				  <option value="ether3-<?php echo $remote->jenis_jarkom.'_'.$remote->nama_provider;?>">ether3</option>
				  <option value="ether4-<?php echo $remote->jenis_jarkom.'_'.$remote->nama_provider;?>">ether4</option>
				  <option value="ether5-<?php echo $remote->jenis_jarkom.'_'.$remote->nama_provider;?>">ether5</option>
					</select>
				</div>
				<?php }?>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Interface to LAN</label>
                <select class="form-control select2" name="interface_lan" style="width: 100%;">
                  <option selected="selected" value="">----</option>
				  <option value="0">ether1</option>
				  <option value="1">ether2</option>
				  <option value="2">ether3</option>
				  <option value="3">ether4</option>
				  <option value="4">ether5</option>
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
			
			
			<!-- /.col -->
			<div class="col-md-2">
				<?php if($remote->kode_jenis_jarkom==3) {?>
				<div class="form-group">
					<label>IP TUNNEL 1 (/30)</label>
					<div class="input-group">
					  <div class="input-group-addon">
						<i class="fa fa-laptop"></i>
					  </div>
					  <input type="text" name="ip_tunnel_1" class="form-control" data-inputmask="'alias': 'ip'" data-mask>
					</div>
				</div>
				
				<div class="form-group">
					<label>IP TUNNEL 2 (/30)</label>
					<div class="input-group">
					  <div class="input-group-addon">
						<i class="fa fa-laptop"></i>
					  </div>
					  <input type="text" name="ip_tunnel_2" class="form-control" data-inputmask="'alias': 'ip'" data-mask> 
					</div>
				</div>
				
				<?php }?>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
			
			
			
          </div>
		  <button type="submit" class="btn btn-block btn-primary" style="width:20%;">Generate Configuration</button>
		  </form>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Make sure all the data above is correct
		  <!--Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
          the plugin.-->
        </div>
      </div>
      <!-- /.box -->
	<?php } ?>
</section>
