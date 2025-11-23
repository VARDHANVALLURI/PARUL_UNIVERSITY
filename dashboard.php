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
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
<title>Student Dashboard (Mobile)</title>

<!-- Bootstrap (only for utilities) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons & Inter font -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ===== GLOBAL & MOBILE-FIRST ===== */
* { box-sizing: border-box; }
html,body { height: 100%; margin: 0; padding: 0; overflow-x: hidden; -webkit-text-size-adjust: 100%; }
body {
  font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
  background: #f4f6f9;
  color: #0b1220;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* ===== BACKGROUND IMAGE (dashboard only) =====
   Using the uploaded file path (server local). If deployed, ensure this file path is available on the server.
*/
.content {
  min-height: 100vh;
  background-image: url('/mnt/data/e0739b2c-67d4-438c-a089-96b469d1c723.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position: relative;
  padding: 16px;
}

/* translucent page overlay so text is readable on background */
.content::before {
  content: "";
  position: fixed;
  inset: 0;
  background: rgba(255,255,255,0.88);
  z-index: 0;
  pointer-events: none;
}

/* ensure inner content sits above overlay */
.content-inner { position: relative; z-index: 1; }

/* ===== SIDEBAR (mobile drawer) ===== */
:root { --sidebar-width: 84%; } /* mobile drawer size (percentage) */
.drawer {
  position: fixed;
  top: 0;
  left: -100%;
  width: var(--sidebar-width);
  max-width: 420px;
  height: 100vh;
  background: #ffffff;
  box-shadow: 8px 0 30px rgba(2,6,23,0.12);
  transition: transform .28s cubic-bezier(.2,.9,.2,1), left .28s ease;
  transform: translateX(0);
  z-index: 2200;
  display: flex;
  flex-direction: column;
  padding: 14px 12px;
  overflow-y: auto;
  -webkit-overflow-scrolling: touch;
}

/* closed/hidden state */
.drawer.hidden { transform: translateX(-120%); left: 0; }

/* visible/open state */
.drawer.open { transform: translateX(0); left: 0; }

/* close control inside drawer */
.drawer .header {
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:8px;
  margin-bottom:8px;
}
.drawer .close-btn {
  background: transparent;
  border: none;
  font-size: 20px;
  color: #374151;
  padding: 6px;
}

/* drawer links */
.drawer a {
  display:block;
  padding: 12px 14px;
  margin: 6px 6px;
  border-radius: 10px;
  text-decoration: none;
  color: #0f1724;
  font-weight:600;
  transition: background .12s ease, transform .08s ease;
}
.drawer a.active { background: #eef6ff; color: #0546c8; transform: translateX(2px); }
.drawer a:active { transform: translateX(0); }

/* overlay behind drawer */
.drawer-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.38);
  z-index: 2100;
  opacity: 0;
  pointer-events: none;
  transition: opacity .18s ease;
}
.drawer-overlay.visible { opacity: 1; pointer-events: auto; }

/* ===== TOPBAR (mobile) ===== */
.topbar {
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:12px;
  background: rgba(255,255,255,0.92);
  padding: 12px;
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(15,23,42,0.06);
  margin-bottom: 12px;
  position: relative;
  z-index: 2;
}
.topbar .brand { font-weight:700; font-size:16px; color:#0b1220; }
.topbar .controls { display:flex; gap:8px; align-items:center; }

/* hamburger button */
.btn-hamburger {
  background: transparent;
  border: 0;
  font-size: 22px;
  color: #0b1220;
  padding: 6px;
}

/* logout small */
.btn-logout { font-size:13px; padding:6px 8px; }

/* ===== PAGE CARDS & CONTENT (single column mobile first) ===== */
.card {
  background: rgba(255,255,255,0.96);
  border-radius: 12px;
  padding: 12px;
  box-shadow: 0 8px 26px rgba(2,6,23,0.06);
  margin-bottom: 12px;
  position: relative;
  z-index: 2;
}

/* profile image */
.profile-img {
  width: 110px;
  height: 110px;
  object-fit: cover;
  border-radius: 12px;
  border: 2px solid #e6e9ee;
}

/* small responsive table wrapper (prevents horizontal overflow) */
.table-wrap { overflow:auto; -webkit-overflow-scrolling: touch; }

/* prevent horizontal page scroll */
img, table, .card, .topbar, .drawer { max-width: 100%; }

/* small text & labels */
.label { display:block; color:#6b7280; font-size:13px; margin-bottom:6px; }
.value { font-weight:600; color:#0b1220; font-size:15px; }

/* remove homepage quick links: keep only profile & key info on home */

/* ===== Accessibility focus states ===== */
a:focus, button:focus { outline: 3px solid rgba(13,110,253,0.18); outline-offset: 2px; }

/* ===== final safety: force no horizontal scroll anywhere ===== */
html, body { overflow-x: hidden !important; }
</style>
</head>
<body>

<!-- DRAWER overlay -->
<div id="drawerOverlay" class="drawer-overlay" aria-hidden="true"></div>

<!-- DRAWER (sidebar replacement for mobile) -->
<nav id="drawer" class="drawer hidden" aria-label="Navigation">
  <div class="header">
    <div style="font-weight:700;font-size:18px;">Student Portal</div>
    <button id="closeDrawer" class="close-btn" aria-label="Close navigation"><i class="bi bi-x-lg"></i></button>
  </div>

  <a href="#" data-target="home" class="nav-link active">Home</a>
  <a href="#" data-target="student" class="nav-link">Student Info</a>
  <a href="#" data-target="hostel" class="nav-link">Hostel</a>
  <a href="#" data-target="attendance" class="nav-link">Attendance</a>
  <a href="#" data-target="results" class="nav-link">Results</a>
  <a href="#" data-target="fees" class="nav-link">Fees</a>

  <div style="margin-top:12px;padding:12px;">
    <a href="logout.php" class="btn btn-outline-secondary w-100 btn-logout">Logout</a>
  </div>
</nav>

<!-- MAIN content area with dashboard background -->
<main class="content" role="main">
  <div class="content-inner">

    <!-- Topbar -->
    <header class="topbar" role="banner">
      <div style="display:flex;align-items:center;gap:12px;">
        <button id="openDrawer" class="btn-hamburger" aria-label="Open navigation"><i class="bi bi-list"></i></button>
        <div class="brand">Welcome, VALLURI SRI KRISHNA VARDAN</div>
      </div>
      <div class="controls">
        <div style="font-size:13px;color:#6b7280;">2403031260215@paruluniversity.ac.in</div>
        <a href="logout.php" class="btn btn-outline-secondary btn-logout">Logout</a>
      </div>
    </header>

    <!-- HOME (mobile-first: only profile & snapshot; quick links removed) -->
    <section id="home" class="page" aria-labelledby="homeTitle">
      <div class="card" role="region" aria-labelledby="homeTitle">
        <h2 id="homeTitle" style="font-size:16px;margin:0 0 8px 0;">Your Profile</h2>
        <div style="display:flex;gap:12px;align-items:center;">
          <img src="profile.jpg" alt="Profile photo" class="profile-img">
          <div>
            <div style="font-weight:700;">VALLURI SRI KRISHNA VARDAN</div>
            <div class="label">Roll</div>
            <div class="value">2403031260215</div>
            <div class="label" style="margin-top:8px;">Branch</div>
            <div class="value">CSE (3CYBER3)</div>
          </div>
        </div>
      </div>

      <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;">
          <div>
            <div class="label">Attendance (snapshot)</div>
            <div class="value">Overall 94%</div>
          </div>
          <div style="width:48%;">
            <div class="progress" style="height:10px;border-radius:8px;overflow:hidden;background:#eef2ff;">
              <div class="progress-bar" role="progressbar" style="width:94%;background:#0d6efd;" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- STUDENT INFO -->
    <section id="student" class="page" style="display:none;" aria-labelledby="studentTitle">
      <div class="card">
        <h3 id="studentTitle" class="section-title">Student Information</h3>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
          <div>
            <div class="label">Date of Birth</div>
            <div class="value">28-11-2006</div>
          </div>
          <div>
            <div class="label">Student Phone</div>
            <div class="value">6281048554</div>
          </div>
          <div>
            <div class="label">College Email</div>
            <div class="value">2403031260215@paruluniversity.ac.in</div>
          </div>
          <div>
            <div class="label">Personal Email</div>
            <div class="value">krishnavardhan124@gmail.com</div>
          </div>
        </div>

        <div style="margin-top:12px;">
          <div class="label">Parents</div>
          <div class="value">Father: VALLURI VENKATA KRISHNANANDA CHOWDARY | 9951996671</div>
          <div class="value" style="margin-top:6px;">Mother: VALLURI VISALAKSHI | 6301244329</div>
        </div>
      </div>
    </section>

    <!-- HOSTEL -->
    <section id="hostel" class="page" style="display:none;">
      <div class="card">
        <h3 class="section-title">Hostel Details</h3>
        <p><strong>Reg No:</strong> 42043</p>
        <p><strong>Block:</strong> TAGORE BHAWAN - C (Non AC)</p>
        <p><strong>Room:</strong> Floor 3 | Room C-361 | Bed 3</p>
        <p><strong>Duration:</strong> 01-07-2025 → 30-06-2026</p>
        <p><strong>Address:</strong> HOUSE NO-1-18 MAIN ROAD, NELAPARTHIPADU, DRAKSHARAMAM</p>
      </div>

      <div class="table-container">
        <h4 class="section-title">Recent Gate Passes</h4>
        <div class="table-wrap">
          <table class="table table-bordered text-center">
            <thead><tr><th>Sr</th><th>Reason</th><th>Place</th><th>From</th><th>To</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td>1</td><td>Holiday</td><td>HOME</td><td>17-10-2025</td><td>02-11-2025</td><td><span class="badge bg-success">Approved</span></td></tr>
              <tr><td>2</td><td>Personal Reason</td><td>PAVGADH</td><td>19-07-2025</td><td>19-07-2025</td><td><span class="badge bg-success">Approved</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- ATTENDANCE -->
    <section id="attendance" class="page" style="display:none;">
      <div class="table-container">
        <h4 class="section-title">Attendance Overview</h4>
        <div class="table-wrap">
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
      <div class="card text-center">
        <h4 class="section-title">2nd SEM Result</h4>
        <img src="SEMRESULTSPHOTO.jpg" alt="Results" class="img-fluid rounded mb-3" style="max-width:100%;">
        <div><button class="btn btn-primary" onclick="alert('Implement PDF export if needed')">Download PDF</button></div>
      </div>
    </section>

    <!-- FEES -->
    <section id="fees" class="page" style="display:none;">
      <div class="card">
        <h4 class="section-title">Fee Status</h4>
        <div class="alert alert-success mb-0">All tuition, hostel, and miscellaneous fees have been cleared for the academic year.</div>
      </div>
    </section>

  </div><!-- content-inner -->
</main>

<script>
/* ===== Elements ===== */
const drawer = document.getElementById('drawer');
const openDrawerBtn = document.getElementById('openDrawer');
const closeDrawerBtn = document.getElementById('closeDrawer');
const overlay = document.getElementById('drawerOverlay');
const drawerLinks = document.querySelectorAll('#drawer .nav-link');

/* ===== Helpers ===== */
function isMobile(){ return window.innerWidth <= 768; }

/* ===== Drawer controls ===== */
function openDrawer(){
  drawer.classList.remove('hidden');
  drawer.classList.add('open');
  overlay.classList.add('visible');
  overlay.setAttribute('aria-hidden', 'false');
}
function closeDrawer(){
  drawer.classList.remove('open');
  drawer.classList.add('hidden');
  overlay.classList.remove('visible');
  overlay.setAttribute('aria-hidden', 'true');
}
function toggleDrawer(){
  if(drawer.classList.contains('open')) closeDrawer(); else openDrawer();
}

/* attach events */
if(openDrawerBtn) openDrawerBtn.addEventListener('click', openDrawer);
if(closeDrawerBtn) closeDrawerBtn.addEventListener('click', closeDrawer);
if(overlay) overlay.addEventListener('click', closeDrawer);

/* clicking a link shows page and closes drawer on mobile */
drawerLinks.forEach(a=>{
  a.addEventListener('click', function(e){
    e.preventDefault();
    const target = this.getAttribute('data-target');
    if(target) showSection(target);
    // update active link styles
    drawerLinks.forEach(x=>x.classList.remove('active'));
    this.classList.add('active');
    if(isMobile()) closeDrawer();
  });
});

/* ===== Sections handling ===== */
const sections = ['home','student','hostel','attendance','results','fees'];
function showSection(id){
  sections.forEach(s=>{
    const el = document.getElementById(s);
    if(!el) return;
    el.style.display = (s === id) ? 'block' : 'none';
  });
  // scroll top to show section properly without horizontal shift
  window.scrollTo({top:0, left:0, behavior:'instant'});
}

/* initialize */
showSection('home');

/* ensure no horizontal overflow on resize */
window.addEventListener('resize', function(){
  document.documentElement.style.overflowX = 'hidden';
  document.body.style.overflowX = 'hidden';
  if(!isMobile()){
    // ensure drawer is hidden on desktop (desktop not used in this mobile-only layout)
    closeDrawer();
  }
});

/* Accessibility: allow ESC to close drawer */
document.addEventListener('keydown', function(e){
  if(e.key === 'Escape'){ closeDrawer(); }
});
</script>
</body>
</html>
