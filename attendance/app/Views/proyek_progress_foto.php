<form class="form-horizontal" method="post"  action="<?php echo site_url('Proyek/progressAddFoto');?>"  enctype='multipart/form-data'>
	<input type="hidden" name="id_proyek" value="<?php echo $id_proyek;?>">
	<input type="hidden" name="id_progress" value="<?php echo $id_progress;?>">
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="foto">Foto</label>
	  <div class="col-md-9">
		<input type="file" id="foto" name="foto" class="form-control" placeholder="Foto" required>
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