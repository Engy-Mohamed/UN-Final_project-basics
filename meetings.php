<?php 
$title = "Education - List of Meetings";
$page = "Meetings";
$perPage = 6;
$pageNo = (isset($_GET['pageNo'])) ? (int)$_GET['pageNo'] : 1;
$startAt = $perPage * ($pageNo - 1);
include_once('admin/includes/conn.php');
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
  $current_date = date("Y-m-d");;
  $sql_No_of_records = "SELECT COUNT(*) as total FROM meeting where active = ? and meeting_date > ? ";
  $stmt_No_of_records = $conn->prepare($sql_No_of_records);
  $stmt_No_of_records->execute([$active, $current_date]);
  $result_No_of_records = $stmt_No_of_records->fetch();
  $totalPages = ceil($result_No_of_records['total'] / $perPage);

  $links = "";
  for ($i = 1; $i <= $totalPages; $i++) {
    $links .= ($i != $pageNo ) 
              ? "<li><a href='meetings.php?pageNo=$i'>".$i."</a><li> "
              :"<li class='active'><a href='meetings.php?pageNo=$i'>".$pageNo."</a></li>";
          
  }
  
  $sql_upcomming_meeting = "SELECT meeting.id, meeting_date, image, title, price, content, category.name as
   category_name FROM meeting inner join category on meeting.category_id = category.id where active = ? and meeting_date > ? LIMIT ".$startAt.", ".$perPage;
  $stmt_upcomming_meetings = $conn->prepare($sql_upcomming_meeting);
  $stmt_upcomming_meetings->execute([$active, $current_date]);
  $result_upcomming_meetings = $stmt_upcomming_meetings->fetchAll();
} catch(PDOException $e) {
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
    <?php include_once("admin/includes/alert.php"); ?>
      <div class="row">
        <div class="col-lg-12">
          <h6>Here are our upcoming meetings</h6>
          <h2>Upcoming Meetings</h2>
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
              <div class="filters">
                <ul>
                  <li data-filter="*"  class="active">All Meetings</li>
                  <li data-filter=".soon">SOON</li>
                  <?php
                    foreach ($result_cat as $category)
                    {
                      $category_id = $category['id']; 
                      $category_name = $category['name'];        
                    ?>
                  <li data-filter=".<?php echo $category_name ;?>"><?php echo $category_name ; ?></li>
                  <?php
                    }
                    ?>
                </ul>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="row grid">
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
                $upcomming_meeting_category_name =  $upcomming_meeting['category_name'];
                $soon = ($date < strtotime(date("Y-m-d"). ' + 14 days'))? "soon":"";
            ?>
                <div class="col-lg-4 templatemo-item-col all <?php echo $soon;?> <?php echo $upcomming_meeting_category_name ;?>">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>$<?php echo $upcomming_meeting_price ;?></span>
                      </div>
                      <a href="meeting-details.php?id=<?php echo $upcomming_meeting_id ;?>"><img src="admin/images/<?php echo $upcomming_meeting_image ;?>" alt="<?php echo $upcomming_meeting_title ;?>"></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6><?php echo $upcomming_meeting_month ;?> <span><?php echo $upcomming_meeting_day ;?></span></h6>
                      </div>
                      <a href="meeting-details.php?id=<?php echo $upcomming_meeting_id ;?>"><h4><?php echo $upcomming_meeting_title ;?></h4></a>
                      <p><?php echo $upcomming_meeting_content ;?></p>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
                         
              </div>
            </div>
            <div class="col-lg-12">
              <div class="pagination">
                <ul>
                  <?php echo $links ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>Copyright © 2022 Edu Meeting Co., Ltd. All Rights Reserved. 
          <br>Design: <a href="https://templatemo.com/page/1" target="_parent" title="website templates">TemplateMo</a></p>
    </div>
  </section>


  <!-- Scripts -->
  <?php include_once('includes/java_scripts.php');?>
    
</body>


  </body>

</html>
