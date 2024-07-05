<?php
	$page = "Edit Category";
	session_start();
	include_once("includes/check_logged.php");
	include_once("includes/conn.php"); 
	$id = $_GET['id'];
     if ($_SERVER["REQUEST_METHOD"] === "POST" ){			
		try{
			$name = $_POST['name'];	
  			$sql = "UPDATE `category` SET `name`=? WHERE `id`=?";	
			$stmt = $conn->prepare($sql);
			$stmt->execute([$name, $id]);
					
			$msg = "Updated Successfully";
			$alertType = "alert-success";
			} 
		catch(PDOException $e){
			$msg = $e->getMessage();
			$alertType = "alert-danger";
		}
	}
	try{
		$sql = "SELECT * FROM category where id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$id]);
		if($stmt->rowcount())
		{
			$result = $stmt->fetch();			
			$name = $result['name'];
		}
		
	}
	catch(PDOException $e){
		$msg = $e->getMessage();
		$alertType = "alert-danger";
		
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include_once('includes/head2.php');?>
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="index.html" class="site_title"><i class="fa fa-graduation-cap"></i> <span>Education Admin</span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<?php include_once('includes/menu_profile_quick_info.php');?>
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->
					<?php include_once('includes/sidebar_menu.php');?>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<?php include_once('includes/menu_footer_buttons.php');?>
					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<?php include_once('includes/top_nav.php');?>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Edit Category</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
								<?php 
					                  include_once("includes/alert.php");
							    ?>
									<h2>Edit Category</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form method="POST" action="" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="add-category">Edit Category <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="add-category" required="required" class="form-control " name="name" value="<?php echo $name?>">
											</div>
										</div>
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button type="submit" class="btn btn-success">Update</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
			<?php include_once('includes/footer.php');?>
			<!-- /footer content -->
		</div>
	</div>

	<?php include_once('includes/javascript_libs2.php');?>

</body></html>
