<?php
session_start();

// Auto-login using cookie
if (!isset($_SESSION["student"]) && isset($_COOKIE["student_login"])) {
  $_SESSION["student"] = $_COOKIE["student_login"];
  header("Location: dashboard.php");
  exit;
}

// If already logged in, go to dashboard
if (isset($_SESSION["student"])) {
  header("Location: dashboard.php");
  exit;
}

// Login submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  require_once __DIR__ . "/private/xauth.php";
}

// Background image detection
$bgPathCandidates = [
  'uploads/college_photo.jpg',
  'college_photo.jpg',
  'uploaded_bg.jpg',
  'bg.jpg'
];
$bg = '';
foreach ($bgPathCandidates as $p) {
  if (file_exists(__DIR__ . '/' . $p)) { $bg = $p; break; }
}
$fallbackBg = 'data:image/svg+xml;charset=utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%221200%22 height=%22800%22%3E%3Cdefs%3E%3CradialGradient id=%22g%22 cx=%22.5%22 cy=%22.5%22 r=%22.8%22%3E%3Cstop offset=%220%22 stop-color=%22%23e6eefc%22/%3E%3Cstop offset=%221%22 stop-color=%22%23dfe9f8%22/%3E%3C/radialGradient%3E%3C/defs%3E%3Crect width=%22100%25%22 height=%22100%25%22 fill=%22url(%23g)%22/%3E%3C/svg%3E';
$bgUrl = $bg ? $bg : $fallbackBg;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Student Portal</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- PWA REQUIRED -->
  <link rel="manifest" href="manifest.json">
  <meta name="theme-color" content="#0d6efd">
  <link rel="apple-touch-icon" href="icons/icon-192.png">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto;
    }
    body {
      position: relative;
      min-height: 100%;
      overflow: auto;
      background: linear-gradient(180deg, #e6eefc, #dfe9f8);
    }
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      z-index: -2;
      background-image: url("<?php echo htmlspecialchars($bgUrl, ENT_QUOTES); ?>");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
    body::after {
      content: "";
      position: fixed;
      inset: 0;
      z-index: -1;
      background: rgba(0,0,0,0.35);
    }
    .login-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }
    .login-box {
      width: 100%;
      max-width: 300px;
      padding: 15px 18px;
      border-radius: 10px;
      background: rgba(255,255,255,0.20);
      backdrop-filter: blur(10px);
    }
    .login-box .form-control {
      background: rgba(255,255,255,0.85);
      border: 1px solid rgba(15,20,30,0.08);
    }
    .logo {
      text-align: center;
      margin-bottom: 12px;
    }
    .logo img {
      height: 64px;
      filter: drop-shadow(0 2px 6px rgba(0,0,0,0.25));
    }
    h4 {
      margin-bottom: 18px;
      font-weight: 600;
      color: #07102a;
    }
    .btn-primary {
      background: linear-gradient(180deg,#0d6efd,#0b5ed7);
      border: none;
      box-shadow: 0 6px 18px rgba(11,94,215,0.18);
    }
  </style>
</head>

<body>

<div class="login-wrapper">
  <div class="login-box">
    <div class="logo">
      <img src="https://i.postimg.cc/tJ6d4mf3/logo.png" alt="College Logo">
    </div>

    <h4 class="text-center mb-3">Student Login</h4>

    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST" novalidate>
      <div class="mb-3">
        <label class="form-label">Username:</label>
        <input type="text" class="form-control" name="username" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password:</label>
        <input type="password" class="form-control" name="password" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</div>

<!-- PWA service worker registration -->
<script>
if ("serviceWorker" in navigator) {
  navigator.serviceWorker.register("service-worker.js")
  .then(() => console.log("Service Worker Registered"))
  .catch(err => console.log("SW registration failed:", err));
}
</script>

</body>
</html>
