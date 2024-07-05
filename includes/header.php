<?php 
    $class_name =  ($page == "Home")? "scroll-to-section":"";
    $href = ($page == "Home")? "":"index.php";
?>
<header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="index.php" class="logo">
                          Edu Meeting
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li class="<?php echo $class_name ?>"><a href="index.php#top" class="<?php echo ($page == 'Home') ? 'active':'' ?>">Home</a></li>
                          <li><a href="meetings.php" class ="<?php echo ($page == 'Meetings') ? 'active':'' ?>">Meetings</a></li>
                          <li class="<?php echo $class_name ?>"><a href="<?php echo $href ?>#apply">Apply Now</a></li>
                          <li class="has-sub">
                              <a href="javascript:void(0)">Pages</a>
                              <ul class="sub-menu">
                                  <li><a href="meetings.php">Upcoming Meetings</a></li>
                                  <li><a href="<?php echo ($page == 'Meeting_details')? '': 'meetings.php' ?>">Meeting Details</a></li>
                              </ul>
                          </li>
                          <li class="<?php echo $class_name ?>"><a href="<?php echo $href ?>#courses">Courses</a></li> 
                          <li class="<?php echo $class_name ?>"><a href="<?php echo $href ?>#contact">Contact Us</a></li> 
                      </ul>        
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
  </header>