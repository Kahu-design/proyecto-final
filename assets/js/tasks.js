document.addEventListener('DOMContentLoaded', loadTasks);

let editingTaskId = null;

function showMessage(text, type = 'error') {
    const messageDiv = document.getElementById('message');
    messageDiv.textContent = text;
    messageDiv.className = 'message ' + type;
}

function loadTasks() {
    fetch('../api/tasks/list.php', {
        credentials: 'same-origin'
    })
    .then(res => res.json())
    .then(data => {
        if (data.status !== 'success') {
            window.location = 'login.php';
            return;
        }

        taskList.innerHTML = '';
        data.data.forEach(task => {
            taskList.innerHTML += `
                <div class="task">
                    <strong>${task.title}</strong>
                    <p>${task.description ?? ''}</p>
                    <div class="task-actions">
                        <button onclick="editTask(${task.id}, '${escapeHtml(task.title)}', '${escapeHtml(task.description ?? '')}')">
                            Editar
                        </button>
                        <button class="btn-danger" onclick="deleteTask(${task.id})">
                            Eliminar
                        </button>
                    </div>
                </div>
            `;
        });
    })
    .catch(() => {
        showMessage('Error al cargar las tareas');
    });
}

function createTask() {
    const titleValue = title.value.trim();
    const descriptionValue = description.value.trim();

    if (!titleValue) {
        showMessage('El título es obligatorio');
        return;
    }

    fetch('../api/tasks/create.php', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            title: titleValue,
            description: descriptionValue
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            showMessage('Tarea creada correctamente', 'success');
            title.value = '';
            description.value = '';
            loadTasks();
        } else {
            showMessage(data.message);
        }
    })
    .catch(() => {
        showMessage('Error al crear la tarea');
    });
}

function editTask(id, taskTitle, taskDescription) {
    editingTaskId = id;
    title.value = taskTitle;
    description.value = taskDescription;
}

function updateTask() {
    if (!editingTaskId) {
        showMessage('No hay ninguna tarea seleccionada');
        return;
    }

    fetch('../api/tasks/update.php', {
        method: 'PUT',
        credentials: 'same-origin',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            id: editingTaskId,
            title: title.value.trim(),
            description: description.value.trim()
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            showMessage('Tarea actualizada correctamente', 'success');
            editingTaskId = null;
            title.value = '';
            description.value = '';
            loadTasks();
        } else {
            showMessage(data.message);
        }
    })
    .catch(() => {
        showMessage('Error al actualizar la tarea');
    });
}

function deleteTask(id) {
    fetch('../api/tasks/delete.php', {
        method: 'DELETE',
        credentials: 'same-origin',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ id })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            showMessage('Tarea eliminada', 'success');
            loadTasks();
        } else {
            showMessage(data.message);
        }
    })
    .catch(() => {
        showMessage('Error al eliminar la tarea');
    });
}

/* Seguridad básica contra comillas */
function escapeHtml(text) {
    return text.replace(/'/g, "\\'");
}
