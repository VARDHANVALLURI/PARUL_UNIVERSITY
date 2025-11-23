<?php
session_start();
if (!isset($_SESSION['student'])) {
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- PREMIUM FONT (INTER) -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

/* GLOBAL */
body {
  margin: 0;
  background: #f1f3f6;
  font-family: 'Inter', sans-serif;
  color: #1a1a1a;
  overflow-x: hidden;
}

/* DASHBOARD BACKGROUND IMAGE */
.content {
  background-image: url('college_photo.jpg'); /* <- Put your college photo file name here */
  background-size: cover;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  backdrop-filter: blur(0px);
}

/* Transparent overlay for readability */
.content::before {
  content: "";
  position: fixed;
  inset: 0;
  background: rgba(255,255,255,0.75);
  z-index: -1;
}

/* ANIMATIONS */
@keyframes fade {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.page { animation: fade 0.4s ease-out; }

/* LAYOUT */
.layout {
  display: flex;
  height: 100vh;
  overflow: hidden;
}

/* SIDEBAR */
.sidebar {
  width: 250px;
  background: white;
  border-right: 1px solid #e1e3e7;
  padding-top: 25px;
  padding-bottom: 25px;
  flex-shrink: 0;
  overflow-y: auto;
  z-index: 500;
}
.sidebar .logo {
  font-size: 22px;
  font-weight: 700;
  padding: 0 25px;
  margin-bottom: 30px;
}

/* MOBILE CLOSE BUTTON INSIDE SIDEBAR */
.sidebar .close-sidebar {
  display: none;
  font-size: 26px;
  padding: 10px 25px;
  cursor: pointer;
}

.sidebar a {
  display: block;
  padding: 12px 28px;
  font-size: 15px;
  text-decoration: none;
  color: #3c3c3c;
  border-left: 4px solid transparent;
  transition: 0.25s;
  font-weight: 500;
}
.sidebar a:hover,
.sidebar a.active {
  background: #eef1f5;
  border-left: 4px solid #0d6efd;
}

/* MOBILE SIDEBAR BEHAVIOR */
.toggle-btn {
  display: none;
  font-size: 24px;
  cursor: pointer;
  margin-bottom: 16px;
}

@media(max-width:768px){
  .sidebar {
    position: fixed;
    left: -250px;
    top: 0;
    bottom: 0;
    height: 100%;
    transition: 0.3s ease;
  }
  .sidebar.open {
    left: 0;
  }
  .close-sidebar {
    display: block;
  }
  .toggle-btn {
    display: inline-block;
  }

  .layout {
    display: block;
  }

  .content {
    padding: 18px !important;
  }
}

/* CONTENT */
.content {
  flex: 1;
  padding: 28px;
  overflow-y: auto;
  position: relative;
  z-index: 1;
}

/* TOPBAR */
.topbar {
  background: rgba(255,255,255,0.85);
  backdrop-filter: blur(4px);
  padding: 16px 22px;
  border-radius: 12px;
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 24px;
  box-shadow: 0 2px 14px rgba(0,0,0,0.08);
}

/* CARDS */
.card-box {
  background: rgba(255,255,255,0.89);
  backdrop-filter: blur(6px);
  border-radius: 14px;
  padding: 22px;
  margin-bottom: 24px;
  box-shadow: 0 3px 12px rgba(0,0,0,0.1);
}

/* PROFILE */
.profile-pic img {
  width: 150px;
  border-radius: 14px;
  border: 3px solid #d0d0d0;
}

.table-container {
  background: rgba(255,255,255,0.9);
  padding: 20px;
  border-radius: 14px;
  box-shadow: 0 3px 12px rgba(0,0,0,0.1);
  margin-bottom: 24px;
}

.table-container th { background: #f4f6f8; font-weight: 600; }

.section-title {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 16px;
}

</style>
</head>

<body>

<div class="layout">

  <!-- SIDEBAR -->
  <div class="sidebar" id="sidebar">

    <!-- Close button for mobile -->
    <div class="close-sidebar" onclick="toggleSidebar()">
      <i class="bi bi-x-lg"></i>
    </div>

    <div class="logo">Student Portal</div>

    <a id="l-home" class="active" onclick="openPage('home')">Dashboard Home</a>
    <a id="l-student" onclick="openPage('student')">Student Info</a>
    <a id="l-hostel" onclick="openPage('hostel')">Hostel</a>
    <a id="l-attendance" onclick="openPage('attendance')">Attendance</a>
    <a id="l-results" onclick="openPage('results')">Results</a>
    <a id="l-fees" onclick="openPage('fees')">Fees</a>

  </div>

  <!-- CONTENT -->
  <div class="content">

    <div class="toggle-btn" onclick="toggleSidebar()">
      <i class="bi bi-list"></i>
    </div>

    <div class="topbar">Welcome, VALLURI SRI KRISHNA VARDAN</div>


    <!-- HOME -->
    <div id="home" class="page">
      <div class="row g-3">
        <div class="col-md-4 col-12">
          <div class="card-box">
            <h5 class="fw-bold">Your Profile</h5>
            <div class="text-muted">View personal details</div>
          </div>
        </div>

        <div class="col-md-4 col-12">
          <div class="card-box">
            <h5 class="fw-bold">Attendance</h5>
            <div class="text-muted">Check performance</div>
          </div>
        </div>

        <div class="col-md-4 col-12">
          <div class="card-box">
            <h5 class="fw-bold">Hostel Details</h5>
            <div class="text-muted">Your accommodation</div>
          </div>
        </div>
      </div>
    </div>


    <!-- STUDENT INFO -->
    <div id="student" class="page" style="display:none;">

      <div class="card-box">

        <div class="profile-pic text-center mb-3">
          <img src="profile.jpg">
          <h5 class="fw-bold mt-3 mb-1">VALLURI SRI KRISHNA VARDAN</h5>
          <div class="text-muted">Roll No: 2403031260215 | CSE (3CYBER3)</div>
        </div>

        <p><strong>Date of Birth:</strong> 28-11-2006</p>
        <p><strong>Student Phone:</strong> 6281048554</p>
        <p><strong>Father:</strong> VALLURI VENKATA KRISHNANANDA CHOWDARY | 9951996671</p>
        <p><strong>Mother:</strong> VALLURI VISALAKSHI | 6301244329</p>
        <p><strong>College Email:</strong> 2403031260215@paruluniversity.ac.in</p>
        <p><strong>Personal Email:</strong> krishnavardhan124@gmail.com</p>

      </div>

    </div>


    <!-- HOSTEL -->
    <div id="hostel" class="page" style="display:none;">

      <div class="card-box">
        <div class="section-title">Hostel Details</div>

        <p><strong>Reg No:</strong> 42043</p>
        <p><strong>Block:</strong> TAGORE BHAWAN - C</p>
        <p><strong>Room:</strong> Floor 3 | Room C-361 | Bed 3</p>
        <p><strong>Duration:</strong> 01-07-2025 → 30-06-2026</p>
        <p><strong>City:</strong> East Godavari</p>
        <p><strong>Address:</strong> House No-1-18 Main Road, Nelaparthipadu</p>
      </div>

    </div>


    <!-- ATTENDANCE -->
    <div id="attendance" class="page" style="display:none;">

      <div class="table-container">
        <div class="section-title">Attendance Overview</div>

        <div class="table-responsive">
          <table class="table table-bordered text-center">
            <thead><tr><th>Sr</th><th>Subject</th><th>Slot</th><th>Conducted</th><th>Present</th><th>Absent</th><th>%</th></tr></thead>
            <tbody>
              <tr><td>1</td><td>DDS</td><td>Theory</td><td>28</td><td>26</td><td>2</td><td>98%</td></tr>
            </tbody>
          </table>
        </div>

      </div>

    </div>


    <!-- RESULTS -->
    <div id="results" class="page" style="display:none;">

      <div class="card-box text-center">
        <div class="section-title">2nd SEM Result</div>
        <img src="SEMRESULTSPHOTO.jpg" class="img-fluid rounded mb-3">
        <button class="btn btn-primary px-4">Download PDF</button>
      </div>

    </div>


    <!-- FEES -->
    <div id="fees" class="page" style="display:none;">

      <div class="card-box">
        <div class="section-title">Fee Status</div>
        All tuition, hostel, and miscellaneous fees have been cleared for the academic year.
      </div>

    </div>


  </div>
</div>

<script>

function toggleSidebar() {
  document.getElementById("sidebar").classList.toggle("open");
}

function openPage(page){
  let pages = ["home","student","hostel","attendance","results","fees"];

  pages.forEach(p=>{
    document.getElementById(p).style.display="none";
    document.getElementById("l-"+p).classList.remove("active");
  });

  document.getElementById(page).style.display="block";
  document.getElementById("l-"+page).classList.add("active");
}

</script>

</body>
</html>
