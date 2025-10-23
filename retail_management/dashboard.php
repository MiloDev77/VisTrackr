<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="gambar/logo sederhana.png">
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
      crossorigin="anonymous"
    />
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
  </head>
  <body class="index">
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
            <a href="salesreport.php" class="sidebar-link">
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
        <h2 class="fw-bold mb-4">Dashboard</h2>
        <div class="card shadow-sm mb-3 p-3">
          <h5 class="mb-3">Daily Sales Report</h5>
          <canvas id="salesChart" height="100px"></canvas>
          <div class="bg-body-secondary text-center p-3 mt-3 rounded">
            <h6>Total Sales Today</h6>
            <h3 class="text-primary fw-bold" id="totalSalesNow"></h3>
          </div>
        </div>
        <div class="d-flex flex-wrap gap-3 ">
          <div class="card flex-fill p-3 shadow-sm">
            <h3 class="fw-bold" id="totalTransaksiNow"></h3>
            <p class="text-primary mb-1">Transactions Today</p>
          </div>
          <div class="card flex-fill p-3 shadow-sm">
            <h3 class="fw-bold" id="averageSalesNow"></h3>
            <p class="text-primary mb-1">Average Transaction</p>
          </div>
        </div>
        <div class="d-flex flex-wrap gap-3 mt-3">
          <div class="card flex-fill p-3 shadow-sm">
            <h3 class="fw-bold" id="productInStock"></h3>
            <p class="text-primary mb-1">Product Types in Stock</p>
          </div>
          <div class="card flex-fill p-3 shadow-sm">
            <h3 class="fw-bold" id="totalStockNow"></h3>
            <p class="text-primary mb-1">Total Products Stock</p>
          </div>
          <div class="card flex-fill p-3 shadow-sm">
            <h3 class="fw-bold" id="totalSoldNow"></h3>
            <p class="text-primary mb-1">Total Products Sold</p>
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="api/jquery3.7.1.js"></script>
    <script src="script.js"></script>
  </body>
</html>
