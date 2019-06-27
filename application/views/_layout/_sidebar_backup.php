<aside class="main-sidebar" style="position:fixed;">
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
            <li class="treeview  <?php if ($page == 'kanwil' || $page == 'prov') {echo 'active';} ?>">
              <a href="#">
                <i class="fa fa-tachometer"></i>
                <span>Gauge Chart</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a>
			  <ul class="treeview-menu">
          <?php if(in_array( $this->session->userdata('role'), array(1,3,5,6,7) )){?>
                <li <?php if ($page == 'kanwil') {echo 'class="active"';} ?>><a href="<?php echo base_url('index.php/Dashboard/All_Kanwil'); ?>">
                      <i class="fa fa-tachometer"></i>
                      <span>Region</span>
                    </a>
                </li>
          <?php }
               if(in_array( $this->session->userdata('role'), array(1,2,3,5,10) )){?>
                <li <?php if ($page == 'prov') {echo 'class="active"';} ?>><a href="<?php echo base_url('index.php/Dash_Provider'); ?>">
                      <i class="fa fa-tachometer"></i>
                      <span>Provider</span>
                    </a>
                </li>
          <?php }
			   if(in_array( $this->session->userdata('role'), array(1) )){?>
                <li><a href="<?php echo base_url('index.php/Dashboard_Rekap'); ?>">
                      <i class="fa fa-tachometer"></i>
                      <span>Recap All Region</span>
                    </a>
                </li>
          <?php } ?>
              </ul>
            </li>
          <?php if(in_array( $this->session->userdata('role'), array(1,5) )){?>
            <li class="treeview  <?php if ($page == 'disable' || $page == 'unused') {echo 'active';} ?>">
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
              </ul>
            </li>         
			
            <li class="treeview" <?php if ($page == 'maps' || $page == 'mapsfull') {echo 'class="active"';} ?>>
              <a href="#">
                <i class="fa fa-map-o"></i>
                <span>Remote Location</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
                </span>
              </a> 
			  <ul class="treeview-menu">
                <li <?php if ($page == 'maps') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Maps'); ?>">
                    <i class="fa fa-map-o"></i>
                    <span>Remote Location</span>
                  </a>
                </li>
                <li <?php if ($page == 'mapsfull') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Maps/fullscreen'); ?>">
                    <i class="fa fa-map-o"></i>
                    <span>All Remote Location</span>
                  </a>
                </li> 
              </ul>
            </li>
			
          <?php }
           if(in_array( $this->session->userdata('role'), array(1,6) )){?>
            <li <?php if ($page == 'user') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('index.php/User'); ?>">
                <i class="fa fa-users"></i>
                <span>Master User</span>
              </a>
            </li>
          <?php }?>
		  
		  
		  <!-- menu untuk reporting [begin]-->
		  <?php if(in_array( $this->session->userdata('role'), array(1,5) )){?>
            <li class="treeview  <?php if ($page == 'reporting' || $page == 'request-report' || $page == 'naru-reporting' || $page == 'branch-reporting' || $page == 'atm-reporting') {echo 'active';} ?>">
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
				<li <?php if ($page == 'main-branch-watch') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Watch/main_branch'); ?>">
                    <i class="fa fa-file-text-o"></i>
                    <span>Branch Watch</span>
                  </a>
                </li>
                <li <?php if ($page == 'naru-reporting') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Dashboard/TestTable'); ?>">
                    <i class="fa fa-file-text-o"></i>
                    <span>NARU Reporting</span>
                  </a>
                </li>
                <li <?php if ($page == 'branch-reporting') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Dashboard/TestTable/branch'); ?>">
                    <i class="fa fa-file-text-o"></i>
                    <span>Branch NARU</span>
                  </a>
                </li>
                <li <?php if ($page == 'atm-reporting') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/Dashboard/TestTable/atm'); ?>">
                    <i class="fa fa-file-text-o"></i>
                    <span>ATM NARU</span>
                  </a>
                </li>

                <!-- my task  -->
                <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/EventReport/tableEvent'); ?>">
                    <i class="fa fa-book"></i>
                    <span>Event Report</span>
                  </a>
                </li>

                <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('index.php/ShiftReport/tableShiftReport'); ?>">
                    <i class="fa fa-book"></i>
                    <span>Shifting Report</span>
                  </a>
                </li>

                <!-- [end] my task -->
                 
              </ul>
            </li> 
          <?php } ?>
		  <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('index.php/Home'); ?>">
                <i class="fa fa-search"></i>
                <span>Quick Search</span>
              </a>
            </li>
		  <!-- menu untuk reporting [end]-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>