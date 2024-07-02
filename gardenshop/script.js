
function openLogin() {
    document.getElementById("login-popup").style.display = "block";
}

function openRegister() {
    document.getElementById("register-popup").style.display = "block";
}

document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault(); 
    var formData = new FormData(this);

    fetch('login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'success') {
            alert('Login successful!');
            closeLogin();
            
        } else {
            alert('Invalid username or password');
        }
    })
    .catch(error => console.error('Error:', error));
});

document.getElementById("register-form").addEventListener("submit", function(event) {
    event.preventDefault(); 
    var formData = new FormData(this);

    fetch('register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'success') {
            alert('Registration successful!');
            closeRegister();
          
        } else {
            alert(data); 
        }
    })
    .catch(error => console.error('Error:', error));
});
