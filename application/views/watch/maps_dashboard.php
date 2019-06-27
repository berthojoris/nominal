<style>
  .info-box-50 {
  display: block;
  min-height: 50px;
  background: #fff;
  width: 100%;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
  border-radius: 2px;
  margin-bottom: 15px;
}
.info-box-icon-50 {
  border-top-left-radius: 2px;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 2px;
  display: block;
  float: left;
  height: 50px;
  width: 50px;
  text-align: center;
  font-size: 20px;
  font-weight:bold;
  line-height: 50px;
  background: rgba(0, 0, 0, 0.2);
}
.info-box-content-50 {
  padding: 5px 10px;
  margin-left: 50px;
}
.row-center {
  margin-right: -15px;
  margin-left: -15px;
  text-align:center;
}
</style>
<meta http-equiv="refresh" content="60"/>

    <div class="row" style="margin:0px;">
        <embed src="<?php echo 'http://nominal.bri.co.id/nominal/index.php/Maps/fullscreen';?>" title="Maps All BRI" width="100%" height="500">
    </div>	
		  
    <div class="row" style="text-align:center;">
        <div class="col-md-2 col-sm-2 col-xs-12" style="width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_kc_offline','mywindow');" style="cursor: pointer;">
                <?php if($total_kc_offline==0){?>
                    <span class="info-box-icon-50 bg-green"><i class="fa fa-check-square"></i></span><?php 
                }else{?>
                    <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span></span>
                <?php }?>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-10"><font size="1">KC Offline</font></span>
                    <span class="info-box-number"><?php echo $total_kc_offline;?></span></center>
                </div>
            </div>
        </div>	    								
        <div class="col-md-2 col-sm-2 col-xs-12" style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_kcp_offline','mywindow');" style="cursor: pointer;">
                <?php if($total_kcp_offline==0){?>
                    <span class="info-box-icon-50 bg-green"><i class="fa fa-check-square"></i></span><?php 
                }else{?>
                    <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <?php } ?>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-10"><font size="1">KCP Offline</font></span>
                    <span class="info-box-number"><?php echo $total_kcp_offline;?></span></center>
                </div>
            </div>
        </div>				
        <div class="col-md-2 col-sm-6 col-xs-12"  style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_kk_offline','mywindow');" style="cursor: pointer;">
                <?php if($total_kk_offline==0){?>
                    <span class="info-box-icon-50 bg-green"><i class="fa fa-check-square"></i></span><?php 
                }else{?>
                    <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <?php } ?>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="1">KK Offline</font></span>
                    <span class="info-box-number"><?php echo $total_kk_offline;?></span></center>
                </div>
            </div>
        </div>				
        <div class="col-md-2 col-sm-6 col-xs-12"  style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_unit_offline','mywindow');" style="cursor: pointer;">
                <?php if($total_unit_offline==0){?>
                    <span class="info-box-icon-50 bg-green"><i class="fa fa-check-square"></i></span><?php 
                }else{?>
                    <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <?php }?>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="1">Unit Offline</font></span>
                    <span class="info-box-number"><?php echo $total_unit_offline;?></span></center>
                </div>
            </div>
        </div>				
        <div class="col-md-2 col-sm-6 col-xs-12" style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_atm_offline','mywindow');" style="cursor: pointer;">
                <?php if($total_atm_offline==0){?>
                    <span class="info-box-icon-50 bg-green"><i class="fa fa-check-square"></i></span><?php 
                }else{?>
                    <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <?php } ?>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="1">ATM Offline</font></span>
                    <span class="info-box-number"><?php echo $total_atm_offline;?></span></center>
                </div>
            </div>
        </div>
				
        <div class="col-md-2 col-sm-2 col-xs-12" style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline','mywindow');" style="cursor: pointer;">
                <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="1">All Offline</font></span>
                    <span class="info-box-number"><?php echo $total_remote_offline;?></span></center>
                </div>
            </div>
        </div>

        <!-- 
        <div class="col-md-2 col-sm-2 col-xs-12" style="margin-left:-20px;width:100px;">
            
        </div>


        
        <div class="col-md-3 col-sm-3 col-xs-12" style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline','mywindow');" style="cursor: pointer;">
                <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="0.5">Total Remote Alarm</font></span>
                    <span class="info-box-number"><?php echo $total_remote_alarm;?></span></center>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12" style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline','mywindow');" style="cursor: pointer;">
                <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="0.5">Acked & Confirmed</font></span>
                    <span class="info-box-number"><?php echo $total_remote_ack_alarm_define;?></span></center>
                </div>
            </div>
        </div> -->


    </div>
	
    <div class="row" >				
        <div class="col-md-2 col-sm-6 col-xs-2"  style="width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_less_1_hour','mywindow');" style="cursor: pointer;">
                <?php if($total_remote_offline_less_1_hour==0){?>
                    <span class="info-box-icon-50 bg-green"><i class="fa fa-check-square"></i></span><?php 
                }else{?>
                    <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <?php } ?>
                <div class="info-box-content-40"><center>
                    <span class="info-box-
                    text-"><font size="1">Off <1 Hour</font></span>
                    <span class="info-box-number"><?php echo $total_remote_offline_less_1_hour;?></span>
                    </center>
                </div>
            </div>
            <!--view ack/unack begin-->
             <div style="margin-top:-13px;font-size:16px;">
                    <center><table>
                        <tr>
                            <td>
                        <span style="background-color: #f7918a;font-weight:bold;">UnAck <?php 
                            for ($i=strlen($total_remote_offline_less_1_hour_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_less_1_hour_unack;
                            for ($i=strlen($total_remote_offline_less_1_hour_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                        ?></span></td>
                            <td></td>
                            <td>
                        <span style="background-color: #FFFF00;font-weight:bold;">Ack 
                            <?php 
                            for ($i=strlen($total_remote_offline_less_1_hour_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_less_1_hour_ack;
                            for ($i=strlen($total_remote_offline_less_1_hour_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            ?>
                        </span>
                    </td>
                        <tr>
                    </table>
                    </center>
                </div>
                    <!--view ack/unack end-->
        </div>
				
        <div class="col-md-2 col-sm-6 col-xs-2"  style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_1_4_hour','mywindow');" style="cursor: pointer;">
                <?php if($total_remote_offline_1_4_hour==0){?>
                    <span class="info-box-icon-50 bg-green"><i class="fa fa-check-square"></i></span><?php 
                }else{?>
                    <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <?php } ?>
                <div class="info-box-content-40">
                    <center>
                        <span class="info-box-text-"><font size="1">Off 1-4 Hours</font></span>
                        <span class="info-box-number"><?php echo $total_remote_offline_1_4_hour;?></span>
                    </center>
                </div>
            </div>

            <!--view ack/unack begin-->
             <div style="margin-top:-13px;font-size:16px;">
                    <center><table>
                        <tr>
                            <td>
                        <span style="background-color: #f7918a;font-weight:bold;">UnAck <?php 
                            for ($i=strlen($total_remote_offline_1_4_hour_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_1_4_hour_unack;
                            for ($i=strlen($total_remote_offline_1_4_hour_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                        ?></span></td>
                            <td></td>
                            <td>
                        <span style="background-color: #FFFF00;font-weight:bold;">Ack 
                            <?php 
                            for ($i=strlen($total_remote_offline_1_4_hour_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_1_4_hour_ack;
                            for ($i=strlen($total_remote_offline_1_4_hour_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            ?>
                        </span>
                    </td>
                        <tr>
                    </table>
                    </center>
                </div>
                    <!--view ack/unack end-->
        </div>
				
        <div class="col-md-2 col-sm-6 col-xs-2"  style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_4_12_hour','mywindow');" style="cursor: pointer;">
                <?php if($total_remote_offline_4_12_hour==0){?>
                    <span class="info-box-icon-50 bg-green"><i class="fa fa-check-square"></i></span><?php 
                }else{?>
                    <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <?php } ?>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="1">Off 4-12 Hours</font></span>
                    <span class="info-box-number"><?php echo $total_remote_offline_4_12_hour;?></span></center>
                </div>
            </div>

            <!--view ack/unack begin-->
             <div style="margin-top:-13px;font-size:16px;">
                    <center><table>
                        <tr>
                            <td>
                        <span style="background-color: #f7918a;font-weight:bold;">UnAck <?php 
                            for ($i=strlen($total_remote_offline_4_12_hour_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_4_12_hour_unack;
                            for ($i=strlen($total_remote_offline_4_12_hour_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                        ?></span></td>
                            <td></td>
                            <td>
                        <span style="background-color: #FFFF00;font-weight:bold;">Ack 
                            <?php 
                            for ($i=strlen($total_remote_offline_4_12_hour_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_4_12_hour_ack;
                            for ($i=strlen($total_remote_offline_4_12_hour_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            ?>
                        </span>
                    </td>
                        <tr>
                    </table>
                    </center>
                </div>
                    <!--view ack/unack end-->
        </div>
				
        <div class="col-md-2 col-sm-6 col-xs-2"  style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_12_24_hour','mywindow');" style="cursor: pointer;">
                <?php if($total_remote_offline_12_24_hour==0){?>
                    <span class="info-box-icon-50 bg-green"><i class="fa fa-check-square"></i></span><?php 
                }else{?>
                    <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <?php } ?>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="1">Off 12-24 Hours</font></span>
                    <span class="info-box-number"><?php echo $total_remote_offline_12_24_hour;?></span></center>
                    </div>
            </div>

            <!--view ack/unack begin-->
             <div style="margin-top:-13px;font-size:16px;">
                    <center><table>
                        <tr>
                            <td>
                        <span style="background-color: #f7918a;font-weight:bold;">UnAck <?php 
                            for ($i=strlen($total_remote_offline_12_24_hour_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_12_24_hour_unack;
                            for ($i=strlen($total_remote_offline_12_24_hour_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                        ?></span></td>
                            <td></td>
                            <td>
                        <span style="background-color: #FFFF00;font-weight:bold;">Ack 
                            <?php 
                            for ($i=strlen($total_remote_offline_12_24_hour_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_12_24_hour_ack;
                            for ($i=strlen($total_remote_offline_12_24_hour_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            ?>
                        </span>
                    </td>
                        <tr>
                    </table>
                    </center>
                </div>
                    <!--view ack/unack end-->
        </div>
				
        <div class="col-md-2 col-sm-6 col-xs-2"  style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_1_5_day','mywindow');" style="cursor: pointer;">
                <?php if($total_remote_offline_1_5_day==0){?>
                    <span class="info-box-icon-50 bg-green"><i class="fa fa-check-square"></i></span><?php 
                }else{?>
                    <span class="info-box-icon-50 bg-red"><i class="fa fa-exclamation"></i></span>
                <?php } ?>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="1">Off 1-5 Days</font></span>
                    <span class="info-box-number"><?php echo $total_remote_offline_1_5_day;?></span></center>

                   
                </div>
            </div>
            <!--view ack/unack begin-->
             <div style="margin-top:-13px;font-size:16px;">
                    <center><table>
                        <tr>
                            <td>
                        <span style="background-color: #f7918a;font-weight:bold;">UnAck <?php 
                            for ($i=strlen($total_remote_offline_1_5_day_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_1_5_day_unack;
                            for ($i=strlen($total_remote_offline_1_5_day_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                        ?></span></td>
                            <td></td>
                            <td>
                        <span style="background-color: #FFFF00;font-weight:bold;">Ack 
                            <?php 
                            for ($i=strlen($total_remote_offline_1_5_day_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_1_5_day_ack;
                            for ($i=strlen($total_remote_offline_1_5_day_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            ?>
                        </span>
                    </td>
                        <tr>
                    </table>
                    </center>
                </div>
                    <!--view ack/unack end-->
        </div>
				
        <div class="col-md-2 col-sm-6 col-xs-2"  style="margin-left:-20px;width:175px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline_more_5_day','mywindow');" style="cursor: pointer;">
                <?php if($total_remote_offline_more_5_day==0){?>
                    <span class="info-box-icon-50 bg-green"><i class="fa fa-check-square"></i></span><?php 
                }else{?>
                    <span class="info-box-icon-50 bg-red"><i class="fa fa-exclamation-circle"></i></span>
                <?php } ?>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="1">Off >5 Days</font></span>
                    <span class="info-box-number"><?php echo $total_remote_offline_more_5_day;?></span></center>

                    
                </div>
            </div>
             <!--view ack/unack begin-->
             <div style="margin-top:-13px;font-size:16px;">
                    <center><table>
                        <tr>
                            <td>
                        <span style="background-color: #f7918a;font-weight:bold;">UnAck <?php 
                            for ($i=strlen($total_remote_offline_more_5_day_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_more_5_day_unack;
                            for ($i=strlen($total_remote_offline_more_5_day_unack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                        ?></span></td>
                            <td></td>
                            <td>
                        <span style="background-color: #FFFF00;font-weight:bold;">Ack 
                            <?php 
                            for ($i=strlen($total_remote_offline_more_5_day_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            echo $total_remote_offline_more_5_day_ack;
                            for ($i=strlen($total_remote_offline_more_5_day_ack); $i<3 ; $i++) { 
                                echo "&nbsp;";
                            }
                            ?>
                        </span>
                    </td>
                        <tr>
                    </table>
                    </center>
                </div>
                    <!--view ack/unack end-->
        </div>  

        
        
        <div class="col-md-3 col-sm-3 col-xs-12" style="width:125px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline','mywindow');" style="cursor: pointer;">
                <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="0.5">Unacked</font></span>
                    <span class="info-box-number"><?php echo $total_remote_unack_alarm;?></span></center>
                </div>
            </div>
        </div>

         <div class="col-md-3 col-sm-3 col-xs-12" style="margin-left:-20px;width:125px;">
            <div class="info-box-50" onclick="window.open('<?php echo base_url();?>index.php/watch/ListDown/total_remote_offline','mywindow');" style="cursor: pointer;">
                <span class="info-box-icon-50 bg-red"><i class="fa fa-arrow-down"></i></span>
                <div class="info-box-content-40"><center>
                    <span class="info-box-text-"><font size="0.5">Acked</font></span>
                    <span class="info-box-number"><?php echo $total_remote_ack_alarm_define;?></span></center>
                </div>
            </div>
        </div> 

    </div>

<script type="text/javascript">
 function refresh()
  {
      setTimeout(function(){
        window.location.reload(1);
         refresh();
      }, 60000);
  }

</script>