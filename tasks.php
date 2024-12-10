<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_task'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];

        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $title, $description, $due_date]);
        header("Location: dashboard.php");
    } elseif (isset($_POST['update_status'])) {
        $task_id = $_POST['task_id'];
        $status = $_POST['status'];

        $stmt = $pdo->prepare("UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$status, $task_id, $user_id]);
        header("Location: dashboard.php");
    }
}
?>
