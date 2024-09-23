<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Document extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logedin();

		$group = array('eximoperasional', 'admin');
		if (!$this->ion_auth->in_group($group)) {
			redirect('/');
		}
	}

	public function documentDestroy()
	{
		$nomor_aju = $this->input->post('nomor_aju');
		if ($nomor_aju) {
			$columnDelete = $this->columnDelete();
			foreach ($columnDelete as $row) {
				$this->db->where('nomor_aju', $nomor_aju);
				$this->db->delete($row);
			}
		}
	}

	public function index()
	{	
		$data['pagetitle'] = "DAFTAR DOKUMEN";

		$this->db->select('KODE_DOKUMEN,URAIAN_DOKUMEN');
		$data['kodeDokumen'] = $this->db->get('v_jenis_dokumen_ceisa')->result_array();

		  $this->db->order_by('cast([kode_entitas] as bigint)', 'ASC');
		  $this->db->select('id, kode_entitas, uraian_entitas');
		  $data['entitasHeader']  = $this->db->get('referensi_entitas')->result_array();

		$this->loadViews('document/document_index', $data);
	}

	public function listdata()
	{
		$orderstart = $_POST['start'];
		$orderlecgth = $_POST['length'];
		$myString = $_POST['search']['value'];
		$myArray = explode(';', $myString);
		$viewName = 'v_grid_header';
		$where = '';
		$kodeDokumen = $this->input->post('dokumen');
		if ($kodeDokumen) {
			$where = "WHERE kode_dokumen = " . $kodeDokumen;
		}
		$q = " Select * from $viewName $where";
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
		$q = "Select  * , ROW_NUMBER() OVER(ORDER BY  nomor_aju desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
		if ($orderstart == 0) {
		  $q = "Select * from ($q) as d where ROWNUM between " . $orderstart . " and " . $orderlecgth . " order by rownum";
		} else {
		  $order2 = $orderstart + 1;
		  $q = "Select * from ($q) as d where ROWNUM between " . $order2 . " and " . ($orderstart + $orderlecgth) . " order by rownum";
		}

		$hasilquery = $this->db->query($q);
		$data = array();
		$no = $_POST['start'];
		foreach ($hasilquery->result() as $row) {
	      $nestedData = array();
	      $entitas =  parse_entitas($row->pemilik_pengirim);

	      $nestedData[] = '<button class="btn btn-danger btn-xs" onclick="deleteData(\''.$row->nomor_aju.'\')">Delete</button>';
	      $nestedData[] = '<a onclick="showDetail(\''.$row->nomor_aju.'\');" href="javascript:void(0);">'. $row->nomor_aju .'</a>';
	      $nestedData[] = $row->nomor_daftar;
	      $nestedData[] = $row->tanggal_daftar;
	      $nestedData[] = $row->kode_dokumen;

	     
	    	foreach ($entitas as $key => $val) {
      		  $nestedData[] = $entitas[$key];
	      	}

	      $nestedData[] = $row->user_upload;
	      $nestedData[] = $row->jam_upload;

	      $data[] = $nestedData;
		}

		$sql = "Select count(*) as num  from $viewName";
		$record_total = $this->db->query($sql)->row()->num;
		$sql = "Select count(*) as num  from ($qcountfilter) as c";
		$recordsFiltered = $this->db->query($sql)->row()->num;

		$output = array(
		    "draw" => $_POST['draw'],
		    "recordsTotal" => $record_total, 
		    "recordsFiltered" => $recordsFiltered,
		    "data" => $data,
		    "q" => $q,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function detail()
	{
		$orderstart = $_POST['start'];
		$orderlecgth = $_POST['length'];
		$myString = $_POST['search']['value'];
		$myArray = explode(';', $myString);
		$viewName = 'v_grid_barang';
		$where = '';
		$nomorAju = $this->input->post('aju');
		 
		$q = " Select * from $viewName $where WHERE nomor_aju = '" . $nomorAju. "'";
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
		$q = "Select  * , ROW_NUMBER() OVER(ORDER BY  seri_barang ASC) AS ROWNUM  from ( " . $q . " ) as tbd ";
		if ($orderstart == 0) {
		  $q = "Select * from ($q) as d where ROWNUM between " . $orderstart . " and " . $orderlecgth . " order by rownum";
		} else {
		  $order2 = $orderstart + 1;
		  $q = "Select * from ($q) as d where ROWNUM between " . $order2 . " and " . ($orderstart + $orderlecgth) . " order by rownum";
		}

		$hasilquery = $this->db->query($q);
		$data = array();
		$no = $_POST['start'];
		foreach ($hasilquery->result() as $row) {
	      $nestedData = array();

       	  $nestedData[] = $row->nomor_aju;
	      $nestedData[] = $row->seri_barang;
	      $nestedData[] = $row->hs;
	      $nestedData[] = $row->kode_barang;
	      $nestedData[] = $row->uraian;
	      $nestedData[] = $row->merek;
	      $nestedData[] = $row->tipe;
	      $nestedData[] = $row->ukuran;
	      $nestedData[] = $row->spesifikasi_lain;
	      $nestedData[] = $row->kode_satuan;
	      $nestedData[] = $row->jumlah_satuan;
	      $nestedData[] = $row->kode_kemasan;
	      $nestedData[] = $row->jumlah_kemasan;
	      $nestedData[] = $row->kode_dokumen_asal;
	      $nestedData[] = $row->kode_kantor_asal;
	      $nestedData[] = $row->nomor_daftar_asal;
	      $nestedData[] = $row->tanggal_daftar_asal;
	      $nestedData[] = $row->nomor_aju_asal;
	      $nestedData[] = $row->seri_barang_asal;
	      $nestedData[] = $row->netto;
	      $nestedData[] = $row->bruto;
	      $nestedData[] = $row->volume;
	      $nestedData[] = $row->saldo_awal;
	      $nestedData[] = $row->saldo_akhir;
	      $nestedData[] = $row->jumlah_realisasi;
	      $nestedData[] = $row->cif;
	      $nestedData[] = $row->cif_rupiah;
	      $nestedData[] = $row->ndpbm;
	      $nestedData[] = $row->fob;
	      $nestedData[] = $row->asuransi;
	      $nestedData[] = $row->freight;
	      $nestedData[] = $row->nilai_tambah;
	      $nestedData[] = $row->diskon;
	      $nestedData[] = $row->harga_penyerahan;
	      $nestedData[] = $row->harga_perolehan;
	      $nestedData[] = $row->harga_satuan;
	      $nestedData[] = $row->harga_ekspor;
	      $nestedData[] = $row->harga_patokan;
	      $nestedData[] = $row->nilai_barang;
	      $nestedData[] = $row->nilai_jasa;
	      $nestedData[] = $row->nilai_dana_sawit;
	      $nestedData[] = $row->nilai_devisa;
	      $nestedData[] = $row->persentase_impor;
	      $nestedData[] = $row->kode_asal_barang;
	      $nestedData[] = $row->kode_daerah_asal;
	      $nestedData[] = $row->kode_guna_barang;
	      $nestedData[] = $row->kode_jenis_nilai;
	      $nestedData[] = $row->jatuh_tempo_royalti;
	      $nestedData[] = $row->kode_kategori_barang;
	      $nestedData[] = $row->kode_kondisi_barang;
	      $nestedData[] = $row->kode_negara_asal;
	      $nestedData[] = $row->kode_perhitungan;
	      $nestedData[] = $row->pernyataan_lartas;
	      $nestedData[] = $row->flag_4_tahun;
	      $nestedData[] = $row->seri_izin;
	      $nestedData[] = $row->tahun_pembuatan;
	      $nestedData[] = $row->kapasitas_silinder;
	      $nestedData[] = $row->kode_bkc;
	      $nestedData[] = $row->kode_komoditi_bkc;
	      $nestedData[] = $row->kode_sub_komoditi_bkc;
	      $nestedData[] = $row->flag_tis;
	      $nestedData[] = $row->isi_per_kemasan;
	      $nestedData[] = $row->jumlah_dilekatkan;
	      $nestedData[] = $row->jumlah_pita_cukai;
	      $nestedData[] = $row->hje_cukai;
	      $nestedData[] = $row->tarif_cukai;

	      $data[] = $nestedData;
		}

		$sql = "Select count(*) as num  from $viewName";
		$record_total = $this->db->query($sql)->row()->num;
		$sql = "Select count(*) as num  from ($qcountfilter) as c";
		$recordsFiltered = $this->db->query($sql)->row()->num;

		$output = array(
		    "draw" => $_POST['draw'],
		    "recordsTotal" => $record_total, 
		    "recordsFiltered" => $recordsFiltered,
		    "data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function sumDetail()
	{
		$nomorAju = $this->input->post('aju');
		$this->db->where('nomor_aju', $nomorAju);
		$result = $this->db->get('v_jumlah_per_nomor_aju')->row_array();
		?>
			<div class="text-left"><strong>Summary</strong></div>
		 	<table class="table table-condensed table-bordered table-striped">
			<thead>
			  <tr class="bg-primary">
			    <th>Jumlah Satuan</th>
			    <th>Jumlah Kemasan</th>
			    <th>Netto</th>
			    <th>Bruto</th>
			    <th>Volume</th>
			    <th>CIF</th>
			    <th>CIF Rupiah</th>
			    <th>Freight</th>
			    <th>Harga Penyerahan</th>
			    <th>Harga Satuan</th>
			  </tr>
			</thead>
			<tbody>
			  <tr class="text-center">
			     <td><?php echo number_format_decimal($result['sum_jumlah_satuan']) ?> </td>
			      <td><?php echo number_format_decimal($result['sum_jumlah_kemasan']) ?> </td>
			      <td><?php echo number_format_decimal($result['sum_netto']) ?> </td>
			      <td><?php echo number_format_decimal($result['sum_bruto']) ?> </td>
			      <td><?php echo number_format_decimal($result['sum_volume']) ?> </td>
			      <td><?php echo number_format_decimal($result['sum_cif']) ?> </td>
			      <td><?php echo number_format_decimal($result['sum_cif_rupiah']) ?> </td>
			      <td><?php echo number_format_decimal($result['sum_freight']) ?> </td>
			      <td><?php echo number_format_decimal($result['sum_harga_penyerahan']) ?> </td>
			      <td><?php echo number_format_decimal($result['sum_harga_satuan']) ?> </td>
			  </tr>
			</tbody>
			</table>
			<?php if (false): ?>
				
			
			<table class="table table-condensed table-bordered table-striped" style="max-width: 600px;">
				<tbody>
				 	<tr>
				    <th>Nomor Aju</th>
				    <th colspan="4" class="text-left"><?php echo $result['nomor_aju'] ?></th>
				  </tr>
				  <tr>
				    <td>Jumlah Satuan</td>
				    <td><?php echo $result['sum_jumlah_satuan'] ?></td>
				    <td rowspan="5"></td>
				    <td>CIF</td>
				    <td><?php echo $result['sum_cif'] ?></td>
				  </tr>
				  <tr>
				    <td>Jumlah Kemasan</td>
				    <td><?php echo $result['sum_jumlah_kemasan'] ?></td>
				    <td>CIF Rupiah</td>
				    <td><?php echo $result['sum_cif_rupiah'] ?></td>
				  </tr>
				  <tr>
				    <td>Netto</td>
				    <td><?php echo $result['sum_netto'] ?></td>
				    <td>Freight</td>
				    <td><?php echo $result['sum_freight'] ?></td>
				  </tr>
				  <tr>
				    <td>Bruto</td>
				    <td><?php echo $result['sum_bruto'] ?></td>
				    <td>Harga Penyerahan</td>
				    <td><?php echo $result['sum_harga_penyerahan'] ?></td>
				  </tr>
				  <tr>
				    <td>Volume</td>
				    <td><?php echo $result['sum_volume'] ?></td>
				    <td>Harga Satuan</td>
				    <td><?php echo $result['sum_harga_satuan'] ?></td>
				  </tr>
				</tbody>
			</table>
			<?php endif ?>
		<?php 
	}
}
