<?php
    include 'controllers/view_controller.php';
?>
<div class="row">
    <div class="col-md-12">
        <?php echo $msgDisplay; ?>
        <div class="card mb-3">
            <div class="card-header">
                Cost Savings Initiatives
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addCSModal">
                    <span>Add a New Record</span>
                </button>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table-bordered" id="savingsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Journey Team</th>
                                <th class="text-center">Cloud/DevOps Technology</th>
                                <th class="text-center">Environment</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Initial Screenshot</th>
                                <th class="text-center">Final Screenshot</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Executed By</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Estimated Savings</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $cs_list; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal for creating a new team -->
<div class="modal fade" id="addCSModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h5 class="modal-title" id="addModalLabel">New Cost Savings Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              	<div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inpTeam">Journey Team</label>
                                <select class="form-control" name="inpTeam" id="inpTeam" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo $list_teams; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpTech">Cloud/DevOps Technology</label>
                                <select class="form-control" name="inpTech" id="inpTech" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo $list_tech; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpEnv">Environment</label>
                                <select class="form-control" name="inpEnv" id="inpEnv" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo $list_env; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inpInitial">Screenshot</label>
                        <input class="form-control" type="file" name="inpPhoto" id="inpPhoto" accept="image/*">
                        <!--<div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                            <div>
                                <span class="btn btn-default btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="..."></span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>-->
                    </div>
                    <div class="form-group">
                        <label for="inpDesc">Description</label>
                        <textarea class="form-control" rows="3" name="inpDesc" id="inpDesc" maxlength="500" placeholder="Brief description of the task/action performed..." required="true"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpName">Action Executed By</label>
                                <input class="form-control" type="text" name="inpName" id="inpName" maxlength="50" placeholder="Enter a name..." required="true">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpDate">Date Executed</label>
                                <input class="form-control" type="date" name="inpDate" id="inpDate" min="2018-01-01" max="<?php echo $tomorrowDate->format('Y-m-d'); ?>" required="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpType">Cost Savings Type</label>
                                <select class="form-control" name="inpType" id="inpType" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo $list_type; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpSave">Estimated Monthly Savings</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" type="text" name="inpSave" id="inpSave" required="true"/>
                                </div>
                            </div>
                        </div>
                    </div>
            	</div>
            	<div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                	<button class="btn btn-primary" name="btnSubmit" id="btnSubmit">Submit</button>
            	</div>
            </form>
        </div>
    </div>
</div>
<!-- Modal for the image zoom on click -->
<div class="modal" tabindex="-1" role="dialog" id="imgModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="images/<?php echo $displayInitial; ?>" width="100%" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php echo $imgModal; ?>

<script type="text/javascript">
//for the page-level data-table
    $(document).ready(function() {
        $('#savingsTable').DataTable( {
            "order": [[ 8, "desc" ]]
        } );
    } );

    document.getElementById('inpDate').valueAsDate = new Date();
</script>
<script type="text/javascript">
      $(function() {
    $('#inpSave').maskMoney({allowZero: true});
  })
</script>
<?php include 'controllers/includes/footer.php'; ?>