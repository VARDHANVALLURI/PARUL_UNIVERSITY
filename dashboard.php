<?php
session_start();
if (!isset($_SESSION['student'])) {
  header("Location: index.php");
  exit;
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Student Dashboard (Mobile)</title>

<!-- Bootstrap (only for utilities) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Inter font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ---------- Global / Mobile-first ---------- */
:root { --nav-height:56px; --sidebar-w:84%; }
*{box-sizing:border-box}
html,body{height:100%;margin:0;padding:0;overflow-x:hidden;font-family:'Inter',system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial;color:#0f1724;background:#f6f7fb;}
a{color:inherit}

/* ---------- Background (dashboard only) ---------- */
/* using uploaded file path exactly as provided */
.content {
  min-height:100vh;
  background-image: url("/mnt/data/e0739b2c-67d4-438c-a089-96b469d1c723.png");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position:relative;
  padding:12px;
}

/* translucent overlay for readability */
.content::before{
  content:"";
  position:fixed;
  inset:0;
  background:rgba(255,255,255,0.86);
  z-index:0;
  pointer-events:none;
}

/* inner container sits above overlay */
.content-inner{position:relative;z-index:1;}

/* ---------- Topbar (mobile) ---------- */
.topbar{
  height:var(--nav-height);
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:8px;
  margin-bottom:12px;
}
.brand{display:flex;align-items:center;gap:8px;font-weight:700}
.mobile-toggle{background:transparent;border:0;font-size:22px;color:#0b3a8c;padding:6px;border-radius:8px}
.logout-btn{font-size:13px}

/* ---------- Off-canvas sidebar (mobile) ---------- */
.sidebar {
  position:fixed;
  left:0;
  top:0;
  bottom:0;
  width:var(--sidebar-w);
  max-width:420px;
  transform:translateX(-110%);
  background:#fff;
  box-shadow:12px 0 40px rgba(2,6,23,0.12);
  z-index:2200;
  transition:transform .28s cubic-bezier(.2,.9,.2,1);
  padding:12px 10px;
  overflow:auto;
  -webkit-overflow-scrolling:touch;
}
.sidebar.open{transform:translateX(0)}
.sidebar .close-btn{display:flex;justify-content:flex-end;padding:4px 8px}
.sidebar .nav{display:flex;flex-direction:column;gap:6px;padding:6px}
.sidebar a{padding:12px 14px;border-radius:8px;text-decoration:none;color:#0b2540;font-weight:600}
.sidebar a.active{background:#eef6ff;border-left:4px solid #0d6efd;color:#0b3a8c}

/* overlay behind sidebar */
#sidebarOverlay{
  position:fixed;inset:0;background:rgba(0,0,0,0.35);z-index:2100;display:none;
}
#sidebarOverlay.visible{display:block}

/* ---------- Content layout (mobile-first) ---------- */
.container-stack{display:flex;flex-direction:column;gap:12px}

/* home cards (kept per your request) */
.home-cards{display:flex;gap:10px;flex-wrap:wrap}
.home-card{
  flex:1 1 calc(50% - 10px);
  min-width:120px;
  background:rgba(255,255,255,0.98);
  border-radius:12px;padding:12px;
  box-shadow:0 6px 18px rgba(2,6,23,0.06);
  display:flex;flex-direction:column;justify-content:space-between;
}
.home-card h6{margin:0;font-size:15px;font-weight:700}
.home-card p{margin:6px 0 0;font-size:13px;color:#475569}

/* ensure full width for single column on narrow screens */
@media (max-width:360px){
  .home-card{flex-basis:100%}
}

/* ---------- Cards & tables ---------- */
.card{
  background:rgba(255,255,255,0.96);
  border-radius:12px;
  padding:12px;
  box-shadow:0 6px 18px rgba(2,6,23,0.06);
}
.card .section-title{font-weight:700;margin-bottom:8px;font-size:16px}
.kv-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.kv{background:transparent;padding:8px;border-radius:8px}
.kv .k{font-size:12px;color:#475569}
.kv .v{font-weight:700;margin-top:6px;color:#0f1724}

/* make kv single column if too narrow */
@media (max-width:420px){
  .kv-grid{grid-template-columns:1fr}
}

/* tables responsive */
.table-responsive{overflow:auto;-webkit-overflow-scrolling:touch}
.table-responsive table{width:100%;border-collapse:collapse}
.table th, .table td{padding:8px;text-align:center;border-top:1px solid #eef2f6}

/* remove horizontal scroll by clamping widths */
img, table{max-width:100%;height:auto}

/* ---------- Accessibility & safe spacing ---------- */
.small-muted{font-size:13px;color:#64748b}
.btn-ghost{background:transparent;border:1px solid rgba(15,23,42,0.06);padding:6px 10px;border-radius:8px}

/* ---------- Prevent any accidental horizontal scroll ---------- */
html, body, .content, .content-inner, .sidebar, .card, .home-card {max-width:100vw;}

/* ---------- Footer spacing ---------- */
.footer-space{height:28px}
</style>
</head>
<body>

<!-- Sidebar overlay (closes sidebar) -->
<div id="sidebarOverlay" aria-hidden="true"></div>

<!-- Off-canvas sidebar -->
<nav id="sidebar" class="sidebar" aria-label="Main menu">
  <div class="close-btn">
    <button id="closeSidebarBtn" aria-label="Close menu" class="mobile-toggle"><i class="bi bi-x-lg"></i></button>
  </div>
  <div class="nav" role="navigation" aria-label="Primary">
    <a href="#" id="link-home" data-target="home" class="active">Dashboard Home</a>
    <a href="#" id="link-student" data-target="student">Student Info</a>
    <a href="#" id="link-hostel" data-target="hostel">Hostel</a>
    <a href="#" id="link-attendance" data-target="attendance">Attendance</a>
    <a href="#" id="link-results" data-target="results">Results</a>
    <a href="#" id="link-fees" data-target="fees">Fees</a>
    <hr />
    <a href="logout.php" class="small-muted">Logout</a>
  </div>
</nav>

<!-- Main content -->
<main class="content" role="main">
  <div class="content-inner">

    <!-- Topbar -->
    <div class="topbar">
      <div class="brand" style="align-items:center">
        <button id="openSidebarBtn" class="mobile-toggle" aria-label="Open menu"><i class="bi bi-list"></i></button>
        <div>STUDENT PORTAL</div>
      </div>
      <div style="display:flex;gap:8px;align-items:center">
        <!-- removed quick links from home as requested -->
        <a href="logout.php" class="btn btn-ghost logout-btn">Logout</a>
      </div>
    </div>

  <!-- HOME -->
<section id="home" class="page">
  <div class="row-gap">

    <!-- Profile Card -->
    <div class="col-card card-box">
      <div style="display:flex;align-items:center;gap:14px;">
        <div style="flex:1;min-width:0;">
          <div class="section-title">Profile</div>
          <div class="text-muted">Basic information</div>
          <div style="margin-top:10px;">
            <strong>VALLURI SRI KRISHNA VARDAN</strong><br>
            Roll: 2403031260215 | CSE (4CYBER3)
          </div>
          <div style="margin-top:4px;font-weight:600;">
            Hostel Bed No: <span style="color:#0d6efd;">BED-3</span>
          </div>
        </div>

        <!-- Small profile placeholder -->
        <div style="width:85px;text-align:center;">
          <img src="your_profile_small.jpg" 
            alt="Profile" 
            style="width:75px;height:75px;object-fit:cover;border-radius:10px;border:2px solid #d7dce3;">
        </div>
      </div>
    </div>

    <!-- Attendance Snapshot -->
    <div class="col-card card-box">
      <div class="section-title">ATTENDENCE SNAPSHOT:</div>
      <div class="text-muted">Quick overview</div>

      <div style="margin-top:12px;">
        <div class="progress" style="height:14px;">
          <div class="progress-bar" 
               role="progressbar" 
               style="width: 100%;" 
               aria-valuenow="100">100%</div>
        </div>
      </div>
    </div>

    <!-- Hostel Card -->
    <div class="col-card card-box">
      <div class="section-title">Hostel</div>
      <div class="text-muted">Room & Allocation</div>
      <div style="margin-top:10px;">
        <strong>TAGORE BHAWAN - C</strong><br>
        Floor 3 | Room C-361 | <span style="color:#0d6efd;font-weight:600;">Bed 3</span>
      </div>
    </div>

  </div>
</section>
  
          

   <!-- STUDENT INFO -->
<section id="student" class="page" style="display:none;">

  <div class="card-box">

    <!-- Medium placeholder -->
    <div class="profile-pic text-center mb-3">
      <img 
        src="your_profile_medium.jpg"
        alt="Student Photo"
        style="width:160px;height:160px;object-fit:cover;border-radius:14px;border:3px solid #d0d0d0;">
      <h5 class="fw-bold mt-3 mb-1">VALLURI SRI KRISHNA VARDAN</h5>
      <div class="text-muted">Roll No: 2403031260215 | CSE (4CYBER3)</div>
    </div>

    <!-- Auto-wrapping grid, no overflow -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">

      <div class="card-box" style="padding:12px;">
        <div class="text-muted">DOB</div>
        <div style="font-weight:600;margin-top:6px;">28-11-2006</div>
      </div>

      <div class="card-box" style="padding:12px;">
        <div class="text-muted">Student Phone</div>
        <div style="font-weight:600;margin-top:6px;">6281048554</div>
      </div>

      <div class="card-box" style="padding:12px;">
        <div class="text-muted">College Email</div>
        <div style="word-break:break-all;font-weight:600;margin-top:6px;">
          2403031260215@paruluniversity.ac.in
        </div>
      </div>

      <div class="card-box" style="padding:12px;">
        <div class="text-muted">Personal Email</div>
        <div style="word-break:break-all;font-weight:600;margin-top:6px;">
          krishnavardhan124@gmail.com
        </div>
      </div>

    </div>

    <div style="margin-top:18px;">
      <div class="section-title">Parents / Guardian</div>
      <p><strong>Father:</strong> VALLURI VENKATA KRISHNANANDA CHOWDARY | 9951996671</p>
      <p><strong>Mother:</strong> VALLURI VISALAKSHI | 6301244329</p>
    </div>

  </div>

</section>


    <!-- HOSTEL -->
    <section id="hostel" class="page" style="display:none" aria-labelledby="hostelTitle">
      <div class="card">
        <h3 id="hostelTitle" class="section-title">Hostel Details</h3>
        <p><strong>Reg No:</strong> 42043</p>
        <p><strong>Block:</strong> TAGORE BHAWAN - C (Non AC)</p>
        <p><strong>Room:</strong> Floor 3 | Room C-361 | Bed 3</p>
        <p><strong>Duration:</strong> 01-07-2025 → 30-06-2026</p>
        <p><strong>City:</strong> EAST GODAVARI</p>
        <p><strong>Address:</strong> HOUSE NO-1-18 MAIN ROAD, NELAPARTHIPADU, DRAKSHARAMAM</p>
      </div>

      <div class="table-container">
        <h4 class="section-title">Recent Gate Passes</h4>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead><tr><th>Sr</th><th>Reason</th><th>Place</th><th>From</th><th>To</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td>1</td><td>Holiday</td><td>HOME</td><td>17-10-2025</td><td>02-11-2025</td><td><span class="badge bg-success">Approved</span></td></tr>
              <tr><td>2</td><td>Personal</td><td>PAVGADH</td><td>19-07-2025</td><td>19-07-2025</td><td><span class="badge bg-success">Approved</span></td></tr>
            </tbody>
          </table>
        </div>

         <!-- NOTE BELOW TABLE -->
  <div style="padding:10px 0; color:#444; font-size:13px; text-align:center;">
      <b>NOTE:</b> Only recent gate passes will be shown.
  </div>
      </div>
    </section>

 <!-- ATTENDANCE -->
<section id="attendance" class="page" style="display:none">

<?php
/* ---------------------
   MANUAL ATTENDANCE DATA
   --------------------- */

// Each date contains slot values: "P" (Present), "A" (Absent), "-" (No class)
// You can add/remove dates and slots anytime.

$attendance = [
    "2025-11-25" => ["P", "P", "P", "P", "P"],     // 5 slots day
    "2025-11-24" => ["P", "P", "P", "-"],          // 4 slot day
    
];
    
// Calculate totals
$totalPresent = 0;
$totalSlots = 0;

foreach ($attendance as $date => $slots) {
    foreach ($slots as $s) {
        if ($s === "P") $totalPresent++;
        if ($s === "P" || $s === "A") $totalSlots++;
    }
}

$percent = $totalSlots > 0 ? round(($totalPresent / $totalSlots) * 100, 2) : 0;

// Maximum slots = 5
$maxSlots = 5;

// Helper to get weekday
function getDayName($date) {
    return date("D", strtotime($date));
}
?>

<style>
.att-card{background:#fff;border-radius:14px;padding:14px;box-shadow:0 4px 12px rgba(0,0,0,0.06);margin-bottom:14px;}
.att-title{font-size:20px;font-weight:700;}
.att-sub{font-size:14px;color:#555;margin-top:2px;}
.att-bar{width:100%;height:9px;background:#e3e3e3;border-radius:10px;margin-top:10px;overflow:hidden;}
.att-bar-fill{height:100%;background:#26c85f;}
.att-percent{text-align:right;font-weight:700;color:#1fa950;margin-top:4px;}

.att-status-box{display:flex;justify-content:space-between;background:#fff;padding:14px;border-radius:12px;
box-shadow:0 2px 10px rgba(0,0,0,0.05);font-size:14px;margin-bottom:14px;}
.att-ok{color:#27ae60;font-weight:600;}
.att-bad{color:#e74c3c;font-weight:600;}
.att-mid{color:#e67e22;font-weight:600;}
.att-info{color:#3498db;font-weight:600;}
.att-legend{font-size:13px;color:#444;margin-bottom:8px;}

.att-table{background:#fff;border-radius:14px;overflow:hidden;
box-shadow:0 2px 12px rgba(0,0,0,0.06);}
.att-header,.att-row{display:flex;padding:12px;border-bottom:1px solid #eee;}
.att-header{background:#f8fafc;font-weight:700;}
.att-col{flex:1;text-align:center;}

.att-slot-p{background:#e7fbe9;color:#27ae60;font-weight:700;border-radius:10px;padding:6px 0;}
.att-slot-a{background:#fdecea;color:#c0392b;font-weight:700;border-radius:10px;padding:6px 0;}
.att-slot-n{background:#f0f0f0;color:#666;border-radius:10px;padding:6px 0;}
</style>


<!-- TOP CARD -->
<div class="att-card">
    <div class="att-title">Sem 4</div>
    <div class="att-sub">A.Y. 2025–26 • Even</div>

    <div class="att-bar">
        <div class="att-bar-fill" style="width: <?= $percent ?>%;"></div>
    </div>

    <div class="att-percent"><?= $percent ?>%</div>
</div>

<!-- STATUS ROW -->
<div class="att-status-box">
    <div class="att-ok">Present: <b><?= $totalPresent ?> / <?= $totalSlots ?></b></div>
    <div class="att-bad">Absent: <b><?= $totalSlots - $totalPresent ?></b></div>
    <div class="att-mid">Pending: <b>0</b></div>
    <div class="att-info">No Attendance: <b>0</b></div>
</div>

<div class="att-legend">P = Present, A = Absent, – = No Lecture/Lab</div>

<!-- DYNAMIC TABLE -->
<div class="att-table">

    <!-- TABLE HEADER -->
    <div class="att-header">
        <div class="att-col">Date</div>
        <?php for ($i=1; $i <= $maxSlots; $i++): ?>
            <div class="att-col">Slot <?= $i ?></div>
        <?php endfor; ?>
    </div>

    <!-- TABLE ROWS -->
    <?php foreach ($attendance as $date => $slots): ?>
        <div class="att-row">

            <!-- DATE + DAY -->
            <div class="att-col">
                <?= date("d-M-y", strtotime($date)) ?><br>
                <span style="font-size:12px;color:#777;"><?= getDayName($date) ?></span>
            </div>

            <!-- SLOT VALUES -->
            <?php for ($i=0; $i < $maxSlots; $i++): ?>

                <div class="att-col">
                    <?php
                    if (!isset($slots[$i])) {
                        echo '<div class="att-slot-n">-</div>';
                    } else if ($slots[$i] === "P") {
                        echo '<div class="att-slot-p">P</div>';
                    } else if ($slots[$i] === "A") {
                        echo '<div class="att-slot-a">A</div>';
                    } else {
                        echo '<div class="att-slot-n">-</div>';
                    }
                    ?>
                </div>

            <?php endfor; ?>

        </div>
    <?php endforeach; ?>

</div>

  <!-- SUBJECT WISE ATTENDANCE -->
<br><br>
<h4 class="section-title">Subject Wise Attendance</h4>

<?php
$subjects = [
    "Operating Systems"          => ["present" => 01, "total" => 01],
    "Operating Systems Lab"      => ["present" => 0, "total" => 0],
    "Python"                     => ["present" => 01, "total" => 01],
    "Python Lab"                 => ["present" => 01, "total" => 01],
    "Networking"                 => ["present" => 02, "total" => 02],
    "Networking Lab"             => ["present" => 0, "total" => 0],
    "Software Engineering"       => ["present" => 02, "total" => 02],
    "Software Engineering Lab"   => ["present" => 01, "total" => 01]
];
?>

<style>
.sub-card{
  background:#fff;
  padding:14px;
  border-radius:14px;
  box-shadow:0 3px 10px rgba(0,0,0,0.06);
  margin-bottom:12px;
}
.sub-name{font-size:16px;font-weight:700;margin-bottom:6px;}
.sub-info{font-size:14px;color:#555;}
</style>

<?php foreach($subjects as $name => $data): ?>
<?php
    $present = $data["present"];
    $total   = $data["total"];
    $absent  = $total - $present;
?>

<div class="sub-card">
    <div class="sub-name"><?= $name ?></div>

    <div class="sub-info">
        Present: <b><?= $present ?></b> / <?= $total ?><br>
        Absent: <b><?= $absent ?></b> / <?= $total ?>
    </div>
</div>

<?php endforeach; ?>

</section>   <!-- CLOSE ATTENDANCE SECTION -->

    <!-- RESULTS -->
<section id="results" class="page" style="display:none" aria-labelledby="resTitle">

<style>
.res-card{
  background:#fff;
  padding:14px;
  border-radius:14px;
  box-shadow:0 2px 12px rgba(0,0,0,0.06);
  margin-bottom:14px;
}

.res-table{
  width:100%;
  border-collapse:collapse;
  font-size:14px;
}
.res-table th{
  background:#f0f4f7;
  padding:10px;
  font-weight:700;
  border-bottom:1px solid #ddd;
  text-align:center;
}
.res-table td{
  padding:10px;
  border-bottom:1px solid #eee;
  text-align:center;
}

.result-pass{background:#e8fbe8;color:#1E9D32;font-weight:700;border-radius:6px;padding:4px 6px;}
.result-fail{background:#fde4e4;color:#C62828;font-weight:700;border-radius:6px;padding:4px 6px;}
.result-mid{background:#eef3ff;color:#3454D1;font-weight:700;border-radius:6px;padding:4px 6px;}

.alert-fail{
  background:#ffe5e5;
  color:#c0392b;
  font-weight:600;
  padding:10px 14px;
  border-radius:10px;
  margin-top:10px;
}
.info-box{
  background:#fff;
  padding:14px;
  border-radius:14px;
  box-shadow:0 2px 10px rgba(0,0,0,0.05);
  margin-top:14px;
}
.info-row{
  display:flex;
  justify-content:space-between;
  padding:6px 0;
  font-size:15px;
}
</style>

<div class="res-card">
  <h4 id="resTitle" class="section-title">Semester - 2 Result</h4>

  <!-- TABLE -->
  <div class="table-responsive">
    <table class="res-table">
      <thead>
        <tr>
          <th>Sr</th>
          <th>Code</th>
          <th>Subject</th>
          <th>Credit</th>
          <th>Result</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>1</td>
          <td>303105151</td>
          <td>Computational Thinking for Structured Design-2</td>
          <td>4.00</td>
          <td><span class="result-pass">F2</span></td>
        </tr>

        <tr>
          <td>2</td>
          <td>303105153</td>
          <td>Global Certifications – Azure, AWS, GCP</td>
          <td>2.00</td>
          <td><span class="result-pass">P</span></td>
        </tr>

        <tr>
          <td>3</td>
          <td>303105154</td>
          <td>Mastering Kali Linux and OSINT</td>
          <td>3.00</td>
          <td><span class="result-pass">B-</span></td>
        </tr>

        <tr>
          <td>4</td>
          <td>303107152</td>
          <td>ICT Workshop</td>
          <td>1.00</td>
          <td><span class="result-pass">B+</span></td>
        </tr>

        <tr>
          <td>5</td>
          <td>303191151</td>
          <td>Mathematics-II</td>
          <td>4.00</td>
          <td><span class="result-pass">F2</span></td>
        </tr>

        <tr>
          <td>6</td>
          <td>303191202</td>
          <td>Engineering Physics-II</td>
          <td>4.00</td>
          <td><span class="result-pass">F2</span></td>
        </tr>

        <tr>
          <td>7</td>
          <td>303193152</td>
          <td>Advanced Communication & Technical Writing</td>
          <td>2.00</td>
          <td><span class="result-pass">F2</span></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- FAIL COUNT -->
  <div class="alert-fail">
    ❗ You are failed in 0 subjects
  </div>

  <!-- INFO CARD -->
  <div class="info-box">

    <div class="info-row">
      <span>Seat No:</span>
      <span><b>AF23604</b></span>
    </div>

    <div class="info-row">
      <span>Name:</span>
      <span><b>VALLURI SRI KRISHNA VARDAN</b></span>
    </div>

    <div class="info-row">
      <span>Current Backlog:</span>
      <span><b>0</b></span>
    </div>

    <div class="info-row">
      <span>Total Backlog:</span>
      <span><b>0</b></span>
    </div>

    <div class="info-row">
      <span>SGPA:</span>
      <span><b>6.75</b></span>
    </div>

    <div class="info-row">
      <span>CGPA:</span>
      <span><b>6.92</b></span>
    </div>

  </div>
</div>

</section>


    <!-- FEES -->
    <section id="fees" class="page" style="display:none" aria-labelledby="feesTitle">
      <div class="card">
        <h4 id="feesTitle" class="section-title">Fee Status</h4>
        <div class="alert alert-success mb-0">ALL TUITION,HOSTEL FEES HAVE BEEN CLEARED FOR THE ACADEMIC YEAR 25-26.TO DOWNLOAD FEE RECIEPTS LOGIN TO GNUMS WEB PORTAL..</div>
      </div>
    </section>

    <div class="footer-space"></div>
  </div>
</main>

<script>
/* Elements */
const sidebar = document.getElementById('sidebar');
const openBtn = document.getElementById('openSidebarBtn');
const closeBtn = document.getElementById('closeSidebarBtn');
const overlay = document.getElementById('sidebarOverlay');
const sidebarLinks = sidebar ? sidebar.querySelectorAll('a[data-target]') : [];

/* Safety: if elements missing, do nothing */
function safeAdd(el, ev, fn){ if(el) el.addEventListener(ev,fn); }

/* Mobile detection */
function isMobile(){ return window.innerWidth <= 768; }

/* Open / close */
function openSidebar(){
  if(!sidebar) return;
  sidebar.classList.add('open');
  overlay.classList.add('visible');
  // prevent body scroll while sidebar open
  document.body.style.overflow = 'hidden';
}
function closeSidebar(){
  if(!sidebar) return;
  sidebar.classList.remove('open');
  overlay.classList.remove('visible');
  document.body.style.overflow = '';
}
safeAdd(openBtn,'click', openSidebar);
safeAdd(closeBtn,'click', closeSidebar);
safeAdd(overlay,'click', closeSidebar);

/* Navigate pages and auto-close on mobile */
function openPage(pageId){
  const pages = ['home','student','hostel','attendance','results','fees'];
  pages.forEach(p=>{
    const el = document.getElementById(p);
    if(el) el.style.display = (p === pageId) ? 'block' : 'none';
    const link = document.getElementById('link-'+p);
    if(link) {
      if(p === pageId) link.classList.add('active'); else link.classList.remove('active');
    }
  });
  // ensure viewport top for small screens
  window.scrollTo({top:0,behavior:'smooth'});
  if(isMobile()) closeSidebar();
}

/* attach link handlers (safe) */
sidebarLinks.forEach(link=>{
  safeAdd(link,'click', function(e){
    e.preventDefault();
    const t = this.getAttribute('data-target');
    if(t) openPage(t);
  });
});

/* resize handler: ensure sidebar state consistent */
window.addEventListener('resize', function(){
  if(!isMobile()){
    // desktop-like: ensure overlay hidden and sidebar reset
    overlay.classList.remove('visible');
    if(sidebar) sidebar.classList.remove('open');
    document.body.style.overflow = '';
  } else {
    // mobile default: hide sidebar (but keep previous open state if user opened)
    if(sidebar && !sidebar.classList.contains('open')) {
      overlay.classList.remove('visible');
    }
  }
});

/* Initialize view */
openPage('home');

/* PDF download placeholder */
function downloadResultsPDF(){
  alert("Download PDF: implement export with html2canvas + jsPDF or server-side.");
}
</script>
</body>
</html>
