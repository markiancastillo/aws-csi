<?php
	include 'controllers/search_controller.php';
?>
<div class="row">
	<div class="col-md-12">
		<h5 class="display-4">Displaying results with "<?php echo $searchKey; ?>"</h5>
		<div class="table table-responsive table-hover">
			<table class="table-bordered display pageResize" id="savingsTable" width="100%" cellspacing="0">
				<thead>
                    <tr>
                        <th class="text-center">Date</th>
                        <th class="text-center">Journey Team</th>
                        <th class="text-center">Cloud/DevOps Technology</th>
                        <th class="text-center">Environment</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Executed By</th>
                        <th class="text-center">Solution/s Implemented</th>
                        <th class="text-center">Total Savings</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $search_table; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">Journey Team</th>
                        <th class="text-center">Cloud/DevOps Technology</th>
                        <th class="text-center">Environment</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Executed By</th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                    </tr>
                </tfoot>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	//for the page-level data-table
    $(document).ready(function() {
        $('#savingsTable').DataTable( {
            "order": [[ 0, "desc" ]],
            pageResize: true,
            scrollY:        '50vh',
            scrollX:        '100%',
            scrollCollapse: true,
            paging:         false,
            initComplete: function () {
                this.api().columns([1,2,3,4,5]).every( function () {
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
  attr('placeholder','Refine search...').
  css({'width':'300px','display':'inline-block'}
  );
});
</script>