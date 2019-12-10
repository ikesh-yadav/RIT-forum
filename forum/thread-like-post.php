<?php
include_once('mysql.php');
$user_id = $_POST['user_id'];
$thread_id = $_POST['thread_id'];
$like_or_dislike = $_POST['is_like'];
$sql = "INSERT INTO `thread_likes_dislikes` VALUES($thread_id,$user_id,$like_or_dislike)";
if ($link->query($sql)){
  echo "success";
}
else{
    echo "Error: ". $sql ." ". $link->error;
  }
  //$link->close();

?>