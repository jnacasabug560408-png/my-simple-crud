<?php
require_once 'components/pdo.php';

// Get user ID from URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Fetch user data
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        header("Location: index.php?error=notfound");
        exit;
    }
} catch (PDOException $e) {
    header("Location: index.php?error=database");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    
    try {
        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?");
        $stmt->execute([$name, $email, $phone, $id]);
        
        header("Location: index.php?message=updated");
        exit;
    } catch (PDOException $e) {
        $error = "Error updating user: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            padding: 40px;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-success {
            background: #48bb78;
            color: white;
            width: 100%;
        }

        .btn-success:hover {
            background: #38a169;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(72, 187, 120, 0.4);
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #4a5568;
            margin-top: 10px;
            width: 100%;
            text-align: center;
        }

        .btn-secondary:hover {
            background: #cbd5e0;
        }

        .error {
            background: #fed7d7;
            color: #742a2a;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #fc8181;
        }

        .user-id {
            background: #edf2f7;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            color: #4a5568;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Update User</h1>

        <div class="user-id">Editing User ID: <?php echo htmlspecialchars($user['id']); ?></div>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Full Name *</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required placeholder="Enter full name">
            </div>

            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required placeholder="Enter email address">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required placeholder="Enter phone number">
            </div>

            <button type="submit" class="btn btn-success">Update User</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>