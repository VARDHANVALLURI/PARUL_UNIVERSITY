<?php
session_start();

// ✅ Auto-login using cookie
if (!isset($_SESSION["student"]) && isset($_COOKIE["student_login"])) {
  $_SESSION["student"] = $_COOKIE["student_login"];
  header("Location: dashboard.php");
  exit;
}

// ✅ If already logged in via session, go to dashboard
if (isset($_SESSION["student"])) {
  header("Location: dashboard.php");
  exit;
}

// ✅ If form is submitted, handle login via xauth.php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  require_once __DIR__ . "/private/xauth.php"; // Handles login + session + cookie
}

// Find a background image (first existing candidate). Change or add filenames here if needed.
$bgPathCandidates = [
  'uploads/college_photo.jpg',
  'college_photo.jpg',
  'uploaded_bg.jpg',
  'bg.jpg'
];
$bg = '';
foreach ($bgPathCandidates as $p) {
  if (file_exists(__DIR__ . '/' . $p)) {
    $bg = $p;
    break;
  }
}
// Fallback image (data URL or remote). You can replace this with any default you like.
$fallbackBg = 'data:image/svg+xml;charset=utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%221200%22 height=%22800%22%3E%3Cdefs%3E%3CradialGradient id=%22g%22 cx=%22.5%22 cy=%22.5%22 r=%22.8%22%3E%3Cstop offset=%220%22 stop-color=%22%23e6eefc%22/%3E%3Cstop offset=%221%22 stop-color=%22%23dfe9f8%22/%3E%3C/radialGradient%3E%3C/defs%3E%3Crect width=%22100%25%22 height=%22100%25%22 fill=%22url(%23g)%22/%3E%3C/svg%3E';
$bgUrl = $bg ? $bg : $fallbackBg;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Student Portal</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Full-page background using :before so the layout remains unchanged */
    html, body {
      height: 100%;
      margin: 0;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    body {
      position: relative;
      min-height: 100%;
      overflow: auto;
      /* fallback color while image loads */
      background: linear-gradient(180deg, #e6eefc, #dfe9f8);
    }
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      z-index: -2;
      background-image: url("<?php echo htmlspecialchars($bgUrl, ENT_QUOTES); ?>");
      background-size: cover;
      background-position: center center;
      background-repeat: no-repeat;
      transform: translateZ(0);
      /* subtle parallax-like effect when scrolling */
      will-change: transform;
    }
    /* dim + color overlay for consistent readability */
    body::after {
      content: "";
      position: fixed;
      inset: 0;
      z-index: -1;
      background: rgba(0,0,0,0.35); /* adjust darkness here (0 = no dim, 0.5 = darker) */
      backdrop-filter: none;
    }

    /* Center the login box vertically and horizontally */
    .login-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }

    /* Glassmorphism / transparent login box */
    .login-box {
      width: 100%;
      max-width: 420px;
      padding: 28px;
      border-radius: 12px;
      background: rgba(255,255,255,0.18); /* translucent white */
      box-shadow: 0 8px 30px rgba(0,0,0,0.25);
      border: 1px solid rgba(255,255,255,0.25);
      backdrop-filter: blur(8px) saturate(120%);
      -webkit-backdrop-filter: blur(8px) saturate(120%);
      color: #0b1220;
    }

    /* Slight stronger panel for inputs to increase contrast */
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
      object-fit: contain;
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

    /* small screens adjustments */
    @media (max-width: 480px) {
      .login-box {
        padding: 18px;
        border-radius: 10px;
      }
      .logo img { height: 48px; }
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
        <label for="username" class="form-label">Username:</label>
        <input id="username" type="text" class="form-control" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input id="password" type="password" class="form-control" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</div>

</body>
</html>
