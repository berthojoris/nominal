<?php
	if(isset($_POST["ip_address"]))
	{
		$cmd="";
		echo "<title>Ping to ".$_POST['ip_address']."</title>";
		echo '<div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Ping... (please wait)</div><br><br>';
		$cmd = "ping ".$_POST["ip_address"]." -c ".$_POST["count"];
		while (@ ob_end_flush()); // end all output buffers if any

		$proc = popen("$cmd 2>&1 ; echo Exit status : $?", 'r');
		$live_output     = "";
		$complete_output = "";
		//echo "<br>";
		while (!feof($proc))
		{
			$live_output     = fread($proc, 4096);
			//$live_output     = fread($proc, 1024);
			$complete_output = $complete_output . $live_output;
			$start = explode("data.",$live_output);
			if(isset($start[1])){
				echo $start[0]."data.<br>".$start[1]."<br>";
			}else{
				//echo "$live_output <br>";
				if(strpos($live_output, "---")){
					$end = explode("---",$live_output);
					echo $end[0]."<br>";
					echo "<br>".$end[1]." :<br>";
					$rtt = explode("rtt",$end[2]); 
					echo $rtt[0]."<br>";
					echo "rtt ".$rtt[1]."<br>";
				}else{
					echo "$live_output <br>";
				}
			}
			
			
			@ flush();
			//echo " a <br>";
		}
		//echo $traceroute[0];
		pclose($proc);

		// get exit status
		preg_match('/[0-9]+$/', $complete_output, $matches);

		// return exit status and intended output
		return array (
						'exit_status'  => intval($matches[0]),
						'output'       => str_replace("Exit status : " . $matches[0], '', $complete_output)
					 );
	}
?>