<?php
$message = "";
$alertType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $databaseName = trim($_POST["database_name"]);

    $conn = new mysqli("localhost", "root", "");

    if ($conn->connect_error) {
        $message = "Connection failed: " . $conn->connect_error;
        $alertType = "danger";
    } elseif (!preg_match("/^[A-Za-z0-9_]+$/", $databaseName)) {
        $message = "Invalid database name. Only letters, numbers, and underscores are allowed.";
        $alertType = "danger";
    } else {
        $sql = "CREATE DATABASE " . $databaseName;

        if ($conn->query($sql) === TRUE) {
            $message = "Database '" . $databaseName . "' created successfully.";
            $alertType = "success";
        } else {
            $message = "Error creating database: " . $conn->error;
            $alertType = "danger";
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Create Database</h2>

    <?php if ($message != ""): ?>
        <div class="alert alert-<?php echo $alertType; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Database Name</label>
            <input type="text" name="database_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Database</button>
    </form>
</div>
</body>
</html>
