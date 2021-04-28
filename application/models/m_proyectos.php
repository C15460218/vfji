<?php

/**
 * 
 */
class M_proyectos extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->vfji = $this->load->database('vfji', TRUE);

		
	}

	public function obtener_proyectos($param)
	{

		$id = $param['id'];
		$evento = $param['evento'];

		$cadena = "SELECT p.*, det.*, u.*,r.* FROM proyecto AS p
					JOIN det_usuario_proyecto AS det ON p.id_proy = det.id_proy_fk 
					JOIN rol AS r ON det.id_rol_fk = r.id_rol
					JOIN usuario AS u ON det.id_us_fk = u.id_us
					WHERE det.id_us_fk = '$id' AND p.id_ev_fk = '$evento'
					ORDER BY fecha_proy ASC";

		$query = $this->vfji->query($cadena);
		return $query->result();

	}

	public function contar_proyectos($param)
	{
		$id = $param['id'];
		$evento = $param['evento'];

		$cadena = "SELECT p.*, det.*, u.*,r.* FROM proyecto AS p
					JOIN det_usuario_proyecto AS det ON p.id_proy = det.id_proy_fk 
					JOIN rol AS r ON det.id_rol_fk = r.id_rol
					JOIN usuario AS u ON det.id_us_fk = u.id_us
					WHERE det.id_us_fk = '$id' AND p.id_ev_fk = '$evento'";

		$query = $this->vfji->query($cadena);
		$numero_filas=$query->num_rows();
		return $numero_filas;

	}

	public function guardar_proyecto($param)
	{

		$campos_us['id_us']=$param['id_p'];
		$campos_us['nombre_us']=$param['nombre_p'];
		$campos_us['apellido1_us']=$param['apellido1_p'];
		$campos_us['apellido2_us']=$param['apellido2_p'];
		$campos_us['departamento_us']=$param['nombre_departamento_p'];
		$campos_us['tipo_us']=1;
		$campos_proy['nombre_proy']=$param['nombre_proy'];
		$campos_proy['problematica_proy']=$param['problematica_proy'];
		$campos_proy['objetivo_proy']=$param['objetivo_proy'];
		$campos_proy['competencia_proy']=$param['competencias_proy'];
		$campos_proy['id_ev_fk']=$param['id_evento'];

		//contar registros para el usuario
		$query = $this->vfji->get_where('usuario',array('id_us'=>$campos_us['id_us']));
		$numero_filas=$query->num_rows();
		
		if($numero_filas==0){
			
			//insertar datos en tabla usuario
			$this->vfji->insert('usuario',$campos_us);
		}


		//insertar datos en tabla de proyecto
		$this->vfji->insert('proyecto',$campos_proy);
		//obtener id de proyecto
		$id_proy = $this->vfji->insert_id();

		$campos_det['id_us_fk'] = $param['id_p'];
		$campos_det['id_proy_fk'] = $id_proy;
		$campos_det['id_rol_fk'] = 1;

		//insertar datos en tabla detalle usuario proyecto
		$this->vfji->insert('det_usuario_proyecto',$campos_det);

		$res=$this->vfji->affected_rows();

		if($res>0){

			return true;

		}else{

			return false;
		}

	}

	public function obtener_datos_participantes_r($param)
	{	
		
		$id=$param['id_proy'];
		$evento=$param['evento'];

		$cadena = "SELECT p.*, det.*, u.*,r.* FROM proyecto AS p
					JOIN det_usuario_proyecto AS det ON p.id_proy = det.id_proy_fk 
					JOIN rol AS r ON det.id_rol_fk = r.id_rol
					JOIN usuario AS u ON det.id_us_fk = u.id_us
					WHERE det.id_proy_fk = '$id' AND p.id_ev_fk = '$evento' AND det.id_rol_fk='1'
					ORDER BY apellido1_us ASC ";

		$query = $this->vfji->query($cadena);
		$res = $query->result();
		return $res;
		
	}

	public function obtener_datos_participantes($param)
	{	
		
		$id=$param['id_proy'];
		$evento=$param['evento'];

		$cadena = "SELECT p.*, det.*, u.*,r.*, a.* FROM proyecto AS p
					JOIN det_usuario_proyecto AS det ON p.id_proy = det.id_proy_fk 
					JOIN rol AS r ON det.id_rol_fk = r.id_rol
					JOIN usuario AS u ON det.id_us_fk = u.id_us
					JOIN alumno AS a ON u.id_us = a.id_al_fk
					WHERE det.id_proy_fk = '$id' AND p.id_ev_fk = '$evento'
					ORDER BY apellido1_us ASC";

		$query = $this->vfji->query($cadena);
		$res = $query->result();
		return $res;
		
	}

	public function obtener_datos_participantes_p($param)
	{	
		
		$id=$param['id_proy'];
		$evento=$param['evento'];

		$cadena = "SELECT p.*, det.*, u.*,r.* FROM proyecto AS p
					JOIN det_usuario_proyecto AS det ON p.id_proy = det.id_proy_fk 
					JOIN rol AS r ON det.id_rol_fk = r.id_rol
					JOIN usuario AS u ON det.id_us_fk = u.id_us
					WHERE det.id_proy_fk = '$id' AND p.id_ev_fk = '$evento' AND det.id_rol_fk='5'
					ORDER BY apellido1_us ASC";

		$query = $this->vfji->query($cadena);
		$res = $query->result();
		return $res;
		
	}

	public function verificar_participante($param_v)
	{
		$usuario = $param_v['id_us_fk'];
		$proyecto = $param_v['id_proy_fk'];

		$query = $this->vfji->get_where('det_usuario_proyecto',array('id_us_fk'=>$usuario, 'id_proy_fk'=>$proyecto));

		if($query->num_rows()==1){

			return true;

		}else{

			return false;
		}

	}

	public function guardar_participante($param)
	{
		

		$campos_us['id_us']=$param['id_us'];
		$campos_us['nombre_us']=$param['nombre_us'];
		$campos_us['apellido1_us']=$param['apellido1_us'];
		$campos_us['apellido2_us']=$param['apellido2_us'];
		$campos_us['tipo_us']=$param['tipo_us'];
		$campos_us['departamento_us']=$param['departamento_us'];
		
		$campos_al['id_al_fk']=$param['id_al_fk'];
		$campos_al['carrera_al']=$param['carrera_al'];		

		$campos_det_proy_us['id_proy_fk']=$param['id_proy_fk'];
		$campos_det_proy_us['id_us_fk']=$param['id_us_fk'];
		$campos_det_proy_us['id_rol_fk']=$param['id_rol_fk'];

		//verificar si ya existe el registro de usuario
		$query=$this->vfji->get_where('usuario',array('id_us'=>$param['id_us']));
		$numero_filas=$query->num_rows();

		if($numero_filas==0){
			
			$this->vfji->insert('usuario',$campos_us);
			$this->vfji->insert('alumno',$campos_al);
		}


		$this->vfji->insert('det_usuario_proyecto',$campos_det_proy_us);
		$res=$this->vfji->affected_rows();

		if($res>0){

			return true;

		}else{

			return false;
		}

	}

	
	public function guardar_participante_profesor($param)
	{

		$campos_us['id_us']=$param['id_us'];
		$campos_us['nombre_us']=$param['nombre_us'];
		$campos_us['apellido1_us']=$param['apellido1_us'];
		$campos_us['apellido2_us']=$param['apellido2_us'];
		$campos_us['tipo_us']=$param['tipo_us'];
		$campos_us['departamento_us']=$param['departamento_us'];

		$campos_det_proy_us['id_proy_fk']=$param['id_proy_fk'];
		$campos_det_proy_us['id_us_fk']=$param['id_us_fk'];
		$campos_det_proy_us['id_rol_fk']=$param['id_rol_fk'];

		//verificar si ya existe el registro de usuario
		$query=$this->vfji->get_where('usuario',array('id_us'=>$param['id_us']));
		$numero_filas=$query->num_rows();

		if($numero_filas==0){
			
			$this->vfji->insert('usuario',$campos_us);
		}

		$this->vfji->insert('det_usuario_proyecto',$campos_det_proy_us);
		$res=$this->vfji->affected_rows();

		if($res>0){

			return true;

		}else{

			return false;
		}

	}

	public function eliminar_participantes($param){

		$usuario = $param['id_us']; 
		$proyecto = $param['id_proy']; 
		
		$cadena = "DELETE from det_usuario_proyecto
				   WHERE id_us_fk = '$usuario' AND id_proy_fk = '$proyecto'";

		$query = $this->vfji->query($cadena);
		$res=$this->vfji->affected_rows();

		if($res>0){

			return true;

		}else{

			return false;
		}


	}

	
	public function v_editar_proyecto($id)
	{
		$query = $this->vfji->get_where('proyecto',array('id_proy'=>$id));
		$res = $query->row();
		return $res;

	}
	
	public function guardar_proyecto_editado($param)
	{

		$campos['nombre_proy']=$param['nombre_proy'];
		$campos['problematica_proy']=$param['problematica_proy'];
		$campos['objetivo_proy']=$param['objetivo_proy'];
		$campos['competencia_proy']=$param['competencia_proy'];


		$this->vfji->where('id_proy', $param['id_proy']);
		$this->vfji->update('proyecto',$campos);
		$res=$this->vfji->affected_rows();

		if($res>0){

			return true;

		}else{

			return false;
		}


	}

	public function eliminar_proyecto($id)
	{

		$cadena = "DELETE FROM det_usuario_proyecto
				   WHERE id_proy_fk = '$id'";

		$cadena2 = "DELETE FROM proyecto
					WHERE id_proy = '$id'";

		$this->vfji->query($cadena);
		$query = $this->vfji->query($cadena2);

		$res=$this->vfji->affected_rows();

		if($res>0){

			return true;

		}else{

			return false;
		}



	}


	public function obtener_proyectos_ajax($param)
	{
		$id = $param['id_proy']; 
		$evento = $param['evento']; 
		$this->vfji->order_by('id_proy','asc');
		$query = $this->vfji->get_where('proyecto',array('id_proy'=>$id, 'id_ev_fk'=>$evento));
		$res = $query->row();
		return $res;
	}

	
	public function obtener_participantes_ajax($param)
	{

		$id = $param['id_proy']; 
		$evento = $param['evento'];

		$cadena = "SELECT det.*, u.*,r.* FROM proyecto AS p
					JOIN det_usuario_proyecto AS det ON p.id_proy = det.id_proy_fk 
					JOIN rol AS r ON det.id_rol_fk = r.id_rol
					JOIN usuario AS u ON det.id_us_fk = u.id_us
					WHERE det.id_proy_fk = '$id' AND p.id_ev_fk = '$evento'
					ORDER BY r.id_rol ASC";


		$query = $this->vfji->query($cadena);
		return $query->result(); 


	}

	public function obtener_lista_proyectos($evento)
	{

		$cadena = "SELECT p.*, det.*, u.*,r.* FROM proyecto AS p
					JOIN det_usuario_proyecto AS det ON p.id_proy = det.id_proy_fk 
					JOIN rol AS r ON det.id_rol_fk = r.id_rol
					JOIN usuario AS u ON det.id_us_fk = u.id_us
					WHERE p.id_ev_fk = '$evento' AND det.id_rol_fk='1'
					ORDER BY fecha_proy ASC";

		$query = $this->vfji->query($cadena);
		return $query->result();

	}

	public function filtro_proyectos($evento)
	{
		$cadena = "SELECT DISTINCT u.departamento_us FROM proyecto AS p
					JOIN det_usuario_proyecto AS det ON p.id_proy = det.id_proy_fk 
					JOIN rol AS r ON det.id_rol_fk = r.id_rol
					JOIN usuario AS u ON det.id_us_fk = u.id_us
					WHERE p.id_ev_fk = '$evento' AND det.id_rol_fk='1'
					ORDER BY fecha_proy ASC";

		$query = $this->vfji->query($cadena);
		return $query->result();
	}


	public function obtener_id_evento()
	{
		$fecha=date("Y-m-d");
		$cadena = "SELECT  id_ev FROM evento WHERE '$fecha' BETWEEN fecha_inicio AND fecha_fin;";
		$query = $this->vfji->query($cadena);
		$row = $query->row();

		if($query->num_rows()==1){

			$this->session->set_userdata('id_evento', $row->id_ev);

		}
	}


}

?>