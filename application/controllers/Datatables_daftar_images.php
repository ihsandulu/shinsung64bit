<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Datatables_daftar_images extends MY_Controller 
{
    function __construct()
    {
        parent::__construct();
		$this->db_kis  = $this->load->database('kis', TRUE);
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function daftar_images_listdata()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select * from v_style_images_all ";
        $qdef = $q;
        if (count($myArray) > 0) {
            for ($index = 0; $index < count($myArray); $index++) {
                $q = "Select * from ( " . $q . " ) as tbd ";
                $q .= " where cari like '%" . trim($myArray[$index]) . "%'";
            }
        } else {
            $q = "Select * from ( " . $q . " ) as tbd ";
            $q .= " where cari like '%" . $myString . "%'";
        }
        $qcountfilter = $q;
        $q = "Select  * , ROW_NUMBER() OVER(ORDER BY id   desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
        if ($orderstart == 0) {
            $q = "Select * from ($q) as d where ROWNUM between " . $orderstart . " and " .
                $orderlecgth . " order by rownum";
        } else {
            $order2 = $orderstart + 1;
            $q = "Select * from ($q) as d where ROWNUM between " . $order2 . " and " . $orderstart *
                2 . " order by rownum";
        }
        //print_r($q); exit;
        $hasilquery = $CI->db_kis->query($q);
        $data = array();
        $no = $_POST['start'];
        $data = array();
        foreach ($hasilquery->result() as $row) {
            $no++;
            $nestedData = array();
			
			if($row->id_images != "") {
				$id_image = $row->id_images;
			} else {
				$id_image = '0';
			}
			$nestedData[] = '<a href="'. base_url().'Daftar_images/add/' . $id_image.'/'.base64_encode($row->id).'"><button type="button" class="btn btn-danger btn-sm"> <i class="fa fa-edit"></i> </button></a>';

			//'.base_url().'purchase_order/detail/'.$row->id_purchase_order.'
			//$nestedData[] = $row->id;
			$nestedData[] = $row->STYLE_NO;
			$nestedData[] = $row->COLOR;
			if($row->images != "") {
				$nestedData[] = '<img src="'.base_url().'uploads/style_all/'.$row->images.'" height="50">';
			} else {
				$nestedData[] = '';
			}
			
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from v_style_images_all ";
        $record_total = $CI->db_kis->query($sql)->row()->num;
        $sql = "Select count(*) as num  from ($qcountfilter) as c   ";
        $recordsFiltered = $CI->db_kis->query($sql)->row()->num;

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $record_total,  
            "recordsFiltered" => $recordsFiltered, 
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }


 
}