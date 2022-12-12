<form class="form-horizontal" method="post"  action="<?php echo site_url('Lokasi/edit');?>" enctype="multipart/form-data">
	<input type="hidden" name="id_lokasi" id="id_lokasi" value="<?php echo $mdata->id_lokasi;?>">
	<div class="form-group row">
	  <label class="col-md-2 col-form-label text-right" for="nama">Lokasi</label>
	  <div class="col-md-8">
		<input type="text" id="lokasi" name="lokasi" class="form-control" value="<?php echo $mdata->lokasi;?>" placeholder="Lokasi" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-2 col-form-label text-right" for="alamat">Alamat</label>
	  <div class="col-md-8">
		<textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" required><?php echo $mdata->alamat;?></textarea>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-2 col-form-label text-right" for="latitude">Latitude</label>
	  <div class="col-md-8">
		<input type="text" id="latitude" name="latitude" class="form-control" value="<?php echo $mdata->latitude;?>" placeholder="Latitude" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-2 col-form-label text-right" for="longitude">Longitude</label>
	  <div class="col-md-8">
		<input type="text" id="longitude" name="longitude" class="form-control" value="<?php echo $mdata->longitude;?>" placeholder="Longitude" required>
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