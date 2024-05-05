<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
								data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
								data-bs-toggle="dropdown">
								<img src="<?php echo base_url("img/avatars/avatar.jpg"); ?>" class="avatar img-fluid rounded me-1"
									alt="Charles Hall" /> <span class="text-dark"><?= session()->get('nama_user'); ?> | <?php if (session()->get('level') == 1) {
                                                                                                                        echo 'Admin 1';
                                                                                                                    } elseif (session()->get('level') == 2) {
                                                                                                                        echo 'Admin 2';
                                                                                                                    } else {
                                                                                                                        echo 'Guest';
                                                                                                                    } ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="<?php echo base_url('/login'); ?>">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>