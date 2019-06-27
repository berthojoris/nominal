
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
		
		<div class="col-md-12"><h3>Number Form : <?=$report_number?></h3></div>

		<div class="col-md-12">
			<br/><label>EVENT / REQUEST NAME : </label><br/>
			<p><?=$event_name?></p>								
		</div>

		<div class="col-md-12">
			<br/><label>REQUEST BY : </label><br/>
			<p><?=$user_create?></p>					
		</div>

		<div class="col-md-12">
			<br/><label>ACTIVITY : </label><br/>
			<p><?=$event_detail?></p>	
		</div>

		<div class="col-md-12">
			<br/><label>LOCATION : </label><br/>
			<p>
				<?=$id_location." - ".$location ?>
			</p>
		</div>

		<div class="col-md-12">
			<br/><label>REPORTER : </label><br/>
			 
				<?php foreach($reporter as $data) {?>
					<?php $dataReporter = explode("_",$data['id_reporter']); ?>
					<?php $idReporter = $dataReporter[0]; ?>
					<?php $namaReporter = $dataReporter[1]; ?>
					
						<p>
							<?=$idReporter." - ".$namaReporter;?>
						</p>
					
				<?php }?>	
						
		</div>

		<div class="col-md-12">
			<br/><label>EMAIL TO : </label><br/>
			<p>
				<?php $data_email=explode(",", $emails);?>

					<?php foreach($data_email as $email ){ ?>
						<p>
							<?=$email?>
						</p>
					<?php } ?>
			</p>
		</div>
						

		<div class="col-md-12">
			<label>REQUEST START : </label><br>
			<?php  $datetime = new DateTime( $start_time );   ?>
			<p>
				<?php echo $datetime->format('Y-m-d H:i:s'); ?>
			</p>						
		</div>

		
		
		<div class="col-md-12">
			<label>REQUEST END :</label><br>
			<?php  $datetime = new DateTime( $end_time );   ?>
			<p>
				<?php echo $datetime->format('Y-m-d H:i:s'); ?>
			</p>
		</div>

		<div class="col-md-12">
			<br/><label>STATUS : </label><br/>
			<p><?=$status?></p>	
		</div>

		<div class="col-md-12">
			<br/><label>NOTE : </label><br/>
			<p> <?=$note ?> </p> 
		</div>

	</div>
	

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
	
	

