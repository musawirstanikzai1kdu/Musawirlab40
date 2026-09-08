<?php
$message = "";
$alertType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $department = trim($_POST["department"]);

    $conn = new mysqli("localhost", "root", "", "wis_lab");

    if ($conn->connect_error) {
        $message = "Connection failed: " . $conn->connect_error;
        $alertType = "danger";
    } elseif ($fullName == "" || $email == "" || $department == "") {
        $message = "All fields are required.";
        $alertType = "danger";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
        $alertType = "danger";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (full_name, email, department) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullName, $email, $department);

        if ($stmt->execute()) {
            $message = "Student added successfully.";
            $alertType = "success";
            $fullName = "";
            $email = "";
            $department = "";
        } else {
            $message = "Error inserting student: " . $stmt->error;
            $alertType = "danger";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Add Student</h2>

    <?php if ($message != ""): ?>
        <div class="alert alert-<?php echo $alertType; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="<?php echo isset($fullName) ? htmlspecialchars($fullName) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Department</label>
            <input type="text" name="department" class="form-control" value="<?php echo isset($department) ? htmlspecialchars($department) : ''; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Student</button>
        <button type="reset" class="btn btn-secondary">Clear</button>
    </form>
</div>
</body>
</html>
