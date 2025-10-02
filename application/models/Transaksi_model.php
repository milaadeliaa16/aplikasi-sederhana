<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Transaksi_model extends CI_Model {

    // Fungsi untuk mengambil semua data transaksi
    public function get_all() {
        return $this->db->get('transaksi')->result(); 
        // Ambil semua data dari tabel 'transaksi'
        // result() => mengembalikan array object
    }

    // Fungsi untuk menambahkan transaksi baru
    public function insert($data) {
        return $this->db->insert('transaksi', $data); 
        // Insert data array ke tabel 'transaksi'
        
    }

    // Fungsi untuk laporan bulanan, menjumlahkan total per tanggal
    public function get_report_monthly($bulan, $tahun) {
        $this->db->select("DATE(tanggal) as tanggal, SUM(total) as total_harian"); 
        $this->db->from("transaksi"); // Dari tabel transaksi
        $this->db->where("MONTH(tanggal)", $bulan); 
        $this->db->where("YEAR(tanggal)", $tahun);  
        $this->db->group_by("DATE(tanggal)"); 
        $this->db->order_by("tanggal", "ASC"); 
        return $this->db->get()->result(); // Ambil hasil sebagai array object
    }
}
