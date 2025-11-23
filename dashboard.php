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
<title>World-Class Student Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

/* GLOBAL */
body {
  margin: 0;
  padding: 0;
  background: #eef1f5;
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
  overflow-x: hidden;
  color: #1a1a1a;
}

/* ANIMATIONS */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeSlide {
  from { opacity:0; transform: translateX(-40px); }
  to { opacity:1; transform: translateX(0); }
}
@keyframes cardFloat {
  from { opacity:0; transform: translateY(20px); }
  to { opacity:1; transform: translateY(0); }
}

/* LAYOUT */
.wrapper {
  display: flex;
  min-height: 100vh;
}

/* SIDEBAR */
.sidebar {
  width: 260px;
  background: rgba(13,110,253,0.95);
  backdrop-filter: blur(12px);
  color: white;
  padding-top: 25px;
  box-shadow: 4px 0 18px rgba(0,0,0,0.15);
  animation: fadeSlide 0.6s ease-out;
  position: relative;
  z-index: 20;
}
.sidebar h3 {
  font-size: 22px;
  font-weight: 700;
  padding-left: 20px;
  margin-bottom: 25px;
}
.sidebar a {
  display: block;
  padding: 14px 26px;
  margin-bottom: 4px;
  font-size: 15px;
  color: white;
  text-decoration: none;
  border-left: 4px solid transparent;
  transition: 0.25s;
  font-weight: 500;
}
.sidebar a:hover,
.sidebar a.active {
  background: rgba(255,255,255,0.18);
  border-left: 4px solid white;
  padding-left: 32px;
}

/* CONTENT AREA */
.content {
  flex: 1;
  padding: 30px;
}

/* TOPBAR */
.topbar {
  background: white;
  padding: 16px 22px;
  font-size: 20px;
  font-weight: 600;
  border-radius: 12px;
  margin-bottom: 24px;
  box-shadow: 0 2px 14px rgba(0,0,0,0.07);
  animation: fadeUp 0.6s ease-out;
}

/* CARDS */
.card-box {
  background: white;
  padding: 22px;
  border-radius: 14px;
  margin-bottom: 28px;
  box-shadow: 0 3px 14px rgba(0,0,0,0.08);
  animation: cardFloat 0.6s ease-out;
}

/* PROFILE PHOTO */
.profile-container {
  text-align: center;
  margin-bottom: 20px;
}
.profile-container img {
  width: 150px;
  border-radius: 14px;
  border: 3px solid #ddd;
}

/* TITLES */
.section-title {
  font-size: 20px;
  font-weight: 700;
  margin-bottom: 16px;
}

/* TABLE */
.table-custom {
  background: white;
  border-radius: 10px;
}
.table-custom th {
  background: #f0f2f5;
}
.table-custom td, .table-custom th {
  vertical-align: middle;
}

/* RESPONSIVE SIDEBAR */
.toggle-btn {
  display: none;
  margin-bottom: 12px;
  font-size: 22px;
  cursor: pointer;
}

@media (max-width: 768px) {
  .sidebar {
    position: fixed;
    left: -260px;
    top: 0;
    height: 100%;
    transition: 0.3s;
  }
  .sidebar.open {
    left: 0;
  }
  .toggle-btn {
    display: inline-block;
  }
  .content {
    padding: 18px;
  }
}
</style>
</head>

<body>

<div class="wrapper">

  <!-- SIDEBAR -->
  <div class="sidebar" id="sidebar">
    <h3>Student Portal</h3>
    <a href="#" id="t-student" class="active" onclick="openTab('student')">Student Info</a>
    <a href="#" id="t-hostel" onclick="openTab('hostel')">Hostel</a>
    <a href="#" id="t-attendance" onclick="openTab('attendance')">Attendance</a>
    <a href="#" id="t-results" onclick="openTab('results')">Results</a>
    <a href="#" id="t-fees" onclick="openTab('fees')">Fees</a>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <div class="toggle-btn" onclick="toggleSidebar()">
      <i class="bi bi-list"></i>
    </div>

    <div class="topbar">
      Welcome to your Student Dashboard
    </div>

    <!-- STUDENT INFO -->
    <div id="student" class="tabPage">
      <div class="card-box">

        <div class="profile-container">
          <img src="profile.jpg">
          <h4 class="mt-3 mb-1 fw-bold">VALLURI SRI KRISHNA VARDAN</h4>
          <div class="text-muted">Roll: 2403031260215 | CSE (3CYBER3)</div>
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
    <div id="hostel" class="tabPage" style="display:none;">
      <div class="card-box">
        <div class="section-title">Hostel Details</div>

        <p><strong>Reg No:</strong> 42043</p>
        <p><strong>Block:</strong> TAGORE BHAWAN - C (Non AC)</p>
        <p><strong>Room:</strong> Floor 3 | Room C-361 | Bed 3</p>
        <p><strong>Duration:</strong> 01-07-2025 to 30-06-2026</p>
        <p><strong>City:</strong> East Godavari</p>
        <p><strong>Address:</strong> HOUSE NO-1-18 MAIN ROAD, NELAPARTHIPADU, DRAKSHARAMAM</p>
      </div>

      <div class="card-box">
        <div class="section-title">Recent Gate Passes</div>

        <div class="table-responsive table-custom">
          <table class="table table-bordered">
            <thead>
              <tr><th>Sr</th><th>Reason</th><th>Place</th><th>From</th><th>To</th><th>Status</th></tr>
            </thead>
            <tbody>
              <tr><td>1</td><td>Holiday</td><td>HOME</td><td>17-10-2025 05:00 PM</td><td>02-11-2025 06:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
              <tr><td>2</td><td>Personal Reason</td><td>PAVGADH</td><td>19-07-2025</td><td>19-07-2025</td><td><span class="badge bg-success">Approved</span></td></tr>
              <tr><td>3</td><td>Personal Reason</td><td>VADODARA</td><td>05-07-2025</td><td>05-07-2025</td><td><span class="badge bg-success">Approved</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ATTENDANCE -->
    <div id="attendance" class="tabPage" style="display:none;">
      <div class="card-box">
        <div class="section-title">Attendance Overview</div>

        <div class="table-responsive table-custom">
          <table class="table table-bordered">
            <thead>
              <tr><th>Sr</th><th>Subject</th><th>Slot</th><th>Conducted</th><th>Present</th><th>Absent</th><th>%</th></tr>
            </thead>
            <tbody>
              <tr><td>1</td><td>Design of Data Structures</td><td>Theory</td><td>28</td><td>26</td><td>2</td><td>98%</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- RESULTS -->
    <div id="results" class="tabPage" style="display:none;">
      <div class="card-box text-center">
        <div class="section-title">2nd SEM Results</div>
        <img src="SEMRESULTSPHOTO.jpg" class="result-img mb-3">
        <button class="btn btn-primary px-4">Download PDF</button>
      </div>
    </div>

    <!-- FEES -->
    <div id="fees" class="tabPage" style="display:none;">
      <div class="card-box">
        <div class="section-title">Fees Status</div>
        All tuition, hostel, and miscellaneous fees have been cleared for the academic year.
      </div>
    </div>

  </div>
</div>

<script>
function toggleSidebar() {
  document.getElementById("sidebar").classList.toggle("open");
}

function openTab(tab) {
  let tabs = document.getElementsByClassName("tabPage");
  for (let t of tabs) t.style.display = "none";

  let links = ["student","hostel","attendance","results","fees"];
  for (let l of links) document.getElementById("t-"+l).classList.remove("active");

  document.getElementById(tab).style.display = "block";
  document.getElementById("t-"+tab).classList.add("active");
}
</script>

</body>
</html>
