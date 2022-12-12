<form class="form-horizontal" method="post"  action="<?php echo site_url('Admin/create');?>"  >
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-left" for="roles">Roles</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='roles' name='roles' required>
			<option value="">Select Roles</option>
			<?php
			foreach ($mroles as $val){
				echo'<option value="'.$val.'">'.$val.'</option>';
			}
			?>
		</select>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-left" for="nama">Nama</label>
	  <div class="col-md-9">
		<input type="text" id="nama" name="nama" class="form-control" placeholder="nama" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-left" for="email">Email</label>
	  <div class="col-md-9">
		<input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-left" for="username">Username</label>
	  <div class="col-md-9">
		<input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-left" for="password">Password</label>
	  <div class="col-md-9">
		<input type="password" id="password" name="password" class="form-control" placeholder="Password">
	  </div>
	</div>
	<div class="form-group row">
	  <div class="offset-sm-3 col-sm-9">
		<button type="submit" id="btn-save" class="btn btn-md btn-primary btn-round">
			<i class="ace-icon fa fa-save"></i> Save
		</button>
		<button type="button" class="btn btn-md btn-danger btn-round" data-dismiss="modal">
			<i class="ace-icon fa fa-ban"></i> Cancel 
		</button>
	  </div>
	</div>
 </form>