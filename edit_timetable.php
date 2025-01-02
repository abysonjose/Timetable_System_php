<?php
session_start();
include('db.php');

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the timetable entry from the database
    $sql = "SELECT * FROM timetable WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $teacher = mysqli_real_escape_string($conn, $_POST['teacher']);
        $day = mysqli_real_escape_string($conn, $_POST['day']);
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $classroom = mysqli_real_escape_string($conn, $_POST['classroom']);

        // Update timetable entry
        $update_sql = "UPDATE timetable SET 
                        subject='$subject', 
                        teacher='$teacher', 
                        day='$day', 
                        start_time='$start_time', 
                        end_time='$end_time', 
                        classroom='$classroom' 
                      WHERE id=$id";

        if (mysqli_query($conn, $update_sql)) {
            header('Location: dashboard.php'); // Redirect back to dashboard
            exit();
        } else {
            echo "Error updating timetable: " . mysqli_error($conn);
        }
    }
} else {
    echo "Invalid timetable ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Timetable</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Timetable Entry</h2>
    <form action="edit_timetable.php?id=<?php echo $row['id']; ?>" method="POST">
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" value="<?php echo $row['subject']; ?>" required>

        <label for="teacher">Teacher:</label>
        <input type="text" id="teacher" name="teacher" value="<?php echo $row['teacher']; ?>" required>

        <label for="day">Day:</label>
        <select id="day" name="day" required>
            <option value="Monday" <?php if($row['day'] == 'Monday') echo 'selected'; ?>>Monday</option>
            <option value="Tuesday" <?php if($row['day'] == 'Tuesday') echo 'selected'; ?>>Tuesday</option>
            <option value="Wednesday" <?php if($row['day'] == 'Wednesday') echo 'selected'; ?>>Wednesday</option>
            <option value="Thursday" <?php if($row['day'] == 'Thursday') echo 'selected'; ?>>Thursday</option>
            <option value="Friday" <?php if($row['day'] == 'Friday') echo 'selected'; ?>>Friday</option>
        </select>

        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time" value="<?php echo $row['start_time']; ?>" required>

        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time" value="<?php echo $row['end_time']; ?>" required>

        <label for="classroom">Classroom:</label>
        <input type="text" id="classroom" name="classroom" value="<?php echo $row['classroom']; ?>" required>

        <button type="submit">Update Timetable</button>
    </form>
</body>
</html>
