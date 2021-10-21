<?php

class Kategori extends CI_Controller{
    public function keranjang()
    {
        $data['keranjang'] = $this->model_kategori->data_keranjang()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('keranjang',$data);
        $this->load->view('templates/footer');
    }
}