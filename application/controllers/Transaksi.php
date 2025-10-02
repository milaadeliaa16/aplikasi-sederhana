<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
 * Transaksi Controller
 *
 * @property CI_Session $session               
 * @property Transaksi_model $Transaksi_model 
 * @property CI_Input $input                   
 */
class Transaksi extends CI_Controller {
    
    public function __construct() {
        parent::__construct(); 
        $this->load->model('Transaksi_model'); 

        $this->load->library('session'); 

        // Cek apakah user sudah login, jika belum redirect ke login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth'); // Halaman login
        }
    }

    // Halaman utama transaksi (list semua transaksi)
    public function index() {
        $data['transaksi'] = $this->Transaksi_model->get_all(); // Ambil semua transaksi dari database

        $viewData['content'] = 'transaksi/index';  
        $viewData['transaksi'] = $data['transaksi']; 
        $this->load->view('layouts/main', $viewData); 
    }

    // Fungsi untuk menambah transaksi baru
    public function tambah() {
        // Ambil data dari form POST
        $nama_barang = $this->input->post('nama_barang', TRUE); 
        $jumlah      = (int)$this->input->post('jumlah');       
        $harga       = (int)$this->input->post('harga');        
        $total       = $jumlah * $harga;                        

        // Siapkan data untuk disimpan ke database
        $data = [
            'nama_barang' => $nama_barang,
            'jumlah'      => $jumlah,
            'harga'       => $harga,
            'total'       => $total,
            'tanggal'     => date('Y-m-d') 
        ];

        // Simpan transaksi melalui model
        if ($this->Transaksi_model->insert($data)) {
            $this->session->set_flashdata('success', 'Transaksi berhasil disimpan'); 
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan transaksi');   
        }

        redirect('transaksi'); // Kembali ke halaman transaksi
    }
}
