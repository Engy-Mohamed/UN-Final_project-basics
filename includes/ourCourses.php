<?php
try{
    $sql_popular_meeting = "SELECT id, image, title, price FROM meeting where active = ?  order by no_of_visits DESC limit 5";
    $active = 1;
    $stmt_popular_meeting = $conn->prepare($sql_popular_meeting);
    $stmt_popular_meeting->execute([$active]);
    $result_popular_meeting = $stmt_popular_meeting->fetchAll();
} catch(PDOException $e) {
    $msg = $e->getMessage();
    $alertType = "alert-danger";
}
?>
<section class="our-courses" id="courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Our Popular Courses</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-courses-item owl-carousel">
          <?php
              foreach ($result_popular_meeting as $popular_meeting)
              {
                $popular_meeting_id = $popular_meeting['id']; 
                $popular_meeting_title = $popular_meeting['title'];  
                $popular_meeting_price= $popular_meeting['price']; 
                $popular_meeting_image= $popular_meeting['image'];      
            ?>
            <div class="item">
              <img src="admin/images/<?php echo $popular_meeting_image ?>" alt="<?php echo $popular_meeting_title ?>" style="height:300px;">
              <div class="down-content">
                <h4><?php echo $popular_meeting_title ?></h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                       <span>$<?php echo $popular_meeting_price ?></span>
                    </div>
                  </div>
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