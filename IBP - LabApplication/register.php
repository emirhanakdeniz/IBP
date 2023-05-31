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

// Define validation and sanitization functions (to be used later)
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and validate form data
    $full_name = validate_input($_POST["full_name"]);
    $email = validate_input($_POST["email"]);
    $gender = validate_input($_POST["gender"]);

    // Insert data into the "students" table
    $sql = "INSERT INTO students (full_name, email, gender) VALUES ('$full_name', '$email', '$gender')";

    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful!";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Result</title>
</head>
<body>
<?php if(isset($message)) { ?>
    <h1><?php echo $message; ?></h1>
<?php } ?>
<?php if(isset($error)) { ?>
    <h1><?php echo $error; ?></h1>
<?php } ?>
</body>
</html>
