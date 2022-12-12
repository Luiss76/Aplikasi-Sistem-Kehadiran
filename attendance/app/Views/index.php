<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo APP_NAMESPACE;?></title>
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">
	<link href="<?php echo base_url('public/sbadmin2/img/favicon.png'); ?>" rel="icon" type="image/x-icon"/>
    <link href="<?php echo base_url('public/sbadmin2/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/sbadmin2/css/sb-admin-2.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('public/sbadmin2/css/mystyle.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('public/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('public/sbadmin2/vendor/jquery/jquery-ui.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('public/sbadmin2/vendor/select2/css/select2.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('public/sbadmin2/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('public/sbadmin2/vendor/jquery/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/sbadmin2/vendor/jquery-ui-1.10.3/jquery-ui.js'); ?>"></script>
    <script src="<?php echo base_url('public/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/sbadmin2/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/sbadmin2/vendor/select2/js/select2.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/sbadmin2/vendor/sweetalert/sweetalert.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/sbadmin2/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'); ?>"></script>
	<script>var BaseUrl='<?php echo base_url();?>';</script>
	<script src="<?php echo base_url('public/sbadmin2/js/myscript.js'); ?>"></script>
</head>
<?php
$this->session = \Config\Services::session();
$this->model= new \App\Models\AppModel();
$this->auth = new \App\Libraries\Auth();
$this->setting = new \App\Libraries\Setting();
?>	
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
		<?php echo view('sidebar');?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->auth->nama ?></span>
                                <img class="img-profile rounded-circle" src="<?php echo base_url('public/uploads/admin/'.$this->auth->foto.'');?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo base_url('account');?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Account
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <?php echo view($page);?>
            </div>
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?php echo APP_NAMESPACE;?> <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
	<div class="modal fade" id="form-modal" role="dialog" aria-hidden="true" data-backdrop="static" tabindex="-1">
		<div id="form-modal-dialog" class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header no-bd">
					<h5 id="form-modal-title" class="modal-title">
						<span class="fw-mediumbold">
							New Row
						</span> 
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="form-modal-content" class="modal-body">
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="confirm-delete" role="dialog" aria-hidden="true" data-backdrop="static" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title">Konfirmasi</p>
				</div>
				<div class="modal-body">
					Apakah ingin menghapus data ini ?
				</div>
				<div class="modal-footer">
					<a class="btn btn-danger btn-ok btn-sm btn-round">Ya</a>
					<button type="button" class="btn btn-primary btn-sm btn-round" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">End your current session ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo base_url('logout');?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
	<script src="<?php echo base_url('public/sbadmin2/js/sb-admin-2.min.js'); ?>"></script>
	<script>
	<?php if($this->session->getFlashdata('info')){ ?>
		swal({
			title: "Informasi",
			text: "<?php echo  $this->session->getFlashdata('info');?>",
			icon: "success",
			button: "Ok",
			timer: 1500
		});
	<?php }?>
	</script>
	</body>
</html>