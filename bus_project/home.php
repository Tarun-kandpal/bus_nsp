<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Home</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

  body, html {
    height: 100%;
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color: white;
  }

  .logout-btn {
    position: fixed;
    top: 20px;
    right: 20px;
    background: linear-gradient(90deg, #ff7e5f, #feb47b);
    border: none;
    color: white;
    padding: 12px 20px;
    font-weight: 600;
    font-size: 1rem;
    border-radius: 30px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(255,126,95,0.7);
    transition: background 0.3s ease, transform 0.2s ease;
    text-decoration: none;
    user-select: none;
  }
  .logout-btn:hover, .logout-btn:focus {
    background: linear-gradient(90deg, #feb47b, #ff7e5f);
    outline: none;
    transform: scale(1.05);
  }

  .container {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 0 20px;
  }

  .welcome-box {
    background: rgba(0, 0, 0, 0.35);
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    max-width: 400px;
    width: 100%;
  }

  h1 {
    font-size: 2.8rem;
    margin-bottom: 15px;
    font-weight: 700;
  }

  p {
    font-size: 1.3rem;
    font-weight: 400;
    color: #d3dff3;
  }

  @media (max-width: 420px) {
    .welcome-box {
      padding: 30px 20px;
    }
    h1 {
      font-size: 2.2rem;
    }
    p {
      font-size: 1rem;
    }
    .logout-btn {
      padding: 10px 16px;
      font-size: 0.95rem;
    }
  }
</style>
</head>
<body>
  <a href="logout.php" class="logout-btn" aria-label="Logout">Logout</a>
  <div class="container">
    <div class="welcome-box" role="main" aria-live="polite">
      <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
      <p>You have successfully signed in.</p>
    </div>
  </div>
</body>
</html>