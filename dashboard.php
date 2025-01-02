<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

echo "<h1>Welcome, " . htmlspecialchars($_SESSION['username']) . "</h1>";

if ($_SESSION['role'] == 'admin') {
    echo "<a href='add_timetable.php' class='button'>Add Timetable</a>";
}

echo "<a href='logout.php' class='button logout-button'>Logout</a>";

include('db.php');
$sql = "SELECT * FROM timetable";
$result = mysqli_query($conn, $sql);

echo "<table class='timetable-table'>";
echo "<tr><th>Subject</th><th>Teacher</th><th>Day</th><th>Start Time</th><th>End Time</th><th>Classroom</th><th>Actions</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['subject']}</td>
            <td>{$row['teacher']}</td>
            <td>{$row['day']}</td>
            <td>{$row['start_time']}</td>
            <td>{$row['end_time']}</td>
            <td>{$row['classroom']}</td>
            <td>
                <a href='edit_timetable.php?id={$row['id']}' class='action-link'>Edit</a> |
                <a href='delete_timetable.php?id={$row['id']}' class='action-link'>Delete</a>
            </td>
        </tr>";
}
echo "</table>";
?>

<style>
    /* Add some basic styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 20px;
    }

    h1 {
        color: #333;
    }

    .button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 20px;
        display: inline-block;
    }

    .button:hover {
        background-color: #45a049;
    }

    .logout-button {
        background-color: #f44336;
    }

    .logout-button:hover {
        background-color: #e53935;
    }

    .timetable-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .timetable-table th, .timetable-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .timetable-table th {
        background-color: #4CAF50;
        color: white;
    }

    .timetable-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .timetable-table tr:hover {
        background-color: #f1f1f1;
    }

    .action-link {
        text-decoration: none;
        color: #007BFF;
    }

    .action-link:hover {
        color: #0056b3;
    }
</style>
