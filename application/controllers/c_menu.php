<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_menu extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();

		
	}

	public function index()
	{

		//obtener datos del profesor que registra
		$this->load->model('m_datos_siitec');
		$this->session->set_userdata('ID', '88');
		$id = $this->session->userdata('ID');
		$res = $this->m_datos_siitec->datos_profesores_inicio($id);

		//obtener id del evento acorde a la fecha
		$this->load->model('m_proyectos');
		$this->m_proyectos->obtener_id_evento();

		//cargar la vista
		$this->load->view('layout/vmenu');
		
	}

	
}

?>