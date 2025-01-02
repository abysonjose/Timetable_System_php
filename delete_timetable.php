<?php
include('db.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM timetable WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: dashboard.php'); // Redirect after deletion
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
