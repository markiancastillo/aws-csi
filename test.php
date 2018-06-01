<?php
#	include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/function.php');
#    include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/config.php');

    include 'controllers/includes/header.php';

    if(isset($_GET['access']) && isset($_GET['pk']))
    {
    	echo 'access is: ' . $_GET['access'];
    	echo '<br>';
    	echo 'passkey is: ' . $_GET['pk'];
    	echo '<br>';    	
    }

    // check from the database the records being passed via the URL 
    #$access = urldecode($_GET['access']);
    $access = "hello";
    $passkey = 'screenshotlayer';

    $sql_verify = "SELECT accountUN, accountPW FROM accounts WHERE accountUN='$access'";
    $result_verify = $con->query($sql_verify) or die(mysqli_error($con));

    if(mysqli_num_rows($result_verify) > 0)
    {
    	while($row = mysqli_fetch_array($result_verify))
    	{
    		$accessPW = $row['accountPW'];

    		if(password_verify($passkey, $accessPW))
    		{
    			#echo '<br>Username and password accepted!';
    		}
    		else
    		{
    			#echo '<br>Access denied.';
    		}
    	}
    }
    else
    {
    	#echo '<br>No matching columns';
    }

    echo '<hr>';
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<button class="btn btn-primary" data-toggle="modal" data-target="#addCSModal">
    <span>Format 1</span>
</button>

<div class="modal fade" id="addCSModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">New Cost Savings Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="inpTeam">Journey Team</label>
                                <select class="form-control" name="inpTeam" id="inpTeam" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listTeams($con); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="inpEnv">Environment</label>
                                <select class="form-control" name="inpEnv" id="inpEnv" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listEnvironments($con); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="inpTech">Cloud/DevOps Technology</label>
                                <select class="form-control" name="inpTech" id="inpTech" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listTech($con); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inpType">Cost Savings Type</label>
                                <select class="form-control" name="inpType" id="inpType" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listTypes($con); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpSave">Initial</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" type="text" name="inpSave" id="inpSave" required="true"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpSave">Final</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" type="text" name="inpSave" id="inpSave" required="true"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpDesc">Description</label>
                                <textarea class="form-control" rows="10" name="inpDesc" id="inpDesc" maxlength="500" placeholder="Brief description of the task/action performed..." required="true"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpDesc">Description</label>
                                <textarea class="form-control" rows="10" name="inpDesc" id="inpDesc" maxlength="500" placeholder="Brief description of the task/action performed..." required="true"></textarea>
                            </div>
                        </div>
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
                            <input class="form-control" type="date" name="inpDate" id="inpDate" min="2018-01-01" max="<?php echo '2018-05-31' ?>" required="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" name="btnSubmit" id="btnSubmit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
</body>
</html>