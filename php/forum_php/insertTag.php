<?php

include "loadTags.php";
$tagId;
$postId = $post['id'];

$lines = explode(",",$tags);

foreach($lines as $tag){
  
    try{
  
        $tag = strtolower($tag);

        $tagId = findTagId($tag);

        if( $tagId < 0){

            $intoTags= "INSERT INTO Tag(id,name) VALUES(default, :tag)";
            $insert = $dbh->prepare($intoTags);
            $insert->bindParam(":tag", $tag, PDO::PARAM_INT);
            $insert->execute();
            $tagId = $dbh->lastInsertId();

        }

        $intoHasTags = "INSERT INTO HasTag (tag,post) VALUES(:tag, :post) RETURNING *";
        $insert = $dbh->prepare($intoHasTags);
        $insert->bindParam(":tag", $tagId, PDO::PARAM_INT);
        $insert->bindParam(":post", $postId, PDO::PARAM_INT);
        $insert->execute();
  

    }catch(Exception $e){
        echo "<script>alert('Error: Failed to insert tag');</script>";
        throw new Exception("Failed to insert tag");
    }
}   


?>