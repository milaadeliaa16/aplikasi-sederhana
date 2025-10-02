<!DOCTYPE html> 
<html>
<head>
    <title>Laporan Transaksi</title> 

    <!-- Bootstrap 5 CSS untuk styling responsif -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- DataTables CSS untuk styling tabel interaktif -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

   
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- DataTables JS untuk membuat tabel lebih interaktif -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    
    <!-- SweetAlert2 untuk popup notifikasi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Highcharts untuk membuat grafik/chart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>


    <style>
        body { /* Styling body utama */
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }
        .sidebar { /* Sidebar kiri */
            width: 220px;
            height: 100vh; /* penuh tinggi layar */
            background: #478effff; /* warna biru */
            color: white;
            position: fixed; /* selalu menempel di kiri */
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar h3 { /* Judul sidebar */
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar a { /* Link di sidebar */
            display: block;
            padding: 12px;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover { /* Efek hover menu */
            background: #34495e;
        }
        .content { /* Bagian konten kanan */
            margin-left: 220px; /* geser agar tidak tertutup sidebar */
            padding: 20px;
        }
        .card { /* Styling untuk card konten */
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        table.dataTable th { /* Header tabel */
            background: #3498db;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigasi -->
    <div class="sidebar">
        <h3>Menu</h3>
        <a href="<?= site_url('transaksi'); ?>">📦 Transaksi</a>
        <a href="<?= site_url('laporan'); ?>">📊 Laporan</a>   
        <a href="<?= site_url('auth/logout'); ?>">🚪 Logout</a> 
    </div>

    <!-- Konten Utama -->
    <div class="content">
        <!-- Card untuk grafik laporan -->
        <div class="card p-4">
            <h3 class="text-center mb-4">📊 Laporan Transaksi Bulanan</h3>
            <!-- Container grafik Highcharts -->
            <div id="container" style="height:400px;"></div>
        </div>

        <!-- Card untuk tabel laporan -->
        <div class="card p-4">
            <h4 class="mb-3">📑 Tabel Laporan</h4>
            <table id="laporanTable" class="display table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Total Harian</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop data laporan dari PHP -->
                    <?php foreach($laporan as $l): ?>
                    <tr>
                        <td><?= $l->tanggal; ?></td> 
                        <td><?= number_format($l->total_harian,0,',','.'); ?></td> 
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Aktifkan DataTables pada tabel laporan
            $('#laporanTable').DataTable({
                "pageLength": 10,     // 10 baris per halaman
                "lengthChange": false // tidak bisa ubah jumlah baris
            });
        });

        // Inisialisasi grafik Highcharts
        Highcharts.chart('container', {
            chart: { type: 'column' }, // Tipe grafik = kolom/batang
            title: { text: 'Laporan Transaksi Harian Bulan <?= date("F") ?>' }, 
            xAxis: { 
                categories: [<?php foreach($laporan as $l){ echo "'".$l->tanggal."',"; } ?>] 
                // Sumbu X = tanggal dari laporan
            },
            yAxis: { 
                title: { text: 'Total Transaksi (Rp)' } 
                // Label sumbu Y
            },
            series: [{
                name: 'Nominal Harian', 
                data: [<?php foreach($laporan as $l){ echo $l->total_harian.","; } ?>]
            },{
                type: 'line', 
                name: 'Target',
                data: Array(<?= count($laporan) ?>).fill(500000), // Target tetap Rp 500.000 per hari
                color: 'red' 
            }]
        });
    </script>
</body>
</html>
