<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_proyectos extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_proyectos');
		$this->m_proyectos->obtener_id_evento();
		
	}

	//ruta -vproy
	public function index()
	{

		$param['id'] = $this->session->userdata('ID');
		$param['evento'] = $this->session->userdata('id_evento');
		$data['proyectos']=$this->m_proyectos->obtener_proyectos($param);
		$data['cuenta']=$this->m_proyectos->contar_proyectos($param);
		$data['mensaje'] = $this->session->flashdata('mensaje');
		$this->load->vars($data);
		$this->load->view('layout/header');
		$this->load->view('proyectos/vProyectos');
	}

	//ruta -aproy
	public function agregar_proyecto(){

		$param['id'] = $this->session->userdata('ID');
		$param['evento'] = $this->session->userdata('id_evento');
		$data['cuenta']=$this->m_proyectos->contar_proyectos($param);
		if($data['cuenta']>1){

			redirect('vproy');

		}else{

			$this->load->view('layout/header');
			$this->load->view('proyectos/vA_Proyectos');

		}	

	}

	//ruta -gproy
	public function guardar_proyecto(){

		$param['id_p'] = $this->session->userdata('ID');
		$param['nombre_p'] = $this->session->userdata('nombre');
		$param['apellido1_p'] = $this->session->userdata('apellido1');
		$param['apellido2_p'] = $this->session->userdata('apellido2');
		$param['nombre_departamento_p'] = $this->session->userdata('nombre_departamento');
		$param['nombre_proy'] = $this->input->post('txtnombre');
		$param['problematica_proy'] = $this->input->post('txtproblematica');
		$param['objetivo_proy'] = $this->input->post('txtobjetivo');
		$param['competencias_proy'] = $this->input->post('txtcompetencias');
		$param['id_evento'] = $this->session->userdata('id_evento');


		$res=$this->m_proyectos->guardar_proyecto($param);

		if($res==true){

			$this->session->set_flashdata('mensaje', 'Proyecto guardado');	

		}

		redirect('vproy');

		

	}

	//ruta -apar
	public function a_participantes(){

		$param['id_proy'] = $this->uri->segment(2);
		$param['evento'] = $this->session->userdata('id_evento');
		$data['datos_r']= $this->m_proyectos->obtener_datos_participantes_r($param);
		$data['datos']= $this->m_proyectos->obtener_datos_participantes($param);
		$data['datos_p']= $this->m_proyectos->obtener_datos_participantes_p($param);
		$data['mensaje'] = $this->session->flashdata('mensaje');
		$this->load->vars($data);
		$this->load->view('layout/header');
		$this->load->view('proyectos/vA_Participantes');

	}


	//ruta -gpar
	public function guardar_participante(){

		$param['id_us']=$this->input->post('numcontrol_s');
		$param['nombre_us']=$this->input->post('nombre_s');
		$param['apellido1_us']=$this->input->post('apellido1_s');
		$param['apellido2_us']=$this->input->post('apellido2_s');
		$param['tipo_us']=$this->input->post('tipo_par');
		$param['departamento_us']=$this->input->post('departamento_s');
		
		$param['id_al_fk']=$this->input->post('numcontrol_s');
		$param['carrera_al']=$this->input->post('carrera_s');		

		$param['id_proy_fk']=$this->input->post('id_proyecto');
		$param['id_us_fk']=$this->input->post('numcontrol_s');
		$param['id_rol_fk']=3;

		$param_v['id_proy_fk']=$this->input->post('id_proyecto');
		$param_v['id_us_fk']=$this->input->post('numcontrol_s');

		//verificar si el participante es repetido
		$verificar = $this->m_proyectos->verificar_participante($param_v);

		if($verificar==true){

			$this->session->set_flashdata('mensaje', 'El participante es repetido');	

		}else{

			$res=$this->m_proyectos->guardar_participante($param);

			if($res==true){

				$this->session->set_flashdata('mensaje', 'Participante agregado');	

			}
		}

		$id=$this->input->post('id_proyecto');
		redirect("apar/$id");

		
	

	}

	
	//ruta -gparp
	public function guardar_participante_profesor(){


		$param['id_us']=$this->input->post('id_p');
		$param['nombre_us']=$this->input->post('nombre_p');
		$param['apellido1_us']=$this->input->post('apellido1_p');
		$param['apellido2_us']=$this->input->post('apellido2_p');
		$param['departamento_us']=$this->input->post('departamento_p');
		$param['tipo_us']=$this->input->post('tipo_par');

		$param['id_proy_fk']=$this->input->post('id_proyecto');
		$param['id_us_fk']=$this->input->post('id_p');
		$param['id_rol_fk']=5;

		$param_v['id_proy_fk']=$this->input->post('id_proyecto');
		$param_v['id_us_fk']=$this->input->post('id_p');

		//verificar si el participante es repetido
		$verificar = $this->m_proyectos->verificar_participante($param_v);

		if($verificar==true){

			$this->session->set_flashdata('mensaje', 'El participante es repetido');	

		}else{
		
			$res=$this->m_proyectos->guardar_participante_profesor($param);

			if($res==true){

				$this->session->set_flashdata('mensaje', 'Participante agregado');
				
			}
		}

		$id=$this->input->post('id_proyecto');
		redirect("apar/$id");

		

	}

	//ruta -epar
	public function eliminar_participantes(){


		$param['id_us'] = $this->uri->segment(2);
		$param['id_proy'] = $this->uri->segment(3);
		$id_proy = $this->uri->segment(3);
		$res=$this->m_proyectos->eliminar_participantes($param);

		if($res==true){

			$this->session->set_flashdata('mensaje', 'Participante eliminado');
			
		}


		redirect("apar/$id_proy");

	}

	
	//ruta -veproy
	public function v_editar_proyecto(){


		$data['id'] = $this->uri->segment(2);
		$data['proyecto']=$this->m_proyectos->v_editar_proyecto($data['id']);
		$this->load->vars($data);
		$this->load->view('layout/header');
		$this->load->view('proyectos/vE_Proyecto');

	}

	
	//ruta - gproye
	public function guardar_proyecto_editado()
	{

		$param['id_proy'] = $this->input->post('txtid_proy');
		$param['nombre_proy'] = $this->input->post('txtnombre');
		$param['problematica_proy'] = $this->input->post('txtproblematica');
		$param['objetivo_proy'] = $this->input->post('txtobjetivo');
		$param['competencia_proy'] = $this->input->post('txtcompetencias');

		$res=$this->m_proyectos->guardar_proyecto_editado($param);

		if($res==true){

			$this->session->set_flashdata('mensaje', 'Proyecto actualizado');
			
		}

		redirect('vproy');

	}

	
	//ruta - eproy
	public function eliminar_proyecto()
	{
		
		$data['id'] = $this->uri->segment(2);
		$res = $this->m_proyectos->eliminar_proyecto($data['id']);
		
		if($res==true){

			$this->session->set_flashdata('mensaje', 'Proyecto eliminado');
			
		}

		redirect('vproy');
	}

	//ruta - oproya
	public function obtener_proyectos_ajax()
	{
		$param['id_proy'] = $this->input->post('id_proy');
		$param['evento'] = $this->session->userdata('id_evento');
		$res = $this->m_proyectos->obtener_proyectos_ajax($param);

		echo json_encode($res);
	}

	
	public function obtener_participantes_ajax()
	{
		$param['id_proy'] = $this->input->post('id_proy');
		$param['evento'] = $this->session->userdata('id_evento');
		$res = $this->m_proyectos->obtener_participantes_ajax($param);

		echo json_encode($res);
	}

	public function lista_proyectos()
	{

		$evento = $this->session->userdata('id_evento');
		$data['proyectos']=$this->m_proyectos->obtener_lista_proyectos($evento);
		$data['datos']=$this->m_proyectos->filtro_proyectos($evento);
		$this->load->vars($data);
		$this->load->view('layout/header');
		$this->load->view('proyectos/vL_Proyectos');
	}

	//ruta - dproy
	public function detalle_proyectos()
	{
		$evento = $this->session->userdata('id_evento');
		$data['proyectos']=$this->m_proyectos->obtener_lista_proyectos($evento);
		$data['estudiantes']=$this->m_proyectos->obtener_cantidad_estudiantes($evento);
		$data['profesores']=$this->m_proyectos->obtener_cantidad_profesores($evento);
		$data['dEstudiantes']=$this->m_proyectos->obtener_datos_estudiantes($evento);
		$data['dProfesores']=$this->m_proyectos->obtener_datos_profesores($evento);
		$this->load->vars($data);
		$this->load->view('layout/header');
		$this->load->view('proyectos/vD_Proyectos');
	}


	
}

?>