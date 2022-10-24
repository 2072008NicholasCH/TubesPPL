<div class="wrapper">
	<!-- Sidebar -->
	<nav id="sidebar">
		<div class="sidebar-header">
			<h3>Tubes PPL</h3>
		</div>

		<ul class="list-unstyled components">
			<p>Dummy Heading</p>
			<li class="active">
				<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
				<ul class="collapse list-unstyled" id="homeSubmenu">
					<li>
						<a href="#">Home 1</a>
					</li>
					<li>
						<a href="#">Home 2</a>
					</li>
					<li>
						<a href="#">Home 3</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">About</a>
			</li>
			<li>
				<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
				<ul class="collapse list-unstyled" id="pageSubmenu">
					<li>
						<a href="#">Page 1</a>
					</li>
					<li>
						<a href="#">Page 2</a>
					</li>
					<li>
						<a href="#">Page 3</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Portfolio</a>
			</li>
			<li>
				<a href="#">Contact</a>
			</li>
			<?php
			if ($_SESSION['user']) {
				echo '<li>
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

	<div class="container">

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">

				<button type="button" id="sidebarCollapse" class="btn btn-info">
					<i class="fas fa-align-left"></i>
					<span>Toggle Sidebar</span>
				</button>


			</div>
		</nav>
		<h2>Berita Acara PBM Ganjil 2022/2023</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam et tempor eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc mollis lectus vel massa fermentum accumsan. In hac habitasse platea dictumst. Maecenas vitae gravida sapien, et accumsan orci. Sed condimentum quam sed erat vehicula, ac lacinia ligula bibendum. Ut tristique, est sit amet porta sagittis, ante quam cursus neque, ut semper eros ligula vitae neque. Maecenas mollis sem ac nulla consequat congue non sit amet dui. In nec nulla dapibus enim varius blandit a et augue. Nunc non leo vel ex semper imperdiet. Pellentesque sit amet magna luctus orci lacinia maximus. Quisque pretium vulputate ante. Suspendisse feugiat velit a nunc varius interdum. Quisque sed pharetra nisl, semper porttitor augue. Cras ultrices arcu neque, eu sollicitudin velit suscipit non. Pellentesque in nisi vehicula, scelerisque ligula eget, tincidunt leo.</p>

		<input type="text" class="form-control" />
	</div>

	<?php
	if (!$_SESSION['user']) {
	?>
		<div class="row">
			<div class="col-md-12 text-right m-3">
				<a href="?ahref=login"><button type="button" class="btn btn-primary">Login</button></a>
			</div>
		</div>

	<?php

	}
	?>
</div>

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<script>
	$(document).ready(function() {

		$('#sidebarCollapse').on('click', function() {
			$('#sidebar').toggleClass('active');
		});

	});
</script>