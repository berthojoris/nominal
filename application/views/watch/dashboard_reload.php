<style>
  .info-box-50 {
  display: block;
  min-height: 50px;
  background: #fff;
  width: 100%;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
  border-radius: 2px;
  margin-bottom: 15px;
}
.info-box-icon-50 {
  border-top-left-radius: 2px;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 2px;
  display: block;
  float: left;
  height: 50px;
  width: 50px;
  text-align: center;
  font-size: 20px;
  font-weight:bold;
  line-height: 50px;
  background: rgba(0, 0, 0, 0.2);
}
.info-box-content-50 {
  padding: 5px 10px;
  margin-left: 50px;
}
.row-center {
  margin-right: -15px;
  margin-left: -15px;
  text-align:center;
}
</style>
<meta http-equiv="refresh" content="60"/>

<style type="text/css">
body, html { margin: 0; padding: 0; width: 100%; height: 100%; overflow: hidden; }
iframe { border: none; width: 100%; height: 100%; display: none; }
iframe.active { display: block;}
</style>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript">
var Dash = {
    nextIndex: 0,
    //Don't put too many items in this list
    dashboards: [
        {url: "http://172.18.65.227/plugins/Weathermap/Core-Edge-PSCF.html", time: 10, refresh: true},
        {url: "http://172.18.65.227/plugins/Weathermap/BRI-IDC.html", time: 10, refresh: true},
        {url: "http://172.18.65.227/overview/dashboard=11", time: 10, refresh: true}
    ],
    startup: function () {
        for (var index = 0; index < Dash.dashboards.length; index++) {
                        Dash.loadFrame(index);
                }
        setTimeout(Dash.display, Dash.dashboards[0].time * 1000);
    },
    loadFrame: function (index) {
                var iframe = document.getElementById(index);
                iframe.src = Dash.dashboards[index].url;
    },
    display: function () {
        var dashboard = Dash.dashboards[Dash.nextIndex];
                Dash.hideFrame(Dash.nextIndex - 1);
                if (dashboard.refresh) {
                        Dash.loadFrame(Dash.nextIndex);
                }
                Dash.showFrame(Dash.nextIndex);
        Dash.nextIndex = (Dash.nextIndex + 1) % Dash.dashboards.length;
        setTimeout(Dash.display, dashboard.time * 1000);
    },
    hideFrame: function (index) {
                if (index < 0) {
                        index = Dash.dashboards.length - 1;
                }
                $('#'+index).css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0.0},2000);
                setTimeout(function() {true;},2000);
                document.getElementById(index).removeAttribute('class');
    },
    showFrame: function (index) {
                $('#'+index).css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0},200);
                document.getElementById(index).setAttribute('class', 'active');
    }
};
function fetchPage(url) {
    $.ajax({
        type: "GET",
        url: url,
        error: function(request, status) {
            alert('Error fetching ' + url);
        },
        success: function(data) {
            parse_hadoop_active_nodes(data.responseText);
        }
    });
}
function parse(data) {
    alert($(data).find("#nodes").text());
}
window.onload = Dash.startup;
</script>
</head>
<body>
<iframe id="0" class="active"></iframe>
<iframe id="1"></iframe>
<iframe id="2"></iframe>
<iframe id="3"></iframe>

<script type="text/javascript">
 function refresh()
  {
      setTimeout(function(){
        window.location.reload(1);
         refresh();
      }, 60000);
   // }, 60);
  }

</script>