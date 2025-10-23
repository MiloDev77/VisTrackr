<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sales Report</title>
    <link rel="icon" type="image/x-icon" href="gambar/logo sederhana.png">
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      crossorigin="anonymous"
    />
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
  </head>
  <body class="report">
    <div class="wrapper">
      <aside id="sidebar">
        <div class="d-flex">
          <button id="toggle-btn" type="button">
            <p class="logo">VT</p>
          </button>
          <div class="sidebar-logo">
            <a href="#">VisTrackr</a>
          </div>
        </div>
        <ul class="sidebar-nav">
          <li class="sidebar-item">
            <a href="dashboard.php" class="sidebar-link">
              <i class="lni lni-dashboard-square-1"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="salesreport.php" class="sidebar-link active">
              <i class="lni lni-bar-chart-4"></i>
              <span>Sales Report</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="cashier.php" class="sidebar-link">
              <i class="lni lni-cart-2"></i>
              <span>Cashier</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="stockopname.php" class="sidebar-link">
              <i class="lni lni-notebook-1"></i>
              <span>Stock OpName</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="index.php" class="sidebar-link">
              <i class="lni lni-exit"></i>
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </aside>
      <div class="main p-3 bg-light">
        <h1 class="fw-bold mb-4">Sales Report</h1>
        <div class="card p-4 shadow-sm mb-4">
          <div class="navbar">
            <div class="nav-btn active" id="weeklyBtn">Daily</div>
            <div class="nav-btn" id="monthlyBtn">Weekly</div>
          </div>
          <div class="content">
            <div class="container show" id="weeklyContainer">
              <canvas id="weeklySalesChart" height="100"></canvas>
              <div class="d-flex flex-wrap gap-3 mt-4">
                <div class="p-3 flex-fill bg-light rounded">
                  <p class="text-secondary mb-1 fw-semibold">
                    Total Products Sold
                  </p>
                  <h3 class="fw-bold text-primary mb-0" id="totalProductSoldWeekly"></h3>
                </div>
                <div class="p-3 flex-fill bg-light rounded">
                  <p class="text-secondary mb-1 fw-semibold">
                    Average Daily Sales
                  </p>
                  <h3 class="fw-bold text-primary mb-0" id="averageSalesWeek"></h3>
                </div>

                <div class="p-3 flex-fill bg-light rounded">
                  <p class="text-secondary mb-1 fw-semibold">
                    Total Transactions
                  </p>
                  <h3 class="fw-bold text-primary mb-0" id="totalTransaksiDaily"></h3>
                </div>
              </div>
            </div>
            <div class="container" id="monthlyContainer">
              <canvas id="monthlySalesChart" height="100"></canvas>
              <div class="d-flex flex-wrap justify-content-between align-items-stretch gap-3 mt-4">
                <div class="flex-fill bg-light rounded shadow-sm p-3 d-flex flex-column" style="min-width: 250px;">
                  <p class="text-secondary mb-1 fw-semibold">Total Products Sold</p>
                  <h3 class="fw-bold text-primary mb-0" id="totalProductSoldMonthly"></h3>
                </div>
                <div class="flex-fill bg-light rounded shadow-sm p-3 d-flex flex-column" style="min-width: 250px;">
                  <p class="text-secondary mb-1 fw-semibold">Average Weekly Sales</p>
                  <h3 class="fw-bold text-primary mb-0" id="averageSalesMonth"></h3>
                </div>
                <div class="flex-fill bg-light rounded shadow-sm p-3 d-flex flex-column" style="min-width: 250px;">
                  <p class="text-secondary mb-1 fw-semibold">Total Transactions</p>
                  <h3 class="fw-bold text-primary mb-0" id="totalTransactionWeek"></h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="infotambahan">
          <div class="isikartu aktif" id="infoDaily">
            <div class="bg-white shadow text-center p-3 mt-3 rounded w-100">
              <h6>Total Sales This Week</h6>
              <h3 class="text-primary fw-bold" id="totalSalesWeek"></h3>
            </div>
          </div>
          <div class="isikartu" id="infoWeekly">
            <div class="bg-white shadow text-center p-3 mt-3 rounded w-100">
              <h6>Total Sales This Month</h6>
              <h3 class="text-primary fw-bold" id="totalSalesMonth"></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="api/jquery3.7.1.js"></script>
    <script src="script.js"></script>
  </body>
</html>
