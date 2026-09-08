<?php
$message = "";
$alertType = "";

$conn = new mysqli("localhost", "root", "", "wis_lab");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    department VARCHAR(80) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    $message = "Table 'students' created successfully.";
    $alertType = "success";
} else {
    $message = "Error creating table: " . $conn->error;
    $alertType = "danger";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Create Students Table</h2>
    <div class="alert alert-<?php echo $alertType; ?>"><?php echo $message; ?></div>
    <a href="insert_student.php" class="btn btn-primary">Go to Insert Student Form</a>
</div>
</body>
</html>
