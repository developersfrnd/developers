<!-- Sidebar user panel (optional) -->
<div class="user-panel">
	<div class="pull-left image">
	  <img src="{{ asset('assets/images') }}/logo.jpg" class="img-circle" alt="Admin Image">
	</div>
	<div class="pull-left info">
	  <p>Admin</p>
	</div>
</div>
<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
	<li><a href="{{ url($ADMIN_URL.'/categories') }}"><i class="fa fa-link"></i> <span>Manage Categories</span></a></li>
	<li><a href="{{ url($ADMIN_URL.'/users') }}"><i class="fa fa-link"></i> <span>Manage Users</span></a></li>
	<li><a href="{{ url($ADMIN_URL.'/blogs') }}"><i class="fa fa-link"></i> <span>Manage Blogs</span></a></li>
	<li><a href="{{ url($ADMIN_URL.'/tags') }}"><i class="fa fa-link"></i> <span>Manage Tags</span></a></li>
</ul>
   