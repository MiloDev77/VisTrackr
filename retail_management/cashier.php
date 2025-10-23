<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cashier</title>
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
  <body class="cashierr">
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
            <a href="cashier.php" class="sidebar-link active">
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
        <h1 class="fw-semibold mb-4">Cashier System</h1>
        <div class="cashier-container">
          <div class="products-section">
            <h4>Available Products</h4>
            <div class="search-box mb-3">
              <input
                type="text"
                id="search"
                class="form-control"
                placeholder="🔍 Search products..."
              />
            </div>
            <div class="product-grid" id="productList"></div>
          </div>
          <div class="cart-section">
            <h4>🛒 Shopping Cart</h4>
            <div class="cart-items" id="cartItems">Cart is empty</div>
            <div class="total mt-3">
              <span>Total:</span>
              <span id="totalPrice">Rp 0</span>
            </div>
            <div class="cart-buttons mt-3">
              <button
                class="btn btn-primary w-100"
                onclick="completePurchase()"
              >
                Complete Purchase
              </button>
              <button
                class="btn btn-outline-secondary w-100 mt-2"
                id = "cancelTransactionBtn"
              >
                Cancel Transaction
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
      crossorigin="anonymous"
    ></script>
    <script src="api/jquery3.7.1.js"></script>
    <script src="script.js"></script>
  </body>
</html>