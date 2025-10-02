<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Aplikasi Manajemen Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Template CSS dari link soal (Tailwind Starter Kit) -->
    <link href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   
    <style>
        body { margin:0; font-family: 'Segoe UI', sans-serif; background:#f4f6f9; }
        .sidebar {
            width: 220px; height: 100vh; background: #478effff; color: white; position: fixed; top:0; left:0; padding-top:20px;
        }
        .sidebar h3 { text-align:center; margin-bottom: 20px; font-size:18px; font-weight:bold; }
        .sidebar a {
            display: block; padding: 12px 20px; color: white; text-decoration: none; border-radius:6px; margin:4px 10px;
        }
        .sidebar a:hover { background: #334155; }
        .content {
            margin-left: 220px; padding: 25px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Menu</h3>
        <a href="<?= site_url('transaksi'); ?>">📦 Transaksi</a>
        <a href="<?= site_url('laporan'); ?>">📊 Laporan</a>
        <a href="<?= site_url('auth/logout'); ?>">🚪 Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <?php $this->load->view($content); ?>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
