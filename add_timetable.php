<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('db.php');

    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $teacher = mysqli_real_escape_string($conn, $_POST['teacher']);
    $day = mysqli_real_escape_string($conn, $_POST['day']);
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $classroom = mysqli_real_escape_string($conn, $_POST['classroom']);

    $sql = "INSERT INTO timetable (subject, teacher, day, start_time, end_time, classroom) 
            VALUES ('$subject', '$teacher', '$day', '$start_time', '$end_time', '$classroom')";

    if (mysqli_query($conn, $sql)) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Timetable</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add Timetable</h2>
    <form action="add_timetable.php" method="POST">
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
        
        <label for="teacher">Teacher:</label>
        <input type="text" id="teacher" name="teacher" required>

        <label for="day">Day:</label>
        <select id="day" name="day" required>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
        </select>

        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time" required>

        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time" required>

        <label for="classroom">Classroom:</label>
        <input type="text" id="classroom" name="classroom" required>

        <button type="submit">Add Timetable</button>
    </form>
</body>
</html>
