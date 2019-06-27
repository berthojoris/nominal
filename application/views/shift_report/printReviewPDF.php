

<page backtop="10mm" backbottom="20mm" backleft="20mm" backright="20mm">

	<page_footer>
		<div id="footer" style="width:100%;text-align: center;">
			<hr>
			<h5>Integrity , Profesialism , Trust, Innovation , Custumer Centric</h5>
			<p style="text-align:right;">NOC Report page : [[page_cu]] / [[page_nb]]</p>
		</div>
	</page_footer>	

	<!-- <page_header> -->
		<?php 
		       $date=explode( "-",$shift_date );

		        switch($date[1])
		        {
		        	case '01' : $date[1]='Jan';break;
		        	case '02' : $date[1]='Feb';break;
		        	case '03' : $date[1]='Mar';break;
		        	case '04' : $date[1]='apr';break;
		        	case '05' : $date[1]='Mei';break;
		        	case '06' : $date[1]='Jun';break;
		        	case '07' : $date[1]='Jul';break;
		        	case '08' : $date[1]='Aug';break;
		        	case '09' : $date[1]='Sep';break;
		        	case '10' : $date[1]='Oct';break;
		        	case '11' : $date[1]='Nov';break;
		        	case '12' : $date[1]='Des';break;
		        }

		        $shiftDate = $date[2]."-".$date[1]."-".$date[0];
		     ?>

		<div id="header" style='width:90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5%;border-bottom: 1px solid grey;' align="center">
			<!-- <img width="250" height="180" border="0" src="<?=base_url()?>assets/img/brisat.png" > -->
			<img width="250" height="180" border="0" src="http://172.18.65.56/nominal/assets/img/brisat.png" >
			<!-- <img width="250" height="180" border="0" src="file:///D:/xampp/htdocs/nominal/assets/img/brisat.png" > -->
			<h1 style="margin-top: -45px;">NOC REPORT</h1>
			 <h4>Shift : <?=$shift?> ( <?= $shiftDate?>)</h4>
		</div>
		
	<!-- </page_header> -->

	    

		
		<div style='width:90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5%;'>
			<h3>*GROUD STATION*</h3>
			<hr style="border-color: #cfd2d6" />	
			<div><?=$groud_station?></div>		        		
		</div>
				
		<div style='width:90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5%'>
			<h3>*SIMCARD*</h3>
			<hr>
			<div><?=$simcard?></div>
		</div>
				
				 	
		<div style='width:90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5%'>
			<h3>*TROUBLE TICKET*</h3>
			<hr>
			<div><?=$trouble_ticket?></div>				
		</div>
					        	
		<div style='width:90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5%'>
			<h3>*REMOTE DOWN*</h3>
			<hr>
			<div><?=$remote_down?></div>
		</div>		
					
				
				
		<div style='width:90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5%;'>
			<h3>*ROUTING*</h3>
			<hr>
			<div><?=$routing?></div>
			
		</div>		
					
				
				
		<div style='width:90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5%'>
			<h3>*NDC*</h3>
			<hr>
			<div><?=$ndc?></div>
		</div>		
					
				
				
		<div style='width:90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5%'>
			<h3>*NAC*</h3>
			<hr>
			<div><?=$nac?></div>
		</div>		
					
				
				
		<div style='width:90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5%'>
			<h3>*JUPITER*</h3>
			<hr>
			<div><?=$jupiter?></div>
		</div>		
					
				
			
					        	


		<div style='width:90%;margin-right: 5%;margin-left: 5%;' id="report_event">

			<h3>*LISTING EVENT*</h3>
			<hr>

				<table style='width:50%;'>
						        		

					<!-- :::::: jika shift sudah cut off ::::::::  -->
						<?php if($activity !='' || $activity !=null) { ?>
									 	
						        				
						 <?php $data_event_closed=json_decode($activity); ?>
						

						<?php $no=1; ?>
						      <?php foreach($data_event_closed->activity->event as $key) {?>
							<tr>
								<td><?=$no?></td>
								<td>Event Name</td>
								<td> : </td>
								<td><?=$key->event_name?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>	
								<td>Report Number</td>
								<td> : </td>
								<td><?=$key->report_number?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>	
								<td>Create Date</td>
								<td> : </td>
								<td><?=$key->create_at?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>	
								<td>Status</td>
								<td> : </td>
								<td><?=$key->status?></td>
							</tr>
							<tr>
								<td colspan="4" style="height: 30px;"></td>	
							</tr>
						      <?php $no++; }?>

						<?php $data_event_open_and_inverstigated=json_decode($next_activity); ?>	
															
						<?php foreach($data_event_open_and_inverstigated->activity->event as $key) {?>
							<tr>
								<td><?=$no?></td>
								<td>Event Name</td>
								<td> : </td>
								<td><?=$key->event_name?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>	
								<td>Report Number</td>
								<td> : </td>
								<td><?=$key->report_number?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>	
								<td>Create Date</td>
								<td> : </td>
								<td><?=$key->create_at?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>	
								<td>Status</td>
								<td> : </td>
								<td><?=$key->status?></td>
							</tr>	
							<tr>
								<td colspan="4" style="height: 30px;"></td>	
							</tr>	
																
						<?php $no++; }?>	

					<?php }  ?>		

				</table>
		</div>

		<div id="report_duty" style='width:100%;' align="center"  >

			<table border="1" cellspacing="0" style="width: 100%;">
				<tr>
					<th style="width: 50%;padding: 15px 0px 15px 0px;">Shift on Duty</th>
					<th style="width: 50%;padding: 15px 0px 15px 0px;">Shift Next DUTY</th>
				</tr>

				<tr>
					
					<td style="text-align: left;padding:15px 0 15px 5px; ">
					<?php $data_on_duty = str_replace(array("<p>","</p>"),"",$on_duty)?>
					<?php $data=explode(",", $data_on_duty)?>

					<?php 
						for ($a=0;$a<count($data);$a++){
							$no=$a+1;
							if($data[0] != '') { 
								
								echo " - ".$data[$a]."<br>" ;

							}else {
									echo "not data available";
					 				} 		
					 	} 

					 ?>	
					</td>

					<td style="text-align: left;padding:15px 0 15px 5px;">
					
					<?php $data_next_duty = str_replace(array("<p>","</p>"),"",$next_duty)?>
					<?php $next_data=explode(",", $data_next_duty)?>

					<?php 
						for ($a=0;$a<count($next_data);$a++){
							$no=$a+1;
							if($next_data[0] != '') { 
								
								echo " - ".$next_data[$a]."<br>" ;

							}else {
									echo "not data available";
					 				} 		
					 	} 

					 ?>		

					</td>

				</tr>

				<tr>
					<td align="center">
						<?=date('d-M-Y')?>
					</td>
					<td align="center">
						<?=date('d-M-Y')?>
					</td>

				</tr>

				<tr>
					<td style="padding: 50px 0 50px 0"></td>
					<td style="padding: 50px 0 50px 0"></td>
				</tr>
			</table>

								
		</div>

		
		

</page>	  
		    





