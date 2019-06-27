<html>
    <head>
        <meta charset='UTF-8'/>
        <meta name='viewport' content='width=device-width'/>
        <meta http-equiv="refresh" content="120">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/default.css">
        <style>

            .running_text {
                align:center;  
                font-family:Verdana, Arial, Helvetica, sans-serif; 
                font-size:13px;
            }
        </style>
    </head>
    <body style='padding:10px 10px 10px 10px'>
        <table width=100%>
            <tr>
                <?php foreach($header as $row) { ?>
                <td class='noborder running_text' colspan='3'  height='30' bgcolor='<?php echo $row->color; ?>'>
            <marquee align='middle' direction='left' scrollamount='4' onmouseover='this.stop()' onmouseout='this.start()' >
                <b><font color='<?php echo $row->text_color; ?>'><?php echo $row->text; ?></font></b>
            </marquee>
                <?php } ?>
        </td>
    </tr>
    <tr>
        <td class=noborder align=left>
            <font color='black' bold=true size=4><?php echo $title; ?></font>
        </td>
        <td class= noborder align=right>
            <font size=1>Last Captured: <?php foreach($time as $row) {echo "<a href='http://nominal.bri.co.id/nominal/index.php/Dashboard_Rekap/monitoring_scheduler' target='_blank'><b>".$row->pdate."</b></a>";} ?> </font>
        </td>
        <td class="noborder" align="right">
            <form name="refreshForm">
                <b>Auto Refresh</b>:
                <select name="REFRESH_TIME" onchange="document.refreshForm.submit();">
                    <option value="120" selected="">2 minute
                    </option></select>
            </form>
        </td>
    </tr>
</table>
<br>
<?php                   $green1 = "#00FF00";
                        $green2 = "#BBFFAA";
                        $yellow = "#FFFF00";
                        $red = "#FF0000";
                        $red2 = "#FF1919";
                        $grey = "#E0E0D1";
?>
<div id='monitoring' class='monitoring_all'>
    <div align='center'>  
<table style="height: 132px;" border="1" width="551" >
<tbody>
<tr align="center">
<td style="width: 62.3833px;" rowspan="3" bgcolor='#CC9966'>No</td>
<td style="width: 62.3667px;" rowspan="3" bgcolor='#CC9966'>Region</td>
<td style="width: 62.3667px;" rowspan="2" colspan="3" bgcolor='#CC9966'>Total</td>
<td style="width: 62.3833px;" rowspan="3" bgcolor='#CC9966'>Precentage Online (%)</td>

<td style="width: 62.3833px;" rowspan="2" colspan="3" bgcolor='#CC9966'>KANWIL, KANINS, SENDIK</td>
<td style="width: 62.3667px;" colspan="9" bgcolor='#CC9966'>Ritel</td>
<td style="width: 62.3833px;" colspan="6" bgcolor='#CC9966'>Mikro</td>
<td style="width: 62.3833px;" colspan="9" bgcolor='#CC9966'>Mobile</td>
<td style="width: 62.3833px;" colspan="6" bgcolor='#CC9966'>OFFsite</td>
<td style="width: 62.3667px;" rowspan="2" colspan="3" bgcolor='#CC9966'>H2H</td>
<td style="width: 62.3667px;" rowspan="2" colspan="3" bgcolor='#CC9966'>Lain Lain</td>
</tr>
<tr align="center">
<td style="width: 62.3667px;" colspan="3" bgcolor='#CC9966'>KC</td>
<td style="width: 62.3833px;" colspan="3" bgcolor='#CC9966'>KCP</td>
<td style="width: 62.3667px;" colspan="3" bgcolor='#CC9966'>KK</td>
<td style="width: 62.3833px;" colspan="3" bgcolor='#CC9966'>UNIT</td>
<td style="width: 62.3667px;" colspan="3" bgcolor='#CC9966'>TERAS</td>
<td style="width: 62.3667px;" colspan="3" bgcolor='#CC9966'>Ebuzz</td>
<td style="width: 62.3667px;" colspan="3" bgcolor='#CC9966'>Teras Keliling</td>
<td style="width: 62.3667px;" colspan="3" bgcolor='#CC9966'>Teras Kapal</td>
<td style="width: 62.3667px;" colspan="3" bgcolor='#CC9966'>ATM</td>
<td style="width: 62.3667px;" colspan="3" bgcolor='#CC9966'>BRILINK</td>
</tr>
<tr align="center">

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>

<td style="width: 62.3667px;" bgcolor='#CC9966'>ON</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>OFF</td>
<td style="width: 62.3667px;" bgcolor='#CC9966'>NOP</td>
</tr>

<tr>
<?php 
$no = 1;
$total_on=$total_off=$total_nop=0;
$KW_on=$KW_off=$KW_nop=0;
$KC_on=$KC_off=$KC_nop=0;
$KCP_on=$KCP_off=$KCP_nop=0;
$KK_on=$KK_off=$KK_nop=0;
$UNIT_on=$UNIT_off=$UNIT_nop=0;
$TERAS_on=$TERAS_off=$TERAS_nop=0;
$EBUZZ_on=$EBUZZ_off=$EBUZZ_nop=0;
$TERLING_on=$TERLING_off=$TERLING_nop=0;
$TERPAL_on=$TERPAL_off=$TERPAL_nop=0;
$ATM_on=$ATM_off=$ATM_nop=0;
$BRILINK_on=$BRILINK_off=$BRILINK_nop=0;
$H2H_on=$H2H_off=$H2H_nop=0;
$LAINNYA_on=$LAINNYA_off=$LAINNYA_nop=0;
                        						
                        foreach ($all_data as $row) { ?>
						<tr  
						
						bgcolor='<?php 
						if($row->percentage_online>98){echo $green1;}
						elseif(($row->percentage_online<=98) && ($row->percentage_online>95.5)){echo $green2;} 
						elseif(($row->percentage_online<=95.5) && ($row->percentage_online>90)){echo $yellow;}
						elseif(($row->percentage_online<=90)){echo $red;}
						?>'>
							<td><?php echo $no; ?></td>
							<td><?php echo $row->kanwil; ?></td>
							
							<td><?php echo $row->total_on; $total_on += $row->total_on;?></td>
							<td><?php echo $row->total_off; $total_off += $row->total_off;?></td>
							<td><?php echo $row->total_nop; $total_nop += $row->total_nop;?></td>
							
							<td><?php echo $row->percentage_online; ?></td>
							
							<td><a target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/1/"?>" ><?php echo $row->KW_on; $KW_on+=$row->KW_on;?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/1/"?>" ><?php echo $row->KW_off; $KW_off+=$row->KW_off;?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/1/2"?>" ><?php echo $row->KW_nop; $KW_nop+=$row->KW_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/2/"?>" ><?php echo $row->KC_on; $KC_on+=$row->KC_on;?></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/2/"?>" ><?php echo $row->KC_off; $KC_off+=$row->KC_off?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/2/2"?>" ><?php echo $row->KC_nop; $KC_nop+=$row->KC_nop;?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/3/"?>" ><?php echo $row->KCP_on; $KCP_on+=$row->KCP_on;?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/3/"?>" ><?php echo $row->KCP_off; $KCP_off+=$row->KCP_off;?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/3/2"?>" ><?php echo $row->KCP_nop; $KCP_nop+=$row->KCP_nop;?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/5/"?>" ><?php echo $row->KK_on; $KK_on+=$row->KK_on;?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/5/"?>" ><?php echo $row->KK_off;$KK_off+=$row->KK_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/5/2"?>" ><?php echo $row->KK_nop; $KK_nop+=$row->KK_nop;?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/4/"?>" ><?php echo $row->UNIT_on; $UNIT_on+=$row->UNIT_on;?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/4/"?>" ><?php echo $row->UNIT_off; $UNIT_off+=$row->UNIT_off;?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/4/2"?>" ><?php echo $row->UNIT_nop; $UNIT_nop+=$row->UNIT_nop;?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/6/"?>" ><?php echo $row->TERAS_on; $TERAS_on+=$row->TERAS_on;?></a></td>
							<td>X<!--<a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/6/"?>" ><?php echo $row->TERAS_off; $TERAS_off+=$row->TERAS_off;?></a>--></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/6/2/"?>" ><?php echo $row->TERAS_nop; $TERAS_nop+=$row->TERAS_nop;?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/11/"?>" ><?php echo $row->EBUZZ_on; $EBUZZ_on+=$row->EBUZZ_on;?></a></td>
							<td>X<!--<a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/11/"?>" ><?php echo $row->EBUZZ_off; $EBUZZ_off+=$row->EBUZZ_off;?></a>--></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/11/2"?>" ><?php echo $row->EBUZZ_nop; $EBUZZ_nop+=$row->EBUZZ_nop;?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/10/"?>" ><?php echo $row->TERLING_on; $TERLING_on+=$row->TERLING_on;?></a></td>
							<td>X<!--<a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/10/"?>" ><?php echo $row->TERLING_off; $TERLING_off+=$row->TERLING_off;?></a>--></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/10/2"?>" ><?php echo $row->TERLING_nop; $TERLING_nop+=$row->TERLING_nop;?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/14/"?>" ><?php echo $row->TERPAL_on; $TERPAL_on+=$row->TERPAL_on;?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/14/"?>" ><?php echo $row->TERPAL_off; $TERPAL_off+=$row->TERPAL_off;?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/14/2"?>" ><?php echo $row->TERPAL_nop; $TERPAL_nop+=$row->TERPAL_nop;?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/7/"?>" ><?php echo $row->ATM_on; $ATM_on+=$row->ATM_on;?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/7/"?>" ><?php echo $row->ATM_off; $ATM_off+=$row->ATM_off;?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/7/2"?>" ><?php echo $row->ATM_nop; $ATM_nop+=$row->ATM_nop;?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/13/"?>" ><?php echo $row->BRILINK_on; $BRILINK_on+=$row->BRILINK_on;?></a></td>
							<td>X<!--<a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/13/"?>" ><?php echo $row->BRILINK_off; $BRILINK_off+=$row->BRILINK_off;?></a>--></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/13/2"?>" ><?php echo $row->BRILINK_nop;$BRILINK_nop+=$row->BRILINK_nop; ?></a></td>
							
                            <td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/9/2"?>" ><?php echo $row->H2H_on;$H2H_on+=$row->H2H_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/9/2"?>" ><?php echo $row->H2H_off;$H2H_off+=$row->H2H_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/9/2"?>" ><?php echo $row->H2H_nop; $H2H_nop+=$row->H2H_nop;?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/$row->kode_kanwil/8/"?>" ><?php echo $row->LAINNYA_on;$LAINNYA_on+=$row->LAINNYA_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/8/"?>" ><?php echo $row->LAINNYA_off;$LAINNYA_off+=$row->LAINNYA_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/$row->kode_kanwil/8/2"?>" ><?php echo $row->LAINNYA_nop;$LAINNYA_nop+=$row->LAINNYA_nop; ?></a></td>
							
                            </tr>
							
							
						<?php
							$no++;
                            $x = 0;
                        //if ($tta > 0) $x = 100 * (($tta - $tdo) / $tta);
                        }
                            ?>
</tr>
<!--begin row untuk menampilkan total-->

					<tr bgcolor='<?php 
						$persentase_total = number_format(($total_on*100/($total_on+$total_off)),2);
						if($persentase_total>98){echo $green1;}
						elseif(($persentase_total<=98) && ($persentase_total>95.5)){echo $green2;} 
						elseif(($persentase_total<=95.5) && ($persentase_total>90)){echo $yellow;}
						elseif(($persentase_total<=90)){echo $red;}
						?>' style="font-weight:bold">
							<td>-</td>
							<td>TOTAL</td>
							
							<td><?php echo $total_on; ?></td>
							<td><?php echo $total_off; ?></td>
							<td><?php echo $total_nop; ?></td>
							
							<td><?php echo number_format(($total_on*100/($total_on+$total_off)),2); ?></td>
							
							<td><a target="_blank"  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/1/"?>" ><?php echo $KW_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/1/"?>" ><?php echo $KW_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/1/2"?>" ><?php echo $KW_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/2/"?>" ><?php echo $KC_on; ?></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/2/"?>" ><?php echo $KC_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/2/2"?>" ><?php echo $KC_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/3/"?>" ><?php echo $KCP_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/3/"?>" ><?php echo $KCP_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/3/2"?>" ><?php echo $KCP_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/5/"?>" ><?php echo $KK_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/5/"?>" ><?php echo $KK_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/5/2"?>" ><?php echo $KK_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/4/"?>" ><?php echo $UNIT_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/4/"?>" ><?php echo $UNIT_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/4/2"?>" ><?php echo $UNIT_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/6/"?>" ><?php echo $TERAS_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/6/"?>" ><?php echo $TERAS_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/6/2/"?>" ><?php echo $TERAS_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/11/"?>" ><?php echo $EBUZZ_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/11/"?>" ><?php echo $EBUZZ_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/11/2"?>" ><?php echo $EBUZZ_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/10/"?>" ><?php echo $TERLING_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/10/"?>" ><?php echo $TERLING_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/10/2"?>" ><?php echo $TERLING_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/14/"?>" ><?php echo $TERPAL_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/14/"?>" ><?php echo $TERPAL_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/14/2"?>" ><?php echo $TERPAL_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/7/"?>" ><?php echo $ATM_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/7/"?>" ><?php echo $ATM_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/7/2"?>" ><?php echo $ATM_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/13/"?>" ><?php echo $BRILINK_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/13/"?>" ><?php echo $BRILINK_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/13/2"?>" ><?php echo $BRILINK_nop; ?></a></td>
							
                            <td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/9/2"?>" ><?php echo $H2H_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/9/2"?>" ><?php echo $H2H_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/9/2"?>" ><?php echo $H2H_nop; ?></a></td>
							
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/3/NULL/8/"?>" ><?php echo $LAINNYA_on; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/8/"?>" ><?php echo $LAINNYA_off; ?></a></td>
							<td><a  target="_blank" href="<?php echo base_url() . "index.php/Dashboard/data_uker_per_kanwil/1/NULL/8/2"?>" ><?php echo $LAINNYA_nop; ?></a></td>
							
                            </tr
<!-- end -->


</tbody>
</table>
<p>&nbsp;</p>
	
        <table border='1'>
            <tr>
                <td>      
                    <table border='1' cellspacing='0' cellpadding='0' class='fancy'>
						<?php
                      
                        
                        
                        $green1 = "#00FF00";
                        $green2 = "#BBFFAA";
                        $yellow = "#FFFF00";
                        $red = "#FF0000";
                        $red2 = "#FF1919";
                        $grey = "#E0E0D1";
                                        
                        
                        $no = 1;
                        ?>
                    </table>
                    <br/>
                    <b>Legend</b>
                    <table border='1'>
                        <!--<tr>
                            <td>
                                TOTAL 
                            </td>
                            <td> : </td>
                            <td>
                                Total Remote (Provider Uker + Provider Mobile + Provider ATM) dalam Region / Kanwil
                            </td>
                        </tr>
                        <tr>
                            <td>
                                AVAIL %
                            </td>
                            <td> : </td>
                            <td>
                                Persentase Availability Remote (100* Total Remote UP / Total Remote)
                            </td>
                        </tr>
                        <tr>
                            <td>
                                PROVIDER
                            </td>
                            <td> : </td>
                            <td>
                                Provider Jaringan : Satkom, Telkom, Patrakom, PSN, Icon+, Tangara, Lintasarta, CSM, Indosat
                            </td>
                        </tr>
                        <tr>
                            <td>
                                UKER
                            </td>
                            <td> : </td>
                            <td>
                                Remote : Kanwil, Kanins, Sendik, Kanca, KCP, KK, Unit, Teras
                            </td>
                        </tr>
                        <tr>
                            <td>
                                MOBILE
                            </td>
                            <td> : </td>
                            <td>
                                Remote : Ebuzz, Teras Mobile
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ATM
                            </td>
                            <td> : </td>
                            <td>
                                Remote : ATM Offsite
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Provider / x% / y%
                            </td>
                            <td> : </td>
                            <td>
                                x% : persentase remote provider dibanding seluruh remote, y% : persentase availability remote provider
                            </td>
                        </tr>
                        <tr>
                            <td>
                                UKER / x% /y%
                            </td>
                            <td> : </td>
                            <td>
                                x% : persentase remote uker provider dibanding seluruh remote provider, y% : persentase availability remote
                            </td>
                        </tr>
                        <tr>
                            <td>
                                MOBILE / x% / y%
                            </td>
                            <td> : </td>
                            <td>
                                x% : persentase remote mobile provider dibanding seluruh remote provider, y% : persentase availability remote
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ATM / x% / y%
                            </td>
                            <td> : </td>
                            <td>
                                x% : persentase remote atm provider dibanding seluruh remote provider, y% : persentase availability remote
                            </td>
                        </tr>
                        <tr>
                            <td>
                                TA
                            </td>
                            <td> : </td>
                            <td>
                                Total Remote Aktife
                            </td>
                        </tr>
                        <tr>
                            <td>
                                UP
                            </td>
                            <td> : </td>
                            <td>
                                Total Remote UP / Online 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                DO
                            </td>
                            <td> : </td>
                            <td>
                                Total Remote Down / Offline
                            </td>
                        </tr>
                        <tr>
                            <td>
                                AO
                            </td>
                            <td> : </td>
                            <td>
                                Total Remote Down / Offline karena After Office Hour
                            </td>
                        </tr>
                        <tr>
                            <td>
                                HL
                            </td>
                            <td> : </td>
                            <td>
                                Total Remote High Latency
                            </td>
                        </tr>-->
                        <tr>
                            <td bgcolor="FF0000">&nbsp;&nbsp;</td>
                            <td>:</td>
                            <td><font size="1">0 &lt; Availability &lt;= 87</font></td>
                        </tr>
                        <tr>
                            <td bgcolor="FFFF00">&nbsp;&nbsp;</td>
                            <td>:</td>
                            <td><font size="1">87 &lt; Availability &lt;= 93</font></td>
                        </tr>
                        <tr>
                            <td bgcolor="BBFFAA">&nbsp;&nbsp;</td>
                            <td>:</td>
                            <td><font size="1">93 &lt; Availability &lt;= 97</font></td>
                        </tr>
                        <tr>
                            <td bgcolor="00FF00">&nbsp;&nbsp;</td>
                            <td>:</td>
                            <td><font size="1">97 &lt; Availability &lt;= 100</font></td>
                        </tr>
                    </table></td></tr></table></div></div><br>

<div align="right">
NOC - DIV SATELIT<br/>
Indonesia - V.1
</div>
</body>
</html>