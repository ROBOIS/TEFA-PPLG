<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'AplikasiTefa'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
    <button id="toggleSidebar" class="mb-3" aria-label="Toggle Sidebar" style="display:none;">☰</button>
    <?php echo $__env->yieldContent('content'); ?>
    <script>
        // Tampilkan tombol toggle jika ada elemen dengan id sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            if (sidebar && toggleBtn) {
                toggleBtn.style.display = 'flex';
                let sidebarVisible = true;
                function setSidebarVisibility(visible) {
                    sidebarVisible = visible;
                    if (visible) {
                        sidebar.classList.remove('sidebar-hidden');
                        sidebar.classList.add('sidebar-visible');
                    } else {
                        sidebar.classList.remove('sidebar-visible');
                        sidebar.classList.add('sidebar-hidden');
                    }
                }
                toggleBtn.addEventListener('click', function() {
                    setSidebarVisibility(!sidebarVisible);
                });
                function handleResize() {
                    if (window.innerWidth < 768) {
                        setSidebarVisibility(false);
                    } else {
                        setSidebarVisibility(true);
                    }
                }
                window.addEventListener('resize', handleResize);
                handleResize();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\KeuanganTefa\AplikasiTefa\resources\views/layouts/app.blade.php ENDPATH**/ ?>