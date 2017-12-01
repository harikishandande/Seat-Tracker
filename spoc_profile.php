<?php session_start();

$nav='spoc_login';

if(isset($_SESSION['s_eid']))
{
	
if(isset($_POST['spoc_update']))
{
	$s_name = $_POST['s_name'];
	$s_password = $_POST['s_password'];
	$spoc_info = file("users_info/spoc_info.txt");
	foreach($spoc_info as $spoc_rec)
	{
		$s_data = explode(",", "$spoc_rec");
													
		if($_SESSION['s_eid'] == $s_data[2])
		{
			$s_odc = $s_data[0];
			$s_eid = $s_data[2];
		}
	}

	
	//	$file = fopen("$odc_path/$odc_name".'_users_info.txt',"a+");
	//	$data = "$odc_name,$cubical_choice,$emp_id,$emp_name,$emp_project_name,$emp_pm,$emp_tm,OCCUPIED,$emp_remark" . PHP_EOL;
	//	fwrite($file,$data);
	//	fclose($file);		
	//	print_r(error_get_last());
	//	echo '<script>alert("Your cubical allocated successfully.");</script>';

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
						<h2>SPOC login</h2>
						<hr/>
						<?php 
												$spoc_info = file("users_info/spoc_info.txt");
												foreach($spoc_info as $spoc_rec)
												{
													$s_data = explode(",", "$spoc_rec");
													
													if($_SESSION['s_eid'] == $s_data[2])
													{
														$s_odc = $s_data[0];
														$s_name = $s_data[1];
														$s_eid = $s_data[2];
														$s_password = $s_data[3];
													}
												}
						?>
						<div class="row">
							<div class="col-md-3">
							</div>
							<div class="col-md-6">
								<form role="form" action="spoc_profile.php" method="post">
									<div class="form-group">
										<label>
											SPOC ODC
										</label>
										<input type="text" class="form-control" name="s_odc" value="<?php echo $s_odc;?>" disabled/>
									</div>
									<div class="form-group">
										<label>
											SPOC eid
										</label>
										<input type="text" class="form-control" name="s_eid" value="<?php echo $s_eid;?>" disabled/>
									</div>
									<div class="form-group">
										<label>
											SPOC Name
										</label>
										<input type="text" class="form-control" name="s_name" value="<?php echo $s_name;?>" required/>
									</div>
									<div class="form-group">
										<label>
											SPOC Password
										</label>
										<input type="password" class="form-control" name="s_password" value="<?php echo $s_password;?>" required/>
									</div>
									<br/>
									<div class="form-group">
										<input type="submit" class="btn btn-primary btn-md btn-block" name="spoc_update" value="Spoc Update" />
									</div>
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
             <!-- /. PAGE INNER  -->
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
<?php
}
?>