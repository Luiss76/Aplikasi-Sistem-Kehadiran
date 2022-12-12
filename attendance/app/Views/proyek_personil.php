<div class="container-fluid">
	<div class="card shadow mb-4">
		<h6 class="card-header d-flex justify-content-between align-items-center font-weight-bold text-primary">
			Input Personil
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
					<th width="85%" class="align-middle">Daftar Personil</th>
					<th width="15%" class="text-center">
						<a id="Add" href="<?php echo site_url('Proyek/personilAdd/'.$mdata->id_proyek.'');?>" class="btn btn-sm btn-primary">
							<i class='fas fa-plus'></i> Personil
						</a>
					</th>
				  </tr>
				</thead>
			</table>
			<table class="table table-hover table-borderless mt-2">
				<thead>
					<tr>
						<th>No</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Posisi</th>
						<th width="5%" class="text-center">Action</th>
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
						<td width="5%" class="text-center">
							<div class="form-button-action">
								<div class="btn-group-justified">
									<a id="Remove" type="button" class="btn btn-danger btn-sm btn-circle" data-toggle="modal" data-target="#confirm-delete" data-href="' . site_url('Proyek/personilRemove/' . trim(base64_encode($rows->id_proyek), '=') . '/' . trim(base64_encode($rows->id_personil), '=') . '') . '">
										<i class="ace-icon fa fa-trash bigger-130"></i>
									</a>
								</div>
							</div>
						</td>
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
<script type="text/javascript">
$(document).ready(function() {
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
});

$(document).on('click', '#Add', function(e){
	e.preventDefault();
	$('.modal-dialog').addClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	$('#form-modal-title').html('New Data');
	$('#form-modal-content').load($(this).attr('href'));
	$('#form-modal').modal({backdrop: 'static', keyboard: false}) 
	$('#form-modal').modal('show');
});

</script>