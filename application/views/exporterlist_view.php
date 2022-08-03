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
          <td style="padding:5px 5px;" align="center" id="title"><strong><u>EXPORTER REPORTS</u></strong></td>
        </tr>
        <tr>
          <td style="padding:10px 10px;">
            <table width="100%" border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td><p style="padding:5px 5px;text-align:left;"><a href="<?=base_url()?>exporter">BACK</a></p></td>
                <td><p style="padding:5px 5px;text-align:left;">TOTAL : <?=$total?></p></td>
                <td colspan="11"><p style="padding:5px 5px;text-align:right;">
                <a href="<?=base_url()?>exporter/result/cetak/word" target="_blank"><img src="<?=base_url()?>images/docprint.gif" alt="print_word"  title="word"border="0" align="middle"></a>&nbsp;<a href="<?=base_url()?>exporter/result/cetak/excel" target="_blank"><img src="<?=base_url()?>images/xlsprint.gif" alt="print_exccel" title="excel" border="0" align="middle"></a>
                </p></td>
              </tr>
              <tr>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">No.</td>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">Nama Perusahaan</td>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">Alamat</td>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">Provinsi</td>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">Telepon</td>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">Fax</td>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">Email</td>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">Website</td>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">Produk</td>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">Contact Person</td>
				<td style="padding:5px 5px; background-color:#002d44; color:#fff;">Negara Tujuan Ekspor</td>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">Tanggal Input</td>
                <td style="padding:5px 5px; background-color:#002d44; color:#fff;">Tanggal Edit</td>
              </tr>
              <?php
			  $c=0; $no=0;
			  if($exporter->num_rows()>0) {
			  foreach ($exporter->result() as $row) {
			  $no++;
			  if($c==0) $clr="#eee";
			  else if($c==1) $clr="#fff";
			  ?>
			  <tr>
				<td bgcolor="<?=$clr?>" style="padding:5px 5px;"><?=$no?>.</td>
                <td bgcolor="<?=$clr?>" style="padding:5px 5px;"><?=$row->company.", ".$row->nmbadanusaha?></td>
                <td bgcolor="<?=$clr?>" style="padding:5px 5px;"><?=$row->address.", ".$row->city?></td>
                <td bgcolor="<?=$clr?>" style="padding:5px 5px;"><?=$row->province_id?></td>
                <td bgcolor="<?=$clr?>" style="padding:5px 5px;"><?=$row->phone?></td>
                <td bgcolor="<?=$clr?>" style="padding:5px 5px;"><?=$row->fax?></td>
                <td bgcolor="<?=$clr?>" style="padding:5px 5px;"><?=$row->email?></td>
                <td bgcolor="<?=$clr?>" style="padding:5px 5px;"><?=$row->website?></td>
				<td bgcolor="<?=$clr?>" style="padding:5px 5px;">
				<?php
				$products = $this->exporter_model->listExporterProducts($row->idcompany);
				$prd = "";
				foreach ($products->result() as $rowp) {
					$prd=$prd.$rowp->product.", ";
				}
				echo $prd;
				?>
				</td>
                <td bgcolor="<?=$clr?>" style="padding:5px 5px;">
				<?php
				$cp = $this->exporter_model->listExporterCP($row->idcompany);
				$cpe = "";
				foreach ($cp->result() as $rowc) {
					$cpe=$cpe.$rowc->name.", ";
				}
				echo $cpe;
				?>
				</td>
				<td bgcolor="<?=$clr?>" style="padding:5px 5px;">
				<?php
				$dc = $this->exporter_model->listDestinationCountry($row->idcompany);
				$dcf = "";
				foreach ($dc->result() as $rowd) {
					$dcf=$dcf.$rowd->country.", ";
				}
				echo $dcf;
				?>
				</td>
                <td bgcolor="<?=$clr?>" style="padding:5px 5px;"><?=$row->updtime?></td>
                <td bgcolor="<?=$clr?>" style="padding:5px 5px;"><?=$row->tgl_edit?></td>
			  </tr>
			  <?php 
			  if($c==1) $c=0;
			  else if($c==0) $c=1;
			  }
			  }
			  else {
			  ?>
			  <tr>
				<td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
				<td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
				<td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
                <td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
				<td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
				<td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
                <td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
				<td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
                <td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
                <td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
                <td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
                <td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
				<td bgcolor="#eee" style="padding:5px 5px;">&nbsp;</td>
			  </tr>
			  <?php } ?>
               <tr>
                <td colspan="12">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
