<?php

  include "forum_credentials.php";
  
  if(isset($_REQUEST))
    $post = $_REQUEST["post"];
  else $post = $post["id"];
  
  try {
    $dbh = new PDO($conn_string);
    
    $selectSum = "SELECT SUM";
    $voteUp= "((SELECT Count(*) FROM Vote JOIN Post on Vote.post=Post.id WHERE value=TRUE and Post.id = :post) ";
    $minusVoteDown = "- (SELECT Count(*) FROM Vote JOIN Post on Vote.post=Post.id WHERE value=FALSE AND Post.id = :post)) AS total";
    
    $stmt = $selectSum.$voteUp.$minusVoteDown;

    $select = $dbh-> prepare($stmt);

    $select-> bindParam(":post", $post, PDO::PARAM_INT);
    
    $select->execute();

    $result = $select->fetch(PDO::FETCH_ASSOC);

   
    if(isset($_REQUEST["show"]))
    echo $result["total"];

  
  } catch (Exception $e) {
    echo"error";
    echo $e;
  }



?>