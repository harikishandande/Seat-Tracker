<?php session_start();

$nav='spoc_login';
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
						<div class="row">
							<div class="col-md-3">
							</div>
							<div class="col-md-6">
								<form role="form" action="dynamic_select.php" method="post">
									<div class="form-group">
										<label>
											SPOC eid
										</label>
										<input type="text" class="form-control" name="s_eid" placeholder="Enter your SPOC id " />
									</div>
									<div class="form-group">
										<label>
											SPOC Password
										</label>
										<input type="password" class="form-control" name="s_password" placeholder="Enter your password " />
									</div>
									<br/>
									<div class="form-group">
										<input type="submit" class="btn btn-primary btn-md btn-block" name="spoc_login" value="Spoc Login" />
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