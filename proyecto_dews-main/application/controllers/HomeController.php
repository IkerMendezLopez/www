<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */



	function __construct()
	{
		parent::__construct();
		$this->load->model('LibroModel');
	}


	public function index()
	{
		$this->load->model('LibroModel');
		$data['generos'] = $this->LibroModel->getGeneros();
		$data['libros'] = $this->LibroModel->getLibros();

		if ($this->input->post() && count($this->input->post()['idlibro']) > 0) {
			$datos = $this->procesarPrestamos();
			$datos['libros'] = $data['libros'];
		}

		$this->load->view('layout/header', $data);
		$this->load->view('ViewLibros', $data);
		if ($this->input->post()) $this->load->view('viewPrestamos', $datos);
		$this->load->view('layout/footer');
	}

	public function genero($genero)
	{

		$data['generos'] = $this->LibroModel->getGeneros();
		$data['libros'] = $this->LibroModel->getLibros($genero);
		if ($this->input->post() && count($this->input->post()['idlibro']) > 0) {
			$datos = $this->procesarPrestamos();
			$datos['libros'] = $data['libros'];
		}
		$this->load->view('layout/header', $data);
		$this->load->view('ViewLibros', $data);
		if ($this->input->post()) $this->load->view('viewPrestamos', $datos);
		$this->load->view('layout/footer');
	}

	public function procesarPrestamos()
	{

		$idLibros = $this->input->post()['idlibro'];
		foreach ($idLibros as $value) {
			if ($this->LibroModel->prestarLibro($value)) {
				$datos['prestados'][] = $value;
			} else {
				$datos['noprestados'][] = $value;
			}
		}

		return $datos;
	}
}
