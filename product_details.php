<?php
include 'db.php';

// Safe integer normalization from URL query parameters
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id === 0) {
    header("Location: products.php");
    exit();
}

// Fetch single product data record matching ID parameter safely
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    // Redirect or exit gracefully if no product matches the target key ID
    echo "<div class='container mt-5 alert alert-danger'>Product asset record could not be found.</div>";
    exit();
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> | Phy_Shop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* PREMIUM RETAIL BRANDED HEADER NAVIGATION */
        .navbar-custom {
            background-color: #131921;
            padding: 15px 0;
        }

        .navbar-brand-custom {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar-brand-custom span {
            color: #ff9900;
        }

        /* CORE DETAIL FLEXBOX WRAPPERS */
        .product-main-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: none;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        /* ZOOM SHOWCASE IMAGE WINDOW CONTAINER */
        .product-image-window {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 450px;
            border: 1px solid #e5e7eb;
        }

        .product-image-window img {
            max-width: 100%;
            max-height: 400px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .product-image-window img:hover {
            transform: scale(1.03);
        }

        /* CONTENT ENGINE DATA DISPLAY FIELDS */
        .product-title {
            font-size: 32px;
            font-weight: 700;
            color: #232f3e;
            margin-bottom: 12px;
        }

        .price-tag {
            font-size: 28px;
            font-weight: 700;
            color: #b12704; /* Amazon-style high contrast alert pricing crimson */
            margin-bottom: 20px;
        }

        .description-box {
            color: #4b5563;
            font-size: 16px;
            line-height: 1.6;
            background-color: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #ff9900;
            margin-bottom: 25px;
            min-height: 120px;
        }

        /* USER INTERACTION AND UTILITY MODULE ACTIONS */
        .btn-amber {
            background-color: #ff9900;
            color: #111;
            font-weight: 600;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            transition: 0.2s ease-in-out;
        }

        .btn-amber:hover {
            background-color: #e68a00;
            color: white;
        }

        .btn-dark-custom {
            background-color: #232f3e;
            color: white;
            font-weight: 600;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .btn-dark-custom:hover {
            background-color: #131921;
            color: #ff9900;
        }

        .quantity-control {
            max-width: 110px;
            text-align: center;
            font-weight: bold;
            border-radius: 8px;
        }

        /* ACCENTS & BADGES */
        .stock-badge {
            display: inline-block;
            background-color: #e6f4ea;
            color: #137333;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-custom">
        <div class="container">
            <a class="navbar-brand-custom" href="products.php">
                Phy_<span>Shop</span>
            </a>
            <div class="d-flex">
                <a href="product.php" class="btn btn-outline-light btn-sm rounded-pill px-3">
                    <i class="bi bi-arrow-left me-1"></i> Back to Control Panel
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card product-main-card">
            <div class="card-body p-5">
                
                <div class="row g-5">
                    
                    <div class="col-lg-6">
                        <div class="product-image-window shadow-sm">
                            <img src="./<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex flex-column justify-content-center">
                        
                        <div>
                            <span class="stock-badge">
                                <i class="bi bi-check-circle-fill me-1"></i> In Stock / Active Listing
                            </span>
                            
                            <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
                            
                            <div class="price-tag">
                                $<?php echo number_format($product['price'], 2); ?>
                                <span class="text-muted fs-6 fw-normal ms-1">USD + Free Shipping</span>
                            </div>

                            <h5 class="text-dark fw-bold mb-2">Product Description</h5>
                            <div class="description-box">
                                <?php 
                                    // Fallback output checks if description string is empty inside record variables
                                    echo !empty($product['description']) ? nl2br(htmlspecialchars($product['description'])) : 'No technical description parameters provided for this product entry model asset.'; 
                                ?>
                            </div>
                        </div>

                        <form action="#" method="POST" class="mt-2">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <label class="form-label mb-0 text-muted fw-bold small">Quantity:</label>
                                <input type="number" class="form-control quantity-control p-2" value="1" min="1" max="99">
                            </div>

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-amber w-100 py-3">
                                        <i class="bi bi-cart-plus-fill me-2"></i> Add to Cart
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-dark-custom w-100 py-3">
                                        <i class="bi bi-lightning-charge-fill me-1"></i> Buy Now
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="row text-center mt-5 pt-4 border-top border-light text-muted small g-2">
                            <div class="col-4">
                                <i class="bi bi-shield-check text-success fs-4 d-block mb-1"></i> 1 Year Warranty
                            </div>
                            <div class="col-4">
                                <i class="bi bi-truck text-primary fs-4 d-block mb-1"></i> Fast Delivery
                            </div>
                            <div class="col-4">
                                <i class="bi bi-arrow-counterclockwise text-danger fs-4 d-block mb-1"></i> 30-Day Returns
                            </div>
                        </div>

                    </div> </div> </div>
        </div>
    </div>

</body>
</html>