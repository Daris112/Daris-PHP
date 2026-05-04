<?php
// 1. DATABASE AND LOGIC FIRST (No HTML allowed above this!)
include('includes/connect.php');

if (isset($_POST['save_product'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    try {
        $query = "INSERT INTO products (name, category, price, stock) VALUES (:name, :category, :price, :stock)";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            'name' => $name,
            'category' => $category,
            'price' => $price,
            'stock' => $stock
        ]);

        // This works now because we haven't included the header/navbar yet
        header("Location: inventory.php?msg=added");
        exit();
        
    } catch (PDOException $e) {
        $error = "Database Error: " . $e->getMessage();
    }
}

// 2. UI INCLUDES SECOND (HTML starts here)
include('includes/header.php'); 
?>

<div class="max-w-2xl mx-auto bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
    <h2 class="text-2xl font-black text-slate-800 mb-8 text-center">Add New Product</h2>
    
    <form method="POST" class="space-y-6">
        <div>
            <label class="block text-xs font-black uppercase text-slate-400 mb-2">Product Name</label>
            <input type="text" name="name" required class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
        </div>
        
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2">Category</label>
                <select name="category" class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    <option>T-Shirts</option>
                    <option>Hoodies</option>
                    <option>Pants</option>
                    <option>Accessories</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2">Price ($)</label>
                <input type="number" step="0.01" name="price" required class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            </div>
        </div>

        <div>
            <label class="block text-xs font-black uppercase text-slate-400 mb-2">Initial Stock</label>
            <input type="number" name="stock" required class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
        </div>

        <button type="submit" name="save_product" class="w-full py-5 bg-blue-600 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
            Confirm & Save Product
        </button>
    </form>
</div>

<?php include('includes/footer.php'); ?>