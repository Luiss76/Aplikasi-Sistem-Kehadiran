<div class="container-fluid">
	<div class="card shadow mb-4">
		<h6 class="card-header d-flex justify-content-between align-items-center font-weight-bold text-primary">
			Detail Proyek
			<div class="ml-auto text-end text-right">
				<a href="<?php echo site_url('proyek');?>" class="btn btn-sm btn-primary btn-round">
					<i class='fa fa-arrow-left'></i> Back
				</a>
			</div>
		</h6>
		<div class="card-body">
			<table class="table table-hover table-borderless">
				<tbody>
				  <tr>
					<td width="25%">Nama Proyek</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->nama_proyek;?></td>
				  </tr>
				   <tr>
					<td>Deskripsi Proyek</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->deskripsi_proyek;?></td>
				  </tr>
				  <tr>
					<td>Alamat Proyek</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->alamat_proyek;?></td>
				  </tr>
				  <tr>
					<td>Nama Klien</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->nama_klien;?></td>
				  </tr>
				   <tr>
					<td>Nilai Proyek</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo number_format($mdata->nilai_proyek);?></td>
				  </tr>
				  <tr>
					<td>Periode Pengerjaan</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->tanggal_mulai;?>, <?php echo $mdata->tanggal_selesai;?></td>
				  </tr>
				  <tr>
					<td>Zona</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->zona;?></td>
				  </tr>
				   <tr>
					<td>PIC Proyek</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->nama;?></td>
				  </tr>
				</tbody>
			</table>
		</div>
		<div class="card-body">
			<table class="table table-hover table-borderless mt-2">
				<thead>
				  <tr class="table-secondary">
					<th width="100%">Daftar Personil</th>
				  </tr>
				</thead>
			</table>
			<table class="table table-hover table-borderless mt-2">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Posisi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($mpersonil->getNumRows() > 0){
					$no=1;
					foreach ($mpersonil->getResult() as $rows) {
						echo '
						<tr>
						<td>'.$no.'</td>
						<td>'.$rows->nik.'</td>
						<td>'.$rows->nama.'</td>
						<td>'.$rows->posisi.'</td>
						</tr>';
						$no++;
					}
				}else{
					echo '
					<tr>
					<td colspan="4">Belum ada data</td>
					</tr>';
				}
				?>
				</tbody>
			</table>
			
			<table class="table table-hover table-borderless mt-2">
				<thead>
				  <tr class="table-secondary">
					<th width="100%">Progress Pengerjaan</th>
				  </tr>
				</thead>
			</table>
			<table class="table table-hover table-borderless mt-2">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th>Tanggal</th>
						<th>Keterangan</th>
						<th class="text-center">Prosentase</th>
						<th>WaktuUpdate</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($mprogress->getNumRows() > 0){
					$no=1;
					foreach ($mprogress->getResult() as $rows) {
						echo '
						<tr>
						<td>'.$no.'</td>
						<td>'.$rows->tanggal.'</td>
						<td>'.$rows->keterangan.'</td>
						<td class="text-center">'.$rows->prosentase.' %</td>
						<td>'.$rows->waktu_input.'</td>
						</tr>';
						$no++;
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