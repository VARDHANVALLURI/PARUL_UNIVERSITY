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
<title>Student Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body{margin:0;padding:0;font-family:'Inter',sans-serif;background:#f4f6fb;}
header{
  background:#000;
  color:#fff;
  padding:22px 14px;
  text-align:center;
  border-bottom-left-radius:24px;
  border-bottom-right-radius:24px;
}
.profile-photo{
  width:95px;height:95px;border-radius:50%;border:3px solid #fff;object-fit:cover;margin-top:8px;
}

.menu-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:16px;
  padding:18px;
}

.menu-btn{
  background:#fff;
  border-radius:18px;
  padding:16px 8px;
  text-align:center;
  font-weight:600;
  font-size:14px;
  box-shadow:0 4px 14px rgba(0,0,0,0.07);
  cursor:pointer;
}

.menu-btn i{
  font-size:26px;
  margin-bottom:6px;
}

.page{display:none;padding:16px;}

.back-btn{
  font-size:15px;
  margin-bottom:12px;
  cursor:pointer;
  font-weight:600;
  display:flex;
  align-items:center;
  gap:6px;
}
</style>
</head>
<body>

<!-- HEADER -->
<header>
  <img src="your_profile_small.jpg" class="profile-photo">
  <h4 class="mt-2 fw-bold">VALLURI SRI KRISHNA VARDAN</h4>
  <div style="font-size:13px;color:#cfcfcf;">CSE CYBER SECURITY • 4th SEM • CSE-CYBER3</div>
</header>

<!-- HOME MENU GRID -->
<section id="home" class="page" style="display:block;">
  <div class="menu-grid">

    <div class="menu-btn" onclick="openPage('attendance')" style="color:#0056d6;">
      <i class="bi bi-clipboard2-check"></i><br>Attendance
    </div>

    <div class="menu-btn" onclick="openPage('results')" style="color:#ff7a00;">
      <i class="bi bi-bar-chart"></i><br>Results
    </div>

    <div class="menu-btn" onclick="openPage('fees')" style="color:#28a745;">
      <i class="bi bi-cash-coin"></i><br>Fees
    </div>

    <div class="menu-btn" onclick="openPage('student')" style="color:#6f42c1;">
      <i class="bi bi-person-vcard"></i><br>Student Info
    </div>

    <div class="menu-btn" onclick="openPage('hostel')" style="color:#0db2b5;">
      <i class="bi bi-building"></i><br>Hostel
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
