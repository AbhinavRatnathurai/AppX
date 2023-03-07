<?php
    include("../Main/db.php");
    $id=$_POST['variable1'];
    $comm=$_POST['comment'];
    echo "$id";
    if($comm != " "){
        $SQL="insert into comment (comm , pId) values ('$comm',  $id)";
        $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
        $cId = mysqli_insert_id($conn);

        // Execute the star_gen.py script with the $comm, $id, and $cId variables
        $script = "python star_gen.py \"$comm\" \"$id\" \"$cId\"";
        $output = shell_exec($script);

        // Print the output of the Python script
        echo $output;
        header('Location:../Product/buypage.php?pid='.$id);

        
    }
?>