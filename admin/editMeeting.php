<?php
	$page = "Edit Meeting";
	session_start();
	include_once("includes/check_logged.php");
	include_once("includes/conn.php"); 
	$id = $_GET['id'];
     if ($_SERVER["REQUEST_METHOD"] === "POST" ){	
				
		try{
			$meeting_date = $_POST['meeting_date'];
			$title = $_POST['title'];
			$content = $_POST['content'];
			$location = $_POST['location'];
			$price = $_POST['price'];
			$active = isset($_POST['active']);
			$category_id = $_POST['category_id'];
			if(!empty($_FILES['image']['name']))
			{
				include("includes/upload.php");
			}
			else
			{
				$image = $_POST['old_image'];
			}
	
			$sql = "UPDATE `meeting` SET `meeting_date`=?,`title`=?,`content`=?,`location`=?,`price`=?,`image`=?,`active`=?,`category_id`=? WHERE `id`=?";
			
			$stmt = $conn->prepare($sql);
			$stmt->execute([$meeting_date, $title, $content, $location, $price, $image, $active, $category_id,$id]);
					
			$msg = "Updated Successfully";
			$alertType = "alert-success";
			} 
		catch(PDOException $e){
			$msg = $e->getMessage();
			$alertType = "alert-danger";
			
			}	
	 }
	try{
		$sql_cat = "select * from category";
		$stmt_cat = $conn->prepare($sql_cat);
		$stmt_cat->execute();
		$category_results = $stmt_cat->fetchAll();

		$sql = "SELECT * FROM meeting where id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$id]);
		if($stmt->rowcount())
		{
			$result = $stmt->fetch();			
			$meeting_date = $result['meeting_date'];
			$title = $result['title'];
			$content = $result['content'];
			$location = $result['location'];
			$price = $result['price'];
			$active = $result['active'];
			$category_id = $result['category_id'];

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
							<h3>Manage Meetings</h3>
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
								 <?php include_once("includes/alert.php"); ?>
									<h2>Edit Meeting</h2>
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
									<form method="POST" action="" id="demo-form2" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="meeting-date">Meeting Date <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" id="meeting-date" required="required" class="form-control " name="meeting_date" value='<?php echo $meeting_date;?>'>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="title" required="required" class="form-control " name="title" value='<?php echo $title;?>'>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Content <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea id="content" name="content" required="required" class="form-control"><?php echo $content;?></textarea>
											</div>
										</div>
										<div class="item form-group">
											<label for="location" class="col-form-label col-md-3 col-sm-3 label-align">Location <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="location" class="form-control" type="text" name="location" required="required" value="<?php echo $location;?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="price" class="col-form-label col-md-3 col-sm-3 label-align">Price <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="price" class="form-control" type="number" name="price" required="required" value="<?php echo $price;?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" class="flat" <?php echo $active ? 'checked':'';?> name="active">
												</label>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" id="image" name="image"  class="form-control" accept="image/*">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Category <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="category_id" id="category_id">
												<?php
                                
													foreach($category_results as $category){
														$category_name = $category['name'] ;
														$cat_id = $category['id'] ;
														$selected_category = ($cat_id == $category_id)?'selected':'';
														
												?>
													<option value="<?php echo  $cat_id ?>" <?php echo $selected_category?> ><?php echo $category_name?></option>
												<?php
												}
												?>
												</select>
											</div>
										</div>
										<div class="ln_solid"></div>
										<input type="hidden" name="old_image" value="<?php echo $image ?>">
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
			<footer>
			<?php include_once('includes/footer.php');?>
			</footer>
			<!-- /footer content -->
		</div>
	</div>

	
	<?php include_once('includes/javascript_libs2.php');?>

</body></html>
