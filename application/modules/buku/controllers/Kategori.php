<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kategori_m');
	}
	public function index()
	{
		$this->kategori_list();
	}
	public function kategori_list()
	{
		$data['title'] = 'kategori';
		//Header
		$this->load->view('templates/header', $data);
		// Body
		$this->load->view('kategori_list',$data);
		// Footer
		$this->load->view('templates/footer');
	}
	public function form()
	{
		$this->load->model('ref_m');

		$data['title'] = 'kategori';
		$data['action'] = $this->uri->segment(3);

		if ($data['action']=='edit') {
			$id = $this->input->get('id_kategori');
			$data['kategori'] = $this->kategori_m->kategori_id($id);
		}
		if ($this->input->post()) {
			if($this->validasi()){
				if ($data['action']=='edit') {
					if($this->kategori_m->edit($id)){
						$this->session->set_flashdata('pesan', 'Edit kategori Berhasil');
						$this->session->set_flashdata('status', TRUE);
						redirect('kategori','refresh');
					}else{
						$this->session->set_flashdata('pesan', 'Edit kategori GAGAL');
						$this->session->set_flashdata('status', FALSE);
					}
				}else{
					if($this->kategori_m->tambah()){
						$this->session->set_flashdata('pesan', 'Tambah kategori Berhasil');
						$this->session->set_flashdata('status', TRUE);
						redirect('kategori','refresh');
					}else{
						$this->session->set_flashdata('pesan', 'Tambah kategori GAGAL');
						$this->session->set_flashdata('status', FALSE);
					}
				}
			}
			$data['kategori'] = $this->input->post();
		}

		//Referensi tabal
		

		//Header
		$this->load->view('templates/header', $data);
		// Body
		$this->load->view('kategori_form',$data);
		// Footer
		$this->load->view('templates/footer');
	}
	public function validasi()
	{
		return TRUE;
	}
}

/* End of file kategori.php */
/* Location: ./application/controllers/kategori.php */