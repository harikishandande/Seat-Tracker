<?php session_start();

$nav='odc_layout';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php include( 'head_nav.php' ); ?>
	
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
						<h2>ODC's Layout Info</h2>
						<hr/>
						<div class="col-md-12">
							<div class="tabbable" id="tabs-116365">
								<ul class="nav nav-tabs">
						<?php		$odc_details=file('users_info/odc_info.txt', FILE_IGNORE_NEW_LINES);
									$i=0;$j=0;
									foreach($odc_details as $odc_name)
									{	
										$s_arrfields = explode(',', $odc_name);
										if($j == 0) { echo '<li class="active">'; } else { echo '<li>'; }
						?>				
											<a href="#panel-<?php echo $i; ?>" data-toggle="tab"><?php echo $s_arrfields[0]; ?></a>
										</li>
						<?php 			$i++;$j++;
									}	?>
								</ul>
								<div class="tab-content">
									<div class='tab-pane active' id='panel-0'>
				<!--					<iframe style="width: 100%;height: 700px;" src="https://drive.google.com/file/d/0B7-2mCQxt6ciZ3pFcnU2YmdHbFk/preview"></iframe>	-->
										<img style="width: 100%;height: 700px;" src="CapOne UK.png"></img>
									</div>
									<div class='tab-pane' id='panel-1'>
										<h5><center>Layout not found</center></h5>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
                    </div>
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