<?php
include "components/pdo.php";

$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>View Users</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h4 mb-0">Users</h1>
      <a href="add.php" class="btn btn-primary">Add User</a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <?php if (count($users) > 0): ?>
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users as $user): ?>
                  <tr>
                    <td><?php echo htmlspecialchars((string) $user["id"], ENT_QUOTES, "UTF-8"); ?></td>
                    <td><?php echo htmlspecialchars($user["firstname"], ENT_QUOTES, "UTF-8"); ?></td>
                    <td><?php echo htmlspecialchars($user["lastname"], ENT_QUOTES, "UTF-8"); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php else: ?>
          <p class="text-muted mb-0">No users found. Add your first user.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>