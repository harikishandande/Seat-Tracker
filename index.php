<?php session_start();

$nav='index';

if(isset($_SESSION["login"]))
{
	if($_SESSION["login"] == 3)
	{	
		echo "<script>alert('Login successfull!');</script>"; 
	}
	else if($_SESSION["login"] == 4)
	{
		echo "<script>alert('Invalid username or password');</script>";
	}
	$_SESSION["login"] = NULL; 
}
if(isset($_POST['emp_submit']))
{
    $odc_choice = $_POST['odc_choice'];
	$odc_r_info = explode('|', $odc_choice);
	$odc_name = $odc_r_info[0];
	$path_info = pathinfo($odc_r_info[1]);
	$odc_path = $path_info['dirname'];
	$cubical_choice = $_POST['cubical_choice'];
	if ($_POST['cub_status'] == "port_issue" || $_POST['cub_status'] == "others")
	{
		$emp_id = "-";
		$emp_name = $_POST['cub_status'];
		$emp_pm = "-";
		$emp_tm = "-";
		$emp_project_name = "-";
	}
	else if($_POST['cub_status'] == "normal")
	{
		$emp_id = $_POST['emp_id'];
		$emp_name = $_POST['emp_name'];
		$emp_pm = $_POST['emp_pm'];
		$emp_tm = $_POST['emp_tm'];
		$emp_project_name = $_POST['emp_project_name'];
	}
	
	if(isset($_POST['emp_remark']))
	{
		$emp_remark = $_POST['emp_remark'];
	}
	else
	{
		$emp_remark = "-";
	}
	
	if(isset($_SESSION["notification"]) && ( $_SESSION["notification"] == 0 || $_SESSION["notification"] == 2 ))
	{
		$file = fopen("$odc_path/$odc_name".'_users_info.txt',"a+");
		$data = "$odc_name,$cubical_choice,$emp_id,$emp_name,$emp_project_name,$emp_pm,$emp_tm,OCCUPIED,$emp_remark" . PHP_EOL;
		fwrite($file,$data);
		fclose($file);		
		print_r(error_get_last());
		
		if(isset($_POST['cub_status']) && $_POST['cub_status'] == "normal")
		{
			echo '<script>alert("Your cubical allocated successfully.");</script>';
		}
		else
		{
			echo '<script>alert("Dear SPOC, the glitch cubical has been locked successfully.");</script>';
		}
		
	}
	else if(isset($_SESSION["notification"]) && ( $_SESSION["notification"] == 1 || $_SESSION["notification"] == 3))
	{
		echo '<script>alert("You can\'t choose this cubical number. It\'s incorrect.");</script>';
	}
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php include( 'head_nav.php' ); ?>
	
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Welcome to Seat Tracker</h2>
					 <hr/>
					 <div class="row">
						<div class="col-md-3">
						</div>
						<div class="col-md-6">
							<div id="notification">
							</div>
							<form role="form" action="index.php" method="post" id="emp_record" name="emp_record" >
								<div class="form-group">
									<label for="seat_tracker_inputs">
										Choose ODC
									</label>
									<select class="form-control" id="odc_choice" name="odc_choice" onchange="fetch_cubical()" required>
										<option value="-1"><?php echo "<< Please select ODC >>"; ?></option>
							<?php		$odc_details=file('users_info/odc_info.txt', FILE_IGNORE_NEW_LINES);
										$i=0;
										foreach($odc_details as $odc_name)
										{	
											$s_arrfields = explode(',', $odc_name);
							?>				<option value="<?php echo "$s_arrfields[0]|$s_arrfields[1]" ; ?>"><?php echo $s_arrfields[0]; ?></option>
							<?php 		}	?>	
									</select>
								</div>								
								<div class="form-group">
									<label for="seat_tracker_inputs">
										Choose Cubical Number
									</label>
									<select class="form-control" id="cubical_choice" name="cubical_choice" onchange="validate_cubical()" required>
										<option value="-1"><?php echo "<< Please select ODC first >>"; ?></option>
									</select>
								</div>
						
				<?php	if(isset($_SESSION['s_eid']))
						{	?>
								<div class="form-group">
									 
									<label for="seat_tracker_inputs">
										Choose cubical status
									</label>
									<label class="radio-inline">
										<input type="radio" name="cub_status" value="normal" onChange="findselected()" checked> Normal
									</label>
									<label class="radio-inline">
										<input type="radio" name="cub_status" value="port_issue" onChange="findselected()"> Port Issue
									</label>
									<label class="radio-inline">
										<input type="radio" name="cub_status" value="others" onChange="findselected()"> others 
									</label>
								</div>
				<?php	}	?>
									<input type="hidden" name="cub_status" value="normal" />
									
								
								<div class="form-group">
									 
									<label for="seat_tracker_inputs">
										Enter Emp ID ( Ex: 316222 )
									</label>
									<input type="text" class="form-control" id="emp_id" name="emp_id" onblur="validate_emp()" minlength="6" required>
								</div>
								<div class="form-group">
									 
									<label for="seat_tracker_inputs">
										Enter Emp Name ( As per Wipro records )
									</label>
									<input type="text" class="form-control" id="emp_name" name="emp_name" required>
								</div>
								<div class="form-group">
									 
									<label for="seat_tracker_inputs">
										Enter PM
									</label>
									<input type="text" class="form-control" id="emp_pm" name="emp_pm" required>
								</div>
								<div class="form-group">
									 
									<label for="seat_tracker_inputs">
										Enter TM
									</label>
									<input type="text" class="form-control" id="emp_tm" name="emp_tm" required>
								</div>
								<div class="form-group">
									 
									<label for="seat_tracker_inputs">
										Enter Project Name ( As per Wipro records )
									</label>
									<input type="text" class="form-control" id="emp_project_name" name="emp_project_name" required>
								</div>
								<div class="form-group">
									 
									<label for="seat_tracker_inputs">
										Remarks
									</label>
									<input type="text" class="form-control" id="emp_remark" name="emp_remark" >
								</div>
								<input type="submit" class="btn btn-success btn-lg" id="emp_submit" name="emp_submit" />
							</form>
						</div>
						<div class="col-md-3">
						</div>
					</div>
                       
                    </div>
					
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
    </div>
		<!--	/. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
	
	<?php include( 'footer.php' ); ?>
	
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>