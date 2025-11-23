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

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
body {
  background: #f4f6f9;
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
  margin: 0;
}

/* Navbar */
.navbar {
  background: #0d6efd;
  padding: 12px 0;
}
.navbar-brand img {
  height: 38px;
  margin-right: 8px;
  border-radius: 6px;
}

/* Tabs */
.nav-tabs .nav-link {
  font-weight: 600;
  color: #555;
  border-radius: 6px 6px 0 0;
}
.nav-tabs .nav-link.active {
  background: #0d6efd;
  color: white;
}

/* Container box */
.tab-content {
  border-radius: 8px;
  margin-top: 15px;
}

/* Profile photo */
.profile-pic img {
  width: 150px;
  border-radius: 10px;
  border: 3px solid #ddd;
}

/* Labels */
.info-label {
  font-weight: 600;
  width: 160px;
  display: inline-block;
}

/* Table */
.table {
  background: white;
  border-radius: 6px;
}
.table th {
  background: #eef1f5;
}
.table td, .table th {
  vertical-align: middle !important;
}

/* Image result */
.result-img {
  width: 100%;
  max-width: 600px;
  border: 2px solid #ccc;
  border-radius: 10px;
}

/* Section spacing */
h5 {
  font-weight: 700;
  margin-bottom: 15px;
}

.card-section {
  background: white;
  padding: 16px;
  border-radius: 8px;
  margin-bottom: 20px;
}

/* Responsive fix */
@media(max-width: 576px) {
  .info-label {
    width: 130px;
  }
  .profile-pic img {
    width: 120px;
  }
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="logo.jpg" alt="College Logo">
      <span class="fw-bold">Student Portal</span>
    </a>
  </div>
</nav>

<!-- MAIN CONTENT -->
<div class="container mt-4">

  <!-- TABS -->
  <ul class="nav nav-tabs" id="portalTabs">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#student">Student Info</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#hostel">Hostel</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#attendance">Attendance</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#results">Results</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#fees">Fees</a></li>
  </ul>

  <div class="tab-content bg-white p-4 shadow-sm">

    <!-- STUDENT INFO -->
    <div id="student" class="tab-pane fade show active">
      <div class="text-center mb-4">
        <div class="profile-pic mb-2">
          <img src="profile.jpg" alt="Student Photo">
        </div>
        <h5 class="fw-bold">VALLURI SRI KRISHNA VARDAN</h5>
        <p class="text-muted">
          Roll No: 2403031260215 | Branch: CSE (3CYBER3)
        </p>
      </div>

      <div class="card-section">
        <p><span class="info-label">DOB:</span> 28-11-2006</p>
        <p><span class="info-label">Student Phone:</span> 6281048554</p>
        <p><span class="info-label">Father:</span> VALLURI VENKATA KRISHNANANDA CHOWDARY | 9951996671</p>
        <p><span class="info-label">Mother:</span> VALLURI VISALAKSHI | 6301244329</p>
        <p><span class="info-label">College Email:</span> 2403031260215@paruluniversity.ac.in</p>
        <p><span class="info-label">Personal Email:</span> krishnavardhan124@gmail.com</p>
      </div>
    </div>

    <!-- HOSTEL -->
    <div id="hostel" class="tab-pane fade">
      <h5>Hostel Details</h5>
      <div class="card-section">
        <p><span class="info-label">Reg No:</span> 42043</p>
        <p><span class="info-label">Block:</span> TAGORE BHAWAN - C (Non AC)</p>
        <p><span class="info-label">Room:</span> Floor 3 | Room C-361 | Bed 3</p>
        <p><span class="info-label">Duration:</span> 01-07-2025 to 30-06-2026</p>
        <p><span class="info-label">City:</span> EAST GODAVARI</p>
        <p><span class="info-label">Address:</span> HOUSE NO-1-18 MAIN ROAD, NELAPARTHIPADU, DRAKSHARAMAM, RAMCHANDRAPURAM</p>
        <p><span class="info-label">Guardian Phone:</span> 6301244329, 9951996671</p>
      </div>

      <h5 class="mt-4">Recent Gate Passes</h5>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Sr.</th><th>Leave Reason</th><th>Place Of Visit</th><th>From</th><th>To</th><th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php /* Your existing table rows preserved */ ?>
            <tr><td>1</td><td>Holiday</td><td>HOME</td><td>17-10-2025 05:00 PM</td><td>02-11-2025 06:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>1</td><td>Personal Reason</td><td>PAVGADH</td><td>19-07-2025 05:00 AM</td><td>19-07-2025 06:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>2</td><td>Personal Reason</td><td>VADODARA</td><td>05-07-2025 10:00 AM</td><td>05-07-2025 07:30 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>3</td><td>Holiday</td><td>HOME</td><td>25-05-2025 10:00 AM</td><td>30-06-2025 12:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>4</td><td>Personal Reason</td><td>WFC</td><td>27-04-2025 05:00 AM</td><td>27-04-2025 09:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>5</td><td>Personal Reason</td><td>HOME</td><td>19-03-2025 09:00 AM</td><td>07-04-2025 12:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>6</td><td>Personal Reason</td><td>Vadodara</td><td>16-02-2025 10:00 AM</td><td>16-02-2025 09:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>7</td><td>Personal Reason</td><td>Vadodara</td><td>01-02-2025 05:00 PM</td><td>02-02-2025 09:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>8</td><td>Holiday</td><td>HOME</td><td>28-12-2024 06:00 PM</td><td>26-01-2025 12:00 AM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>9</td><td>Personal Reason</td><td>VADODARA</td><td>15-12-2024 07:00 AM</td><td>15-12-2024 09:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>10</td><td>Personal Reason</td><td>Vadodara</td><td>25-11-2024 03:10 PM</td><td>26-11-2024 12:00 AM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>11</td><td>Vacation</td><td>HOME</td><td>19-10-2024 12:00 PM</td><td>18-11-2024 12:00 AM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>12</td><td>Personal Reason</td><td>VADODARA</td><td>13-10-2024 04:20 PM</td><td>13-10-2024 06:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>13</td><td>Shopping</td><td>SALOON & SHOPPING</td><td>13-10-2024 09:00 AM</td><td>13-10-2024 02:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- ATTENDANCE -->
    <div id="attendance" class="tab-pane fade">
      <h5>Attendance Overview</h5>

      <div class="table-responsive mb-4">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Sr</th><th>Subject</th><th>Slot</th><th>Conducted</th><th>Present</th><th>Absent</th><th>%</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>Design of Data Structures</td><td>Theory</td><td>28</td><td>26</td><td>2</td><td>98%</td></tr>
            <tr><td>2</td><td>DDS Lab</td><td>Practical</td><td>20</td><td>19</td><td>0</td><td>99%</td></tr>
            <tr><td>3</td><td>DBMS</td><td>Theory</td><td>28</td><td>28</td><td>0</td><td>100%</td></tr>
            <tr><td>4</td><td>DBMS Lab</td><td>Practical</td><td>10</td><td>9</td><td>0</td><td>100%</td></tr>
          </tbody>
        </table>
      </div>

      <h6 class="fw-bold mb-2">Slot-wise Attendance</h6>
      <div class="table-responsive mb-4">
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th>Date</th><th>Day</th><th>Slot1</th><th>Slot2</th><th>Slot3</th><th>Slot4</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>03-oct-25</td><td>Fri</td><td>P</td><td>P</td><td>LIB</td><td>P</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- RESULTS -->
    <div id="results" class="tab-pane fade">
      <h5>2nd SEM Result</h5>
      <div class="text-center" id="resultImageDiv">
        <img src="SEMRESULTSPHOTO.jpg" class="result-img mb-3">
        <button class="btn btn-primary" onclick="downloadPDF()">Download PDF</button>
      </div>
    </div>

    <!-- FEES -->
    <div id="fees" class="tab-pane fade">
      <h5>Fee Status</h5>
      <div class="alert alert-success text-center">
        All tuition, hostel, and miscellaneous fees have been cleared for the academic year. Login to GNUMS Web Portal to download the fee receipt.
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
