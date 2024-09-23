<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
class Vans_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function detaildata($uuid)
	{
		$this->db->order_by('id', 'asc');
		$this->db->order_by('pcs_ctn', 'desc');
		$this->db->where('dpl_header_id', $uuid);
		$query = $this->db->get('v_packing_list');

		$dd = [];
		foreach ($query->result_array() as $row) {
			$dd[$row['kanaan_po']][] = $row;
		}

		return $dd;
	}

	public function invkmjdata($uuid)
	{
		$this->db->order_by('id', 'asc');
		$this->db->where('dpl_header_id', $uuid);
		$query = $this->db->get('v_invoice_kmj');

		$dd = [];
		foreach ($query->result_array() as $row) {
			$dd[$row['kanaan_po']][] = $row;
		}

		return $dd;
	}

	public function headerdata($id)
	{
		$this->db->where('uuid', $id);
		return $this->db
				->get('v_dpl_header')
				->row();
	}

	public function si($id)
	{
		$this->db->where('dpl_header_id', $id);
		return $this->db->get('v_si');
	}


	public function siCms($id)
	{
		$data = array();
		$this->db->where('dpl_header_id', $id);
		$result = $this->db->get('v_si_cms');
		
		if ( ! empty($result->result_array())) {
			foreach ($result->result() as $row) {
				$data[] = $row;
			}
		}

		return $data;
	}

	public function dpldata($id)
	{
		$this->db->where('dpl_header_id', $id);
		$this->db->order_by('id', 'asc');
		$this->db->order_by('pcs_ctn', 'desc');
		$query =  $this->db->get('v_dpl');

		foreach ($query->result_array() as $row) {
			$dd[$row['kanaan_po']][$row['material']][] = $row;
		}

		return $dd;
	}

	public function total_dpl($id)
	{
		return $this->db
			->query("sp_dpl_total '$id' ")
			->row();
	}

	public function total_si($id)
	{
		return $this->db
			->query("sp_si_total '$id' ")
			->row();
	}

	public function total_invoice_kmj($uuid)
	{
		return $this->db
			->query("sp_invoice_kmj_total '$uuid' ")
			->row();
	}

	public function total_invoice($uuid)
	{
		return $this->db
			->query("sp_invoice_total '$uuid' ")
			->row();
	}


	public function invoicedata($uuid)
	{
		$this->db->order_by('id', 'asc');
		$this->db->where('dpl_header_id', $uuid);
		$query = $this->db->get('v_invoice');

		$dd = [];
		foreach ($query->result_array() as $row) {
			$dd[$row['kanaan_po']][] = $row;
		}

		return $dd;
	}

	public function pebdata($uuid)
	{
		$data = array();
		$this->db->where('dpl_header_id', $uuid);
		$query = $this->db->get('v_pebdata');
		if ($query->num_rows() > 0) {
			$data = $query->result_array();
		}

		return $data;
	}

	public function vdf($uuid)
	{
		$this->db->order_by('id', 'asc');
		$this->db->select('id, material_description, description');
		$this->db->where('dpl_header_id', $uuid);
		$query_material = $this->db->get('dpl');
		
		$material = array();
		foreach ($query_material->result_array() as $row) {
			$material[$row['material_description']][] = $row['description'];
		}

		return $material;
	}

	public function vdf_carton($uuid)
	{
		$this->db->where('dpl_header_id', $uuid);
		$query = $this->db->get('v_vdf');
		return $query->result();
	}

	function total_amount($uuid)
	{
		$this->db->where('uuid', $uuid);
		$qh = $this->db->get('dpl_header')->row();

		$this->db->where('buyer_name', 'VANS');
		$this->db->like('country_name', $qh->final_destination, 'BOTH');
		$qs = $this->db->get('country_fob');

		$total_amount = $this->db->query("sp_invoice_total '$uuid' ")
						->row()->total_amount;
						
		if (floatval($total_amount) <= 7000) {
			if ($qs->num_rows() > 0) {
				$final_total_amount = $total_amount + 200;
			} else {
				$final_total_amount = $total_amount;
			}
		} else {
			$final_total_amount = $total_amount;
		}
		
		return $final_total_amount;
	}

}

/* End of file Packinglist_model.php */
/* Location: ./application/models/Packinglist_model.php */