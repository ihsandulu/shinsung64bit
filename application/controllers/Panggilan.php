<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class panggilan extends MY_Controller
{

    private $db_kis = "";
    function __construct()
    {
        parent::__construct();
		$this->is_logedin();
		$this->lang->load('auth');
    }

        public function Inspect($line_ , $id_schedule) {
            // pre($this->session->userdata());
            $data['id_schedule']=$id_schedule;
            $data['line_']=$line_;

            $sql = " Select * from ref_panggilan  "; 
            $data['unc_list'] = $this->db->query($sql)->result_array();
            $sql = " Select * from inspect_v2_panggilan  where line = '$line_' "; 
            $data['unc_sch'] = $this->db->query($sql)->result_array();
            $this->load->view('panggilan/Endline/inputan', $data);

        }

        public function InsertpanggilanEndline($line_ , $id_schedule){
            pre($id_schedule);
            pre($_POST);
            $check = $this->input->post("checkboxList");

            $this->db->query("delete from inspect_v2_panggilan where line = $line_");

            foreach ($check as $key => $value) {
                // code...
                 $data['line'] = $line_;
                 $data['panggilan_nama'] = $value;
                 $this->db->insert('inspect_v2_panggilan' , $data);
                 // kirim bot 
                 //cari id telegram 
                 $sql = "select idtelegram from ref_panggilan where nama = '$value' "; 
                 $cd = execute_query_and_log($sql);
                 if ($cd)
                 {
                    $this->kirimPesanTelegram( $cd['idtelegram'] , "$value DIMOHON SEGERA KE LINE $line_" );
                 }
            }
            $this->Inspect($line_ , $id_schedule);
            // exit();

        }


         function kirimPesanTelegram( $idtelegram , $pesan) {
  
    // URL untuk mengirim pesan
    // $url = "https://api.telegram.org/bot{$token}/sendMessage"; User id: 568052191
    //$userId = '-1002022957796';
    $userId = $idtelegram ;
    $url = "https://api.telegram.org/bot6754617894:AAF529zenlm6tlsTn8tOOqVJ6AWSm_zgi2Y/sendMessage?parse_mode=markdown" ;
    // $url = "https://api.telegram.org/bot{$token}/sendMessage";
    // $url = "https://api.telegram.org/bot6754617894:AAF529zenlm6tlsTn8tOOqVJ6AWSm_zgi2Y/sendMessage?parse_mode=markdown&chat_id=-279721493&text=$pesan";

    // Data yang akan dikirim
    $data = [
        'chat_id' => $userId,
        'text' => urldecode($pesan),
    ];
    pre($data);

    $options = [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_ENCODING => "",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => false, // Hanya digunakan untuk pengembangan lokal, sebaiknya dihapus di produksi
    ];

    $ch = curl_init();
    curl_setopt_array($ch, $options);

    $response = curl_exec($ch);
    curl_close($ch);

    // Respon dari Telegram Bot API
    return json_decode($response, true);
}





    
}