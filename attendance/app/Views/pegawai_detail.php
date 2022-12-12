<div class="container-fluid">
	<div class="card shadow mb-4">
		<h6 class="card-header d-flex justify-content-between align-items-center font-weight-bold text-primary">
			Detail Pegawai
			<div class="ml-auto text-end text-right">
				<a href="<?php echo site_url('pegawai');?>" class="btn btn-sm btn-primary btn-round">
					<i class='fa fa-arrow-left'></i> Back
				</a>
			</div>
		</h6>
		<div class="card-body">
			<table class="table table-hover table-borderless">
				<tbody>
				  <tr>
					<td width="25%">NIK</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->nik;?></td>
					<td rowspan="13" width="15%">
						<?php
						$picture=($mdata->foto!='') ? base_url('public/uploads/pegawai/'.$mdata->foto.'') : base_url('public/uploads/pegawai/avatar.png');
						?>
						<img src="<?php echo $picture;?>" class="img-responsive" width="90%" class="text-center">
					</td>
				  </tr>
				   <tr>
					<td>Gender</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->jenis_kelamin;?></td>
				  </tr>
				  <tr>
					<td>TTL</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->tempat_lahir;?>, <?php echo $mdata->tanggal_lahir;?></td>
				  </tr>
				  <tr>
					<td>Penempatan</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->lokasi;?></td>
				  </tr>
				   <tr>
					<td>Jabatan</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->jabatan;?></td>
				  </tr>
				  <tr>
					<td>Departemen</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->departemen;?></td>
				  </tr>
				   <tr>
					<td>Pendidikan</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->jenjang;?></td>
				  </tr>
				  <tr>
					<td>Masa Kerja</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->year;?> Tahun</td>
				  </tr>
				   <tr>
					<td>Status Pegawai</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->status;?></td>
				  </tr>
				  <tr>
					<td>Status Pernikahan</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->status_pernikahan;?></td>
				  </tr>
				  <tr>
					<td>Alamat</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->alamat;?></td>
				  </tr>
				  <tr>
					<td>Telepon</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->telepon;?></td>
				  </tr>
				  <tr>
					<td>Email</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->email;?></td>
				  </tr>
				 
				</tbody>
			</table>
		</div>
		<div class="card-body">
			<table class="table table-hover table-borderless mt-2">
				<thead>
				  <tr class="table-secondary">
					<th width="100%">Data Absensi</th>
				  </tr>
				</thead>
			</table>
			<table class="table table-hover table-borderless mt-2">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Lokasi</th>
						<th>AbsenIn</th>
						<th>AbsenOut</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($mabsensi->getNumRows() > 0){
					$no=1;
					foreach ($mabsensi->getResult() as $rows) {
						$no++;
						echo '
						<tr>
						<td>'.$no.'</td>
						<td>'.$rows->tanggal.'</td>
						<td>'.$rows->lokasi.'</td>
						<td>'.$rows->absen_in.'</td>
						<td>'.$rows->absen_out.'</td>
						</tr>';
					}
				}else{
					echo '
					<tr>
					<td colspan="5">Belum ada data</td>
					</tr>';
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>