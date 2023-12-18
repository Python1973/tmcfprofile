<?php
include "database.php";
if (isset($_GET['id'])) {
    $stu_id = $_GET['id'];
    $sql = "DELETE FROM student WHERE id = '$stu_id'";
    $result = $conn->query($sql);
    if ($result == TRUE) {
        echo "Record deleted successfully.";
        header('Location: home.php');
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}
?>