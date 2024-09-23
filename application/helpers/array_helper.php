<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function kiri($nilai , $n){
    return substr($nilai , 0 , $n);
}

function kanan($nilai, $n) {
    return substr($nilai, -$n);
}


function filterArray($array, $filter) {
    $filteredArray = array_filter($array, function($item) use ($filter) {
        foreach ($filter as $key => $value) {
            if (!isset($item[$key]) || $item[$key] !== $value) {
                return false;
            }
        }
        return true;
    });
    
    return $filteredArray;
}

function Daftar_supervisor($tanggal){
     $CI =& get_instance();
    $CI->load->database();
    
    $query = $CI->db->query("SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'");
    
    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return array();
    }

}

function Helper_daftar_defect(){
    $sql = "select  distinct * from daftar_defect order by kode asc " ;         
     $CI =& get_instance();
    $CI->load->database();
    
    $query = $CI->db->query($sql);
    
    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return array();
    }


}
function cetakNamaHari($tanggal_sebelum, $tanggal_sesudah) {
  // Mengonversi tanggal menjadi format timestamp
    $timestamp_sebelum = strtotime($tanggal_sebelum);
    $timestamp_sesudah = strtotime($tanggal_sesudah);

    // Membuat array hari
    $nama_hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

    // Membuat array untuk menyimpan nama hari dan tanggal
    $hasil = array();

    // Mencetak nama hari dan tanggal di antara tanggal sebelum dan sesudah
    while ($timestamp_sebelum <= $timestamp_sesudah) {
        $hari_index = date('w', $timestamp_sebelum);
        $nama_hari_tanggal = $nama_hari[$hari_index];
        $tanggal = date('Y-m-d', $timestamp_sebelum);
        $hasil[] = array('hari' => $nama_hari_tanggal, 'tanggal' => $tanggal);
        $timestamp_sebelum = strtotime('+1 day', $timestamp_sebelum);
    }

    return $hasil;
}


 function log_slow_queries($execution_time, $query)
    {
        // Set waktu eksekusi yang dianggap lambat (dalam detik)
        $slow_query_threshold = 1;

        // Jika waktu eksekusi lebih dari ambang batas, catat ke file log
        if ($execution_time > $slow_query_threshold) {
            $log_message = date('Y-m-d H:i:s') . ' - Execution Time: ' . $execution_time . 's - Query: ' . $query . PHP_EOL;

            // Sesuaikan path log sesuai kebutuhan
            $log_path = APPPATH . 'logs/slow_queries.log';

            // Menulis log ke file
            if (!write_file($log_path, $log_message, 'a')) {
                // Tambahkan penanganan kesalahan jika diperlukan
                // Misalnya, log pesan kesalahan ke file lain atau kirim notifikasi
                log_message('error', 'Unable to write to the log file: ' . $log_path);
            }
        }
    }

 function execute_query_and_log($query )
    {
        $CI =& get_instance();
        
        // Catat waktu sebelum eksekusi query
        $start_time = microtime(true);

        // Eksekusi query
        $sql = $CI->db->query($query);
        $result = $sql->row_array();

        // Catat waktu setelah eksekusi query
        $end_time = microtime(true);

        // Hitung selisih waktu
        $execution_time = $end_time - $start_time;

        // Ambil data IP pengguna
        $ip_user = $_SERVER['REMOTE_ADDR'];

        // Ambil waktu saat ini
        $jam = date('Y-m-d H:i:s');

        // Simpan log ke database
        $log_data = array(
            'ip_user' => $ip_user,
            'query' => $query,
            'waktu_eksekusi' => $execution_time,
            'jam' => $jam
        );

        $CI->db->insert('log_query', $log_data);

        return $result;
    }

    function execute_query_resultarray_and_log($query )
    {
        $CI =& get_instance();
        
        // Catat waktu sebelum eksekusi query
        $start_time = microtime(true);

        // Eksekusi query
        $sql = $CI->db->query($query);
        $result = $sql->result_array();

        // Catat waktu setelah eksekusi query
        $end_time = microtime(true);

        // Hitung selisih waktu
        $execution_time = $end_time - $start_time;


        $ua = $_SERVER['HTTP_USER_AGENT'];
        $browser = get_browser(null, true); 
        $os = $browser['platform']; 

        // Ambil data IP pengguna
        $ip_user = $_SERVER['REMOTE_ADDR'];

        // Ambil waktu saat ini
        $jam = date('Y-m-d H:i:s');

        // Simpan log ke database
        $log_data = array(
            'ip_user' => $ip_user   ,
            'query' => $query,
            'waktu_eksekusi' => $execution_time 
        );

        $CI->db->insert('log_query', $log_data);

        return $result;
    }

    function execute_query_resultarray_and_log_with_param($query, $params = array())
{
    $CI =& get_instance();

    // Catat waktu sebelum eksekusi query
    $start_time = microtime(true);

    // Eksekusi query dengan parameter
    $sql = $CI->db->query($query, $params);
    $result = $sql->result_array();

    // Catat waktu setelah eksekusi query
    $end_time = microtime(true);

    // Hitung selisih waktu
    $execution_time = $end_time - $start_time;

    $ua = $_SERVER['HTTP_USER_AGENT'];
    $browser = get_browser(null, true);
    $os = $browser['platform'];

    // Ambil data IP pengguna
    $ip_user = $_SERVER['REMOTE_ADDR'];

    // Ambil waktu saat ini
    $jam = date('Y-m-d H:i:s');

    // Simpan log ke database
    $log_data = array(
        'ip_user' => $ip_user,
        'query' => $query,
        'waktu_eksekusi' => $execution_time
    );

    $CI->db->insert('log_query', $log_data);

    return $result;
}

    function simpan_log( $nama_function ,  $execution_time  )
    {
        $CI =& get_instance();
         // Ambil data IP pengguna
        $ip_user = $_SERVER['REMOTE_ADDR'];

        // Ambil waktu saat ini
        $jam = date('Y-m-d H:i:s');

        // Simpan log ke database
        $log_data = array(
            'ip_user' => $ip_user   ,
            'query' => $nama_function ,
            'waktu_eksekusi' => $execution_time 
        );

        $CI->db->insert('log_query', $log_data);
    }
 
?>