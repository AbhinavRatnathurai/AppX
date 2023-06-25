<?php
include("../Main/db.php");

if (isset($_POST['variable1'])) {
    $id = $_POST['variable1'];
    $comm = trim($_POST['comment']); // Trim leading and trailing spaces
    $wordCount = str_word_count($comm); // Count the number of words

    if (!empty($comm)) {
        // At least one word is entered, proceed with storing the comment
        $fixedComm = htmlspecialchars_decode($comm);

        echo "$id";

        if (isset($_POST['comment'])) {
            $SQL = "INSERT INTO comment (comm, pId) VALUES ('" . $fixedComm . "', $id)";

            if (mysqli_query($conn, $SQL)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $SQL . "<br>" . mysqli_error($conn);
            }
            $cId = mysqli_insert_id($conn);

            $shScriptPath = 'AppX/Comment/runcode.sh'; // Update with the correct path to your runcode.sh script
            $comment = escapeshellarg($comm);
            $command = " $shScriptPath $comment $id $cId";

            exec($command, $output, $returnCode);

            if ($returnCode === 0) {
                // The shell script executed successfully
                header('Location:../Product/buypage.php?pid=' . $id);
                exit(); // Add exit() after the header() function to terminate the script execution
            } else {
                // There was an error executing the shell script
                echo "Error executing the shell script. Please check your setup.";
            }
        }
    } else {
        // No words are entered, display a specific error message or take appropriate action
        echo "Error: Please enter a comment with at least one word.";
    }
}
?>

