<?php
include 'pdo.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: view.php"); exit; }

// Fetch existing data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE users SET firstname = ?, lastname = ? WHERE id = ?");
    $stmt->execute([trim($_POST["firstname"]), trim($_POST["lastname"]), $id]);
    header("Location: view.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm mx-auto border-0" style="max-width: 450px;">
            <div class="card-header bg-warning text-dark fw-bold">Update User Details</div>
            <div class="card-body p-4">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label small text-uppercase fw-bold text-muted">First Name</label>
                        <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-uppercase fw-bold text-muted">Last Name</label>
                        <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-dark">Save Changes</button>
                        <a href="view.php" class="btn btn-link text-decoration-none text-muted">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
