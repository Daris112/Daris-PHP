<?php
// 1. DATABASE AND LOGIC FIRST
include('includes/connect.php');

// Fetch categories to populate the dropdown dynamically
$cat_stmt = $pdo->query("SELECT * FROM categories");
$categories = $cat_stmt->fetchAll();

if (isset($_POST['save_product'])) {
    $name = trim($_POST['name']);
    $category_id = $_POST['category_id']; // Using ID to match your FK constraint
    $price = $_POST['price'];
    $image_url = trim($_POST['image_url']); // Match your image_url column
    $description = trim($_POST['description']); // Match your description column

    try {
        // Query updated to match your table: name, price, image_url, description, category_id
        $query = "INSERT INTO products (name, price, image_url, description, category_id) 
                  VALUES (:name, :price, :image_url, :description, :category_id)";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'name' => $name,
            'price' => $price,
            'image_url' => $image_url,
            'description' => $description,
            'category_id' => $category_id
        ]);

        header("Location: inventory.php?msg=added");
        exit();
        
    } catch (PDOException $e) {
        $error = "Database Error: " . $e->getMessage();
    }
}

// 2. UI INCLUDES SECOND
include('includes/header.php'); 
?>

<div class="max-w-2xl mx-auto bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
    <h2 class="text-2xl font-black text-slate-800 mb-8 text-center uppercase tracking-tighter">Add New Product</h2>
    
    <?php if(isset($error)): ?>
        <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl text-sm border-l-4 border-red-500">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="space-y-6">
        <div>
            <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Product Name</label>
            <input type="text" name="name" required placeholder="e.g. Luxury Silk Shirt"
                   class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black transition-all">
        </div>
        
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Category</label>
                <select name="category_id" class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black transition-all">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Price ($)</label>
                <input type="number" step="0.01" name="price" required placeholder="0.00"
                       class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black transition-all">
            </div>
        </div>

        <div>
            <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Image Filename</label>
            <input type="text" name="image_url" placeholder="e.g. product1.jpg"
                   class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black transition-all">
            <p class="text-[10px] text-slate-400 mt-2 italic">Ensure file exists in assets/images/</p>
        </div>

        <div>
            <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Description</label>
            <textarea name="description" rows="3" 
                      class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black transition-all"></textarea>
        </div>

        <button type="submit" name="save_product" class="w-full py-5 bg-black text-white rounded-2xl font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg">
            Confirm & Save Product
        </button>
    </form>
</div>

<?php include('includes/footer.php'); ?>