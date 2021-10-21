<?php

class Data_produk extends CI_Controller{
    public function index()
    {
        $data['barang'] = $this->model_barang->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_produk',$data);
        $this->load->view('templates_admin/footer');
    }
    public function tambah_aksi()
    {
        $nama_brg       = $this->input->post('nama_brg');
        $keterangan     = $this->input->post('keterangan');
        $kategori       = $this->input->post('kategori');
        $harga       = $this->input->post('harga');
        $stock       = $this->input->post('stock');
        $gambar       = $_FILES['gambar']['name'];
        if ($gambar=''){}else{
            $config ['upload_path'] = './uploads';
            $config ['allowed_types'] = 'jpg|jpeg|png|gif|';

            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('gambar')){
                echo "Gambar gagal diupload";
            }else{
                $gambar=$this->upload->data('file_name');
            }
        }
        $data = array(
            'nama_brg'      => $nama_brg,
            'keterangan'    => $keterangan,
            'kategori'      => $kategori,
            'harga'         => $harga,
            'stock'         => $stock,
            'gambar'        => $gambar
        );
        $this->model_barang->tambah_barang($data, 'tb_barang');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Berhasil Ditambahkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('admin/data_produk/index');
    }

    public function edit($id)
    {
        $where = array('id_brg' =>$id);
        $data['barang'] = $this->model_barang->edit_barang($where,'tb_barang')->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/edit_barang',$data);
        $this->load->view('templates_admin/footer');
    }

    public function update()
    {
        $id                 = $this->input->post('id_brg');
        $nama_brg           = $this->input->post('nama_brg');
        $keterangan         = $this->input->post('keterangan');
        $kategori           = $this->input->post('kategori');
        $harga              = $this->input->post('harga');
        $stock              = $this->input->post('stock');

        $data = array(
                'nama_brg'      => $nama_brg,
                'keterangan'    => $keterangan,
                'kategori'      => $kategori,
                'harga'         => $harga,
                'stock'         => $stock
        );
        $where = array(
            'id_brg'    => $id
        );

        $this->model_barang->update_data($where,$data,'tb_barang');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Berhasil Diupdate
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('admin/data_produk/index');
    }

    public function hapus($id)
    {
        $where = array('id_brg' => $id);
        $this->model_barang->hapus_data($where, 'tb_barang');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Berhasil Dihapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('admin/data_produk/index');
    }
}