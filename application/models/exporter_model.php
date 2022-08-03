<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exporter_model extends CI_Model {
	
		function __construct() {
				parent::__construct();
				$this->load->database();
			}
		
		function listProvince() {
				$result = array();
				$this->db->select('idprovince, province_id');
				$this->db->from('mst_propinsi');
				$this->db->order_by('province_id','ASC');
				$array_keys_values = $this->db->get();
				foreach ($array_keys_values->result() as $row)
				{
					$result['all']= '- Pilih Provinsi -';
					$result[$row->idprovince]= ucwords(strtolower($row->province_id));
				}
				
				return $result;
			}
		
		function listCountry() {
				$result = array();
				$this->db->select('idcountry, country');
				$this->db->from('mst_negara');
				$this->db->order_by('country','ASC');
				$array_keys_values = $this->db->get();
				foreach ($array_keys_values->result() as $row)
				{
					$result['all']= '- Pilih Negara -';
					$result[$row->idcountry]= ucwords(strtolower($row->country));
				}
				
				return $result;
			}
			
		function listSizeBisnis() {
				$result = array();
				$this->db->select('idsize, nmsize_ind');
				$this->db->from('eks_sizebisnis');
				$this->db->order_by('idsize','ASC');
				$array_keys_values = $this->db->get();
				foreach ($array_keys_values->result() as $row)
				{
					$result['all']= '- Pilih Size Bisnis -';
					$result[$row->idsize]= $row->nmsize_ind;
				}
				
				return $result;
			}
			
		function pagingExporter($idprovince, $idsize, $produk, $tahun, $bulan, $statdata, $urutan, $idcountry) {
				$this->db->distinct();
				/*$this->db->select('count(distinct eks_profil.idcompany) as jum');
				$this->db->from('eks_profil');
				$this->db->join('mst_propinsi', 'eks_profil.idprovince=mst_propinsi.idprovince');
				$this->db->join('eks_badanusaha', 'eks_profil.badanusaha=eks_badanusaha.badanusaha');
				if($produk=="all") {
					$this->db->join('eks_produk', 'eks_profil.idcompany=eks_produk.idcompany', 'left');
				}
				if($produk!="all") {
					$this->db->join('eks_produk', 'eks_profil.idcompany=eks_produk.idcompany');
					$this->db->join('mst_produk', 'eks_produk.idproduct=mst_produk.idproduct');
				}
				if($idcountry!="all") {
					$this->db->join('eks_tujuan_ekspor', 'eks_profil.idcompany=eks_tujuan_ekspor.idcompany');
					$this->db->join('mst_negara', 'eks_tujuan_ekspor.idcountry=mst_negara.idcountry');
				}
				$this->db->where('eks_profil.status', '1');
				if(!$idprovince!="all") { $this->db->where('eks_profil.idprovince', $idprovince); }
				if($idcountry!="all") { $this->db->where('eks_tujuan_ekspor.idcountry', $idcountry); }
				if($idsize!="all") { $this->db->where('idsize', $idsize); }
				if($produk!="all") { $this->db->like('product', $produk); }
				//if($statdata==1) { $this->db->where('updtime', 'tgledit'); }
				//if($statdata==2) { $this->db->where('tgledit !=', 'updtime'); }
				if(!empty($bulan) && $bulan!="- Bulan -") { $this->db->where('Month(tgl_edit)', $bulan); }
				if(!empty($tahun) && $tahun!="- Tahun -") { $this->db->where('Year(tgl_edit)', $tahun); }
				if(!empty($urutan) && $urutan!="- Urutan -") { $this->db->order_by('tgl_edit', $urutan); }*/

				$this->db->select('count(distinct eks_profil.idcompany) as jum');
				$this->db->from('eks_profil');
				$this->db->join('mst_propinsi', 'eks_profil.idprovince=mst_propinsi.idprovince');
				$this->db->join('eks_badanusaha', 'eks_profil.badanusaha=eks_badanusaha.badanusaha');
				if($produk=="all") {
					$this->db->join('eks_produk', 'eks_profil.idcompany=eks_produk.idcompany', 'left');
				}
				if($produk!="all") {
					$this->db->join('eks_produk', 'eks_profil.idcompany=eks_produk.idcompany');
					$this->db->join('mst_produk', 'eks_produk.idproduct=mst_produk.idproduct');
				}
				if($idcountry!="all") {
					$this->db->join('eks_tujuan_ekspor', 'eks_profil.idcompany=eks_tujuan_ekspor.idcompany');
					$this->db->join('mst_negara', 'eks_tujuan_ekspor.idcountry=mst_negara.idcountry');
				}
				$this->db->where('eks_profil.status', '1');
				if($idprovince!="all") { $this->db->where('eks_profil.idprovince', $idprovince); }
				if($idcountry!="all") { $this->db->where('eks_tujuan_ekspor.idcountry', $idcountry); }
				if($idsize!="all") { $this->db->where('idsize', $idsize); }
				if($produk!="all") { $this->db->like('product', $produk); }
				//if($statdata==1) { $this->db->where('updtime', 'tgledit'); }
				//if($statdata==2) { $this->db->where('tgledit !=', 'updtime'); }
				if(!empty($bulan) && $bulan!="- Bulan -") { $this->db->where('Month(tgl_edit)', $bulan); }
				if(!empty($tahun) && $tahun!="- Tahun -") { $this->db->where('Year(tgl_edit)', $tahun); }
				if(!empty($urutan) && $urutan!="- Urutan -") { $this->db->order_by('tgl_edit', $urutan); }


				$query = $this->db->get();
				
				$row = $query->row();
				$jum = $row->jum;
				
				return $jum;
			}
			
		function listExporter($idprovince, $idsize, $produk, $tahun, $bulan, $statdata, $urutan, $idcountry) {
				$this->db->distinct();
				$this->db->select('eks_profil.idcompany, company, nmbadanusaha, address, city, province_id, phone, fax, email, website, updtime, tgl_edit');
				$this->db->from('eks_profil');
				$this->db->join('mst_propinsi', 'eks_profil.idprovince=mst_propinsi.idprovince');
				$this->db->join('eks_badanusaha', 'eks_profil.badanusaha=eks_badanusaha.badanusaha');
				if($produk=="all") {
					$this->db->join('eks_produk', 'eks_profil.idcompany=eks_produk.idcompany', 'left');
				}
				if($produk!="all") {
					$this->db->join('eks_produk', 'eks_profil.idcompany=eks_produk.idcompany');
					$this->db->join('mst_produk', 'eks_produk.idproduct=mst_produk.idproduct');
				}
				if($idcountry!="all") {
					$this->db->join('eks_tujuan_ekspor', 'eks_profil.idcompany=eks_tujuan_ekspor.idcompany');
					$this->db->join('mst_negara', 'eks_tujuan_ekspor.idcountry=mst_negara.idcountry');
				}
				$this->db->where('eks_profil.status', '1');
				if($idprovince!="all") { $this->db->where('eks_profil.idprovince', $idprovince); }
				if($idcountry!="all") { $this->db->where('eks_tujuan_ekspor.idcountry', $idcountry); }
				if($idsize!="all") { $this->db->where('idsize', $idsize); }
				if($produk!="all") { $this->db->like('product', $produk); }
				//if($statdata==1) { $this->db->where('updtime', 'tgledit'); }
				//if($statdata==2) { $this->db->where('tgledit !=', 'updtime'); }
				if(!empty($bulan) && $bulan!="- Bulan -") { $this->db->where('Month(tgl_edit)', $bulan); }
				if(!empty($tahun) && $tahun!="- Tahun -") { $this->db->where('Year(tgl_edit)', $tahun); }
				if(!empty($urutan) && $urutan!="- Urutan -") { $this->db->order_by('tgl_edit', $urutan); }
				else { $this->db->order_by('tgl_edit','DESC'); }
				$this->db->order_by('company', 'ASC');
				$query = $this->db->get();
				
				return $query;
			}
			
		function listExporterProducts($idcompany) {
				$this->db->distinct();
				$this->db->select('mst_produk.product');
				$this->db->from('eks_profil');
				$this->db->join('eks_produk', 'eks_profil.idcompany=eks_produk.idcompany');
				$this->db->join('mst_produk', 'eks_produk.idproduct=mst_produk.idproduct');
				$this->db->where('eks_profil.idcompany', $idcompany);
				$this->db->order_by('mst_produk.idproduct','ASC');
				$query = $this->db->get();
				
				return $query;
			}
			
		function listExporterCP($idcompany) {
				$this->db->distinct();
				$this->db->select('eks_kontak.name');
				$this->db->from('eks_profil');
				$this->db->join('eks_kontak', 'eks_profil.idcompany=eks_kontak.idcompany');
				$this->db->where('eks_profil.idcompany', $idcompany);
				$query = $this->db->get();
				
				return $query;
			}
			
		function listDestinationCountry($idcompany) {
				$this->db->distinct();
				$this->db->select('mst_negara.country');
				$this->db->from('eks_profil');
				$this->db->join('eks_tujuan_ekspor', 'eks_profil.idcompany=eks_tujuan_ekspor.idcompany');
				$this->db->join('mst_negara', 'eks_tujuan_ekspor.idcountry=mst_negara.idcountry');
				$this->db->where('eks_profil.idcompany', $idcompany);
				$this->db->order_by('mst_negara.country','ASC');
				$query = $this->db->get();
				
				return $query;
			}
				
	}
