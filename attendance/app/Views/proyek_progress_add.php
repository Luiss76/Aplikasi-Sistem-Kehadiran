<form class="form-horizontal" method="post"  action="<?php echo site_url('Proyek/progressAdd');?>">
	<input type="hidden" name="id_proyek" value="<?php echo $id_proyek;?>">
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="tanggal">Tanggal</label>
	  <div class="col-md-9">
		<input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo $tanggal;?>" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="keterangan">Keterangan</label>
	  <div class="col-md-9">
		<textarea id="keterangan" rows="5" name="keterangan" class="form-control" placeholder="Keterangan" required></textarea>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="prosentase">Prosentase</label>
	  <div class="col-md-9">
		<input type="number" id="prosentase" name="prosentase" class="form-control" placeholder="Prosentase %" required>
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