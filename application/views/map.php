<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    
<script>
    function initialize() {
    // Data yang disimpan dalam variabel array locations
    var locations = [
      ['<h4>Bondi Beach</h4>', 5.550176, 95.319263],
      ['<h4>Ibukota Kab.Aceh Jaya</h4>', 4.727890, 95.601373],
      ['<h4>Ibukota Abdya</h4>', 3.818570, 96.831841],
      ['<h4>Ibukota Kotamadya Langsa</h4>', 4.476020, 97.952447],
      ['<h4>Ibukota Kotamadya Sabang</h4>', 5.909284, 95.304742]
    ];
    
    // Lokasi folder dari icon
    var iconMarker = '<?php echo base_url(); ?>icon/';
    
    // variabel uniqueIcons untuk menyimpan icon yang berbeda-bedan
    var uniqueIcons = [
      iconMarker + 'red-dot.png',
      iconMarker + 'green-dot.png',
      iconMarker + 'blue-dot.png',
      iconMarker + 'orange-dot.png',
      iconMarker + 'purple-dot.png',
      iconMarker + 'pink-dot.png',      
      iconMarker + 'yellow-dot.png'
    ]
    var iconsLength = uniqueIcons.length;

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(4.845582, 96.271539),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      streetViewControl: false,
      panControl: false,
      zoomControlOptions: {
         position: google.maps.ControlPosition.LEFT_BOTTOM
      }
    });

    var infowindow = new google.maps.InfoWindow();

    var markers = new Array();
    
    var iconCounter = 0;
    
    // Membuat marker dengan icon yang berbeda-beda
    for (var i = 0; i < locations.length; i++) {  
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: uniqueIcons[iconCounter]
      });

      markers.push(marker);
      
      // Membuah event click dan menambah infowindows
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      
      iconCounter++;
      
      if(iconCounter >= iconsLength) {
        iconCounter = 0;
      }
    }

    function autoCenter() {
      
      var bounds = new google.maps.LatLngBounds();
      
      for (var i = 0; i < markers.length; i++) {  
                bounds.extend(markers[i].position);
      }
      
      map.fitBounds(bounds);
    }
    autoCenter();
    };
</script> 
    
<section>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Different Marker On The Location of Google Maps </div>
                    <div class="panel-body">
                        <div id="map" style="width: 700px; height: 600px;"></div>
                    </div>
            </div>
        </div>  
    </div>
</section>