<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
 * Controller Laporan
 *
 * @property CI_Session $session             
 * @property Transaksi_model $Transaksi_model 
 */
class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct(); 

       
        $this->load->library('session');       
        $this->load->model('Transaksi_model'); 
        $this->load->helper('url');            

        // Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) { 
          redirect('auth'); // Jika belum login, masih tetap di halaman login
        }
    }

    public function index() {
        $bulan = date('m'); 
        $tahun = date('Y'); 

        // mengambil data transaksi dari database untuk bulan dan tahun ini
        $laporan = $this->Transaksi_model->get_report_monthly($bulan, $tahun);

        // Mapping data hasil query ke array dengan key = tanggal, value = total harian
        $dataMap = [];
        foreach ($laporan as $row) {
            $dataMap[$row->tanggal] = (int)$row->total_harian; // Convert ke integer
        }

        // Generate semua tanggal dalam bulan ini
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); // Hitung jumlah hari di bulan ini
        $result = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $tgl = sprintf("%04d-%02d-%02d", $tahun, $bulan, $i); // Format tanggal YYYY-MM-DD
            $result[] = (object)[
                'tanggal' => $tgl,
                'total_harian' => isset($dataMap[$tgl]) ? $dataMap[$tgl] : 0 // Jika tidak ada transaksi, isi 0
            ];
        }

        $data['laporan'] = $result; // Siapkan data untuk dikirim ke view
        $this->load->view('laporan/index', $data); // Load view laporan dan kirim datanya
    }
}
