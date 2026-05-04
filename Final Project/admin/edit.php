<?php
// 1. DATABASE AND LOGIC FIRST
include('includes/connect.php');

// Check for Product ID
if (!isset($_GET['id'])) {
    header("Location: inventory.php");
    exit();
}

$id = $_GET['id'];

// Fetch categories for the dropdown menu
$cat_stmt = $pdo->query("SELECT * FROM categories");
$categories = $cat_stmt->fetchAll();

// Fetch current product details
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    header("Location: inventory.php?error=not_found");
    exit();
}

// Handle Update Logic
if (isset($_POST['update_product'])) {
    $name = trim($_POST['name']);
    $category_id = $_POST['category_id']; // Using ID to maintain foreign key integrity
    $price = $_POST['price'];
    $image_url = trim($_POST['image_url']);
    $description = trim($_POST['description']);

    try {
        // Query targets the products table from your SQL dump[cite: 1]
        $query = "UPDATE products SET 
                    name = :name, 
                    price = :price, 
                    image_url = :image_url, 
                    description = :description, 
                    category_id = :category_id 
                  WHERE id = :id";
        
        $updateStmt = $pdo->prepare($query);
        $updateStmt->execute([
            'name' => $name,
            'price' => $price,
            'image_url' => $image_url,
            'description' => $description,
            'category_id' => $category_id,
            'id' => $id
        ]);

        header("Location: inventory.php?msg=updated");
        exit();
    } catch (PDOException $e) {
        $error = "Update failed: " . $e->getMessage();
    }
}

// 2. UI INCLUDES
include('includes/header.php'); 
?>

<div class="max-w-2xl mx-auto bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
    <div class="flex items-center gap-4 mb-8">
        <a href="inventory.php" class="text-slate-400 hover:text-slate-800 transition-colors">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Edit Product</h2>
    </div>
    
    <?php if(isset($error)): ?>
        <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl text-sm border-l-4 border-red-500">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="space-y-6">
        <div>
            <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Product Name</label>
            <input type="text" name="name" required value="<?php echo htmlspecialchars($product['name']); ?>"
                   class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black transition-all">
        </div>
        
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Category</label>
                <select name="category_id" class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black transition-all">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Price ($)</label>
                <input type="number" step="0.01" name="price" required value="<?php echo $product['price']; ?>"
                       class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black transition-all">
            </div>
        </div>

        <div>
            <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Image Filename</label>
            <input type="text" name="image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>"
                   class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black transition-all">
        </div>

        <div>
            <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Description</label>
            <textarea name="description" rows="3" 
                      class="w-full px-5 py-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-black transition-all"><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>

        <button type="submit" name="update_product" class="w-full py-5 bg-black text-white rounded-2xl font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg">
            Save Changes
        </button>
    </form>
</div>

<?php include('includes/footer.php'); ?>