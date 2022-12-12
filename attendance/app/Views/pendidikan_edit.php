<form class="form-horizontal" method="post"  action="<?php echo site_url('pendidikan/edit');?>" enctype="multipart/form-data">
	<input type="hidden" name="id_pendidikan" id="id_pendidikan" value="<?php echo $mdata->id_pendidikan;?>">
	<div class="form-group row">
	  <label class="col-md-2 col-form-label text-right" for="jenjang">Jenjang</label>
	  <div class="col-md-8">
		<input type="text" id="jenjang" name="jenjang" class="form-control" value="<?php echo $mdata->jenjang;?>" placeholder="Jenjang" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-2 col-form-label text-right" for="keterangan">Keterangan</label>
	  <div class="col-md-8">
		<textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" required><?php echo $mdata->keterangan;?></textarea>
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