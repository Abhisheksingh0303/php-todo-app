<?php
include 'db.php';

$action = $_POST['action'] ?? '';

if ($action == 'add') {
    $task = trim($_POST['task']);
    if ($task == '') {
        echo json_encode(['success' => false, 'message' => 'Task cannot be empty']);
        exit;
    }


    $stmt = $conn->prepare("SELECT id FROM tasks WHERE task = ?");
    $stmt->bind_param("s", $task);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Duplicate task']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO tasks (task) VALUES (?)");
    $stmt->bind_param("s", $task);
    $stmt->execute();
    echo json_encode(['success' => true]);
}

elseif ($action == 'load') {
    $showAll = isset($_POST['showAll']);
    $sql = $showAll ? "SELECT * FROM tasks" : "SELECT * FROM tasks WHERE is_completed = 0";
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
        echo "<li>
                <input type='checkbox' onchange='completeTask({$row['id']})' " . ($row['is_completed'] ? 'checked' : '') . ">
                <span style='text-decoration:" . ($row['is_completed'] ? 'line-through' : 'none') . "'>{$row['task']}</span>
                <button onclick='deleteTask({$row['id']})'>Delete</button>
              </li>";
    }
}

elseif ($action == 'complete') {
    $id = (int)$_POST['id'];
    $conn->query("UPDATE tasks SET is_completed = 1 WHERE id = $id");
}

elseif ($action == 'delete') {
    $id = (int)$_POST['id'];
    $conn->query("DELETE FROM tasks WHERE id = $id");
}
?>
