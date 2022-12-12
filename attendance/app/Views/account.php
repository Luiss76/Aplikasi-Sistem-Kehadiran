<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="row">
				<div class="col-xl-9 col-lg-9">
					<div class="card shadow mb-4">
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">Account</h6>
							<div class="dropdown no-arrow">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-filter fa-sm fa-fw text-gray-400"></i>
								</a>
								
							</div>
						</div>
						<!-- Card Body -->
						<div class="card-body" id="card-content">
							<form class="form-horizontal" method="post"  action="<?php echo site_url('account/update');?>">
								<div class="form-group row">
								  <label class="col-md-2 col-form-label text-right" for="nama">Nama</label>
								  <div class="col-md-9">
									<input type="text" id="nama" name="nama" class="form-control" value="<?php echo $mdata->nama;?>" placeholder="Nama" readonly>
								  </div>
								</div>
								<div class="form-group row">
								  <label class="col-md-2 col-form-label text-right" for="username">Username</label>
								  <div class="col-md-9">
									<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $mdata->username;?>" readonly>
								  </div>
								</div>
								<div class="form-group row">
								  <label class="col-md-2 col-form-label text-right" for="newpassword">Ganti Password</label>
								  <div class="col-md-9">
										<input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Input New Password" required >
								  </div>
								</div>
								<div class="form-group row">
								  <label class="col-md-2 col-form-label text-right" for="newpasswordconfirm">Konfirmasi Password</label>
								  <div class="col-md-9">
									<input type="password" class="form-control" id="newpasswordconfirm" name="newpasswordconfirm" placeholder="Confirm Password"  required >
								  </div>
								</div>
								<div class="form-group row">
								  <div class="offset-sm-2 col-sm-10">
									<button type="submit" id="btn-save" class="btn btn-md btn-primary btn-round">
										<i class="ace-icon fa fa-save"></i> Update
									</button>
									<button type="button" class="btn btn-md btn-danger btn-round" data-dismiss="modal">
										<i class="ace-icon fa fa-ban"></i> Cancel 
									</button>
								  </div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Area Chart -->
				<div class="col-xl-3 col-lg-3 text-center">
					<div class="card shadow mb-4">
						<!-- Card Header - Dropdown -->
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">Photo</h6>
						</div>
						<div class="card-body">
							<img class="img-responsive" width="80%"  src="<?php echo base_url('public/uploads/admin/'.$mdata->foto.'');?>" />
							<div class="user-profile text-center">
								<div class="name mb-1"></div>
								<div class="view-profile">
									<div class="input-file input-file-image">
										<form id="photoForm" method="post"  action="<?php echo site_url('account/upload');?>" enctype='multipart/form-data'>
											<input type="file" class="btn-primary form-control form-control-file" id="avatar" name="avatar" accept="image/*" required>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
var password = document.getElementById("newpassword");
var confirmpassword = document.getElementById("newpasswordconfirm");

function validatePassword(){
  if(password.value != confirmpassword.value) {
    confirmpassword.setCustomValidity("Passwords Don't Match");
  } else {
    confirmpassword.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirmpassword.onkeyup = validatePassword;
</script>