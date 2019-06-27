<?php


kanca_off();

function kanca_off()
{
    echo("Start : ".date("Y-m-d H:i:s"));
    $host = "172.18.65.56"; //"localhost";
$user = "root";
$pass = "P@ssw0rd";
$dbnm = "wanvolution_dev";
$conn = mysqli_connect($host, $user, $pass);

// connection
if ($conn)
{
        $open = mysqli_select_db($conn,$dbnm);
        if (!$open)
        {
            die ("Database tidak dapat dibuka karena ".mysqli_error());
        }
}
else
{
    die ("Server MySQL tidak terhubung karena ".mysqli_error());
}

  $query_prov = "SELECT a.id_remote, a.ip_lan
  FROM tb_remote_test a
  LEFT JOIN tb_kanca b ON a.kode_kanca = b.kode_kanca
  WHERE a.kode_tipe_uker='2' AND `status` = 1;";
  $prov_result = mysqli_query($conn,$query_prov);
  $arr_prov    = array();
  $total_prov  = mysqli_num_rows($prov_result);
  //echo $query_prov;
  if ($total_prov > 0)
  {  
    for ($j = 0; $j < $total_prov; $j++)
    {
        $prov       = mysqli_fetch_array($prov_result);
        $arr_id[$j] = $prov["id_remote"];
        $arr_ip[$j] = $prov["ip_lan"];
        $ip         = explode(".", $arr_ip[$j]);
        $ip_test    = $ip[0].".".$ip[1].".".$ip[2].".9";
      
        //exec('ping -c 2 ' . $ip_test, $out);
        
        //$pingne = $out[sizeof($out) - 2];
        //$avga = explode(" ", $pingne);
        //$output = $avga[3] ." ". $avga[4];
        
        $nmap = exec("nmap -n -sn $ip_test/32 -oG - | awk '/Up$/{print $2}'",$result);
        var_dump($result);
        
        //echo $avga[3];
        //echo $j+1, " ". $ipnew ." ". $arr_des[$j] ." ". $output;
      
        //if ($avga[3] == "2")
        //{
        //    $q_update_status_online = "UPDATE tb_remote_test SET status = 3, status_rec_date = NOW(), last_status_update = NOW() WHERE id_remote = ".$arr_id[$j].";";
        //    $r_update_status_online = mysqli_query($conn,$q_update_status_online) or die ("error".mysqli_error());
            //echo $q_update_status_online;
        //}
    }
  }
  
  mysqli_close($conn);
  
  echo("End : ".date("Y-m-d H:i:s"));
}




?>
