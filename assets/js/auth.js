function showMessage(text, type = 'error') {
    const messageDiv = document.getElementById('message');
    messageDiv.textContent = text;
    messageDiv.className = 'message ' + type;
}

function register() {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    fetch('../api/auth/register.php', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: nameInput.value.trim(),
            email: emailInput.value.trim(),
            password: passwordInput.value.trim()
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            showMessage('Registro exitoso. Redirigiendo...', 'success');
            setTimeout(() => {
                window.location = 'login.php';
            }, 1500);
        } else {
            showMessage(data.message);
        }
    })
    .catch(() => {
        showMessage('Error de conexión');
    });
}

function login() {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    fetch('../api/auth/login.php', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            email: emailInput.value.trim(),
            password: passwordInput.value.trim()
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            showMessage('Login correcto. Redirigiendo...', 'success');
            setTimeout(() => {
                window.location = 'dashboard.php';
            }, 1000);
        } else {
            showMessage(data.message);
        }
    })
    .catch(() => {
        showMessage('Error de conexión');
    });
}

function logout() {
    fetch('../api/auth/logout.php', {
        method: 'POST',
        credentials: 'same-origin'
    })
    .then(() => {
        window.location.href = 'login.php';
    });
}
