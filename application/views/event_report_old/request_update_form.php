<form class="col-md-12" id="request_form" data="4">
	<input type="hidden" name="type_report" value="4"/>
	<div class="col-md-12"><h3>Number Form : <?=$report_number?></h3></div>
	<div class="col-md-12">
		<br/><label>Event / Request Name: </label><br/>
		<input type="text" name="request_name" class="form-control" value="<?=$event_name?>" />
		<span class="error_message" id="request_name" style="display: none">message error</span>						
	</div>

	<div class="col-md-12">
		<br/><label>Request By: </label><br/>
		<input type="text" name="request_by" class="form-control" value="<?=$user_create?>"/>
		<span class="error_message" id="request_by" style="display: none">message error</span>						
	</div>

	<div class="col-md-12">
		<br/><label>Activity</label><br/>
		<textarea id="request_textarea" name="activity" class="form-control" rows="30">
			<?=$event_detail?>
		</textarea><br/>
		<span class="error_message" id="activity" style="display: none">message error</span>	
	</div>

	<div class="col-md-12">
		<br/><label>Location</label><br/>
		<select id="location4" name="location" class="form-control" style="width: 100%;"></select><br/>	
		<span class="error_message" id="location" style="display: none">message error</span>
	</div>

	<div class="col-md-12">
		<br/><label>Reporter</label><br/>
		<select id="reporter4" name="reporter" class="form-control" style="width: 100%;"></select><br/>
		<span class="error_message" id="reporter" style="display: none;">message error</span><br/>
		<button type="button" class="btn btn-primary btn-xs add_reporter" data="reporter4">add reporter</button><br/><br/> 
		<div class="list_data_reporter" name="reporter">
			<?php foreach($reporter as $data) {?>
				<?php $dataReporter = explode("_",$data['id_reporter']); ?>
				<?php $idReporter = $dataReporter[0]; ?>
				<?php $namaReporter = $dataReporter[1]; ?>
				<div class="alert alert-info col-md-4 data_reporter" data="<?=$idReporter?>" style="margin-right: 3px;">
					<i class="fa fa-user"></i>
					<button type="button" class="close btn_delete_reporter" data-dismiss="alert">&times;</button>
					<?=$namaReporter;?>
				</div>
			<?php }?>	
		</div>			
	</div>

	<div class="col-md-12">
		<br/><label>Email to</label><br/>
		<input type="text" class="form-control email emails"  />
		<span class="error_message" id="emails" style="display: none;">message error</span><br/>
		<span class="message_validate"></span>
		<div class="list_email col-md-12"></div>
	</div>
					

	<div class="col-md-12">
		<label>Request Start:</label><br>

		<div class='input-group date'>
			<?php  $datetime = new DateTime( $start_time );   ?>
	  		<input type="text" name="start_time" id="start_time_request" class="form-control start_time" value="<?php echo $datetime->format('Y-m-d H:i:s'); ?>"></input><br>
	  		 <span class="input-group-addon">
			    <span class="glyphicon glyphicon-calendar"></span>
			 </span>
		</div>
		
		<span class="error_message" id="start_time" style="display: none">message error</span>
						
	</div>

	
	
	<div class="col-md-12">
		<label>Request End:</label><br>
		<div class='input-group date'>
			<?php  $datetime = new DateTime( $start_time );   ?>
	  		<input type="text" name="end_time" id="end_time_request" class="form-control end_time" value="<?php echo $datetime->format('Y-m-d H:i:s'); ?>"></input><br>
	  		<span class="input-group-addon">
			    <span class="glyphicon glyphicon-calendar"></span>
			 </span>
		</div>
		
		<span class="error_message" id="end_time" style="display: none">message error</span>
	</div>

	<div class="col-md-12">
		<br/><label>Status</label><br/>
		<select name="status" class="form-control"></select><br/>
		<span class="error_message" id="status" style="display: none">message error</span>	
	</div>

	<div class="col-md-12">
		<br/><label>Note</label><br/> 
		<textarea id="note_request" name="note" class="form-control" rows="10">
			<?=$note ?>
		</textarea><br/>	
	</div>
	
	<div class="col-md-12">
		<br/><input type="submit" class="btn btn-primary" value="save & update"/>&nbsp;
		<input type="reset" id="request" name="btn_cancel" class="btn btn-danger" value="back" onclick="window.location='<?=base_url()?>index.php/EventReport/tableEvent' "/>&nbsp;
	</div>
</form>

<script>
	$(document).ready(function(){

		showOptionLocation();
		$("#location4").append( "<option value='<?=$id_location?>' > <?=$location?> </option>" );
		showOptionOperator();
		$("#reporter4").append("<option value='<?=$reporter[0]['id_reporter']?>'><?=$reporter[0]['nama_reporter']?></option>");
		showOptionStatus();
		showListEmail();

		$('#start_time_request').datetimepicker({
			format:"Y-m-d H:i:s"	
		});
		
		$('#end_time_request').datetimepicker({
			format:"Y-m-d H:i:s"	
		});

	});

	$(document).on("click",".add_reporter",function(){

	   	id=$(this).attr("data");
	   	//alert(id);
	  	dataReporter=$("#"+id).val().split("_");

	  	console.log(dataReporter);
	  	reporterId=dataReporter[0];
	  	reporterName=dataReporter[1];
	  	
	  	data_list = $(".data_reporter");
		//alert(data_list.length);				  			
		reporter=0;
		for(a=0;a<data_list.length;a++){
			if(reporterId == data_list.eq(a).attr('data') )
			{				  					
				reporter++;
				break;
			}
		}

		if(reporter == 0)
		{
					  				

			list="<div data='"+reporterId+"' class='alert alert-info col-md-4 data_reporter' style='margin-right: 3px;' >";
			list+="<i class='fa fa-user'></i>&nbsp;";
			list+=reporterId+" - "+reporterName;
			list+="<button title='"+reporterId+"' class='close btn_delete_reporter' data-dismiss='alert'>&times</button>";
			list+="</div>";

						  			
			$(".list_data_reporter").append(list);
		}

   });

	$(document).on("submit","#request_form",function(event){
		event.preventDefault();
		process_type="update";
		
		
		data_input = $(this).serialize();		
  		//total list email dikalikan 4 karena atribut name pada formnya sama !!
  		total_email =$(".list_data_email").length;
  		list_email =[];
  		for(a=0;a<total_email;a++)
  		{
  			list_email.push( $(".list_data_email").eq(a).attr('data') );
  		}

  		list_fixed_email=[];
  		for(let i = 0;i < list_email.length; i++)
  		{
	        if(list_fixed_email.indexOf(list_email[i]) == -1){
	            list_fixed_email.push(list_email[i]);
	        }
	    }

	    type_report = $(this).attr("data");
	    data_location = $("#location"+type_report).val();
	    data_reporter = $("#reporter"+type_report).val();

	    if(data_location == null)
	    {
	    	data_location="0";
	    }

	    /*if(data_reporter == null)
	    {
	    	data_reporter="0";
	    }
	    
	    data_input += "&emails="+list_fixed_email+"&location="+data_location+"&reporter="+data_reporter;*/

	    data_reporter=[];
		//total list enginer dikalikan 2 karena atribut name pada formnya sama !!
		list_reporter = $(".data_reporter");
		for(a=0;a<list_reporter.length;a++)
		{
		    		
			data_reporter.push( $(".data_reporter").eq(a).attr('data') );
		}

		list_fixed_reporter=[];
		for(let i = 0;i < data_reporter.length; i++)
		{
		    if(list_fixed_reporter.indexOf(data_reporter[i]) == -1){
		        list_fixed_reporter.push(data_reporter[i]);
		    }
		}

		data_input += "&emails="+list_fixed_email+"&location="+data_location+"&reporter="+list_fixed_reporter;

	   

	     if( type_report == "1" || type_report == "2")
		    {
		    	data_enginer=[];
		    	//total list enginer dikalikan 2 karena atribut name pada formnya sama !!
		    	list_enginer = $(".list_data_enginer");
		    	for(a=0;a<list_enginer.length;a++)
		    	{
		    		
		    		data_enginer.push( $(".list_data_enginer").eq(a).attr('data') );
		    	}

		    	list_fixed_enginer=[];
		  		for(let i = 0;i < data_enginer.length; i++)
		  		{
			        if(list_fixed_enginer.indexOf(data_enginer[i]) == -1){
			            list_fixed_enginer.push(data_enginer[i]);
			        }
			    }

		    	data_input += "&enginer="+list_fixed_enginer;

		    	//alert(list_fixed_enginer); 
		    }

	    data_row_id = "<?=$id_event?>";
	    data_input += "&id_db="+data_row_id;

	    data_form_number="<?=$report_number?>";
	    //data_input += "&report_number="+data_form_number;
	    data_input += "&report_number="+data_form_number+"&process_type="+process_type;

	    

		$.ajax({
			// url:"<?=base_url()?>index.php/EventReport/updateData",
			url:"<?=base_url()?>index.php/EventReport/validation",
			type:"post",
			data:data_input,
			dataType:"json",
			error:function()
			{
				alert("update failed !!");
				 //$("#ajax_loader").hide();
				 //$("#error_alert").show(1000);
				 //$("#error_message").html("update failed !!");
			},
			beforeSend:function()
			{
				
				$("#ajax_loader").show();
			},
			success:function(response)
			{
				//alert(response.results);
				$("#process_alert").slideUp("slow");
				$("#process_message").html("");
				
				$("#ajax_loader").hide();

				
				message_element = $(".error_message");
					
				for(a=0;a<message_element.length;a++)
				{	
						
					message_element.eq(a).slideUp('slow');			
				}

				

				if(response.results==true)
				{
					//window.location.href="<?=base_url()?>index.php/Dashboard/tableEvent";
					$("#process_alert").addClass("alert-warning").slideDown("slow");
					style_message={"color":"white","font-weight":"bold"};
					$("#process_message").html(" DATA SAVED !").css(style_message);

				}else{

						
						
							response_empty_field=response.field;
							//message_element = $(".error_message");
							for(a=0;a<message_element.length;a++)
							{
								for(i=0;i<response_empty_field.length;i++)
								{
									dataId=message_element.eq(a).attr("id");
									
									if( response_empty_field[i] == dataId )
									{
										styleError={'color':'red','font-weight':'bold'};
										message_element.eq(a).html('required').css(styleError);
										message_element.eq(a).slideDown('slow');
									}
								}
							}

						$("#process_alert").removeClass("alert-warning")	
						$("#process_alert").addClass("alert-danger").slideDown("slow");
						style_message={"color":"white","font-weight":"bold"};
						$("#process_message").html(" FAILED UPDATE DATA !").css(style_message);
					
					
				}
				
				
			}
		});
	});

	function showListEmail()
	{
		data_email="<?=$emails?>";
		findSeparator = data_email.indexOf(",");
		
		emails = data_email.split(",");
		//alert(emails.length);

		if( emails[0] !="" )
		{	

			for(a=0;a<emails.length;a++)
			{
				list="<div data='"+emails[a]+"' class='alert alert-danger col-md-5 list_data_email' style='margin-top:5px;margin-right:5px;'>";
				list+="<i class='fa fa-envelope'></i>&nbsp;";
				list+=emails[a];
				list+="<button title='"+emails[a]+"' class='close btn_delete_email' data-dismiss='alert'>&times</button>";
				list+="</div>";
				$(".list_email").append(list);
			}
		}
	}

	$(document).on("click",".btn_delete_email",function(){
	 	//alert();
	 	data_id=$(this).attr("title"); 	
	 	element=$(".list_data_email");
	 	

	 	for(a=0;a<element.length;a++)
	 	{
	 		if( element.eq(a).attr('data') == data_id )
	 		{
	 			element.eq(a).remove();
	 		}
	 	}
	 	
	 	
	 })

	$(document).on("keydown",".email",function(event){

	  		char = event.which?event.which:event.keyCode;  		
	  		if(char ==13)
	  		{
	  			
	  			event.preventDefault();
	  		}

	  			//alert(char);
	  			dataInput = $(this).val();
		  		$.ajax({
		  			
		  			url:"<?=base_url()?>index.php/EventReport/validasiEmail",
		  			data:{"parameter":dataInput},
		  			type:"post",
		  			dataType:"json",
		  			beforeSend:function()
		  			{
		  				$(".message_validate").html("<i>please wait..</i>");
		  			},
		  			error:function()
		  			{
		  				$(".message_validate").html("error process");
		  				$(".message_validate").css("color","red");
		  			},
		  			success:function(response)
		  			{
		  				if(response.data==true)
		  				{
		  					$(".message_validate").html("email valid ");
		  					$(".message_validate").css("color","blue");

		  					if(char ==13)
					  		{
					  			
					  			event.preventDefault();

					  			data_list = $(".list_data_email");				  			
					  			email=0;
					  			for(a=0;a<data_list.length;a++){
					  				if(dataInput == data_list.eq(a).attr('data') )
					  				{				  					
					  					email++;
					  					break;
					  				}
					  			}

					  			//alert(email);

					  			if(email == 0)
					  			{
					  				list="<div data='"+dataInput+"' class='alert alert-danger col-md-5 list_data_email' style='margin-top:5px;margin-right:5px;'>";

						  			list+="<i class='fa fa-envelope'></i>&nbsp;";
						  			list+=dataInput;
						  			list+="<button title='"+dataInput+"' class='close btn_delete_email' data-dismiss='alert'>&times</button>";
						  			list+="</div>";

						  			$(".list_email").append(list);
					  			}
					  			
					  			$(".email").val('');				  			
					  		}

		  				}else{
		  					$(".message_validate").html("email not valid ! ");
		  					$(".message_validate").css("color","red");
		  				}
		  			}
		  		});
	  })

	function showOptionStatus() 
	{
		

		 $.ajax({
		 	url:"<?=base_url()?>index.php/EventReport/getDataStatus",
		 	type:"get",
		 	dataType:"json",
		 	error:function()
		 	{
		 		alert("data status report not set !!");
		 	},
		 	success:function(response)
		 	{
		 		data_status="<?=$status ?>";
				//alert(data_status);

		 		option = "<option value='0'>--pilih--</option>";
		 		$("select[name=status]").append(option);
		 		for(a=0;a<response.data.length;a++){

		 			if(response.data[a].status == data_status)
		 			{
		 				option = "<option value="+response.data[a].id+" selected >"+response.data[a].status+"</option>";
		 			$("select[name=status]").append(option);
		 			}else{

		 				option = "<option value="+response.data[a].id+">"+response.data[a].status+"</option>";
		 			$("select[name=status]").append(option);
		 			
		 			}	
		 			
		 		}
		 		
		 	}
		 })	
	}

	function showOptionLocation()
		{
			$("select[name=location]").select2({
				minimumInputLength:3,
				allowClear:true,
				placeholder:"minimum typing 3 character",
				

				ajax:{
					url:"<?=base_url()?>index.php/EventReport/getOptionLocation",
					dataType:"json",
					data:function(param){
						return{
							parameter:param.term
						}
					},
					processResults:function(data)
					{
						return {
							results:data
						}
					}
				}
			});
		}

	function showOptionOperator()
	{
		$("select[name=reporter]").select2({
			minimumInputLength:3,
			allowClear:true,
			placeholder:"minimum typing 3 character",

			ajax:{
					url:"<?=base_url()?>index.php/EventReport/getDataOperator",
					dataType:'json',
					data:function(params)
					{
						//console.log(params.term);
						return {
							parameter:params.term
						}
					},
					processResults:function(data)
					{
						return {
							results:data
						}
					}
				}

		});
	}

</script>