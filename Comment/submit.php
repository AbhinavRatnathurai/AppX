<?php
    include("../Main/db.php");
    $id=$_POST['variable1'];
    $comm=$_POST['comment'];
    echo "$id";
    $SQL="insert into comment (comm, csRate , pId) values ('$comm', 2.3, $id)";
    $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
    header('Location:../Product/product.php?pid='.$id);
    die();
?>  