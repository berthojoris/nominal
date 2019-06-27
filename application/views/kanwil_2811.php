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
    height: 190px;
    background: transparent;
    margin-right: -25px
}
.highcharts-yaxis-grid .highcharts-grid-line {
    display: none;
    background: transparent;
}

@media (max-width: 100px) {
    .outer {
        width: 100%;
        height: 200px;
        background: transparent;
    }
    .container {
        width: 100px;
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
</style>
<script type="text/javascript">
    $(document).ready(function() {
        //initialize();
    });
</script>
<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Region</li>
  </ol>
</section>
<section class="content" style="background: white">   
    <div class="row">
        <div class="col-md-12">
            <div class="box box-widget widget-user-2" style="width: 1250px">
                <div class="widget-user-header bg-green" style="height: 30px">
                  <!-- <div class="box-tools pull-left">
                    <button class="btn btn-primary"><i class="fa fa-external-link"></i></button>
                  </div> -->
                  <h2 align="center" style="margin-top: -15px">DASHBOARD ALL REGION</h2>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="margin-top: -45px">
                    <div id="content" style="top:50px;position:relative;margin-left: -20px;">        
                        <div style="width:65%;height:90%;position:relative;float:left">
                            <div class="outer"  id="Gauge_kanwil">
                            <?php //foreach ($data as $datas){
                                //echo count($data['kode_kanwil']);
                                for($i=0;$i<count($data['kode_kanwil']);$i++){
                                    if($i==count($data['kode_kanwil'])-1){?>
                                        <div id="container-<?php echo $data['kode_kanwil'][$i];?>" class="container"></div>
                                <?php }else{?>
                                        <a href="<?php echo base_url();?>index.php/Dashboard/kanca/<?php echo $data['kode_kanwil'][$i];?>"><div id="container-<?php echo $data['kode_kanwil'][$i];?>" class="container"></div></a>
                            <?php }} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="position:relative;margin-top: 150px;display: none">       
                <div class="box box-widget widget-user-2" style="height: 600px">
                    <div class="widget-user-header bg-green" style="width: 1250px;">
                      <!-- <div class="box-tools pull-left">
                        <button class="btn btn-primary"><i class="fa fa-external-link"></i></button>
                      </div> -->
                      <h2 align="center">NETWORK LOCATION OPERATION CENTER </h2>
                      <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="margin-top: -45px">
                        <div id="content" style="top:50px;position:relative;margin-left: -10px;">        
                            <div style="width:65%;height:90%;position:relative;float:left">
                                <div id="map" style="width:100%;height:100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
           
  initGauge();

  refresh();
});

function refresh()
{
    setTimeout(function(){
      //window.location.reload(1);
      refreshGauge();
       refresh();
    }, 30000);
}

function refreshGauge()
{
    var gaugeOptions = {
        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '100%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
                [0.86, '#fd0707'], // merah
                [0.88, '#ff8000'], // orange tua
                [0.94, '#ffbf00'], // orange
                [0.96, '#ffff4d'], // kuning
                [0.98, '#00ff55'], // hijau muda
                [0.99, '#00b33c'] // hujau
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
                y: -60
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };
    
    /* --------- COLLECT DATA --------- */
    
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
                //alert(data["data"]["persen"][j]['prosentase'].toFixed(2) );
                var prosen = data["data"]["persen"][j]["prosentase"].toFixed(2);
                 var chartKanca = Highcharts.chart('container-'+data["data"]["kode_kanwil"][j], Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 0,
                        max: 100,
                        title: {
                            text: '<div style="text-align:center"><span style="font-size:14px;font-weight: bold;">'+data["data"]["nama_kanwil"][j]+'<br>('+(parseInt(data["data"]['persen'][j]['all']))+')</span></div>'
                        }
                    },
                
                    credits: {
                        enabled: false
                    },
                    
                    series: [{
                        name: 'REGION '+data["data"]["nama_kanwil"][j],
                        data: [parseFloat(data["data"]["persen"][j]["prosentase"].toFixed(2))],
                        dataLabels: {
                            format: '<div style="text-align:center"><span style="font-size:12px;color:' +
                                ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                                   '<span style="font-size:10px;color:silver"> % Online</span></div>'
                        },
                        tooltip: {
                            valueSuffix: ' % Online'
                        }
                    }]
                
                }));
            }    
        }
    }); 
    
    /* --------END COLLECT DATA ------- */
}

function initGauge(){
    var gaugeOptions = {

        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '100%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
               
                [0.86, '#fd0707'], // merah
                [0.88, '#ff8000'], // orange tua
                [0.94, '#ffbf00'], // orange
                [0.96, '#ffff4d'], // kuning
                [0.98, '#00ff55'], // hijau muda
                [0.99, '#00b33c'] // hujau 
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
                y: -60
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };

        <?php //foreach ($data as $datas){
            for($i=0;$i<count($data['kode_kanwil']);$i++){
                // $on = (int)$data['persen'][$i]['on'];
                // $all = (int)$data['persen'][$i]['all'];
                //$persen = ($on / $all) * 100;
                ?>
                var chartKanca = Highcharts.chart('container-<?php echo $data['kode_kanwil'][$i];?>', Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 0,
                        max: 100,
                        title: {
                            text: '<div style="text-align:center"><span style="font-size:14px;font-weight: bold;"><?php echo $data['nama_kanwil'][$i]."<br>(".$data['persen'][$i]['all'].')';?></span></div>'
                        }
                    },
                
                    credits: {
                        enabled: false
                    },
                
                    series: [{
                        name: 'REGION <?php echo $data['nama_kanwil'][$i];?>',
                        data: [<?php echo number_format((float)$data['persen'][$i]['prosentase'], 2, '.', '');;?>],
                        dataLabels: {
                            format: '<div style="text-align:center"><span style="font-size:12px;color:' +
                                ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                                   '<span style="font-size:10px;color:silver"> % Online</span></div>'
                        },
                        tooltip: {
                            valueSuffix: ' % Online'
                        }
                    }]
                
                }));
        <?php }?>

}


function initialize(){

    var pinKanca = new Array();
     $.ajax({
        type: "POST",
        url: "<?php echo site_url('Dashboard/getKanwilLocations'); ?>",
        dataType:'JSON',
        //data: {"currdate" : currdate },
        error:function()
        {
            //alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {
           //alert(data['data'].length);
           //alert(data['data'][0]["latitude"]);
           for(var j=0 ; j<data['data'].length ;j++)
           {
              pinKanca[j] = new google.maps.LatLng(data['data'][j]["latitude"],data['data'][j]["longitude"]);       
           }
           
           //pinKanca[0] = new google.maps.LatLng(1.4895452,124.8391881);
           //alert(data['data'][0]["latitude"]+","+data['data'][0]["longitude"]);
           //alert(data['data'].length);
           //alert(myCenter[0]);
           //alert(pinKanca.length);
           var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: 'roadmap',
                center: {lat: 2.5489, lng: 118.0149},
                zoom: 8,
            }; 
            
          map = new google.maps.Map(document.getElementById("mapholder"), mapOptions);

           for(var i=0; i<pinKanca.length ; i++)
           { 
                var marker=new google.maps.Marker({ position:pinKanca[i] });
                marker.setMap(map);
           }
        }
    });
    //alert(myCenter.length);
    //alert(pinKanca.length); 
    //1.4898877,124.8406189
}






</script>
