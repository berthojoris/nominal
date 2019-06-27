<html>
<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/leaflet/leaflet.css" />
<script src="<?php echo base_url(); ?>assets/plugins/leaflet/leaflet.js" ></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>

<style>
html, body, #map-canvas {
	width: 100%;
    height: 100%;
    position: relative;
	margin: 0;
	padding: 0;
}
</style>
</head>
<body>
<div id="map-canvas" ></div>
<script>
$(document).ready(function()
{
    initialize(); 
});

function initialize()
{
	var lat_grey   = new Array(); 
	var lat_green  = new Array(); 
	var lat_red    = new Array(); 
	var lng_grey   = new Array(); 
	var lng_green  = new Array(); 
	var lng_red    = new Array(); 
    var mark_grey  = new Array();	
    var mark_red   = new Array();	
    var mark_green = new Array();
	var titles_grey  = new Array();
	var titles_green = new Array();
	var titles_red   = new Array();
	
    //var mark = new Array();
	
	
	var markersLayer = new L.LayerGroup();
	
	
	var mymap = L.map('map-canvas').setView([-2.600029, 118.015776], 5);
	var osmUrl='http://172.18.65.56/hot/{z}/{x}/{y}.png';
	var osmAttrib='PT Bank Rakyat Indonesia (Persero) Tbk. | Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
	var myRenderer = L.canvas();

	L.tileLayer(osmUrl, {
		maxZoom: 20,
		attribution: osmAttrib
	}).addTo(mymap);
	
	var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
	
	var LeafIcon = L.Icon.extend({
		options: {
			iconSize:     [10, 15],
			iconAnchor:   [5, 15]}
	});	
	
	/*
	var ico_3 = new LeafIcon({iconUrl: iconBase + 'green.png'}),
    ico_1 = new LeafIcon({iconUrl: iconBase + 'red.png'}),
    ico_0 = new LeafIcon({iconUrl: iconBase + 'grey.png'}),
	ico_nop = new LeafIcon({iconUrl: iconBase + 'grey.png'});
	*/
	var ico_3   = "#009900";
	var ico_1   = "#DD0000";
	var ico_0   = "#9A9A9A";
	var ico_10  = "#9A9A9A";
	var ico_nop = "#9A9A9A";
	
	var icons = { ico_0, ico_1, ico_3, ico_10, ico_nop };
	
	
	
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('Maps/viewLocationAll'); ?>",
		dataType:'JSON',
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{       
			var grey = 0;
			var red = 0;
			var green = 0;
            for(var j=0 ; j<data['filter'].length ;j++)
            {	
				if((data['filter'][j]["kode_tipe_uker"]==6 && data['filter'][j]["status"]==1) || (data['filter'][j]["kode_tipe_uker"]==10 && data['filter'][j]["status"]==1) || (data['filter'][j]["kode_tipe_uker"]==11 && data['filter'][j]["status"]==1)) // jika teras, ebuzz, terling offline, maka ditampilkan nop
				{
					mark_grey[grey]   = icons['ico_nop'];	
					lat_grey[grey]    = data['filter'][j]["latitude"]; 
					lng_grey[grey]    = data['filter'][j]["longitude"];
					titles_grey[grey] = "<div><span style='font-weight:bold;font-size:12pt;'>"+toTitleCase(data['filter'][j]["nama_remote"])+"</span></div>"+
					"<br /><div><span style='font-size:10pt;'>Remote Type : "+data['filter'][j]["tipe_uker"]+"</span><br />"+
					"<span style='font-size:10pt;'>IP Address : "+data['filter'][j]["ip_lan"]+"</span><br />"+
					"</div>";				
					
					grey++;
				}
				else 
				{
					//mark[j] = icons['ico_'+data['filter'][j]["status"]];
					
					if(data['filter'][j]["status"]==1)
					{
						mark_red[red]   = icons['ico_1'];
						lat_red[red]    = data['filter'][j]["latitude"]; 
						lng_red[red]    = data['filter'][j]["longitude"];
						titles_red[red] = "<div><span style='font-weight:bold;font-size:12pt;'>"+toTitleCase(data['filter'][j]["nama_remote"])+"</span></div>"+
						"<br /><div><span style='font-size:10pt;'>Remote Type : "+data['filter'][j]["tipe_uker"]+"</span><br />"+
						"<span style='font-size:10pt;'>IP Address : "+data['filter'][j]["ip_lan"]+"</span><br />"+
						"</div>";
						
						red++;
					}
					else
					{
						mark_green[green]   = icons['ico_3'];
						lat_green[green]    = data['filter'][j]["latitude"]; 
						lng_green[green]    = data['filter'][j]["longitude"];
						titles_green[green] = "<div><span style='font-weight:bold;font-size:12pt;'>"+toTitleCase(data['filter'][j]["nama_remote"])+"</span></div>"+
						"<br /><div><span style='font-size:10pt;'>Remote Type : "+data['filter'][j]["tipe_uker"]+"</span><br />"+
						"<span style='font-size:10pt;'>IP Address : "+data['filter'][j]["ip_lan"]+"</span><br />"+
						"</div>";
						
						green++;
					}	
					
				}				
				
				
					/*
					var circleMarker = L.circleMarker([lat[j],lng[j]], {
					renderer: myRenderer,
					color: '#FFFFFF',
					radius: 5,
					weight: 0.5,
					fillColor: mark[j],
					fillOpacity: 0.8
				}).addTo(mymap);
				circleMarker.bindPopup(titles[j]);*/
            }  
			
			for(var k=0; k<mark_grey.length; k++)
			{
				var circleMarker_grey = L.circleMarker([lat_grey[k],lng_grey[k]], {
					renderer: myRenderer,
					color: '#FFFFFF',
					radius: 5,
					weight: 0.5,
					fillColor: mark_grey[k],
					fillOpacity: 0.8
				}).addTo(mymap);
				circleMarker_grey.bindPopup(titles_grey[k]);
			}
			
			for(var l=0; l<mark_green.length; l++)
			{
				var circleMarker_green = L.circleMarker([lat_green[l],lng_green[l]], {
					renderer: myRenderer,
					color: '#FFFFFF',
					radius: 5,
					weight: 0.5,
					fillColor: mark_green[l],
					fillOpacity: 0.8
				}).addTo(mymap);
				circleMarker_green.bindPopup(titles_green[l]);
			}
			
			for(var m=0; m<mark_red.length; m++)
			{
				var circleMarker_red = L.circleMarker([lat_red[m],lng_red[m]], {
					renderer: myRenderer,
					color: '#FFFFFF',
					radius: 5,
					weight: 0.5,
					fillColor: mark_red[m],
					fillOpacity: 0.8
				}).addTo(mymap);
				circleMarker_red.bindPopup(titles_red[m]);
			}
			
        }
    });
	
	refresh();
}

function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt){
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}

function refresh()
{
    setTimeout(function(){
	   window.location.reload();
	   //refresh();
    }, 300000);
}
</script>
</body>
</html>