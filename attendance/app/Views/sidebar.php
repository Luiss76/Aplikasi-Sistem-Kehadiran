<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url();?>">
		<div class="sidebar-brand-icon">
			<img width="75%" src="<?php echo base_url('public/sbadmin2/img/logo.png');?>" class="img-responsive"></i>
		</div>
		<div class="sidebar-brand-text mx-3">ATTENDANCE</div>
	</a>
	<!-- Divider -->
	<hr class="sidebar-divider">
	<div class="sidebar-heading">
		Dashboard
	</div>
	<!-- Heading -->
	<li class="nav-item">
		<a class="nav-link" href="<?php echo base_url();?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>
	</li>
	<!-- Divider -->
	<hr class="sidebar-divider">
	<div class="sidebar-heading">
		Master
	</div>
	<!-- Heading -->
	<li class="nav-item">
		<a class="nav-link" href="<?php echo base_url('Lokasi');?>">
			<i class="fas fa-fw fa-map-marker"></i>
			<span>Lokasi</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo base_url('Jabatan');?>">
			<i class="fas fa-fw fa-sitemap"></i>
			<span>Jabatan</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo base_url('Departemen');?>">
			<i class="fas fa-fw fa-building"></i>
			<span>Departemen</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo base_url('Pendidikan');?>">
			<i class="fas fa-fw fa-graduation-cap"></i>
			<span>Pendidikan</span>
		</a>
	</li>
	<!-- Divider -->
	<hr class="sidebar-divider">
	<div class="sidebar-heading">
		Data
	</div>
	<!-- Divider -->
	<li class="nav-item">
		<a class="nav-link" href="<?php echo base_url('Pegawai');?>">
			<i class="fas fa-fw fa-user"></i>
			<span>Pegawai</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo base_url('Absensi');?>">
			<i class="fas fa-fw fa-fingerprint "></i>
			<span>Absensi</span>
		</a>
	</li>
	<!-- Divider -->
	<hr class="sidebar-divider">
	<div class="sidebar-heading">
		Pengaturan
	</div>
	<!-- Divider -->
	<li class="nav-item">
		<a class="nav-link" href="<?php echo base_url('Admin');?>">
			<i class="fas fa-fw fa-lock"></i>
			<span>Admin</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
			<i class="fas fa-fw fa-sign-out-alt"></i>
			<span>Logout</span>
		</a>
	</li>
	
	<hr class="sidebar-divider d-none d-md-block">
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>