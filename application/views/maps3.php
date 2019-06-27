<html>
<head>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHsVQ1T62EfD-uo64IeLr7CxWbgw1Y8kU&callback=initialize"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
    
<script>
$(document).ready(function()
{
    initialize(); 
	view();
});

function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt){
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}

function view()
{
   //alert($("#sel_kanca").val()); 
    var loc    = new Array(); 
    var mark   = new Array();
	var uker   = new Array();
	var titles = new Array();
	//var anim   = new Array();
    var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
   
    var icons = {
      ico_3: iconBase + 'green.png' , ico_1: iconBase + 'red.png', ico_nop: iconBase + 'grey.png', ico_0: iconBase + 'grey.png'   
    };
      
   $.ajax({
		type: "POST",
		url: "<?php echo site_url('Maps/viewLocation'); ?>",
		dataType:'JSON',
        //data:"kw="+$("#sel_kanwil").val()+"&kc="+$("#sel_kanca").val()+"&jns="+$("#sel_jenisuker").val()+"&prv="+$("#sel_provider").val(),
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{       
            for(var j=0 ; j<data['filter'].length ;j++)
            {				
				loc[j]  = new google.maps.LatLng(data['filter'][j]["latitude"],data['filter'][j]["longitude"]); 
				if(data['filter'][j]["kode_tipe_uker"]==6 && data['filter'][j]["status"]==1) // jika teras offline, maka ditampilkan nop
				{
				mark[j] = icons['ico_nop'];	
				}
				else
				{
				mark[j] = icons['ico_'+data['filter'][j]["status"]];
				}
              
				uker[j] = [data['filter'][j]["kode_uker"],data['filter'][j]["nama_remote"]];
				//titles[j] = "<h4>"+data['filter'][j]["nama_remote"]+"</h4><h5>IP : "+data['filter'][j]["ip_lan"]+"</h5>";
				titles[j] = "<div><span style='font-weight:bold;font-size:12pt;'>"+toTitleCase(data['filter'][j]["nama_remote"])+"</span></div>"+
				"<br /><div><span style='font-size:10pt;'>Remote Type : "+data['filter'][j]["tipe_uker"]+"</span><br />"+
				"<span style='font-size:10pt;'>IP Address : "+data['filter'][j]["ip_lan"]+"</span><br />"+
				"</div>"; 
            }       

			//alert(mark[0]);
              
            var bounds = new google.maps.LatLngBounds();
             
      		var mapOptions = {
      			   mapTypeId: 'roadmap',
                   center: {lat: -2.600029, lng: 118.015776},
      			   zoom: 5,
				   fullscreenControl: true
      		}; 
                         
             map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);      
                                                                               
             var infowindow = new google.maps.InfoWindow();
			 
             for(var i=0; i<loc.length ; i++)
             { 
                  var markers  = new google.maps.Marker({ position:loc[i], icon:mark[i], map:map, title: uker[i][0]+" - "+uker[i][1]/*, animation: anim[i]*/ });
				  
				  google.maps.event.addListener(markers, 'click', (function(markers, i) {
                    return function() {
                      infowindow.setContent(titles[i]);
                      infowindow.open(map, markers);
                    }
                })(markers, i));
             }   

			refresh();			 
        }
    });
}


function refresh()
{
    setTimeout(function(){
      //window.location.reload(1);
      //view();
       //refresh();
	   location.reload();
    }, 300000);
}

function initialize()
{
  myCenter = Array();  
  var bounds = new google.maps.LatLngBounds();
  
  var mapOptions = {
    mapTypeId: 'roadmap',
    center: {lat: -2.600029, lng: 118.015776},
    zoom: 5
  };
  
  // Display a map on the page
  map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
  
  for(var i=0; i<myCenter.length ; i++)
  { 
        var marker=new google.maps.Marker({ position:myCenter[i] });
        marker.setMap(map);
  } 
	
}

</script>
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
</body>
</html>