				<div class="wrapper d-flex align-items-stretch">
				  <nav id="sidebar">
				    <div class="custom-menu">
				      <button type="button" id="sidebarCollapse" class="btn btn-primary">
				        <i class="fa fa-bars"></i>
				        <span class="sr-only">Toggle Menu</span>
				      </button>
				    </div>
				    <h1><a href="index.html" class="logo">Tubes PPL</a></h1>
				    <ul class="list-unstyled components mb-5">
				      <li class="active">
				        <a href="#"><span class="fa fa-home mr-3"></span> Homepage</a>
				      </li>
				      <li>
				        <a href="#"><span class="fa fa-user mr-3"></span> Dashboard</a>
				      </li>
				      <li>
				        <a href="#"><span class="fa fa-duotone fa-gear mr-3"></span> Settings</a>
				      </li>
				      <li>
				        <a href="#"><span class="fa fa-paper-plane mr-3"></span> Information</a>
				      </li>
					  <?php
					  	if ($_SESSION['user']){
							echo'<li>
							<a onclick="logOut()"><span class="fa fa-regular fa-right-from-bracket mr-3"></span> Log Out</a>
							<script>
							  function logOut() {
								const confirm = window.confirm("Are you sure want to sign out?");
								if (confirm) {
								  window.location = "index.php?ahref=logout";
								}
							  }
							</script>
						  </li>';
						}
					  ?>
				      
				    </ul>

				  </nav>

				  <!-- Page Content  -->
				  <div id="content" class="p-4 p-md-5 pt-5">
				    <?php
            if (!$_SESSION['user']) {
            ?>
				      <div class="row">
				        <div class="col-md-12 text-right">
				          <a href="?ahref=login"><button type="button" class="btn btn-primary">Login</button></a>
				        </div>
				      </div>
				    <?php

            }
            ?>

				    <h2 class="mb-4">Berita Acara PBM Ganjil 2022/2023</h2>
				    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				  </div>
				</div>

				<script src="js/jquery.min.js"></script>
				<script src="js/popper.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<script src="js/main.js"></script>