<?php include 'controllers/manage_controller.php'; ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-3">
			<div class="card-header">
				<h5>Manage Access</h5>
			</div>
			<div class="card-body">
				<div class="table table-responsive table-hover">
					<table id="usersTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">User Name</th>
								<th class="text-center">Access Level</th>
								<th class="text-center">Account Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php echo $list_users; ?>
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#usersTable').DataTable( {
        "order": [[ 0, "asc" ]],
        pageResize: true,
        scrollY:        '50vh',
        scrollX:        '100%',
        scrollCollapse: true,
        paging:         false,
        columnDefs: [{orderable: false, targets: [3]}],
        initComplete: function () {
            this.api().columns([1,2]).every( function () {
                var column = this;
                var title = $(this).text();
                var select = $('<select class="form-control"><option value="">Show All</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );

$(document).ready(function () {             
    $('.dataTables_filter input[type="search"]').
    attr('placeholder','Enter a keyword...').
    css({'width':'300px','display':'inline-block'});
});
</script>
<?php include 'controllers/includes/footer.php'; ?>