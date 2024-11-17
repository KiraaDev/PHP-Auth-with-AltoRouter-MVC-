<?php
if (isset($_SESSION['loggedin']) || isset($_SESSION['loggedin']) === true) {
    header('Location: /reusable_Codes_PHP/AUTH%20MVC/dashboard');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/register.css" />
    <title>Document</title>
</head>

<body>
    <div class="main">
        <form id="registerForm" class="form" method="POST">
            <p class="title">Register </p>
            <p class="message">Signup now and get full access to our app. </p>

            <!-- Error message -->
            <?php if (!empty($error)): ?>
                <div class="error" style="color: red;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <div id="error" class="error" style="color: red;"></div>

            <label>
                <input id="username" required placeholder="" type="text" class="input" name="username">
                <span>Username</span>
            </label>

            <label>
                <input id="email" required placeholder="" type="email" class="input" name="email">
                <span>Email</span>
            </label>

            <label>
                <input id="password" required placeholder="" type="password" class="input" name="password">
                <span>Password</span>
            </label>

            <button id="registerBtn" class="submit" type="submit">Submit</button>
            <p class="signin">Already have an acount ? <a href="/reusable_Codes_PHP/AUTH%20MVC/login">Login</a> </p>
        </form>
    </div>

    <script>
        const registerForm = document.getElementById('registerForm');

        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const error = document.getElementById('error');

            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (username === "" || email === "" || password === ""){
                return error.innerText = "All fields are required."
            }

            registerForm.submit();

        })
    </script>

</body>

</html>