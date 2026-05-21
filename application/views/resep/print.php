<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Resep</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .summary { margin-top: 12px; text-align: right; font-weight: bold; }
    </style>
</head>
<body>
    <h3>Detail Resep #<?= $header ? $header->id : '-' ?></h3>
    <?php if ($header): ?>
        <p>Pasien: <?= $header->pasien_nama ?> | Dokter: <?= $header->dokter_nama ?> | Tanggal: <?= $header->tanggal ?></p>
    <?php endif; ?>

    <table>
        <tr>
            <th>Obat</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach ($detail as $d): ?>
            <tr>
                <td><?= $d->nama_obat ?></td>
                <td><?= $d->qty ?></td>
                <td>Rp <?= number_format($d->harga) ?></td>
                <td>Rp <?= number_format($d->subtotal) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="summary">Grand Total: Rp <?= $header ? number_format($header->total) : 0 ?></div>
    <script>window.print();</script>
</body>
</html>
