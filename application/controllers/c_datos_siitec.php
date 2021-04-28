<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_datos_siitec extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_datos_siitec');
		
	}


	// ruta - de
	public function datos_estudiantes_tr(){

		
		$dato_buscado=$this->input->POST('dato');
		//$id_departamento=$this->input->POST('id_departamento');


		$dato_obtenido = $this->m_datos_siitec->datos_estudiantes_tr($dato_buscado);
		
		echo json_encode($dato_obtenido);

	}

	// ruta - dp
	public function datos_profesores_tr(){

		
		$dato_buscado=$this->input->POST('dato_p');
		//$id_departamento=$this->input->POST('id_departamento');


		$dato_obtenido = $this->m_datos_siitec->datos_profesores_tr($dato_buscado);
		
		echo json_encode($dato_obtenido);

	}

	

	
}

?>