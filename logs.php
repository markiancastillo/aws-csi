<?php
	include 'controllers/logs_controller.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <h4>Audit Records</h4>
            </div>
            <div class="card-body">
                <div class="table table-responsive table-hover">
                    <table class="table-bordered display pageResize" id="logsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Event Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $list_logs; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">User</th>
                                <th class="text-center"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
// For the dropdown filters
$(document).ready(function() {
    $('#logsTable').DataTable( {
        "order": [[ 0, "desc" ]],
        pageResize: true,
        scrollY:        '50vh',
        scrollX:        '100%',
        scrollCollapse: true,
        paging:         false,
        initComplete: function () {
            this.api().columns([1]).every( function () {
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

// Changes in the search bar
$(document).ready(function () {             
    $('.dataTables_filter input[type="search"]').
    attr('placeholder','Enter a keyword...').
    css({'width':'300px','display':'inline-block'});
});
</script>

<?php include 'controllers/includes/footer.php'; ?>