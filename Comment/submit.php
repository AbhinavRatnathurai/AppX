<?php
    include("../Main/db.php");
    $id=$_POST['variable1'];
    $comm=addslashes($_POST['comment']);
    $str=str_replace(' ', '&nbsp;', $comm);
    $fixedComm=nl2br($str);

    echo "$id";
    
    if(isset($_POST['comment'])){
        $SQL="INSERT INTO comment (comm , pId) VALUES ('".$fixedComm."',$id)";
        //$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
        //echo $SQL;
        if (mysqli_query($conn, $SQL)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $SQL . "<br>" . mysqli_error($conn);
        }
        $cId = mysqli_insert_id($conn);

        // // Execute the star_gen.py script with the $comm, $id, and $cId variables
        $script = "python ../Python_backend/model.py";
        $output = shell_exec($script);

        // Print the output of the Python script
        echo $output;

        header('Location:../Product/buypage.php?pid='.$id);
    }

?>