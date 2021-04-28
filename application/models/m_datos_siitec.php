<?php

/**
 * 
 */
class M_datos_siitec extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();

		
	}

	public function datos_estudiantes_tr($dato_buscado)
	{

		$cadena = "SELECT * FROM alumnos_vfji_view where estado = '1' and CONCAT(apellido1,' ',apellido2,' ',nombre)  LIKE '$dato_buscado%' LIMIT 4";

		$query = $this->db->query($cadena);

		$res = $query->result();

		return $res;


	}

	public function datos_profesores_tr($dato_buscado)
	{

		$cadena = "SELECT * FROM empleados_vfji_view where CONCAT(apellido1,' ',apellido2,' ',nombre)  LIKE '$dato_buscado%' LIMIT 4";

		$query = $this->db->query($cadena);

		$res = $query->result();

		return $res;


	}

	public function datos_profesores_inicio($id)
	{

		$query = $this->db->get_where('empleados_vfji_view', array('id_empleado'=>$id));
		$row = $query->row();

		if($query->num_rows()==1){

			$this->session->set_userdata('nombre', $row->nombre);
			$this->session->set_userdata('apellido1', $row->apellido1);
			$this->session->set_userdata('apellido2', $row->apellido2);
			$this->session->set_userdata('nombre_departamento',$row->departamento);
		}

	}



}

?>