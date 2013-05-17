<input type="hidden" name="BASE_URL" id="BASE_URL" value="<?php echo BASE_URL; ?>" />
	
	<section id="sidebar">
		<a class="logo" href="<?php echo BASE_URL; ?>home">API Documentor</a>
		<nav>
			<ul>
				<li><a href="dashboard/home">Manage Documentation</a></li>
				<li><a class="add" href="dashboard/add">Create Documentation</a></li>
				<li><a href="dashboard/users">Manage Users</a></li>
				<li><a class="add" href="dashboard/add-user">Create User</a></li>
				<li><a href="dashboard/categories">Manage Categories</a></li>
				<li><a class="add" href="dashboard/add-category">Create Category</a></li>
				<li><a class="logout" href="">Logout</a></li>
			</ul>
		</nav><!-- End nav -->
		<footer>
			<span>Version: <?php echo VERSION; ?></span>
		</footer>
		<div class="clear"></div>
	</section><!-- End sidebar -->