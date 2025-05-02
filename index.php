<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TO Do List </title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>📝 To-Do List</h2>
        <div class="input-group">
            <input type="text" id="taskInput" placeholder="Add your task...">
            <button onclick="addTask()">➕ Add Task</button>
            <button class="show-all" onclick="showAll()">📋 Show All</button>
        </div>
        <ul id="taskList"></ul>
        <footer>
    Made with ❤️ by <strong>Abhishek Singh</strong><br>
    <a href="https://www.linkedin.com/in/abhishek-singh-531889240/" target="_blank">LinkedIn</a> |
    <a href="https://github.com/Abhisheksingh0303" target="_blank">GitHub</a>
</footer>
    </div>
    <script src="script.js"></script>
</body>
</html>
