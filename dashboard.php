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
  <title>Student Dashboard (Mobile-first)</title>

  <!-- Inter font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap (kept for utilities) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    /* ---------- global, mobile-first ---------- */
    *, *::before, *::after { box-sizing: border-box; }
    html,body { height: 100%; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
    body {
      font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      color: #0f1724;
      background: #f3f4f6;
      overflow-x: hidden; /* prevent horizontal scroll */
    }

    /* use the uploaded college photo as background (mobile first) */
    .app-background {
      background-image: url('/mnt/data/e0739b2c-67d4-438c-a089-96b469d1c723.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
    }

    /* translucent sheet over background for readability */
    .app-background::before{
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(255,255,255,0.88);
      z-index: 0;
      pointer-events: none;
    }

    /* container for content so it's above the overlay */
    .app {
      position: relative;
      z-index: 1;
      min-height: 100vh;
      padding: 14px;
    }

    /* topbar */
    .topbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      background: rgba(255,255,255,0.96);
      padding: 10px 12px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(15,23,42,0.06);
    }
    .topbar .title { font-weight: 700; font-size: 16px; }
    .topbar .email { color: #6b7280; font-size: 13px; }

    /* mobile toggle button */
    .btn-toggle {
      background: transparent;
      border: 0;
      font-size: 20px;
      padding: 6px;
      color: #0b3a8c;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    /* layout: mobile-first single column */
    .stack { display: block; gap: 12px; }

    /* cards */
    .card-panel {
      background: rgba(255,255,255,0.96);
      padding: 12px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(2,6,23,0.04);
      margin-bottom: 12px;
    }

    .profile-row { display:flex; gap:12px; align-items:center; }
    .profile-row img { width:84px; height:84px; object-fit:cover; border-radius:12px; border:2px solid #e6e9ee; }

    .section-title { font-weight:700; font-size:15px; margin-bottom:8px; }

    /* responsive table wrapper (prevents horizontal page scroll) */
    .table-scroll { width:100%; overflow:auto; -webkit-overflow-scrolling: touch; border-radius:10px; }

    .table-simple { min-width:700px; } /* table inner min width so it scrolls horizontally within wrapper */

    /* sidebar (overlay style on mobile) */
    :root { --sidebar-width: 300px; }
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      bottom: 0;
      width: var(--sidebar-width);
      max-width: 86%;
      transform: translateX(-110%);
      transition: transform .26s cubic-bezier(.2,.9,.2,1);
      background: #ffffff;
      z-index: 2200;
      padding: 12px;
      box-shadow: 8px 0 30px rgba(2,6,23,0.12);
      overflow-y: auto;
    }
    .sidebar.open { transform: translateX(0); }
    .sidebar .close-inline {
      display:flex; justify-content:flex-end;
    }
    .sidebar .close-inline button {
      border: 0; background: transparent; font-size:20px; cursor:pointer;
    }
    .sidebar .nav-link {
      display:block; padding:12px 10px; margin:8px 4px; border-radius:10px; color:#111827; text-decoration:none; font-weight:600;
    }
    .sidebar .nav-link.active, .sidebar .nav-link:hover { background:#f1f5f9; color:#0b3a8c; }

    /* overlay behind sidebar */
    .overlay {
      position: fixed; inset: 0; z-index: 2100; background: rgba(0,0,0,0.35); display:none;
    }
    .overlay.visible { display:block; }

    /* footer / logout in sidebar */
    .sidebar-footer { margin-top:18px; padding:10px; border-top:1px solid #eef2f7; }

    /* ===== desktop adjustments (wider screens) ===== */
    @media(min-width: 769px) {
      .sidebar { position: relative; transform: translateX(0); width:220px; max-width:220px; box-shadow:none; }
      .overlay { display:none !important; }
      .app { margin-left: 220px; padding:28px; }
      .topbar { padding:14px 18px; }
      .card-panel { padding:18px; }
      .stack-row { display:flex; gap:16px; }
      .stack-row .col { flex:1; }
      .table-simple { min-width:unset; }
    }
  </style>
</head>
<body>

  <div class="app-background">
    <div class="app">

      <!-- SIDEBAR (overlay on mobile, static on desktop) -->
      <nav id="appSidebar" class="sidebar" aria-label="Main navigation">
        <div class="close-inline">
          <button id="closeSidebarBtn" aria-label="Close sidebar"><i class="bi bi-x-lg"></i></button>
        </div>

        <div style="padding:6px 6px 12px 6px;">
          <div style="font-weight:700;font-size:18px;padding:6px 4px;">Student Portal</div>
          <hr style="border:none;border-top:1px solid #eef2f7;margin:8px 0;">
          <a href="#" class="nav-link active" data-target="home" id="link-home">Dashboard Home</a>
          <a href="#" class="nav-link" data-target="student" id="link-student">Student Info</a>
          <a href="#" class="nav-link" data-target="hostel" id="link-hostel">Hostel</a>
          <a href="#" class="nav-link" data-target="attendance" id="link-attendance">Attendance</a>
          <a href="#" class="nav-link" data-target="results" id="link-results">Results</a>
          <a href="#" class="nav-link" data-target="fees" id="link-fees">Fees</a>

          <div class="sidebar-footer">
            <div style="font-size:13px;color:#6b7280;">Logged in as</div>
            <div style="font-weight:600;margin-top:6px;font-size:14px;">2403031260215@paruluniversity.ac.in</div>
            <div style="margin-top:10px;">
              <a href="logout.php" class="btn btn-outline-secondary btn-sm w-100">Logout</a>
            </div>
          </div>
        </div>
      </nav>

      <!-- overlay for mobile -->
      <div id="sidebarOverlay" class="overlay" tabindex="-1" aria-hidden="true"></div>

      <!-- MAIN CONTENT -->
      <header class="topbar" role="banner">
        <div style="display:flex;align-items:center;gap:10px;">
          <button id="openSidebarBtn" class="btn-toggle" aria-label="Open menu"><i class="bi bi-list"></i></button>
          <div class="title">Welcome, VALLURI SRI KRISHNA VARDAN</div>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
          <div class="email">2403031260215@paruluniversity.ac.in</div>
        </div>
      </header>

      <main>

        <!-- HOME (default) -->
        <section id="home" class="stack page" aria-labelledby="homeTitle">
          <div class="card-panel" role="region" aria-labelledby="homeTitle">
            <div id="homeTitle" class="section-title">Profile & Snapshot</div>
            <div style="display:flex;align-items:center;gap:12px;">
              <div style="flex:1;">
                <div style="font-weight:700;">VALLURI SRI KRISHNA VARDAN</div>
                <div style="color:#6b7280;font-size:13px;margin-top:4px;">Roll No: 2403031260215 | CSE (3CYBER3)</div>
                <div style="margin-top:10px;color:#111827;font-weight:600;">Attendance: 94%</div>
                <div style="margin-top:6px;color:#6b7280;font-size:13px;">Hostel: TAGORE BHAWAN - C (C-361)</div>
              </div>
              <div>
                <img src="profile.jpg" alt="profile" style="width:86px;height:86px;border-radius:12px;border:2px solid #e6e9ee;object-fit:cover;">
              </div>
            </div>
          </div>

          <div class="card-panel">
            <div class="section-title">Quick Actions</div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
              <button class="btn btn-primary btn-sm">View Results</button>
              <button class="btn btn-outline-primary btn-sm">Download Fee Receipt</button>
              <button class="btn btn-outline-secondary btn-sm">Apply Gate Pass</button>
            </div>
          </div>
        </section>

        <!-- STUDENT -->
        <section id="student" class="page" style="display:none;">
          <div class="card-panel">
            <div class="section-title">Student Information</div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
              <div style="background:transparent;">
                <div style="color:#6b7280;font-size:13px;">DOB</div>
                <div style="font-weight:600;">28-11-2006</div>
              </div>
              <div>
                <div style="color:#6b7280;font-size:13px;">Student Phone</div>
                <div style="font-weight:600;">6281048554</div>
              </div>
              <div>
                <div style="color:#6b7280;font-size:13px;">College Email</div>
                <div style="font-weight:600;">2403031260215@paruluniversity.ac.in</div>
              </div>
              <div>
                <div style="color:#6b7280;font-size:13px;">Personal Email</div>
                <div style="font-weight:600;">krishnavardhan124@gmail.com</div>
              </div>
            </div>

            <div style="margin-top:12px;">
              <div style="font-weight:700;margin-bottom:6px;">Parents / Guardian</div>
              <div><strong>Father:</strong> VALLURI VENKATA KRISHNANANDA CHOWDARY | 9951996671</div>
              <div><strong>Mother:</strong> VALLURI VISALAKSHI | 6301244329</div>
            </div>
          </div>
        </section>

        <!-- HOSTEL -->
        <section id="hostel" class="page" style="display:none;">
          <div class="card-panel">
            <div class="section-title">Hostel Details</div>
            <div><strong>Reg No:</strong> 42043</div>
            <div><strong>Block:</strong> TAGORE BHAWAN - C (Non AC)</div>
            <div><strong>Room:</strong> Floor 3 | Room C-361 | Bed 3</div>
            <div><strong>Duration:</strong> 01-07-2025 → 30-06-2026</div>
            <div><strong>City:</strong> EAST GODAVARI</div>
            <div><strong>Address:</strong> HOUSE NO-1-18 MAIN ROAD, NELAPARTHIPADU, DRAKSHARAMAM</div>
          </div>

          <div class="table-container">
            <div class="section-title">Recent Gate Passes</div>
            <div class="table-scroll" role="region" aria-label="Gate passes table">
              <table class="table table-bordered table-simple">
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
            <div class="table-scroll" role="region" aria-label="Attendance table">
              <table class="table table-bordered table-simple text-center">
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
          <div class="card-panel text-center">
            <div class="section-title">2nd SEM Result</div>
            <img src="SEMRESULTSPHOTO.jpg" alt="result" style="max-width:100%;height:auto;border-radius:10px;border:1px solid #e6e9ee;">
            <div style="margin-top:10px;"><button class="btn btn-primary btn-sm" onclick="downloadResultsPDF()">Download PDF</button></div>
          </div>
        </section>

        <!-- FEES -->
        <section id="fees" class="page" style="display:none;">
          <div class="card-panel">
            <div class="section-title">Fee Status</div>
            <div class="alert alert-success mb-0">All tuition, hostel, and miscellaneous fees have been cleared for the academic year.</div>
          </div>
        </section>

      </main>
    </div>
  </div>

<script>
  /* Elements (null-safe) */
  const sidebar = document.getElementById('appSidebar');
  const openSidebarBtn = document.getElementById('openSidebarBtn');
  const closeSidebarBtn = document.getElementById('closeSidebarBtn');
  const overlay = document.getElementById('sidebarOverlay');
  const sidebarLinks = sidebar ? sidebar.querySelectorAll('a[data-target]') : [];

  function isMobile(){ return window.innerWidth <= 768; }

  function openSidebar(){
    if(!sidebar) return;
    sidebar.classList.add('open');
    if(overlay) overlay.classList.add('visible');
    // prevent body scroll when sidebar open on mobile
    if(isMobile()) document.body.style.overflow = 'hidden';
  }

  function closeSidebar(){
    if(!sidebar) return;
    sidebar.classList.remove('open');
    if(overlay) overlay.classList.remove('visible');
    document.body.style.overflow = '';
  }

  function toggleSidebar(){
    if(!sidebar) return;
    if(sidebar.classList.contains('open')) closeSidebar(); else openSidebar();
  }

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
    // close sidebar on mobile after selecting
    if(isMobile()) closeSidebar();
    // ensure top of content visible (helpful on small screens)
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  /* attach events safely */
  if(openSidebarBtn) openSidebarBtn.addEventListener('click', openSidebar);
  if(closeSidebarBtn) closeSidebarBtn.addEventListener('click', closeSidebar);
  if(overlay) overlay.addEventListener('click', closeSidebar);
  sidebarLinks.forEach(link=>{
    link.addEventListener('click', function(e){
      e.preventDefault();
      const t = this.getAttribute('data-target');
      if(t) openPage(t);
    });
  });

  /* handle resize: ensure sidebar/overlay states are correct when switching between mobile/desktop */
  window.addEventListener('resize', function(){
    if(!isMobile()){
      // desktop: always show sidebar (no overlay)
      if(sidebar) sidebar.classList.remove('open');
      if(overlay) overlay.classList.remove('visible');
      document.body.style.overflow = '';
    } else {
      // mobile default: hide sidebar (unless opened by user)
      if(sidebar && !sidebar.classList.contains('open')) {
        sidebar.classList.remove('open');
        if(overlay) overlay.classList.remove('visible');
      }
    }
  });

  // initialise
  openPage('home');

  /* placeholder for PDF download - implement as needed */
  function downloadResultsPDF(){
    alert('Download PDF not implemented in this template. Integrate html2canvas + jsPDF or server-side export.');
  }
</script>

</body>
</html>
