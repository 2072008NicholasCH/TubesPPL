<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Tubes PPL</h3>
    </div>

    <ul class="list-unstyled components">
        <p>Dummy Heading</p>
        <li class="active">
            <a href="index.php?ahref=home" >Home</a>
            <!-- <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a> -->
            <!-- <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="#">Home 1</a>
                </li>
                <li>
                    <a href="#">Home 2</a>
                </li>
                <li>
                    <a href="#">Home 3</a>
                </li>
            </ul> -->
        </li>
        <?php if ($_SESSION['user'] && ($_SESSION['user_role_id'] == 3 || $_SESSION['user_role_id'] == 1)) { ?>
        <li>
            <a href="#dosenSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Dosen</a>
            <ul class="collapse list-unstyled" id="dosenSubmenu">
                <li>
                    <a href="index.php?ahref=dosen">Dashboard</a>
                </li>
                <li>
                    <a href="index.php?ahref=dosen-berita-acara">Berita Acara</a>
                </li>
            </ul>
        </li>
        <?php } ?>
        <?php  if ($_SESSION['user'] && ($_SESSION['user_role_id'] == 2 || $_SESSION['user_role_id'] == 1)) { ?>
        <li>
            <a href="#staffSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Staff</a>
            <ul class="collapse list-unstyled" id="staffSubmenu">
                <li>
                    <a href="index.php?ahref=staff">Dashboard</a>
                </li>
                <li>
                    <a href="index.php?ahref=staff-berita-acara">Berita Acara</a>
                </li>
                <li>
                    <a href="index.php?ahref=staff-jadwal">Jadwal</a>
                </li>
                <li>
                    <a href="index.php?ahref=staff-mata-kuliah">Mata Kuliah</a>
                </li>
                <li>
                    <a href="index.php?ahref=staff-ruangan">Ruangan</a>
                </li>
                <li>
                    <a href="index.php?ahref=staff-semester">Semester</a>
                </li>
            </ul>
        </li>
        <?php  } ?>
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