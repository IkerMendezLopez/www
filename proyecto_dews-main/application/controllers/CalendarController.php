<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CalendarController extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('LibroModel');

		$prefs = array(
			'start_day'    => 'monday',
			'month_type'   => 'long',
			'day_type'     => 'short'
		);

		$this->load->library('calendar', $prefs);
	}

	public function index()
	{
		$data['calendar'] = $this->crearCalendario();

		$data['generos'] = $this->LibroModel->getGeneros();
		$this->load->view('layout/header', $data);
		$this->load->view('ViewCalendar', $data);
		$this->load->view('layout/footer');
	}

	public function crearCalendario()
	{
		$mes = date('m');
		$year = date('Y');
		$data = $this->LibroModel->getPrestamos();

		return $this->calendar->generate($year, $mes, $data);
	}

	public function verPrestamosFecha($year, $month, $day)
	{
		$fecha = "$year-$month-$day";
		$data['fecha'] = $fecha;
		$data['prestados'] = $this->LibroModel->getPrestamosDia($fecha);
		$data['generos'] = $this->LibroModel->getGeneros();
		$data['calendar'] = $this->crearCalendario();

		$this->load->view('layout/header', $data);
		$this->load->view('ViewCalendar', $data);
		$this->load->view('layout/footer');
	}
}
