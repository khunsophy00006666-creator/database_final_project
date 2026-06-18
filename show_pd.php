<?php
include 'db.php';

// 1. Get the ID from the URL and validate it
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 2. Fetch the specific product
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("<div class='container mt-5'><h3>Product not found.</h3><a href='index.php'>Back to Shop</a></div>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?= htmlspecialchars($product['name']) ?></title>
</head>
<body class="bg-light">
 <!-- Top Bar -->
<div class="bg-dark text-white text-center py-1 small">
  Free shipping on orders over $50 | 24/7 Support
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">

    <!-- Brand -->
    <a class="navbar-brand fw-bold text-success" href="#">
      PHY-Shop
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="mainNavbar">

      <!-- Categories -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Men</a></li>
            <li><a class="dropdown-item" href="#">Women</a></li>
            <li><a class="dropdown-item" href="#">Electronics</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">Deals</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
      </ul>

      <!-- Search -->
      <form class="d-flex me-3">
        <input class="form-control rounded-pill" type="search" placeholder="Search products...">
      </form>

      <!-- Icons -->
      <div class="d-flex align-items-center gap-3">

        <!-- Wishlist -->
        <a href="#" class="text-dark fs-5">
          <i class="bi bi-heart"></i>
        </a>

        <!-- Cart -->
        <a href="#" class="text-dark fs-5 position-relative">
          <i class="bi bi-cart3"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge bg-danger">
            3
          </span>
        </a>

        <!-- User -->
        <a href="#" class="btn btn-success btn-sm rounded-pill">
          Login
        </a>

      </div>

    </div>
  </div>
</nav>
<div class="container my-5">
    <div class="card border-0 shadow-sm p-4 rounded-4">
        <div class="row align-items-start g-5">
            <div class="col-md-6">
                <img src="<?= htmlspecialchars($product['image']) ?>" 
                     class="img-fluid rounded-4 shadow-sm w-100" 
                     style="max-height: 500px; object-fit: cover;" 
                     alt="<?= htmlspecialchars($product['name']) ?>">
            </div>
            
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-success">Shop</a></li>
                        <li class="breadcrumb-item active"><?= htmlspecialchars($product['name']) ?></li>
                    </ol>
                </nav>
                
                <h1 class="fw-bold mb-3"><?= htmlspecialchars($product['name']) ?></h1>
                <h2 class="text-success fw-bold mb-4">$<?= number_format($product['price'], 2) ?></h2>
                
                <div class="bg-light p-3 rounded-3 mb-4">
                    <h6 class="fw-bold">Description</h6>
                    <p class="text-muted mb-0"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                </div>
                
                <div class="d-flex gap-3 mt-4">
                    <button class="btn btn-success btn-lg px-4 rounded-pill">Add to Cart</button>
                    <a href="index.php" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="footer accordion bg-dark text-white">
        <div class="container text-center py-3">
            <p class="mb-0">&copy; 2024 PHY-Shop. All rights reserved.</p>
            <small class="text-muted">Designed by PHY-Shop Team</small>
        </div>
    </div>

</body>
</html>