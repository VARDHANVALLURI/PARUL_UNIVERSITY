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
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Student Dashboard</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Inter font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* --- Global --- */
:root{
  --sidebar-width: 250px;
}
html,body{height:100%;}
body{
  margin:0;
  font-family:'Inter',system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial;
  background:#f1f3f6;
  color:#111827;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
  overflow-x:hidden;
}

/* --- Layout --- */
.layout{display:flex;min-height:100vh;}

/* --- Sidebar --- */
.sidebar{
  width:var(--sidebar-width);
  background:#ffffff;
  border-right:1px solid #e6e9ee;
  padding:18px 12px;
  box-sizing:border-box;
  flex-shrink:0;
  position:relative;
  z-index:2200;
  transition:transform .28s ease;
}
.sidebar .logo{font-size:20px;font-weight:700;padding:0 12px;margin-bottom:14px;}
.sidebar .close-btn {
  display:none; /* shown on mobile */
  background:transparent;
  border:0;
  font-size:22px;
  color:#374151;
  padding:8px 12px;
  cursor:pointer;
}

/* sidebar links */
.sidebar a {
  display:block;
  padding:10px 16px;
  margin:6px 8px;
  color:#1f2937;
  text-decoration:none;
  border-left:4px solid transparent;
  border-radius:8px;
  transition:all .18s ease;
  font-weight:600;
}
.sidebar a:hover{background:#f3f6fb;}
.sidebar a.active{background:#eef6ff;border-left-color:#0d6efd;color:#0b3a8c;}

/* --- Content area --- */
.content{
  flex:1;
  padding:22px;
  position:relative;
  overflow:auto;
  min-height:100vh;
  /* background image (dashboard only) */
  background-image: url('college_photo.jpg'); /* replace file if needed */
  background-size:cover;
  background-position:center;
  background-repeat:no-repeat;
}

/* translucent overlay over the background for readability */
.content::before{
  content:"";
  position:fixed;
  inset:0;
  background:rgba(255,255,255,0.82);
  z-index:1;
  pointer-events:none;
}

/* inner content area sits above the translucent overlay */
.content-inner{
  position:relative;
  z-index:2;
}

/* --- Topbar --- */
.topbar{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:12px;
  background:rgba(255,255,255,0.9);
  backdrop-filter:blur(6px);
  padding:12px 16px;
  border-radius:12px;
  box-shadow:0 6px 18px rgba(15,23,42,0.06);
  margin-bottom:20px;
  z-index:3;
}

/* mobile toggle */
.mobile-toggle{
  display:none;
  background:transparent;
  border:0;
  font-size:22px;
  cursor:pointer;
  color:#0b3a8c;
}

/* --- Cards, tables, typography --- */
.card-box{
  background:rgba(255,255,255,0.95);
  border-radius:12px;
  padding:18px;
  box-shadow:0 6px 20px rgba(15,23,42,0.05);
  margin-bottom:20px;
}
.section-title{font-size:18px;font-weight:700;margin-bottom:12px;}
.profile-pic img{width:140px;border-radius:12px;border:3px solid #e6e9ee;}
.table-container{background:rgba(255,255,255,0.96);padding:14px;border-radius:12px;box-shadow:0 6px 18px rgba(15,23,42,0.04);}

/* --- Sidebar behaviour on mobile --- */
.sidebar.mobile-hidden{
  transform:translateX(calc(-1 * var(--sidebar-width)));
  position:fixed;
  left:0;
  top:0;
  bottom:0;
  height:100%;
  box-shadow:8px 0 30px rgba(2,6,23,0.12);
}
.sidebar.mobile-visible{
  transform:translateX(0);
}

/* overlay (shown when sidebar open on mobile) */
#sidebarOverlay{
  display:none;
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.35);
  z-index:2100;
}

/* show overlay */
#sidebarOverlay.visible{display:block;}

/* show close button inside sidebar on mobile */
@media (max-width: 768px){
  .mobile-toggle{display:inline-block;}
  .sidebar .close-btn{display:block;margin-bottom:6px;}
  .sidebar{padding-top:22px;padding-left:10px;padding-right:10px;}
  .content{
    padding:16px;
    background-attachment:scroll;
  }
  .content::before{background:rgba(255,255,255,0.92);}
}

/* responsive grid helpers */
.row-gap{gap:18px;display:flex;flex-wrap:wrap;}
.col-card{flex:1 1 320px;min-width:240px;max-width:100%;}
</style>
</head>
<body>
<div class="layout">

  <!-- SIDEBAR -->
  <nav id="sidebar" class="sidebar mobile-hidden" aria-label="Main navigation">
    <!-- close button (visible on mobile) -->
    <div style="display:flex;align-items:center;justify-content:space-between;padding:0 6px 8px 6px;">
      <div class="logo">Student Portal</div>
      <button class="close-btn" id="closeSidebarBtn" aria-label="Close sidebar"><i class="bi bi-x-lg"></i></button>
    </div>

    <a href="#" id="link-home" class="active" data-target="home">Dashboard Home</a>
    <a href="#" id="link-student" data-target="student">Student Info</a>
    <a href="#" id="link-hostel" data-target="hostel">Hostel</a>
    <a href="#" id="link-attendance" data-target="attendance">Attendance</a>
    <a href="#" id="link-results" data-target="results">Results</a>
    <a href="#" id="link-fees" data-target="fees">Fees</a>
  </nav>

  <!-- overlay used to close the sidebar on mobile -->
  <div id="sidebarOverlay" role="button" aria-label="Close sidebar overlay"></div>

  <!-- CONTENT -->
  <main class="content">
    <div class="content-inner">

      <!-- topbar with mobile toggle -->
      <div class="topbar">
        <div style="display:flex;align-items:center;gap:12px;">
          <button class="mobile-toggle" id="openSidebarBtn" aria-label="Open sidebar"><i class="bi bi-list"></i></button>
          <div style="font-weight:700;font-size:18px;">Welcome, VALLURI SRI KRISHNA VARDAN</div>
        </div>
        <div style="display:flex;align-items:center;gap:12px;">
          <div style="color:#6b7280;font-size:14px;">2403031260215@paruluniversity.ac.in</div>
          <a href="logout.php" class="btn btn-outline-secondary btn-sm">Logout</a>
        </div>
      </div>

      <!-- HOME -->
      <section id="home" class="page">
        <div class="row-gap">
          <div class="col-card card-box">
            <div style="display:flex;align-items:center;gap:14px;">
              <div style="flex:1">
                <div class="section-title">Profile</div>
                <div class="text-muted">Basic information</div>
                <div style="margin-top:10px;">
                  <strong>VALLURI SRI KRISHNA VARDAN</strong><br>
                  Roll: 2403031260215 | CSE (3CYBER3)
                </div>
              </div>
              <div style="width:120px;text-align:center;">
                <img src="profile.jpg" alt="Profile" style="width:100px;border-radius:10px;border:2px solid #eef2f6;">
              </div>
            </div>
          </div>

          <div class="col-card card-box">
            <div class="section-title">Attendance Snapshot</div>
            <div class="text-muted">Overall percentage (quick view)</div>
            <div style="margin-top:12px;">
              <div class="progress" style="height:14px;">
                <div class="progress-bar" role="progressbar" style="width: 94%;" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100">94%</div>
              </div>
              <small class="text-muted">Improved from last month</small>
            </div>
          </div>

          <div class="col-card card-box">
            <div class="section-title">Hostel</div>
            <div class="text-muted">Room & pass status</div>
            <div style="margin-top:10px;">
              <strong>TAGORE BHAWAN - C</strong><br>
              Room: Floor 3 | C-361 | Bed 3
            </div>
          </div>
        </div>
      </section>

      <!-- STUDENT -->
      <section id="student" class="page" style="display:none;">
        <div class="card-box">
          <div class="section-title">Student Information</div>
          <div class="profile-pic text-center mb-3">
            <img src="profile.jpg" alt="Student">
            <div style="margin-top:10px;font-weight:700;">VALLURI SRI KRISHNA VARDAN</div>
            <div class="text-muted">Roll No: 2403031260215 | CSE (3CYBER3)</div>
          </div>

          <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;">
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
              <div style="font-weight:600;margin-top:6px;">2403031260215@paruluniversity.ac.in</div>
            </div>
            <div class="card-box" style="padding:12px;">
              <div class="text-muted">Personal Email</div>
              <div style="font-weight:600;margin-top:6px;">krishnavardhan124@gmail.com</div>
            </div>
          </div>

          <div style="margin-top:12px;">
            <div class="section-title">Parents / Guardian</div>
            <p><strong>Father:</strong> VALLURI VENKATA KRISHNANANDA CHOWDARY | 9951996671</p>
            <p><strong>Mother:</strong> VALLURI VISALAKSHI | 6301244329</p>
          </div>
        </div>
      </section>

      <!-- HOSTEL -->
      <section id="hostel" class="page" style="display:none;">
        <div class="card-box">
          <div class="section-title">Hostel Details</div>
          <p><strong>Reg No:</strong> 42043</p>
          <p><strong>Block:</strong> TAGORE BHAWAN - C (Non AC)</p>
          <p><strong>Room:</strong> Floor 3 | Room C-361 | Bed 3</p>
          <p><strong>Duration:</strong> 01-07-2025 → 30-06-2026</p>
          <p><strong>City:</strong> EAST GODAVARI</p>
          <p><strong>Address:</strong> HOUSE NO-1-18 MAIN ROAD, NELAPARTHIPADU, DRAKSHARAMAM</p>
        </div>

        <div class="table-container">
          <div class="section-title">Recent Gate Passes</div>
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead><tr><th>Sr</th><th>Reason</th><th>Place</th><th>From</th><th>To</th><th>Status</th></tr></thead>
              <tbody>
                <tr><td>1</td><td>Holiday</td><td>HOME</td><td>17-10-2025 05:00 PM</td><td>02-11-2025 06:00 PM</td><td><span class="badge bg-success">Approved</span></td></tr>
                <tr><td>2</td><td>Personal Reason</td><td>PAVGADH</td><td>19-07-2025</td><td>19-07-2025</td><td><span class="badge bg-success">Approved</span></td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ATTENDANCE -->
      <section id="attendance" class="page" style="display:none;">
        <div class="table-container">
          <div class="section-title">Attendance Overview</div>
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead><tr><th>Sr</th><th>Subject</th><th>Slot</th><th>Conducted</th><th>Present</th><th>Absent</th><th>%</th></tr></thead>
              <tbody>
                <tr><td>1</td><td>Design of Data Structures</td><td>Theory</td><td>28</td><td>26</td><td>2</td><td>98%</td></tr>
                <tr><td>2</td><td>DDS Lab</td><td>Practical</td><td>20</td><td>19</td><td>0</td><td>99%</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- RESULTS -->
      <section id="results" class="page" style="display:none;">
        <div class="card-box text-center">
          <div class="section-title">2nd SEM Result</div>
          <img src="SEMRESULTSPHOTO.jpg" alt="Results" class="img-fluid rounded mb-3" style="max-width:680px;">
          <div><button class="btn btn-primary" onclick="downloadResultsPDF()">Download PDF</button></div>
        </div>
      </section>

      <!-- FEES -->
      <section id="fees" class="page" style="display:none;">
        <div class="card-box">
          <div class="section-title">Fee Status</div>
          <div class="alert alert-success mb-0">All tuition, hostel, and miscellaneous fees have been cleared for the academic year.</div>
        </div>
      </section>

    </div><!-- /.content-inner -->
  </main>
</div>

<!-- scripts -->
<script>
/* elements */
const sidebar = document.getElementById('sidebar');
const openBtn = document.getElementById('openSidebarBtn');
const closeBtn = document.getElementById('closeSidebarBtn');
const overlay = document.getElementById('sidebarOverlay');

let sidebarLinks;

/* load sidebar links safely AFTER page is fully loaded */
document.addEventListener("DOMContentLoaded", () => {
  sidebarLinks = document.querySelectorAll('#sidebar a[data-target]');
  sidebarLinks.forEach(link => {
    link.addEventListener('click', function(e){
      e.preventDefault();
      const target = this.getAttribute('data-target');
      openPage(target);

      // close sidebar on mobile after clicking link
      if (window.innerWidth <= 768) {
        closeSidebar();
      }
    });
  });
});

/* helpers */
function isMobile(){
  return window.innerWidth <= 768;
}

/* open sidebar (mobile) */
function openSidebar(){
  sidebar.classList.add('mobile-visible');
  sidebar.classList.remove('mobile-hidden');
  overlay.classList.add('visible');
}

/* close sidebar (mobile) */
function closeSidebar(){
  sidebar.classList.remove('mobile-visible');
  sidebar.classList.add('mobile-hidden');
  overlay.classList.remove('visible');
}

/* toggle */
function toggleSidebar(){
  if(sidebar.classList.contains('mobile-visible')){
    closeSidebar();
  } else {
    openSidebar();
  }
}

/* open page and close sidebar on mobile */
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
  // if mobile, close sidebar automatically so user sees content
  if(isMobile()) closeSidebar();
}

/* click handlers */
if(openBtn) openBtn.addEventListener('click', openSidebar);
if(closeBtn) closeBtn.addEventListener('click', closeSidebar);
if(overlay) overlay.addEventListener('click', closeSidebar);

/* sidebar links behaviour */
sidebarLinks.forEach(link=>{
  link.addEventListener('click', function(e){
    e.preventDefault();
    const t = this.getAttribute('data-target');
    if(t) openPage(t);
  });
});

/* on resize, ensure sidebar state is correct */
window.addEventListener('resize', function(){
  if(!isMobile()){
    // desktop: ensure sidebar visible and overlay hidden
    sidebar.classList.remove('mobile-hidden');
    sidebar.classList.remove('mobile-visible');
    overlay.classList.remove('visible');
  } else {
    // mobile default: hide sidebar (unless it was explicitly opened)
    if(!sidebar.classList.contains('mobile-visible')){
      sidebar.classList.add('mobile-hidden');
    }
  }
});

/* initialize: show home */
openPage('home');

/* Download results stub (user can replace with actual implementation) */
function downloadResultsPDF(){
  // placeholder: you can integrate html2canvas + jspdf or server side PDF
  alert("Download PDF - implement export (html2canvas + jsPDF) if needed)");
}
</script>

</body>
</html>
