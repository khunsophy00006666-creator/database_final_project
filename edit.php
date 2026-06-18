<?php 
include 'db.php';

$message = "";
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id === 0) {
    header("Location: products.php");
    exit();
}

// Fetch current product datasheet values securely
$stmt_fetch = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt_fetch->bind_param("i", $product_id);
$stmt_fetch->execute();
$result = $stmt_fetch->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    header("Location: products.php");
    exit();
}
$stmt_fetch->close();

// Update Data Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    // Check if a new image asset is selected
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . basename($image);

        if (move_uploaded_file($image_tmp, "./" . $image_path)) {
            // Update table along with new image file path
            $stmt_update = $conn->prepare("UPDATE products SET name = ?, price = ?, description = ?, image = ? WHERE id = ?");
            $stmt_update->bind_param("sdssi", $name, $price, $description, $image_path, $product_id);
        } else {
            $message = "Error uploading image to file system storage.";
        }
    } else {
        // Fallback: update records without overwriting current active image path
        $stmt_update = $conn->prepare("UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?");
        $stmt_update->bind_param("sdsi", $name, $price, $description, $product_id);
    }

    if (isset($stmt_update)) {
        if ($stmt_update->execute()) {
            header("Location: product.php");
            exit();
        } else {
            $message = "Error updating database entry attributes.";
        }
        $stmt_update->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product #<?php echo $product['id']; ?> | Phy_Shop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        /* E-COMMERCE BRANDED SIDEBAR */
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

        /* MAIN CONTENT ROW FRAMEWORK */
        .main-content {
            margin-left: 260px;
            padding: 30px;
        }

        /* TOPBAR PANEL CARDS */
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

        /* INTERFACE SHIELD CONTAINER CARDS */
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

        /* SYSTEM DATA FORM CONTROLS */
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

        /* PREVIEW WRAPPER MODULES */
        .preview-img-box {
            width: 100%;
            max-height: 280px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preview-img-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 10px;
        }

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
                <h2>Product Details</h2>
                <p class="text-muted mb-0">Modify attributes, asset details, and catalog options</p>
            </div>

            <div>
                <a href="product.php" class="btn btn-dark">
                    <i class="bi bi-arrow-left-short me-1"></i> Back to Products
                </a>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Current Item Media</h5>
                    </div>
                    <div class="card-body text-center p-4">
                        <div class="preview-img-box mb-3">
                            <img src="./<?php echo htmlspecialchars($product['image']); ?>" alt="Current display asset">
                        </div>
                        <h4 class="text-dark fw-bold mb-1"><?php echo htmlspecialchars($product['name']); ?></h4>
                        <p class="text-muted small mb-2">System Record Key ID: #<?php echo $product['id']; ?></p>
                        <span class="badge bg-success fs-6 px-3 py-2">
                            $<?php echo number_format($product['price'], 2); ?> USD
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Update Inventory Specifications</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        <?php if ($message != "") { ?>
                            <div class="alert alert-danger py-2.5 small mb-4">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i> <?php echo $message; ?>
                            </div>
                        <?php } ?>

                        <form method="POST" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label text-muted small fw-bold">Product Name Label</label>
                                    <input type="text" name="name" class="form-control" 
                                           value="<?php echo htmlspecialchars($product['name']); ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label text-muted small fw-bold">Retail Price ($ USD)</label>
                                    <input type="number" name="price" class="form-control" step="0.01" 
                                           value="<?php echo htmlspecialchars($product['price']); ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Detailed Description Log</label>
                                <textarea name="description" class="form-control" rows="5" 
                                          placeholder="Provide item specifications..."><?php echo htmlspecialchars($product['description']); ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Replace Cover Media (Optional)</label>
                                <input type="file" name="image" class="form-control">
                                <div class="form-text text-muted small mt-1">
                                    Leave blank to maintain current graphic path file configuration safely.
                                </div>
                            </div>

                            <hr class="text-muted my-4">

                            <div class="d-flex justify-content-end gap-2">
                                <a href="products.php" class="btn btn-outline-secondary px-4">Cancel Execution</a>
                                <button type="submit" class="btn btn-amber px-4">
                                    <i class="bi bi-cloud-check-fill me-1"></i> Synchronize Changes
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
</body>
</html>