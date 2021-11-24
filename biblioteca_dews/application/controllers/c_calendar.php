<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_calendar extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_libros');

		$preferencias = array(
			'start_day'    => 'monday',
			'month_type'   => 'long',
			'day_type'     => 'short'
		);

		$this->load->library('calendar', $preferencias);
	}
    public function index()
    {
        $data['generos'] = $this->m_libros->getGeneros();

        $this->load->view('template/header', $data);
        $this->calendario();
        $this->load->view('template/footer');
    }

    public function calendario()
    {
        $mesActual =date('m');
        $anioActual =date('Y');
        $data['calendar'] = $this->calendar->generate($anioActual, $mesActual, $this->m_libros->getPrestamos());
        $this->load->view('template/v_calendar', $data);

    }
    public function diaprestamo($fecha)
    {
        $data['generos'] = $this->m_libros->getGeneros();
        $this->load->view('template/header', $data);
        $this->calendario();
        $datos['prestados'] = $this->m_libros->getPrestamosDia($fecha);
        $this->load->view('template/v_prestamosdia', $datos);
        $this->load->view('template/footer');
    }
}