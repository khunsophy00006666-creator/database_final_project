<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
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
         <a href="product.php" class="btn btn-outline-warning ms-2 text-dark">
                    <i class="bi bi-globe me-1"></i> Admin Panel
                </a>
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

  <div class="row align-items-center g-4">

    <!-- Left Info -->
    <div class="col-lg-3 h-100">
      <div class="p-4 bg-light rounded-4 shadow-sm text-center h-100">
        <h3 class="fw-bold text-success">PHY-Shop</h3>
        <p class="text-muted mb-0">
          Your one-stop shop for fashion, electronics & lifestyle products.
        </p>
        <hr>
        <small class="text-secondary">
          🚀 Fast delivery <br>
          💳 Secure payment <br>
          🎁 Daily deals
           🚀 Fast delivery <br>
          💳 Secure payment <br>
          🎁 Daily deals
           🚀 Fast delivery <br>
          💳 Secure payment <br>
          🎁 Daily deals
           🚀 Fast delivery <br>
          💳 Secure payment <br>
          🎁 Daily deals
           🚀 Fast delivery <br>
          💳 Secure payment <br>
          
        </small>
      </div>
    </div>

    <!-- Carousel (Main Focus) -->
    <div class="col-lg-6 h-100">

      <div id="heroCarousel" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">

        <div class="carousel-inner">

          <div class="carousel-item active">
            <img src="https://i.pinimg.com/1200x/22/e9/70/22e9707022c7f280eba0d32b9407eac0.jpg"
              class="d-block w-100" style="height: 420px; object-fit: cover;" alt="">
          </div>

          <div class="carousel-item">
            <img src="https://i.pinimg.com/1200x/fb/b4/28/fbb428b8dc00805103875a54642e03be.jpg"
              class="d-block w-100" style="height: 420px; object-fit: cover;" alt="">
          </div>

          <div class="carousel-item">
            <img src="https://i.pinimg.com/736x/64/78/2b/64782bc68b74c049e92af29d6d5971cd.jpg"
              class="d-block w-100" style="height: 420px; object-fit: cover;" alt="">
          </div>

        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>

      </div>
    </div>

    <!-- Right CTA -->
    <div class="col-lg-3 h-100">
      <div class="p-4 bg-success text-white rounded-4 shadow-sm h-100 d-flex flex-column justify-content-center text-center">

        <h4 class="fw-bold">🔥 Today’s Deals</h4>
        <p class="mb-3">Up to 50% off selected items</p>
         <h4 class="fw-bold">🔥 Today’s Deals</h4>
        <p class="mb-3">Up to 50% off selected items</p>
         <h4 class="fw-bold">🔥 Today’s Deals</h4>
        <p class="mb-3">Up to 50% off selected items</p>
            <h4 class="fw-bold">🔥 Today’s Deals</h4>
                <p class="mb-3">Up to 50% off selected items</p>
                 <h4 class="fw-bold">🔥 Today’s Deals</h4>
                

        <a href="#" class="btn btn-light fw-bold rounded-pill">
          Shop Now
        </a>

      </div>
    </div>

  </div>
</div>

<div class=" container bg-light text-center text-dark py-3 small">
    <div class="row">
        <div class="col-md-4">
            <p class="mb-0">📦 Free Shipping on orders over $50</p>
        </div>
        <div class="col-md-4">
            <p class="mb-0">💳 100% Secure Payment</p>
        </div>
        <div class="col-md-4">
            <p class="mb-0">📞 24/7 Customer Support</p>
        </div>
    </div>
   

</div>
<?php
include 'db.php';
$result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>
<!-- body -->
   <div class="container my-5">
    <div class="row g-4">
    
        <?php 
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { 
        ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" 
                         class="card-img-top" 
                         style="height: 250px; object-fit: cover;" 
                         alt="<?php echo htmlspecialchars($row['name']); ?>">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                        <p class="card-text text-muted mb-4">
                            <?php echo substr(htmlspecialchars($row['description']), 0, 80); ?>...
                        </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">

                            <span class="text-success fw-bold fs-5">$<?php echo number_format($row['price'], 2); ?></span>
                              <a href="show_pd.php?id=<?= $row['id'] ?>" class="btn btn-outline-success">View Details</a>
                            <a href="#" class="btn btn-outline-success rounded-pill">Add to Cart</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        <?php 
            } 
        } else {
            echo "<p class='text-center'>No products available at the moment.</p>";
        }
        ?>
    </div>
</div>

    <div class="footer accordion bg-dark text-white">
        <div class="container text-center py-3">
            <p class="mb-0">&copy; 2024 PHY-Shop. All rights reserved.</p>
            <small class="text-muted">Designed by PHY-Shop Team</small>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>