<style type="text/css">
.outer {
    width: 1250px;
    height: 100px;
    margin-left: : 0 auto;
    background: transparent;
    align-content: center;
}
.container {
    width: 180px;
    float: left;
    height: 160px;
    background: transparent;
    margin-right: -30px
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
        initialize();
    });
</script>
<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>

<!-- <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script> -->

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>

<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <?php $kode_kanwil = $this->uri->segment(3);?>
    <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
    <li class="active">Main Branch</li>
  </ol>
</section><br>
<section class="content" id="full" style="background: white; margin-top: -20px">   
    <div class="row">
        <div style="position: relative;">
            <div class="box box-widget widget-user-2" style="width: 1250px;height: 670px;">
                <div class="widget-user-header bg-green" style="height: 30px">
                 <!--  <div class="box-tools pull-left">
                    <button class="btn btn-primary"><i class="fa fa-external-link"></i></button>
                  </div> -->
                  <h2 align="center" style="margin-top: -15px">DASHBOARD ALL MAIN BRANCH - REGION <?php echo strtoupper($nama_kanwil);?></h2>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="margin-top: -45px">
                    <div id="content" style="top:50px;position:relative;margin-left: 0px;">        
                        <div style="width:65%;height:90%;position:relative;float:left">
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url();?>index.php/Dashboard/data_uker_kanwil/<?php echo $kanwil;?>"><button type="button" class="btn btn-block btn-primary btn-sm" style="width: 250px">
                                                LIST DATA UKER (<?php echo $nama_kanwil;?>)
                                            </button></a>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <a href="<?php echo base_url();?>index.php/Dashboard/Provider/kanwil/<?php echo $kanwil;?>"><button type="button" class="btn btn-block btn-primary btn-sm" style="width: 300px">
                                                LIST DATA PROVIDER (<?php echo $nama_kanwil;?>)
                                            </button></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <div></div>
                            </div>
                            <div class="outer">
                            <?php //echo count($data['kode_kanca']);
                            //var_dump($data['nama_kanca']); 
                            for($i=0;$i<count($data['kode_kanca']);$i++){?>
                                <a href="<?php echo base_url();?>index.php/Dashboard/remote/<?php echo $data['kode_kanca'][$i];?>"><div id="container-<?php echo $data['nama_kanca'][$i];?>" class="container"></div></a>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="position:relative;margin-top: 250px;height: 700px">       
            <div class="box box-widget widget-user-2"  style="width: 1250px;height: 100%;display: none">
                <div class="widget-user-header bg-green" style="height: 30px">
                  <!-- <div class="box-tools pull-left">
                    <button class="btn btn-primary"><i class="fa fa-external-link"></i></button>
                  </div> -->
                  <h2 align="center"  style="margin-top: -15px">REMOTE LOCATION</h2>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="margin-top: -45px">
                    <div style="top:50px;position:relative;margin-left: -10px;">        
                        <!-- <div id="map-canvas"></div> -->
                    </div>
                </div>
            </div>

            <div class="col-md-8" style="width:100%;">
                <div class="panel panel-default">
                    <div class="panel-heading">Peta Sebaran Unit Kerja BRI</div>
                        <div class="panel-body">
                            <div style="width: 100%; " class="panel panel-default">
                                <table width="100%">
                                    <tr style="display: none;">
                                        <td width="100px">Kanwil</td>
                                        <td width="20px">:</td>
                                        <td >
                                          <select id="sel_kanwil" class="sumoselect" multiple="multiple" onchange="javascript:getKanca();">
                                          </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kanca</td>
                                        <td>:</td>
                                        <td>
                                          <select id="sel_kanca" class="sumoselect" multiple="multiple">
                                          </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Uker</td>
                                        <td>:</td>
                                        <td>
                                          <select id="sel_jenisuker" class="sumoselect" multiple="multiple" >
                                          </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Provider</td>
                                        <td>:</td>
                                        <td>
                                          <select id="sel_provider" class="sumoselect" multiple="multiple" >
                                              <option values="all">-- ALL --</option>
                                          </select>
                                        </td>
                                    </tr>
                                             
                                </table>
                                <span>
                                    <input type="button" id="btn_view" value="view" onclick="javascript:view();" />
                                </span> &nbsp;
                                <span id="wait" style="display:none;float:right">
                                    <img src='<?php echo base_url()."assets/img/ajax-loader.gif"; ?>' />
                                </span>
                                                          
                            </div>
                            
                            <div id="map-canvas" style="width: 100%; height: 600px;" class="panel panel-default"></div>
                            
                            <div id="map-legend" style="width: 100%;padding:5px;" class="panel panel-default"></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>




<script type="text/javascript">
$(document).ready(function() {
           
  initGauge();
  //initialize();
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
        url: "<?php echo site_url('Dashboard/refreshKanca/'.$this->uri->segment(3)); ?>",
        dataType:'JSON',
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {
            //alert(data['all'][10]["latitude"]); 
            //console.log(data);     
            for(var j=0 ; j<data["data"]["kode_kanca"].length ;j++)
            {
                //alert(data["data"]["persen"][j]['prosentase'].toFixed(2) );
                var prosen = data["data"]["persen"][j]["prosentase"].toFixed(2);
                 var chartKanca = Highcharts.chart('container-'+data["data"]["nama_kanca"][j], Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 0,
                        max: 100,
                        title: {
                            text: '<div style="text-align:center"><span style="font-size:10px;font-weight: bold;">'+data["data"]["nama_kanca"][j]+'<br>('+(parseInt(data["data"]['persen'][j]['all']))+')</span></div>'
                        }
                    },
                
                    credits: {
                        enabled: false
                    },
                    
                    series: [{
                        name: 'MAIN BRANCH '+data["data"]["nama_kanca"][j],
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
                [0.80, '#fd0707'], // merah
                [0.86, '#ff8000'], // orange tua
                [0.88, '#ffbf00'], // orange
                [0.94, '#ffff4d'], // kuning
                [0.96, '#00ff55'], // hujau muda
                [0.98, '#00b33c'] // hujau 
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
                y: -50
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

        <?php for($i=0;$i<count($data['kode_kanca']);$i++){?>
                var chartKanca = Highcharts.chart('container-<?php echo $data['nama_kanca'][$i];?>', Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 0,
                        max: 100,
                        title: {
                            text: '<div style="text-align:center"><span style="font-size:10px;font-weight: bold;"><?php echo strtoupper($data['nama_kanca'][$i])."<br>";?>(<?php echo ($data['persen'][$i]['all']);?>)</span></div>'
                        }
                    },
                
                    credits: {
                        enabled: false
                    },
                
                    series: [{
                        name: 'KC <?php echo $data['nama_kanca'][$i];?>',
                        data: [<?php echo number_format((float)$data['persen'][$i]['prosentase'], 2, '.', '');?>],
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


// function initialize(){

//     var pinKanca = new Array();
//      $.ajax({
//         type: "POST",
//         url: "<?php //echo site_url('Dashboard/getKancaLocations/'.$kanwil); ?>",
//         dataType:'JSON',
//         //data: {"currdate" : currdate },
//         error:function()
//         {
//             alert("Error\nGagal retrieve data");
//         },
//         success: function(data)
//         {
//            //alert(data['data'].length);
//            //alert(data['data'][0]["latitude"]+'-'+data['data'][0]["longitude"]);
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
//                 center:  new google.maps.LatLng(data['data'][0]["latitude"], data['data'][0]["longitude"]),
//                 zoom: 8,
//             }; 
            
//           map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

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
<!-- <style>
#map-canvas {
    height: 600px;
    width: 1250px;
    margin: 0px;
    padding: 0px
}
</style> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>
<script>
var map;
function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(-34.397, 150.644)
  };
  map = new google.maps.Map(document.getElementById('map'),
      mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script> -->
<!-- <div id="map-canvas"></div> -->

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>
    
<script>
$(document).ready(function()
{
    $("#wait").hide();
    $(".sumoselect").SumoSelect({ okCancelInMulti: true });    
    $(document).ajaxStart(function(){
        //$("#wait").css("display", "block");
         $("#wait").show();
    });
    $(document).ajaxComplete(function(){
        //$("#wait").css("display", "none");
        $("#wait").hide();
    });
    initialize();
    //getAllUker();
    //getKanwil();
    <?php
        $kode_kanwil = $this->uri->segment(3);
    ?>
    getKanca('<?php echo $kode_kanwil;?>');
    getJenisUker();
    getProvider();
    
});

function view()
{
   //alert($("#sel_kanca").val()); 
    var loc   = new Array(); 
    var mark  = new Array();
    var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
   
    var icons = {
      ico0_3: iconBase + 'i0-3.png' ,  ico0_1: iconBase + 'i0-1.png' ,
      ico1_3: iconBase + 'i1-3.png' ,  ico1_1: iconBase + 'i1-1.png' ,
      ico2_3: iconBase + 'i2-3.png' ,  ico2_1: iconBase + 'i2-1.png' ,
      ico3_3: iconBase + 'i3-3.png' ,  ico3_1: iconBase + 'i3-1.png' ,
      ico4_3: iconBase + 'i4-3.png' ,  ico4_1: iconBase + 'i4-1.png' ,
      ico5_3: iconBase + 'i5-3.png' ,  ico5_1: iconBase + 'i5-1.png' ,
      ico6_3: iconBase + 'i6-3.png' ,  ico6_1: iconBase + 'i6-1.png' ,
      ico7_3: iconBase + 'i7-3.png' ,  ico7_1: iconBase + 'i7-1.png', 
      ico8_3: iconBase + 'i8-3.png' ,  ico8_1: iconBase + 'i8-1.png',
      ico9_3: iconBase + 'i9-3.png' ,  ico9_1: iconBase + 'i9-1.png',
      ico10_3: iconBase + 'i10-3.png' , ico10_1: iconBase + 'i10-1.png',
      ico11_3: iconBase + 'i11-3.png' , ico11_1: iconBase + 'i11-1.png',
      ico12_3: iconBase + 'i12-3.png' , ico12_1: iconBase + 'i12-1.png'      
      };
      
   $.ajax({
        type: "POST",
        url: "<?php echo site_url('Maps/viewLocation'); ?>",
        dataType:'JSON',
        data:"kw="+"<?php echo $kode_kanwil;?>"+"&kc="+$("#sel_kanca").val()+"&jns="+$("#sel_jenisuker").val()+"&prv="+$("#sel_provider").val(),
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {       
            for(var j=0 ; j<data['filter'].length ;j++)
            {
              loc[j]  = new google.maps.LatLng(data['filter'][j]["latitude"],data['filter'][j]["longitude"]); 
              mark[j] = icons['ico'+data['filter'][j]["kode_tipe_uker"]+'_'+data['filter'][j]["status"]];
            }         
              
            var bounds = new google.maps.LatLngBounds();
             
            var mapOptions = {
                   mapTypeId: 'roadmap',
                   center: {lat: <?php echo $center_loc[0]->latitude?>, lng: <?php echo $center_loc[0]->longitude?>},
                   zoom: 8
            }; 
                         
             map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);      
                                                                               
                                                                                           
             for(var i=0; i<loc.length ; i++)
             { 
                  var markers  = new google.maps.Marker({ position:loc[i], icon:mark[i], map:map });
             }                                             
        }
    });
}

function getProvider()
{

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Maps/getListProvider'); ?>",
        dataType:'JSON',
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {       
            var opt = "";
            //$('#sel_kanwil')[0].sumo.add('all','All');
            for(var j=0 ; j<data['provider'].length ;j++)
            {
                 opt +=  "<option value='"+data['provider'][j]['kode_provider']+"' >"+data['provider'][j]['nickname_provider']+"</option>";
                 //$('#sel_kanwil')[0].sumo.add(data['kanwil'][j]['kode_kanwil'],data['kanwil'][j]['nama_kanwil']);
            }
            
            $("#sel_provider").html(opt);
            
            $("#sel_provider")[0].sumo.reload();
        } 
    });
}

function getJenisUker()
{
    var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Maps/getListJenisUker'); ?>",
        dataType:'JSON',
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {       
            var opt = "";
            var legend = "";
            //$('#sel_kanwil')[0].sumo.add('all','All');
            for(var j=0 ; j<data['jenisuker'].length ;j++)
            {
                 opt +=  "<option value='"+data['jenisuker'][j]['kode_tipe_uker']+"' >"+data['jenisuker'][j]['tipe_uker']+"</option>";
                 
                 legend += "<span style='padding-left:10px;display:inline-block;width:220px;padding:5px;'><img height='25px' src='"+iconBase+"i"+data['jenisuker'][j]['kode_tipe_uker']+"-3.png"+"' />&nbsp;"+data['jenisuker'][j]['tipe_uker']+"</span>";
            }
            
            
            $("#sel_jenisuker").html(opt);
            
            $("#sel_jenisuker")[0].sumo.reload();
            
            $("#map-legend").html(legend);
            
            //alert(legend);
        } 
    });
}

function getKanca(kanwil)
{
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Maps/getListKanca'); ?>",
        data: "kanwil="+kanwil,
        dataType:'JSON',
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {       
            var opt = "";
            //$('#sel_kanwil')[0].sumo.add('all','All');
            for(var j=0 ; j<data['kanca'].length ;j++)
            {
                 opt +=  "<option value='"+data['kanca'][j]['kode_kanca']+"' >"+data['kanca'][j]['nama_kanca']+"</option>";
                 //$('#sel_kanwil')[0].sumo.add(data['kanwil'][j]['kode_kanwil'],data['kanwil'][j]['nama_kanwil']);
            }
            
            $("#sel_kanca").html(opt);
            
            $("#sel_kanca")[0].sumo.reload();
        } 
    });
}

function getKanwil()
{                                     
   $.ajax({
        type: "POST",
        url: "<?php echo site_url('Maps/getListKanwil'); ?>",
        dataType:'JSON',
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {       
            var opt = "";
            //$('#sel_kanwil')[0].sumo.add('all','All');
            for(var j=0 ; j<data['kanwil'].length ;j++)
            {
                 opt +=  "<option value='"+data['kanwil'][j]['kode_kanwil']+"' >"+data['kanwil'][j]['nama_kanwil']+"</option>";
                 //$('#sel_kanwil')[0].sumo.add(data['kanwil'][j]['kode_kanwil'],data['kanwil'][j]['nama_kanwil']);
            }
            
            $("#sel_kanwil").html(opt);
            
            $("#sel_kanwil")[0].sumo.reload();
        } 
    });
}

function initialize()
{
   // alert('<?php //echo $center_loc[0]->latitude?>');
  myCenter = Array();
  //myCenter[0] = new google.maps.LatLng(-8.35000000,116.60000000);
  //myCenter[1] = new google.maps.LatLng(-8.66636810,115.23813590);
  
  var bounds = new google.maps.LatLngBounds();
  
  var mapOptions = {
    mapTypeId: 'roadmap',
    center: {lat: <?php echo $center_loc[0]->latitude?>, lng: <?php echo $center_loc[0]->longitude?>},
    zoom: 8
  };
  
  // Display a map on the page
  map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
  
  for(var i=0; i<myCenter.length ; i++)
  { 
        var marker=new google.maps.Marker({ position:myCenter[i] });
        marker.setMap(map);
  } 
    
}

function getAllUker()
{
    //alert("aaa");
    var loc   = new Array(); 
    var mark  = new Array(); 
    //var icons = new Array();
    
   var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
   
    var icons = {
      ico0_3: iconBase + 'i0-3.png' ,  ico0_1: iconBase + 'i0-1.png' ,
      ico1_3: iconBase + 'i1-3.png' ,  ico1_1: iconBase + 'i1-1.png' ,
      ico2_3: iconBase + 'i2-3.png' ,  ico2_1: iconBase + 'i2-1.png' ,
      ico3_3: iconBase + 'i3-3.png' ,  ico3_1: iconBase + 'i3-1.png' ,
      ico4_3: iconBase + 'i4-3.png' ,  ico4_1: iconBase + 'i4-1.png' ,
      ico5_3: iconBase + 'i5-3.png' ,  ico5_1: iconBase + 'i5-1.png' ,
      ico6_3: iconBase + 'i6-3.png' ,  ico6_1: iconBase + 'i6-1.png' ,
      ico7_3: iconBase + 'i7-3.png' ,  ico7_1: iconBase + 'i7-1.png', 
      ico8_3: iconBase + 'i8-3.png' ,  ico8_1: iconBase + 'i8-1.png',
      ico9_3: iconBase + 'i9-3.png' ,  ico9_1: iconBase + 'i9-1.png',
      ico10_3: iconBase + 'i10-3.png' , ico10_1: iconBase + 'i10-1.png',
      ico11_3: iconBase + 'i11-3.png' , ico11_1: iconBase + 'i11-1.png',
      ico12_3: iconBase + 'i12-3.png' , ico12_1: iconBase + 'i12-1.png'      
      }
    //alert(icons['kanwil_on']['icon']);                                                   
     
    
     $.ajax({
        type: "POST",
        url: "<?php echo site_url('Maps/All_Uker'); ?>",
        dataType:'JSON',
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {
            //alert(data['all'][10]["latitude"]);
            for(var j=0 ; j<data['all'].length ;j++)
            {
              loc[j]  = new google.maps.LatLng(data['all'][j]["latitude"],data['all'][j]["longitude"]); 
              mark[j] = icons['ico'+data['all'][j]["kode_tipe_uker"]+'_'+data['all'][j]["status"]];
            }         
              
            var bounds = new google.maps.LatLngBounds();
             
            var mapOptions = {
                   mapTypeId: 'roadmap',
                   center: {lat: -2.600029, lng: 118.015776},
                   zoom: 5
            }; 
                         
             map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);      
                                                                               
                                                                                           
             for(var i=0; i<loc.length ; i++)
             { 
                  var markers  = new google.maps.Marker({ position:loc[i], icon:mark[i], map:map });
             }
        }
    }); 
}
</script>
<style>
    td 
    {
        padding:3px;    
    }
</style>
