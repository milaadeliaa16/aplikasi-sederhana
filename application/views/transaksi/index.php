<!DOCTYPE html> 
<html>
<head>
    <title>Manajemen Transaksi</title> 
    
    <!-- CSS DataTables untuk styling tabel -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
    <!-- Library jQuery versi 3.7.0 -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- Library DataTables untuk membuat tabel interaktif -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    
    <!-- Library SweetAlert2 untuk popup notifikasi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        h2 {
            margin-top: 0;
            margin-bottom: 15px;
            text-align: center;
        }
        form input, form button {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        form button {
            background: #3498db;
            color: #fff;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background: #2980b9;
        }
        table.dataTable {
            border-collapse: collapse !important;
            width: 100% !important;
            text-align: center;
        }
        table.dataTable th {
            background: #3498db;
            color: #fff;
        }
        table.dataTable tr:nth-child(even) {
            background: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Bagian Form Input Transaksi -->
    <div class="card">
        <h2>Form Input Transaksi</h2>
        
        <form method="post" action="<?php echo site_url('transaksi/tambah'); ?>">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" required>

            <label>Jumlah</label>
            <input type="number" name="jumlah" required>

            <label>Harga</label>
            <input type="number" name="harga" required>

            <button type="submit">Simpan</button>
        </form>
    </div>

    <!-- Bagian Tabel Data Transaksi -->
    <div class="card">
        <h2>Data Transaksi</h2>
        
        <table id="transaksiTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($transaksi as $t): ?>
                <tr>
                    <td><?= $t->id; ?></td>
                    <td><?= $t->nama_barang; ?></td>
                    <td><?= $t->jumlah; ?></td>
                    <td><?= number_format($t->harga,0,',','.'); ?></td>
                    <td><?= number_format($t->total,0,',','.'); ?></td>
                    <td><?= $t->tanggal; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<script>
    $(document).ready( function () {
        // DataTables
        $('#transaksiTable').DataTable({
            "pageLength": 5,
            "lengthChange": false
        });

        // Alert sukses
        <?php if($this->session->flashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= $this->session->flashdata('success'); ?>'
            });
        <?php endif; ?>

        // Alert error
        <?php if($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= $this->session->flashdata('error'); ?>'
            });
        <?php endif; ?>
    });
</script>
</body>
</html>
