document.addEventListener('DOMContentLoaded', loadTasks);

function addTask() {
    const task = document.getElementById('taskInput').value.trim();
    if (!task) return;

    fetch('task_action.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'add', task: task })
    }).then(res => res.json()).then(data => {
        if (data.success) loadTasks();
        else alert(data.message);
    });

    document.getElementById('taskInput').value = '';
}

function loadTasks(showAll = false) {
    fetch('task_action.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'load', showAll: showAll })
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('taskList').innerHTML = html;
    });
}

function showAll() {
    loadTasks(true);
}

function completeTask(id) {
    fetch('task_action.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'complete', id: id })
    }).then(() => loadTasks());
}

function deleteTask(id) {
    if (!confirm("Are you sure to delete this task?")) return;
    fetch('task_action.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'delete', id: id })
    }).then(() => loadTasks());
}
