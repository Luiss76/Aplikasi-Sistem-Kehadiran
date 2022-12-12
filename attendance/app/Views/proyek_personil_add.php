<form class="form-horizontal" method="post"  action="<?php echo site_url('Proyek/personilAdd');?>"  >
	<input type="hidden" name="id_proyek" value="<?php echo $id_proyek;?>">
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="id_pegawai">Pegawai</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='id_pegawai' name='id_pegawai' required>
			<option value="">Select Pegawai</option>
			<?php
			if($mpegawai->getNumRows()>0){
				foreach ($mpegawai->getResult() as $row){
					echo'<option value="'.$row->id_pegawai.'">'.$row->nama.'</option>';
				}
			}
			?>
		</select>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="posisi">Posisi</label>
	  <div class="col-md-9">
		<input type="text" id="posisi" name="posisi" class="form-control" placeholder="Posisi" required>
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