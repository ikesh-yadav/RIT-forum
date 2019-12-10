<?php
include_once('mysql.php');
$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];
$like_or_dislike = $_POST['is_like'];
$sql = "INSERT INTO `post_likes_dislikes` VALUES($post_id,$user_id,$like_or_dislike)";
if ($link->query($sql)){
  echo "success";
}
else{
    echo "Error: ". $sql ." ". $link->error;
  }
  //$link->close();

?>