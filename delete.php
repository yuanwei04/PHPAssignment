<?php

session_start();

if (!empty($_GET)) {
    include('a-DBconnect.php');

    $table = $_GET['table'];
    $column = $_GET['column'];
    $pk = $_GET['pk'];

    $delete_query = "DELETE FROM $table WHERE $column = '$pk'";

    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Delete Successfully.');
        window.history.back();</script>";
    } else {
        echo "<script>alert('Unsuccessful');
        window.history.back();</script>";
    }
}
?>