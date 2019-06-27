<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>

<section style="margin-bottom: 30px">
    <div style="width:100%;height:38px;" class="panel panel-default">
    <ol class="breadcrumb"  style="background: white;">
      <li><a href="" ><i class="fa fa-home"></i> Home</a></li>
      <li class="active" style="color: #3C8DBC;">Region</li>
    </ol>
  </div>   
</section>
<section class="content" style="margin-top:-30px;min-height: 1000px">   
    <div class="row">
        <div class="panel panel-default" style="width:100%;background: transparent;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Dashboard All Region</div>
            <div class="panel-body">
             <?php
            if(in_array( $this->session->userdata('role'), array(1,2,3,5,10))){
                  for($i=0;$i<count($data['kode_kanwil']);$i++){
                    $persen =  ($data['persen'][$i]['prosentase']-80)*5;

                    if ($data['persen'][$i]['prosentase']>=99 && $data['persen'][$i]['prosentase']<=100) {
                      $warna = '#009900';
                    }else if ($data['persen'][$i]['prosentase']>=98 && $data['persen'][$i]['prosentase']<99) {
                      $warna = '#00b300';
                    }else if ($data['persen'][$i]['prosentase']>=96 && $data['persen'][$i]['prosentase']<98) {
                      $warna = '#00cc00';
                    }else if ($data['persen'][$i]['prosentase']>=94 && $data['persen'][$i]['prosentase']<96) {
                      $warna = '#32CD32';
                    }else if ($data['persen'][$i]['prosentase']>=88 && $data['persen'][$i]['prosentase']<94) {
                      $warna = '#00ff00';
                    }else if ($data['persen'][$i]['prosentase']>=85 && $data['persen'][$i]['prosentase']<88) {
                      $warna = '#ff3300';
                    }

                    ?>
                    <div class="box-body" style="float: left;background: white;margin:5px 5px 7px 5px;height: 80px">
                      <div>
                        <p style="font-weight: bold;font-size: 16px;float: left;"><?php echo $data['nama_kanwil'][$i];?></p>
                        <p align="right" style="float: right;">(<?php echo $data['persen'][$i]['all'];?>)</p>
                      </div>
                      <div class="progress progress active" style="width: 200px;background: #d2d6de">
                        <div class="progress-bar progress-bar-striped" role="progressbar"  id="<?php echo $data['kode_kanwil'][$i];?>" style="width:<?php echo $persen;?>%;background: <?php echo $warna;?>"><span><?php echo number_format((float)$data['persen'][$i]['prosentase'], 2, '.', '')."%";?></span>
                        </div>
                      </div>
                    </div>
            <?php
                  }
            }
            ?>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {

  //refresh();

});

function refresh()
{
    setTimeout(function(){
      //window.location.reload(1);
      refreshBar();
       refresh();
    }, 30000);
}

function refreshBar()
{
    
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Dashboard/refreshKanwil'); ?>",
        dataType:'JSON',
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {
            //alert(data['all'][10]["latitude"]);      
            for(var j=0 ; j<data["data"]["kode_kanwil"].length ;j++)
            {
                
            }    
        }
    }); 
    
    /* --------END COLLECT DATA ------- */
}
</script>