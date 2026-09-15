<?php
require_once "db.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"]);
    $father_name = trim($_POST["father_name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $program = trim($_POST["program"]);

    if ($full_name === "" || $father_name === "" || $email === "" || $phone === "" || $program === "") {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO applications (full_name, father_name, email, phone, program) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $full_name, $father_name, $email, $phone, $program);
        $stmt->execute();
        $stmt->close();

        header("Location: admission.php");
        exit();
    }
}

$result = $conn->query("SELECT * FROM applications ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Admission Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Student Admission Application</h2>

    <?php if (!empty($errors)) { ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>

    <form method="post" class="border p-4 rounded bg-light">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="father_name" class="form-label">Father's Name</label>
            <input type="text" name="father_name" id="father_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="program" class="form-label">Program</label>
            <select name="program" id="program" class="form-select" required>
                <option value="">Select a program</option>
                <option value="Information Systems">Information Systems</option>
                <option value="Software Engineering">Software Engineering</option>
                <option value="Computer Science">Computer Science</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>

    <h3 class="mt-5">Submitted Applications</h3>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Father's Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Program</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["id"]); ?></td>
                    <td><?php echo htmlspecialchars($row["full_name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["father_name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                    <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                    <td><?php echo htmlspecialchars($row["program"]); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
