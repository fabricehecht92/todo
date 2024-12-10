<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ?");
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Your Tasks</h1>
        <form action="tasks.php" method="POST">
            <input type="text" name="title" placeholder="Task Title" required>
            <textarea name="description" placeholder="Task Description"></textarea>
            <input type="date" name="due_date">
            <button type="submit" name="add_task">Add Task</button>
        </form>

        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <strong><?= htmlspecialchars($task['title']) ?></strong>
                    <p><?= htmlspecialchars($task['description']) ?></p>
                    <small>Due: <?= htmlspecialchars($task['due_date']) ?></small>
                    <form action="tasks.php" method="POST">
                        <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                        <select name="status" onchange="this.form.submit()">
                            <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                        </select>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
