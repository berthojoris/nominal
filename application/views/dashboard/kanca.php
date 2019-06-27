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

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/leaflet/leaflet.css" />
<script src="<?php echo base_url(); ?>assets/plugins/leaflet/leaflet.js" ></script>

<script src="<?php echo base_url(); ?>code/modules/solid-gauge.js"></script>

<section>
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>">Region</a></li>
        <li class="active" style="color: #3C8DBC;">Main Branch</li>
      </ol>
    </div>
</section>
<section class="content" id="full" style="margin-top: -20px">   
    <div class="row">
        <div class="panel panel-default" style="width:100%;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Dashboard All Main Branch - Region <?php echo $nama_kanwil;?></div>
                <div class="panel-body">
                    <?php if(in_array( $this->session->userdata('role'), array(1,2,3,5))){?>
                    <div>
                        <?php for($i=0;$i<count($data['kode_kanca']);$i++){?>
                            <a href="<?php echo base_url();?>index.php/Dashboard/remote/<?php echo $data['kode_kanca'][$i];?>"><div id="container-<?php echo $data['kode_kanca'][$i];?>" class="container"></div></a>
                        <?php } ?>
                    </div>
                    <?php }else if($this->session->userdata('role')==6){
                            if ($this->session->userdata('kanwil')==$this->uri->segment(3)){?>
                            <div>
                                <?php for($i=0;$i<count($data['kode_kanca']);$i++){?>
                                    <a href="<?php echo base_url();?>index.php/Dashboard/remote/<?php echo $data['kode_kanca'][$i];?>"><div id="container-<?php echo $data['kode_kanca'][$i];?>" class="container"></div></a>
                                <?php } ?>
                            </div>
                        <?php }
                         }else if($this->session->userdata('role')==7){
                            if ($this->session->userdata('kanwil')==$this->uri->segment(3)){?>
                            <div>
                                <?php for($i=0;$i<count($data['kode_kanca']);$i++){
                                        if($this->session->userdata('kanca')==$data['kode_kanca'][$i]){?>
                                            <a href="<?php echo base_url();?>index.php/Dashboard/remote/<?php echo $data['kode_kanca'][$i];?>"><div id="container-<?php echo $data['kode_kanca'][$i];?>" class="container"></div></a>
                                <?php   }else{?>
                                            <div id="container-<?php echo $data['kode_kanca'][$i];?>" class="container"></div>
                                <?php   }
                                      } ?>
                            </div>
                        <?php }?>
                <?php    }else{ redirect('Dashboard');}?>
                </div>
            </div>
    </div>
    <div class="row">
        <?php if(in_array( $this->session->userdata('role'), array(1,2,3,5,6))){?>
        <a href="<?php echo base_url();?>index.php/Dashboard/new_list_kanwil/<?php echo $kanwil;?>"><button type="button" class="btn btn-primary btn-sm" style="width: 250px">List Remote (<?php echo $nama_kanwil;?>)</button></a>&nbsp;
        <a href="<?php echo base_url();?>index.php/Dashboard/Provider/kanwil/<?php echo $kanwil;?>"><button type="button" class="btn btn-primary btn-sm" style="width: 300px">List Provider (<?php echo $nama_kanwil;?>)</button></a>
        <?php }?>
    </div>
    <br>
    <div class="row">
        <div class="panel panel-default" style="width:100%;"> 
            <div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Remote Location</div>
                <div class="panel-body">
                     <div style="width: 100%; " class="panel panel-default">
                          <table width="100%" margin="5px;">
                              <tr style="display: none;">
                                  <td width="100px">Region</td>
                                  <td width="20px">:</td>
                                  <td >
                                    <select id="sel_kanwil" class="sumoselect" multiple="multiple" onchange="javascript:getKanca();">
                                    </select>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Main Branch</td>
                                  <td>:</td>
                                  <td>
                                    <select id="sel_kanca" class="sumoselect" multiple="multiple">
                                    </select>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Remote Type</td>
                                  <td>:</td>
                                  <td>
                                    <select id="sel_jenisuker" class="sumoselect" multiple="multiple" >
                                    </select>
                                  </td>
                              </tr>
							  <!--
                              <tr>
                                  <td>Provider</td>
                                  <td>:</td>
                                  <td>
                                    <select id="sel_provider" class="sumoselect" multiple="multiple" >
                                        <option values="all">-- ALL --</option>
                                    </select>
                                  </td>
                              </tr>
							  -->
                              <tr>
                                <td><input type="button" id="btn_view" value="view" onclick="javascript:view();" /></td>
                                <td>&nbsp;</td>
                                <td><img id="wait" src='<?php echo base_url()."assets/img/ajax-loader.gif"; ?>' /></td>
                              </tr>         
                          </table>                
                      </div>
                            
                      <div id="map-canvas" style="width: 100%; height: 600px;" class="panel panel-default"></div>
                      
                      <div id="map-legend" style="width: 100%;padding:5px;" class="panel panel-default"></div>
                </div>
            </div>
        </div>
    </div>
</section>




<script type="text/javascript">
$(document).ready(function() {
	$("#wait").hide();
    $(".sumoselect").SumoSelect({ okCancelInMulti: true });    

	<?php
        $kode_kanwil = $this->uri->segment(3);
    ?>
    getKanca('<?php echo $kode_kanwil;?>');
    getJenisUker();
    //getProvider();
	initialize();
	initGauge();
	refresh();
	//getLocationInduk(449);
	//alert(getLocationInduk(449));
});

function refresh()
{
    setTimeout(function(){
       //window.location.reload(1);
       initGauge();
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
                var warna='';
                var v_class='';
                if ((data['data']['persen'][j]['all_on']+data['data']['persen'][j]['off'])>0 && data['data']['persen'][j]['prosentase']<=80) {
                    warna = 'color:red';
                    v_class = 'class="blinking"';
                }
                var prosen = data["data"]["persen"][j]["prosentase"].toFixed(2);
                 var chartKanca = Highcharts.chart('container-'+data["data"]["kode_kanca"][j], Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 80,
                        max: 100,
                        title: {
                            text: '<div style="text-align:center"><span style="font-size:10px;font-weight: bold;'+warna+'">'+data["data"]["nama_kanca"][j]+'<br>('+(parseInt(data["data"]['persen'][j]['all']))+')</span></div>'
                        }
                    },
                
                    credits: {
                        enabled: false
                    },
                    
                    series: [{
                        name: 'MAIN BRANCH '+data["data"]["kode_kanca"][j],
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

        <?php for($i=0;$i<count($data['kode_kanca']);$i++){
                $warna='';
                $class='';
                 if (($data['persen'][$i]['all_on']+$data['persen'][$i]['off'])>0 && $data['persen'][$i]['prosentase']<80) {
                    $warna = 'color:red';
                    $class = 'class="blinking"';
                }?>
                var chartKanca = Highcharts.chart('container-<?php echo $data['kode_kanca'][$i];?>', Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 80,
                        max: 100,
                        title: {
                            text: '<div style="text-align:center"><span style="font-size:10px;font-weight: bold;<?php echo $warna;?>"><?php echo strtoupper($data['nama_kanca'][$i])."<br>";?>(<?php echo ($data['persen'][$i]['all']);?>)</span></div>'
                        }
                    },
                
                    credits: {
                        enabled: false
                    },
                
                    series: [{
                        name: 'KC <?php echo $data['kode_kanca'][$i];?>',
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

function view()
{
	var lat    = new Array(); 
    var lng    = new Array(); 
    var mark   = new Array();
	var uker   = new Array();
	var titles = new Array();
	var anim   = new Array();
	var idremote = new Array();
    var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
	
	var LeafIcon = L.Icon.extend({
		options: {
			//shadowUrl: 'leaf-shadow.png',
			iconSize:     [20, 31],
			//shadowSize:   [50, 64],
			iconAnchor:   [10, 31]
			//shadowAnchor: [4, 62],
			//popupAnchor:  [-3, -76]
		}
	});
	
	var ico0_3 = new LeafIcon({iconUrl: iconBase + 'i0-3.png'}), ico0_1 = new LeafIcon({iconUrl: iconBase + 'i0-1.png'}), ico0_ = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_null = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_nop = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_0 = new LeafIcon({iconUrl: iconBase + 'i0-null.png'}), ico0_10 = new LeafIcon({iconUrl: iconBase + 'i0-null.png'});
    var ico1_3 = new LeafIcon({iconUrl: iconBase + 'i1-3.png'}), ico1_1 = new LeafIcon({iconUrl: iconBase + 'i1-1.png'}), ico1_ = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_null = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_nop = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_0 = new LeafIcon({iconUrl: iconBase + 'i1-null.png'}), ico1_10 = new LeafIcon({iconUrl: iconBase + 'i1-null.png'});
    var ico2_3 = new LeafIcon({iconUrl: iconBase + 'i2-3.png'}), ico2_1 = new LeafIcon({iconUrl: iconBase + 'i2-1.png'}), ico2_ = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_null = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_nop = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_0 = new LeafIcon({iconUrl: iconBase + 'i2-null.png'}), ico2_10 = new LeafIcon({iconUrl: iconBase + 'i2-null.png'});
    var ico3_3 = new LeafIcon({iconUrl: iconBase + 'i3-3.png'}), ico3_1 = new LeafIcon({iconUrl: iconBase + 'i3-1.png'}), ico3_ = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_null = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_nop = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_0 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'}), ico3_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico4_3 = new LeafIcon({iconUrl: iconBase + 'i4-3.png'}), ico4_1 = new LeafIcon({iconUrl: iconBase + 'i4-1.png'}), ico4_ = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_null = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_nop = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_0 = new LeafIcon({iconUrl: iconBase + 'i4-null.png'}), ico4_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico5_3 = new LeafIcon({iconUrl: iconBase + 'i5-3.png'}), ico5_1 = new LeafIcon({iconUrl: iconBase + 'i5-1.png'}), ico5_ = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_null = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_nop = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_0 = new LeafIcon({iconUrl: iconBase + 'i5-null.png'}), ico5_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico6_3 = new LeafIcon({iconUrl: iconBase + 'i6-3.png'}), ico6_1 = new LeafIcon({iconUrl: iconBase + 'i6-1.png'}), ico6_ = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_null = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_nop = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_0 = new LeafIcon({iconUrl: iconBase + 'i6-null.png'}), ico6_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico7_3 = new LeafIcon({iconUrl: iconBase + 'i7-3.png'}), ico7_1 = new LeafIcon({iconUrl: iconBase + 'i7-1.png'}), ico7_ = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_null = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_nop = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_0 = new LeafIcon({iconUrl: iconBase + 'i7-null.png'}), ico7_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico8_3 = new LeafIcon({iconUrl: iconBase + 'i8-3.png'}), ico8_1 = new LeafIcon({iconUrl: iconBase + 'i8-1.png'}), ico8_ = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_null = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_nop = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_0 = new LeafIcon({iconUrl: iconBase + 'i8-null.png'}), ico8_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico9_3 = new LeafIcon({iconUrl: iconBase + 'i9-3.png'}), ico9_1 = new LeafIcon({iconUrl: iconBase + 'i9-1.png'}), ico9_ = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_null = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_nop = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_0 = new LeafIcon({iconUrl: iconBase + 'i9-null.png'}), ico9_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico10_3 = new LeafIcon({iconUrl: iconBase + 'i10-3.png'}), ico10_1 = new LeafIcon({iconUrl: iconBase + 'i10-1.png'}), ico10_ = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_null = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_nop = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_0 = new LeafIcon({iconUrl: iconBase + 'i10-null.png'}), ico10_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico11_3 = new LeafIcon({iconUrl: iconBase + 'i11-3.png'}), ico11_1 = new LeafIcon({iconUrl: iconBase + 'i11-1.png'}), ico11_ = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_null = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_nop = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_0 = new LeafIcon({iconUrl: iconBase + 'i11-null.png'}), ico11_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico12_3 = new LeafIcon({iconUrl: iconBase + 'i12-3.png'}), ico12_1 = new LeafIcon({iconUrl: iconBase + 'i12-1.png'}), ico12_ = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_null = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_nop = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_0 = new LeafIcon({iconUrl: iconBase + 'i12-null.png'}), ico12_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
    var ico13_3 = new LeafIcon({iconUrl: iconBase + 'i13-3.png'}), ico13_1 = new LeafIcon({iconUrl: iconBase + 'i13-1.png'}), ico13_ = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_null = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_nop = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_0 = new LeafIcon({iconUrl: iconBase + 'i13-null.png'}), ico13_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
	var ico14_3 = new LeafIcon({iconUrl: iconBase + 'i14-3.png'}), ico14_1 = new LeafIcon({iconUrl: iconBase + 'i14-1.png'}), ico14_ = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_null = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_nop = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_0 = new LeafIcon({iconUrl: iconBase + 'i14-null.png'}), ico14_10 = new LeafIcon({iconUrl: iconBase + 'i3-null.png'});
	
	var icons = { ico0_3, ico0_1, ico0_null, ico0_, ico0_nop, ico0_0, ico0_10,
	ico1_3, ico1_1, ico1_null, ico1_, ico1_nop, ico1_0, ico1_10,
	ico2_3, ico2_1, ico2_null, ico2_, ico2_nop, ico2_0, ico2_10,
	ico3_3, ico3_1, ico3_null, ico3_,  ico3_nop, ico3_0, ico3_10,
	ico4_3, ico4_1, ico4_null, ico4_, ico4_nop, ico4_0, ico4_10,
	ico5_3, ico5_1, ico5_null, ico5_, ico5_nop, ico5_0, ico5_10,
	ico6_3, ico6_1, ico6_null, ico6_, ico6_nop, ico6_0, ico6_10,
	ico7_3, ico7_1, ico7_null, ico7_, ico7_nop, ico7_0, ico7_10,
	ico8_3, ico8_1, ico8_null, ico8_, ico8_nop, ico8_0, ico8_10,
	ico9_3, ico9_1, ico9_null, ico9_, ico9_nop, ico9_0, ico9_10,
	ico10_3, ico10_1, ico10_null, ico10_, ico10_nop, ico10_0, ico10_10,
	ico11_3, ico11_1, ico11_null, ico11_, ico11_nop, ico11_0, ico11_10,
	ico12_3, ico12_1, ico12_null, ico12_, ico12_nop, ico12_0, ico12_10,
	ico13_3, ico13_1, ico13_null, ico13_, ico13_nop, ico13_0, ico13_10,
	ico14_3, ico14_1, ico14_null, ico14_, ico14_nop, ico14_0, ico14_10};
   
      
   $.ajax({
		type: "POST",
		url: "<?php echo site_url('Maps/viewLocation'); ?>",
		dataType:'JSON',
        data:"kw=<?php echo $kode_kanwil;?>"+"&kc="+$("#sel_kanca").val()+"&jns="+$("#sel_jenisuker").val(),//+"&prv="+$("#sel_provider").val(),
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{       
            for(var j=0 ; j<data['filter'].length ;j++)
            {
				//anim[j] = "none";
				lat[j] = data['filter'][j]["latitude"];
				lng[j] = data['filter'][j]["longitude"]; 
				idremote[j] = data['filter'][j]["id_remote"];
				if((data['filter'][j]["kode_tipe_uker"]==6 && data['filter'][j]["status"]==1) || (data['filter'][j]["kode_tipe_uker"]==10 && data['filter'][j]["status"]==1) || (data['filter'][j]["kode_tipe_uker"]==11 && data['filter'][j]["status"]==1)) // jika teras, ebuzz, terling offline, maka ditampilkan nop
				{
					mark[j] = icons['ico'+data['filter'][j]["kode_tipe_uker"]+'_nop'];
				}
				else
				{
					mark[j] = icons['ico'+data['filter'][j]["kode_tipe_uker"]+'_'+data['filter'][j]["status"]];
				}
				
				titles[j] = "<div><span style='font-weight:bold;font-size:12pt;'>"+toTitleCase(data['filter'][j]["nama_remote"])+"</span></div>"+
					"<br /><div><span style='font-size:10pt;'>Remote Type : "+data['filter'][j]["tipe_uker"]+"</span><br />"+
					"<span style='font-size:10pt;'>IP Address : "+data['filter'][j]["ip_lan"]+"</span><br />"+
					"</div>";
            }      
			
			markersLayer.clearLayers();

			for(var i=0; i<lat.length ; i++)
			{ 
				var marker;
				if(lat[i]==0 && lng[i]==0)
				{
					var loc = getLocationInduk(idremote[i]).split("|");
					marker = L.marker([loc[0],loc[1]], {icon: mark[i]});
				}
				else
				{
					marker = L.marker([lat[i],lng[i]], {icon: mark[i]});
				}
				
				markersLayer.addLayer(marker); 
				markersLayer.addTo(mymap);
				marker.bindPopup(titles[i]);
			}                                             
        }
    });
}


function getLocationInduk(idremote)
{
	var locs = new Array();
	//locs['lat'] = 0;
	//locs['lng'] = 0;
	var ret;
	
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('Maps/getLocationInduk'); ?>",
		dataType:'JSON',
        data:"idremote="+idremote,
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{
			//ret = data['filter'][0]['latitude']+","+data['filter'][0]['latitude'];
			locs['lat'] = data['filter'][0]['latitude'];
			locs['lng'] = data['filter'][0]['longitude'];
			//locs['tst'] = "aaa";
			
			//alert(latlng);
		},
		async: false
	});
	
	return (locs['lat']+"|"+locs['lng']);
	//alert(locs['lat']);
	//alert(ret);
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
		data: "data=kanca",
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

var mymap;
var osmUrl;
var osmAttrib;
var markersLayer = new L.LayerGroup();

function initialize()
{
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('Maps/getCenterMap'); ?>",
		dataType:'JSON',
        data:"kw=<?php echo $kode_kanwil;?>",
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{ 
			//alert(data['center'][0]['center_map']);
			//var center = data['center'][0]['center_map'];
			mymap = L.map('map-canvas').setView([data['center'][0]['latitude'],data['center'][0]['longitude']], 8);
			osmUrl='http://172.18.65.56/hot/{z}/{x}/{y}.png';
			osmAttrib='PT Bank Rakyat Indonesia (Persero) Tbk. | Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';

			L.tileLayer(osmUrl, {
				maxZoom: 20,
				attribution: osmAttrib
			}).addTo(mymap);
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
