<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
	<link rel="icon" href="<?php echo base_url('public/sbadmin2/img/favicon.png'); ?>" type="image/x-icon"/>
    <link href="<?php echo base_url('public/sbadmin2/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">
    <link href="<?php echo base_url('public/sbadmin2/css/sb-admin-2.min.css');?>" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                           <div class="col-lg-12">
                                <div class="p-5">
									<div class="text-center" style="margin-left:35%;margin-right:35%;margin-bottom:10px;">
										<img width="100%" src="<?php echo base_url('public/sbadmin2/img/logo.png');?>" class="img-responsive">
									</div>
									<?php
									$this->session = \Config\Services::session();
									if ($this->session->getFlashdata('error_login')){
										echo'
										<div class="text-center">
											<h1 class="h4 text-gray-900 mb-4"><i class="fa fa-exclamation-triangle"></i>  '.$this->session->getFlashdata('error_login').'</h1>
										</div>';
									}else{
										echo'
										<div class="text-center">
											<h1 class="h4 text-gray-900 mb-4">Login Sistem</h1>
										</div>';
									}
									?>
                                    
                                    <form class="user" action="<?php echo base_url('login');?>" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="exampleInputUsername" aria-describedby="emailHelp" name="username" placeholder="Enter Username..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('public/sbadmin2/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/sbadmin2/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/sbadmin2/js/sb-admin-2.min.js'); ?>"></script>
</body>
</html>