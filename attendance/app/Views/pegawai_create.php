<form class="form-horizontal" method="post"  action="<?php echo site_url('Pegawai/create');?>"  enctype="multipart/form-data">
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="foto">Foto</label>
	  <div class="col-md-9">
		<input type="file" id="foto" name="foto" class="form-control" placeholder="Foto" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="nik">NIK</label>
	  <div class="col-md-9">
		<input type="text" id="nik" name="nik" class="form-control" placeholder="NIK" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="nama">Nama</label>
	  <div class="col-md-9">
		<input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="tempat_lahir">TTL</label>
	  <div class="col-md-5">
		<input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
	  </div>
	  <div class="col-md-4">
		<input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="jenis_kelamin">Jenis Kelamin</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='jenis_kelamin' name='jenis_kelamin' required>
			<option value="">Jenis Kelamin</option>
			<?php
			foreach ($mgender as $val){
				echo'<option value="'.$val.'">'.$val.'</option>';
			}
			?>
		</select>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="status_pernikahan">Status Pernikahan</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='status_pernikahan' name='status_pernikahan' required>
			<option value="">Status Pernikahan</option>
			<?php
			foreach ($mpernikahan as $val){
				echo'<option value="'.$val.'">'.$val.'</option>';
			}
			?>
		</select>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="alamat">Alamat</label>
	  <div class="col-md-9">
		<textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" required></textarea>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="telepon">Telepon</label>
	  <div class="col-md-9">
		<input type="text" id="telepon" name="telepon" class="form-control" placeholder="Telepon" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="email">Email</label>
	  <div class="col-md-9">
		<input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="nilai_proyek">Tanggal Masuk</label>
	  <div class="col-md-9">
		<input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" placeholder="Tanggal Masuk" required>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="id_pendidikan">Pendidikan</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='id_pendidikan' name='id_pendidikan' required>
			<option value="">Select Pendidikan</option>
			<?php
			if($mpendidikan->getNumRows()>0){
				foreach ($mpendidikan->getResult() as $row){
					echo'<option value="'.$row->id_pendidikan.'">'.$row->jenjang.'</option>';
				}
			}
			?>
		</select>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="id_departemen">Departemen</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='id_departemen' name='id_departemen' required>
			<option value="">Select Depertemen</option>
			<?php
			if($mdepartemen->getNumRows()>0){
				foreach ($mdepartemen->getResult() as $row){
					echo'<option value="'.$row->id_departemen.'">'.$row->departemen.'</option>';
				}
			}
			?>
		</select>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="id_jabatan">Jabatan</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='id_jabatan' name='id_jabatan' required>
			<option value="">Select Jabatan</option>
			<?php
			if($mjabatan->getNumRows()>0){
				foreach ($mjabatan->getResult() as $row){
					echo'<option value="'.$row->id_jabatan.'">'.$row->jabatan.'</option>';
				}
			}
			?>
		</select>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="id_lokasi">Penempatan</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='id_lokasi' name='id_lokasi' required>
			<option value="">Select Penempatan</option>
			<?php
			if($mlokasi->getNumRows()>0){
				foreach ($mlokasi->getResult() as $row){
					echo'<option value="'.$row->id_lokasi.'">'.$row->lokasi.'</option>';
				}
			}
			?>
		</select>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="col-md-3 col-form-label text-right" for="status">Status Pegawai</label>
	  <div class="col-md-9">
		<select style="width:100%" class='form-control select2' id='status' name='status' required>
			<option value="">Select Status Pegawai</option>
			<?php
			foreach ($mstatus as $val){
				echo'<option value="'.$val.'">'.$val.'</option>';
			}
			?>
		</select>
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