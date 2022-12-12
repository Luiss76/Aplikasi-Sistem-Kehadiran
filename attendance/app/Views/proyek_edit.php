<form class="form-horizontal" method="post"  action="<?php echo site_url('Proyek/edit');?>"  >
	<input type="hidden" name="id_proyek" id="id_proyek" value="<?php echo $mdata->id_proyek;?>">
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="nama_proyek">Nama Proyek</label>
	  <div class="col-md-9">
		<input type="text" id="nama_proyek" name="nama_proyek" class="form-control" value="<?php echo $mdata->nama_proyek;?>" placeholder="Nama Proyek" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="deskripsi_proyek">Deskripsi Proyek</label>
	  <div class="col-md-9">
		<textarea id="deskripsi_proyek" name="deskripsi_proyek" class="form-control" placeholder="Deskripsi Proyek" required><?php echo $mdata->deskripsi_proyek;?></textarea>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="alamat_proyek">Alamat Proyek</label>
	  <div class="col-md-9">
		<textarea id="alamat_proyek" name="alamat_proyek" class="form-control" placeholder="Alamat Proyek" required><?php echo $mdata->alamat_proyek;?></textarea>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="latitude">Titik Koordinat</label>
	  <div class="col-md-4">
		<input type="text" id="latitude" name="latitude" class="form-control" value="<?php echo $mdata->latitude;?>" placeholder="Latitude" required>
	  </div>
	  <label class="col-md-1 col-form-label text-center" for="sd">-</label>
	  <div class="col-md-4">
		<input type="text" id="longitude" name="longitude" class="form-control" value="<?php echo $mdata->longitude;?>" placeholder="Longitude" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="tanggal_mulai">Periode Pengerjaan</label>
	  <div class="col-md-4">
		<input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" value="<?php echo $mdata->tanggal_mulai;?>"  placeholder="Tanggal Mulai" required>
	  </div>
	  <label class="col-md-1 col-form-label text-center" for="sd">S/D</label>
	  <div class="col-md-4">
		<input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" value="<?php echo $mdata->tanggal_selesai;?>"  placeholder="Tanggal Selesai" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="nilai_proyek">Nilai Proyek</label>
	  <div class="col-md-9">
		<input type="number" id="nilai_proyek" name="nilai_proyek" class="form-control" value="<?php echo $mdata->nilai_proyek;?>"  placeholder="Nilai Pproyek" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="nama_klien">Nama Klien</label>
	  <div class="col-md-9">
		<input type="text" id="nama_klien" name="nama_klien" class="form-control" value="<?php echo $mdata->nama_klien;?>"  placeholder="Nama Klien" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="id_zona">Zona Proyek</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='id_zona' name='id_zona' required>
			<option value="">Select Zona</option>
			<?php
			if($mzona->getNumRows()>0){
				foreach ($mzona->getResult() as $row){
					$selected=($mdata->id_zona=$row->id_zona) ? "selected" : "";
					echo'<option value="'.$row->id_zona.'" '.$selected.'>'.$row->zona.'</option>';
				}
			}
			?>
		</select>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="id_pegawai">PIC Proyek</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='id_pegawai' name='id_pegawai' required>
			<option value="">Select Pegawai</option>
			<?php
			if($mpegawai->getNumRows()>0){
				foreach ($mpegawai->getResult() as $row){
					$selected=($mdata->id_pegawai=$row->id_pegawai) ? "selected" : "";
					echo'<option value="'.$row->id_pegawai.'" '.$selected.'>'.$row->nama.'</option>';
				}
			}
			?>
		</select>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="status">Status</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='status' name='status' required>
			<option value="">Select Status</option>
			<?php
			foreach ($mstatus as $val){
				$selected=($mdata->status=$val) ? "selected" : "";
				echo'<option value="'.$val.'" '.$selected.'>'.$val.'</option>';
			}
			?>
		</select>
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