<!-- <script src="<?=base_url()?>assets/myjquery.min.js"></script> -->
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script src="<?=base_url()?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/jsPDF/dist/jspdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.10/jspdf.plugin.autotable.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.datetimepicker.css">


<style>
a {color : #777777;}

.formChild{margin-bottom:20px;}	
</style>



<section style="margin-bottom: -20px">
    <div style="width:100%;height:38px;" class="panel panel-default">
      <ol class="breadcrumb" style="background: white;">
        <?php $kode_kanwil = $this->uri->segment(3);?>
        <li><a href="<?php echo base_url().'index.php/Dashboard/All_Kanwil'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'index.php/ShiftReport/tableShiftReport' ?>">Shifting Report</a></li>
        <li class="active" style="color: #3C8DBC;">Shifting Review</li>
      </ol>
    </div>
</section>

<section class="content">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;"><?=$page?></div>

        <div class="panel-body">

        	 <div align="center" id="logo" style="display: block;">
				<img id="image_logo" src="<?=base_url()?>assets/img/brisat.png"/> 
				
				<h1 id="title" style="margin-top: -75px;">NOC Shift Report</h1>
			</div>

        	<div align="center">
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
	        	<h3 id="data_shift" >Shift : <?=$shift?> ( <?= $shiftDate?>)</h3>
	        	<hr style="border-color: #cfd2d6" />	
	        </div>

	        <div class="content_button container col-md-12">
		        <input type="hidden" id="id_shift" value="<?=$id_shift?>"></input>
		        	<div id="area_button" style="margin-bottom: 10px;">
						
						<?php if($activity !=''){?>

						<button class="btn btn-danger" onclick=window.location="<?=base_url().'index.php/ShiftReport/tableShiftReport'?>">
			        		<span class="glyphicon glyphicon-backward"></span>
			        		Back
			        	</button>&nbsp;	

						<!--  convert via php HTML2PDF  -->
		        		
						
		        		<!-- <button class="btn btn-warning" id="btn_convert" onclick="window.location='<?=base_url()?>index.php/ShiftReport/convert2pdf/<?=$id_shift?>' ">
					        <i class="glyphicon glyphicon-save-file"></i>	
					        	Convert
					    </button>&nbsp;
					     -->


					    <button class="btn btn-warning" id="btn_convert" onclick="window.open('<?=base_url()?>index.php/ShiftReport/convert2pdf/<?=$id_shift?>','myWindow','width=600,height=600')" >
					        <i class="glyphicon glyphicon-save-file"></i>	
					        	Convert
					    </button>&nbsp;

					    <!--  convert via jsPDF  -->
					    <!-- <button class="btn btn-warning" id="btn_convert"  >
					        <i class="glyphicon glyphicon-save-file"></i>	
					        	Convert
					    </button>&nbsp; -->

					    <button class="btn btn-info" id="btn_copy" >
					        <i class="glyphicon glyphicon-save-file"></i>	
					        	Copy
					    </button>&nbsp;

						<?php } ?>

			        	
			        </div>
			</div> 

			
			<div class="report_content" id="report_content">
						
						<div id="report_duty" class="col-md-12" style="margin-bottom: 30px;">
								<h3>*Shift On Duty*</h3>
								<hr/>
								<?php $data_on_duty = str_replace(array("<p>","</p>"),"",$on_duty)?>
								<?php $data=explode(",", $data_on_duty)?>
								

								<?php for ($a=0;$a<count($data);$a++){ ?>
									<?php $no=$a+1; ?>
										<?php if($data[0] != '') { ?>
											<div><?=$no." - ".$data[$a] ?></div>
										<?php } else { ?>
												<p>data not available</p>
												<?php }?>	
								<?php  } ?>
						</div>
						
						
						
						<?php $unallowed_character=array("<br>","<br/>","<br />","&nbsp;") ?>
			        	<div id="report_team" class="col-md-12">	
				        	<div>
				        		<h3>*GROUD STATION*</h3>
				        		<hr>
				        		<div>
				        			<!-- <?= str_replace($unallowed_character, "", $groud_station)?> -->
				        			<?=$groud_station?>
				        		</div>		
				        	</div>
				        	<hr/>
				        	<div>
				        		<h3>*SIMCARD*</h3>
				        		<hr>
				        		<div>
				        			<!-- <?= str_replace($unallowed_character, "", $simcard)?> -->
				        			<?=$simcard?>
				        		</div>
				        	</div>
				        	<hr/>   	
				        	<div>
				        		<h3>*TROUBLE TICKET*</h3>
				        		<hr>
				        		<div>
				        			<!-- <?= str_replace($unallowed_character, "", $trouble_ticket)?> -->
				        			<?=$trouble_ticket?>
				        		</div>
				        	</div>
				        	<hr/>	        	
				        	<div>
				        		<h3>*REMOTE DOWN*</h3>
				        		<hr>
				        		<div>
				        			<!-- <?= str_replace($unallowed_character, "", $remote_down)?> -->
				        			<?=$remote_down?>
				        		</div>
				        	</div>
				        	<hr/>
				        	<div>
				        		<h3>*ROUTING*</h3>
				        		<hr>
				        		<div>
				        			<!-- <?= str_replace($unallowed_character, "", $routing)?> -->
				        			<?=$routing?>
				        		</div>
				        	</div>
				        	<hr/>
				        	<div>
				        		<h3>*NDC*</h3>
				        		<hr>
				        		<div>
				        			<!-- <?= str_replace($unallowed_character, "", $ndc)?> -->
				        			<?=$ndc?>
				        		</div>
				        	</div>
				        	<hr/>
				        	<div>
				        		<h3>*NAC*</h3>
				        		<hr>
				        		<div>
				        			<!-- <?= str_replace($unallowed_character, "", $nac)?> -->
				        			<?=$nac?>
				        		</div>
				        	</div>
				        	<hr/>
				        	<div>
				        		<h3>*JUPITER*</h3>
				        		<hr/>
				        		<div>
				        			<!-- <?= str_replace($unallowed_character, "", $jupiter)?> -->
				        			<?=$jupiter?>
				        		</div>
				        	</div>
				        	<hr/>

				        	
			        	</div>



			        	
			        	<div id="report_event" class="col-md-12">
			        		
			        			<h3>*LISTING EVENT*</h3>
				        		<hr/>
				        	
				        		
				        		<table  class="col-md-3">
				        		

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
			

        </div>

        
    </div>        
</div>

<!-- <div id="html-2-pdfwrapper">

		<h1>Html2Pdf</h1>
		<p>
			This demo uses Html2Canvas.js to render HTML. <br />Instead of using an HTML canvas however, a canvas wrapper using jsPDF is substituted. The <em>context2d</em> provided by the wrapper calls native PDF rendering methods.
		</p>
		<p>A PDF of this page will be inserted into the right margin.</p>

		<h2>Colors</h2>
		<p>
			<span style='color: red'>red</span> <span style='color: rgb(0, 255, 0)'>rgb(0,255,0)</span> <span style='color: rgba(0, 0, 0, .5)'>rgba(0,0,0,.5)</span> <span style='color: #0000FF'>#0000FF</span> <span style='color: #0FF'>#0FF</span>
		</p>

		<h2>Text Alignment</h2>
		<div style='text-align: left'>left</div>
		<div style='text-align: center'>center</div>
		<div style='text-align: right'>right</div>
		
		<h1 style='page-break-before: always; margin-top:100px;'>Page Two</h1>
		<p>
			This demo uses Html2Canvas.js to render HTML. <br />Instead of using an HTML canvas however, a canvas wrapper using jsPDF is substituted. The <em>context2d</em> provided by the wrapper calls native PDF rendering methods.
		</p>

		<p>A PDF of this page will be inserted into the right margin.</p>

		<h2>Colors</h2>
		<p>
			<span style='color: red'>red</span> <span style='color: rgb(0, 255, 0)'>rgb(0,255,0)</span> <span style='color: rgba(0, 0, 0, .5)'>rgba(0,0,0,.5)</span> <span style='color: #0000FF'>#0000FF</span> <span style='color: #0FF'>#0FF</span>
		</p>
		
		<h1 style='page-break-before: always; margin-top:100px;'>Yet Another Page</h1>
		<h2>Text Alignment</h2>
		<div style='text-align: left'>left</div>
		<div style='text-align: center'>center</div>
		<div style='text-align: right'>right</div>
		<h2>Look here</h2>
		<p>
			This demo uses Html2Canvas.js to render HTML. <br />Instead of using an HTML canvas however, a canvas wrapper using jsPDF is substituted. The <em>context2d</em> provided by the wrapper calls native PDF rendering methods.
			This demo uses Html2Canvas.js to render HTML. Instead of using an HTML canvas however, a canvas wrapper using jsPDF is substituted. The <em>context2d</em> provided by the wrapper calls native PDF rendering methods.
		</p>
		<p>A PDF of this page will be inserted into the right margin.</p>

		<h2>Colors</h2>
		<p>
			<span style='color: red'>red</span> <span style='color: rgb(0, 255, 0)'>rgb(0,255,0)</span> <span style='color: rgba(0, 0, 0, .5)'>rgba(0,0,0,.5)</span> <span style='color: #0000FF'>#0000FF</span> <span style='color: #0FF'>#0FF</span>
		</p>

		<h2>Text Alignment</h2>
		<div style='text-align: left'>left</div>
		<div style='text-align: center'>center</div>
		<div style='text-align: right'>right</div>
		<p>
			This demo uses Html2Canvas.js to render HTML. <br />Instead of using an HTML canvas however, a canvas wrapper using jsPDF is substituted. The <em>context2d</em> provided by the wrapper calls native PDF rendering methods.
		</p>
		<p>A PDF of this page will be inserted into the right margin.</p>

		<h2>Colors</h2>
		<p>
			<span style='color: red'>red</span> <span style='color: rgb(0, 255, 0)'>rgb(0,255,0)</span> <span style='color: rgba(0, 0, 0, .5)'>rgba(0,0,0,.5)</span> <span style='color: #0000FF'>#0000FF</span> <span style='color: #0FF'>#0FF</span>
		</p>

		<h2>Text Alignment</h2>
		<div style='text-align: left'>left</div>
		<div style='text-align: center'>center</div>
		<div style='text-align: right'>right</div>
		
		
</div> -->


</section>

<script type="text/javascript">

$(document).on("click","#btn_copy",function(){
	CopyToClipboard("report_content");
})


function CopyToClipboard(containerid) {
	//alert();
if (document.selection) {
	 
    var range = document.body.createTextRange();
    range.moveToElementText(document.getElementById(containerid));
    range.select().createTextRange();
    document.execCommand("copy"); 

} else if (window.getSelection) {

    var range = document.createRange();
     range.selectNode(document.getElementById(containerid));
     r=window.getSelection().addRange(range);
     console.log( r );
     document.execCommand("copy");
     alert("text copied") 
}}


// $(document).on("click","#btn_convert",function(){

// 	var pdf = new jsPDF('p','mm','A4');

// 	 margins = {
//         top: 10,
//         bottom: 10,
//         left: 10,
//         width: 190
//     };

// 	var specialElementHandlers = {
//       '#bypassme': function (element, renderer) {
//           return true;
//       }
//   	}; 
	
// 	/*dataImage = encodeImage();
	
// 	header =$("#title").html();
// 	shift  =$("#data_shift").html();

// 	pdf.addImage(dataImage,"jpeg",67.5,0,75,75);

// 	pdf.setFontSize(20);
// 	pdf.text(75,60,header);
// 	pdf.setFontSize(10);
// 	pdf.text(85,70,shift);
// 	pdf.line(10, 80, 200,80); 
// 	pdf.output("save","report.pdf");
// 	*/

// 	value =document.getElementById('report_content');
// 	//value =document.getElementById('report_content');
// 	//value =document.getElementById('html-2-pdfwrapper');
	

// 	//console.log(value);
// 	pdf.fromHTML( value,  margins.left, margins.top,
// 	{
// 		// y coord
// 		width: 190,// max width of content on PDF ( A4 size paper)
// 		 'elementHandlers': specialElementHandlers
// 	},
// 	function (dispose) { 
//        	pdf.save('Test.pdf');
//     },margins);

	

// 	//pdf.output("save","report.pdf");

// 	/* pdf.fromHTML(
//     value, // HTML string or DOM elem ref.
//     margins.left, // x coord
//     margins.top, { // y coord
//         'width': margins.width // max width of content on PDF
//         //'elementHandlers': specialElementHandlers
//     },

//     function (dispose) {
//         // dispose: object with X, Y of the last line add to the PDF 
//         //          this allow the insertion of new lines after html
//         pdf.save('Test.pdf');
//     }, margins);*/

	

	
	

	 

// })

/*function encodeImage()
{
	var img = new Image();
	img.src="http://localhost/nominal/assets/img/brisat.png";

	var canvas = document.createElement("canvas");
	canvas.height =img.height;
	canvas.width =img.width;

	var context = canvas.getContext("2d");
	context.drawImage(img,0,0,canvas.height,canvas.width);

	data = canvas.toDataURL("image/png");
	return data;
}*/

</script>