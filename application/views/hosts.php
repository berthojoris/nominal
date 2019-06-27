  
<script>
$(document).ready(function()
{
     
});

function getIpHost()
{
    $.ajax({
		type: "POST",
		url: "<?php echo site_url('Hosts/getHosts'); ?>",
		dataType:'JSON',
        data:"ip="+$("#ip_address").val()+"&net="+$("#netmask").val(),
		error:function()
		{
			alert("Error\nGagal retrieve data");
		},
		success: function(data)
		{       
            var txt = "";
            for(var i = 0 ; i < data['hosts'].length ; i++)
            {
                txt += data['hosts'][i]['ip_addr']+" : "+data['hosts'][i]['host_apps']+"<br />";    
            }      
            
            $("#result").html(txt);                                          
        }
    });
}

</script>

<section>
    <div class="row">
        <div class="col-md-8" style="width:100%;">
            <div class="panel panel-default">
                <div class="panel-heading">Peta Sebaran Unit Kerja BRI</div>
                <div class="panel-body">
                    IP Address : <input type="text" id="ip_address" /><br />
                    Netmask : /<input type="text" id="netmask" /><input type="button" onclick="getIpHost();" value="Show Hosts">
                </div>
                <div id="result">
                </div>
            </div>
        </div>  
    </div>
</section>