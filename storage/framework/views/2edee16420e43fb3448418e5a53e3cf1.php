<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Transaksi Keluar PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align:center; margin-bottom:0;">LAPORAN TEFA PPLG</h2>
    <p style="text-align:center; margin-top:2px; margin-bottom:18px;">
        Tgl, <?php echo e(\Carbon\Carbon::now()->translatedFormat('d F Y')); ?>

    </p>
    <p>
        Periode: 
        <?php if($tanggal_awal && $tanggal_akhir): ?>
            <?php echo e($tanggal_awal); ?> s/d <?php echo e($tanggal_akhir); ?>

        <?php else: ?>
            Semua Data
        <?php endif; ?>
    </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Jual Satuan</th>
                <th>Harga Jual Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i+1); ?></td>
                <td><?php echo e($t->tanggal); ?></td>
                <td><?php echo e($t->barang->nama ?? '-'); ?></td>
                <td><?php echo e($t->jumlah); ?></td>
                <td>Rp <?php echo e(number_format($t->barang->harga_jual ?? 0,0,',','.')); ?></td>
                <td>Rp <?php echo e(number_format($t->harga_jual,0,',','.')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" style="text-align:right">Total</th>
                <th>Rp <?php echo e(number_format($total,0,',','.')); ?></th>
            </tr>
        </tfoot>
    </table>

    <br><br><br>
    <table style="width:100%; border:none; margin-top:40px;">
        <tr>
            <td style="width:50%; text-align:left; border:none;">
                Mengetahui<br><br><br><br>
                ............................
            </td>
            <td style="width:50%; text-align:right; border:none;">
                Pembuat Laporan<br><br><br><br>
                ............................
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\KeuanganTefa\AplikasiTefa\resources\views/rekap_transaksi_keluar/pdf.blade.php ENDPATH**/ ?>