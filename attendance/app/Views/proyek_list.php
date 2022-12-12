<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header d-flex justify-content-between align-items-center font-weight-bold text-primary">
			Data Proyek
			<div class="ml-auto text-end" style="font-size:12px;">
				<?php if($this->auth->roles=='Admin'){ ?>
				<div class="row">
					<a id="Add" href="<?php echo site_url('Proyek/create');?>" class="btn btn-sm btn-primary">
						<i class='fas fa-plus'></i> Input
					</a>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="datatables" class="display table table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Proyek</th>
							<th>Alamat Proyek</th>
							<th>Nilai</th>
							<th>Klien</th>
							<th>Zona</th>
							<th>PIC</th>
							<th>Progress</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if($mdata->getNumRows() > 0){
						$no=1;
						foreach ($mdata->getResult() as $rows) {
							$progress=$this->model->proyekLastProgress($rows->id_proyek);
							if($rows->status=='Open'){
								$bntAction='
								<a id="Detail" type="button" class="btn btn-primary btn-sm btn-circle" href="' . site_url('Proyek/detail/' . trim(base64_encode($rows->id_proyek), '=') . '') . '">
									<i class="ace-icon fa fa-list bigger-130"></i>
								</a>
								<a id="Team" type="button" class="btn btn-success btn-sm btn-circle" href="' . site_url('Proyek/personil/' . trim(base64_encode($rows->id_proyek), '=') . '') . '">
									<i class="ace-icon fa fa-user bigger-130"></i>
								</a>
								<a id="Edit" type="button" class="btn btn-warning btn-sm btn-circle" href="' . site_url('Proyek/edit/' . trim(base64_encode($rows->id_proyek), '=') . '') . '"  data-toggle="modal" data-target="#form-modal">
									<i class="ace-icon fa fa-edit bigger-130"></i>
								</a>
								<a id="Remove" type="button" class="btn btn-danger btn-sm btn-circle" data-toggle="modal" data-target="#confirm-delete" data-href="' . site_url('Proyek/remove/' . trim(base64_encode($rows->id_proyek), '=') . '') . '">
									<i class="ace-icon fa fa-trash bigger-130"></i>
								</a>';
							}else{
								$bntAction='
								<a id="Detail" type="button" class="btn btn-primary btn-sm btn-circle" href="' . site_url('Proyek/detail/' . trim(base64_encode($rows->id_proyek), '=') . '') . '">
									<i class="ace-icon fa fa-list bigger-130"></i>
								</a>';
							}
							
							
							if($this->auth->roles!='Admin'){
								if($rows->status=='Open'){
									$bntAction='
									<a id="Detail" type="button" class="btn btn-primary btn-sm btn-circle" href="' . site_url('Proyek/detail/' . trim(base64_encode($rows->id_proyek), '=') . '') . '">
										<i class="ace-icon fa fa-list bigger-130"></i>
									</a>
									<a id="Progress" type="button" class="btn btn-warning btn-sm btn-circle" href="' . site_url('Proyek/progress/' . trim(base64_encode($rows->id_proyek), '=') . '') . '">
										<i class="ace-icon fa fa-check bigger-130"></i>
									</a>';
								}else{
									$bntAction='
									<a id="Detail" type="button" class="btn btn-primary btn-sm btn-circle" href="' . site_url('Proyek/detail/' . trim(base64_encode($rows->id_proyek), '=') . '') . '">
										<i class="ace-icon fa fa-list bigger-130"></i>
									</a>';
								}
							}
							$no++;
							echo '
							<tr>
							<td>'.$no.'</td>
							<td>'.$rows->nama_proyek.'</td>
							<td>'.$rows->alamat_proyek.'</td>
							<td>'.number_format($rows->nilai_proyek).'</td>
							<td>'.$rows->nama_klien.'</td>
							<td>'.$rows->zona.'</td>
							<td>'.$rows->nama.'</td>
							<td>'.$progress.' %</td>
							<td><span class="badge badge-pill badge-primary">'.$rows->status.'</span></td>
							<td>
								<div class="form-button-action">
									<div class="btn-group-justified">
										'.$bntAction.'
									</div>
								</div>
							</td>
							</tr>';
						}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url('public/sbadmin2/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('public/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    showData();
});

function showData(){
	if ( $.fn.DataTable.isDataTable('#datatables') ){
		$('#datatables').DataTable().destroy();
	}
    $('#datatables').DataTable({
        "oLanguage": {
			"sProcessing": "<img src='<?php echo base_url('public/sbadmin2/img/loader.gif')?>'>"
		},
		"processing": true, 
        "serverSide": false,
        "columnDefs": [
        { 
            "targets": [ 0 ],
            "orderable": true,
			"width": "5%",
			"targets": 0,
        },
		{ 
            "targets": [ 8 ],
			"class":"text-center",
            "orderable": true,
			"width": "5%",
			"targets": 8,
        },
		{ 
            "targets": [ 9 ],
			"class":"text-center",
            "orderable": false,
			"width": "20%",
			"targets": 9,
        },
        ],
    });
}
$(document).ready(function() {
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
});

$(document).on('click', '#Add, #Edit', function(e){
	e.preventDefault();
	$('.modal-dialog').addClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	if($(this).attr('id') == 'Add'){
		$('#form-modal-title').html('New Data');
	}
	if($(this).attr('id') == 'Edit'){
		$('#form-modal-title').html('Edit Data');
	}
	if($(this).attr('id') == 'Detail'){
		$('#form-modal-title').html('Detail Data');
	}
	$('#form-modal-content').load($(this).attr('href'));
	$('#form-modal').modal({backdrop: 'static', keyboard: false}) 
	$('#form-modal').modal('show');
});

</script>