const API = {
  getProducts: "api/get_products.php",
  addProduct: "api/add_product.php",
  updateProduct: "api/update_product.php",
  deleteProduct: "api/delete_product.php",
  getTransactions: "api/get_transactions.php",
  addTransaction: "api/add_transactions.php",
  getDashboardData: "api/get_dashboard_data.php",
  getSalesReportData: "api/get_salesreport_data.php",
};

function apiGet(url, data = {}) {
  return $.ajax({ url, method: "GET", dataType: "json", data });
}
function apiPostJson(url, payload = {}) {
  return $.ajax({
    url,
    method: "POST",
    data: JSON.stringify(payload),
    contentType: "application/json",
    dataType: "json",
  });
}

function numberWithSeparator(n) {
  n = parseInt(n || 0, 10);
  return n.toLocaleString("id-ID");
}

function escapeHtml(unsafe) {
  if (unsafe === null || unsafe === undefined) return "";
  return String(unsafe)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}
function showError(err) {
  console.error(err);
  try {
    const msg =
      err.responseJSON?.message || err.statusText || JSON.stringify(err);
    alert("Terjadi error: " + msg);
  } catch (e) {
    alert("Terjadi error, lihat console.");
  }
}

function parseMySQLTimestamp(ts) {
  if (!ts) return null;

  // Ubah format MySQL "2025-10-13 14:33:22" → ISO "2025-10-13T14:33:22"
  const isoString = ts.replace(" ", "T");

  const d = new Date(isoString);

  // Jika masih invalid, coba parse manual
  if (isNaN(d)) {
    const parts = ts.split(/[- :]/).map(Number);
    if (parts.length >= 3) {
      return new Date(
        parts[0],
        parts[1] - 1,
        parts[2],
        parts[3] || 0,
        parts[4] || 0,
        parts[5] || 0
      );
    }
    return null;
  }

  return d;
}

function formatDateLabel(isoDate) {
  if (!isoDate) return "";
  const d = new Date(isoDate);
  if (isNaN(d)) return "";
  const day = d.toLocaleDateString("en-US", { day: "numeric" });
  const month = d.toLocaleDateString("en-US", { month: "short" });
  const weekday = d.toLocaleDateString("en-US", { weekday: "short" });
  return `${month} ${day} (${weekday})`;
}

function formatWeekLabel(createdAt, index) {
  const d = parseMySQLTimestamp(createdAt);
  if (!d || isNaN(d)) return `Week ${index + 1}`;

  const monthName = d.toLocaleString("en-US", { month: "short" });
  return `Week ${index + 1} (${monthName})`;
}

function refreshProducts(callback) {
  $.getJSON(API.getProducts, (data) => {
    productData = data;
    if (callback) callback();
  }).fail((err) => {
    showError(err);
  });
}

let productsCache = [];
let cart = [];

function refreshProducts(cb) {
  apiGet(API.getProducts)
    .done((res) => {
      productsCache = Array.isArray(res) ? res : [];
      if (typeof cb === "function") cb(productsCache);
    })
    .fail((err) => {
      showError(err);
      if (typeof cb === "function") cb(productsCache);
    });
}

function renderProducts(filter = "") {
  const productList = document.getElementById("productList");
  if (!productList) return;
  productList.innerHTML = "<div>Loading products...</div>";
  refreshProducts((products) => {
    productList.innerHTML = "";
    const f = filter.toLowerCase();
    const list = products.filter((p) =>
      (p.nama || "").toLowerCase().includes(f)
    );
    if (!list.length) {
      productList.innerHTML = "<div class='text-muted p-2'>No Product :(</div>";
      return;
    }
    list.forEach((p) => {
      const stok = parseInt(p.stok || 0, 10);
      const card = document.createElement("div");
      card.className = "product-card";
      card.innerHTML = `
        <h5>${escapeHtml(p.nama)}</h5>
        <div class="price">Rp ${numberWithSeparator(p.harga)}</div>
        <div class="stock">Stock: ${stok}</div>
        <button class="btn btn-sm btn-primary" ${
          stok <= 0 ? "disabled" : ""
        } onclick="addToCartById(${p.id})">Add</button>
      `;
      productList.appendChild(card);
    });
  });
}

function addToCartById(id) {
  const prod = productsCache.find((p) => parseInt(p.id) === parseInt(id));
  if (!prod) return alert("The product not found.");
  const stok = parseInt(prod.stok || 0, 10);
  if (stok <= 0) return alert("Out of stock!");

  const existing = cart.find((c) => c.id == id);
  if (existing) {
    if (existing.qty + 1 > stok) return alert("Stock is insufficient..");
    existing.qty++;
  } else {
    cart.push({
      id: prod.id,
      nama: prod.nama,
      price: parseInt(prod.harga || 0, 10),
      qty: 1,
    });
  }
  renderCart();
}

function renderCart() {
  const cartItems = document.getElementById("cartItems");
  const totalPriceEl = document.getElementById("totalPrice");
  if (!cartItems || !totalPriceEl) return;
  cartItems.innerHTML = "";
  if (!cart.length) {
    cartItems.textContent = "Empty Cart";
    totalPriceEl.textContent = "Rp 0";
    return;
  }
  let total = 0;
  cart.forEach((item, i) => {
    const subtotal = item.price * item.qty;
    total += subtotal;
    const div = document.createElement("div");
    div.className = "cart-item";
    div.innerHTML = `
      <span>${escapeHtml(item.nama)} x${item.qty}</span>
      <span>Rp ${numberWithSeparator(subtotal)}</span>
      <div class="cart-controls">
        <button class="btn btn-sm btn-outline-secondary" onclick="changeQty(${i}, -1)">-</button>
        <button class="btn btn-sm btn-outline-secondary" onclick="changeQty(${i}, 1)">+</button>
        <button class="btn btn-sm btn-danger" onclick="removeCartItem(${i})">Delete</button>
      </div>
    `;
    cartItems.appendChild(div);
  });
  totalPriceEl.textContent = "Rp " + numberWithSeparator(total);
}

function changeQty(index, delta) {
  const item = cart[index];
  if (!item) return;
  const prod = productsCache.find((p) => p.id == item.id);
  const stok = prod ? parseInt(prod.stok || 0, 10) : Infinity;
  const newQty = item.qty + delta;
  if (newQty <= 0) cart.splice(index, 1);
  else if (newQty > stok) alert("Stock is insufficient.");
  else item.qty = newQty;
  renderCart();
}
function removeCartItem(i) {
  cart.splice(i, 1);
  renderCart();
}

function completePurchase() {
  if (!cart.length) return alert("Empty cart!");
  let total = 0;
  const items = cart.map((c) => {
    total += c.price * c.qty;
    return { id: c.id, nama: c.nama, price: c.price, qty: c.qty };
  });

  apiPostJson(API.addTransaction, { total, items })
    .done((res) => {
      if (res.status === "success") {
        alert("Transaction saved successfully.");
        cart = [];
        renderCart();
        refreshProducts(() => renderProducts());
        if (typeof renderCharts === "function") renderCharts();
      } else {
        alert("Fail to saved transaction: " + (res.message || "Unknown error"));
      }
    })
    .fail(showError);
}

function renderStockTable(filter = "") {
  const tbody = document.getElementById("stockTableBody");
  if (!tbody) return;

  tbody.innerHTML = "";

  const filtered = productsCache.filter((p) =>
    (p.nama || "").toLowerCase().includes(filter.toLowerCase())
  );

  if (filtered.length === 0) {
    tbody.innerHTML = `
      <tr><td colspan="6" class="text-center text-secondary py-4">No products found</td></tr>
    `;
    return;
  }

  filtered.forEach((prod) => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${prod.nama}</td>
      <td>${prod.kategori}</td>
      <td>${prod.stok}</td>
      <td>Rp ${Number(prod.harga).toLocaleString("id-ID")}</td>
      <td>${prod.updated_at || "-"}</td>
      <td>
        <div class="action-buttons">
          <button class="action-btn edit" data-id="${prod.id}">Edit</button>
          <button class="action-btn delete" data-id="${prod.id}">Delete</button>
        </div>
      </td>
    `;
    tbody.appendChild(row);
  });

  document.querySelectorAll(".action-btn.edit").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const id = e.target.dataset.id;
      const product = productsCache.find((p) => p.id == id);
      if (!product) return;

      $("#productName").val(product.nama);
      $("#productCategory").val(product.kategori);
      $("#productStock").val(product.stok);
      $("#productPrice").val(product.harga);

      $("#productForm").show();
      $("#toggleForm").text("Close Form");

      $("#productForm").attr("data-edit-id", id);
    });
  });

  document.querySelectorAll(".action-btn.delete").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const id = e.target.dataset.id;
      if (confirm("Are you sure delete this product?")) {
        apiPostJson(API.deleteProduct, { id })
          .done(() => {
            alert("The product deleted successfully!");
            refreshProducts(() => renderStockTable());
          })
          .fail((err) => showError(err));
      }
    });
  });
}

function renderRecentProducts() {
  const container = document.getElementById("recentProducts");
  if (!container) return;

  container.innerHTML = "<p class='text-muted'>Loading recent products...</p>";

  refreshProducts(() => {
    const recent = [...productsCache].sort((a, b) => b.id - a.id).slice(0, 3);

    if (recent.length === 0) {
      container.innerHTML = `<p class="text-secondary">No recent product yet.</p>`;
      return;
    }

    container.innerHTML = "";

    recent.forEach((p) => {
      const card = document.createElement("div");
      card.className = "recent-card";
      card.innerHTML = `
        <h6>${escapeHtml(p.nama)}</h6>
        <p class="category">${escapeHtml(p.kategori)}</p>
        <p class="stock">Stok: ${numberWithSeparator(p.stok)}</p>
        <p class="price">Rp ${numberWithSeparator(p.harga)}</p>
      `;
      container.appendChild(card);
    });
  });
}

function renderCharts() {
  apiGet(API.getTransactions)
    .done((res) => {
      const hariini = res.hariini || [];
      const harian = res.harian || [];
      const mingguan = res.mingguan || [];

      const dailyLabels = hariini.map((r) => {
        if (!r.created_at) return "Unknown";

        const parts = r.created_at.split(/[- :]/);
        const d = new Date(
          parts[0],
          parts[1] - 1,
          parts[2],
          parts[3] || 0,
          parts[4] || 0,
          parts[5] || 0
        );

        if (isNaN(d)) return "Invalid";

        return d.toLocaleTimeString("en-US", {
          hour: "2-digit",
          minute: "2-digit",
          hour12: false,
        });
      });

      const dailyData = hariini.map((r) => parseInt(r.pendapatan || 0, 10));
      const salesChartEl = document.getElementById("salesChart");
      if (salesChartEl) {
        const ctx = salesChartEl.getContext("2d");
        if (salesChartEl._chartInstance) salesChartEl._chartInstance.destroy();
        salesChartEl._chartInstance = new Chart(ctx, {
          type: "line",
          data: {
            labels: dailyLabels,
            datasets: [
              {
                label: "Revenue This Day (Rp)",
                data: dailyData,
                tension: 0.3,
                borderColor: "rgba(54, 162, 235, 1)",
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                fill: true,
              },
            ],
          },
          options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  callback: function (value) {
                    return "Rp " + value.toLocaleString("id-ID");
                  },
                },
              },
            },
          },
        });
      }

      const weekLabels = harian.map((r, i) => {
        if (r.created_at) return formatDateLabel(r.created_at);
        return `Day ${i + 1}`;
      });

      const weekData = harian.map((r) =>
        parseInt(r.total_pendapatanperhari || 0, 10)
      );
      const weeklyEl = document.getElementById("weeklySalesChart");
      if (weeklyEl) {
        const ctxW = weeklyEl.getContext("2d");
        if (weeklyEl._chartInstance) weeklyEl._chartInstance.destroy();
        weeklyEl._chartInstance = new Chart(ctxW, {
          type: "bar",
          data: {
            labels: weekLabels,
            datasets: [
              {
                label: "Daily Revenue (Rp)",
                data: weekData,
                backgroundColor: "rgba(54, 162, 235, 0.5)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
              },
            ],
          },
          options: {
            responsive: true,
            scales: {
              x: {
                ticks: {
                  autoSkip: false,
                  maxRotation: 45,
                  minRotation: 0,
                },
              },
              y: {
                beginAtZero: true,
                ticks: {
                  callback: function (value) {
                    return "Rp " + value.toLocaleString("id-ID");
                  },
                },
              },
            },
          },
        });
      }

      const monthLabels = mingguan.map((r, i) =>
        formatWeekLabel(r.created_at, i)
      );

      const monthData = mingguan.map((r) =>
        parseInt(r.total_pendapatanperminggu || 0, 10)
      );
      const monthlyEl = document.getElementById("monthlySalesChart");
      if (monthlyEl) {
        const ctxM = monthlyEl.getContext("2d");
        if (monthlyEl._chartInstance) monthlyEl._chartInstance.destroy();
        monthlyEl._chartInstance = new Chart(ctxM, {
          type: "bar",
          data: {
            labels: monthLabels,
            datasets: [
              {
                label: "Weekly Revenue (Rp)",
                data: monthData,
                tension: 0.3,
              },
            ],
          },
          options: { responsive: true },
        });
      }
    })
    .fail(showError);
}

function updateDashboardStats() {
  apiGet(API.getDashboardData)
    .done((data) => {
      $("#totalSalesNow").text("Rp " + numberWithSeparator(data.totalSalesNow));
      $("#productInStock").text(numberWithSeparator(data.productInStock));
      $("#totalStockNow").text(numberWithSeparator(data.totalStockNow));
      $("#totalTransaksiNow").text(numberWithSeparator(data.totalTransaksiNow));
      $("#averageSalesNow").text(
        "Rp " + numberWithSeparator(data.averageSalesNow)
      );
      $("#totalSoldNow").text(numberWithSeparator(data.totalSoldNow));
    })
    .fail(showError);
}

function updateSalesReportStats() {
  apiGet(API.getSalesReportData)
    .done((data) => {
      $("#totalSalesWeek").text(
        "Rp " + numberWithSeparator(data.totalSalesWeek)
      );
      $("#averageSalesWeek").text(
        "Rp " + numberWithSeparator(data.averageSalesWeek)
      );
      $("#totalTransaksiDaily").text(
        numberWithSeparator(data.totalTransactionDaily)
      );
      $("#totalProductSoldWeekly").text(
        numberWithSeparator(data.totalProductSoldWeekly)
      );

      $("#totalSalesMonth").text(
        "Rp " + numberWithSeparator(data.totalSalesMonth)
      );
      $("#averageSalesMonth").text(
        "Rp " + numberWithSeparator(data.averageSalesMonth)
      );
      $("#totalTransactionWeek").text(
        numberWithSeparator(data.totalTransactionWeek)
      );
      $("#totalProductSoldMonthly").text(
        numberWithSeparator(data.totalProductSoldMonthly)
      );
    })
    .fail(showError);
}

$(document).ready(function () {
  const path = window.location.pathname;

  /* INI YANG BAGIAN BIAR BISA NYALA */
  const owalah = document.querySelector("#toggle-btn");
  owalah.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
  });

  const navActive = document.querySelectorAll(".sidebar-link");
  const windowPathname = window.location.pathname;
  navActive.forEach((navActive) => {
    const navLinkPathname = new URL(navActive.href).pathname;

    if (
      windowPathname === navLinkPathname ||
      (windowPathname === "/index.html" && navLinkPathname === "/")
    ) {
      navActive.classList.add("active");
    }
  });

  if (path.includes("cashier")) {
    refreshProducts(() => renderProducts());
    $("#search").on("input", function () {
      renderProducts(this.value);
    });
    $("#completePurchaseBtn").on("click", completePurchase);
    $("#cancelTransactionBtn").on("click", () => {
      if (confirm("Batalkan transaksi?")) {
        cart = [];
        renderCart();
      }
    });
  }

  if (path.includes("stockopname")) {
    refreshProducts(() => {
      renderStockTable();
      renderRecentProducts();
    });

    $("#searchStock").on("input", function () {
      renderStockTable(this.value);
    });

    const toggleBtn = document.getElementById("toggleForm");
    const form = document.getElementById("productForm");
    const cancelBtn = document.getElementById("cancelForm");

    if (toggleBtn && form) {
      form.style.display = "none";

      toggleBtn.addEventListener("click", function () {
        if (form.style.display === "none") {
          form.style.display = "block";
          toggleBtn.textContent = "Close Form";
        } else {
          form.style.display = "none";
          toggleBtn.textContent = "Add Product";
        }
      });
    }

    if (cancelBtn) {
      cancelBtn.addEventListener("click", function (e) {
        e.preventDefault();
        form.reset();
        form.style.display = "none";
        toggleBtn.textContent = "Add Product";
      });
    }

    if (form) {
      form.addEventListener("submit", function (ev) {
        ev.preventDefault();

        const payload = {
          nama: $("#productName").val(),
          kategori: $("#productCategory").val(),
          stok: parseInt($("#productStock").val() || 0, 10),
          harga: parseInt($("#productPrice").val() || 0, 10),
        };

        if (!payload.nama) {
          alert("Nama produk wajib diisi!");
          return;
        }

        const editId = $("#productForm").attr("data-edit-id");

        if (editId) {
          payload.id = editId;

          apiPostJson(API.updateProduct, payload)
            .done(() => {
              alert("Product success to update!");
              $("#productForm").removeAttr("data-edit-id");
              form.reset();
              form.style.display = "none";
              toggleBtn.textContent = "Add Product";
              refreshProducts(() => {
                renderStockTable();
                renderRecentProducts();
              });
            })
            .fail(showError);
        } else {
          apiPostJson(API.addProduct, payload)
            .done(() => {
              alert("Product success to add!");
              form.reset();
              form.style.display = "none";
              toggleBtn.textContent = "Add Product";
              refreshProducts(() => {
                renderStockTable();
                renderRecentProducts();
              });
            })
            .fail(showError);
        }
      });
    }
  }

  if (path.includes("salesreport") || path.includes("dashboard")) {
    renderCharts();
    const weeklyBtn = document.getElementById("weeklyBtn");
    const monthlyBtn = document.getElementById("monthlyBtn");
    const weeklyContainer = document.getElementById("weeklyContainer");
    const monthlyContainer = document.getElementById("monthlyContainer");
    if (weeklyBtn && monthlyBtn && weeklyContainer && monthlyContainer) {
      const infoDaily = document.getElementById("infoDaily");
      const infoWeekly = document.getElementById("infoWeekly");

      function toggleReportView(showWeekly) {
        if (showWeekly) {
          weeklyBtn.classList.add("active");
          monthlyBtn.classList.remove("active");

          weeklyContainer.classList.add("show");
          monthlyContainer.classList.remove("show");

          if (infoDaily) infoDaily.classList.add("aktif");
          if (infoWeekly) infoWeekly.classList.remove("aktif");
        } else {
          monthlyBtn.classList.add("active");
          weeklyBtn.classList.remove("active");

          monthlyContainer.classList.add("show");
          weeklyContainer.classList.remove("show");

          if (infoWeekly) infoWeekly.classList.add("aktif");
          if (infoDaily) infoDaily.classList.remove("aktif");
        }
      }

      weeklyBtn.addEventListener("click", () => toggleReportView(true));
      monthlyBtn.addEventListener("click", () => toggleReportView(false));

      toggleReportView(true);
    }
  }

  if (path.includes("dashboard")) {
    updateDashboardStats();
    renderCharts();
    setInterval(updateDashboardStats, 10000);
  }

  if (path.includes("salesreport")) {
    updateSalesReportStats();
    renderCharts();
    setInterval(updateSalesReportStats, 10000);
  }
});

window.addToCartById = addToCartById;
window.completePurchase = completePurchase;
window.changeQty = changeQty;
window.removeCartItem = removeCartItem;