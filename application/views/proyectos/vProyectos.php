<div style="margin-top: 10px;" class="s2-container">

   <a class="bc" href="<?php echo base_url();?>"> Menu - VFJI |</a>
   Mis proyectos
   
</div>
<?php echo $this->session->userdata('id_evento'); ?>
<div class="s2-container">
	<h1>Mis proyectos</h1>
	<a class="boton_agregar" href="<?php echo base_url();?>aproy"><button id="a_competencia" class="btn bg_botones" title="Agregar"><span class="fas fa-plus-circle"></span></button></a>
	<div class="s2-alert">
		<!-- Aqui se pone el texto de la alerta-->
	</div>
	<?php if($mensaje!=''){ ?>
		<div class="s1-alert">
			<?php echo $mensaje; ?><!-- Aqui se pone el texto de cambios en los registros-->
		</div>	
	<?php } ?>
	<table class='s2-table wide' style="margin-top: 20px;">
		<thead>
			<tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Proyecto completo</th>
				<td>Participantes</td>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1 ?>
            <?php foreach($proyectos as $proyecto):?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $proyecto->nombre_proy?> </td>
				<td>
					<button  onclick="get_modal_info(<?php echo $proyecto->id_proy?>)" class="btn bg_botones" title="Ver"><i class="fas fa-info-circle"></i></button>
				</td>
				<td>
					<?php if($proyecto->id_rol_fk==1) {?>
						<a href="<?php echo base_url();?>apar/<?php echo $proyecto->id_proy?>">
							<button class="btn bg_botones" title="Agregar"><i class="fas fa-plus-circle"></i></button>
						</a>
					<?php } ?>
				</td>
				<td>
					<?php if($proyecto->id_rol_fk==1) {?>
					<a href="<?php echo base_url();?>veproy/<?php echo $proyecto->id_proy?>">
						<button class="btn bg_botones" title="Editar"><i class="fas fa-pen"></i></button>
					</a>
					<a onclick="eliminar_proyecto(<?php echo $proyecto->id_proy?>,'<?php echo $proyecto->nombre_proy;?>')" >
				 		<button class="btn bg_botones" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
				 	</a>
				 	<?php } ?>
				</td>
			</tr>
			<?php $i++ ?>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<!------------------------------------ modal bootstrap--------------------------------------->
<div class="modal fade" id="modal_proyecto_completo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Información completa &nbsp;&nbsp;

        	<!-- Spiner -->
        	<div id="spiner_modal_proyecto" class="spinner-border text-warning" role="status">
  				<span class="sr-only">Loading...</span>
			</div>

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div id="modal_contenido">
        
	 		<h5>Nombre:</h5>  
	 		<p id="nombre_proy">-</p>

	 		<h5>Problematica:</h5>  
	 		<p id="problematica_proy">-</p>

	 		<h5>Objetivo:</h5>  
	 		<p id="objetivo_proy" style="text-align: justify;">-</p>

	 		<h5>Competencias:</h5>  
	 		<p id="competencias_proy" style="text-align: justify;">-</p>

	 		<h5>Participantes:</h5>
	 		<p id="participantes_proy">-</p>

	 	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg_botones" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!------------------------------------ modal bootstrap/Eliminar------------------------------->
<div class="modal fade" id="modal_eliminar_proyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar proyecto &nbsp;&nbsp;

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<h5> ¿Estas seguro de eliminar <span id="nombre_proyecto_eliminar"> </span> ? <h5>
      </div>
      <div class="modal-footer">
      	<a id="link_eliminar">
        	<button type="button" class="btn bg_botones">Eliminar</button>
    	</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	var base= "<?php echo base_url();?>";
	var cuenta = <?php echo $cuenta ?>;


	if(cuenta>1){

		$('.s2-alert').text('Ha alcanzado el número máximo de proyectos');
		$('#a_competencia').attr('disabled',true);
		$('#a_competencia').attr('title','Número máximo de proyectos');
		$('#a_competencia').parent().click(function(){

			return false;

		});

	}else{

		$('.s2-alert').css('display','none');

	}


	function get_modal_info(id_proy)
	{
		
		$('#modal_proyecto_completo').modal('show'); 
		//ajax proyecto
		$.ajax({

            type: 'POST',
            url:base +'oproya',
            data: {
                
                id_proy
                
            },
            beforeSend:function(){

            	$('#modal_contenido').css('visibility','hidden');
            	$('#spiner_modal_proyecto').css('display','inline-block');
            	$('#competencias_proy').html('');
            	$('#participantes_proy').html('');

            },
            success:function(response){

            	$('#spiner_modal_proyecto').css('display','none');
            	$('#modal_contenido').css('visibility','visible');
                data = JSON.parse(response);

				$('#nombre_proy').html(data.nombre_proy);
				$('#problematica_proy').html(data.problematica_proy);
				$('#objetivo_proy').html(data.objetivo_proy);

				c = data.competencia_proy.split(',');

				for(i=0;i<c.length;i++){

					$('#competencias_proy').append('<li>'+c[i]+'</li>');
				}
				
            }

        });//termina ajax

	   //ajax participantes
       $.ajax({

            type: 'POST',
            url:base +'opara',
            data: {
            
                id_proy
                
            },
            beforeSend:function(){

            	$('#modal_contenido').css('visibility','hidden');
            	$('#spiner_modal_proyecto').css('display','inline-block');
            	$('#competencias_proy').html('');
            	$('#participantes_proy').html('');
            },
            success:function(response){

            	$('#spiner_modal_proyecto').css('display','none');
            	$('#modal_contenido').css('visibility','visible');
				data = JSON.parse(response);
				$.each(data,function(i,item){

					$('#participantes_proy').append('<li>'+item.apellido1_us+' '+item.apellido2_us+' '+item.nombre_us+'&nbsp;||&nbsp;<b>'+item.nombre_rol+ '</b></li>');
				

				});//termina each							    		

            }

        });//termina ajax
	
	}//termina función

	function eliminar_proyecto(id_proy,nombre_proy)
	{
		$('#nombre_proyecto_eliminar').css('color','red');
		$('#nombre_proyecto_eliminar').html(nombre_proy);
		$('#link_eliminar').attr('href',base+'eproy/'+id_proy);
		$('#modal_eliminar_proyecto').modal('show'); 
	}

</script>


</body>
</html>