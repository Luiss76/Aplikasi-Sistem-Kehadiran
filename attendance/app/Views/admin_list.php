<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header d-flex justify-content-between align-items-center font-weight-bold text-primary">
			Setup Admin
			<div class="ml-auto text-end" style="font-size:12px;">
				<div class="row">
					<a id="Add" href="<?php echo site_url('Admin/create');?>" class="btn btn-sm btn-primary">
						<i class='fas fa-plus'></i> Input
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
							<th>Nama</th>
							<th>Email</th>
							<th>Roles</th>
							<th>Username</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if($mdata->getNumRows() > 0){
						$no=1;
						foreach ($mdata->getResult() as $rows) {
							if($rows->status==1){
								$status='<span class="badge badge-pill badge-primary">Active</span>';
								$button='<a title="Inactive" class="btn btn-sm btn-danger btn-circle" href="'.site_url('user/inactive/'.trim(base64_encode($rows->id_user),'=').'').'">
											<i class="fa fa-ban" aria-hidden="true"></i>
										</a>';
							}else{
								$status='<span class="badge badge-pill badge-danger">InActive</span>';
								$button='<a title="Activate" class="btn btn-sm btn-primary btn-circle" href="'.site_url('user/activate/'.trim(base64_encode($rows->id_user),'=').'').'">
											<i class="fa fa-check-square" aria-hidden="true"></i>
										</a>';
							}
							$no++;
							echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$rows->nama.'</td>
								<td>'.$rows->email.'</td>
								<td>'.$rows->username.'</td>
								<td>'.$rows->roles.'</td>
								<td>'.$status.'</td>
								<td>
									<div class="form-button-action">
										<div class="btn-group-justified">							
											'.$button.'
											<a id="Edit" type="button" class="btn btn-warning btn-sm btn-circle" href="' . site_url('Admin/edit/' . trim(base64_encode($rows->id_user), '=') . '') . '"  data-toggle="modal" data-target="#form-modal">
												<i class="ace-icon fa fa-edit bigger-130"></i>
											</a>
											<a id="Remove" type="button" class="btn btn-danger btn-sm btn-circle" data-toggle="modal" data-target="#confirm-delete" data-href="' . site_url('Admin/remove/' . trim(base64_encode($rows->id_user), '=') . '') . '">
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
            "targets": [ 5 ],
			"class":"text-center",
            "orderable": true,
			"width": "5%",
			"targets": 5,
        },
		{ 
            "targets": [ 6 ],
			"class":"text-center",
            "orderable": false,
			"width": "20%",
			"targets": 6,
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