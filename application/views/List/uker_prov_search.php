<script type="text/javascript">
function edit_jarkom(kodeja) {
  //alert('masoook');
  var url="<?php echo base_url(); ?>index.php/Dashboard/edit_jarkom";

    //ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form'+kodeja).serialize(),
        dataType: "JSON",
        success: function(data)
        {
            alert("Success!");
            location.reload();
            //swal("SUCCESS!", "", "success");
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            //swal("ERROR!", "", "error");
 
        }
    });
}

function test() {
  swal("SUCCESS!", "", "success");
}
</script>
<style>
a {color : #777777;}
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dash_Provider'; ?>"> Provider</a></li>
        <li class="active">Provider List</li>
      </ol>
    </div>
</section>
<section class="content">
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">List Network - Provider <?php echo $this->uri->segment(6); ?></div>
		<div class="panel-body">
			<div style="width:100%;height:50px;">
        <span style="float:left;font-size: 25px"><?php echo "Total : ".$total.""; ?></span>
        <span style="float:right;">
          <?php
            $kode_provider = $this->uri->segment(3);
            $kode_jenis_jarkom = $this->uri->segment(4);
            $brisat = $this->uri->segment(5);
            $name = $this->uri->segment(6);
          ?>         
          <div style="float: left; margin-right: 10px">
            <a href="<?php echo base_url().'index.php/Dashboard/uker_excel/provider/'.$kode_provider.'/'.$kode_jenis_jarkom.'/'.$brisat;?>"><button type="button" class="btn btn-primary btn-sm" style="width: 100px">
            Export Excel
            </button></a>
          </div>
					<div class="input-group input-group-sm" style="width: 150px;">
						<input type="hidden" name="url" id="url" value="<?php echo base_url().'index.php/Dashboard/uker_prov_search/'.$kode_provider.'/'.$kode_jenis_jarkom.'/'.$brisat.'/'.$name.'/'; ?>">
						<input type="text" name="input" class="form-control pull-right" id="input" placeholder="Search">
						<div class="input-group-btn">
							<button type="submit" class="btn btn-default" onclick="search()"><i class="fa fa-search"></i></button>
						</div>
					 </div>
				</span>
			</div>
			<div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" >
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Network ID</th>
                    <th>Remote Name</th>
                    <th>Remote Type</th>
                    <th>Region</th>
                    <th>Main Branch</th>
                    <th>Branch Code</th>
                    <th>IP WAN</th>
                    <th>Network Status</th>
                    <th>Last Change Update</th>
                    <th>Bandwidth</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(8)+1; foreach ($remote as $datas) {?>
                	<tr>
                		<td><?php echo $no;?></td>
                    <td><?php echo $datas->kode_jarkom;?></td>
                    <td><?php echo $datas->nama_remote;?></td>
                    <td><?php echo $datas->tipe_uker;?></td>
                    <td><?php echo $datas->nama_kanwil;?></td>
                    <td><?php echo $datas->nama_kanca;?></td>
                    <td><?php echo $datas->kode_uker;?></td>
                    <td><?php echo $datas->ip_wan;?></td>
                    <td><?php 
                        if ($datas->status==3) {
                          echo '<span class="label label-success">ONLINE</span>';
                          $waktu = $datas->status_rec_date;
                        }else if($datas->status==1 && $datas->kode_op==1){
                          echo '<span class="label label-danger">OFFLINE</span>';
                          $waktu = $datas->status_fail_date;
                        }else if($datas->status==1 && $datas->kode_op==2){
                          echo '<span class="label label-primary">NOP</span>';
                          $waktu = $datas->status_fail_date;
                        }else{
                          echo '<span class="label label-primary">UNKNOWN</span>';
                          $waktu = $datas->status_fail_date;
                        }
                      ?>
                    </td>
                    <td><?php 
                        //echo $datas->last_up;
                        $firstTime = strtotime($waktu);
                        $lastTime = strtotime(date('Y-m-d H:i:s'));
                        $lama = (($lastTime - $firstTime) / 3600) / 24;
                        $date_a = new DateTime($waktu);

                        $date_b = new DateTime(date('Y-m-d H:i:s'));
                          
                        $interval = date_diff($date_a, $date_b);

                        $lamane = $interval->format('%ad %hh %im %ss');   
                        echo $lamane;
                      ?>
                    </td>
                    <td><?php echo $datas->bandwidth; ?></td>
                    <td>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#<?php echo $datas->kode_jarkom;?>">
                          <i class="fa fa-edit"></i> Edit
                        </button>
                    </td>
                	</tr>
                    <!--pop up edit jarkom-->

                          <div class="modal fade" id="<?php echo $datas->kode_jarkom;?>">
                            <div class="modal-dialog">
                              <div class="modal-content" >
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Edit Network</h4>
                                </div>
                                <div class="modal-body">
                                  <form role="form" action="" id="form<?php echo $datas->kode_jarkom;?>" method='post'>
                                    <div class="box-body">
                                      <div class="row">
                                        <input type="hidden" name="kode_jarkom" value="<?php echo $datas->kode_jarkom;?>">
                                        <!-- <div class="col-md-6"> -->
                                          <div class="form-group">
                                            <label>Provider</label>
                                            <select class="form-control" name="kode_provider">
                                            <?php foreach ($provider as $p) {?>
                                              <option value="<?php echo $p->kode_provider;?>" 
                                                <?php echo $datas->kode_provider == $p->kode_provider ? 'selected' : ''?> >
                                                <?php echo $p->nickname_provider;?>
                                              </option>
                                            <?php }?>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label>Network Type</label>
                                            <select class="form-control" name="kode_jenis_jarkom">
                                            <?php foreach ($jenis_jarkom as $jj) {?>
                                              <option value="<?php echo $jj->kode_jenis_jarkom;?>" 
                                                <?php echo $datas->kode_jenis_jarkom == $jj->kode_jenis_jarkom ? 'selected' : ''?> >
                                                <?php echo $jj->jenis_jarkom;?>
                                              </option>
                                            <?php }?>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label>IP WAN</label>
                                            <div class="input-group">
                                              <div class="input-group-addon">
                                                <i class="fa fa-laptop"></i>
                                              </div>
                                              <input type="text" name="ip_wan" class="form-control" value="<?php echo $datas->ip_wan;?>" data-inputmask="'alias': 'ip'" data-mask >
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label>Network Type</label>
                                            <select class="form-control" name="brisat">
                                              <option value="1" 
                                                <?php echo $datas->brisat == 1 ? 'selected' : ''?> > BRISAT
                                              </option>
                                              <option value="0" 
                                                <?php echo $datas->brisat == 0 ? 'selected' : ''?> > NON BRISAT
                                              </option>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label>BANDWIDTH</label>
                                            <input type="text" name="bandwidth" class="form-control" value="<?php echo $datas->bandwidth;?>">
                                          </div>
                                          <!-- /.input group -->
                                        <!-- </div> -->
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button type="button" name="submit" value="submit" class="btn btn-primary" onclick="edit_jarkom('<?php echo $datas->kode_jarkom;?>')">Save</button>
                                    </div>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>

                    <!--end edit jarkom-->
                <?php $no++; }?>
                </tbody>
              </table>
              <?php echo $this->pagination->create_links();?>
            </div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript">
  function search() {
    search = $('#input').val();
    url = $('#url').val();
    //alert(url+search);
    window.location = url+search;
  }
</script>