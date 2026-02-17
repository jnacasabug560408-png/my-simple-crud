<?php
include 'pdo.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["firstname"]) && !empty($_POST["lastname"])) {
        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname) VALUES (?, ?)");
        $stmt->execute([trim($_POST["firstname"]), trim($_POST["lastname"])]);
        header("Location: view.php?success=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm border-0 mx-auto" style="max-width: 500px;">
            <div class="card-body p-4">
                <h1 class="h4 mb-4">Add New User</h1>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstname" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastname" class="form-control" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Save User</button>
                        <a href="view.php" class="btn btn-light">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
