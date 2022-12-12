<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header d-flex justify-content-between align-items-center font-weight-bold text-primary">
			Master Brand
			<div class="ml-auto text-end" style="font-size:12px;">
				<div class="row">
					<a id="Add" href="<?php echo site_url('jabatan/create');?>" class="btn btn-sm btn-primary">
						<i class='fas fa-plus'></i> Tambah
					</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="datatables" class="display table table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Jabatan</th>
							<th>Keterangan</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if($mdata->getNumRows() > 0){
						$no=1;
						foreach ($mdata->getResult() as $rows) {
							$no++;
							echo '
							<tr>
							<td>'.$no.'</td>
							<td>'.$rows->jabatan.'</td>
							<td>'.$rows->keterangan.'</td>
							<td>
								<div class="form-button-action">
									<div class="btn-group-justified">
										<a id="Edit" type="button" class="btn btn-warning btn-sm btn-circle" href="' . site_url('Jabatan/edit/' . trim(base64_encode($rows->id_jabatan), '=') . '') . '"  data-toggle="modal" data-target="#form-modal">
											<i class="ace-icon fa fa-edit bigger-130"></i>
										</a>
										<a id="Remove" type="button" class="btn btn-danger btn-sm btn-circle" data-toggle="modal" data-target="#confirm-delete" data-href="' . site_url('Jabatan/remove/' . trim(base64_encode($rows->id_jabatan), '=') . '') . '">
											<i class="ace-icon fa fa-trash bigger-130"></i>
										</a>
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
            "targets": [ 3 ],
			"class":"text-center",
            "orderable": false,
			"width": "15%",
			"targets": 3,
        },
        ],
    });
}
$(document).ready(function() {
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
});

$(document).on('click', '#Add, #Edit, #Detail', function(e){
	e.preventDefault();
	$('#form-modal-dialog').addClass('modal-lg');
	$('#form-modal-dialog').removeClass('modal-sm');
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