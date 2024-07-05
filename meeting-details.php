<?php

    $id = $_GET["id"];
    $page = "Meeting_details";
    include_once('admin/includes/conn.php');
    try{
        # update the number of visits
        $sql_update= "update meeting set no_of_visits=no_of_visits+1 where id =?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->execute([$id]);
        
        $sql = "SELECT * FROM meeting where id = ? and active= ?";
        $active = 1;
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id, $active]);
          if($stmt->rowcount())
          {
            $result = $stmt->fetch();			
            $date = strtotime($result['meeting_date']);
            $meeting_date_day= date('j', $date); 
            $meeting_date_month= date('M', $date); 
            $meeting_title = $result['title'];
            $meeting_content = $result['content'];
            $meeting_image = $result['image'];
            $meeting_location = $result['location'];
            $meeting_price = $result['price'];
            $meeting_active = $result['active'];
            $meeting_category_id = $result['category_id'];
            $title = $result['title'];
          }
          else
          {
            $msg = "There is no data";
            $alertType = "alert-danger";
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
  <?php include_once('includes/head3.php');?>
  </head>

<body>

   

  <!-- Sub Header -->
  <?php include_once('includes/subHeader.php');?>

  <!-- ***** Header Area Start ***** -->
  <?php include_once('includes/header.php');?>
  <!-- ***** Header Area End ***** -->

  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Get all details</h6>
          <h2><?php  echo $title ?></h2>
        </div>
      </div>
    </div>
  </section>

  <section class="meetings-page" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-12">
              <div class="meeting-single-item">
                <div class="thumb">
                  <div class="price">
                    <span>$<?php  echo $meeting_price ?></span>
                  </div>
                  <div class="date">
                    <h6><?php  echo $meeting_date_month ?> <span><?php  echo $meeting_date_day ?></span></h6>
                  </div>
                  <a href="meeting-details.php?id=<?php  echo $meeting_id ?>"><img src="admin/images/<?php  echo $meeting_image ?>" alt=""></a>
                </div>
                <div class="down-content">
                  <a href="meeting-details.php?id=<?php  echo $meeting_id ?>"><h4><?php  echo $meeting_title ?></h4></a>
                  <p><?php  echo $meeting_location ?></p>
                  <p class="description">
                  <?php  echo $meeting_content?>
                  </p>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="hours">
                        <h5>Hours</h5>
                        <p>Monday - Friday: 07:00 AM - 13:00 PM<br>Saturday- Sunday: 09:00 AM - 15:00 PM</p>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="location">
                        <h5>Location</h5>
                        <p><?php  echo $meeting_location ?></p>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="book now">
                        <h5>Book Now</h5>
                        <p>010-020-0340<br>090-080-0760</p>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="share">
                        <h5>Share:</h5>
                        <ul>
                          <li><a href="#">Facebook</a>,</li>
                          <li><a href="#">Twitter</a>,</li>
                          <li><a href="#">Linkedin</a>,</li>
                          <li><a href="#">Behance</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button-red">
                <a href="meetings.php">Back To Meetings List</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>Copyright © 2022 Edu Meeting Co., Ltd. All Rights Reserved. 
          <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a></p>
    </div>
  </section>


  <!-- Scripts -->
  <?php include_once('includes/java_scripts.php');?>
</body>
  </body>
</html>
