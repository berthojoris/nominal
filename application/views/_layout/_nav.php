<nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
							
							 <!--<li class="dropdown messages-menu">
                                <form action="<?php echo base_url();?>index.php/Home" class="form" method="post" style="width: 300px;margin-top: 8px">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search... (IP LAN / IP WAN / Remote name)">
                                        <span class="input-group-btn">
                                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </li>-->
							
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="user-image" alt="User Image"/>
                                    <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="img-circle" alt="User Image" />
                                        <p>
                                            <?php echo $this->session->userdata('nama'); ?> / <?php echo $this->session->userdata('nama_role'); ?>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left" style="">
                                            <a href="<?php echo site_url('user/edit/'.$this->session->userdata('id')); ?>" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo site_url('dashboard/logout'); ?>" class="btn btn-danger btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>