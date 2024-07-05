<?php
  $page="Categories";
  session_start();
  if(isset($_GET['error_msg']))
  {
    $msg = $_GET['error_msg'];
    $alertType = "alert-danger";
  }
  include_once('includes/check_logged.php');
  include_once('includes/conn.php');
  try{
      $sql = "SELECT * FROM category";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
  } catch(PDOException $e) {
      $msg = $e->getMessage();
      $alertType = "alert-danger";
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include_once('includes/head.php');?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-graduation-cap"></i></i> <span>Education Admin</span></a>
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
                <h3>Manage Categories</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
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
                    <h2>List of Categories</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Category Name</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php
                        foreach ($result as $category)
                        {
                          $id = $category['id']; 
                          $name = $category['name'];        
                        ?>
                        <tr>
                          <td><?php echo $name ?></td>
                          <td><a href="editCategory.php?id=<?php echo $id ?>"><img src="./images/edit.png" alt="Edit"></a></td>
                          <td><a href="deletecategory.php?id=<?php echo $id ?>" onclick="return checkDelete()"><img src="./images/delete.png" alt="Delete"></a></td>
                        </tr>
                        <?php
                        }    
                        ?>
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
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

    <?php include_once('includes/javascript_libs.php');?>

  </body>
</html>