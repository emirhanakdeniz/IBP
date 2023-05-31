<?php
// Connection configuration
$host = "localhost";  // Modify this if your MySQL server is running on a different host
$user = "root";       // Modify this with your MySQL username
$password = "";       // Modify this with your MySQL password
$database = "mydatabase";  // Modify this with the name of your MySQL database

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve registered students from the "students" table
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Students</title>
</head>
<body>
<h1>Registered Students</h1>
<?php if ($result->num_rows > 0) { ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Gender</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["full_name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["gender"]; ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>No students registered yet.</p>
<?php } ?>
</body>
</html>
