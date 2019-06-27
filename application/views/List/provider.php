<style type="text/css">
  a {color : #777777;}
</style>
<?php if ($kategori=='kanwil') {?>
<section>
    <div style="width:100%;height:38px;" class="panel panel-default">
    <ol class="breadcrumb"  style="background: white;">
    <?php $kode_kanwil = $this->uri->segment(4);?>
    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
    <li><a href="<?php echo base_url().'index.php/Dashboard/Kanca/'.$kode_kanwil; ?>">Main Branch</a></li>
    <li class="active">Provider Table</li>
    </ol>
  </div>   
</section>
<?php }else if($kategori=='kanca'){?>
<section>
    <div style="width:100%;height:38px;" class="panel panel-default">
    <ol class="breadcrumb"  style="background: white;">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
      <li><a href="<?php echo base_url().'index.php/Dashboard/Kanca/'.$kanwil[0]->kode_kanwil; ?>">Main Branch</a></li>
      <li><a href="<?php echo base_url().'index.php/Dashboard/Remote/'.$this->uri->segment(4); ?>">Remote</a></li>
      <li class="active" style="color: #3C8DBC;"bbb>Provider Table</li>
    </ol>
  </div>   
</section>
<?php }?>
<section class="content">
<!--  <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title" style="font-weight: bold ">Monitoring Provider <?php echo $nama[0]->nama;?></h3>
            </div> -->
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Monitoring Provider <?php echo $nama[0]->nama;?></div>
        <div class="panel-body">
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped table-hover" id="provider">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Provider</th>
                    <th>UP</th>
                    <th>DOWN</th>
                    <th>NOP</th>
                    <th>Total</th>
                    <th>%</th>
                    <th>Progress</th>
                  </tr>
                </thead>
                <tbody>
                <!--Brisat-->
                <?php $no=1; $up=0; $down=0; $nop=0; $total = 0; $persen_total = 0;
                    for ($i=0; $i < $jenis_jarkom; $i++) { 
                      for ($j=0; $j < $provider; $j++) { 
                        if ($data_b[$i][$j]['nama']!=NULL) {
                          if ($data_b[$i][$j]['prosentase']<=80) {
                            $warna = '#fd0707';
                          }else if ($data_b[$i][$j]['prosentase']>=80 && $data_b[$i][$j]['prosentase']<=86) {
                            $warna = '#ff8000';
                          }else if ($data_b[$i][$j]['prosentase']>86 && $data_b[$i][$j]['prosentase']<=88) {
                            $warna = '#ffbf00';
                          }else if ($data_b[$i][$j]['prosentase']>88 && $data_b[$i][$j]['prosentase']<=94) {
                            $warna = '#ffff4d';
                          }else if($data_b[$i][$j]['prosentase']>94 && $data_b[$i][$j]['prosentase']<=96){
                            $warna = '#00ff55';
                          }else{
                            $warna = '#00b33c';
                          }
                    ?>
                          <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $data_b[$i][$j]['nama'];?></td>
                            <td><?php echo $data_b[$i][$j]['on']; $up = $up + $data_b[$i][$j]['on'];?></td>
                            <td><?php echo $data_b[$i][$j]['off']; $down = $down + $data_b[$i][$j]['off'];?></td>
                            <td><?php echo $data_b[$i][$j]['nop']; $nop = $nop + $data_b[$i][$j]['nop'];?></td>
                            <td><?php echo $data_b[$i][$j]['on']+$data_b[$i][$j]['off']+$data_b[$i][$j]['nop']; 
                            $total=$total+$data_b[$i][$j]['on']+$data_b[$i][$j]['off']+$data_b[$i][$j]['nop'];?></td>
                            <td><?php  echo number_format((float)$data_b[$i][$j]['prosentase'], 2, '.', '');?> %</td>
                            <td>
                              <div class="progress progress-xs progress-striped active" style="height: 20px">
                                <div class="progress-bar progress-bar" style="width: <?php  echo number_format((float)$data_b[$i][$j]['prosentase'], 2, '.', ''); $persen_total = $persen_total + $data_b[$i][$j]['prosentase'];?>%; background-color:<?php echo $warna;?>;"></div>
                              </div>
                            </td>
                          </tr>
                <?php 
                          $no++;
                        } 
                      }
                    }
                ?>

                <!--Non Brisat-->
                <?php 
                    for ($i=0; $i < $jenis_jarkom; $i++) { 
                      for ($j=0; $j < $provider; $j++) { 
                        if ($data_nb[$i][$j]['nama']!=NULL) {
                          if ($data_nb[$i][$j]['prosentase']<=80) {
                            $warna = '#fd0707';
                          }else if ($data_nb[$i][$j]['prosentase']>=80 && $data_nb[$i][$j]['prosentase']<=86) {
                            $warna = '#ff8000';
                          }else if ($data_nb[$i][$j]['prosentase']>86 && $data_nb[$i][$j]['prosentase']<=88) {
                            $warna = '#ffbf00';
                          }else if ($data_nb[$i][$j]['prosentase']>88 && $data_nb[$i][$j]['prosentase']<=94) {
                            $warna = '#ffff4d';
                          }else if($data_nb[$i][$j]['prosentase']>94 && $data_nb[$i][$j]['prosentase']<=96){
                            $warna = '#00ff55';
                          }else{
                            $warna = '#00b33c';
                          }
                    ?>
                          <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $data_nb[$i][$j]['nama']; ?></td>
                            <td><?php echo $data_nb[$i][$j]['on']; $up = $up + $data_nb[$i][$j]['on'];?></td>
                            <td><?php echo $data_nb[$i][$j]['off']; $down = $down + $data_nb[$i][$j]['off'];?></td>
                            <td><?php echo $data_nb[$i][$j]['nop'];  $nop = $nop + $data_nb[$i][$j]['nop'];?></td>
                            <td><?php echo $data_nb[$i][$j]['on']+$data_nb[$i][$j]['off']+$data_nb[$i][$j]['nop'];
                            $total=$total+$data_nb[$i][$j]['on']+$data_nb[$i][$j]['off']+$data_nb[$i][$j]['nop'];?></td>
                            <td><?php  echo number_format((float)$data_nb[$i][$j]['prosentase'], 2, '.', '');?> %</td>
                            <td>
                              <div class="progress progress-xs progress-striped active" style="height: 20px">
                                <div class="progress-bar progress-bar" style="width: <?php  echo number_format((float)$data_nb[$i][$j]['prosentase'], 2, '.', '');  $persen_total = $persen_total + $data_nb[$i][$j]['prosentase']; ?>%; background-color:<?php echo $warna;?>;"></div>
                              </div>
                            </td>
                          </tr>
                <?php 
                          $no++;
                        } 
                      }
                    }
                ?>
                </tbody>

                <tr>
                  <th></th>
                  <th>TOTAL</th>
                  <th><?php echo $up;?></th>
                  <th><?php echo $down;?></th>
                  <th><?php echo $nop;?></th>
                  <th><?php echo $total;?></th>
                  <th>
                    <?php  
                          $persen_total= ($up/ ($up+$down))*100; 
                          echo number_format((float)$persen_total, 2, '.', '');
                          if ($persen_total<=80) {
                            $warna = '#fd0707';
                          }else if ($persen_total>=80 && $persen_total<=86) {
                            $warna = '#ff8000';
                          }else if ($persen_total>86 && $persen_total<=88) {
                            $warna = '#ffbf00';
                          }else if ($persen_total>88 && $persen_total<=94) {
                            $warna = '#ffff4d';
                          }else if($persen_total>94 && $persen_total<=96){
                            $warna = '#00ff55';
                          }else{
                            $warna = '#00b33c';
                          }
                    ?> %
                  </th>
                  <th>
                    <div class="progress progress-xs progress-striped active" style="height: 20px">
                      <div class="progress-bar progress-bar" style="width: <?php  echo number_format((float)$persen_total, 2, '.', '');?>%; background-color:<?php echo $warna;?>;"></div>
                    </div>

                  </th>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
</section>
<script type="text/javascript">
  $(document).ready(function() {
      $('#provider').DataTable();
  });
</script>