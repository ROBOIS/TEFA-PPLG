            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="<?php echo e(route('rekap-penjualan.index')); ?>">Rekap Penjualan</a>
            </li>


<?php $__env->startSection('content'); ?>
<style>
    .sidebar {
        min-width: 220px;
        min-height: 100vh;
        transition: transform 0.35s cubic-bezier(.4,2,.6,1), box-shadow 0.3s;
        will-change: transform;
        z-index: 1000;
        position: relative;
    }
    .sidebar-hidden {
        transform: translateX(-100%);
        box-shadow: none;
    }
    .sidebar-visible {
        transform: translateX(0);
        box-shadow: 2px 0 8px rgba(0,0,0,0.05);
    }
</style>
<div class="d-flex" style="position:relative;">
    <nav id="sidebar" class="sidebar bg-primary text-white p-3 sidebar-visible">
        <h4 class="mb-4">Menu</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="/dashboard">Home</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="<?php echo e(route('barang.index')); ?>">Barang</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="<?php echo e(route('transaksi-masuk.index')); ?>">Transaksi Masuk</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="<?php echo e(route('transaksi-keluar.index')); ?>">Transaksi Keluar</a>
            </li>
            <li class="nav-item mb-2">
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="nav-link text-white bg-transparent border-0 p-0" style="cursor:pointer;">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    <main class="flex-fill p-4">
        <h2 class="mb-4">Daftar Barang</h2>
        <a href="<?php echo e(route('barang.create')); ?>" class="btn btn-primary mb-3">Tambah Barang</a>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Harga Beli (satuan)</th>
                    <th>Harga Jual (satuan)</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($b->nama); ?></td>
                    <td><?php echo e($b->stok); ?></td>
                    <td>Rp<?php echo e(number_format($b->harga_beli,0,',','.')); ?></td>
                    <td>Rp<?php echo e(number_format($b->harga_jual,0,',','.')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\KeuanganTefa\AplikasiTefa\resources\views/barang/index.blade.php ENDPATH**/ ?>