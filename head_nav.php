<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seat Tracker Application</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
 <!--   <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
         CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

	<script type="text/javascript">
	
	function fetch_cubical() {
		var v = $('#odc_choice').val();
		$.ajax({
			type: 'POST',
			url: 'dynamic_select.php',
			data: 'odc_info=' + v,
			success:function(html){
				$('#cubical_choice').html(html);
			}
		});
	}
	
	function validate_cubical() {
		var cubical_number = $('#cubical_choice').val();
			$.ajax({
				type: 'POST',
				url: 'dynamic_select.php',
				data: 'cubical_number=' + cubical_number,
				success:function(html){
					$('#notification').html(html);
				}
			});
	}
	
	function validate_emp() {
        var emp_id = $('#emp_id').val();
			$.ajax({
				type: 'POST',
				url: 'dynamic_select.php',
				data: 'emp_id=' + emp_id,
				success:function(html){
					$('#notification').html(html);
				}
			});
    }
	
	function findselected() { 
		var result = document.querySelector('input[name="cub_status"]:checked').value;
		if(result=="port_issue")
		{
			document.getElementById("emp_id").setAttribute('disabled', true);
			document.getElementById("emp_name").setAttribute('disabled', true);
			document.getElementById("emp_pm").setAttribute('disabled', true);
			document.getElementById("emp_tm").setAttribute('disabled', true);
			document.getElementById("emp_project_name").setAttribute('disabled', true);
			document.getElementById("emp_remark").setAttribute('disabled', true);
		}
		else if(result=="others"){
			document.getElementById("emp_id").setAttribute('disabled', true);
			document.getElementById("emp_name").setAttribute('disabled', true);
			document.getElementById("emp_pm").setAttribute('disabled', true);
			document.getElementById("emp_tm").setAttribute('disabled', true);
			document.getElementById("emp_project_name").setAttribute('disabled', true);
			
			document.getElementById("emp_remark").removeAttribute('disabled');
			document.getElementById("emp_remark").setAttribute('required');
		}
		else if(result=="normal")
		{
			document.getElementById("emp_id").removeAttribute('disabled');
			document.getElementById("emp_name").removeAttribute('disabled');
			document.getElementById("emp_pm").removeAttribute('disabled');
			document.getElementById("emp_tm").removeAttribute('disabled');
			document.getElementById("emp_project_name").removeAttribute('disabled');
			document.getElementById("emp_remark").removeAttribute('disabled');
			document.getElementById("emp_remark").removeAttribute('required');
		}
	}
	</script>
	
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Seat Tracker</a> 
            </div>
			<?php 
			if(isset($_SESSION['s_eid']))
			{
			?>
				<div style="color: white;
				padding: 15px 50px 5px 50px;
				float: right;
				font-size: 16px;"> <i class="fa fa-user fa-1x"></i> <a href="spoc_profile.php" style="color:white;"><?php echo $_SESSION['s_name']; ?></a> &nbsp; <a href="logout.php" class="btn btn-primary square-btn-adjust">Logout</a> </div>
		<?php
			}
			else
			{	?>		
				<div style="color: white;
				padding: 15px 50px 5px 50px;
				float: right;
				font-size: 16px;"> &nbsp; <a href="spoc_login.php" class="btn btn-primary square-btn-adjust"><i class="fa fa-edit fa-1x"></i> Login</a> </div>
	<?php	}
			?>
		</nav>
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li class="text-center">
						<img src="logo.png" width="50%" class="user-image img-responsive"/>
					</li>
                    <li>
                        <a <?php if($nav == 'index'){ echo 'class="active-menu"'; }?> href="index.php"><i class="fa fa-square-o fa-1x"></i> Allocate Cubical</a>
                    </li>
					<li>
                        <a <?php if($nav == 'list_cubicals'){ echo 'class="active-menu"'; }?> href="list_cubicals.php"><i class="fa fa-list fa-1x"></i> Allocated Cubicals</a>
                    </li>
                     <li>
                        <a <?php if($nav == 'odc_layout'){ echo 'class="active-menu"'; }?> href="odc_layout.php"><i class="fa fa-desktop fa-1x"></i> ODC's layout Info</a>
                    </li>
			<?php 
			if(isset($_SESSION['s_eid']))
			{
			?>         
					<li>
                        <a <?php if($nav == 'excel_convertion'){ echo 'class="active-menu"'; }?> href="excel_convertion.php"><i class="fa fa-table fa-1x"></i> Excel sheet convertion</a>
                    </li>
	<?php	} ?>
      <!--          <li>
                        <a <?php //if($nav == 'spoc_login'){ echo 'class="active-menu"'; }?> href="spoc_login.php"><i class="fa fa-edit fa-1x"></i> SPOC login </a>
                    </li>				  
        -->     </ul>
            </div>
        </nav>