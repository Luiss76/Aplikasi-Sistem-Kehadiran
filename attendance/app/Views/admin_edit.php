<form class="form-horizontal" method="post"  action="<?php echo site_url('user/edit');?>"  >
	<input type="hidden" name="id_pegawai" id="id_pegawai" value="<?php echo $mdata->id_pegawai;?>">
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-left" for="roles">Roles</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='roles' name='roles' required>
			<option value="">Select Roles</option>
			<?php
			foreach ($mroles as $val){
				$selected=($mdata->roles=$val) ? "selected" : "";
				echo'<option value="'.$val.'" '.$selected.'>'.$val.'</option>';
			}
			?>
		</select>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-left" for="nama">Nama</label>
	  <div class="col-md-9">
		<input type="text" id="nama" name="nama" class="form-control" value="<?php echo $mdata->nama;?>" placeholder="nama" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-left" for="email">Email</label>
	  <div class="col-md-9">
		<input type="email" id="email" name="email" class="form-control" value="<?php echo $mdata->email;?>" placeholder="Email" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-left" for="username">Username</label>
	  <div class="col-md-9">
		<input type="text" id="username" name="username" class="form-control" value="<?php echo $mdata->username;?>" placeholder="Username" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-left" for="newpassword">New Password</label>
	  <div class="col-md-9">
		<input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="New Password">
	  </div>
	</div>
	<div class="form-group row">
	  <div class="offset-sm-3 col-sm-9">
		<button type="submit" id="btn-save" class="btn btn-md btn-primary btn-round">
			<i class="ace-icon fa fa-save"></i> Update
		</button>
		<button type="button" class="btn btn-md btn-danger btn-round" data-dismiss="modal">
			<i class="ace-icon fa fa-ban"></i> Cancel 
		</button>						
	  </div>
	</div>
</form>