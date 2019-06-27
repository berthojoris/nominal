<style type="text/css">
.outer {
    width: 100%;
    height: 100%;
    margin-left: : 0 auto;
    background: transparent;
    align-content: center;
}
.container {
    width: 225px;
    float: left;
    height: 165px;
    background: transparent;
    margin-right: -30px;
    margin-top: -10px
}
.highcharts-yaxis-grid .highcharts-grid-line {
    display: none;
    background: transparent;
}

@media (max-width: 100px) {
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
</style>

<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>

<!-- <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script> -->

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>
<style>
a {color : #777777;}
</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Provider</li>
      </ol>
    </div>
</section>
<section class="content" style="height: 1000px">   
    <div class="row">
        <div class="panel panel-default" style="width:100%;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">DASHBOARD JUPITER</div>
             <div class="panel-body">     
                <div style="width:100%;height: 100%;float: left;">
                <?php if($this->session->userdata('role')==10){?>
                        <div class="row"  style="margin-bottom: 10px">
                            <div class="outer">

                                <?php if($this->session->userdata('provider')==$prov[0]->kode_provider){?>
                                <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[0]->kode_provider.'/'.$prov[0]->kode_jenis_jarkom.'/'.$prov[0]->brisat.'/'.$prov[0]->nickname_provider.'/';?>">
                                    <div id="container-<?php echo $prov[0]->nickname_provider;?>" class="container" ></div>
                                </a>
                                <?php }else{?>
                                    <div id="container-<?php echo $prov[0]->nickname_provider;?>" class="container" ></div>
                                <?php }?>

                                <?php if($this->session->userdata('provider')==$prov[1]->kode_provider){?>
                                <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[1]->kode_provider.'/'.$prov[1]->kode_jenis_jarkom.'/'.$prov[1]->brisat.'/'.$prov[1]->nickname_provider.'/';?>">
                                    <div id="container-<?php echo $prov[1]->nickname_provider;?>" class="container" ></div>
                                </a>
                                <?php }else{?>
                                    <div id="container-<?php echo $prov[1]->nickname_provider;?>" class="container" ></div>
                                <?php }?>

                                <?php if($this->session->userdata('provider')==$prov[2]->kode_provider){?>
                                <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[2]->kode_provider.'/'.$prov[2]->kode_jenis_jarkom.'/'.$prov[2]->brisat.'/'.$prov[2]->nickname_provider.'/';?>">
                                    <div id="container-<?php echo $prov[2]->nickname_provider;?>" class="container" ></div>
                                </a>
                                <?php }else{?>
                                    <div id="container-<?php echo $prov[2]->nickname_provider;?>" class="container" ></div>
                                <?php }?>

                                <?php if($this->session->userdata('provider')==$prov[3]->kode_provider){?>
                                <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[3]->kode_provider.'/'.$prov[3]->kode_jenis_jarkom.'/'.$prov[3]->brisat.'/'.$prov[3]->nickname_provider.'/';?>">
                                    <div id="container-<?php echo $prov[3]->nickname_provider;?>" class="container" ></div>
                                </a>
                                <?php }else{?>
                                    <div id="container-<?php echo $prov[3]->nickname_provider;?>" class="container" ></div>
                                <?php }?>

                                <?php if($this->session->userdata('provider')==$prov[4]->kode_provider){?>
                                <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[4]->kode_provider.'/'.$prov[4]->kode_jenis_jarkom.'/'.$prov[4]->brisat.'/'.$prov[4]->nickname_provider.'/';?>">
                                    <div id="container-<?php echo $prov[4]->nickname_provider;?>" class="container" ></div>
                                </a>
                                <?php }else{?>
                                    <div id="container-<?php echo $prov[4]->nickname_provider;?>" class="container" ></div>
                                <?php }?>

                            </div>
                        </div>
                <?php }else{?>
                        <div class="row"  style="margin-bottom: 10px">
                            <div class="outer">
                                <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[0]->kode_provider.'/'.$prov[0]->kode_jenis_jarkom.'/'.$prov[0]->brisat.'/'.$prov[0]->nickname_provider.'/';?>">
                                    <div id="container-<?php echo $prov[0]->nickname_provider;?>" class="container" ></div>
                                </a>
                                <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[1]->kode_provider.'/'.$prov[1]->kode_jenis_jarkom.'/'.$prov[1]->brisat.'/'.$prov[1]->nickname_provider.'/';?>">
                                    <div id="container-<?php echo $prov[1]->nickname_provider;?>" class="container" ></div>
                                </a>
                                <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[2]->kode_provider.'/'.$prov[2]->kode_jenis_jarkom.'/'.$prov[2]->brisat.'/'.$prov[2]->nickname_provider.'/';?>">
                                    <div id="container-<?php echo $prov[2]->nickname_provider;?>" class="container" ></div>
                                </a>
                                <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[3]->kode_provider.'/'.$prov[3]->kode_jenis_jarkom.'/'.$prov[3]->brisat.'/'.$prov[3]->nickname_provider.'/';?>">
                                    <div id="container-<?php echo $prov[3]->nickname_provider;?>" class="container" ></div>
                                </a>
                                <a href="<?php echo base_url().'index.php/Dashboard/new_list_provider/'.$prov[4]->kode_provider.'/'.$prov[4]->kode_jenis_jarkom.'/'.$prov[4]->brisat.'/'.$prov[4]->nickname_provider.'/';?>">
                                    <div id="container-<?php echo $prov[4]->nickname_provider;?>" class="container" ></div>
                                </a>
                            </div>
                        </div>
                <?php }?>
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

/*function refresh()
  {
      setTimeout(function(){
        window.location.reload(1);
         refresh();
      }, 5000);
  }

comment sementara*/
function refresh()
{
    setTimeout(function(){
        //alert('test');
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
                // [0.86, '#fd0707'], // merah
                // [0.88, '#ff4000'], // orange tua
                // [0.94, '#ff8000'], // orange
                // [0.96, '#ffbf00'], // kuning
                // [0.98, '#00ff55'], // hijau muda
                // [0.99, '#00b33c'] // hujau
                [0.60, '#fd0707'], // merah
                [0.85, '#fbfd07'], // kuning
                [0.90, '#11a51b'] // hujau
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
        url: "<?php echo site_url('Dash_Provider/RefJarkom_Jupiter'); ?>",
        dataType:'JSON',
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {
            //alert(data["prov"][0]['nickname_provider']); 
            for(var j = 0 ; j < data["prov"].length ;j++)
            {
                //alert(data["data"]["persen"][j]['prosentase'].toFixed(2) );
                var prosen = data["data_prov"][j]["prosentase"].toFixed(2);
                var total  = parseInt(data["data_prov"][j]['total']);
                var chartKanca = Highcharts.chart('container-'+data["prov"][j]["nickname_provider"], Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 80,
                        max: 100,
                        title: {
                            text: '<div style="text-align:center"><span style="font-size:14px;font-weight: bold;">'+data["prov"][j]["nickname_provider"]+'<br>('+total+')</span></div>'
                        }
                    },
                
                    credits: {
                        enabled: false
                    },
                    
                    series: [{
                        name: data["prov"][j]["nickname_provider"],
                        data: [parseFloat(prosen)],
                        dataLabels: {
                            format: '<div style="text-align:center"><span style="font-size:14px;color:' +
                                ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                                   '<span style="font-size:12px;color:silver"> % Online</span></div>',
                            y: 16
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
                // [0.86, '#fd0707'], // merah
                // [0.88, '#ff4000'], // orange tua
                // [0.94, '#ff8000'], // orange
                // [0.96, '#ffbf00'], // kuning
                // [0.98, '#00ff55'], // hijau muda
                // [0.99, '#00b33c'] // hujau
                [0.60, '#fd0707'], // merah
                [0.85, '#fbfd07'], // kuning
                [0.90, '#11a51b'] // hujau 
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

        <?php
                $total = 0;
                $warna = '';
            for($j=0;$j<count($prov);$j++){
                $total = $total + ($data_prov[$j]['on']+$data_prov[$j]['off']+$data_prov[$j]['nop']);
                ?>
                var chartKanca = Highcharts.chart('container-<?php echo $prov[$j]->nickname_provider;?>', Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 80,
                        max: 100,
                        title: {
                            text: '<div style="text-align:center;background-color:red"><span style="font-size:14px;font-weight: bold;"><?php echo $prov[$j]->nickname_provider."<br>(".($data_prov[$j]['total']).")";?></span></div>'
                        }
                    },
                
                    credits: {
                        enabled: false
                    },
                
                    series: [{
                        name: '<?php echo $prov[$j]->nickname_provider;?>',
                        data: [<?php echo number_format((float)$data_prov[$j]['prosentase'], 2, '.', '');?>],
                        dataLabels: {
                            format: '<div style="text-align:center"><span style="font-size:14px;color:' +
                                ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                                   '<span style="font-size:12px;color:silver"> % Online</span></div>',
                            y: 16
                        },
                        tooltip: {
                            valueSuffix: ' % Online'
                        }
                    }]
                
                }));
        <?php 
                $total = 0;
                $warna = '';
            }?>
            // $('#total-<?php //echo $jenis_jarkom[$j]->kode_jenis_jarkom;?>').text('<?php //echo number_format($total);?>');

}


// function initialize(){

//     var pinKanca = new Array();
//      $.ajax({
//         type: "POST",
//         url: "<?php //echo site_url('Dashboard/getKanwilLocations'); ?>",
//         dataType:'JSON',
//         //data: {"currdate" : currdate },
//         error:function()
//         {
//             alert("Error\nGagal retrieve data");
//         },
//         success: function(data)
//         {
//            //alert(data['data'].length);
//            //alert(data['data'][0]["latitude"]);
//            for(var j=0 ; j<data['data'].length ;j++)
//            {
//               pinKanca[j] = new google.maps.LatLng(data['data'][j]["latitude"],data['data'][j]["longitude"]);       
//            }
           
//            //pinKanca[0] = new google.maps.LatLng(1.4895452,124.8391881);
//            //alert(data['data'][0]["latitude"]+","+data['data'][0]["longitude"]);
//            //alert(data['data'].length);
//            //alert(myCenter[0]);
//            //alert(pinKanca.length);
//            var bounds = new google.maps.LatLngBounds();
//             var mapOptions = {
//                 mapTypeId: 'roadmap',
//                 center: {lat: 2.5489, lng: 118.0149},
//                 zoom: 8,
//             }; 
            
//           map = new google.maps.Map(document.getElementById("mapholder"), mapOptions);

//            for(var i=0; i<pinKanca.length ; i++)
//            { 
//                 var marker=new google.maps.Marker({ position:pinKanca[i] });
//                 marker.setMap(map);
//            }
//         }
//     });
//     //alert(myCenter.length);
//     //alert(pinKanca.length); 
//     //1.4898877,124.8406189
// }






</script>
