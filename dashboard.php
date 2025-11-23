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
<title>Student Portal - Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
body {
  margin: 0;
  background: #eef1f5;
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
  overflow-x: hidden;
}

/* Animations */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(12px); }
  to { opacity: 1; transform: translateY(0); }
}
@keyframes slideIn {
  from { transform: translateX(-240px); }
  to { transform: translateX(0); }
}
@keyframes floatUp {
  from { transform: translateY(10px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

/* Layout */
.wrapper {
  display: flex;
  min-height: 100vh;
}

/* Sidebar */
.sidebar {
  width: 240px;
  background: #0d6efd;
  color: white;
  padding-top: 20px;
  flex-shrink: 0;
  animation: slideIn 0.5s ease-out;
}
.sidebar h4 {
  font-size: 20px;
  font-weight: 700;
  padding-left: 20px;
  margin-bottom: 30px;
}
.sidebar a {
  display: block;
  padding: 14px 20px;
  color: white;
  font-size: 15px;
  text-decoration: none;
  border-left: 4px solid transparent;
  transition: 0.2s;
}
.sidebar a:hover,
.sidebar a.active {
  background: rgba(255,255,255,0.15);
  border-left: 4px solid white;
  padding-left: 26px;
}

/* Content */
.content {
  flex: 1;
  padding: 25px;
}
.topbar {
  background: white;
  padding: 14px 20px;
  border-radius: 8px;
  margin-bottom: 20px;
  font-size: 18px;
  font-weight: 600;
  animation: fadeIn 0.5s ease-out;
}

.tab-section {
  animation: fadeIn 0.4s ease-out;
}

/* Cards */
.info-card {
  background: white;
  padding: 18px;
  border-radius: 10px;
  box-shadow: 0 1px 4px rgba(0,0,0,0.08);
  margin-bottom: 20px;
  animation: floatUp 0.5s ease-out;
}

/* Titles */
.section-title {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 14px;
}

/* Profile */
.profile-pic {
  text-align: center;
  margin-bottom: 20px;
}
.profile-pic img {
  width: 150px;
  border-radius: 12px;
  border: 3px solid #ccc;
  animation: floatUp 0.5s ease-out;
}

/* Tables */
.table-custom {
  background: white;
  border-radius: 8px;
  animation: floatUp 0.6s ease-out;
}
.table-custom th {
  background: #eef1f5;
}

/* Result image */
.result-img {
  width: 100%;
  max-width: 600px;
  border: 2px solid #ccc;
  border-radius: 10px;
}

/* Mobile Sidebar */
.toggle-btn {
  display: none;
  font-size: 22px;
  cursor: pointer;
  margin-bottom: 10px;
}

@media(max-width:768px){
  .sidebar {
    position: fixed;
    left: -240px;
    top: 0;
    height: 100%;
    z-index: 2000;
    transition: 0.3s;
  }
  .sidebar.open {
    left: 0;
  }
  .toggle-btn {
    display: inline-block;
  }
  .content {
    padding: 15px;
  }
}
</style>
</head>
<body>

<div class="wrapper">

  <!-- SIDEBAR -->
  <div class="sidebar" id="sidebar">
    <h4>Student Portal</h4>
    <a href="#" id="link-student" class="active" onclick="showTab('student')">Student Info</a>
    <a href="#" id="link-hostel" onclick="showTab('hostel')">Hostel</a>
    <a href="#" id="link-attendance" onclick="showTab('attendance')">Attendance</a>
    <a href="#" id="link-results" onclick="showTab('results')">Results</a>
    <a href="#" id="link-fees" onclick="showTab('fees')">Fees</a>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <!-- Mobile Toggle -->
    <div class="toggle-btn" onclick="toggleSidebar()">
      <i class="bi bi-list"></i>
    </div>

    <div class="topbar">Welcome to your Dashboard</div>

    <!-- STUDENT INFO -->
    <div id="student" class="tab-section">

      <div class="info-card">
        <div class="profile-pic">
          <img src="profile.jpg" alt="Profile Photo">
          <h5 class="fw-bold mt-3">VALLURI SRI KRISHNA VARDAN</h5>
          <p class="text-muted">
            Roll No: 2403031260215 | Branch: CSE (3CYBER3)
          </p>
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
    <div id="hostel" class="tab-section" style="display:none;">
      <div class="section-title">Hostel Details</div>

      <div class="info-card">
        <p><strong>Reg No:</strong> 42043</p>
        <p><strong>Block:</strong> Tagore Bhawan - C (Non AC)</p>
        <p><strong>Room:</strong> Floor 3 | Room C-361 | Bed 3</p>
        <p><strong>Duration:</strong> 01-07-2025 to 30-06-2026</p>
        <p><strong>City:</strong> East Godavari</p>
        <p><strong>Address:</strong> HOUSE NO-1-18 MAIN ROAD, NELAPARTHIPADU, DRAKSHARAMAM</p>
      </div>

      <div class="section-title">Recent Gate Passes</div>

      <div class="table-responsive table-custom">
        <table class="table table-bordered">
          <thead>
            <tr><th>Sr</th><th>Reason</th><th>Place</th><th>From</th><th>To</th><th>Status</th></tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>Holiday</td><td>Home</td><td>17-10-2025</td><td>02-11-2025</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>2</td><td>Personal Reason</td><td>Pavgadh</td><td>19-07-2025</td><td>19-07-2025</td><td><span class="badge bg-success">Approved</span></td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- ATTENDANCE -->
    <div id="attendance" class="tab-section" style="display:none;">
      <div class="section-title">Attendance Overview</div>

      <div class="table-responsive table-custom mb-4">
        <table class="table table-bordered">
          <thead><tr><th>Sr</th><th>Subject</th><th>Slot</th><th>Conducted</th><th>Present</th><th>Absent</th><th>%</th></tr></thead>
          <tbody>
            <tr><td>1</td><td>Design of Data Structures</td><td>Theory</td><td>28</td><td>26</td><td>2</td><td>98%</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- RESULTS -->
    <div id="results" class="tab-section" style="display:none;">
      <div class="section-title">2nd SEM Results</div>

      <div class="info-card text-center">
        <img src="SEMRESULTSPHOTO.jpg" class="result-img mb-3">
        <button class="btn btn-primary">Download PDF</button>
      </div>
    </div>

    <!-- FEES -->
    <div id="fees" class="tab-section" style="display:none;">
      <div class="section-title">Fee Status</div>

      <div class="info-card">
        All tuition, hostel, and miscellaneous fees have been cleared for the academic year.
      </div>
    </div>

  </div>
</div>

<script>
function toggleSidebar() {
  document.getElementById("sidebar").classList.toggle("open");
}

function showTab(tab) {
  const tabs = ["student", "hostel", "attendance", "results", "fees"];
  tabs.forEach(t => {
    document.getElementById(t).style.display = "none";
    document.getElementById("link-" + t).classList.remove("active");
  });
  document.getElementById(tab).style.display = "block";
  document.getElementById("link-" + tab).classList.add("active");
}
</script>

</body>
</html>
