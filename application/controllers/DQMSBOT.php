<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  DQMSBOT extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->lang->load('auth');
	}

	public function CaraRegistarasi()
    {
        echo "chat dulu ke IDBot kemudian  /start ";
        echo "<br> setelah info kan ke IT P.S. Your ID: xxxxxxxx";
        echo "<br> chat ke DQMS_KMJ1bot kemudian  /start ";

    } 

	public function Panggil_bot($line)
    {
        $data['pagetitle'] = 'PILIHAN PANGGILAN '; 		
		//pre($data);
		$data['line']= $line;
		$this->loadViews('Bot/DQMSBOT/Panggil_bot', $data);
		 // $this->load->view('Bot/DQMSBOT/Panggil_bot', $data);
    } 

	public function KirimPesan($pesan)
	{
		echo $pesan;
	
			$curl = curl_init();

		curl_setopt_array($curl, [
		    CURLOPT_URL => "https://api.telegram.org/bot6754617894:AAF529zenlm6tlsTn8tOOqVJ6AWSm_zgi2Y/sendMessage?parse_mode=markdown&chat_id=-1002072078003&text=$pesan",
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_ENCODING => "",
		    CURLOPT_MAXREDIRS => 10,
		    CURLOPT_TIMEOUT => 30,
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_CUSTOMREQUEST => "GET",
		    CURLOPT_SSL_VERIFYPEER => false, // Non-production only, use with caution!
		    CURLOPT_SSL_VERIFYHOST => false, // Non-production only, use with caution!
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		    echo "cURL Error #:" . $err;
		} else {
		    echo $response;
		}
	}





   function kirimPesanTelegram(  $pesan) {
  
    // URL untuk mengirim pesan
    // $url = "https://api.telegram.org/bot{$token}/sendMessage"; User id: 568052191
    $userId = '-1002022957796';
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