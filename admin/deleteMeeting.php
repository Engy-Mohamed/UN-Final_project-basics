<?php
  $id = $_GET['id'];
  session_start();
  include_once('includes/check_logged.php');
  include_once('includes/conn.php');
  try{
      $sql = "DELETE FROM meeting where id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$id]);
      header("location:meetings.php");
	  die();
      
  } catch(PDOException $e) {
      $msg = $e->getMessage();
      $alertType = "alert-danger";
  }
?> 
