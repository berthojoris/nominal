
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/leaflet/leaflet.css" />
<script src="<?php echo base_url(); ?>assets/plugins/leaflet/leaflet.js" ></script>
    
<script>


function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt){
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
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
		url: "<?php echo site_url('Maps/getListJenisUkerAll'); ?>",
		//data: "data=all",
		dataType:'JSON',
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{       
            var opt = "";
            var legend = "";
            for(var j=0 ; j<data['jenisuker'].length ;j++)
            {
                 opt +=  "<option value='"+data['jenisuker'][j]['kode_tipe_uker']+"' >"+data['jenisuker'][j]['tipe_uker']+"</option>";
                 
                 legend += "<span style='padding-left:10px;display:inline-block;width:220px;padding:5px;'><img height='25px' src='"+iconBase+"i"+data['jenisuker'][j]['kode_tipe_uker']+"-3.png"+"' />&nbsp;"+data['jenisuker'][j]['tipe_uker']+"</span>";
            }
            
            
            $("#sel_jenisuker").html(opt);
            
            $("#sel_jenisuker")[0].sumo.reload();
            
            $("#map-legend").html(legend);
        } 
    });
}

function getKanca()
{
    $.ajax({
		type: "POST",
		url: "<?php echo site_url('Maps/getListKanca'); ?>",
        data: "kanwil="+$("#sel_kanwil").val(),
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
            }
            
            $("#sel_kanwil").html(opt);
            
            $("#sel_kanwil")[0].sumo.reload();
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
<section>
    <div class="row">
        <div class="col-md-8" style="width:100%;">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">MAPS Distribution of BRI Remotes</div>
                    <div class="panel-body">
                        <div style="width: 100%;" class="panel panel-default">
                            <table width="100%" style="margin:5px;">
                                <tr>
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
                                    <td colspan="3"><input type="button" id="btn_view" value="view" onclick="javascript:view();" />&nbsp;<img id="wait" src='<?php echo base_url()."assets/img/ajax-loader.gif"; ?>' /></td>
                                </tr>         
                            </table>
                                                                                  
                        </div>
                        
                        <div id="map-canvas" style="width: 100%; height: 600px;" class="panel panel-default"></div>
                        
                        <div id="map-legend" style="width: 100%;padding:5px;" class="panel panel-default"></div>
                    </div>
            </div>
        </div>  
    </div>
<script>

var mymap;
var osmUrl;
var osmAttrib;
var markersLayer = new L.LayerGroup();

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
    getKanwil();
    getJenisUker();
    //getProvider();
});

function initialize()
{
	mymap = L.map('map-canvas').setView([-2.600029, 118.015776], 5);
	osmUrl='http://172.18.65.56/hot/{z}/{x}/{y}.png';
	osmAttrib='PT Bank Rakyat Indonesia (Persero) Tbk. | Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';

	L.tileLayer(osmUrl, {
		maxZoom: 20,
		attribution: osmAttrib
	}).addTo(mymap);	
}

function view()
{
    var lat    = new Array(); 
    var lng    = new Array(); 
    var mark   = new Array();
	var uker   = new Array();
	var titles = new Array();
	var anim   = new Array();
	
	
    var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
	
	var LeafIcon = L.Icon.extend({
		options: {
			iconSize:     [20, 31],
			iconAnchor:   [10, 31]
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
        data:"kw="+$("#sel_kanwil").val()+"&kc="+$("#sel_kanca").val()+"&jns="+$("#sel_jenisuker").val(),//+"&prv="+$("#sel_provider").val(),
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
				var marker = L.marker([lat[i],lng[i]], {icon: mark[i]});
				markersLayer.addLayer(marker); 
				markersLayer.addTo(mymap);
				marker.bindPopup(titles[i]);
			}                                             
        }
    });
}
</script>   
    
</section>