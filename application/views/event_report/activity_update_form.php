<form class="col-md-12 formChild" id="activity_form" data="3">
	<input type="hidden" name="type_report" value="3"/>
	<div class="col-md-12"><h3>Number Form : <?=$report_number?></h3></div>
	<div class="col-md-12">
		<br/><label>Activity Name: </label><br/>
		<input type="text" name="activity_name" class="form-control" value="<?=$event_name?>"/>
		<span class="error_message" id="activity_name" style="display: none">message error</span>							
	</div><br><br><br><br><br><br><br><br>

	<div class="col-md-12 formChild">
		<label>Activity Start:</label><br>
		<div class='input-group date'>
	  		<input type="text" name="start_time" id="start_time_activity" class="form-control start_time" value="<?=$start_time?>"></input><br>
	  		<span class="input-group-addon">
			     <span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
		
		<span class="error_message" id="start_time" style="display: none">message error</span>
						
	</div>

	<div class="col-md-12 formChild">
		<label>Activity End:</label><br>
		<div class='input-group date'>
			<input type="text" name="end_time" id="end_time_activity" class="form-control end_time" value="<?=$end_time?>"></input><br>
			<span class="input-group-addon">
			     <span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
	  	
		<span class="error_message" id="end_time" style="display: none">message error</span>						
	</div>


	<div class="col-md-12 formChild">
		<br/><label>Request By: </label><br/>
		<input type="text" name="request_by" class="form-control" value="<?=$user_create?>"/>
		<span class="error_message" id="request_by" style="display: none">message error</span>							
	</div>

	<div class="col-md-12 formChild">
		<label>activity</label><br/>
		<textarea id="activity_textarea" name="activity" class="form-control" rows="30">
			<?=$event_detail?>
		</textarea><br/>
		<span class="error_message" id="activity" style="display: none">message error</span>		
	</div>

	<div class="col-md-12 formChild">
		<label>Location</label><br/>
		<select id="location3" name="location" class="form-control" style="width: 100%;"></select><br/>
		<span class="error_message" id="location" style="display: none">message error</span>		
	</div>

	<div class="col-md-12 formChild">
		<label>reporter</label><br/>
		<select id="reporter3" name="reporter" class="form-control" style="width: 100%;"></select><br/>	
		<span class="error_message" id="reporter" style="display: none;">message error</span><br/>
		<button type="button" class="btn btn-primary btn-xs add_reporter" data="reporter3">
		<i class="fa fa-user"></i>	
			add reporter
		</button><br/><br/> 
		<div class="list_data_reporter" name="reporter">
			<!-- <?php foreach($reporter as $data) {?>
				<?php $dataReporter = explode("_",$data['id_reporter']); ?>
				<?php $idReporter = $dataReporter[0]; ?>
				<?php $namaReporter = $dataReporter[1]; ?>
				<div class="alert alert-info col-md-2 data_reporter" data="<?=$idReporter?>" style="margin-right: 3px;">
					<i class="fa fa-user"></i>
					<button type="button" class="close btn_delete_reporter" data-dismiss="alert">&times;</button>
					<?=$namaReporter;?>
				</div>
			<?php }?> -->

			<?php foreach($reporter as $data) {?>
				<?php $dataReporter = explode("_",$data['id_reporter']); ?>
				<?php $idReporter = $dataReporter[0]; ?>
				<?php $namaReporter = $dataReporter[1]; ?>
				<div class="data_reporter" data="<?=$idReporter?>" style="margin-right: 3px;">
					<i class="fa fa-user"></i>
					<?=$namaReporter;?>
					&nbsp;<span title="<?=$idReporter?>" class="glyphicon glyphicon-trash btn_delete_reporter" style="cursor:pointer"></span>
				</div>
			<?php }?>

		</div>		
	</div>

	<div class="col-md-12 formChild">
		<label>Email to</label><br/>
		<input type="text" class="form-control email emails "  />
		<span class="error_message" id="emails" style="display: none">message error</span><br>	
		<span class="message_validate"></span><br>
		<div class="list_email"></div>
	</div>

	<div class="col-md-12 formChild">
		<label>Status</label><br/>
		<select name="status" class="form-control"></select><br/>
		<span class="error_message" id="status" style="display: none">message error</span><br>		
	</div>

	<div class="col-md-12 formChild">
		<label>Note</label><br/> 
		<textarea id="note_activity" name="note" class="form-control" rows="10">
			<?=$note ?>
		</textarea><br/>	
	</div>

	<div class="col-md-12 formChild">
		<label>Attachment : </label><br/>
		<div style="position:relative;">
				<div class='btn btn-primary'>
				<span class="fa fa-paperclip"></span>
					Choose File...
					<input class="update_file_attach" id="file_attach_activity_update" type="file" style='position:absolute;top:0;left:0;opacity: 0;height: 35px;cursor: pointer' name="file_source[]" size="40"  multiple="multiple" >
				</div>
			&nbsp;
							
		</div>
		<span class="error_message" id="request_attachment" style="display: none">message error</span><br>	
		
		

		 <div class="upload_file_info" data="file_attach_activity_update" style="margin-top: 10px;">
		 	<?php if(count($attachment)!=0 ){ ?>

		 		<?php foreach( $attachment as $key ){ ?>
		 			<?php $data=explode("/", $key->url) ?>
		 			<?php $data_id=explode("-", $data[1]) ?>
		 			<?php $data_index=count($data_id) ?>
		 			<?php $url= $key->url ?>
		 			<p id="link_<?=$key->id_files?>">
		 				<i class="glyphicon glyphicon-file"></i>
		 				<a href="<?=base_url($url)?>" class="p-list-attach" data="<?=$data_id[ $data_index-1 ] ?>" ><?=$data[1] ?></a>&nbsp;
		 				<i class="glyphicon glyphicon-trash btn_delete_attachment" id="<?=$key->id_files?>" style="cursor:pointer;"></i>
		 				
		 			</p>
		 		<?php } ?>
		 	<?php } ?>
		 </div>
		
		<input type="hidden" value="" id="data_delete_attachment"></input>	

	</div>

	 
	
	<div class="col-md-12 formChild">
		<br/><button type="submit" class="btn btn-primary">
		<span class="fa fa-floppy-o"></span>
			save & update
		</button>&nbsp;
		<button type="reset" id="activity" name="btn_cancel" class="btn btn-danger" onclick="window.location='<?=base_url()?>index.php/EventReport/tableEvent' ">
		<span class="glyphicon glyphicon-backward"></span>	
			back
		</button>&nbsp;
	</div>
</form>


<script>
	$(document).ready(function(){



		showOptionLocation();
		$("#location3").append( "<option value='<?=$id_location?>' > <?=$location?> </option>" );
		showOptionOperator();
		$("#reporter3").append("<option value='<?=$reporter[0]['id_reporter']?>'><?=$reporter[0]['nama_reporter']?></option>");
		showOptionStatus();
		showListEmail();

		$('#start_time_activity').datetimepicker({
			format:"Y-m-d H:i:s"	
		});
		
		$('#end_time_activity').datetimepicker({
			format:"Y-m-d H:i:s"	
		});

	});

	$(document).on("click",".new-p-list-attach",function(){
		//alert( $(this).attr("data"));
		$(this).remove();
	});

	$(document).on("click",".btn_delete_attachment",function(){
		id_attachment=$(this).attr("id");
		
		data_delete=$("#data_delete_attachment").val();
		if(data_delete=="")
		{
			data_id=id_attachment;

		}else{
			data_id=data_delete+","+id_attachment;
		}

		$("#link_"+id_attachment).remove();

		$("#data_delete_attachment").val(data_id);
	})

	 $(document).on("click",".btn_delete_reporter",function(){
 		
	 	data_id=$(this).attr("title");
	 	element=$(".data_reporter");
	 	for(a=0;a<element.length;a++)
	 	{
	 		if( element.eq(a).attr('data') == data_id )
	 		{
	 			element.eq(a).remove();
	 		}
	 	}
	 	
	 	
	 })



	$(document).on("change",".update_file_attach",function(event){
  		id=$(this).attr("id");
  		//alert(id);
		
  		newTotalFile=document.getElementById(id).files.length;

  		newDataFile="";
  		for(a=0;a<newTotalFile;a++)
  		{
  			idFile="file"+a;
  			idArea="area"+id;


  			fileName=document.getElementById(id).files[a].name;
  			

  			newDataFile +="<div class='new-p-list-attach' style='display:block;cursor:pointer;color:blue;font-weight:bold;margin-bottom:10px;' id='"+idFile+"' data='"+fileName+"'>";
  			newDataFile +="<span class='glyphicon glyphicon-file'></span>";
  			newDataFile += fileName;
  			newDataFile +="</div>";

  		}

  		file_info=$(".upload_file_info");

  		for(a=0;a<file_info.length;a++)
  		{
  			if(	file_info.eq(a).attr('data') == id)
  			{
  				//file_info.eq(a).html(newDataFile);
  				file_info.eq(a).append(newDataFile);
  			}
  		}
	
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
					  				

			/*list="<div data='"+reporterId+"' class='alert alert-info col-md-2 data_reporter' style='margin-right: 3px;' >";
			list+="<i class='fa fa-user'></i>&nbsp;";
			list+=reporterId+" - "+reporterName;
			list+="<button title='"+reporterId+"' class='close btn_delete_reporter' data-dismiss='alert'>&times</button>";
			list+="</div>";				  			
			$(".list_data_reporter").append(list);*/

			list="<div data='"+reporterId+"' class='data_reporter' >";
			list+="<i class='fa fa-user'></i>&nbsp;";
			list+=reporterId+" - "+reporterName;
			list+="<span title='"+reporterId+"' class='glyphicon glyphicon-trash btn_delete_reporter' style='cursor:pointer'></span>";
			list+="</div>";						  			
			$(".list_data_reporter").append(list);
		}

   });

	$(document).on("submit","#activity_form",function(event){
		event.preventDefault();
		process_type="update";
		
		
		//data_input = $(this).serialize();
		data_input = new FormData(this);		
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

		//console.log(list_fixed_reporter);

		//data_input += "&emails="+list_fixed_email+"&location="+data_location+"&reporter="+list_fixed_reporter;
		data_input.append("emails",list_fixed_email);
		data_input.append("location",data_location);
		data_input.append("reporter",list_fixed_reporter);

	   

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

		    	//data_input += "&enginer="+list_fixed_enginer;
		    	data_input.append("enginer",list_fixed_enginer);
		    	
		    }

	    data_row_id = "<?=$id_event?>";
	    //data_input += "&id_db="+data_row_id;
	    data_input.append("id_db",data_row_id);

	    data_form_number="<?=$report_number?>";
	    //data_input += "&report_number="+data_form_number+"&process_type="+process_type;
	    data_input.append("report_number",data_form_number);
	    data_input.append("process_type",process_type);

	    data_input.append("list_delete_attachment", $("#data_delete_attachment").val() );
	    console.log( $("#data_delete_attachment").val() );
	    

	     /*
		::========================================
		:: collecting list file attchment 
		::======================================
	    */

	   
  		dataAttachment= $(".new-p-list-attach");

  		//total list attachment dikalikan 2 karena atribut name / class pada formnya sama !!
  		list_attach=[];
  		for(a=0;a<dataAttachment.length;a++)
  		{
  			data=dataAttachment.eq(a).attr("data");
  			list_attach.push(data);
  			
  		}

  		list_fixed_attach=[];
	  	for(let i = 0;i < dataAttachment.length; i++)
	  	{
		       if(list_fixed_attach.indexOf(list_attach[i]) == -1){
		           list_fixed_attach.push(list_attach[i]);
		       }
		   }

  		//console.log(list_fixed_attach);
  		data_input.append("data_add_attachment", list_fixed_attach );

	    

		$.ajax({
			// url:"<?=base_url()?>index.php/EventReport/updateData",
			contentType:false,
			processData:false,
			url:"<?=base_url()?>index.php/EventReport/validation",
			type:"post",
			data:data_input,
			dataType:"json",
			error:function()
			{
				//alert("update failed !!");
				 $("#ajax_loader").hide();
				 //$("#error_alert").show(1000);
				 //$("#error_message").html("update failed !!");
			},
			beforeSend:function()
			{
				
				$("#ajax_loader").show();
			},
			success:function(response)
			{

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
					$("#process_alert").addClass("alert-warning").slideDown("slow");
					style_message={"color":"white","font-weight":"bold"};
					$("#process_message").html(" DATA SAVED !").css(style_message);
					$("#data_delete_attachment").val('');

					if( list_attach.length !=0 )
					{
						refreshDataLink(data_row_id);	
					}	
	
				}else{
	
							response_empty_field=response.field;
			
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

	

	function refreshDataLink(id_event)
	{
		
		$.ajax({
		  			
		  			url:"<?=base_url()?>index.php/EventReport/updateListAttachment",
		  			data:{"id_event":id_event},
		  			type:"post",
		  			dataType:"json",
		  			beforeSend:function()
		  			{
		  				$(".upload_file_info").html("<i>please wait..</i>");
		  			},
		  			error:function()
		  			{
		  				
		  				$(".upload_file_info").html("failed to refresh link");
		  			},
		  			success:function(response)
		  			{
		  				$(".upload_file_info").html(response.newLink);	
		  			}
		  		});
	  
	}


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
				/*list="<div data='"+emails[a]+"' class='alert alert-info col-md-5 list_data_email' style='margin-top:5px;margin-right:5px;'>";
				list+="<i class='fa fa-envelope'></i>&nbsp;";
				list+=emails[a];
				list+="<button title='"+emails[a]+"' class='close btn_delete_email' data-dismiss='alert'>&times</button>";
				list+="</div>";
				$(".list_email").append(list);*/

				list="<div data='"+emails[a]+"' class='list_data_email' style='margin-top:5px;margin-right:5px;'>";
				list+="<i class='fa fa-envelope'></i>&nbsp;";
				list+=emails[a];
				list+="&nbsp;<span title='"+emails[a]+"' class='glyphicon glyphicon-trash btn_delete_email' style='cursor:pointer;'></span>";
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
					  				/*list="<div data='"+dataInput+"' class='alert alert-info col-md-5 list_data_email' style='margin-top:5px;margin-right:5px;'>";
						  			list+="<i class='fa fa-envelope'></i>&nbsp;";
						  			list+=dataInput;
						  			list+="<button title='"+dataInput+"' class='close btn_delete_email' data-dismiss='alert'>&times</button>";
						  			list+="</div>";
						  			$(".list_email").append(list);*/

						  			list="<div data='"+dataInput+"' class='list_data_email' style='margin-top:5px;margin-right:5px;'>";
						  			list+="<i class='fa fa-envelope'></i>&nbsp;";
						  			list+=dataInput;
						  			list+="<span title='"+dataInput+"' class='glyphicon glyphicon-trash btn_delete_email' style='cursor:pointer'></span>";
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
				placeholder:"minimum typing 3 character ",
				

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