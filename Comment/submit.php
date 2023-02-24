<?php
    include("../Main/db.php");
    $id=$_POST['variable1'];
    $comm=$_POST['comment'];
    echo "$id";
    if($comm != " "){
        $SQL="insert into comment (comm , pId) values ('$comm',  $id)";
        $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
        header('Location:../Product/buypage.php?pid='.$id);
    }
?>