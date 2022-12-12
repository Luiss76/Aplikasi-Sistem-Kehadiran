<div class="container-fluid">
	<div class="card shadow mb-4">
		<h6 class="card-header d-flex justify-content-between align-items-center font-weight-bold text-primary">
			Detail Progress
			<div class="ml-auto text-end text-right">
				<a href="<?php echo site_url('proyek/progress/'.trim(base64_encode($id_proyek), '=').'');?>" class="btn btn-sm btn-primary btn-round">
					<i class='fa fa-arrow-left'></i> Back
				</a>
			</div>
		</h6>
		<div class="card-body">
			<table class="table table-hover table-borderless">
				<tbody>
				  <tr>
					<td width="25%">Tanggal</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->tanggal;?></td>
				  </tr>
				   <tr>
					<td>Keterangan</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->keterangan;?></td>
				  </tr>
				  <tr>
					<td>Prosentase</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->prosentase;?></td>
				  </tr>
				  <tr>
					<td>Waktu Input</td>
					<td width="5%" class="text-center">:</td>
					<td><?php echo $mdata->waktu_input;?></td>
				  </tr>
				</tbody>
			</table>
		</div>
		<div class="card-body">
			<table class="table table-hover table-borderless mt-2">
				<thead>
				  <tr class="table-secondary">
					<th class="align-middle">Progress Foto</th>
				  </tr>
				</thead>
			</table>
			<div class="">
			<?php
			if($mfoto->getNumRows()>0){
				foreach($mfoto->getResult() as $row){
					echo'
					<div class="col-xl-3 col-md-3 mb-3">
						<img width="100%" src="'.base_url('public/uploads/progress/'.$row->foto.'').'" />
						<a type="button" class="mt-2 btn btn-danger btn-sm btn-circle" href="'.base_url('proyek/progressRemoveFoto/'.trim(base64_encode($id_progress),'=').'/'.trim(base64_encode($row->id_foto),'=').'').'">
							<i class="ace-icon fa fa-trash"></i>
						</a>
					</div>';
				}
			}else{
				echo'
				<div class="col-xl-12 col-md-12 mb-12">
					Belum ada data !
				</div>';
			}
			?>
			</div>
		</div>
	</div>
</div>