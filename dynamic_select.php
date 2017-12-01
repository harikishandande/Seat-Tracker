<?php session_start();
	
	if(isset($_POST['odc_info']))
	{
		$odc_info = $_POST['odc_info'];
		$odc_f_info = explode('|', $odc_info);
		$cubical_info = file($odc_f_info[1], FILE_IGNORE_NEW_LINES);
		$path_info = pathinfo($odc_f_info[1]);
		
		$_SESSION["odc_path"] = $path_info['dirname'];
		$_SESSION["odc_name"] = $path_info['filename'];
	
		echo '<option value="-1"><< Please select cubical number >></option>';
		foreach($cubical_info as $each_cubical)
		{	
			echo '<option value="' . $each_cubical . '">' . $each_cubical . '</option>';
		}		
	}

	if(isset($_POST['cubical_number']))
	{
		$search_cubical = $_POST['cubical_number'];
		$odc_path = $_SESSION["odc_path"];
		$odc_name = $_SESSION["odc_name"];
		
		$users_file = "$odc_path/$odc_name" . '_users_info.txt';	
		header('Content-Type: text/plain');
		$contents = file_get_contents($users_file);
		$pattern = preg_quote($search_cubical, '/');
		$pattern = "/^.*$pattern.*\$/m";
		if(preg_match_all($pattern, $contents, $matches))
		{
			$_SESSION["notification"] = 1;
			echo '<div class="alert alert-dismissable alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
						
					</button>
					<h4>
						<strong>Alert!</strong>
					</h4> This cubical( <strong>'. $search_cubical .'</strong> ) is occupied. If you are sure that it\'s vacant.<br/> <center>Please contact your <strong>SPOC</strong>.</center>
				  </div>';
		}
		else
		{
			$_SESSION["notification"] = 0;
		}
	}
	
	if(isset($_POST['emp_id']))
	{
		$search_id = $_POST['emp_id'];
		$odc_path = $_SESSION["odc_path"];
		$odc_name = $_SESSION["odc_name"];
		
		$users_file = "$odc_path/$odc_name" . '_users_info.txt';	
		header('Content-Type: text/plain');
		$contents = file_get_contents($users_file);
		$pattern = preg_quote($search_id, '/');
		$pattern = "/^.*$pattern.*\$/m";
		if(preg_match_all($pattern, $contents, $matches))
		{
			$_SESSION["notification"] = 3;
			echo '<div class="alert alert-dismissable alert-warning">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
					
					</button>
					<h4>
						<strong>Warning!</strong>
					</h4> This Employee( <strong>'. $search_id .'</strong> ) is found in our record. <center>Please cross check or contact your <strong>SPOC</strong>.</center>
				  </div>';
		}
		else
		{
			$_SESSION["notification"] = 2;
		}
	}
	
	if(isset($_POST['odc_name']))
	{
		$odc_name = $_POST['odc_name'];
		header('Content-Type: application/download');
		  header('Content-Disposition: attachment; filename='."$odc_name". '.xlsx');
		  header("Content-Length: " . filesize("$odc_name.xlsx"));
		  $fp = fopen("$odc_name.xlsx", "r");
		  fpassthru($fp);
		  fclose($fp);
	}
	
	if(isset($_POST['spoc_login']))
	{
		$auth = 0;
		$spoc_info = file("users_info/spoc_info.txt");
		foreach($spoc_info as $spoc_rec)
		{
			$s_data = explode(",",$spoc_rec);

			if(($_POST['s_eid'] == $s_data[2]) && (strcmp(trim($_POST['s_password']),trim($s_data[3])) == 0))
			{
				$auth = 1;
				$_SESSION['s_name'] = $s_data[1];
				$_SESSION['s_eid'] = $s_data[2];
				break; 
			}
		}
		if($auth) 
		{
			$_SESSION["login"] = 3; 
		}
		else 
		{
			$_SESSION["login"] = 4; 	
		}
		header('Location: index.php');
	}
	
	if(isset($_GET['rc']))
	{
		$release_cubical = $_GET['rc'];
		$odc_name = $_GET['odc_name'];
		
		$odc_details=file('users_info/odc_info.txt', FILE_IGNORE_NEW_LINES);
		$i=0;
		foreach($odc_details as $odc_rec)
		{	
			$s_arrfields = explode(',', $odc_rec);
			if(strcmp(trim($s_arrfields[0]),trim($odc_name)) == 0)
			{
				$cubical_file = $s_arrfields[1];
			}
		}
		
		$cubical_file = str_replace("$odc_name","$odc_name". "_users_info","$cubical_file");
		
		$lines = file($cubical_file, FILE_IGNORE_NEW_LINES);
			
		foreach($lines as $key => $line)
		  if(stristr($line, $release_cubical)) unset($lines[$key]);

		 
		$data = implode("\n", array_values($lines)) . PHP_EOL;;
	
		$file = fopen($cubical_file,"w+");
		fwrite($file, $data);
		fclose($file);
		
		$_SESSION['release_cubical'] = $release_cubical;
		header('Location: list_cubicals.php');
	}

?>