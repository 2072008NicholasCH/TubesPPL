<div class="wrapper">
	
	<?php include_once 'view/template/sidebar.php'; ?>

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

		<!-- <input type="text" class="form-control" /> -->
	</div>

	<?php
	if (!$_SESSION['user']) {
	?>
		<div class="row">
			<div class="col-2 text-right m-3">
				<a href="?ahref=login"><button type="button" class="btn btn-primary">Login</button></a>
			</div>
		</div>

	<?php

	}
	?>
</div>

