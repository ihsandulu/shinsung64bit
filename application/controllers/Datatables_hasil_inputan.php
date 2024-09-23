<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Datatables_hasil_inputan extends MY_Controller 
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

    public function hasil_inputan_listdata()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select * from v_hasil_ispect_defect ";
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
        $q = "Select  * , ROW_NUMBER() OVER(ORDER BY time_stamp   desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
        if ($orderstart == 0) {
            $q = "Select * from ($q) as d where ROWNUM between " . $orderstart . " and " .
                $orderlecgth . " order by rownum";
        } else {
            $order2 = $orderstart + 1;
            $q = "Select * from ($q) as d where ROWNUM between " . $order2 . " and " . $orderstart *
                2 . " order by rownum";
        }
        //print_r($q); exit;
        $hasilquery = $CI->db->query($q);
        $data = array();
        $no = $_POST['start'];
        $data = array();
        foreach ($hasilquery->result() as $row) {
            $no++;
            $nestedData = array();
			
			$nestedData[] = '<button type="button" class="btn btn-danger btn-xs" onclick="hasil_defect_delete(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button>';

			//'.base_url().'purchase_order/detail/'.$row->id_purchase_order.'
			//$nestedData[] = $row->id;
			$nestedData[] = $row->kanaan_po;
			$nestedData[] = $row->style;
			$nestedData[] = $row->color;
			$nestedData[] = 'LINE '. $row->line;
			$nestedData[] = $row->time_stamp;
			$nestedData[] = $row->kode_defect;
			$nestedData[] = $row->keterangan;
			
			
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from v_hasil_ispect_defect ";
        $record_total = $CI->db->query($sql)->row()->num;
        $sql = "Select count(*) as num  from ($qcountfilter) as c   ";
        $recordsFiltered = $CI->db->query($sql)->row()->num;

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $record_total,  
            "recordsFiltered" => $recordsFiltered, 
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }



    public function hasil_inputan_listdata_ok()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select * from v_hasil_ispect_ok ";
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
        $q = "Select  * , ROW_NUMBER() OVER(ORDER BY time_stamp   desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
        if ($orderstart == 0) {
            $q = "Select * from ($q) as d where ROWNUM between " . $orderstart . " and " .
                $orderlecgth . " order by rownum";
        } else {
            $order2 = $orderstart + 1;
            $q = "Select * from ($q) as d where ROWNUM between " . $order2 . " and " . $orderstart *
                2 . " order by rownum";
        }
        //print_r($q); exit;
        $hasilquery = $CI->db->query($q);
        $data = array();
        $no = $_POST['start'];
        $data = array();
        foreach ($hasilquery->result() as $row) {
            $no++;
            $nestedData = array();
			
			$nestedData[] = '<button type="button" class="btn btn-danger btn-xs" onclick="hasil_ok_delete(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button>';

			//'.base_url().'purchase_order/detail/'.$row->id_purchase_order.'
			//$nestedData[] = $row->id;
			$nestedData[] = $row->kanaan_po;
			$nestedData[] = $row->style;
			$nestedData[] = $row->color;
			$nestedData[] = 'LINE '. $row->line;
			$nestedData[] = $row->time_stamp;
			
			
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from v_hasil_ispect_ok ";
        $record_total = $CI->db->query($sql)->row()->num;
        $sql = "Select count(*) as num  from ($qcountfilter) as c   ";
        $recordsFiltered = $CI->db->query($sql)->row()->num;

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $record_total,  
            "recordsFiltered" => $recordsFiltered, 
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }




public function hasil_inputan_listdata_output()
{
    $orderstart = $_POST['start'];
    $orderlecgth = $_POST['length'];
    $myString = $_POST['search']['value'];
    $myArray = explode(';', $myString);
    $CI = &get_instance();
    $q = " Select * from v_hasil_output ";
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
    $q = "Select  * , ROW_NUMBER() OVER(ORDER BY tanggal_hasil desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
    if ($orderstart == 0) {
        $q = "Select * from ($q) as d where ROWNUM between " . $orderstart . " and " .
            $orderlecgth . " order by rownum";
    } else {
        $order2 = $orderstart + 1;
        $q = "Select * from ($q) as d where ROWNUM between " . $order2 . " and " . $orderstart *
            2 . " order by rownum";
    }
    //print_r($q); exit;
    $hasilquery = $CI->db->query($q);
    $data = array();
    $no = $_POST['start'];
    $data = array();
    foreach ($hasilquery->result() as $row) {
        $no++;
        $nestedData = array();
		//'.base_url().'purchase_order/detail/'.$row->id_purchase_order.'
		//$nestedData[] = $row->id;
		$nestedData[] = '<input type="datetime-local" step="1" id="tanggal_hasil_'.$row->id.'" value="'.format_tanggal($row->TANGGAL_HASIL).'"/>';
		$nestedData[] = 'LINE '.$row->LINE;
		$nestedData[] = $row->KANAAN_PO;
		$nestedData[] = $row->STYLE_NO;
		$nestedData[] = $row->COLOR;
		$nestedData[] = $row->QTYGLOBAL;
		$nestedData[] = $row->DES;

		//JAM NORMAL 
		
		$hariini = date('l');
		if($hariini =="Friday") {
			if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:10:00.000') {
				$jamke = '1';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:50:00.000') {
				$jamke = '2';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:30:00.000') {
				$jamke = '3';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:10:00.000') {
				$jamke = '4';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:50:00.000') {
				$jamke = '5';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:30:00.000') {
				$jamke = '6';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:25:00.000') {
				$jamke = '7';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:20:00.000') {
				$jamke = '8';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:00:00.000') {
				$jamke = '9';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:40:00.000') {
				$jamke = '10';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:20:00.000') {
				$jamke = '11';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:00:00.000') {
				$jamke = '12';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
				$jamke = '13';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:55:00.000') {
				$jamke = '14';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:35:00.000') {
				$jamke = '15';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:55:00.000') {
				$jamke = '16';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 19:35:00.000') {
				$jamke = '17';
			} else {
				$jamke = '18';
			}
		} else {
			if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:10:00.000') {
				$jamke = '1';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:50:00.000') {
				$jamke = '2';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:30:00.000') {
				$jamke = '3';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:10:00.000') {
				$jamke = '4';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:50:00.000') {
				$jamke = '5';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:30:00.000') {
				$jamke = '6';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:10:00.000') {
				$jamke = '7';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:50:00.000') {
				$jamke = '8';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:30:00.000') {
				$jamke = '9';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:10:00.000') {
				$jamke = '10';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:50:00.000') {
				$jamke = '11';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:30:00.000') {
				$jamke = '12';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:25:00.000') {
				$jamke = '13';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:05:00.000') {
				$jamke = '14';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
				$jamke = '15';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
				$jamke = '16';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:45:00.000') {
				$jamke = '17';
			} else {
				$jamke = '18';
			}
			
		}
		
		
		
		
		
		
		/*
		//JAM PUASA 
		$hariini = date('l');
		if($hariini =="Friday") {
			if($row->TANGGAL_HASIL <= date('Y-m-d').' 06:40:00.000') {
				$jamke = '1';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:20:00.000') {
				$jamke = '2';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:00:00.000') {
				$jamke = '3';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:40:00.000') {
				$jamke = '4';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:20:00.000') {
				$jamke = '5';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:00:00.000') {
				$jamke = '6';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:55:00.000') {
				$jamke = '7';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:35:00.000') {
				$jamke = '8';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:15:00.000') {
				$jamke = '9';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:55:00.000') {
				$jamke = '10';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:35:00.000') {
				$jamke = '11';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:15:00.000') {
				$jamke = '12';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:55:00.000') {
				$jamke = '13';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:45:00.000') {
				$jamke = '14';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
				$jamke = '15';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:25:00.000') {
				$jamke = '16';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 19:05:00.000') {
				$jamke = '17';
			} else {
				$jamke = '18';
			}
		} else {
			if($row->TANGGAL_HASIL <= date('Y-m-d').' 06:40:00.000') {
				$jamke = '1';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:20:00.000') {
				$jamke = '2';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:00:00.000') {
				$jamke = '3';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:40:00.000') {
				$jamke = '4';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:20:00.000') {
				$jamke = '5';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:00:00.000') {
				$jamke = '6';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:10:00.000') {
				$jamke = '7';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:50:00.000') {
				$jamke = '8';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:30:00.000') {
				$jamke = '9';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:10:00.000') {
				$jamke = '10';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:50:00.000') {
				$jamke = '11';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:30:00.000') {
				$jamke = '12';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:25:00.000') {
				$jamke = '13';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:05:00.000') {
				$jamke = '14';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:45:00.000') {
				$jamke = '15';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
				$jamke = '16';
			} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
				$jamke = '17';
			} else {
				$jamke = '18';
			}
			
		}
		*/	
	
		$nestedData[] = $jamke;
		
					
		$nestedData[] = '<input type="number" name="qty_'.$row->id.'" id="qty_'.$row->id.'" value='.$row->QTY.' style="width:75px;"> <button class="btn btn-success btn-xs" onclick="update_qty(' . $row->id . ');"> <i class="fa fa- fa-edit"></i> UPDATE</button>
		<a href="#myModalAdd" data-toggle="modal" id="add" data-id="'.$row->id.'_'.$row->LINE.'">
		<button class="btn btn-danger btn-xs"> <i class="fa fa- fa-edit"></i> PINDAH STYLE</button></a>
		' ;	
		
		
        $data[] = $nestedData;
    }

    $sql = "Select count(*) as num  from v_hasil_output ";
    $record_total = $CI->db->query($sql)->row()->num;
    $sql = "Select count(*) as num  from ($qcountfilter) as c   ";
    $recordsFiltered = $CI->db->query($sql)->row()->num;

    $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => $record_total,  
        "recordsFiltered" => $recordsFiltered, 
        "data" => $data,
    );

    //output dalam format JSON
    echo json_encode($output);
}

public function hasil_inputan_output_packing()
{
    $orderstart = $_POST['start'];
    $orderlecgth = $_POST['length'];
    $myString = $_POST['search']['value'];
    $myArray = explode(';', $myString);
    $CI = &get_instance();
    $q = " Select * from v_hasil_output_packing ";
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
    $q = "Select  * , ROW_NUMBER() OVER(ORDER BY tanggal_hasil desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
    if ($orderstart == 0) {
        $q = "Select * from ($q) as d where ROWNUM between " . $orderstart . " and " .
            $orderlecgth . " order by rownum";
    } else {
        $order2 = $orderstart + 1;
        $q = "Select * from ($q) as d where ROWNUM between " . $order2 . " and " . $orderstart *
            2 . " order by rownum";
    }
    //print_r($q); exit;
    $hasilquery = $CI->db->query($q);
    $data = array();
    $no = $_POST['start'];
    $data = array();
    foreach ($hasilquery->result() as $row) {
        $no++;
        $nestedData = array();
        //'.base_url().'purchase_order/detail/'.$row->id_purchase_order.'
        //$nestedData[] = $row->id;
        $nestedData[] = '<input type="datetime-local" step="1" id="tanggal_hasil_'.$row->id.'" value="'.format_tanggal($row->TANGGAL_HASIL).'"/>';
        // $nestedData[] = $row->TANGGAL_HASIL;
        $nestedData[] = 'LINE '.$row->LINE;
        $nestedData[] = $row->KANAAN_PO;
        $nestedData[] = $row->STYLE_NO;
        $nestedData[] = $row->COLOR;
        $nestedData[] = $row->QTYGLOBAL;
        $nestedData[] = $row->DES;

        //JAM NORMAL 
      
        $hariini = date('l');
        if($hariini =="Friday") {
            if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:10:00.000') {
                $jamke = '1';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:50:00.000') {
                $jamke = '2';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:30:00.000') {
                $jamke = '3';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:10:00.000') {
                $jamke = '4';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:50:00.000') {
                $jamke = '5';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:30:00.000') {
                $jamke = '6';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:25:00.000') {
                $jamke = '7';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:20:00.000') {
                $jamke = '8';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:00:00.000') {
                $jamke = '9';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:40:00.000') {
                $jamke = '10';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:20:00.000') {
                $jamke = '11';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:00:00.000') {
                $jamke = '12';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
                $jamke = '13';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:55:00.000') {
                $jamke = '14';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:35:00.000') {
                $jamke = '15';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:55:00.000') {
                $jamke = '16';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 19:35:00.000') {
                $jamke = '17';
            } else {
                $jamke = '18';
            }
        } else {
            if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:10:00.000') {
                $jamke = '1';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:50:00.000') {
                $jamke = '2';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:30:00.000') {
                $jamke = '3';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:10:00.000') {
                $jamke = '4';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:50:00.000') {
                $jamke = '5';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:30:00.000') {
                $jamke = '6';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:10:00.000') {
                $jamke = '7';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:50:00.000') {
                $jamke = '8';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:30:00.000') {
                $jamke = '9';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:10:00.000') {
                $jamke = '10';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:50:00.000') {
                $jamke = '11';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:30:00.000') {
                $jamke = '12';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:25:00.000') {
                $jamke = '13';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:05:00.000') {
                $jamke = '14';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
                $jamke = '15';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
                $jamke = '16';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:45:00.000') {
                $jamke = '17';
            } else {
                $jamke = '18';
            }
            
        }
        
        
        
        
        
        
        /*
        //JAM PUASA 
        $hariini = date('l');
        if($hariini =="Friday") {
            if($row->TANGGAL_HASIL <= date('Y-m-d').' 06:40:00.000') {
                $jamke = '1';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:20:00.000') {
                $jamke = '2';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:00:00.000') {
                $jamke = '3';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:40:00.000') {
                $jamke = '4';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:20:00.000') {
                $jamke = '5';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:00:00.000') {
                $jamke = '6';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:55:00.000') {
                $jamke = '7';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:35:00.000') {
                $jamke = '8';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:15:00.000') {
                $jamke = '9';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:55:00.000') {
                $jamke = '10';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:35:00.000') {
                $jamke = '11';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:15:00.000') {
                $jamke = '12';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:55:00.000') {
                $jamke = '13';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:45:00.000') {
                $jamke = '14';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
                $jamke = '15';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:25:00.000') {
                $jamke = '16';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 19:05:00.000') {
                $jamke = '17';
            } else {
                $jamke = '18';
            }
        } else {
            if($row->TANGGAL_HASIL <= date('Y-m-d').' 06:40:00.000') {
                $jamke = '1';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:20:00.000') {
                $jamke = '2';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:00:00.000') {
                $jamke = '3';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:40:00.000') {
                $jamke = '4';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:20:00.000') {
                $jamke = '5';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:00:00.000') {
                $jamke = '6';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:10:00.000') {
                $jamke = '7';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:50:00.000') {
                $jamke = '8';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:30:00.000') {
                $jamke = '9';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:10:00.000') {
                $jamke = '10';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:50:00.000') {
                $jamke = '11';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:30:00.000') {
                $jamke = '12';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:25:00.000') {
                $jamke = '13';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:05:00.000') {
                $jamke = '14';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:45:00.000') {
                $jamke = '15';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
                $jamke = '16';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
                $jamke = '17';
            } else {
                $jamke = '18';
            }
            
        }
    */    
    
        $nestedData[] = $jamke;
        
                    
        $nestedData[] = '<input type="number" name="qty_'.$row->id.'" id="qty_'.$row->id.'" value='.$row->QTY.' style="width:75px;"> <button class="btn btn-success btn-xs" onclick="update_qty(' . $row->id . ');"> <i class="fa fa- fa-edit"></i> UPDATE</button>
        <a href="#myModalAdd" data-toggle="modal" id="add" data-id="'.$row->id.'_'.$row->LINE.'">
        <button class="btn btn-danger btn-xs"> <i class="fa fa- fa-edit"></i> PINDAH STYLE</button></a>
        ' ; 
        
        
        $data[] = $nestedData;
    }

    $sql = "Select count(*) as num  from v_hasil_output_packing ";
    $record_total = $CI->db->query($sql)->row()->num;
    $sql = "Select count(*) as num  from ($qcountfilter) as c   ";
    $recordsFiltered = $CI->db->query($sql)->row()->num;

    $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => $record_total,  
        "recordsFiltered" => $recordsFiltered, 
        "data" => $data,
    );

    //output dalam format JSON
    echo json_encode($output);
}

public function hasil_inputan_output_ironing()
{
    $orderstart = $_POST['start'];
    $orderlecgth = $_POST['length'];
    $myString = $_POST['search']['value'];
    $myArray = explode(';', $myString);
    $CI = &get_instance();
    $q = " Select * from v_hasil_output_ironing ";
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
    $q = "Select  * , ROW_NUMBER() OVER(ORDER BY tanggal_hasil desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
    if ($orderstart == 0) {
        $q = "Select * from ($q) as d where ROWNUM between " . $orderstart . " and " .
            $orderlecgth . " order by rownum";
    } else {
        $order2 = $orderstart + 1;
        $q = "Select * from ($q) as d where ROWNUM between " . $order2 . " and " . $orderstart *
            2 . " order by rownum";
    }
    //print_r($q); exit;
    $hasilquery = $CI->db->query($q);
    $data = array();
    $no = $_POST['start'];
    $data = array();
    foreach ($hasilquery->result() as $row) {
        $no++;
        $nestedData = array();
        //'.base_url().'purchase_order/detail/'.$row->id_purchase_order.'
        //$nestedData[] = $row->id;
        // $nestedData[] = $row->TANGGAL_HASIL;

        $nestedData[] = '<input id="tanggal_hasil_'.$row->id.'" step="1" type="datetime-local" value="'.format_tanggal($row->TANGGAL_HASIL).'" />';

        $nestedData[] = 'LINE '.$row->LINE;
        $nestedData[] = $row->KANAAN_PO;
        $nestedData[] = $row->STYLE_NO;
        $nestedData[] = $row->COLOR;
        $nestedData[] = $row->QTYGLOBAL;
        $nestedData[] = $row->DES;

        //JAM NORMAL 
        
        $hariini = date('l');
        if($hariini =="Friday") {
            if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:10:00.000') {
                $jamke = '1';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:50:00.000') {
                $jamke = '2';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:30:00.000') {
                $jamke = '3';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:10:00.000') {
                $jamke = '4';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:50:00.000') {
                $jamke = '5';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:30:00.000') {
                $jamke = '6';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:25:00.000') {
                $jamke = '7';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:20:00.000') {
                $jamke = '8';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:00:00.000') {
                $jamke = '9';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:40:00.000') {
                $jamke = '10';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:20:00.000') {
                $jamke = '11';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:00:00.000') {
                $jamke = '12';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
                $jamke = '13';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:55:00.000') {
                $jamke = '14';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:35:00.000') {
                $jamke = '15';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:55:00.000') {
                $jamke = '16';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 19:35:00.000') {
                $jamke = '17';
            } else {
                $jamke = '18';
            }
        } else {
            if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:10:00.000') {
                $jamke = '1';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:50:00.000') {
                $jamke = '2';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:30:00.000') {
                $jamke = '3';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:10:00.000') {
                $jamke = '4';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:50:00.000') {
                $jamke = '5';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:30:00.000') {
                $jamke = '6';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:10:00.000') {
                $jamke = '7';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:50:00.000') {
                $jamke = '8';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:30:00.000') {
                $jamke = '9';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:10:00.000') {
                $jamke = '10';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:50:00.000') {
                $jamke = '11';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:30:00.000') {
                $jamke = '12';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:25:00.000') {
                $jamke = '13';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:05:00.000') {
                $jamke = '14';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
                $jamke = '15';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
                $jamke = '16';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:45:00.000') {
                $jamke = '17';
            } else {
                $jamke = '18';
            }
            
        }
        
        
     
        
        
        
        
        //JAM PUASA 
       /*
	    $hariini = date('l');
        if($hariini =="Friday") {
            if($row->TANGGAL_HASIL <= date('Y-m-d').' 06:40:00.000') {
                $jamke = '1';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:20:00.000') {
                $jamke = '2';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:00:00.000') {
                $jamke = '3';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:40:00.000') {
                $jamke = '4';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:20:00.000') {
                $jamke = '5';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:00:00.000') {
                $jamke = '6';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:55:00.000') {
                $jamke = '7';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:35:00.000') {
                $jamke = '8';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:15:00.000') {
                $jamke = '9';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:55:00.000') {
                $jamke = '10';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:35:00.000') {
                $jamke = '11';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:15:00.000') {
                $jamke = '12';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:55:00.000') {
                $jamke = '13';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:45:00.000') {
                $jamke = '14';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
                $jamke = '15';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:25:00.000') {
                $jamke = '16';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 19:05:00.000') {
                $jamke = '17';
            } else {
                $jamke = '18';
            }
        } else {
            if($row->TANGGAL_HASIL <= date('Y-m-d').' 06:40:00.000') {
                $jamke = '1';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:20:00.000') {
                $jamke = '2';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:00:00.000') {
                $jamke = '3';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:40:00.000') {
                $jamke = '4';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:20:00.000') {
                $jamke = '5';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:00:00.000') {
                $jamke = '6';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:10:00.000') {
                $jamke = '7';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:50:00.000') {
                $jamke = '8';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:30:00.000') {
                $jamke = '9';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:10:00.000') {
                $jamke = '10';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:50:00.000') {
                $jamke = '11';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:30:00.000') {
                $jamke = '12';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:25:00.000') {
                $jamke = '13';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:05:00.000') {
                $jamke = '14';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:45:00.000') {
                $jamke = '15';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
                $jamke = '16';
            } else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
                $jamke = '17';
            } else {
                $jamke = '18';
            }
            
        }
      */  
    
        $nestedData[] = $jamke;
        
                    
        $nestedData[] = '<input type="number" name="qty_'.$row->id.'" id="qty_'.$row->id.'" value='.$row->QTY.' style="width:75px;"> <button class="btn btn-success btn-xs" onclick="update_qty(' . $row->id . ');"> <i class="fa fa- fa-edit"></i> UPDATE</button>
        <a href="#myModalAdd" data-toggle="modal" id="add" data-id="'.$row->id.'_'.$row->LINE.'">
        <button class="btn btn-danger btn-xs"> <i class="fa fa- fa-edit"></i> PINDAH STYLE</button></a>
        ' ; 
        
        
        $data[] = $nestedData;
    }

    $sql = "Select count(*) as num  from v_hasil_output_ironing ";
    $record_total = $CI->db->query($sql)->row()->num;
    $sql = "Select count(*) as num  from ($qcountfilter) as c   ";
    $recordsFiltered = $CI->db->query($sql)->row()->num;

    $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => $record_total,  
        "recordsFiltered" => $recordsFiltered, 
        "data" => $data,
    );

    //output dalam format JSON
    echo json_encode($output);
}
 
 
 public function hasil_inputan_listdata_output_hd()
    {
		
		$orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select * from v_hasil_output_hd ";
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
        $q = "Select  * , ROW_NUMBER() OVER(ORDER BY tanggal_hasil desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
        if ($orderstart == 0) {
            $q = "Select * from ($q) as d where ROWNUM between " . $orderstart . " and " .
                $orderlecgth . " order by rownum";
        } else {
            $order2 = $orderstart + 1;
            $q = "Select * from ($q) as d where ROWNUM between " . $order2 . " and " . $orderstart *
                2 . " order by rownum";
        }
        //print_r($q); exit;
        $hasilquery = $CI->db->query($q);
        $data = array();
        $no = $_POST['start'];
        $data = array();
        foreach ($hasilquery->result() as $row) {
            $no++;
            $nestedData = array();
			//'.base_url().'purchase_order/detail/'.$row->id_purchase_order.'
			//$nestedData[] = $row->id;
			$nestedData[] = $row->TANGGAL_HASIL;
			$nestedData[] = 'LINE '. $row->LINE;
			$nestedData[] = $row->KANAAN_PO;
			$nestedData[] = $row->STYLE_NO;
			$nestedData[] = $row->COLOR;
			$nestedData[] = $row->QTYGLOBAL;
			$nestedData[] = $row->DES;
			
			
			$hariini = date('l');
			
			if($hariini =="Friday") {
				if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:10:00.000') {
					$jamke = '1';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:50:00.000') {
					$jamke = '2';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:30:00.000') {
					$jamke = '3';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:10:00.000') {
					$jamke = '4';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:50:00.000') {
					$jamke = '5';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:30:00.000') {
					$jamke = '6';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:25:00.000') {
					$jamke = '7';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:20:00.000') {
					$jamke = '8';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:00:00.000') {
					$jamke = '9';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:40:00.000') {
					$jamke = '10';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:20:00.000') {
					$jamke = '11';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:00:00.000') {
					$jamke = '12';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
					$jamke = '13';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:55:00.000') {
					$jamke = '14';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:35:00.000') {
					$jamke = '15';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:55:00.000') {
					$jamke = '16';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 19:35:00.000') {
					$jamke = '17';
				} else {
					$jamke = '18';
				}
			} else {
				if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:10:00.000') {
					$jamke = '1';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:50:00.000') {
					$jamke = '2';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:30:00.000') {
					$jamke = '3';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:10:00.000') {
					$jamke = '4';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:50:00.000') {
					$jamke = '5';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:30:00.000') {
					$jamke = '6';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:10:00.000') {
					$jamke = '7';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:50:00.000') {
					$jamke = '8';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:30:00.000') {
					$jamke = '9';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:10:00.000') {
					$jamke = '10';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:50:00.000') {
					$jamke = '11';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:30:00.000') {
					$jamke = '12';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:25:00.000') {
					$jamke = '13';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:05:00.000') {
					$jamke = '14';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
					$jamke = '15';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
					$jamke = '16';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:45:00.000') {
					$jamke = '17';
				} else {
					$jamke = '18';
				}
				
			}
			
			
			
			/*
			//JAM PUASA 
			$hariini = date('l');
			if($hariini =="Friday") {
				if($row->TANGGAL_HASIL <= date('Y-m-d').' 06:40:00.000') {
					$jamke = '1';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:20:00.000') {
					$jamke = '2';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:00:00.000') {
					$jamke = '3';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:40:00.000') {
					$jamke = '4';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:20:00.000') {
					$jamke = '5';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:00:00.000') {
					$jamke = '6';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:55:00.000') {
					$jamke = '7';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:35:00.000') {
					$jamke = '8';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:15:00.000') {
					$jamke = '9';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:55:00.000') {
					$jamke = '10';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:35:00.000') {
					$jamke = '11';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:15:00.000') {
					$jamke = '12';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:55:00.000') {
					$jamke = '13';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:45:00.000') {
					$jamke = '14';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
					$jamke = '15';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:25:00.000') {
					$jamke = '16';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 19:05:00.000') {
					$jamke = '17';
				} else {
					$jamke = '18';
				}
			} else {
				if($row->TANGGAL_HASIL <= date('Y-m-d').' 06:40:00.000') {
					$jamke = '1';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 07:20:00.000') {
					$jamke = '2';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:00:00.000') {
					$jamke = '3';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 08:40:00.000') {
					$jamke = '4';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 09:20:00.000') {
					$jamke = '5';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 10:00:00.000') {
					$jamke = '6';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:10:00.000') {
					$jamke = '7';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 11:50:00.000') {
					$jamke = '8';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 12:30:00.000') {
					$jamke = '9';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:10:00.000') {
					$jamke = '10';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 13:50:00.000') {
					$jamke = '11';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 14:30:00.000') {
					$jamke = '12';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 15:25:00.000') {
					$jamke = '13';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:05:00.000') {
					$jamke = '14';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 16:45:00.000') {
					$jamke = '15';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 17:45:00.000') {
					$jamke = '16';
				} else if($row->TANGGAL_HASIL <= date('Y-m-d').' 18:15:00.000') {
					$jamke = '17';
				} else {
					$jamke = '18';
				}
				
			}
			*/
			
			
			$nestedData[] = $jamke;
			$nestedData[] = '<input type="number" name="qty_'.$row->id.'" id="qty_'.$row->id.'" value='.$row->QTY.' style="width:50px;"> <button class="btn btn-success btn-xs" onclick="update_qty_hd(' . $row->id . ');"> <i class="fa fa- fa-edit"></i> UPDATE</button> 
			<a href="#myModalAdd" data-toggle="modal" id="add" data-id="'.$row->id.'_'.$row->LINE.'">
			<button class="btn btn-danger btn-xs"> <i class="fa fa- fa-edit"></i> PINDAH STYLE</button></a>' ;	
			
			
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from v_hasil_output ";
        $record_total = $CI->db->query($sql)->row()->num;
        $sql = "Select count(*) as num  from ($qcountfilter) as c   ";
        $recordsFiltered = $CI->db->query($sql)->row()->num;

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
