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
	var lat  = new Array(); 
	var lng  = new Array(); 
    var mark = new Array();	
	
	var mymap = L.map('map-canvas').setView([-2.600029, 118.015776], 5);
	var osmUrl='http://172.18.65.56/hot/{z}/{x}/{y}.png';
	var osmAttrib='PT Bank Rakyat Indonesia (Persero) Tbk. | Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';

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
	
	var ico_3 = new LeafIcon({iconUrl: iconBase + 'green.png'}),
    ico_1 = new LeafIcon({iconUrl: iconBase + 'red.png'}),
    ico_0 = new LeafIcon({iconUrl: iconBase + 'grey.png'}),
	ico_nop = new LeafIcon({iconUrl: iconBase + 'grey.png'});
	
	var icons = { ico_0, ico_1, ico_3, ico_nop };
	
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('Maps/viewLocation'); ?>",
		dataType:'JSON',
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{       
            for(var j=0 ; j<data['filter'].length ;j++)
            {				
				lat[j] = data['filter'][j]["latitude"]; 
				lng[j] = data['filter'][j]["longitude"];
				if((data['filter'][j]["kode_tipe_uker"]==6 && data['filter'][j]["status"]==1) || (data['filter'][j]["kode_tipe_uker"]==10 && data['filter'][j]["status"]==1) || (data['filter'][j]["kode_tipe_uker"]==11 && data['filter'][j]["status"]==1)) // jika teras, ebuzz, terling offline, maka ditampilkan nop
				{
					mark[j] = icons['ico_nop'];	
				}
				else
				{
					mark[j] = icons['ico_'+data['filter'][j]["status"]];
				}				
            }       
			
			for(var i=0; i<lat.length ; i++)
			{ 
				var marker = L.marker([lat[i],lng[i]], {icon: mark[i]}).addTo(mymap);   
			}
				 
        }
    });
	
	refresh();
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