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

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <style>
    .profile-pic img {
      border-radius: 10px;
      border: 3px solid #555;
      width: 150px;
    }
    .nav-tabs .nav-link.active {
      background-color: #0d6efd;
      color: white;
    }
    .info-label {
      font-weight: bold;
      width: 160px;
      display: inline-block;
    }
    .table th, .table td {
      vertical-align: middle !important;
    }
    .result-img {
      width: 100%;
      max-width: 600px;
      border: 2px solid #666;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="logo.jpg" alt="College Logo" height="40">
      &nbsp; Student Portal
    </a>
  </div>
</nav>

<!-- Main Content -->
<div class="container mt-4">
  <ul class="nav nav-tabs" id="portalTabs">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#student"> Student Info</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#hostel"> Hostel</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#attendance"> Attendance</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#results"> Results</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#fees"> Fees</a></li>
  </ul>

  <div class="tab-content border p-4 bg-white">
    <!-- Student Info Tab -->
    <div id="student" class="tab-pane fade show active">
      <div class="text-center mb-3">
        <div class="profile-pic mb-2">
          <img src="profile.jpg" alt="Student Photo">
        </div>
        <h5 class="fw-bold">VALLURI SRI KRISHNA VARDAN</h5>
        <p class="text-muted">Roll No: 2403031260215 | Branch: CSE (3CYBER3)</p>
      </div>
      <div>
        <p><span class="info-label">DOB:</span> 28-11-2006</p>
        <p><span class="info-label">Student Phone:</span> 6281048554</p>
        <p><span class="info-label">Father:</span> VALLURI VENKATA KRISHNANANDA CHOWDARY | 9951996671</p>
        <p><span class="info-label">Mother:</span> VALLURI VISALAKSHI | 6301244329</p>
        <p><span class="info-label">College Email:</span> 2403031260215@paruluniversity.ac.in</p>
        <p><span class="info-label">Personal Email:</span> krishnavardhan124@gmail.com</p>
      </div>
    </div>

    <!-- Hostel Tab -->
    <div id="hostel" class="tab-pane fade">
      <h5 class="mb-3">Hostel Details</h5>
      <p><span class="info-label">Reg No:</span> 42043</p>
      <p><span class="info-label">Block:</span> TAGORE BHAWAN - C (Non AC)</p>
      <p><span class="info-label">Room:</span> Floor 3 | Room C-361 | Bed 3</p>
      <p><span class="info-label">Duration:</span> 01-07-2025 to 30-06-2026</p>
      <p><span class="info-label">City:</span> EAST GODAVARI</p>
      <p><span class="info-label">Address:</span> HOUSE NO-1-18 MAIN ROAD, NELAPARTHIPADU, DRAKSHARAMAM, RAMCHANDRAPURAM, DR B R AMBEDKAR, NEAR PANCHAYAT</p>
      <p><span class="info-label">Guardian Phone:</span> 6301244329, 9951996671</p>
      
      <h5 class="mt-4 mb-3">Recent Gate Passes</h5>
      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>Sr.</th><th>Leave Reason</th><th>Place Of Visit</th><th>From</th><th>To</th><th>Status</th>
            </tr>
          </thead>
          <tbody>
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
            <tr><td>14</td><td>Personal Reason</td><td>SHOPPING</td><td>27-09-2024 07:00 AM</td><td>27-09-2024 05:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>15</td><td>Shopping</td><td>Shopping</td><td>23-09-2024 05:00 PM</td><td>23-09-2024 08:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>16</td><td>Personal Reason</td><td>HAIR CUTTING & SHOPPING</td><td>08-09-2024 09:00 AM</td><td>08-09-2024 12:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>17</td><td>Shopping</td><td>Shopping</td><td>02-09-2024 04:30 PM</td><td>02-09-2024 09:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
            <tr><td>18</td><td>Shopping</td><td>For shopping and saloon</td><td>01-09-2024 10:00 AM</td><td>01-09-2024 05:00 PM</td><td><span class="badge bg-danger">Rejected</span></td></tr>
          </tbody>
        </table>
      </div>
    </div>
    

    <!-- Attendance Tab -->
    <div id="attendance" class="tab-pane fade">
      <h5 class="mb-3">Attendance Overview </h5>

      <!-- Structured Table -->
      <div class="table-responsive mb-4">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>Sr</th><th>Subject</th><th>Slot</th><th>Conducted</th><th>Present</th><th>Absent</th><th>%</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>Design of Data Structures</td><td>Theory</td><td>28</td><td>26</td><td>2</td></td><td>98%</td></tr>
            <tr><td>2</td><td>DDS Lab</td><td>Practical</td><td>20</td><td>19</td><td>0</td><td>99%</td></tr>
            <tr><td>3</td><td>DBMS</td><td>Theory</td><td>28</td><td>28</td><td>0</td><td>100%</td></tr>
            <tr><td>4</td><td>DBMS Lab</td><td>Practical</td><td>10</td><td>9</td><td>0</td><td>100%</td></tr>
            <tr><td>5</td><td>OOP with JAVA</td><td>Theory</td><td>10</td><td>10</td><td>0</td><td>100%</td></tr>
            <tr><td>6</td><td>JAVA Lab</td><td>Practical</td><td>8</td><td>7</td><td>1</td><td>99%</td></tr>
            <tr><td>7</td><td>Kali Linux</td><td>Theory</td><td>15</td><td>10</td><td>5</td><td>66.7%</td></tr>
            <tr><td>8</td><td>Kali Lab</td><td>Practical</td><td>4</td><td>2</td><td>2</td><td>50%</td></tr>
            <tr><td>9</td><td>Discrete Math</td><td>Theory</td><td>19</td><td>10</td><td>9</td><td>52.6%</td></tr>
            <tr><td>10</td><td>Prof. Comm.</td><td>Theory</td><td>10</td><td>6</td><td>4</td><td>60%</td></tr>
          </tbody>
        </table>
      </div>

      <!-- Custom Slot Breakdown -->
      <h6 class="mb-2">Slot-wise Day-wise Attendance</h6>
<div class="table-responsive mb-4">
  <table class="table table-bordered text-center">
    <thead class="table-light">
      <tr>
        <th>Date</th>
        <th>Day</th>
        <th>Slot 1</th>
        <th>Slot 2</th>
        <th>Slot 3</th>
        <th>Slot 4</th>
      </tr>
    </thead>
    <tbody>
      <tr><td>03-oct-25</td><td>Fri</td><td>P</td><td>P</td><td>LIB</td><td>P</td></tr
      <tr><td>02-oct-25</td><td>Thu</td><td>AB</td><td>P</td><td>P</td><td>AB</td></tr
      <tr><td>01-oct-25</td><td>Wed</td><td>P</td><td>P</td><td>LIB</td><td>P</td></tr
      <tr><td>30-sep-25</td><td>Tue</td><td>P</td><td>P</td><td>P</td><td>AB</td></tr
      <tr><td>29-Sep-25</td><td>Mon</td><td>P</td><td>P</td><td>P</td><td>P</td></tr
      <tr><td>25-sep-25</td><td>Thu</td><td>AB</td><td>P</td><td>P</td><td>AB</td></tr
      <tr><td>24-sep-25</td><td>Wed</td><td>P</td><td>P</td><td>LIB</td><td>P</td></tr
      <tr><td>23-sep-25</td><td>Tue</td><td>P</td><td>P</td><td>P</td><td>P</td></tr
      <tr><td>22-Sep-25</td><td>Mon</td><td>P</td><td>P</td><td>P</td><td>P</td></tr
      <tr><td>19-sep-25</td><td>Fri</td><td>P</td><td>P</td><td>LIB</td><td>P</td></tr
      <tr><td>18-sep-25</td><td>Thu</td><td>AB</td><td>P</td><td>P</td><td>AB</td></tr
      <tr><td>17-sep-25</td><td>Wed</td><td>P</td><td>P</td><td>LIB</td><td>P</td></tr
      <tr><td>16-sep-25</td><td>Tue</td><td>P</td><td>P</td><td>P</td><td>P</td></tr
      <tr><td>15-Sep-25</td><td>Mon</td><td>P</td><td>P</td><td>P</td><td>P</td></tr
      <tr><td>11-sep-25</td><td>Thu</td><td>P</td><td>P</td><td>P</td><td>P</td></tr
      <tr><td>10-sep-25</td><td>Wed</td><td>P</td><td>P</td><td>LIB</td><td>P</td></tr
      <tr><td>09-sep-25</td><td>Tue</td><td>P</td><td>P</td><td>P</td><td>P</td></tr
      <tr><td>08-Sep-25</td><td>Mon</td><td>P</td><td>P</td><td>P</td><td>P</td></tr
      <tr><td>05-sep-25</td><td>Fri</td><td>P</td><td>P</td><td>LIB</td><td>P</td></tr
      <tr><td>04-sep-25</td><td>Thu</td><td>P</td><td>P</td><td>P</td><td>P</td></tr
      <tr><td>03-sep-25</td><td>Wed</td><td>P</td><td>P</td><td>LIB</td><td>P</td></tr
      <tr><td>02-sep-25</td><td>Tue</td><td>P</td><td>P</td><td>P</td><td>P</td></tr
      <tr><td>01-Sep-25</td><td>Mon</td><td>P</td><td>P</td><td>P</td><td>P</td></tr
    </tbody>
  </table>
</div>
<small><strong>Legend:</strong> P – Present | A – Absent | PN – On Permission</small>

    </div>

    <!-- Results Tab -->
     <div id="results" class="tab-pane fade">
      <h5 class="mb-3">2nd SEM Result Image</h5>
      <div class="text-center" id="resultImageDiv">
        <img src="SEMRESULTSPHOTO.jpg" class="result-img mb-3" alt="Result Photo">
        <br>
        <button class="btn btn-primary" onclick="downloadPDF()">⬇️ Download as PDF</button>
      </div>
    </div>

  <!-- Fees Tab -->
    <div id="fees" class="tab-pane fade">
      <h5 class="mb-3">Fee Status</h5>
      <div class="alert alert-success text-center">
         All tuition, hostel, and miscellaneous fees have been cleared for the academic year.To Download Fee receipt login to GNUMS Web Portal <strong>2025–2026</strong>.
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
