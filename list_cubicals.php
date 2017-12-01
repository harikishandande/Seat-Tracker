<?php session_start();

$nav='list_cubicals';

if(isset($_SESSION["release_cubical"]))
{
	echo '<script>alert("' . 'Cubical ' . $_SESSION["release_cubical"] . ' released successfully' . '");</script>';	
	$_SESSION["release_cubical"] = NULL;
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
						<h2>Allocated Cubicals</h2>
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
						<?php		$odc_details=file('users_info/odc_info.txt', FILE_IGNORE_NEW_LINES);
									$i=0;$j=0;
									foreach($odc_details as $odc_name)
									{	
						?>				
						<?php			if($j == 0) { echo "<div class='tab-pane active' id='panel-$i'>"; } else { echo "<div class='tab-pane' id='panel-$i'>"; }
								
										$s_arrfields = explode(',', $odc_name);
										$path_info = pathinfo($s_arrfields[1]);
										$odc_path = $path_info['dirname'];
										$odc_name = $path_info['filename'];
										$users_file = "$odc_path/$odc_name" . '_users_info.txt';										
										pathinfo($s_arrfields[1]);
										$occupied_cubicals = file($users_file, FILE_IGNORE_NEW_LINES);
						?>					
											<table class="table">
												<thead>
													<tr>
														<th>
															S No
														</th>
														<th>
															ODC Name
														</th>
														<th>
															Cubical Number
														</th>
														<th>
															Emp Id
														</th>
														<th>
															Emp Name
														</th>
														<th>
															Project Name
														</th>
														<th>
															Project Manager
														</th>
														<th>
															TM
														</th>
														<th>
															Status
														</th>
													</tr>
												</thead>
												<tbody>
									<?php			$e=1;
													foreach($occupied_cubicals as $each_cubical)
													{
														$each_rec = explode(',',$each_cubical);
														echo "<tr class='default'>";
														echo "<td> $e </td>";
														echo "<td> $each_rec[0] </td>";
														echo "<td> $each_rec[1] </td>";
														echo "<td> $each_rec[2] </td>";
														echo "<td> $each_rec[3] </td>";
														echo "<td> $each_rec[4] </td>";
														echo "<td> $each_rec[5] </td>";
														echo "<td> $each_rec[6] </td>";
						if(isset($_SESSION['s_eid']))
						{	
							$spoc_info = file("users_info/spoc_info.txt");
							foreach($spoc_info as $spoc_rec)
							{
								$s_data = explode(",", "$spoc_rec");
								if(strcmp($_SESSION['s_eid'],$s_data[2]))
								{
									$s_odc = $s_data[0];
									break;
								}
							}
							if(strcmp($s_odc,$odc_name))
							{
						?>								<td> <a type='button' class='btn btn-xs btn-primary' href="dynamic_select.php?odc_name=<?php echo $each_rec[0] ?>&rc=<?php echo $each_rec[1] ?>" onclick='release_cubical()'>Release</a> </td> 
				<?php		}
						}
						else
						{
														echo "<td> OCCUPIED </td>"; 
						}								echo "</tr>";
														$e++;
													}	
						?>							
												</tbody>
											</table>	
										</div>
						<?php 			$i++;$j++;
									}	?>
								</div>
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