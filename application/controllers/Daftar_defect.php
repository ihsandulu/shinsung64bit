<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Log
 */
class Daftar_defect extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
	}

	public function index()
	{
		$data['pagetitle'] = 'DAFTAR DEFECT';
		$data['defects'] = $this->db->get('daftar_defect')->result_array();

		$this->loadViews('Daftar_defect/index', $data);
	}
	
	public function list_defect()
	{
		$data['pagetitle'] = 'DAFTAR DEFECT';
		$data['defects'] = $this->db->get('daftar_defect')->result_array();

		$this->loadViews('Daftar_defect/list_defect', $data);
	}
	
	public function list_defect_info()
	{
		$data['pagetitle'] = 'DAFTAR DEFECT';
		$data['defects'] = $this->db->get('daftar_defect')->result_array();

		$this->load->view('Daftar_defect/list_defect', $data);
	}


  	public function add_new() {
    // ambil data dengan kode yang diberikan
    $data['pagetitle'] = 'ADD NEW';
    // tampilkan form edit
    //$this->load->view('edit_form', $data);
    $this->loadViews('Daftar_defect/add_form', $data);
  }

	public function submit() {
    $jenis = $this->input->post('jenis');
    $kode = $this->input->post('kode');
    $keterangan = $this->input->post('keterangan');

    // mengupload gambar dan menyimpan nama file ke dalam tabel
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 1024;
    $config['max_width'] = 1024;
    $config['max_height'] = 768;

    $this->load->library('upload', $config);

    /* if (!$this->upload->do_upload('lokasi_gambar')) {
      // jika gagal upload gambar, tampilkan pesan error
      $error = array('error' => $this->upload->display_errors());
      // pre($error);
      //// $this->load->view('upload_form', $error);
      $data['pagetitle'] = 'masalah';
       $data['error'] = $error;
       $this->loadViews('error', $data);

    } else {
      // jika berhasil upload gambar, simpan data ke dalam database
      $gambar_data = $this->upload->data(); */
      $data = array(
        'jenis' => $jenis,
        'kode' => $kode,
        'keterangan' => $keterangan/* ,
        'lokasi_gambar' => $gambar_data['file_name'] */
      );

      $this->db->insert('daftar_defect', $data);
       $data['defects'] = $this->db->get('daftar_defect')->result_array();
      // redirect ke halaman sukses
      $this->index();
    // }
  }


  public function edit($kode) {
    // ambil data dengan kode yang diberikan
    $data['defect'] = $this->db->get_where('daftar_defect', array('kode' => $kode))->row_array();

     $data['pagetitle'] = 'EDIT DEFECT KODE'.$data['defect']['kode'] ;

    // tampilkan form edit
    //$this->load->view('edit_form', $data);
    $this->loadViews('Daftar_defect/edit_form', $data);
  }

  public function update($kode) {
    // ambil data dari form input
    $jenis = $this->input->post('jenis');
    $keterangan = $this->input->post('keterangan');

    // update data dengan kode yang diberikan
    $this->db->where('kode', $kode);
    $this->db->update('daftar_defect', array(
      'jenis' => $jenis,
      'keterangan' => $keterangan,
    ));
 	$this->index();
    // redirect ke halaman daftar list
    // redirect('Daftar_defect/index');
  }


}

/* End of file Log.php */
/* Location: ./application/controllers/Log.php */