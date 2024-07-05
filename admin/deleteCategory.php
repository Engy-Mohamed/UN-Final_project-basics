<?php
  $id = $_GET['id'];
  session_start();
  include_once('includes/check_logged.php');
  include_once('includes/conn.php');
  try{
      $sql = "select * from meeting where category_id=?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$id]);
      if($stmt->rowcount())
      {
        $error_msg= "There are meetings belong to this category";
        header("location:categories.php?error_msg=".$error_msg);
        die;
      }
      $sql = "DELETE FROM category where id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$id]);
      header("location:categories.php");
	  die();
      
  } catch(PDOException $e) {
      $msg = $e->getMessage();
      $alertType = "alert-danger";
  }
?> 
