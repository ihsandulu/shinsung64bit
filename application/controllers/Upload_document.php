<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Upload_document extends MY_Controller {

	public $title = "BC 4.0";
	function __construct()
	{
		parent::__construct();
		$this->is_logedin();

		$group = array('eximoperasional', 'admin');
		if (!$this->ion_auth->in_group($group)) {
			redirect('/');
		}
	}

	public function index()
	{	
		function format_column($str) {
			return strtolower(str_replace(' ', '_', $str));
		}

		$data = array();
		$data['pagetitle'] = "Upload Dokumen";

	 	if ( !empty($this->input->post())) {

			$userId = $this->session->userdata('user_id');
			$newName = $userId.'_'.time().'_'.$_FILES["userfile"]['name'];
	        $config['allowed_types'] = '*';
	        $config['file_name']     = $newName;
			$config['upload_path']      = 'assets/uploads/';
	        $config['allowed_types']    = '*';

	        $this->load->library('upload', $config);
       
			if (!$this->upload->do_upload('userfile')) {
				$data['error'] = $this->upload->display_errors();
			} else {
 				$upload_data          = ['upload_data' => $this->upload->data()];
                $tmpfname2     = 'assets/uploads/' . $newName;
                $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($tmpfname2);
                $reader        = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $spreadsheet   = $reader->load($tmpfname2);

				$dbNames = ['header','entitas','dokumen','pengangkut','kemasan','kontainer','barang','barang_tarif','barang_dokumen','barang_entitas','barang_spek_khusus','barang_vd','bahan_baku','bahan_baku_tarif','bahan_baku_dokumen','pungutan','jaminan','bank_devisa'];

			    $sheetCount = $spreadsheet->getSheetCount() - 1;

			    $this->db->trans_start();
			    for ($i=0; $i < $sheetCount; $i++) { 
			    	$sheet = $spreadsheet->getSheet($i);
					$sheetData = $sheet->toArray(null, true, true, true);
					removeEmptyArrayKey($sheetData);
					//print_r($sheet);
					// if ($i == 14)
					// {
					// 	pre($sheetData); 
					// $outputArray = removeEmptyArrayKey($sheetData);
					// pre($sheetData);	
					// exit();
					// }
					
					 
					//exit();
					$keys = array_map("format_column", $sheetData[1]);
					array_shift($sheetData);

					$itemData = [];
					foreach ($sheetData as $value) {
						$itemRow = [];
						$kolom = 0 ;
						foreach ($value as $key => $item) {
							// if ($sheetData[$kolom]!='')
							// {
								$itemRow[$keys[$key]] = $item;	
							// }
							$kolom++;
							
						}

						$itemData[] = $itemRow;
					}

					foreach ($itemData as $value) {
						if ($i == 0) {
			    			$value['user_upload'] = $this->session->userdata('user_id');

			    			$check = $this->db->get_where('header', [
			    				'nomor_aju' => $value['nomor_aju'
			    			]])->num_rows();

			    			if ($check > 0) {
			    				$this->session->set_flashdata('response', [
			    					'status' => 'danger',
			    					'message' => 'Data nomor aju sudah ada.'
			    				]);
			    				redirect(base_url().'upload_document/index');
			    			}
			    		}

						$query = $this->db->insert_string($dbNames[$i], $value);
						$this->db->query($query);
					}
		    	}
		    	$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
				    $this->session->set_flashdata('response', [
    					'status' => 'danger',
    					'message' => 'Data nomor aju sudah ada.'
    				]);
				} else {
					$this->session->set_flashdata('response', [
						'status' => 'success',
						'message' => 'Excel dokumen berhasil upload.'
					]);
				}

				redirect(base_url().'upload_document/index');
			}
        }

		$this->loadViews('upload_document/upload_document_index', $data);
	}
	
	public function upload()
	{
	

		$newName  = '1_1675310325_00002370170620230131000009.xlsx';
		$tmpfname2     = 'assets/uploads/' . $newName;
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($tmpfname2);
        $reader        = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet   = $reader->load($tmpfname2);

        $dbNames = ['header','entitas','dokumen','pengangkut','kemasan','kontainer','barang','barang_tarif','barang_dokumen','barang_entitas','barang_spek_khusus','barang_vd','bahan_baku','bahan_baku_tarif','bahan_baku_dokumen','pungutan','jaminan','bank_devis'];

	    $sheetCount = $spreadsheet->getSheetCount() - 1;
	    for ($i=0; $i < $sheetCount; $i++) { 
	    	$sheet = $spreadsheet->getSheet($i);
			$sheetData = $sheet->toArray(null, true, true, true);

			$keys = array_map("format_column", $sheetData[1]);
			array_shift($sheetData);
			$itemData = [];
			foreach ($sheetData as $value) {
				$itemRow = [];
				foreach ($value as $key => $item) {
					$itemRow[$keys[$key]] = $item;
				}

				$itemData[] = $itemRow;
			}

			foreach ($itemData as $value) {
				$this->db->insert($dbNames[$i], $value);
			}
    	}
    }
}
