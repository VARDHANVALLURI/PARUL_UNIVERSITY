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
// Fallback image (data URL). You can replace this with any default you like.
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
    /* Basic reset & typography */
    html, body {
      height: 100%;
      margin: 0;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      background: linear-gradient(180deg, #e6eefc, #dfe9f8);
      color: #07102a;
    }

    /* Background image layer */
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
      will-change: transform;
      filter: saturate(1) contrast(0.98);
    }

    /* Dim overlay for readability */
    body::after {
      content: "";
      position: fixed;
      inset: 0;
      z-index: -1;
      background: rgba(0,0,0,0.34); /* adjust darkness if needed */
    }

    /* Wrapper centers the box */
    .login-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 14px;
    }

    /* Compact / small glass login box */
    .login-box {
      width: 100%;
      max-width: 300px;        /* compact width */
      padding: 14px 16px;
      border-radius: 10px;
      background: rgba(255,255,255,0.20);
      box-shadow: 0 8px 20px rgba(0,0,0,0.22);
      border: 1px solid rgba(255,255,255,0.20);
      backdrop-filter: blur(10px) saturate(120%);
      -webkit-backdrop-filter: blur(10px) saturate(120%);
      color: #07102a;
    }

    .logo {
      text-align: center;
      margin-bottom: 8px;
    }
    .logo img {
      height: 48px;
      object-fit: contain;
      filter: drop-shadow(0 2px 6px rgba(0,0,0,0.20));
    }

    h4 {
      margin: 6px 0 10px;
      font-weight: 600;
      font-size: 18px;
      text-align: center;
      color: #07102a;
    }

    /* Inputs / controls */
    .login-box .form-control {
      background: rgba(255,255,255,0.94);
      border: 1px solid rgba(15,20,30,0.07);
      height: 46px;
      font-size: 16px; /* 16px avoids iOS zoom */
      padding: 10px 12px;
      border-radius: 8px;
    }
    .form-label {
      font-size: 13px;
      margin-bottom: 6px;
      color: rgba(7,16,42,0.9);
    }

    .btn-primary {
      height: 46px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 8px;
      background: linear-gradient(180deg,#0d6efd,#0b5ed7);
      border: none;
      box-shadow: 0 6px 14px rgba(11,94,215,0.14);
    }

    .alert {
      font-size: 14px;
      padding: 8px 10px;
      margin-bottom: 10px;
    }

    /* Responsive tweaks */
    @media (max-width: 480px) {
      .login-box { max-width: 280px; padding: 12px 14px; border-radius: 10px; }
      .logo img { height: 44px; }
      h4 { font-size: 17px; }
      .login-box .form-control { height: 44px; font-size: 16px; }
      .btn-primary { height: 44px; font-size: 15px; }
    }

    /* Ensure clickable targets are large enough on mobile */
    @media (pointer: coarse) {
      .login-box .form-control, .btn-primary { min-height: 44px; }
    }

    /* Prevent zoom on focus for iOS (font-size:16 above) */
    input, button, select, textarea { font-size: 16px; }
  </style>
</head>
<body>

<div class="login-wrapper">
  <div class="login-box" role="main" aria-labelledby="loginTitle">
    <div class="logo" aria-hidden="true">
      <img src="https://i.postimg.cc/tJ6d4mf3/logo.png" alt="College Logo">
    </div>

    <h4 id="loginTitle">Student Login</h4>

    <?php if (isset($error)) : ?>
      <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></div>
    <?php endif; ?>

    <form method="POST" novalidate>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input id="username" type="text" class="form-control" name="username" required autocomplete="username" inputmode="text" />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" />
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</div>

</body>
</html>
