<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Render extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('Ciqrcode');
    $this->load->library('Zend');
    $this->load->database();
  }

  public function index()
  {
    $data['title'] = "";
    $data['data']  = $this->db->get('KMJ1_MESIN_INVENTORY.dbo.mesin')->result_array();
    //pre($data);
    $this->load->view('render', $data); 
  }

  public function QRcode($kodenya)
  {
    //render  qr code dengan format gambar PNG
    QRcode::png(
      $kodenya,
      $outfile = false,
      $level = QR_ECLEVEL_H,
      $size  = 6,
      $margin = 2
    );
  }

  public function Barcode($kodenya)
  {
    $this->zend->load('Zend/Barcode');
    Zend_Barcode::render('code128', 'image', array('text' => $kodenya));
  }

}

/* End of file Render.php */
/* Location: ./application/controllers/Render.php */