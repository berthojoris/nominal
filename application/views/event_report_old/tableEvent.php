
<script src="<?=base_url()?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.datetimepicker.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.datetimepicker.css">






<style>
a {color : #777777;}



</style>


<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        
       <li><a href="<?php echo base_url().'index.php/Dashboard/tableEvent/' ?>">Event Report</a></li>
        <li class="active" style="color: #3C8DBC;">list Report</li>
      </ol>
    </div>
</section>

<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Event Report <?php echo strtoupper($this->uri->segment(3));?></div>
        <div class="panel-body">

        	<div id="warning" style="display: none;"></div>

            <div class="box-body table-responsive no-padding">           		
				  <div class="col-md-3" style="clear:both;">
				  	
				  	<button id="button_add_event" type="button" class="btn btn-primary dropdown-toggle" data="closed">
				  		<i class="fa fa-th-list"></i>	
				        Add Event 
				    </button>
				    <div id="type_report" style="display: none;"></div>
				   

				    <br/><br/>
				  
				  </div>
			  <br/><br/>
	              <div style="clear:both;">
	              	<table class="table table-bordered table-striped table-hover text-center" id="table_data_event">
		                <thead>
		                  <tr>
		                    <th>no</th>  
		                    <th>type</th>
		                    <th>report_number</th>
		                    <th>event_name</th>
		                    <th>event_start</th>
		                    <th>status</th>
		                    <th>action</th>
		                  </tr>
		                </thead>
		                <tbody></tbody>

		             </table>
	              </div>            
            </div>
        </div>
    </div>        
</div>
</section>








<!-- form planned & maintenance -->
<div class="modal fade" id="form_plan_maintenance" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h3>
					<i class="fa fa-th-list"></i>	
					Add Planed & Maintenance
					<button class="close" data-dismiss="modal" style="color:white;font-size:30px;font-weight:bold">&times;</button>
				</h3>
				
			</div>

			<div class="modal-body col-md-12">
	
				<form class="col-md-12" id="plan_and_maintenance_form" data="1">
					<input type="hidden" name="type_report" value="1"/>
					<div class="col-md-12">
						<br/><label>Plan Name: </label><br/>
						<input type="text" name="plan_name" class="form-control plan_name"/>
						<span class="error_message" id="plan_name" style="display: none">message error</span>
					</div>
					<div class="col-md-12">
						<label>Location</label><br/>
						<div class="location" id='divarea_location_plan' style="width: 100%;padding:1px;border-radius:5px; ">
							<select id="location1" name="location" class="form-control" style="width: 100%;"></select><br/>	
						</div>						
						<span class="error_message" id="location" style="display: none">message error</span>	
					</div>
					<div class="col-md-12">
						<label>plan detail</label><br/>
						<div class="activity" style="width: 100%;height:354px;padding:1px 3px 1px 1px;border-radius:3px; ">
							<textarea id="plan_detail_textarea" name="activity" class="form-control" rows="30"></textarea><br/>
						</div>
						<span class="error_message" id="activity" style="display: none">message error</span>	
					</div><br><br>
					<div class="col-md-12">
						<label>Begin Time:</label><br>
						<div class='input-group date'>
							<input type="text" name="start_time" id="start_time_plan" class="form-control start_time"></input><br>
							<span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                 </span>
						</div>						 
						 <span class="error_message" id="start_time" style="display: none">message error</span>	
					</div>
					<div class="col-md-12">
						<label>End Time:</label><br>
						<div class='input-group date'>
							 <input type="text" name="end_time" id="end_time_plan" class="form-control end_time"></input><br>
							 <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                 </span>

						</div>
						
						 <span class="error_message" id="end_time" style="display: none">message error</span>
						
					</div>

					<div class="col-md-12">
						
						<label>Enginer</label><br/>
						<div class="enginer" id="divarea_enginer_plan" style="width: 100%;height:30px;padding:1px;border-radius:5px; ">
							<select id="enginer1" name="enginer" class="form-control" style="width: 100%;"></select><br/><br/>
						</div>
						<span class="error_message" id="enginer" style="display: none">message error</span><br>		
						<button type="button" class="btn btn-primary btn-xs add_enginer" data="enginer1">add enginer</button><br/><br/> 
						<div class="list_data_enginer" name="enginer"></div>
						
					</div>

					<div class="col-md-12">
						<label>reporter</label><br/>
						<div class="reporter" id="divarea_reporter_plan" style="width: 100%;padding:1px;border-radius:5px; ">
							<select id="reporter1" name="reporter" class="form-control" style="width: 100%;"></select><br/>
						</div>	
						<span class="error_message" id="reporter" style="display: none;">message error</span><br>

						<button type="button" class="btn btn-primary btn-xs add_reporter" data="reporter1">add reporter</button><br/><br/> 
						<div class="list_data_reporter" name="reporter"></div>

					</div>

					<div class="col-md-12">
						<label>Email to</label><br/>
						<!-- there is 2 class !!! email to handle event keydown and emails to handle error submit -->
						<input type="text" class="form-control email emails"  />
						<span class="message_validate"></span><br>
						<div class="list_email col-md-12"></div>
						<span class="error_message" id="emails" style="display: none">message error</span>

					</div>

					
					
					<div class="col-md-12">
						<label>Status</label><br/>
						<select name="status" class="form-control status"></select><br/>
						<span class="error_message" id="status" style="display: none">message error</span>	
					</div>

					<div class="col-md-12">
						<label>note ( optional ) </label><br/>
						<div class="note" style="width: 100%;height:354px;padding:1px 3px 1px 1px;border-radius:3px; "> 
							<textarea id="note_planned" name="note" class="form-control" rows="10"></textarea><br/>
						</div>
						<span class="error_message" id="note" style="display: none">message error</span>		
					</div>

					<div class="col-md-12">
						<br/><input type="submit" class="btn btn-primary" value="Add Plan"/>&nbsp;
						<input type="reset" id="plan" name="btn_cancel" class="btn btn-danger" value="cancel"/>&nbsp;
						
					</div>
				</form>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<!-- [end] planned & maintenance -->

<!-- form incident -->
<div class="modal fade" id="form_incident_event" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h3>
					<i class="fa fa-th-list"></i>	
					Add Event incident
					<button class="close" data-dismiss="modal" style="color:white;font-size:30px;font-weight:bold">&times;</button>
				</h3>
				
			</div>
			<div class="modal-body col-md-12">	
				<form class="col-md-12" id="incident_form" data="2">
					<input type="hidden" name="type_report" value="2"/>
					
					<div class="col-md-12">
						<br/><label>Incident Name: </label><br/>
						<input type="text" name="incident_name" class="form-control incident_name"/>
						<span class="error_message" id="incident_name" style="display: none">message error</span>						
					</div>

					

					

					<div class="col-md-12">
						<label>Incident start:</label><br>
						<div class='input-group date'>
							<input type="text" name="start_time" id="start_time_incident" class="form-control start_time"></input><br>
							 <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                 </span>
						</div>
						 
						 <span class="error_message" id="start_time" style="display: none">message error</span>
						
					</div>

					

					<div class="col-md-12">
						<label>Incident End:</label><br>
						<div class='input-group date'>
							<input type="text" name="end_time" id="end_time_incident" class="form-control end_time"></input><br>
							<span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                 </span>
						</div>
						 
						 <span class="error_message" id="end_time" style="display: none">message error</span>
						
					</div>

					<div class="col-md-12">
						<br/><label>Impact: </label><br/>
						<input type="text" name="impact" class="form-control impact"/>
						<span class="error_message" id="impact" style="display: none">message error</span>							
					</div>
					<div class="col-md-12">
						<label>Root cause</label><br/>
						<div class="root_cause" style="width: 100%;height:354px;padding:1px 3px 1px 1px;border-radius:3px; ">
							<textarea id="root_cause_textarea" name="root_cause" class="form-control root_cause" rows="30"></textarea><br/>
						</div>
						<span class="error_message" id="root_cause" style="display: none">message error</span>		
					</div>
					<div class="col-md-12">
						<label>Action</label><br/>
						<div class="action" style="width: 100%;height:354px;padding:1px 3px 1px 1px;border-radius:3px; ">
							<textarea id="action_textarea" name="action" class="form-control" rows="30"></textarea><br/>
						</div>
						<span class="error_message" id="action" style="display: none">message error</span>	
					</div> 
					<div class="col-md-12">
						<label>Location</label><br/>
						<div class="location" id="divarea_location_incident" style="width: 100%;padding:1px;border-radius:5px; ">
							<select id="location2" name="location" class="form-control" style="width: 100%;"></select><br/>
						</div>
						<span class="error_message" id="location" style="display: none;">message error</span>			
					</div>
					<div class="col-md-12">
						<label>Esclate to Enginer</label><br/>
						<div class="enginer" id="divarea_enginer_incident" style="width: 100%;height:30px;padding:1px;border-radius:5px; ">
							<select id="enginer2" name="enginer" class="form-control" style="width: 100%;"></select><br/><br/>
						</div>
						<span class="error_message" id="enginer" style="display: none;">message error</span><br>	
						<button type="button" class="btn btn-primary btn-xs add_enginer" data="enginer2">add enginer</button><br/><br/>
						
						<div class="list_data_enginer" name="enginer"></div>
					</div>
					<div class="col-md-12">
						<label>reporter</label><br/>
						<div class="reporter" id="divarea_reporter_incident" style="width: 100%;padding:1px;border-radius:5px; ">
							<select id="reporter2" name="reporter" class="form-control reporter" style="width: 100%;"></select><br/>
						</div>
						<span class="error_message" id="reporter" style="display: none;">message error</span><br/>

						<button type="button" class="btn btn-primary btn-xs add_reporter" data="reporter2">add reporter</button><br/><br/> 
						<div class="list_data_reporter" name="reporter"></div>

					</div>
					<div class="col-md-12">
						<label>Email to</label><br/>
						<!-- there is 2 class !!! email to handle event keydown and emails to handle error submit -->
						<input type="text" class="form-control email emails"  />
						<span class="message_validate"></span><br>
						<div class="list_email col-md-12"></div>
						<span class="error_message" id="emails" style="display: none">message error</span>
					</div>
					<div class="col-md-12">
						<label>Status</label><br/>
						<select name="status" class="form-control status"></select><br/>
						<span class="error_message" id="status" style="display: none">message error</span>		
					</div>
					

					<div class="col-md-12">
						<label>note ( optional )</label><br/>
						<div class="note" style="width: 100%;height:354px;padding:1px 3px 1px 1px;border-radius:3px; ">
							<textarea id="note_incident" name="note" class="form-control" rows="10"></textarea><br/>
						</div>
						<span class="error_message" id="note" style="display: none">message error</span>		
					</div>

					<div class="col-md-12">
						<br/><input type="submit" class="btn btn-primary" value="Add Incident"/>&nbsp;
						<input type="reset" id="incident" name="btn_cancel" class="btn btn-danger" value="cancel"/>&nbsp;
					</div>
				</form>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<!-- [end] form incident -->


<!-- form activity event -->
<div class="modal fade" id="form_activity_event" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h3>
					<i class="fa fa-th-list"></i>	
					Add Activity Event
					<button class="close" data-dismiss="modal" style="color:white;font-size:30px;font-weight:bold">&times;</button>
				</h3>
				
			</div>

			<div class="modal-body col-md-12">
	
				<form class="col-md-12" id="activity_form" data="3">
					<input type="hidden" name="type_report" value="3"/>
					<div class="col-md-12">
						<br/><label>Activity Name: </label><br/>
						<input type="text" name="activity_name" class="form-control activity_name"/>
						<span class="error_message" id="activity_name" style="display: none">message error</span>							
					</div>

					<div class="col-md-12">
						<br/><label>Request By: </label><br/>
						<input type="text" name="request_by" class="form-control request_by" value="<?=$this->session->userdata('username')?>"/>
						<span class="error_message" id="request_by" style="display: none">message error</span>						
					</div>

					<div class="col-md-12">
						<label>activity</label><br/>
						<div class="activity" style="width: 100%;height:354px;padding:1px 3px 1px 1px;border-radius:3px; ">
							<textarea id="activity_textarea" name="activity" class="form-control" rows="30"></textarea><br/>
						</div>							
						<span class="error_message" id="activity" style="display: none">message error</span>	

					</div>

					<div class="col-md-12">
						<label>Location</label><br/>
						<div class="location" id="divarea_location_activity" style="width: 100%;padding:1px;border-radius:5px; ">
							<select id="location3" name="location" class="form-control" style="width: 100%;"></select><br/>
						</div>
						<span class="error_message" id="location" style="display: none;">message error</span>

					</div>

					<div class="col-md-12">
						<label>reporter</label><br/>
						<div class="reporter" id="divarea_reporter_activity" style="width: 100%;padding:1px;border-radius:5px; ">
							<select id="reporter3" name="reporter" class="form-control" style="width: 100%;"></select><br/>
						</div>
						<span class="error_message" id="reporter" style="display: none;">message error</span><br>

						<button type="button" class="btn btn-primary btn-xs add_reporter" data="reporter3">add reporter</button><br/><br/> 
						<div class="list_data_reporter" name="reporter"></div>

					</div>

					<div class="col-md-12">
						<label>Email to</label><br/>
						<input type="text" class="form-control email emails"  />
						<span class="error_message" id="emails" style="display: none">message error</span><br>	
						<span class="message_validate"></span>
						<div class="list_email col-md-12"></div>
					</div>
					
					

					

					<div class="col-md-12">
						<label>Activity Start: </label><br>
						<div class='input-group date'>
							 <input type="text" name="start_time" id="start_time_activity" class="form-control start_time"></input><br>
							 <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                 </span>
						</div>
						
						 <span class="error_message" id="start_time" style="display: none">message error</span>
						
					</div>

					
					
					<div class="col-md-12">
						<label>Activity End:  </label><br>
						<div class='input-group date'>
							 <input type="text" name="end_time" id="end_time_activity" class="form-control end_time"></input><br>
							 <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                 </span>
						</div>
						
						 <span class="error_message" id="end_time" style="display: none">message error</span>
						
					</div>

					<div class="col-md-12">
						<label>Status</label><br/>
						<select name="status" class="form-control status"></select><br/>
						<span class="error_message" id="status" style="display: none">message error</span>		
					</div>

					<div class="col-md-12">
						<label>note ( optional )</label><br/>
						<div class="note" style="width: 100%;height:354px;padding:1px 3px 1px 1px;border-radius:3px; "> 
							<textarea id="note_activity" name="note" class="form-control" rows="10"></textarea><br/>
						</div>														
						<span class="error_message" id="note" style="display: none">message error</span>	
	
					</div>
	
					<div class="col-md-12">
						<br/><input type="submit" class="btn btn-primary" value="Add activity"/>&nbsp;
						<input type="reset" id="activity" name="btn_cancel" class="btn btn-danger" value="cancel"/>&nbsp;
					</div>
				</form>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<!-- [end] form activity event -->

<!-- form request event -->
<div class="modal fade" id="form_request_event" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h3>
					<i class="fa fa-th-list"></i>	
					Add Request
					<button class="close" data-dismiss="modal" style="color:white;font-size:30px;font-weight:bold">&times;</button>
				</h3>
				
			</div>

			<div class="modal-body col-md-12">
	
				<form class="col-md-12" id="request_form" data="4">
					<input type="hidden" name="type_report" value="4"/>
					
					<div class="col-md-12">
						<br/><label>Request Name: </label><br/>
						<input type="text" name="request_name" class="form-control activity_name"/>
						<span class="error_message" id="activity_name" style="display: none">message error</span>							
					</div>

					<div class="col-md-12">
						<br/><label>Request By: </label><br/>
						<input type="text" name="request_by" class="form-control request_by" value="<?=$this->session->userdata('username')?>"/>
						<span class="error_message" id="request_by" style="display: none">message error</span>						
					</div>

					<div class="col-md-12">
						<label>activity</label><br/>
						<div class="activity" style="width: 100%;height:354px;padding:1px 3px 1px 1px;border-radius:3px; ">  
							<textarea id="request_textarea" name="activity" class="form-control" rows="30"></textarea><br/>
						</div>
						<span class="error_message" id="activity" style="display: none">message error</span>			
					</div>

					<div class="col-md-12">
						<label>Location</label><br/>
						<div class="location" id="divarea_location_request" style="width: 100%;padding:1px;border-radius:5px; ">
							<select id="location4" name="location" class="form-control" style="width: 100%;"></select><br/>
						</div>
						<span class="error_message" id="location" style="display: none;">message error</span>		
					</div>

					<div class="col-md-12">
						<label>reporter</label><br/>
						<div class="reporter" id="divarea_reporter_request" style="width: 100%;padding:1px;border-radius:5px; ">
							<select id="reporter4" name="reporter" class="form-control" style="width: 100%;"></select><br/>
						</div>
						<span class="error_message" id="reporter" style="display: none;">message error</span><br>
						<button type="button" class="btn btn-primary btn-xs add_reporter" data="reporter4">add reporter</button><br/><br/> 
						<div class="list_data_reporter" name="reporter"></div>

					</div>

					<div class="col-md-12">
						<label>Email to</label><br/>
						<input type="text" class="form-control email emails "  />
						<span class="error_message" id="emails" style="display: none">message error</span><br>	
						<span class="message_validate"></span>
						<div class="list_email col-md-12"></div>
					</div>
					
					

					

					<div class="col-md-12">
						<label>Start Event:  </label><br>
						<div class='input-group date'>
							 <input type="text" name="start_time" id="start_time_request" class="form-control start_time"></input><br>
							 <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                 </span>
						</div>
						
						 <span class="error_message" id="start_time" style="display: none">message error</span>
						
					</div>

					

					<div class="col-md-12">
						<label>End Event:  </label><br>
						<div class='input-group date'>
							<input type="text" name="end_time" id="end_time_request" class="form-control end_time"></input><br>
							<span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                 </span>
						</div>
						 
						 <span class="error_message" id="end_time" style="display: none">message error</span>						
					</div>

					<div class="col-md-12">
						<label>Status</label><br/>
						<select name="status" class="form-control status"></select><br/>
						<span class="error_message" id="status" style="display: none">message error</span>			
					</div>

					<div class="col-md-12">
						<label>note ( optional )</label><br/>
						<div class="note" style="width: 100%;height:354px;padding:1px 3px 1px 1px;border-radius:3px; ">  
							<textarea id="note_request" name="note" class="form-control" rows="10"></textarea><br/>
						</div>
						<span class="error_message" id="note" style="display: none">message error</span>		
					</div>
															
							
	
					<div class="col-md-12">
						<br/><input type="submit" class="btn btn-primary" value="Add Event"/>&nbsp;
						<input type="reset" id="request" name="btn_cancel" class="btn btn-danger" value="cancel"/>&nbsp;
					</div>
				</form>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>


<!-- [end] form request event -->






<script type="text/javascript">

 	
  
  $(document).ready(function() {
    
    /*
	:: data enginer, data location & data operator (reporter) dipanggil
	:: dari fungsi list_type_report
    */
   
    showDataEvent();
    showOptionReportType();
    showOptionStatus();

    
   // getTime();

   
   	
   
  });


   $(document).on("click",".add_reporter",function(){

	   	id=$(this).attr("data");
	   	//alert(id);
	  	dataReporter=$("#"+id).val().split("_");

	  	//console.log(dataReporter);
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
					  				

			list="<div data='"+reporterId+"' class='alert alert-info col-md-5 data_reporter' style='margin-right:5px;'>";
			list+="<i class='fa fa-user'></i>&nbsp;";
			list+=reporterId+" - "+reporterName;
			list+="<button title='"+reporterId+"' class='close btn_delete_reporter' data-dismiss='alert'>&times</button>";
			list+="</div>";

						  			
			$(".list_data_reporter").append(list);
		}

   });



  function showCalendar(idCalendar)
  {
  
		$('#'+idCalendar).datetimepicker({
			format:"Y-m-d H:i:s"
			
		});
	
  }

  
  $(document).on("click",".add_enginer",function(){

  	id=$(this).attr("data");
  	//enginer_name=$("#"+id).val().split("_");
  	dataEnginer=$("#"+id).val().split("_");
  	enginerId=dataEnginer[0];
  	enginerName=dataEnginer[1];
  	
  	data_list = $(".data_enginer");
	//alert(data_list.length);				  			
	enginer=0;
	for(a=0;a<data_list.length;a++){
		if(enginerId == data_list.eq(a).attr('data') )
		{				  					
			enginer++;
			break;
		}
	}

				  			

	if(enginer == 0)
	{
				  				

		list="<div data='"+enginerId+"' class='alert alert-info col-md-5 data_enginer' style='margin-right:5px;'>";
		list+="<i class='fa fa-user'></i>&nbsp;";
		list+=enginerId+" - "+enginerName;
		list+="<button title='"+enginerId+"' class='close btn_delete_enginer' data-dismiss='alert'>&times</button>";
		list+="</div>";

					  			
		$(".list_data_enginer").append(list);
	}

  })

  $(document).on("click",".btn_delete_enginer",function(){
 	//alert();
 	data_id=$(this).attr("title"); 	
 	element=$(".data_enginer");
 	

 	for(a=0;a<element.length;a++)
 	{
 		if( element.eq(a).attr('data') == data_id )
 		{
 			element.eq(a).remove();
 		}
 	}
 	
 	
 })

   $(document).on("click",".btn_delete_reporter",function(){
 	//alert();
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


  $(document).on("submit","form",function(e){

  		e.preventDefault();

  		process_type="insert";
  		data_input = $(this).serialize();
  		type_report = $(this).attr("data");
	    data_location = $("#location"+type_report).val();

  		/*
		:: =====================================================
		:: get email data [ start] 
		::======================================================
  		*/

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

	    /*
		:: =====================================================
		:: get email data [ end] 
		::======================================================
  		*/

	  

	  	
	   // data_reporter = $("#reporter"+type_report).val();
	    //alert("data reporter :"+data_reporter);

	   /* if(data_reporter == null)
	    {
	    	data_reporter="0";
	    }*/

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

	    	// sortir duplicated data
	    	list_fixed_reporter=[];
	  		for(let i = 0;i < data_reporter.length; i++)
	  		{
		        if(list_fixed_reporter.indexOf(data_reporter[i]) == -1){
		            list_fixed_reporter.push(data_reporter[i]);
		        }
		    }

	    	//data_input += "&enginer="+list_fixed_enginer;

	    
	    data_input += "&emails="+list_fixed_email+"&location="+data_location+"&reporter="+list_fixed_reporter;
	    
	    if( type_report == "1" || type_report == "2")
	    {
	    	data_enginer=[];
	    	//total list enginer dikalikan 2 karena atribut name pada formnya sama !!
	    	list_enginer = $(".data_enginer");
	    	for(a=0;a<list_enginer.length;a++)
	    	{
	    		
	    		data_enginer.push( $(".data_enginer").eq(a).attr('data') );
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

	    data_input += "&process_type="+process_type;

	    
		
		//console.log(process_type);	    

	   id_form = $(this).attr("id");
	    
  		$.ajax({
  			 //url:"<?=base_url()?>index.php/EventReport/insertData",
  			url:"<?=base_url()?>index.php/EventReport/validation",
  			type:"post",
  			dataType:"json",
  			data:data_input,

  			error:function(){
  				alert("error submit !");
  				$("#ajax_loader").hide();
  			},

  			beforeSend:function(){
  				$("#ajax_loader").show();
  			},

  			success:function(response)
  			{				
  				$("#ajax_loader").hide();
  				
  				error_message = $(".error_message");
  				for(a=0; a < error_message.length; a++)
  				{
  					error_message.eq(a).slideUp("slow"); 					
  					fieldClass=error_message.eq(a).attr("id");
  					
  					if(fieldClass=="reporter" || fieldClass=="location" || fieldClass=="activity" || fieldClass=="note" || fieldClass=="enginer" || fieldClass=="root_cause" || fieldClass=="action")
  					{
  						$("."+fieldClass).css({"background":""});	
  					}else{
  						$("."+fieldClass).css({"border-color":""});
  					}  					
  				}
 				
  				if(response.results == true)
  				{
	  					alert("success");
	  					switch(id_form)
		  				{
		  					case 'activity_form' :
		  						$("#form_activity_event").modal("hide");
					  		break;
					  		case 'incident_form' :
					  			$("#form_incident_event").modal("hide");
					  		break;
					  		case 'request_form' :
					  			$("#form_request_event").modal("hide");
					  		break;
					  		case 'plan_and_maintenance_form' :
					  			$("#form_plan_maintenance").modal("hide");
					  		break;

		  				}

		  				$("#table_data_event").DataTable().ajax.reload();

  				}else if(response.results=="incomplete")
  					{
  						for(a=0; a < response.field.length; a++)
  						{
  							
  							$("#"+response.field[a]).html("required").css({"color":"red","font-style":"italic","font-weight":"bold"});

  							if(response.field[a] =="reporter" || response.field[a] =="location" || response.field[a] =="activity" || response.field[a] =="note" || response.field[a] =="enginer" || response.field[a] =="root_cause" || response.field[a] =="action")
  							{
  								$("."+response.field[a]).css({"background":"red"});
  							}else{
  								$("."+response.field[a]).css({"border-color":"red"});
  							}

  							$("#"+response.field[a]).slideDown('slow');

  							/* this is looping function for handle bug element with the same id*/
  							/*start*/

  							element_error_message=$(".error_message");
  							for(x=0;x<element_error_message.length;x++)
	  						{
	  							getIdElement = element_error_message.eq(x).attr("id");
	  					
	  							if( getIdElement == "start_time" || getIdElement == "end_time" || getIdElement == "status" || getIdElement == "note" || getIdElement == "enginer" || getIdElement == "reporter" || getIdElement == "emails" || getIdElement == "activity_name" || getIdElement == "request_by" || getIdElement == "activity")
	  							{

	  								if( response.field[a] == getIdElement)
	  								{
	  									$( element_error_message.eq(x) ).html("required").css({"color":"red","font-style":"italic","font-weight":"bold"});
	  									element_error_message.eq(x).slideDown('slow');
	  								}

	  								
	  							}	
	  						}	

  							/*end*/ 	
  						}

  					}else
  						{
  							alert(response.results);
  						}  				
  			}

  		});

  		
  });

 


   $(document).on("keydown",".email",function(event){

  		char = event.which?event.which:event.keyCode;
  		//alert(char); 		
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
				  			//alert("email enter !!");
				  			event.preventDefault();

				  			data_list = $(".list_data_email");
				  			//alert(data_list.length);				  			
				  			email=0;
				  			for(a=0;a<data_list.length;a++){
				  				if(dataInput == data_list.eq(a).attr('data') )
				  				{				  					
				  					email++;
				  					break;
				  				}
				  			}

				  			

				  			if(email == 0)
				  			{
				  				

				  				list="<div data='"+dataInput+"' class='alert alert-danger col-md-5 list_data_email' style='margin-right:5px;'>";
					  			list+="<i class='fa fa-envelope'></i>&nbsp;";
					  			list+=dataInput;
					  			list+="<button title='"+dataInput+"' class='close btn_delete_email' data-dismiss='alert'>&times</button>";
					  			list+="</div>";

					  			//data_input_email = dataInput;
					  			/*list+="<input data='"+dataInput+"' type='text' class='list_data_email' value="+dataInput+" />";*/
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


  $(document).on("change","#type_report",function(){
  	//alert($(this).val());
  	title = $(this).val();

  	if(title=="0"){
  		 content="<i class='fa fa-th-list'></i>&nbsp;Add Event";
  	}else{
  		content="<i class='fa fa-th-list'></i>&nbsp;"+title;	
  	}
  	
  	$("#button_add_event").html(content);
  });


  $(document).on("click","#button_add_event",function(){
  	
  	data=$(this).attr("data");
  	//alert(data);

  	switch(data)
  	{
  		case 'closed' :
  			$(this).attr('data','open');
  			$("#type_report").slideDown('slow');
  		break;

  		case 'open' :
  			$(this).attr('data','closed');
  			$("#type_report").slideUp('slow');
  		break;
  	}
  	
  	

  });


  $(document).on("click",".list_type_report",function(){
  	data = $(this).attr('data');
  	
  	switch(data)
  	{
  		case '1' :
  			showOptionLocation("divarea_location_plan");
  			showOptionEnginer("divarea_enginer_plan");
  			showOptionOperator("divarea_reporter_plan");
  			showCalendar("start_time_plan");
    		showCalendar("end_time_plan");
  			$("#form_plan_maintenance").modal("show");
  		break;

  		case '2' :
  			showOptionLocation("divarea_location_incident");
  			showOptionEnginer("divarea_enginer_incident");
  			showOptionOperator("divarea_reporter_incident");
  			showCalendar("start_time_incident");
    		showCalendar("end_time_incident");
  			$("#form_incident_event").modal("show");
  		break;

  		case '3' :
  			showOptionLocation("divarea_location_activity");
  			showOptionOperator("divarea_reporter_activity");
  			showCalendar("start_time_activity");
    		showCalendar("end_time_activity");
  			$("#form_activity_event").modal("show");
  		break;

  		case '4' :
  			showOptionLocation("divarea_location_request");
  			showOptionOperator("divarea_reporter_request");
  			showCalendar("start_time_request");
    		showCalendar("end_time_request");
  			$("#form_request_event").modal("show");
  		break;

  		
  		default:
  			//alert("error");
  			element = "<div class='alert alert-danger message_error'>pilih form<button class='close' data-dismiss='alert'>&times;</button></div>";	
  			$("#warning").html(element);
  			$("#warning").slideDown('slow');;
  			$("#warning").slideUp(8000);
  		break;	
  			

  	}

  	$("#type_report").slideUp('slow');
  	 $("#button_add_event").attr('data','closed');

  });

   $(document).on("click","input[name=btn_cancel]",function(){
  	
  	id = $(this).attr('id');
  	//alert(id);

  	$(".list_email").html('');
  	$("select[name=location]").val('').trigger('change');
  	$("select[name=reporter]").val('').trigger('change');
  	$(".message_validate").html('');
  	
  	switch(id)
  	{
  		case 'incident':
  			$("#form_incident_event").modal("hide");
  		break;
  		
  		case 'request':
  			$("#form_request_event").modal("hide");
  		break;

  		case 'plan':
  			$("#form_plan_maintenance").modal("hide");
  		break;

  		case 'activity':
  			$("#form_activity_event").modal("hide");
  		break;

  		default :alert("modal not found !");	 	 	 	 
  	}
  
  })

 


  
/* all function on this page */
// no,type,report_number,event_name,event_start,status,action
function showDataEvent(){

	var table=$("#table_data_event").DataTable({
		processing:true,
		serverSide:true,
		columns:[
			{data:"no"},
			{data:"type"},
			{data:"report_number"},
			{data:"event_name"},
			{data:"event_start"},
			{data:"status"},
			{data:"action"}
		],
		columnDefs:[{orderable:false,targets:[6]}],
		ajax:{

			url:"<?=base_url()?>index.php/EventReport/getDataEvent",
			type:'post',
			dataType:'json'
		}

	});

	 table.on( 'order.dt search.dt processing.dt page.dt', function () {
    		table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        cell.innerHTML = i+1;
	        var info = table.page.info();
	        var page = info.page+1;             
	        if (page >'1') { 
	            hal = (page-1) *10;  // u can change this value of ur page
	            cell.innerHTML = hal+i+1;
	        } 
	    } );
	} ).draw(); 
}




function showOptionOperator(divId){
	$("select[name=reporter]").select2({
		dropdownParent:$("#"+divId),
		minimumInputLength:3,
		allowClear:true,
		// placeholder:"ketik minimum 3 character",
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

function showOptionLocation(idForm)
{
	//area= $('#divarea_location_plan');
	$("select[name=location]").select2({
		dropdownParent:$("#"+idForm),

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

function getTime()
{

	$.ajax({
		url:"<?=base_url()?>index.php/EventReport/getTime",
		type:"get",
		dataType:"json",
		error:function()
		{
			alert("time not set !!");
		},
		success:function(response)
		{
			$("#entry_time").html(response.time);
		}
	});

	setTimeout(function(){
		getTime();
	},1000);
}

/*function showDataEnginer(){
	$.ajax({
		url:"<?=base_url()?>index.php/EventReport/getNewDataEnginer",
		type:"get",
		dataType:"json",
		error:function()
		{
			alert("data enginer not set !!");
		},
		success:function(response)
		{
			if(response.length == 0)
			{
				$(".data_enginer").html("<p>data enginer tidak tersedia</p>");
			}else{

				for(a=0;a<response.length;a++)
				{
					checkbox="<input name='checkbox_enginer' type='checkbox' value='"+response[a].id+"'>&nbsp;"+response[a].text;
					$(".data_enginer").append(checkbox);
				}

			}	

			
			
		}
	});
}*/


function showOptionEnginer(divId){
	$("select[name=enginer]").select2({
		dropdownParent:$("#"+divId),
		minimumInputLength:3,
		allowClear:true,
		// placeholder:"ketik minimal 3 character",
		placeholder:"minimum typing 3 character",
		

		ajax:{
				url:"<?=base_url()?>index.php/EventReport/getDataEnginer",
				dataType:'json',
				data:function(params)
				{
					//console.log(params.term);
					return {
						param:params.term
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



function showOptionReportType(){
	 $.ajax({
	 	url:"<?=base_url()?>index.php/EventReport/getDataReportType",
	 	type:"get",
	 	dataType:"json",
	 	error:function()
	 	{
	 		alert("data type report not set !!");
	 	},
	 	success:function(response)
	 	{
	 		

	 		/*option = "<option value='0'>--pilih--</option>";
	 		$("#type_report").append(option);
	 		for(a=0;a<response.data.length;a++){

	 			option = "<option value='"+response.data[a].type+"'>"+response.data[a].type+"</option>";
	 			$("#type_report").append(option);
	 		}*/
	 		//110119

	 	
	 		option="";	
	 		for(a=0;a<response.data.length;a++){

	 			// option += "<a href='#' class='list-group-item list-group-item-action' "+response.data[a].type+"'>"+response.data[a].type+"</a>";
	 			option += "<div class='list-group-item list-group-item-action list_type_report' style='cursor:pointer;background:#edeeef;' data='"+response.data[a].id+"'>"+response.data[a].type+"</div>";
	 			
	 			
	 		}
	 		
	 		$("#type_report").append(option);
	 		
	 	}
	 })	
}


function showOptionStatus(){
	

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
	 		

	 		option = "<option value='0'>--pilih--</option>";
	 		$("select[name=status]").append(option);
	 		for(a=0;a<response.data.length;a++){

	 			
	 			option = "<option value="+response.data[a].id+">"+response.data[a].status+"</option>";
	 			$("select[name=status]").append(option);
	 		}

	 		

	 		
	 		
	 	}
	 })	
}
  
</script>


<!-- 
::
::================================
:: tinyMce set TextArea 
::==================================
::
:: Author : Idris
::
 -->


<script>

	tinymce.init({
	    selector: "#plan_detail_textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

	
	tinymce.init({
	    selector: "#note_planned",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});


	tinymce.init({
	    selector: "#root_cause_textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

	tinymce.init({
	    selector: "#action_textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});
	


	tinymce.init({
	    selector: "#note_incident",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

	

	tinymce.init({
	    selector: "#activity_textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

	

	tinymce.init({
	    selector: "#note_activity",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

	

	tinymce.init({
	    selector: "#request_textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

	tinymce.init({
	    selector: "#note_request",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    height:250
	});

</script>