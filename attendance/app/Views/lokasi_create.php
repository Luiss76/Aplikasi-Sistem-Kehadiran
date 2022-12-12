<form class="form-horizontal" method="post"  action="<?php echo site_url('Lokasi/create');?>" enctype="multipart/form-data">
	<div class="form-group row">
	  <label class="col-md-2 col-form-label text-right" for="lokasi">Lokasi</label>
	  <div class="col-md-8">
		<input type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Lokasi" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-2 col-form-label text-right" for="alamat">Alamat</label>
	  <div class="col-md-8">
		<textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" required></textarea>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-2 col-form-label text-right" for="latitude">Latitude</label>
	  <div class="col-md-8">
		<input type="text" id="latitude" name="latitude" class="form-control" placeholder="Latitude" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-2 col-form-label text-right" for="longitude">Longitude</label>
	  <div class="col-md-8">
		<input type="text" id="longitude" name="longitude" class="form-control" placeholder="Longitude" required>
	  </div>
	</div>
	<div class="form-group row">
	  <div class="offset-sm-2 col-sm-10">
		<button type="submit" id="btn-save" class="btn btn-md btn-primary btn-round">
			<i class="ace-icon fa fa-save"></i> Save
		</button>
		<button type="button" class="btn btn-md btn-danger btn-round" data-dismiss="modal">
			<i class="ace-icon fa fa-ban"></i> Cancel 
		</button>
	  </div>
	</div>
</form>