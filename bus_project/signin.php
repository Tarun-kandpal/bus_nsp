<?php
session_start();
$conn = new mysqli("localhost", "root", "", "bus_tracking");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            header("Location: home.php");
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User  not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            width: 90%;
            max-width: 400px;
            backdrop-filter: blur(10px);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 1rem;
            transition: background 0.3s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            background: rgba(255, 255, 255, 0.4);
            outline: none;
        }
        input[type="submit"] {
            width: 100%;
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background 0.3s, transform 0.2s;
        }
        input[type="submit"]:hover {
            background: linear-gradient(90deg, #feb47b, #ff7e5f);
            transform: scale(1.05);
        }
        .error {
            color: #ff4d4d;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Sign In</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post" novalidate>
            <input type="text" name="username" placeholder="Username" required pattern="[A-Za-z0-9_]{3,}" title="Minimum 3 characters, letters, numbers or underscores"><br>
            <input type="password" name="password" placeholder="Password" required minlength="6" title="At least 6 characters"><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>