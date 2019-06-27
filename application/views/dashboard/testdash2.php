<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>

<style type="text/css">
  span{
    font-size: 16px;
  }
</style>

<section style="margin-bottom: 30px">
    <div style="width:100%;height:38px;" class="panel panel-default">
    <ol class="breadcrumb"  style="background: white;">
      <li><a href="" ><i class="fa fa-home"></i> Home</a></li>
      <li class="active" style="color: #3C8DBC;">Region</li>
    </ol>
  </div>   
</section>
<?php

function warna($persen='')
{
  if ($persen>=99 && $persen<=100) {
    $warna = '#43BA20';
  }else if ($persen>=98 && $persen<99) {
    $warna = '#25FF00';
  }else if ($persen>=97.5 && $persen<98) {
    $warna = '#93FF00';
  }else if ($persen>=96 && $persen<97.5) {
    $warna = '#F7FF00';
  }else if ($persen>=94 && $persen<96) {
    $warna = '#FFA300';
  }else if ($persen>=85 && $persen<94) {
    $warna = '#FF8200';
  }else{
    $warna = '#FF0000';
  }

  return $warna;
}

?>
<section class="content" style="margin-top:-30px;min-height: 1000px">   
    <div class="row">
        <div class="panel panel-default" style="width:100%;background: transparent;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Dashboard All Provider</div>
            <div class="panel-body">
             <?php
             // if(in_array( $this->session->userdata('role'), array(1,2,3,5,10))){
             //     for($j=0;$j<count($prov);$j++){
                    ?>
                    <!-- <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[$j]->kode_provider.'/'.$prov[$j]->kode_jenis_jarkom.'/'.$prov[$j]->brisat.'/'.$prov[$j]->nickname_provider.'/';?>">
                      <div class="box-body" style="float: left;background: white;margin:5px 5px 7px 5px;height: 70px">
                        <div style="color: black">
                          <p style="font-weight: bold;font-size: 16px;float: left;"><?php echo $prov[$j]->nickname_provider;?></p>
                          <p align="right" style="float: right;">(<?php echo $data_prov[$j]['total'];?>)</p>
                        </div>
                        <div class="progress progress active" style="width: 200px;background: #d2d6de">
                          <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[$j]->nickname_provider;?>" style="width:<?php echo ($data_prov[$j]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[$j]['prosentase']);?>">
                            <span id="span<?php echo $prov[$j]->nickname_provider;?>"><?php echo number_format((float)$data_prov[$j]['prosentase'], 2, '.', '')."%";?></span>
                          </div>
                        </div>
                      </div>
                    </a> -->
                    <div class="row">
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[23]->kode_provider.'/'.$prov[23]->kode_jenis_jarkom.'/'.$prov[23]->brisat.'/'.$prov[23]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;border-radius: 25px;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:10px; line-height: 80%;"><?php echo $prov[23]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[23]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[23]->nickname_provider;?>" style="width:<?php echo ($data_prov[23]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[23]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[23]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[24]->kode_provider.'/'.$prov[24]->kode_jenis_jarkom.'/'.$prov[24]->brisat.'/'.$prov[24]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:10px; line-height: 80%;"><?php echo $prov[24]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[24]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[24]->nickname_provider;?>" style="width:<?php echo ($data_prov[24]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[24]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[24]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[25]->kode_provider.'/'.$prov[25]->kode_jenis_jarkom.'/'.$prov[25]->brisat.'/'.$prov[25]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:25px; line-height: 80%;"><?php echo $prov[25]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[25]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[25]->nickname_provider;?>" style="width:<?php echo ($data_prov[25]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[25]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[25]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[22]->kode_provider.'/'.$prov[22]->kode_jenis_jarkom.'/'.$prov[22]->brisat.'/'.$prov[22]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:22px; line-height: 80%;"><?php echo $prov[22]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[22]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[22]->nickname_provider;?>" style="width:<?php echo ($data_prov[22]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[22]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[22]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                    </div>

                    <div class="row">
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[3]->kode_provider.'/'.$prov[3]->kode_jenis_jarkom.'/'.$prov[3]->brisat.'/'.$prov[3]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[3]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[3]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[3]->nickname_provider;?>" style="width:<?php echo ($data_prov[3]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[3]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[3]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[2]->kode_provider.'/'.$prov[2]->kode_jenis_jarkom.'/'.$prov[2]->brisat.'/'.$prov[2]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[2]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[2]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[2]->nickname_provider;?>" style="width:<?php echo ($data_prov[2]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[2]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[2]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                       <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[1]->kode_provider.'/'.$prov[1]->kode_jenis_jarkom.'/'.$prov[1]->brisat.'/'.$prov[1]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[1]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[1]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[1]->nickname_provider;?>" style="width:<?php echo ($data_prov[1]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[1]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[1]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[0]->kode_provider.'/'.$prov[0]->kode_jenis_jarkom.'/'.$prov[0]->brisat.'/'.$prov[0]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[0]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[0]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[0]->nickname_provider;?>" style="width:<?php echo ($data_prov[0]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[0]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[0]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[4]->kode_provider.'/'.$prov[4]->kode_jenis_jarkom.'/'.$prov[4]->brisat.'/'.$prov[4]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[4]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[4]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[4]->nickname_provider;?>" style="width:<?php echo ($data_prov[4]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[4]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[4]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                    </div>

                    <div  class="row">
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[6]->kode_provider.'/'.$prov[6]->kode_jenis_jarkom.'/'.$prov[6]->brisat.'/'.$prov[6]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[6]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[6]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[6]->nickname_provider;?>" style="width:<?php echo ($data_prov[6]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[6]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[6]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[7]->kode_provider.'/'.$prov[7]->kode_jenis_jarkom.'/'.$prov[7]->brisat.'/'.$prov[7]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[7]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[7]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[7]->nickname_provider;?>" style="width:<?php echo ($data_prov[7]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[7]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[7]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[17]->kode_provider.'/'.$prov[17]->kode_jenis_jarkom.'/'.$prov[17]->brisat.'/'.$prov[17]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[17]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[17]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[17]->nickname_provider;?>" style="width:<?php echo ($data_prov[17]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[17]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[17]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[15]->kode_provider.'/'.$prov[15]->kode_jenis_jarkom.'/'.$prov[15]->brisat.'/'.$prov[15]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[15]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[15]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[15]->nickname_provider;?>" style="width:<?php echo ($data_prov[15]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[15]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[15]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[10]->kode_provider.'/'.$prov[10]->kode_jenis_jarkom.'/'.$prov[10]->brisat.'/'.$prov[10]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[10]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[10]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[10]->nickname_provider;?>" style="width:<?php echo ($data_prov[10]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[10]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[10]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[18]->kode_provider.'/'.$prov[18]->kode_jenis_jarkom.'/'.$prov[18]->brisat.'/'.$prov[18]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[18]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[18]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[18]->nickname_provider;?>" style="width:<?php echo ($data_prov[18]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[18]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[18]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                    </div>

                    <div  class="row">
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[5]->kode_provider.'/'.$prov[5]->kode_jenis_jarkom.'/'.$prov[5]->brisat.'/'.$prov[5]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[5]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[5]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[5]->nickname_provider;?>" style="width:<?php echo ($data_prov[5]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[5]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[5]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[9]->kode_provider.'/'.$prov[9]->kode_jenis_jarkom.'/'.$prov[9]->brisat.'/'.$prov[9]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[9]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[9]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[9]->nickname_provider;?>" style="width:<?php echo ($data_prov[9]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[9]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[9]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[13]->kode_provider.'/'.$prov[13]->kode_jenis_jarkom.'/'.$prov[13]->brisat.'/'.$prov[13]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[13]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[13]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[13]->nickname_provider;?>" style="width:<?php echo ($data_prov[13]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[13]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[13]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[12]->kode_provider.'/'.$prov[12]->kode_jenis_jarkom.'/'.$prov[12]->brisat.'/'.$prov[12]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[12]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[12]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[12]->nickname_provider;?>" style="width:<?php echo ($data_prov[12]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[12]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[12]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[11]->kode_provider.'/'.$prov[11]->kode_jenis_jarkom.'/'.$prov[11]->brisat.'/'.$prov[11]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[11]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[11]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[11]->nickname_provider;?>" style="width:<?php echo ($data_prov[11]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[11]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[11]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[14]->kode_provider.'/'.$prov[14]->kode_jenis_jarkom.'/'.$prov[14]->brisat.'/'.$prov[14]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[14]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[14]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[14]->nickname_provider;?>" style="width:<?php echo ($data_prov[14]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[14]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[14]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                    </div>

                    <div  class="row">
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[19]->kode_provider.'/'.$prov[19]->kode_jenis_jarkom.'/'.$prov[19]->brisat.'/'.$prov[19]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[19]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[19]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[19]->nickname_provider;?>" style="width:<?php echo ($data_prov[19]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[19]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[19]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[21]->kode_provider.'/'.$prov[21]->kode_jenis_jarkom.'/'.$prov[21]->brisat.'/'.$prov[21]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[21]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[21]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[21]->nickname_provider;?>" style="width:<?php echo ($data_prov[21]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[21]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[21]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[16]->kode_provider.'/'.$prov[16]->kode_jenis_jarkom.'/'.$prov[16]->brisat.'/'.$prov[16]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[16]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[16]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[16]->nickname_provider;?>" style="width:<?php echo ($data_prov[16]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[16]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[16]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[20]->kode_provider.'/'.$prov[20]->kode_jenis_jarkom.'/'.$prov[20]->brisat.'/'.$prov[20]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[20]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[20]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[20]->nickname_provider;?>" style="width:<?php echo ($data_prov[20]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[20]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[20]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                      <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[8]->kode_provider.'/'.$prov[8]->kode_jenis_jarkom.'/'.$prov[8]->brisat.'/'.$prov[8]->nickname_provider.'/';?>">
                        <div class="box-body" style="float: left;background: white;border-radius: 25px;border-style: solid;border-color: #A9A9A9;margin:13px 13px 13px 13px;height: 90px">
                          <div style="color: black">
                            <span style="font-family:arial;font-size:18px;text-align: center;float: left;margin-top: -5px;margin-left:3px; line-height: 80%;"><?php echo $prov[8]->nickname_provider;?><br><font size="2">(<?php echo $data_prov[8]['total'];?>)</font></span>
                          </div>
                          <div class="progress progress active" style="width: 175px;background: #d2d6de;height: 30px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $prov[8]->nickname_provider;?>" style="width:<?php echo ($data_prov[8]['prosentase']-80)*5;?>%;background: <?php echo warna($data_prov[8]['prosentase']);?>">
                            </div>
                          </div>
                          <div style="color: black;margin-top: -25px">
                            <p align="center" style="font-size: 20px;font-weight:bold;"><?php echo number_format((float)$data_prov[8]['prosentase'], 2, '.', '')." %";?></p>
                          </div>
                        </div>
                      </a>
                    </div>
            <?php
            //       }
            // }
            ?>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {

  refresh();

});

function refresh()
{
    setTimeout(function(){
      window.location.reload(1);
      refreshBar();
       //refresh();
    }, 30000);
}

function warna(persen='')
{
  var warna = '';
  if (persen>=99 && persen<=100) {
    warna = '#009900';
  }else if (persen>=98 && persen<99) {
    warna = '#00e600';
  }else if (persen>=97.5 && persen<98) {
    warna = '#00e600';
  }else if (persen>=96 && persen<97.5) {
    warna = '#e6e600';
  }else if (persen>=94 && persen<96) {
    warna = '#ff6600';
  }else if (persen>=85 && persen<94) {
    warna = '#ff3300';
  }else{
    warna = '#d2d6de';
  }

  return warna;
}

function refreshBar()
{
    
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Dash_Provider/refreshProv'); ?>",
        dataType:'JSON',
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {
            //alert(data["prov"][0]['nickname_provider']);  
            var persen=0,warna='',id='';    
            for(var j = 0 ; j < data["data_prov"].length ;j++)
            {
                id = data["prov"][j]["nickname_provider"];

                persen = (data["data_prov"][j]["prosentase"]-80)*5;

                persenfix = persen+"%";

                if (persen>=99 && data["data_prov"][j]["prosentase"]<=100) {
                  warna = '#009900';
                }else if (data["data_prov"][j]["prosentase"]>=98 && data["data_prov"][j]["prosentase"]<99) {
                  warna = '#00e600';
                }else if (data["data_prov"][j]["prosentase"]>=97.5 && data["data_prov"][j]["prosentase"]<98) {
                  warna = '#00e600';
                }else if (data["data_prov"][j]["prosentase"]>=96 && data["data_prov"][j]["prosentase"]<97.5) {
                  warna = '#e6e600';
                }else if (data["data_prov"][j]["prosentase"]>=94 && data["data_prov"][j]["prosentase"]<96) {
                  warna = '#ff6600';
                }else if (data["data_prov"][j]["prosentase"]>=85 && data["data_prov"][j]["prosentase"]<94) {
                  warna = '#ff3300';
                }else{
                  warna = '#d2d6de';
                }
                //console.log(id);
                //document.getElementById(id).style.width = persenfix;
                var elem = document.getElementById(id);
                var elem2 = document.getElementById("span"+id);
                if( (typeof elem !== 'undefined' && elem !== null) && (typeof elem2 !== 'undefined' && elem2 !== null) ) {
                  elem.style.width = persenfix;
                  elem.style.background = warna;
                  elem2.innerHTML = data["data_prov"][j]["prosentase"].toFixed(2)+"%";
                  console.log(id);
                }
                //document.getElementById(data["prov"][j]["nickname_provider"]).style.background = warna;
                //document.getElementById("span"+data["prov"][j]["nickname_provider"]).innerHTML = data["data_prov"][j]["prosentase"].toFixed(2)+"%";
            }    
        }
    }); 
    
}
</script>