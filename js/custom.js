// For the data table filtering
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
    attr('placeholder','Enter a keyword...').
    css({'width':'300px','display':'inline-block'});
});

// Automatically display the total when the initial and final values are input
function getTotal() {
    var initcost = document.getElementById('inpInitial').value;
    var finalcost = document.getElementById('inpFinal').value;

    initcost = initcost.replace(/\,/g,'');
    finalcost = finalcost.replace(/\,/g,'');

    var diffcost = initcost - finalcost;

    document.getElementById('sampledisp').value = diffcost.toFixed(2);
}

// Set the default value of the date input to today's date
document.getElementById('inpDate').valueAsDate = new Date();

// Input masking for the money input
$(function() {
    $('#inpInitial').maskMoney({allowZero: true});
});

$(function() {
    $('#inpFinal').maskMoney({allowZero: true});
})