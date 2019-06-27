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
    getKanwil();
    getJenisUker();
    getProvider();
	
	//refresh();
    
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
	var anim   = new Array();
    var iconBase = '<?php echo base_url(); ?>assets/icon/markers/';
   
    var icons = {
      ico0_3: iconBase + 'i0-3.png' ,  ico0_1: iconBase + 'i0-1.png' , ico0_null: iconBase + 'i0-null.png' , ico0_nop: iconBase + 'i0-null.png' , ico0_0: iconBase + 'i0-null.png' ,
      ico1_3: iconBase + 'i1-3.png' ,  ico1_1: iconBase + 'i1-1.png' , ico1_null: iconBase + 'i1-null.png' , ico1_nop: iconBase + 'i1-null.png' , ico1_0: iconBase + 'i1-null.png' ,
      ico2_3: iconBase + 'i2-3.png' ,  ico2_1: iconBase + 'i2-1.png' , ico2_null: iconBase + 'i2-null.png' , ico2_nop: iconBase + 'i2-null.png' , ico2_0: iconBase + 'i2-null.png' ,
      ico3_3: iconBase + 'i3-3.png' ,  ico3_1: iconBase + 'i3-1.png' , ico3_null: iconBase + 'i3-null.png' , ico3_nop: iconBase + 'i3-null.png' , ico3_0: iconBase + 'i3-null.png' ,
      ico4_3: iconBase + 'i4-3.png' ,  ico4_1: iconBase + 'i4-1.png' , ico4_null: iconBase + 'i4-null.png' , ico4_nop: iconBase + 'i4-null.png' , ico4_0: iconBase + 'i4-null.png' ,
      ico5_3: iconBase + 'i5-3.png' ,  ico5_1: iconBase + 'i5-1.png' , ico5_null: iconBase + 'i5-null.png' , ico5_nop: iconBase + 'i5-null.png' , ico5_0: iconBase + 'i5-null.png' ,
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
		url: "<?php echo site_url('Maps/viewLocation'); ?>",
		dataType:'JSON',
        data:"kw="+$("#sel_kanwil").val()+"&kc="+$("#sel_kanca").val()+"&jns="+$("#sel_jenisuker").val()+"&prv="+$("#sel_provider").val(),
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{       
            for(var j=0 ; j<data['filter'].length ;j++)
            {
				anim[j] = "none";
              loc[j]  = new google.maps.LatLng(data['filter'][j]["latitude"],data['filter'][j]["longitude"]); 
			  if(data['filter'][j]["kode_tipe_uker"]==6 && data['filter'][j]["status"]==1) // jika teras offline, maka ditampilkan nop
			  {
				mark[j] = icons['ico'+data['filter'][j]["kode_tipe_uker"]+'_nop'];	
			  }
			  else
			  {
				mark[j] = icons['ico'+data['filter'][j]["kode_tipe_uker"]+'_'+data['filter'][j]["status"]];
			  }
              
			  uker[j] = [data['filter'][j]["kode_uker"],data['filter'][j]["nama_remote"]];
			  //titles[j] = "<h4>"+data['filter'][j]["nama_remote"]+"</h4><h5>IP : "+data['filter'][j]["ip_lan"]+"</h5>";
			  titles[j] = "<div><span style='font-weight:bold;font-size:12pt;'>"+toTitleCase(data['filter'][j]["nama_remote"])+"</span></div>"+
			  "<br /><div><span style='font-size:10pt;'>Remote Type : "+data['filter'][j]["tipe_uker"]+"</span><br />"+
			  "<span style='font-size:10pt;'>IP Address : "+data['filter'][j]["ip_lan"]+"</span><br />"+
			  "</div>";
			  
			  if(data['filter'][j]["status"]==1 && data['filter'][j]["kode_tipe_uker"]!=6)
			  {
				  anim[j] = google.maps.Animation.BOUNCE;
			  }
			  
            }       

			//alert(mark[0]);
              
            var bounds = new google.maps.LatLngBounds();
             
      		var mapOptions = {
      			   mapTypeId: 'roadmap',
                   center: {lat: -2.600029, lng: 118.015776},
      			   zoom: 5
      		}; 
                         
             map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);      
                                                                               
             var infowindow = new google.maps.InfoWindow();
			 
             for(var i=0; i<loc.length ; i++)
             { 
                  var markers  = new google.maps.Marker({ position:loc[i], icon:mark[i], map:map, title: uker[i][0]+" - "+uker[i][1], animation: anim[i] });
				  
				  google.maps.event.addListener(markers, 'click', (function(markers, i) {
                    return function() {
                      infowindow.setContent(titles[i]);
                      infowindow.open(map, markers);
                    }
                })(markers, i));
             }                                             
        }
    });
	
	//refresh();
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
                 //$('#sel_kanwil')[0].sumo.add(data['kanwil'][j]['kode_kanwil'],data['kanwil'][j]['nama_kanwil']);
            }
            
            $("#sel_kanwil").html(opt);
            
            $("#sel_kanwil")[0].sumo.reload();
        } 
    });
}

function refresh()
{
    setTimeout(function(){
      //window.location.reload(1);
      view();
       refresh();
    }, 300000);
}

function initialize()
{
  myCenter = Array();
  //myCenter[0] = new google.maps.LatLng(-8.35000000,116.60000000);
  //myCenter[1] = new google.maps.LatLng(-8.66636810,115.23813590);
  
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

function gotoFs()
{
	window.open('<?php echo base_url(); ?>index.php/Maps/fullscreen');
}

/*
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
}*/
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
                                <tr>
                                    <td>Provider</td>
                                    <td>:</td>
                                    <td>
                                      <select id="sel_provider" class="sumoselect" multiple="multiple" >
                                          <option values="all">-- ALL --</option>
                                      </select>
                                    </td>
                                </tr>
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
    
    
</section>