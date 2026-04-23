<?php
// 1. DATABASE AND LOGIC FIRST
include('includes/connect.php');

// Handle the Update form submission
if (isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $prod_id = $_POST['prod_id'];

    try {
        $query = "UPDATE products SET name = :name, category = :category, price = :price, stock = :stock WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            'name' => $name,
            'category' => $category,
            'price' => $price,
            'stock' => $stock,
            'id' => $prod_id
        ]);

        // SUCCESS! This redirect will now work because no HTML has been sent yet.
        header("Location: inventory.php?msg=updated");
        exit();
        
    } catch (PDOException $e) {
        $error = "Update failed: " . $e->getMessage();
    }
}

// 2. FETCH DATA FOR THE FORM
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch();

    if (!$product) {
        header("Location: inventory.php");
        exit();
    }
}

// 3. UI INCLUDES SECOND (HTML starts here)
include('includes/header.php'); 
?>
<div class="max-w-2xl mx-auto bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
    <div class="flex items-center gap-4 mb-8">
        <a href="inventory.php" class="text-slate-400 hover:text-slate-600 transition-colors">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 class="text-2xl font-black text-slate-800">Edit Product</h2>
    </div>
    
    <form method="POST" class="space-y-6">
        <input type="hidden" name="prod_id" value="<?php echo $product['id']; ?>">

        <div>
            <label class="block text-xs font-black uppercase text-slate-400 mb-2">Product Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required 
                   class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
        </div>
        
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2">Category</label>
                <select name="category" class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    <option <?php echo $product['category'] == 'T-Shirts' ? 'selected' : ''; ?>>T-Shirts</option>
                    <option <?php echo $product['category'] == 'Hoodies' ? 'selected' : ''; ?>>Hoodies</option>
                    <option <?php echo $product['category'] == 'Pants' ? 'selected' : ''; ?>>Pants</option>
                    <option <?php echo $product['category'] == 'Accessories' ? 'selected' : ''; ?>>Accessories</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2">Price ($)</label>
                <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required 
                       class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            </div>
        </div>

        <div>
            <label class="block text-xs font-black uppercase text-slate-400 mb-2">Current Stock</label>
            <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required 
                   class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
        </div>

        <button type="submit" name="update_product" class="w-full py-5 bg-blue-600 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
            Update Product Information
        </button>
    </form>
</div>

<?php include('includes/footer.php'); ?>