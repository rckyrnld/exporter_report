<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exporter extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');	
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('exporter_model');
		$this->load->database();	
	}
	
	function index() {
			$data['title'] = "Exporter | DJPEN";
			$data['page'] = "index";
			$data['province'] = $this->exporter_model->listProvince();
			$data['country'] = $this->exporter_model->listCountry();
			$data['size'] = $this->exporter_model->listSizeBisnis();
			$data['produk'] = array('name' => 'produk', 'id' => 'logfield', 'class' => 'text', 'size' => '60');
			$data['button'] = array('name' => 'proses', 'value' => 'Proses', 'id' => 'logbutton');	
			$this->load->view('exporter_view', $data);
			//echo "hello Words";
		}
		
	function result() {
			$ctk = $this->uri->segment(3);
			
			if(!empty($ctk)) { 
				$idprovince = $this->session->userdata('idprovince');
				$idcountry = $this->session->userdata('idcountry');
				$idsize = $this->session->userdata('idsize');
				$produk = $this->session->userdata('produk');
				$tahun = $this->session->userdata('tahun');
				$bulan = $this->session->userdata('bulan');
				$statdata = $this->session->userdata('statdata');
				$urutan = $this->session->userdata('urutan'); 
			}
			else {
				$idprovince = $this->input->post('idprovince');
				$idcountry = $this->input->post('idcountry');
				$idsize = $this->input->post('idsize');
				$produk = $this->input->post('produk');
				$tahun = $this->input->post('tahun');
				$bulan = $this->input->post('bulan');
				$statdata = $this->input->post('statdata');
				$urutan = $this->input->post('urutan');
				
				$data = array('idprovince' => $idprovince, 'idsize' => $idsize, 'produk' => $produk, 'tahun' => $tahun, 'bulan' => $bulan, 'statdata' => $statdata, 'urutan' => $urutan, 'idcountry' => $idcountry);
				$this->session->set_userdata($data);			
			}
			
			$paging = $this->exporter_model->pagingExporter($idprovince, $idsize, $produk, $tahun, $bulan, $statdata, $urutan, $idcountry);
			
			$data['total'] = $paging;
			$data['tipe'] = $this->uri->segment(4);
			
			$data['exporter'] = $this->exporter_model->listExporter($idprovince, $idsize, $produk, $tahun, $bulan, $statdata, $urutan, $idcountry);
			
			$data['title'] = "Exporter | DJPEN";
			$data['page'] = "result";
			
			if(!empty($ctk)) {
				$this->load->view('exporterlistcetak_view', $data);
			}
			else {
				$this->load->view('exporterlist_view', $data);
			}
				
		}
			
}

?>