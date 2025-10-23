<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VisTrackr - Retail Management</title>
  <script src="https://kit.fontawesome.com/a2d0cf5a04.js" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      background-color: #fff;
      color: #1f2937;
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 80px;
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
      background: rgba(255, 255, 255, 0.4);
      backdrop-filter: blur(10px);
      z-index: 1000;
      box-sizing: border-box;
    }

    .navbar-left {
    display: flex;
    align-items: center;
    gap: 12px;
    }
    
    .logo-icon {
    background-color: #3b82f6;
    color: #fff;
    font-weight: 700;
    border-radius: 8px;
    padding: 6px 10px;
    font-size: 16px;
    }
    
    .logo-text {
      font-size: 20px;
      font-weight: 600;
      color: #2563eb;
      letter-spacing: 0.5px;
    }

    .btn-dashboard {
      background: #3b82f6;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 500;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .btn-dashboard:hover {
      background: #2563eb;
      transform: translateY(-2px);
    }

    .btn-dashboard:hover {
      background: #2563eb;
    }

    .hero {
      text-align: center;
      padding: 160px 30px 120px;
      background: linear-gradient(to bottom, #f9fafb, #ffffff);
    }

    .hero h1 {
      font-size: 38px;
      color: #1e40af;
      font-weight: 700;
    }

    .hero p {
      max-width: 640px;
      margin: 15px auto 35px;
      color: #4b5563;
      font-size: 17px;
    }

    .btn-primary {
      background: #3b82f6;
      color: #fff;
      padding: 12px 28px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }
      
    .btn-primary:hover {
      background: #2563eb;
    }

    .features {
      text-align: center;
      padding: 80px 40px;
    }

    .features h2 {
      font-size: 28px;
      font-weight: 700;
    }

    .features .subtitle {
      color: #6b7280;
      margin-bottom: 45px;
    }

    .feature-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 30px;
      max-width: 1100px;
      margin: 0 auto;
    }

    .feature-card {
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 25px 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.03);
      transition: all 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 18px rgba(0,0,0,0.07);
    }

    .icon {
      font-size: 26px;
      background: #eff6ff;
      color: #2563eb;
      display: inline-block;
      padding: 10px;
      border-radius: 10px;
      margin-bottom: 15px;
    }

    .why-choose {
      background: #f9fafb;
      padding: 80px 20px;
      text-align: center;
    }

    .why-choose h2 {
      font-size: 26px;
      margin-bottom: 40px;
      font-weight: 700;
    }

    .why-list {
      max-width: 700px;
      margin: 0 auto;
      text-align: left;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .why-item {
      background: white;
      padding: 15px 20px;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .why-item i {
      color: #10b981;
    }

    .footer {
      text-align: center;
      padding: 20px 0;
      font-size: 14px;
      color: #6b7280;
      border-top: 1px solid #e5e7eb;
      background-color: #fff;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="navbar-left">
    <div class="logo-icon">VT</div>
    <span class="logo-text">VisTrackr</span>
  </div>
  <a href="dashboard.php" class="btn-dashboard">
    Go to Dashboard <i class="fas fa-arrow-right"></i>
  </a>
</nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1>Manage Your Retail Business<br>with Confidence</h1>
      <p>
        VisTrackr provides powerful tools to streamline your operations, track inventory,
        manage sales, and gain insights with intelligent forecasting.
      </p>
      <a href="dashboard.php" class="btn-primary">Start Managing Now <i class="fas fa-arrow-right"></i></a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features">
    <h2>Everything You Need in One Place</h2>
    <p class="subtitle">Powerful features designed for modern retail management</p>
    <div class="feature-grid">
      <div class="feature-card">
        <div class="icon"><i class="fas fa-chart-line"></i></div>
        <h3>Smart Dashboard</h3>
        <p>Real-time insights and metrics at your fingertips with intelligent data visualization.</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="fas fa-cubes"></i></div>
        <h3>Stock Management</h3>
        <p>Efficient inventory tracking with automated alerts and stock opname system.</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="fas fa-cash-register"></i></div>
        <h3>Cashier System</h3>
        <p>Fast and reliable POS system for seamless customer transactions.</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="fas fa-chart-bar"></i></div>
        <h3>Sales Reports</h3>
        <p>Comprehensive daily and monthly reports with trend forecasting.</p>
      </div>
    </div>
  </section>

  <!-- Why Choose Section -->
  <section class="why-choose">
    <h2>Why Choose VisTrackr?</h2>
    <div class="why-list">
      <div class="why-item"><i class="fas fa-check-circle"></i> Automated Reporting — Generate detailed reports automatically with beautiful charts.</div>
      <div class="why-item"><i class="fas fa-check-circle"></i> Cash Flow Forecasting — Predict future cash flow based on spending trends.</div>
      <div class="why-item"><i class="fas fa-check-circle"></i> Real-time Updates — Data syncs instantly across devices.</div>
      <div class="why-item"><i class="fas fa-check-circle"></i> Easy to Use — Intuitive interface for all managers.</div>
      <div class="why-item"><i class="fas fa-check-circle"></i> Mobile Optimized — Access from any device anywhere.</div>
    </div>
  </section>

  <footer class="footer">
    <p>© 2025 VisTrackr. All rights reserved.</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
