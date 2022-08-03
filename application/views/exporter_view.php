<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title?></title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:60px 60px;">
      <table width="100%" border="0" cellspacing="1" cellpadding="1" style="border:1px solid #000">
        <tr>
          <td style="padding:5px 5px;" align="center" id="title" colspan="4"><strong><u>EXPORTERS REPORT</u></strong></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <?=form_open('exporter/result')?>
        <tr>
          <td width="300">&nbsp;</td>
          <td width="300" style="padding:5px 5px;" align="left" id="text">PROVINSI</td>
          <td width="5" style="padding:5px 5px;" align="center" id="text">:</td>
          <td style="padding:5px 5px;" align="left" id="text"><?php echo form_dropdown("idprovince", $province, "", "id='combofield'"); ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td style="padding:5px 5px;" align="left" id="text">SIZE BISNIS</td>
          <td style="padding:5px 5px;" align="center" id="text">:</td>
          <td style="padding:5px 5px;" align="left" id="text"><?php echo form_dropdown("idsize", $size, "", "id='combofield'"); ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td style="padding:5px 5px;" align="left" id="text">PRODUK</td>
          <td style="padding:5px 5px;" align="center" id="text">:</td>
          <td style="padding:5px 5px;" align="left" id="text"><?php echo form_input($produk); ?></td>
        </tr>
		<tr>
          <td>&nbsp;</td>
          <td style="padding:5px 5px;" align="left" id="text">NEGARA TUJUAN EKSPOR</td>
          <td style="padding:5px 5px;" align="center" id="text">:</td>
          <td style="padding:5px 5px;" align="left" id="text"><?php echo form_dropdown("idcountry", $country, "", "id='combofield'"); ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td style="padding:5px 5px;" align="left" id="text">STATUS UPDATE</td>
          <td style="padding:5px 5px;" align="center" id="text">:</td>
          <td style="padding:5px 5px;" align="left" id="text">
          <?php
		  // Tahun update data eksportir
		  $dy[0] = "- Tahun -";
		  $idfield = 'id = "combofield"';
		  $sql = "SELECT DISTINCT YEAR( tgl_edit ) AS tahun
				FROM eks_profil
				WHERE YEAR( tgl_edit ) !=  ''
				ORDER BY tahun DESC ";
		  $query = $this->db->query($sql);
		  if ($query->num_rows() > 0) {
				  foreach ($query->result() as $row) {
					$dy[$row->tahun] = $row->tahun;
				  }
		  }
		  if(empty($tahun)) $set="";
		  else $set=$tahun;
		  echo form_dropdown('tahun',$dy,$set,$idfield)." ";
		  
		  // Bulan update data eksportir
		  $dm = array('- Bulan -', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		  $idfield = 'id = "combofield"';
		  if(empty($bulan)) $set="";
		  else $set=$bulan;
		  echo form_dropdown('bulan',$dm,$set,$idfield)." ";
		  
		   // Status data
		  $ds = array('- Status Data -', 'Baru', 'Update');
		  $idfield = 'id = "combofield"';
		  if(empty($statdata)) $set="";
		  else $set=$statdata;
		  echo form_dropdown('statdata',$ds,$set,$idfield)." ";
		  
		  // Urutan data
		  $do = array('- Urutan -', 'ASC', 'DESC');
		  $idfield = 'id = "combofield"';
		  if(empty($urutan)) $set="";
		  else $set=$urutan;
		  echo form_dropdown('urutan',$do,$set,$idfield);
		  ?>
          </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td style="padding:5px 5px;" align="left" id="text"><?php echo form_submit($button); ?></td>
        </tr>
        <?=form_close()?>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
