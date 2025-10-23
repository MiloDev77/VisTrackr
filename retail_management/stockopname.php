<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stock Opname</title>
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
  <body class="stockname">
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
            <a href="stockopname.php" class="sidebar-link active">
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
        <div class="container-fluid mt-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Stock Opname System</h2>
            <button class="btn btn-primary" id="toggleForm">Add Product</button>
          </div>
          <form class="form-container" id="productForm" action="" method="post">
            <h3>Add New Product</h3>
            <div class="form-row">
              <div class="form-group">
                <label for="productName">Product Name</label>
                <input
                  type="text"
                  id="productName"
                  placeholder="Product Name"
                />
              </div>
              <div class="form-group">
                <label for="productCategory">Category</label>
                <input
                  type="text"
                  id="productCategory"
                  placeholder="Category"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="productStock">Stock Quantity</label>
                <input
                  type="number"
                  id="productStock"
                  placeholder="Stock Quantity"
                />
              </div>
              <div class="form-group">
                <label for="productPrice">Price (Rp)</label>
                <input type="number" id="productPrice" placeholder="Price" />
              </div>
            </div>
            <div class="form-actions">
              <button class="save-btn">Save Product</button>
              <button class="cancel-btn" id="cancelForm">Cancel</button>
            </div>
          </form>
          <h5 class="fw-bold mt-3">Recently Added Products</h5>
          <div
            class="recent-products d-flex flex-wrap gap-3"
            id="recentProducts"
          ></div>
          <div class="card p-3 mt-4 shadow-sm border-0">
            <div class="input-group mb-3">
              <span class="input-group-text bg-light border-0">
                <i class="lni lni-search-2"></i>
              </span>
              <input
                type="text"
                id="searchStock"
                class="form-control border-0"
                placeholder="Search products..."
              />
            </div>
            <div class="table-responsive">
              <table class="table align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="stockTableBody"></tbody>
              </table>
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
