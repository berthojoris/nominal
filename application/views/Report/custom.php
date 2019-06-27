<style>
a {color : #777777;}
/* tr:hover  #TR{ background-color : #ccd9ff }  */

</style>
<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active" style="color: #3C8DBC;">Custom Report</li>
      </ol>
    </div>
</section>
<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Custom Remote Monitoring</div>
        <div class="panel-body">             
            <div style="width:100%;height:50px;">
				<input type="hidden" name="perpage" id="perpage" value="10" />
				<input type="hidden" name="url" id="url" value="<?php echo base_url().'index.php/Report/incidental/'; ?>">
				<select id="sel_kanwil" name="kw" class="sumoselect" multiple="multiple" onchange="javascript:getKanca();"></select>&nbsp;
				<select id="sel_kanca"  name="kc" class="sumoselect" multiple="multiple"></select>&nbsp;
				<input type="button" id="btn_view" value="view" onclick="javascript:view(1,10,1);" />				
			</div>
      <div class="box-body table-responsive no-padding">
        <span style="margin-left:10px;font-size:18px">Total Data : <span id="totalnya"></span></span>
        <table class="table table-bordered table-striped table-hover" id="tb_custom">
          <thead>
            <tr>
              <th>No.</th>
              <th>Remote Name</th>
              <th>Remote Type</th>
              <th>Region</th>
              <th>Main Branch</th>
              <th>Branch Code</th>
              <th>IP Address</th>
              <th>Remote Status</th>
              <th>Last Change Update</th>
              <th>Network</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
		  <tfoot>
		  </tfoot>
        </table>
        
      </div>
    </div>
    </div>        
</div>
</section>
<script type="text/javascript">
$(document).ready(function()
{
    $(".sumoselect").SumoSelect({ okCancelInMulti: true }); 

	//$("#tb_custom").DataTable();
	    
    getKanwil();
    //getJenisUker();
	//last_status();
	view(1,10,1);
    
});
  function search() {
    kategori = $('#kategori').val();
    input = $('#input').val();
    status = $('#status').val();
    url = $('#url').val();

    if (kategori=='status') {
      window.location = url+kategori+'/'+status;
    }else{
      window.location = url+kategori+'/'+input;
    }
    //alert(location);
  }
  
	function jarkom(jarkoms)
	{
		//alert(jarkoms[0]["brisat"]);
		var str = "";
		for(var i=0 ; i<jarkoms.length ; i++)
		{
			if (jarkoms[i]["brisat"]==1) {
				if (jarkoms[i]["status"]==3) {
					str += '<span class="label label-success">BRISAT/'+jarkoms[i]["nickname_provider"]+'</span><br>';
                }else if (jarkoms[i]["status"]==1) {
					str += '<span class="label label-danger">BRISAT/'+jarkoms[i]["nickname_provider"]+'</span><br>';
                }else{
					str += '<span class="label label" style="color:#3d3d29">BRISAT/'+jarkoms[i]["nickname_provider"]+'</span><br>';
				}
            }else{
				if (jarkoms[i]["status"]==3) {
					str += '<span class="label label-success">'+jarkoms[i]["jenis_jarkom"]+'/'+jarkoms[i]["nickname_provider"]+'</span><br>';
				}else if (jarkoms[i]["status"]==1) {
					str += '<span class="label label-danger">'+jarkoms[i]["jenis_jarkom"]+'/'+jarkoms[i]["nickname_provider"]+'</span><br>';
				}else{
					str += '<span class="label label" style="color:#3d3d29">'+jarkoms[i]["jenis_jarkom"]+'/'+jarkoms[i]["nickname_provider"]+'</span><br>';
				}
			}
		}
		
		return str;
	}

	function status(onoff,op,tipe) 
	{
		var arr = [10,6,11,13];
		if(onoff==3) 
		{
			return '<span class="label label-success">ONLINE</span>';
                    //$waktu = $datas->status_rec_date;
        }
		else if(onoff==1 && op==2 || ( op==1 && onoff==1 && arr.indexOf(tipe)))
		{
            return '<span class="label label-primary">NOP</span>';
                    //$waktu = $datas->status_fail_date;
        }
		else if(onoff==1 && op==1)
		{
            return '<span class="label label-danger">OFFLINE</span>';
                    //$waktu = $datas->status_fail_date;
        }
		else
		{
			return '<span class="label label-primary">UNKNOWN</span>';
                    //$waktu = $datas->status_fail_date;
        }
	}
	
	function last_status(last_update_status)
	{
		if(last_update_status!=null)
		{
		//bongkar last_update_status
			var split1 = last_update_status.split(" ");
			var spdate = split1[0].split("-");
			var sptime = split1[1].split(":");
			
			var now = new Date().getTime();
			//var curr = new Date(spdate[0],(spdate[1]-1),spdate[2],sptime[0],sptime[1],sptime[2]);
			var statms = new Date(spdate[0],(spdate[1]-1),spdate[2],sptime[0],sptime[1],sptime[2]).getTime(); 
			
			var diffms = now - statms;
			var diff = diffms / 1000;
			var sec = Math.floor(diff % 60);
			
			var diffsec = diff / 60;
			var min = Math.floor(diffsec % 60);
			
			var diffmin = diffsec / 60; 
			var hours = Math.floor(diffmin % 24);  
			var days = Math.floor(diffmin/24);			
			
			return (days+"d "+hours+"h "+min+"m "+sec+"s");
		}	
		else
		{
			return 0;
		}
		
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



function view(start,length,currpage)
{
	$.ajax({
			type: "POST",
			url: "<?php echo site_url('Report/getCustomData'); ?>",
			dataType:'JSON',
			data:"kw="+$("#sel_kanwil").val()+"&kc="+$("#sel_kanca").val()+"&start="+start+"&length="+length,
			error:function()
			{
				alert("Error\nGagal retrieve data");
			},
			success: function(data)
			{
				$("table tbody").html("");
				$("#totalnya").html(data["total"]);
				
				var dt = data["data"];
				var str = "";
				var startingno = start;
				
				//alert(dt[0]["nama_remote"]);
				for (var i=0 ; i<dt.length ; i++)
				{
					str += "<tr>";
					str += "<td>"+startingno+"</td>";
					str += "<td>"+dt[i]["nama_remote"]+"</td>";
					str += "<td>"+dt[i]["tipe_uker"]+"</td>";
					str += "<td>"+dt[i]["nama_kanwil"]+"</td>";
					str += "<td>"+dt[i]["nama_kanca"]+"</td>";
					str += "<td>"+dt[i]["kode_uker"]+"</td>";
					str += "<td>"+dt[i]["ip_lan"]+"</td>";
					str += "<td>"+status(dt[i]["status_onoff"],dt[i]["kode_op"],dt[i]["kode_tipe_uker"])+"</td>";
					str += "<td>"+last_status(dt[i]["last_update_status"])+"</td>";
					str += "<td>"+jarkom(data["jarkom"][dt[i]["id_remote"]])+"</td>";
					str += "<td><a href='<?php echo base_url();?>index.php/Dashboard/detail_uker/"+dt[i]["id_remote"]+"/"+dt[i]["kode_tipe_uker"]+"'><button type='button' class='btn btn-block btn-primary btn-xs' style='width: 100px;hight:30px'><i class='fa fa-book'></i> Detail</button></a></td>";
					str += "</tr>";
					
					startingno++;
				}
				$("#tb_custom tbody").html(str);
				pagination(length,data["total"],currpage);
			}
	});
}

function pagination(length,numrow,currpage)
{
	var str = "";
	var pagelength = Math.ceil(numrow / length);
	var prevstart = 0;
	var nextstart = length + 1;
	
	if(pagelength>1)
	{
		if(currpage==1)//first page
		{
			prevstart = 1;
			nextstart = ((currpage*length)+1);
		}
		else if(currpage==pagelength)//last page
		{
			prevstart = (((currpage-2)*length)+1);
			nextstart = (((currpage-1)*length)+1);
		}
		else if(currpage==2)
		{
			prevstart = 1;
			nextstart = ((currpage*length)+1);
		}
		else
		{
			prevstart = (((currpage-2)*length)+1);
			nextstart = (((currpage)*length)+1);		
		}
	}
	else
	{
		prevstart = 1;
		nextstart = 1;
	}
	
	str += "<tr>";
	str += "<td colspan='6'>";
	str += "<input type ='button' id='first' class='navigation' onClick='javascript:view("+1+","+length+","+1+")' value='<< First' />";
	str += "<input type ='button' id='prev' class='navigation' onClick='javascript:view("+prevstart+","+length+","+(currpage-1)+")' value='< Prev' />";
	//for(var i = 1 ; i <= pagelength ; i++)
	for(var i = (currpage-2) ; i <= (currpage+2) ; i++)
	{		
		if(i>0 && i<=pagelength)
		{
			if(i==currpage)
			{
				str += "<input type='button' id='pg_"+i+"' class='paging' disabled='true' onClick='javascript:view("+(((i-1)*length)+1)+","+length+","+i+")' value='"+i+"' />";
			}
			else
			{
				str += "<input type='button' id='pg_"+i+"' class='paging' onClick='javascript:view("+(((i-1)*length)+1)+","+length+","+i+")' value='"+i+"' />";
			}
			
			
		}	
		//$(".paging").removeAttr("disabled",true);
		//$("#pg_"+currpage).attr("disabled",true);
	}
	str += "<input type ='button' id='next' class='navigation' onClick='javascript:view("+nextstart+","+length+","+(currpage+1)+")' value='Next >' />";
	str += "<input type ='button' id='last' class='navigation' onClick='javascript:view("+(((pagelength-1)*length)+1)+","+length+","+pagelength+")' value='Last >>' />";
	str += "</td>";
	str += "</tr>";
	
	$("#tb_custom tfoot").html(str);
	
	if(pagelength==1)
	{
		$("#prev , #first").attr("disabled",true);
		$("#next , #last").attr("disabled",true);
		$(".paging").attr("disabled",true);
	}
	else
	{
		if(currpage==1)//first page
		{
			$("#prev , #first").attr("disabled",true);
		}
		else if(currpage==pagelength)//last page
		{
			$("#next , #last").attr("disabled",true);
		}
		else if(currpage==2)
		{
			$("#prev , #first").removeAttr("disabled");
		}	
		else
		{
			$("#prev , #first").removeAttr("disabled");
			$("#next , #last").removeAttr("disabled");
			//$(".paging").removeAttr("disabled",true);
		}
	}
}
</script>