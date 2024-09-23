<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Report
 */
class Report extends MY_Controller
{
    
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
        $data = array();

        $this->db->select('KODE_DOKUMEN,URAIAN_DOKUMEN');
        $data['kodeDokumen'] = $this->db->get('v_jenis_dokumen_ceisa')->result_array();
        
        $data['pagetitle'] = 'Laporan Dokumen';
        $this->loadViews('report/report_index', $data);
    }

    public function ceisaXKis()
    {
        $data = array();

        $data['pagetitle'] = 'CEISA x KIS';
        $this->loadViews('report/ceisaxkis_index', $data);
    }

    public function ajaxReport()
    {
        if ($this->input->post()) {
            $postData = $this->input->post();
            $periodeAwal = $postData['periodeAwal'];
            $periodeAkhir = $postData['periodeAkhir'];
            $kodeDokumen = $postData['kodeDokumen'];
            $shipperName = $postData['shipperName'];
            $termQuery = $postData['termQuery'];
         
            if ($kodeDokumen == "") {
                $kodeDokumen = "";
            }

            $sql = "exec report_ceisa_40 ' $periodeAwal', '$periodeAkhir' , '$kodeDokumen',  '$shipperName' ,'$termQuery' ";
            // echo "<pre>";
            // print_r ($sql);
            // echo "</pre>";
            $query = $this->db->query($sql);
            $result = $query->result_array();


            if ( ! empty($result)) {
            ?>

              <div style="overflow-y: hidden; overflow-x: scroll; margin-top: 10px">
                <table id="reportTable"  class="table table-striped table-bordered table-condensed table-striped nowrap" style="white-space: nowrap;">
                    <thead>
                        <tr class="bg-primary">
                        <th> NOMOR AJU</th><th> TANGGAL PERNYATAAN</th><th> NOMOR DAFTAR</th><th> TANGGAL DAFTAR</th><th> KODE DOKUMEN</th>
                        <!-- <th> USER UPLOAD</th><th> JAM UPLOAD</th> -->
                        <th> NAMA PENGUSAHA</th><th> ALAMAT PENGUSAHA</th><th> SHIPPER NM</th><th> ALAMAT SHIPPER NM</th><th> ASURANSI</th><th> BRUTO</th><th> CIF</th><th> FOB</th><th> FREIGHT</th><th> HARGA PENYERAHAN</th><th> KODE VALUTA</th><th> NDPBM</th><th> NETTO</th><th> NILAI BARANG</th><th> NILAI JASA</th><th> NILAI MAKLON</th><th> UANG MUKA</th><th> VD</th><th> VOLUME</th><th> SERI BARANG</th><th> HS</th><th> KODE BARANG</th><th> URAIAN</th><th> KODE SATUAN</th><th> JUMLAH SATUAN</th><th> KODE KEMASAN</th><th> JUMLAH KEMASAN</th><th> NETTO BARANG</th><th> BRUTO BARANG</th><th> VOLUME BARANG</th><th> CIF BARANG</th><th> CIF RUPIAH BARANG</th><th> NDPBM BARANG</th><th> FOB BARANG</th><th> HARGA PENYERAHAN BARANG</th><th> SERI</th><th> URAIAN DOKUMEN</th><th> NOMOR DOKUMEN</th><th> TANGGAL DOKUMEN</th></tr>
                    </thead>
                <?php 
 
                foreach ($result as $key => $val) {
                    echo '<tr>';
                    echo '<td>' . $val['nomor_aju'] . '</td>';
                    echo '<td>' . $val['tanggal_pernyataan'] . '</td>';
                    echo '<td>' . $val['nomor_daftar'] . '</td>';
                    echo '<td>' . $val['tanggal_daftar'] . '</td>';
                    echo '<td>' . $val['kode_dokumen'] . '</td>';
                    // echo '<td>' . $val['user_upload'] . '</td>';
                    // echo '<td>' . $val['jam_upload'] . '</td>';
                    echo '<td>' . $val['nama_pengusaha'] . '</td>';
                    echo '<td>' . $val['alamat_pengusaha'] . '</td>';
                    echo '<td>' . $val['shipper_nm'] . '</td>';
                    echo '<td>' . $val['alamat_shipper_nm'] . '</td>';
                    echo '<td>' . $val['asuransi'] . '</td>';
                    echo '<td>' . $val['bruto'] . '</td>';
                    echo '<td>' . $val['cif'] . '</td>';
                    echo '<td>' . $val['fob'] . '</td>';
                    echo '<td>' . $val['freight'] . '</td>';
                    echo '<td>' . $val['harga_penyerahan'] . '</td>';
                    echo '<td>' . $val['kode_valuta'] . '</td>';
                    echo '<td>' . $val['ndpbm'] . '</td>';
                    echo '<td>' . $val['netto'] . '</td>';
                    echo '<td>' . $val['nilai_barang'] . '</td>';
                    echo '<td>' . $val['nilai_jasa'] . '</td>';
                    echo '<td>' . $val['nilai_maklon'] . '</td>';
                    echo '<td>' . $val['uang_muka'] . '</td>';
                    echo '<td>' . $val['vd'] . '</td>';
                    echo '<td>' . $val['volume'] . '</td>';
                    echo '<td>' . $val['seri_barang'] . '</td>';
                    echo '<td>' . $val['hs'] . '</td>';
                    echo '<td>' . $val['kode_barang'] . '</td>';
                    echo '<td>' . $val['uraian'] . '</td>';
                    echo '<td>' . $val['kode_satuan'] . '</td>';
                    echo '<td>' . $val['jumlah_satuan'] . '</td>';
                    echo '<td>' . $val['kode_kemasan'] . '</td>';
                    echo '<td>' . $val['jumlah_kemasan'] . '</td>';
                    echo '<td>' . $val['netto_barang'] . '</td>';
                    echo '<td>' . $val['bruto_barang'] . '</td>';
                    echo '<td>' . $val['volume_barang'] . '</td>';
                    echo '<td>' . $val['cif_barang'] . '</td>';
                    echo '<td>' . $val['cif_rupiah_barang'] . '</td>';
                    echo '<td>' . $val['ndpbm_barang'] . '</td>';
                    echo '<td>' . $val['fob_barang'] . '</td>';
                    echo '<td>' . $val['harga_penyerahan_barang'] . '</td>';
                    echo '<td>' . $val['seri'] . '</td>';
                    echo '<td>' . $val['uraian_dokumen'] . '</td>';
                    echo '<td>' . $val['nomor_dokumen'] . '</td>';
                    echo '<td>' . $val['tanggal_dokumen'] . '</td>';
                    echo '</tr>';
                }

                ?>
                    </tbody> </table>
                <?php 
            }
        }
    } 

    public function ajaxCeisaXKis()
    {
        if ($this->input->post()) {
            $postData = $this->input->post();
            $periodeAwal = $postData['periodeAwal'];
            $periodeAkhir = $postData['periodeAkhir'];
            $sql = "exec ceisa_x_kis_ceking ' $periodeAwal', '$periodeAkhir'";

            $query = $this->db->query($sql);
            $result = $query->result_array();

            if ( ! empty($result)) {
            ?>

              <div style="overflow-y: hidden; overflow-x: scroll; margin-top: 10px">
                <table id="reportTable"  class="table table-striped table-bordered table-condensed table-striped nowrap" style="white-space: nowrap;">
                    <thead>
                        <tr class="bg-primary">
                        <th> NOMOR AJU</th>
                        <th> NOMOR DAFTAR</th>
                        <th> TANGGAL DAFTAR</th>
                        <th> KODE DOKUMEN</th>
                        <th> QTY DOK</th>
                        <th> QTY KIS</th>
                        <th> KETERANGAN</th>
                        </tr>
                    </thead>
                <?php 
 
                foreach ($result as $key => $val) {
                    echo '<tr>';
                    echo '<td>' . $val['nomor_aju'] . '</td>';
                    echo '<td>' . $val['nomor_daftar'] . '</td>';
                    echo '<td>' . $val['tanggal_daftar'] . '</td>';
                    echo '<td>' . $val['kode_dokumen'] . '</td>';
                    echo '<td>' . $val['qty_dok'] . '</td>';
                    echo '<td>' . $val['qty_kis'] . '</td>';
                    echo '<td style="cursor:pointer;" onclick="detailKis(\''. $val['nomor_daftar'] .'\', \''. $val['tanggal_daftar'] .'\');" class="'. descColor($val['keterangan']) . '">' . $val['keterangan'] . '</td>';
                    echo '</tr>';
                }

                ?>
                    </tbody> </table>
                <?php 
            }
        }
    } 

    public function detailKis()
    {
        $postData = $this->input->post();
        if ( ! empty($postData)) {
            $this->db->where('tanggal_kepabeanan', $postData['tanggalDaftar']);
            $this->db->where('nomor_kepabeanan', $postData['nomorDaftar']);
            $query = $this->db->get('v_header_kis');
               ?>
                <table class="table table-striped table-bordered table-condensed table-striped nowrap" style="white-space: nowrap;">
                    <thead>
                        <tr class="bg-primary">
                            <th>NOMOR KEPABEAN</th>
                            <th>JENIS KEPABEAN</th>
                            <th>TANGGAL KEPABEAN</th>
                            <th>NOMOR KIS</th>
                            <th>TOTAL BARANG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($query->num_rows() > 0) :
                          $totalSum = 0;
                        foreach ($query->result_array() as $row): 
                        ?>
                        <tr>
                            <td><?php echo $row['nomor_kepabeanan'] ?></td>
                            <td><?php echo $row['jenis_kepabeanan'] ?></td>
                            <td><?php echo format_tanggal_notime($row['tanggal_kepabeanan']) ?></td>
                            <td><?php echo $row['nomor_kis'] ?></td>
                            <td class="text-right"><?php echo ($row['total_barang']) ?></td>
                        </tr>
                        <?php 

                        $totalSum += $row['total_barang'];
                    endforeach;
                    ?>
                     <tr>
                            <td class="text-right" colspan="4"><strong>Total</strong></td>
                            <td class="text-right"><?php echo ($totalSum) ?></td>
                        </tr>
                    <?php else:  ?>
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
               <?php
        }
    }
}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */
