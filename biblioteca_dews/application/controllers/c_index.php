<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_index extends CI_Controller {
	
	public function index()
	{
		$this->load->model('m_libros');
		$data['generos'] = $this->m_libros->getGeneros();
		$this->load->view('template/header', $data);
		$data['libros'] =  $this->m_libros->getLibros();
		$this->load->view('template/v_libros', $data);
		if ($this->input->post() && count($this->input->post()['idlibro']) > 0) {
			$datos = $this->m_libros->prestamos();
			$datos['libros'] = $data['libros'];
		}
		if(isset($_POST)) $this->load->view('template/v_prestamos', $datos);
		$this->load->view('template/footer');
		
	}


	public function librosPorGenero($genero)
	{
		$this->load->model('m_libros');
		$data['libros'] =  $this->m_libros->getLibros($genero);
		$data['generos'] = $this->m_libros->getGeneros();
		if ($this->input->post() && count($this->input->post()['idlibro']) > 0) {
			$datos = $this->m_libros->prestamos();
			$datos['libros'] = $data['libros'];
		}
		$this->load->view('template/header', $data);
		$this->load->view('template/v_libros', $data);
		if(isset($_POST)) $this->load->view('template/v_prestamos', $datos);
		$this->load->view('template/footer');
	}
}
