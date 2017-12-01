<?php session_start();

$nav='excel_convertion';

if(isset($_SESSION['s_eid']))
{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php include( 'head_nav.php' ); ?>
	
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
						<h2>Convert to Excel</h2>
						<hr/>
						<!-- ##########Before and after cancel###########-->
						<div class="col-md-12">
							<!-- ################### end of tab block ##################### -->
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
										
										$s_arrfields = explode(',', $odc_name);
										$path_info = pathinfo($s_arrfields[1]);
										$odc_path = $path_info['dirname'];
										$odc_name = $path_info['filename'];
										
												$spoc_info = file("users_info/spoc_info.txt");
												foreach($spoc_info as $spoc_rec)
												{
													$s_data = explode(",","$spoc_rec");
													
													if($odc_name == $s_data[0])
													{
														$s_name = $s_data[1];
														break;
													}
												}	
										
										$users_file = "$odc_path/$odc_name" . '_users_info.txt';										
										pathinfo($s_arrfields[1]);
										$occupied_cubicals = file($users_file, FILE_IGNORE_NEW_LINES);
										
										if($j == 0) { echo "<div class='tab-pane active' id='panel-$i'>"; } else { echo "<div class='tab-pane' id='panel-$i'>"; }
										
										require_once dirname(__FILE__) . '/PHPExcel.php';
										$objPHPExcel = new PHPExcel();
										$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
																	 ->setLastModifiedBy("Maarten Balliauw")
																	 ->setTitle("Office 2007 XLSX Test Document")
																	 ->setSubject("Office 2007 XLSX Test Document")
																	 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
																	 ->setKeywords("office 2007 openxml php")
																	 ->setCategory("Test result file");
										
										$objPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
										
										$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(6);
										$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
										$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
										$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
										$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17);
										$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
										$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
										$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
										$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(17);
										$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
										$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
										$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(13);
										
										$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10)->setBold(false);
										$objPHPExcel->getDefaultStyle()->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
										$objPHPExcel->getActiveSheet()->getStyle('B6:M6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('dbdbdb');
										$objPHPExcel->getActiveSheet()->getStyle('B6:M6')->getFont()->setName('Arial')->setSize(10)->setBold(true);
										$objPHPExcel->getActiveSheet()->mergeCells('F3:I4');
										$objPHPExcel->getActiveSheet()->getStyle('F3')->getAlignment()->applyFromArray(array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,));
										$objPHPExcel->getActiveSheet()->getStyle('F3')->getFont()->setName('Arial')->setSize(16)->setBold(false);
										$objPHPExcel->getActiveSheet()->setCellValue('F3', "Capital One ODC :: $odc_name");
									
										$styleArray = array(
														'borders' => array(
															'allborders' => array(
																'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
																'color' => array('argb' => '000000'),
															),
														),
													);
										$objPHPExcel->getActiveSheet()->getStyle('F3:I4')->applyFromArray($styleArray);
										$objPHPExcel->getActiveSheet()->getStyle('B6:M6')->applyFromArray($styleArray);
										
										if (file_exists("$odc_name.xlsx")) { unlink("$odc_name.xlsx"); }
						?>					
											<table class="table">
												<thead>
													<tr>
														<th> S No </th>
														<th> ODC Name </th>
														<th> Cubical Number </th>
														<th> Emp Id </th>
														<th> Emp Name </th>
														<th> Project Name </th>
														<th> Project Manager </th>
														<th> TM </th>
														<th> Status </th>
													</tr>
									<?php
													$objPHPExcel->getActiveSheet()   
														 ->setCellValue('B6', 'SI.No')
														 ->setCellValue('C6', 'ODC')
														 ->setCellValue('D6', 'Seat#')
														 ->setCellValue('E6', 'EMP ID')
														 ->setCellValue('F6', 'EMP Name')
														 ->setCellValue('G6', 'PM')
														 ->setCellValue('H6', 'TM')
														 ->setCellValue('I6', 'Cpro Project name')
														 ->setCellValue('J6', 'SPOC')
														 ->setCellValue('K6', 'Status')
														 ->setCellValue('L6', 'Remarks')
														 ->setCellValue('M6', 'GS ADM ODC');
														 
									?>			</thead>
												<tbody>
									<?php			
													$e=7;$f=1;
													foreach($occupied_cubicals as $each_cubical)
													{
														$each_rec = explode(',',$each_cubical);
														echo "<tr class='default'>";
														echo "<td> $f </td>";
														echo "<td> $each_rec[0] </td>";
														echo "<td> $each_rec[1] </td>";
														echo "<td> $each_rec[2] </td>";
														echo "<td> $each_rec[3] </td>";
														echo "<td> $each_rec[4] </td>";
														echo "<td> $each_rec[5] </td>";
														echo "<td> $each_rec[6] </td>";
														echo "<td> $each_rec[7] </td>";
														echo "</tr>";
														
														if(!strcmp($each_rec[8],"-"))
														{
															$remark=" ";
														}
														else
														{
															$remark=$each_rec[8];
														}
														
													$objPHPExcel->getActiveSheet()  
														 ->setCellValue('B' . $e, $f)
														 ->setCellValue('C' . $e, $each_rec[0])
														 ->setCellValue('D' . $e, $each_rec[1])
														 ->setCellValue('E' . $e, $each_rec[2])
														 ->setCellValue('F' . $e, $each_rec[3])
														 ->setCellValue('G' . $e, $each_rec[5])
														 ->setCellValue('H' . $e, $each_rec[6])
														 ->setCellValue('I' . $e, $each_rec[4])
														 ->setCellValue('J' . $e, "$s_name")
														 ->setCellValue('K' . $e, $each_rec[7])
														 ->setCellValue('L' . $e, "$remark")
														 ->setCellValue('M' . $e, "EC5-S2");
														 $e++;$f++;
													}
													
													$unoccupied_cubicals=file("$odc_path/$odc_name.txt", FILE_IGNORE_NEW_LINES);
													
													foreach($unoccupied_cubicals as $each_cubical)
													{
														$users_file = "$odc_path/$odc_name" . '_users_info.txt';	
														$contents = file_get_contents($users_file);
														$pattern = preg_quote($each_cubical, '/');
														$pattern = "/^.*$pattern.*\$/m";
														if(preg_match_all($pattern, $contents, $matches))
														{
															continue;
														}
														else
														{
															$objPHPExcel->getActiveSheet()  
																 ->setCellValue('B' . $e, $f)
																 ->setCellValue('C' . $e, "$odc_name")
																 ->setCellValue('D' . $e, "$each_cubical")
																 ->setCellValue('E' . $e, "")
																 ->setCellValue('F' . $e, "")
																 ->setCellValue('G' . $e, "")
																 ->setCellValue('H' . $e, "")
																 ->setCellValue('I' . $e, "")
																 ->setCellValue('J' . $e, "$s_name")
																 ->setCellValue('K' . $e, "VACANT")
																 ->setCellValue('L' . $e, "")
																 ->setCellValue('M' . $e, "EC5-S2");
																 $e++;$f++;
														}
													}
				
												$styleArray = array(
															'borders' => array(
																'allborders' => array(
																	'style' => PHPExcel_Style_Border::BORDER_THIN,
																	'color' => array('argb' => '000000'),
																),
															),
														);
												$e -= 1;
												$objPHPExcel->getActiveSheet()->getStyle("B7:M$e")->applyFromArray($styleArray);
									
									/*				TO GET FOCUS ON TOP CELL 			*/
									
									$objPHPExcel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
									
									
						?>						</tbody>
											</table>	
									<?php
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
										?>			<div class="row">
														<div class="col-md-3"></div>
														<div class="col-md-6">
															<form action="dynamic_select.php" method="post">
																<input type="hidden" name="odc_name" value="<?php echo "$odc_name";?>" />
																<input type="submit" value="Convert to EXCEL sheet" class="btn btn-block btn-lg btn-success"/>
															</form>
														</div>
														<div class="col-md-3"></div>
													</div>
									<?php		}
											}
									?>

										</div>
						<?php 			
										$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
										$objWriter->save("$odc_name.xlsx");
										$objPHPExcel->disconnectWorksheets();
										unset($objPHPExcel);
										$i++;$j++;
									}	?>
								</div>
							</div>
						</div>
						<?php
						//}
						?>
						<!-- ################### end of tab block ##################### -->
                    </div>
					<!-- ##########Before and after cancel###########-->
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
else
{
	header('Location: index.php');
}
?>