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
        <div>Student Portal</div>
      </div>
      <div style="display:flex;gap:8px;align-items:center">
        <!-- removed quick links from home as requested -->
        <a href="logout.php" class="btn btn-ghost logout-btn">Logout</a>
      </div>
    </div>

    <!-- HOME (kept home cards) -->
    <section id="home" class="container-stack page" aria-labelledby="homeTitle">
      <div class="card" id="homeContent">
        <h3 id="homeTitle" class="section-title">Dashboard Home</h3>
        <p class="small-muted">Overview</p>

        <div class="home-cards" style="margin-top:10px">
          <div class="home-card">
            <h6>Profile</h6>
            <p>Basic student information</p>
          </div>
          <div class="home-card">
            <h6>Attendance</h6>
            <p>Quick snapshot</p>
          </div>
          <div class="home-card">
            <h6>Hostel</h6>
            <p>Room & passes</p>
          </div>
          <div class="home-card">
            <h6>Results</h6>
            <p>Semester results</p>
          </div>
        </div>
      </div>
    </section>

    <!-- STUDENT -->
    <section id="student" class="page" style="display:none" aria-labelledby="studentTitle">
      <div class="card">
        <h3 id="studentTitle" class="section-title">Student Information</h3>

        <!-- Grid of key-values that wrap responsively -->
        <div class="kv-grid" role="list">
          <div class="kv" role="listitem"><div class="k">Full name</div><div class="v">VALLURI SRI KRISHNA VARDAN</div></div>
          <div class="kv" role="listitem"><div class="k">Roll No</div><div class="v">2403031260215</div></div>
          <div class="kv" role="listitem"><div class="k">Branch</div><div class="v">CSE (3CYBER3)</div></div>
          <div class="kv" role="listitem"><div class="k">DOB</div><div class="v">28-11-2006</div></div>
          <div class="kv" role="listitem"><div class="k">Student Phone</div><div class="v">6281048554</div></div>
          <div class="kv" role="listitem"><div class="k">College Email</div><div class="v">2403031260215@paruluniversity.ac.in</div></div>
          <div class="kv" role="listitem"><div class="k">Personal Email</div><div class="v">krishnavardhan124@gmail.com</div></div>
          <div class="kv" role="listitem"><div class="k">Father</div><div class="v">VALLURI VENKATA KRISHNANANDA CHOWDARY | 9951996671</div></div>
          <div class="kv" role="listitem"><div class="k">Mother</div><div class="v">VALLURI VISALAKSHI | 6301244329</div></div>
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
      </div>
    </section>

    <!-- ATTENDANCE -->
    <section id="attendance" class="page" style="display:none" aria-labelledby="attTitle">
      <div class="table-container">
        <h4 id="attTitle" class="section-title">Attendance Overview</h4>
        <div class="table-responsive">
          <table class="table table-bordered">
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
    <section id="results" class="page" style="display:none" aria-labelledby="resTitle">
      <div class="card text-center">
        <h4 id="resTitle" class="section-title">2nd SEM Result</h4>
        <img src="SEMRESULTSPHOTO.jpg" class="img-fluid rounded mb-3" alt="Result photo" style="max-width:100%">
        <div><button class="btn btn-primary" onclick="downloadResultsPDF()">Download PDF</button></div>
      </div>
    </section>

    <!-- FEES -->
    <section id="fees" class="page" style="display:none" aria-labelledby="feesTitle">
      <div class="card">
        <h4 id="feesTitle" class="section-title">Fee Status</h4>
        <div class="alert alert-success mb-0">All tuition, hostel, and miscellaneous fees have been cleared for the academic year.</div>
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
