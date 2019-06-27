<style type="text/css">

/*.outer {
    width: 650px;
    height: 100px;
    margin-left: : 0 auto;
    background: transparent;
    align-content: center;
}  */
.container {
    width:180px;
  	height:155px;
  	display: inline-block; 
    margin-right:-25px;  
}
a {color : #777777;}
/*.highcharts-yaxis-grid .highcharts-grid-line {
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
 */
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
<script type="text/javascript">
    // $(document).ready(function() {
    //     initialize();
    // });
</script>
<script src="<?php echo base_url(); ?>code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>code/highcharts-more.js"></script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>

<section >
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb"  style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/Kanca/'.$kanwil[0]->kode_kanwil; ?>">Main Branch</a></li>
        <li class="active" style="color: #3C8DBC;">Remote Group</li>
      </ol>
    </div>
</section>
<section class="content" id="full" style="margin-top: -20px">   
    <div class="row">
        <div class="panel panel-default" style="float: left;width:55%;">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Dashboard All Remote (KC <?php echo $nama_kanca;?>)</div>
            <div class="panel-body">
                <div>
                    <a href="<?php echo base_url();?>index.php/Dashboard/new_list_kanca/<?php echo $kanca;?>"><button type="button" class="btn btn-primary btn-sm" style="width: 49%;">List Remote (<?php echo $nama_kanca;?>)</button></a>
                    <a href="<?php echo base_url();?>index.php/Dashboard/Provider/kanca/<?php echo $kanca;?>"><button type="button" class="btn btn-primary btn-sm" style="width: 49%;">List Provider (<?php echo $nama_kanca;?>)</button></a>    
                </div>
                <div>
                    <?php for ($i=0; $i < count($data['tipe_uker']); $i++)
                                  { 
                                    if($data['total'][$i]==0)
                                    {
                            ?>
                                <div id="container-<?php echo $data['tipe_uker'][$i];?>" class="container"></div>
                            <?php   }else{?>
                                <a href="<?php echo base_url();?>index.php/Dashboard/new_list_remote/<?php echo $kanca.'/'.$data['kode_tipe_uker'][$i];?>"><div id="container-<?php echo $data['tipe_uker'][$i];?>" class="container"></div></a>
                            <?php }
                                } ?>
                </div>
            </div>
        </div>                                                         
    
        <div class="panel panel-default" style="width:44%;float: right;"> 
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Remote Location</div> 
            <div class="panel-body">    
              <div id="map-canvas" style="width:100%; height:300px;" class="panel panel-default"></div><br />
              <div id="map-legend" style="width:100%;padding:5px;" class="panel panel-default"></div>
            </div>
        </div>
    </div>
</section>




<script type="text/javascript">
$('button').click(function(e){
    $('#full').toggleClass('fullscreen'); 
});

$(document).ready(function() {
    getJenisUker(); 
    //initialize();
    initGauge();
    refresh();
});

function refresh()
{
    setTimeout(function(){
       //window.location.reload(1);
       refreshGauge();
       //refresh();
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
                // [0.88, '#ff8000'], // orange tua
                // [0.94, '#ffbf00'], // orange
                // [0.96, '#ffff4d'], // kuning
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
        url: "<?php echo site_url('Dashboard/refreshRemote/'.$this->uri->segment(3)); ?>",
        dataType:'JSON',
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {
            //alert(data['all'][10]["latitude"]); 
            //console.log(data);     
            for(var j=0 ; j<data["data"]["tipe_uker"].length ;j++)
            {
                //alert(data["data"]["persen"][j]['prosentase'].toFixed(2) );//alert(data["data"]["persen"][j]['prosentase'].toFixed(2) );
                var warna='';
                var v_class='';
                if ((data['data']['persen'][j]['all_on']+data['data']['persen'][j]['off'])>0 && data['data']['persen'][j]['prosentase']<=80) {
                    warna = 'color:red';
                    v_class = 'class="blinking"';
                }
                var prosen = data["data"]["persen"][j]["prosentase"].toFixed(2);
                 var chartKanca = Highcharts.chart('container-'+data["data"]["tipe_uker"][j], Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 80,
                        max: 100,
                        title: {
                            text: '<div style="text-align:center"><span style="font-size:14px;font-weight: bold;'+warna+'">'+data["data"]["tipe_uker"][j]+'<br>('+(parseInt(data["data"]['total'][j]))+')</span></div>'
                        }
                    },
                
                    credits: {
                        enabled: false
                    },
                    
                    series: [{
                        name: 'MAIN BRANCH '+data["data"]["tipe_uker"][j],
                        data: [parseFloat(data["data"]["persen"][j]["prosentase"].toFixed(2))],
                        dataLabels: {
                            format: '<div style="text-align:center"><span '+v_class+' style="font-size:12px;color:' +
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
                // [0.80, '#fd0707'], // merah
                // [0.86, '#ff8000'], // orange tua
                // [0.88, '#ffbf00'], // orange
                // [0.94, '#ffff4d'], // kuning
                // [0.96, '#00ff55'], // hujau muda
                // [0.98, '#00b33c'] // hujau 
                [0.60, '#fd0707'], // merah
                [0.85, '#fbfd07'], // kuning
                [0.90, '#11a51b'] // hujau
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
                y: -70
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

        <?php for ($i=0; $i < count($data['tipe_uker']); $i++){
                $warna='';
                $class='';
                if (($data['persen'][$i]['all_on']+$data['persen'][$i]['off'])>0 && $data['persen'][$i]['prosentase']<80) {
                    $warna = 'color:red';
                    $class = 'class="blinking"';
                }?>
                var chartKanca = Highcharts.chart('container-<?php echo $data['tipe_uker'][$i];?>', Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 80,
                        max: 100,
                        title: {
                            text: '<div style="text-align:center"><span style="font-size:14px;font-weight: bold;<?php echo $warna;?>"><?php echo $data['tipe_uker'][$i]."<br><br>";?>(<?php echo $data['total'][$i];?>)</span></div>'
                        }
                    },
                
                    credits: {
                        enabled: false
                    },
                
                    series: [{
                        name: '<?php echo $data['tipe_uker'][$i];?>',
                        data: [<?php echo number_format((float)$data['persen'][$i]['prosentase'], 2, '.', '');?>],
                        dataLabels: {
                            format: '<div style="text-align:center"><span <?php echo $class;?> style="font-size:12px;color:' +
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


function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt){
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}

function initialize(){

    var pinKanca = new Array();
    var mark  = new Array();
    var titles = new Array();
	var anim   = new Array();
    var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
   
    var icons = {
      ico0_3: iconBase + 'i0-3.png' ,  ico0_1: iconBase + 'i0-1.png' , ico0_null: iconBase + 'i0-null.png' , ico0_nop: iconBase + 'i0-null.png' , ico0_0: iconBase + 'i0-null.png' ,
      ico1_3: iconBase + 'i1-3.png' ,  ico1_1: iconBase + 'i1-1.png' , ico1_null: iconBase + 'i1-null.png' , ico1_nop: iconBase + 'i1-null.png' , ico1_0: iconBase + 'i1-null.png' ,
      ico2_3: iconBase + 'i2-3.png' ,  ico2_1: iconBase + 'i2-1.png' , ico2_null: iconBase + 'i2-null.png' , ico2_nop: iconBase + 'i2-null.png' , ico2_0: iconBase + 'i2-null.png' ,
      ico3_3: iconBase + 'i3-3.png' ,  ico3_1: iconBase + 'i3-1.png' , ico3_null: iconBase + 'i3-null.png' , ico3_nop: iconBase + 'i3-null.png' , ico3_0: iconBase + 'i3-null.png' ,
      ico4_3: iconBase + 'i4-3.png' ,  ico4_1: iconBase + 'i4-1.png' , ico4_null: iconBase + 'i4-null.png' , ico4_nop: iconBase + 'i4-null.png' , ico4_0: iconBase + 'i4-null.png' ,
      ico5_3: iconBase + 'i5-3.png' ,  ico5_1: iconBase + 'i5-1.png' , ico5_null: iconBase + 'i5-null.png' , ico5_nop: iconBase + 'i5-null.png' , ico6_0: iconBase + 'i5-null.png' ,
      ico6_3: iconBase + 'i6-3.png' ,  ico6_1: iconBase + 'i6-1.png' , ico6_null: iconBase + 'i6-null.png' , ico6_nop: iconBase + 'i6-null.png' , ico6_0: iconBase + 'i6-null.png' ,
      ico7_3: iconBase + 'i7-3.png' ,  ico7_1: iconBase + 'i7-1.png', ico7_null: iconBase + 'i7-null.png' , ico7_nop: iconBase + 'i7-null.png' , ico7_0: iconBase + 'i7-null.png' ,
      ico8_3: iconBase + 'i8-3.png' ,  ico8_1: iconBase + 'i8-1.png', ico8_null: iconBase + 'i8-null.png' , ico8_nop: iconBase + 'i8-null.png' , ico8_0: iconBase + 'i8-null.png' ,
      ico9_3: iconBase + 'i9-3.png' ,  ico9_1: iconBase + 'i9-1.png', ico9_null: iconBase + 'i9-null.png' , ico9_nop: iconBase + 'i9-null.png' , ico9_0: iconBase + 'i9-null.png' ,
      ico10_3: iconBase + 'i10-3.png' , ico10_1: iconBase + 'i10-1.png', ico10_null: iconBase + 'i10-null.png' , ico10_nop: iconBase + 'i10-null.png' , ico10_0: iconBase + 'i10-null.png' ,
      ico11_3: iconBase + 'i11-3.png' , ico11_1: iconBase + 'i11-1.png', ico11_null: iconBase + 'i11-null.png' , ico11_nop: iconBase + 'i11-null.png' , ico11_0: iconBase + 'i11-null.png' ,
      ico12_3: iconBase + 'i12-3.png' , ico12_1: iconBase + 'i12-1.png', ico12_null: iconBase + 'i12-null.png' , ico12_nop: iconBase + 'i12-null.png' , ico12_0: iconBase + 'i12-null.png' ,
	  ico13_3: iconBase + 'i13-3.png' , ico13_1: iconBase + 'i13-1.png', ico13_null: iconBase + 'i13-null.png' , ico13_nop: iconBase + 'i13-null.png' , ico13_0: iconBase + 'i13-null.png'
      };

     $.ajax({
        type: "POST",
        url: "<?php echo site_url('Dashboard/getUkerLocations/'.$kanca); ?>",
        dataType:'JSON',
        //data: {"currdate" : currdate },
        error:function()
        {
            alert("Error\nGagal retrieve data");
        },
        success: function(data)
        {
           //alert(data['data'].length);
           //alert(data['data'][0]["latitude"]+'-'+data['data'][0]["longitude"]);
           for(var j=0 ; j<data['data'].length ;j++)
           {
              pinKanca[j] = new google.maps.LatLng(data['data'][j]["latitude"],data['data'][j]["longitude"]); 
              //mark[j] = icons['ico'+data['data'][j]["kode_tipe_uker"]+'_'+data['data'][j]["status"]]; 
			  if(data['data'][j]["kode_tipe_uker"]==6 && data['data'][j]["status"]==1) // jika teras offline, maka ditampilkan nop
			  {
				mark[j] = icons['ico'+data['data'][j]["kode_tipe_uker"]+'_nop'];	
			  }
			  else
			  {
				mark[j] = icons['ico'+data['data'][j]["kode_tipe_uker"]+'_'+data['data'][j]["status"]];
			  }
              //titles[j] = "<h4>"+data['data'][j]["nama_remote"]+"</h4><h5>IP : "+data['data'][j]["ip"]+"</h5>";   
			  titles[j] = "<div><span style='font-weight:bold;font-size:12pt;'>"+toTitleCase(data['data'][j]["nama_remote"])+"</span></div>"+
			  "<br /><div><span style='font-size:10pt;'>Remote Type : "+data['data'][j]["tipe_uker"]+"</span><br />"+
			  "<span style='font-size:10pt;'>IP Address : "+data['data'][j]["ip"]+"</span><br />"+
			  "</div>";			  
			  if(data['data'][j]["status"]==1 && data['data'][j]["kode_tipe_uker"]!=6)
			  {
				  anim[j] = google.maps.Animation.BOUNCE;
			  }
           }
           
           //pinKanca[0] = new google.maps.LatLng(1.4895452,124.8391881);
           //alert(data['data'][0]["latitude"]+","+data['data'][0]["longitude"]);
           //alert(data['data'].length);
           //alert(myCenter[0]);
           //alert(pinKanca.length);
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: 'roadmap',
                center:  new google.maps.LatLng(data['center'][0]["latitude"], data['center'][0]["longitude"]),
                zoom: 8,
            }; 
            
            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

            var infowindow = new google.maps.InfoWindow();

           for(var i=0; i<pinKanca.length ; i++)
           { 
                // var infowindow = new google.maps.InfoWindow({
                //     content: titles[i]
                // });

                var marker=new google.maps.Marker({ position:pinKanca[i], icon:mark[i], animation: anim[i]});

                // marker.addListener('click', function() {
                //     infowindow.open(map, marker);
                // });

                // Membuat event click dan menambah infowindows
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                      infowindow.setContent(titles[i]);
                      infowindow.open(map, marker);
                    }
                })(marker, i));
                

                marker.setMap(map);
           }
        }
    });
    //alert(myCenter.length);
    //alert(pinKanca.length); 
    //1.4898877,124.8406189
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
            var legend = "";
            //$('#sel_kanwil')[0].sumo.add('all','All');
            for(var j=0 ; j<data['jenisuker'].length ;j++)
            {
                 legend += "<span style='padding-left:10px;display:inline-block;width:220px;padding:5px;'><img height='25px' src='"+iconBase+"i"+data['jenisuker'][j]['kode_tipe_uker']+"-3.png"+"' />&nbsp;"+data['jenisuker'][j]['tipe_uker']+"</span>";
            }
            
            $("#map-legend").html(legend);
            
            //alert(legend);
        } 
    });
}

</script>
<style>
#map-canvas {
    height: 600px;
    width: 550px;
    margin: 0px;
    padding: 0px
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>
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
</script>
<!-- <div id="map-canvas"></div> -->
