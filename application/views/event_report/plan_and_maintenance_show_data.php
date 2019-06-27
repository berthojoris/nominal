
<style>
	.data{
		margin-bottom:10px; 
	}
</style>

<div class="content">
	
	<div>

		<button type="button" class="btn btn-danger" title="back" onclick="window.location='<?=base_url()?>index.php/EventReport/tableEvent' ">
			<i class="glyphicon glyphicon-backward"></i>
			back
		</button>&nbsp;

		<button type="button" class="btn btn-warning" id="btn_copy" title="copy">
			 <i class="glyphicon glyphicon-book"></i>	
			copy
		</button>&nbsp;
	
	</div>

	<div id="dataArea" class="container col-md-12">

		
		<div class="col-md-12 data"><h3>Number Form : <?=$report_number?></h3></div>

		<div class="col-md-12 data">
			<br/><label>PLAN NAME :</label><br/>
			<p><?=$plan_name?></p>
											
		</div>

		<div class="col-md-12 data">
			<label>LOCATION : </label><br/>
			<p> <?=$id_location." - ".$location ?> </p>			
		</div>

		<div class="col-md-12 data">
			<label>PLAN DETAIL :</label><br/>
			<div><?=$activity?></div>
		</div>

		

		<div class="col-md-12 data">
			<?php  $datetime = new DateTime( $start_time );   ?>
			<label>PLAN START TIME: </label><br>
			<p> <?=$datetime->format('Y-m-d H:i:s'); ?> </p>					
		</div>

		

		

		<div class="col-md-12 data">
			<?php  $datetime = new DateTime( $start_time );   ?>
			<label>PLAN END TIME: </label><br>
			<p><?=$datetime->format('Y-m-d H:i:s'); ?></p>		
		</div>

		<div class="col-md-12 data">
			<label>ENGINER : </label><br/>
			 
			<div>
				
				<?php for($a=0;$a<count($enginer);$a++){ ?>
					<p>
						<?=$enginer[$a]['id_enginer']." - ".$enginer[$a]['nama_enginer'] ?>
					</p>
				<?php } ?>

						
			</div>
							
		</div>
		 
		<div class="col-md-12 data">
			<label>EMAIL TO :</label><br/>
			<?php $data_email=explode(",", $emails);?>

			<?php foreach($data_email as $email ){ ?>
				<p>
					<?=$email?>
				</p>
			<?php } ?>

		</div>
		
		<div class="col-md-12 data">
			<label>REPORTER :</label><br/>

				<?php 
					foreach($reporter as $data) {
					
					$dataReporter = explode("_",$data['id_reporter']);
					$idReporter = $dataReporter[0];
					$namaReporter = $dataReporter[1]; 
				?>
					<p>	
						<?=$idReporter." - ".$namaReporter;?>
					</p>

				<?php }?>

				
			
		</div>

		
						
		<div class="col-md-12 data">
			<label>STATUS :</label><br/>
			<p>
				<?=$status?>
			</p>			
		</div>

		<div class="col-md-12 data">
			<label>NOTE :</label><br/> 
			<div>
				<?=$note?>
			</div><br/>	
		</div>

	</div>

	
	<!-- <button id="button1" onclick="CopyToClipboard('div1')">Click to copy</button>

	<div id="div1" >Text To Copy </div> -->

</div>

	
<script type="text/javascript">
	
	


$(document).on("click","#btn_copy",function(){
	CopyToClipboard("dataArea");
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

	
 
</script>	

	
	

	

