<?php
include 'db.php';

$message = "";

// Secure Insert Logic
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        // Establish file location path string before executing parameters
        $image_path = 'uploads/' . basename($_FILES['image']['name']);
        
        $stmt = $conn->prepare("INSERT INTO products(name, price, description, image, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("sdss", $_POST['name'], $_POST['price'], $_POST['description'], $image_path);
        
        if(move_uploaded_file($_FILES['image']['tmp_name'], './' . $image_path)) {
            if($stmt->execute()) {
                $message = "Product Published Successfully";
            } else {
                $message = "Database Save Error Occurred";
            }
        } else {
            $message = "Failed to upload image file asset";
        }
        $stmt->close();
    } else {
        $message = "Please include a valid cover image";
    }
}

$result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Inventory Manager | Phy_Shop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f4f6f9;
            font-family: Arial, Helvetica, sans-serif;
            overflow-x: hidden;
        }

        /* E-COMMERCE SIDEBAR */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #131921;
            padding: 25px 15px;
            color: white;
            border-right: 1px solid #232f3e;
            z-index: 100;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 40px;
            letter-spacing: 0.5px;
        }

        .logo span {
            color: #ff9900;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #eeeeee;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 8px;
            font-weight: 500;
            transition: 0.3s;
        }

        .sidebar a:hover, .sidebar a.active {
            background: #232f3e;
            color: #ff9900;
            transform: translateX(3px);
        }

        /* MAIN CONTENT AREA */
        .main-content {
            margin-left: 260px;
            padding: 30px;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            border-radius: 16px;
            padding: 20px 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .topbar h2 {
            font-weight: bold;
            color: #232f3e;
        }

        /* CORE CONTAINERS */
        .card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .card-header {
            padding: 16px 20px;
            border: none;
            font-weight: 600;
        }

        /* FORMS & DATA CONTROLS */
        .form-control {
            border-radius: 10px;
            padding: 11px;
            border: 1px solid #dcdcdc;
            box-shadow: none !important;
        }

        .form-control:focus {
            border-color: #ff9900;
        }

        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 20px;
        }

        .btn-amber {
            background-color: #ff9900;
            color: #111;
            border: none;
            transition: 0.2s ease-in-out;
        }

        .btn-amber:hover {
            background-color: #e68a00;
            color: white;
        }

        /* DATA MANAGEMENT INVENTORY TABLE */
        table {
            vertical-align: middle !important;
        }

        .table thead {
            background-color: #232f3e;
            color: white;
        }

        .table thead th {
            font-weight: 600;
            padding: 14px;
            border: none;
        }

        .img-thumb {
            width: 54px;
            height: 54px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
        }

        .product-link {
            color: #232f3e;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .product-link:hover {
            color: #ff9900;
        }

        /* RESPONSIVE LAYOUTS */
        @media(max-width:992px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-right: none;
                border-bottom: 1px solid #232f3e;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo">
            Phy_<span>Shop</span>
        </div>

        <a href="dashboard.php">
            <i class="bi bi-grid-fill"></i> Dashboard  
        </a>
        <a href="products.php" class="active">
            <i class="bi bi-bag-check-fill"></i> Products
        </a>
        <a href="orders.php">
            <i class="bi bi-cart-fill"></i> Orders
        </a>
        <a href="catagory.php">
            <i class="bi bi-tags-fill"></i> Categories
        </a>
        <a href="customers.php">
            <i class="bi bi-people-fill"></i> Customers
        </a>
        <a href="#">
            <i class="bi bi-bar-chart-line-fill"></i> Analytics
        </a>
        <a href="#">
            <i class="bi bi-gear-fill"></i> Settings
        </a>
        <a href="#" class="mt-5 text-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

    <div class="main-content">
        
        <div class="topbar d-flex justify-content-between align-items-center">
            <div>
                <h2>Product Catalog</h2>
                <p class="text-muted mb-0">Control inventory listings and active assets</p>
            </div>

            <div>
                <button class="btn btn-dark">
                    <i class="bi bi-person-circle me-2"></i> Admin Panel
                </button>
                <a href="index.php" class="btn btn-outline-warning ms-2 text-dark">
                    <i class="bi bi-globe me-1"></i> View Shop
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Publish New Product</h5>
                    </div>
                    <div class="card-body p-4">
                        <?php if ($message != "") { ?>
                            <div class="alert alert-info py-2 small mb-3">
                                <i class="bi bi-info-circle-fill me-1"></i> <?php echo $message; ?>
                            </div>
                        <?php } ?>

                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Product Item Title</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g., Smart Watch Edition 6" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Retail Price ($ USD)</label>
                                <input type="number" name="price" class="form-control" placeholder="0.00" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Detailed Description</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Provide product specifications..."></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Product Graphic Cover</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-amber w-100">
                                <i class="bi bi-cloud-arrow-up-fill me-1"></i> Publish Product
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Active Stock Listings</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="100">Display</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th width="180" class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                               
                                    <?php if ($result->num_rows > 0): ?>
                                        <?php while($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td>
                                                <img src="./<?php echo htmlspecialchars($row['image']); ?>" class="img-thumb" alt="Product thumbnail">
                                            </td>
                                            <td class="fw-bold">
                                                <a href="product_details.php?id=<?= $row['id'] ?>" class="product-link" title="View customer-facing details page">
                                                    <?= htmlspecialchars($row['name']) ?> <i class="bi bi-box-arrow-up-right small ms-1 text-muted"></i>
                                                </a>
                                            </td>
                                            <td class="text-success fw-bold">
                                                $<?= number_format($row['price'], 2) ?>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1 justify-content-end px-2">
                                                    <a href="product_details.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-dark px-2.5" title="Preview Product Details">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success px-2.5" title="Modify item details">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger px-2.5" onclick="return confirm('Drop this product from inventory permanently?')" title="Delete entry">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center p-4 text-muted">
                                                <i class="bi bi-box-seam display-6 d-block mb-2"></i> No items available in active stock.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>