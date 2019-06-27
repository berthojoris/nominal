<aside class="main-sidebar" >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('nama'); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
    <!-- 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Main Navigation</li>
            <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('index.php/Dashboard'); ?>">
                <i class="fa fa-home"></i>
                <span>Home</span>
              </a>
            </li>
      


            <li <?php if ($page == 'quick') {echo 'class="active"';} ?>>
              <a href="#">
                <i class="fa fa-search"></i>
                <span>Quick Search</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
              
              <li <?php if ($page == 'quick') {echo 'class="active"';} ?>>                 
                <a href="<?php echo base_url('index.php/Home'); ?>">
               <i class="fa fa-search"></i>
              <span>Search Remote</span>
              </li>
              <li>
                  <!-- <a href="#"> -->
                  <a href="<?=base_url()?>index.php/ApiSimcard/searchDeviceUI">
                    <i class="fa fa-search"></i>
                    <span>M2M</span>
                  </a>
                </li>
                <li>
                  <!--<a href="#">-->
                  <a href="<?=base_url()?>index.php/ApiSimcard/masterIccidNumber">
                    <i class="fa fa-search"></i>
                    <span>ICCID NUMBER</span>
                  </a>
                </li>
              </ul>
              
            </li>



            <li class="treeview"  <?php if ($page == 'kanwil' || $page == 'prov' || $page == 'dashboard') {echo 'class="active"';} ?> >
              <a href="#">
                <i class="fa fa-tachometer"></i>
                <span>Dashboard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
                  <a href="#"><i class="fa fa-tachometer"></i>Gauge Chart
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                    <?php if(in_array( $this->session->userdata('role'), array(1,3,5,6,7,10) )){?>
                          <li <?php if ($page == 'kanwil') {echo 'class="active"';} ?>><a href="<?php echo base_url('index.php/Dashboard/All_Kanwil'); ?>">
                                <i class="fa fa-tachometer"></i>
                                <span>Region</span>
                              </a>
                          </li>
                    <?php }
                         if(in_array( $this->session->userdata('role'), array(1,2,3,5,10) )){?>
                          <li <?php if ($page == 'prov') {echo 'class="active"';} ?> > <a href="<?php echo base_url('index.php/Dash_Provider'); ?>">
                                <i class="fa fa-tachometer"></i>
                                <span>Provider</span>
                              </a>
                          </li>
                    <?php }
                          if(in_array( $this->session->userdata('role'), array(1))){?>
                          <li <?php echo $page == 'dashboard'?'class="active"' : '';?> ><a href="<?php echo base_url('index.php/Dashboard_Rekap'); ?>">
                                <i class="fa fa-tachometer"></i>
                                <span>Recap All Region</span>
                              </a>
                          </li>
                    <?php } ?>
                  </ul>
                </li>



                 <?php if(in_array( $this->session->userdata('role'), array(1,2,3,5,6,7,10) )){?>
                <li class="treeview">
                  <a href="#"><i class="fa fa-map-o"></i>Maps
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                        <?php if(in_array( $this->session->userdata('role'), array(1,2,3,5,6,7,10) )){?>
                        <li <?php if ($page == 'maps') {echo 'class="active"';} ?>>
                          <a href="<?php echo base_url('index.php/Maps'); ?>">
                            <i class="fa fa-map-o"></i>
                            <span>Remote Location</span>
                          </a>
                        </li>
                        <?php } ?>

                        <?php if(in_array( $this->session->userdata('role'), array(1,2,3,5,6,7,10) )){?>
                        <li <?php if ($page == 'mapsfull') {echo 'class="active"';} ?>>
                          <a href="<?php echo base_url('index.php/Maps/fullscreen'); ?>">
                            <i class="fa fa-map-o"></i>
                            <span>All Remote Location</span>
                          </a>
                        </li>
                        <?php }?> 

                        <?php if(in_array( $this->session->userdata('role'), array(1,2,5,6,7,10) )){?>
                        <li <?php if ($page == 'maps-dashboard') {echo 'class="active"';} ?>>
                          <a href="<?php echo base_url('index.php/watch/maps_dasboard'); ?>">
                            <i class="fa fa-tachometer"></i>
                            <span>Maps Dashboard</span>
                          </a>
                        </li>
                      <?php }?>

                        <?php if(in_array( $this->session->userdata('role'), array(1,2,5,6,7,10) )){?>
                        <li <?php if ($page == 'alarm-watch') {echo 'class="active"';} ?>>
                          <a href="<?php echo base_url('index.php/watch/dashboard_down'); ?>">
                            <i class="fa fa-tachometer"></i>
                            <span>Offline Dashboard</span>
                          </a>
                        </li>
                      <?php }?>
                      </ul>
                  </li>
                <?php }?>


                   <?php if(in_array( $this->session->userdata('role'), array(1,5,6,7,10) )){?>
                  <li class="treeview">
                  <a href="#"><i class="fa fa-eye"></i>Watch
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                    <li <?php if ($page == 'main-branch-watch') {echo 'class="active"';} ?>>
                    <a href="<?php echo base_url('index.php/Watch/main_branch'); ?>">
                      <i class="fa fa-eye"></i>
                      <span>Branch Watch</span>
                    </a>
                    </li>
                    <li <?php if ($page == 'sub-watch') {echo 'class="active"';} ?>>
                      <a href="<?php echo base_url('index.php/Watch/sub_branch'); ?>">
                        <i class="fa fa-eye"></i>
                        <span>Sub Branch Watch</span>
                      </a>
                    </li> 
                      <li <?php if ($page == 'atm-priority') {echo 'class="active"';} ?>>
                        <a href="<?php echo base_url('index.php/Watch/priority_atm'); ?>">
                          <i class="fa fa-eye"></i>
                          <span>Priority ATMs</span>
                        </a>
                      </li>
                      </ul>
                  </li>
                <?php }?>
                </ul>
              </li>   

          <?php if(in_array( $this->session->userdata('role'), array(1,5) )){?>
            <li class="treeview  <?php if ($page == 'disable' || $page == 'unused' || $page == 'nop') {echo 'active';} ?>">
              <a href="#">
                <i class="fa fa-ban"></i>
                <span>Disable</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li <?php if ($page == 'disable') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Dashboard/Disable'); ?>">
                    <i class="fa fa-ban"></i>
                    <span>Remote Disable</span>
                  </a>
                </li>
                <li <?php if ($page == 'unused') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Dashboard/Un_Used'); ?>">
                    <i class="fa fa-ban"></i>
                    <span>Network Non Active</span>
                  </a>
                </li>
                <li <?php if ($page == 'nop') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Dashboard/new_list_nop'); ?>">
                    <i class="fa fa-ban"></i>
                    <span>Remote NOP</span>
                  </a>
                </li> 
              </ul>
            </li>         
            
          <?php }
           if(in_array( $this->session->userdata('role'), array(1,2,5,6,10) )){
              $master = array('user','project','spk','remote','jarkom');
          ?>
            <li class="treeview <?php if (in_array($page, $master)) {echo 'active';} ?>">
              <a href="#">
                <i class="fa fa-folder"></i>
                <span>Master</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li <?php if ($page == 'user') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/User'); ?>">
                    <i class="fa fa-users"></i>
                    <span>Master User</span>
                  </a>
                </li>
                <?php 
               if(in_array( $this->session->userdata('role'), array(1,2,3,5,10) )){
                  $master = array('user','project','spk','remote','jarkom');
              ?>
                <li <?php if ($page == 'project') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Master/Project'); ?>">
                    <i class="fa fa-book"></i>
                    <span>Master Project</span>
                  </a>
                </li>
                <li <?php if ($page == 'spk') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Master/SPK'); ?>">
                    <i class="fa fa-book"></i>
                    <span>Master SPK</span>
                  </a>
                </li>
                <li <?php if ($page == 'remote') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Master/Remote'); ?>">
                    <i class="fa fa-building"></i>
                    <span>Master Remote</span>
                  </a>
                </li>
                <li <?php if ($page == 'jarkom') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Master/Network'); ?>">
                    <i class="fa fa-sitemap"></i>
                    <span>Master Network</span>
                  </a>
                </li>
              <?php }?>
              </ul>
            </li>
          <?php }?>


           <?php if(in_array( $this->session->userdata('role'), array(1,2,5,10,11) )){
              $operation = array('req_routing','dash_req_routing','wifi','event','table_shift');
          ?>
            <li class="treeview <?php if (in_array($page, $operation)) {echo 'active';} ?>">
              <a href="#">
                <i class="fa fa-life-ring"></i>
                <span>Operation</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li <?php if ($page == 'req_routing') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Req_Routing'); ?>">
                    <i class="fa fa-code-fork"></i>
                    <span>Routing Ops</span>
                  </a>
                </li>
                <li <?php if ($page == 'dash_req_routing') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Req_Routing/Dashboard'); ?>">
                    <i class="fa fa-tachometer"></i>
                    <span>Dashbord Routing</span>
                  </a>
                </li>
                <li <?php if ($page == 'wifi') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Wifi'); ?>">
                    <i class="fa fa-wifi"></i>
                    <span>Wifi</span>
                  </a>
                </li>
                <li <?php if ($page == 'event') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/EventReport/tableEvent'); ?>">
                    <i class="fa fa-book"></i>
                    <span>Event All</span>
                  </a>
                </li>
        
                <li class="treeview">
                  <a href="#"><i class="fa fa-book"></i>Event By Type
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('index.php/EventReport/list_event_by_type/1'); ?>"><i class="fa fa-tasks"></i>Prev. Maintenance</a></li>
                  <li><a href="<?php echo base_url('index.php/EventReport/list_event_by_type/2'); ?>"><i class="fa fa-cogs"></i>Incident</a></li>
                  <li><a href="<?php echo base_url('index.php/EventReport/list_event_by_type/3'); ?>"><i class="fa fa-plus-circle"></i>Activity</a></li>
                  <li><a href="<?php echo base_url('index.php/EventReport/list_event_by_type/4'); ?>"><i class="fa fa-plus-circle"></i>Event Request</a></li>
                  </ul>
                </li>     
                <li <?php if ($page == 'table_shift') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/ShiftReport/tableShiftReport'); ?>">
                    <i class="fa fa-book"></i>
                    <span>Handover Report</span>
                  </a>
                </li>
              </ul>
            </li>
          <?php }?>
      
      
      <!-- menu untuk reporting [begin]-->
      <?php if(in_array( $this->session->userdata('role'), array(1,5) )){?>
            <li class="treeview  <?php if ($page == 'reporting' || $page == 'main-branch-watch' 
            || $page == 'request-report' || $page == 'naru-reporting' 
            || $page == 'branch-reporting' || $page == 'atm-reporting' 
            || $page == 'sub-watch' || $page == 'alarm-watch' || $page == 'atm-priority'
            || $page == 'event'|| $page == 'table_shift') {echo 'active';} ?>">
              <a href="#">
                <i class="fa fa-file-text-o"></i>
                <span>Reporting</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
        <?php if(in_array( $this->session->userdata('role'), array(1) )){?>
                <li <?php if ($page == 'request-report') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Report/request_report'); ?>">
                    <i class="fa fa-file-text-o"></i>
                    <span>Request Report</span>
                  </a>
                </li>
        <?php }?>
        
                <!-- my task  -->
                
        
        

                <!--<li <?php if ($page == 'naru-reporting') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Dashboard/TestTable'); ?>">
                    <i class="fa fa-eye"></i>
                    <span>NARU Reporting</span>
                  </a>
                </li>-->
                <!--<li <?php if ($page == 'branch-reporting') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Dashboard/TestTable/branch'); ?>">
                    <i class="fa fa-eye"></i>
                    <span>Branch NARU</span>
                  </a>
                </li>-->
                <!--<li <?php if ($page == 'atm-reporting') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Dashboard/TestTable/atm'); ?>">
                    <i class="fa fa-eye"></i>
                    <span>ATM NARU</span>
                  </a>
                </li>-->
                


                <!-- [end] my task -->
                 
              </ul>
            </li> 
          <?php } ?>
      
      
      <li class="treeview">
        <a href="#">
        <i class="fa fa-wrench"></i> <span>Tools</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
        <?php if(in_array( $this->session->userdata('role'), array(1,5) )){?>
        <li class="treeview">
          <a href="#"><i class="fa fa-code-fork"></i>Router
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-file-code-o"></i>Template</a></li>
          <li><a href="#"><i class="fa fa-cogs"></i>List Config</a></li>
          <li><a href="<?php echo base_url('index.php/Configure/add'); ?>"><i class="fa fa-plus-circle"></i>Add New Config</a></li>
          </ul>
        </li>
        <?php } ?>
        <li class="treeview">
          <a href="#"><i class="fa fa-lightbulb-o"></i>Troubleshoot
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="<?php echo base_url('index.php/Troubleshoot/test_ping'); ?>"><i class="fa fa-spinner"></i>Ping</a></li>
          <li><a href="<?php echo base_url('index.php/Troubleshoot/test_traceroute'); ?>"><i class="fa fa-random"></i>Traceroute</a></li>
          <li><a href="<?php echo base_url('index.php/Troubleshoot/speedtest'); ?>"><i class="fa fa-cloud-download"></i>Speedtest</a></li>
          
          </ul>
        </li>
        <!--<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>-->
        </ul>
      </li>

      
       
      
        <li <?php if ($page == 'alarm') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('index.php/Master/Alarm'); ?>">
                <i class="fa fa-warning"></i>
                <span>Alarm</span>
              </a>
            </li>
      
      <?php if(in_array( $this->session->userdata('role'), array(1,5) )){?>
      <li class="treeview  <?php if ($page == 'main-branch-watch' || $page == 'request-report' || $page == 'naru-reporting' || $page == 'branch-reporting') {echo 'active';} ?>">
              <a href="#">
                <i class="fa fa-lightbulb-o"></i>
                <span>Support</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li <?php if ($page == 'request-report') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('#'); ?>">
                    <i class="fa fa-book"></i>
                    <span>Manual Book</span>
                  </a>
                </li>
        <li <?php if ($page == 'main-branch-watch') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('#'); ?>">
                    <i class="fa fa-comment"></i>
                    <span>Comments</span>
                  </a>
                </li>
                <li <?php if ($page == 'naru-reporting') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('#'); ?>">
                    <i class="fa fa-history"></i>
                    <span>Changelog</span>
                  </a>
                </li>
      <?php }?>

                <!-- [end] my task -->
                 
              </ul>
            </li> 
      
      <!-- menu untuk reporting [end]-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>