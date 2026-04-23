document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. Select All Checkboxes ---
    const selectAll = document.getElementById('selectAll');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');

    if (selectAll) {
        selectAll.addEventListener('change', () => {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
                // Add a highlight class to the row
                toggleRowHighlight(checkbox);
            });
        });
    }

    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            toggleRowHighlight(checkbox);
            // Uncheck "Select All" if one item is unchecked
            if (!checkbox.checked) selectAll.checked = false;
        });
    });

    function toggleRowHighlight(checkbox) {
        const row = checkbox.closest('tr');
        if (checkbox.checked) {
            row.classList.add('bg-blue-50');
        } else {
            row.classList.remove('bg-blue-50');
        }
    }

    // --- 2. Delete Confirmation ---
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const itemName = btn.getAttribute('data-name') || "this item";
            const confirmed = confirm(`Are you sure you want to delete "${itemName}"? This action cannot be undone.`);
            
            if (!confirmed) {
                e.preventDefault(); // Stops the link/button from working
            }
        });
    });

    // --- 3. Simple Toast Notification (Success/Error) ---
    window.showToast = function(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-5 right-5 px-6 py-3 rounded-xl shadow-2xl text-white transition-all duration-500 transform translate-y-20 z-50`;
        
        if(type === 'success') toast.classList.add('bg-green-600');
        else toast.classList.add('bg-red-600');
        
        toast.innerHTML = `<i class="fas fa-check-circle mr-2"></i> ${message}`;
        document.body.appendChild(toast);

        // Animate in
        setTimeout(() => toast.classList.remove('translate-y-20'), 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.classList.add('opacity-0');
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    };
});

// --- 4. Auto-trigger Toast based on URL message ---
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');

    if (msg) {
        if (msg === 'added') showToast('Successfully added to database!');
        if (msg === 'updated') showToast('Information updated successfully!');
        if (msg === 'deleted') showToast('Item has been removed.', 'error');
        if (msg === 'user_added') showToast('New administrator created!');
        
        // Optional: Clean the URL so the toast doesn't pop up again if they refresh
        window.history.replaceState({}, document.title, window.location.pathname);
    }