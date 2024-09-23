<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Log
 */
class Daftar_images extends MY_Controller
{
	private $db_kis = "";
	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
	    $this->load->helper(array('form', 'url'));
	    $this->db_kis  = $this->load->database('kis', TRUE);
		$this->load->helper('url');
		$this->load->library(['ion_auth', 'form_validation']);
	}

	public function index()
	{
		$data['pagetitle'] = 'DAFTAR IMAGES BY STYLE AND COLOR ';
		$this->loadViews('Daftar_images/Index', $data);
	}
	
	
	
	public function add() {
    // ambil data dengan kode yang diberikan
    
	$data['pagetitle'] = 'ADD NEW';
	$id_image = $this->uri->segment(3);
	$id = base64_decode($this->uri->segment(4));
	$id_ = explode('|',$id);
	$style_no = trim($id_[0]);
	$color = trim($id_[1]);
	
	$data['style_no']  = $style_no; 
	$data['color']  = $color; 
	
	$sql = $this->db->query("SELECT * FROM style_image_all where id = '$id_image'");
	$row = $sql->row_array();
	
	$data_image['image']  = $sql->row_array(); 
	$data['images']  = $data_image['image']['images'];
	//pre($data);
    $this->loadViews('Daftar_images/add', $data);
  }
  
  
  
  public function submit() {
    $id_image = $this->input->post('id_image');
    $style_no = $this->input->post('style_no');
    $color = $this->input->post('color');

    // mengupload gambar dan menyimpan nama file ke dalam tabel
    $config['upload_path'] = './uploads/style_all/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 1024;
    $config['max_width'] = 1024;
    $config['max_height'] = 768;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('lokasi_gambar')) {
      // jika gagal upload gambar, tampilkan pesan error
      $error = array('error' => $this->upload->display_errors());
      // pre($error);
      //// $this->load->view('upload_form', $error);
      $data['pagetitle'] = 'masalah';
       $data['error'] = $error;
       $this->loadViews('error', $data);

    } else {
      // jika berhasil upload gambar, simpan data ke dalam database
      $gambar_data = $this->upload->data();
      $data = array(
        'style_no' => $style_no,
        'color' => $color,
        'images' => $gambar_data['file_name']
      );
	  if($id_image == "0") {
    	$this->db->insert('style_image_all', $data);
      
	   } else {
		$this->db->where('id', $id_image);
		$this->db->update('style_image_all', $data);
		
		unlink(realpath('./uploads/style_all/'.$this->input->post('lokasi_gambar_asli')));
		
	   }
		//$data['defects'] = $this->db->get('daftar_defect')->result_array();
      // redirect ke halaman sukses
     redirect('Daftar_images/Index', 'refresh');
    }
  }
  
  
  
}

/* End of file Log.php */
/* Location: ./application/controllers/Log.php */