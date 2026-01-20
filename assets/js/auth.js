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
            alert('Registro exitoso');
            window.location = 'login.php';
        } else {
            alert(data.message);
        }
    })
    .catch(() => {
        alert('Error de conexión');
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
            window.location = 'dashboard.php';
        } else {
            alert(data.message);
        }
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

