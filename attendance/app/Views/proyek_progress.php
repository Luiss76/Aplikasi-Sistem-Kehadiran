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
					<th width="85%" class="align-middle">Laporan Progress</th>
					<th width="15%" class="text-center">
						<a id="Add" href="<?php echo site_url('Proyek/progressAdd/' . trim(base64_encode($mdata->id_proyek), '=') . '');?>" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#form-modal">
							<i class='fas fa-edit'></i> Progress
						</a>
					</th>
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
						<th>WaktuInput</th>
						<th width="15%" class="text-center">Action</th>
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
						<td class="text-center">
							<div class="form-button-action">
								<div class="btn-group-justified">
									<a id="Detail" type="button" class="btn btn-primary btn-sm btn-circle" href="' . site_url('Proyek/progressDetail/' . trim(base64_encode($rows->id_proyek), '=') . '/' . trim(base64_encode($rows->id_progress), '=') . '') . '">
										<i class="ace-icon fa fa-search-plus bigger-130"></i>
									</a>
									<a id="AddFoto" type="button" class="btn btn-warning btn-sm btn-circle" href="' . site_url('Proyek/progressAddFoto/' . trim(base64_encode($rows->id_proyek), '=') . '/' . trim(base64_encode($rows->id_progress), '=') . '') . '" data-toggle="modal" data-target="#form-modal">
										<i class="ace-icon fa fa-image bigger-130"></i>
									</a>
									<a id="Remove" type="button" class="btn btn-danger btn-sm btn-circle" data-toggle="modal" data-target="#confirm-delete" data-href="' . site_url('Proyek/progressRemove/' . trim(base64_encode($rows->id_proyek), '=') . '/' . trim(base64_encode($rows->id_progress), '=') . '') . '">
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
					<td colspan="7">Belum ada data</td>
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
$(document).on('click', '#AddFoto,#Add', function(e){
	e.preventDefault();
	
	if($(this).attr('id') == 'AddFoto'){
		$('.modal-dialog').addClass('modal-md');
		$('.modal-dialog').removeClass('modal-lg');
		$('#form-modal-title').html('New Data');
	}
	if($(this).attr('id') == 'Add'){
		$('.modal-dialog').addClass('modal-lg');
		$('.modal-dialog').removeClass('modal-md');
		$('#form-modal-title').html('New Data');
	}
	$('#form-modal-content').load($(this).attr('href'));
	$('#form-modal').modal({backdrop: 'static', keyboard: false}) 
	$('#form-modal').modal('show');
});
</script>