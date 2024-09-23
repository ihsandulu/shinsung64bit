<?php  
    function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}   
?> 

<?php

echo'
<div style="font-size:12px; font:Tahoma, Geneva, sans-serif; overflow-y: scroll; overflow-x: scroll;">
  <table width="100%" class="table table-condensed">
    <tbody>
      <tr>
        <th width="37">#</th>
        <th width="37">QTY PLAN</th>
		    <th width="37">OUTPUT</th>
        <th width="37">BALANCE</th>
        <th width="125">BUYER</th>
        <th width="125">FILE NO</th>
        <th width="113">STYLE NO</th>
        <th width="235">ITEM</th>
        <th width="276">COLOR</th>
        <th width="153">DES</th>
        <th width="153">GAC</th>
        <th width="153">QTY <BR>
          ORDER</th>
        <th width="106">SIZE</th>
        <th width="119">QTY DEFECT</th>
        

		<th width="96">OUTPUT HARI INI</th>
      <th width="119">QTY IRONING</th>
      <th width="119">QTY PACKING</th>
      </tr>
    ';
    $nomor = '0';
    foreach($filteredHasil as $row) {
    $nomor++;
    
    echo '
    <tr>
      <td>
	  <a href="'.base_url().'Qa_end_line/'.$_POST['url'].'/'.$row['line_sewing'].'/'.$row['ID'].'">
	  <button class="button" style="background-color:black; width: 60px; height: 30px; font-size:11px;" id="btn_history">PROSES</button>
	  </a>
	  </td>
      <td align="right"><div style="margin-right:20px;">'. $row['QTY_PLAN'] .'</div></td>

	  <td align="right"><div style="margin-right:20px;">'. $row['ALLOUT'] .'</div></td>
      <td align="right"><div style="margin-right:20px;">'. $row['BALANCE'] .'</div></td>
      <td>'. $row['BUYER'] .'</td>
      <td>'. $row['KANAAN_PO'] .'</td>
      <td>'. $row['STYLE_NO'] .'</td>
      <td>'. $row['ITEM'] .'</td>
      <td>'. $row['COLOR'] .'</td>
      <td>'. $row['DES'] .'</td>
      <td>'. $row['GAC'] .'</td>
      <td>'. $row['QTY_ORDER'] .'</td>
      <td>'. $row['SIZE'] .'</td>
      
      <td align="right"  bgcolor="#CCFFCC"><div style="margin-right:20px;">'. $row['jml_defect'] .'</div></td>

	  <td align="right"  bgcolor="#CCFFCC"><div style="margin-right:20px;">'. $row['qty'] .'</div></td>
    <td align="right"  bgcolor="#CCFFCC"><div style="margin-right:20px;">'. $row['ALLOUTIRONING'] .'</div></td>
    <td align="right"  bgcolor="#CCFFCC"><div style="margin-right:20px;">'. $row['ALLOUTPACKING'] .'</div></td>
    </tr>
    ';
    }
    //<td align="right"  bgcolor="#CCFFCC"><div style="margin-right:20px;">'. $row['jml_cek'] .'</div></td>
    echo '
      </tbody>
    
  </table>
</div>';
