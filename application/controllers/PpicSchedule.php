<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Log
 */
class PpicSchedule extends MY_Controller
{
	private $db_kis = "";
	function __construct()
	{
		ini_set('memory_limit', '256M');
		parent::__construct();
		$this->is_logedin();
	    $this->load->helper(array('form', 'url'));
	    $this->db_kis  = $this->load->database('kis', TRUE);
		$this->load->helper('url');
		$this->load->library(['ion_auth', 'form_validation']);
	}

	public function GroupPerStyle()
	{
		$data['pagetitle'] = 'DAFTAR STYLE ORDERSHEET';
		$this->loadViews('ppic/ScheduleGroupPerStyle', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}

	public function TampilkanStyleDariGac()
	{ini_set('memory_limit', '256M');
		$postData = $this->input->post();
		// pre($postData); 
		$periodeAwal = $postData['tanggal_awal'];
        $periodeAkhir = $postData['tanggal_akhir'];
		$sql = "  Select * from [KIS].[KMJ1_KIS_2019_PREPARE].[dbo].[OS_list_style]  where delivery between '$periodeAwal' and '$periodeAkhir' order by style_no ; ";
		echo $sql;
	    $query = $this->db->query($sql);
        $result = $query->result_array();

            if ( ! empty($result)) {
            ?>

 
              <div style="overflow-y: hidden; overflow-x: scroll; margin-top: 10px">
                <table id="reportTable"  class="table table-striped table-bordered table-condensed table-striped nowrap" style="white-space: nowrap;">
                    <thead>
                        <tr class="bg-primary">
                        	<th class="col0"> </th>
					          <th class="col1">KANAAN_PO</th>
					          <th class="col2">BUYER_PO_NO</th>
					          <th class="col3">STYLE_NO</th>
					          <th class="col4">ITEM</th>
					          <th class="col5">COLOR</th>
					          <th class="col7">QTY</th>
					          <th class="col8">PP_QTY</th>
					          <th class="col9">FOB</th>
					          <th class="col10">AMOUNT</th>
					          <th class="col11">DELIVERY</th>
					          <th class="col12">DES</th>
					          <th class="col13">COLOR CODE</th>
					     </tr>
					</thead>
					<tbody>
			            <?php
			            $style_no = ""; 
			            $sum = 0 ; 
			            foreach ($result as $key => $val) {
			            if ($style_no == "") {
							$style_no = $val['STYLE_NO'] ;			            	
			            }else
			            {
				            if ($style_no != $val['STYLE_NO'] ) {
				            	// code...
				     //        	echo "<tr>";
				     //        		echo '<td colspan=3>  <h5> <b> TOTAL  STYLE </b>  </h5>  </td>';
				     //        		echo '<td colspan=3> <h5> <b>  '. $style_no .'  </b>  </h5> </td>';
									// echo '<td colspan=1> '. $sum .'</td>';
									// echo '<td colspan=6></td>';
				     //        	echo "</tr>";
				            }
			        	}

			            echo "<tr>";
			            	 echo '<td> <input type="button" onclick="showPopup(this)" value="Show Popup">  </td>';
			            	 echo '<td  class="column-2">' . $val['KANAAN_PO'] . '</td>';
			            	 echo '<td  class="column-3">' . $val['BUYER_PO_NO'] . '</td>';
			            	 echo '<td  class="column-4">' . $val['STYLE_NO'] . '</td>';
			            	 echo '<td  class="column-5">' . $val['ITEM'] . '</td>';
			            	 echo '<td  class="column-6">' . $val['COLOR'] . '</td>';
			            	 echo '<td  class="column-7">' . $val['QTY'] . '</td>';
			            	 echo '<td  class="column-8">' . $val['PP_QTY'] . '</td>';
			            	 echo '<td  class="column-9">' . $val['FOB'] . '</td>';
			            	 echo '<td  class="column-10">' . $val['AMOUNT'] . '</td>';
			            	 echo '<td  class="column-11">' . $val['DELIVERY'] . '</td>';
			            	 echo '<td  class="column-12">' . $val['DES'] . '</td>';
			            	 echo '<td  class="column-13">' . $val['color_code'] . '</td>';
			            echo "</tr>";
						
						$style_no = $val['STYLE_NO'] ;
						$sum += $val['QTY'] ; 			            	

			            }

			            ?>
            		</tbody>
            		</table>

            <?php		
        }

	}


	public function TampilkanLineYangMenegrjakan()
	{ini_set('memory_limit', '256M');
		$postData = $this->input->post();
		// pre($postData); 
		$periodeAwal = $postData['tanggal_awal'];
        $periodeAkhir = $postData['tanggal_akhir'];
		$sql = "  Select * from [KIS].[KMJ1_KIS_2019_PREPARE].[dbo].[OS_list_style]  where delivery between '$periodeAwal' and '$periodeAkhir' order by style_no ; ";
		echo $sql;
	    $query = $this->db->query($sql);
        $result = $query->result_array();

            if ( ! empty($result)) {
            ?>

 
              <div style="overflow-y: hidden; overflow-x: scroll; margin-top: 10px">
                <table id="reportTable"  class="table table-striped table-bordered table-condensed table-striped nowrap" style="white-space: nowrap;">
                    <thead>
                        <tr class="bg-primary">
                        	<th class="col0"> </th>
					          <th class="col1">KANAAN_PO</th>
					          <th class="col2">BUYER_PO_NO</th>
					          <th class="col3">STYLE_NO</th>
					          <th class="col4">ITEM</th>
					          <th class="col5">COLOR</th>
					          <th class="col7">QTY</th>
					          <th class="col8">PP_QTY</th>
					          <th class="col9">FOB</th>
					          <th class="col10">AMOUNT</th>
					          <th class="col11">DELIVERY</th>
					          <th class="col12">DES</th>
					          <th class="col13">COLOR CODE</th>
					     </tr>
					</thead>
					<tbody>
			            <?php
			            $style_no = ""; 
			            $sum = 0 ; 
			            foreach ($result as $key => $val) {
			            if ($style_no == "") {
							$style_no = $val['STYLE_NO'] ;			            	
			            }else
			            {
				            if ($style_no != $val['STYLE_NO'] ) {
				            	// code...
				     //        	echo "<tr>";
				     //        		echo '<td colspan=3>  <h5> <b> TOTAL  STYLE </b>  </h5>  </td>';
				     //        		echo '<td colspan=3> <h5> <b>  '. $style_no .'  </b>  </h5> </td>';
									// echo '<td colspan=1> '. $sum .'</td>';
									// echo '<td colspan=6></td>';
				     //        	echo "</tr>";
				            }
			        	}

			            echo "<tr>";
			            	 echo '<td> <input type="button" onclick="showPopup(this)" value="Show Popup">  </td>';
			            	 echo '<td  class="column-2">' . $val['KANAAN_PO'] . '</td>';
			            	 echo '<td  class="column-3">' . $val['BUYER_PO_NO'] . '</td>';
			            	 echo '<td  class="column-4">' . $val['STYLE_NO'] . '</td>';
			            	 echo '<td  class="column-5">' . $val['ITEM'] . '</td>';
			            	 echo '<td  class="column-6">' . $val['COLOR'] . '</td>';
			            	 echo '<td  class="column-7">' . $val['QTY'] . '</td>';
			            	 echo '<td  class="column-8">' . $val['PP_QTY'] . '</td>';
			            	 echo '<td  class="column-9">' . $val['FOB'] . '</td>';
			            	 echo '<td  class="column-10">' . $val['AMOUNT'] . '</td>';
			            	 echo '<td  class="column-11">' . $val['DELIVERY'] . '</td>';
			            	 echo '<td  class="column-12">' . $val['DES'] . '</td>';
			            	 echo '<td  class="column-13">' . $val['color_code'] . '</td>';
			            echo "</tr>";
						
						$style_no = $val['STYLE_NO'] ;
						$sum += $val['QTY'] ; 			            	

			            }

			            ?>
            		</tbody>
            		</table>

            <?php		
        }

	}



	 }

 
