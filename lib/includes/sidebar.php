<input type="hidden" name="BASE_URL" id="BASE_URL" value="<?php echo BASE_URL; ?>" />
	
	<section id="sidebar">
		<a class="logo" href="<?php echo BASE_URL; ?>dashboard/home">API Documentor</a>
		<nav>
			<ul>
				<li><a class="documentation" href="dashboard/home">Manage Documentation</a></li>
				<li><a class="add create" href="dashboard/add">Create Documentation</a></li>
				<li><a class="users" href="dashboard/users">Manage Users</a></li>
				<li><a class="add create" href="dashboard/add-user">Create User</a></li>
				<li><a class="categories" href="dashboard/categories">Manage Categories</a></li>
				<li><a class="add create" href="dashboard/add-category">Create Category</a></li>
				<li><a class="logout" href="dashboard/">Logout</a></li>
			</ul>
		</nav><!-- End nav -->
		<footer>
			<span>Version: <?php echo VERSION; ?></span>
		</footer>
		<div class="clear"></div>
	</section><!-- End sidebar -->