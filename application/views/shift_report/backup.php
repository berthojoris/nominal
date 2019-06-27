       <div class="report_content" id="report_content">
						

						
						<div id="report_duty" class="col-md-12 bg-info">
							<h4>Shift On Duty</h4>
						
							<?php $data_on_duty = str_replace(array("<p>","</p>"),"",$on_duty)?>
							<?php $data=explode(",", $data_on_duty)?>
							

							<?php for ($a=0;$a<count($data);$a++){ ?>
								<?php $no=$a+1; ?>
									<?php if($data[0] != '') { ?>
										<p><?=$no." - ".$data[$a] ?></p>
									<?php }else { ?>
											<p>data not available</p>
											<?php }?>	
							<?php  } ?>	
							
						</div>
						
						

			        	<div id="report_team" class="col-md-12 bg-warning" style="margin-right: 15px;margin-top:30px;">	
				        	<div>
				        		<h3>*GROUD STATION*</h3>
				        		<hr>
				        		<div>
				        			<?=$groud_station?>
				        		</div>
				        		
				        	</div>
				        	<hr style="border-color: #98999b" />
				        	<div>
				        		<h3>*SIMCARD*</h3>
				        		<hr>
				        		<div>
				        			<?=$simcard?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />   	
				        	<div>
				        		<h3>*TROUBLE TICKET*</h3>
				        		<hr>
				        		<div>
				        			<?=$trouble_ticket?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />	        	
				        	<div>
				        		<h3>*REMOTE DOWN*</h3>
				        		<hr>
				        		<div>
				        			<?=$remote_down?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />
				        	<div>
				        		<h3>*ROUTING*</h3>
				        		<hr>
				        		<div>
				        			<?=$routing?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />
				        	<div>
				        		<h3>*NDC*</h3>
				        		<hr>
				        		<div>
				        			<?=$ndc?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />
				        	<div>
				        		<h3>*NAC*</h3>
				        		<hr>
				        		<div>
				        			<?=$nac?>
				        		</div>
				        	</div>
				        	<hr style="border-color: #98999b" />
				        	<div>
				        		<h3>*JUPITER*</h3>
				        		<hr>
				        		<div>
				        			<?=$jupiter?>
				        		</div>
				        	</div>
			        	</div>


			        	<div class="col-md-12" style="margin-top:30px;" id="report_event">

			        		<h3>*LISTING EVENT*</h3>
				        	<hr>

							<table class="table" style='width:50%;'>
				        		

							<!-- :::::: jika shift sudah cut off ::::::::  -->
							 <?php if($activity !='' || $activity !=null) { ?>
							 	
				        				
				        				<?php $data_event_closed=json_decode($activity); ?>
										<?php //var_dump($id_shift) ?>

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
													<!-- <?php //var_dump($data->activity->event) ?> -->
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

				        			
							
							<!-- :::::: jika shift belum cut off :::::::: -->

										<?php } else { ?>
											
											<?php if( count( $data_event_open_status ) > 0 || count( $data_event_closed_status ) > 0  ) { ?>
												
												<!-- event dengan status open -->
												<?php $no=1; ?>
												<?php foreach($data_event_open_status as $key){ ?>
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
						        					<?php $no++ ?>	
						        				<?php } ?>
												
												<!-- event dengan status closed -->	
												<?php //var_dump($data_event_closed_status)?>
						        				<?php foreach($data_event_closed_status as $keyClosed){ ?>
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
						        					<?php $no++ ?>	
						        				<?php } ?>
												
												<!-- jika data belum atau tidak tersedia -->	
												<?php } else { ?>	
										 		
										 			<tr>
										 				<td colspan="6">
										 					there is no data event
										 				</td>
										 			</tr>
										 		<?php } ?>
										 			
										 <?php } ?>		


				        		
				        	</table>
				        </div>

			        </div>
			        