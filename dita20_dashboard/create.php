<?php include('includes/header.php'); ?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-800">Add New Product</h3>
        <p class="text-gray-500 text-sm">Fill in the details to add an item to the inventory.</p>
    </div>

    <form action="process.php" method="POST" class="space-y-6">
        <div class="grid grid-cols-2 gap-6">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                <input type="text" name="name" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="e.g. Silk Scarf">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Price ($)</label>
                <input type="number" name="price" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="0.00">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    <option>Accessories</option>
                    <option>Apparel</option>
                    <option>Footwear</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-8">
            <a href="index.php" class="px-6 py-2 border rounded-lg text-gray-600 hover:bg-gray-50">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">Save Product</button>
        </div>
    </form>
</div>

<?php include('includes/footer.php'); ?>