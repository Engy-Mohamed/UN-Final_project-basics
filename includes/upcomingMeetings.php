<?php
  try{
      $sql_cat = "SELECT * FROM category";
      $stmt_cat = $conn->prepare($sql_cat);
      $stmt_cat->execute();
      $result_cat = $stmt_cat->fetchAll();
  } catch(PDOException $e) {
      $msg = $e->getMessage();
      $alertType = "alert-danger";
  }
  try{
    $active = 1;
    $current_date = date("Y-m-d");
    if(isset($_GET['category_id']))
    {
      $curr_category_id = $_GET['category_id'];
      $sql_upcomming_meeting = "SELECT id, meeting_date, image, title, price, content FROM meeting where active = ? and meeting_date > ? and category_id=? limit 4";
      $stmt_upcomming_meetings = $conn->prepare($sql_upcomming_meeting);
      $stmt_upcomming_meetings->execute([$active, $current_date,$curr_category_id]);
    }
    else{
    $sql_upcomming_meeting = "SELECT id, meeting_date, image, title, price, content FROM meeting where active = ? and meeting_date > ? limit 4";
    $stmt_upcomming_meetings = $conn->prepare($sql_upcomming_meeting);
    $stmt_upcomming_meetings->execute([$active, $current_date]);
    }
    $result_upcomming_meetings = $stmt_upcomming_meetings->fetchAll();
} catch(PDOException $e) {
    $msg = $e->getMessage();
    $alertType = "alert-danger";
}
?>
<section class="upcoming-meetings" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Upcoming Meetings</h2>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="categories">
            <h4>Meeting Catgories</h4>
            <ul>
            <?php
              foreach ($result_cat as $category)
              {
                $category_id = $category['id']; 
                $category_name = $category['name']."";   
                $class = (isset($curr_category_id) and $curr_category_id == $category_id)? "active":"";
              ?>
              <li class="<?php echo $class ?>"><a href="index.php?category_id=<?php echo $category_id; ?>#meetings" class="" > <?php echo $category_name; ?></a></li>
              <?php
              }
              ?>
            </ul>
            <div class="main-button-red">
              <a href="meetings.php">All Upcoming Meetings</a>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row">
          <?php
              foreach ($result_upcomming_meetings as $upcomming_meeting)
              {
                $upcomming_meeting_id = $upcomming_meeting['id']; 
                #1 Jan 2023 
                $date = strtotime($upcomming_meeting['meeting_date']);
                $upcomming_meeting_day= date('j', $date); 
                $upcomming_meeting_month= date('M', $date); 
                $upcomming_meeting_title = $upcomming_meeting['title']; 
                $upcomming_meeting_content= $upcomming_meeting['content'];  
                $upcomming_meeting_price= $upcomming_meeting['price']; 
                $upcomming_meeting_image= $upcomming_meeting['image'];   
                 
            ?>
            <div class="col-lg-6">
              <div class="meeting-item">
                <div class="thumb">
                  <div class="price">
                    <span>$<?php echo $upcomming_meeting_price ;?></span>
                  </div>
                  <a href="meeting-details.php?id=<?php echo $upcomming_meeting_id ?>"><img src="admin/images/<?php echo $upcomming_meeting_image;?>" alt="<?php echo $upcomming_meeting_title ;?>" style="height:300px;"></a>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6><?php echo $upcomming_meeting_month ;?> <span><?php echo $upcomming_meeting_day ;?></span></h6>
                  </div>
                  <a href="meeting-details.php?id=<?php echo $upcomming_meeting_id ?>"><h4><?php echo $upcomming_meeting_title ;?></h4></a>
                  <p><?php echo $upcomming_meeting_content ;?></p>
                </div>
              </div>
            </div>
            <?php 
              }

            ?>
            
            
          </div>
        </div>
      </div>
    </div>
  </section>