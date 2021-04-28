<div style="margin-top: 10px;" class="s2-container">

   <a class="bc" href="<?php echo base_url();?>"> Menu - VFJI |</a>
   <a class="bc" href="<?php echo base_url();?>vproy"> Mis proyectos |</a>
   Registro de participantes

     
    
</div>

<div class='s2-container'>
		<h1>Registro de participantes <small>(Máximo 5 participantes)</small></h1>
        <div class="s2-alert"></div>
        <?php if($mensaje!=''){ ?>
            <div class="s1-alert">
                <?php echo $mensaje; ?><!-- Aqui se pone el texto de cambios en los registros-->
            </div>  
        <?php } ?>
        <form class="s2-form" method="POST" action="<?php echo base_url();?>gpar">		
            <div class="s2-input">
                <label for="c_busqueda_estudiantes">Estudiantes</label>
                <input id="c_busqueda_estudiantes" type="text" name="txtc_busqueda_estudiantes" autocomplete="off"  placeholder="Ejemplo: GARCIA GONZALEZ JUAN GABRIEL" required />
                
                <div id="nombre_encontrados">
                    <!--aqui se colocan los nombres de los estudiantes-->    
                </div>

                <div id="form_estudiantes">
                    
                </div>
            </div>

			<!-- Colocar botones en línea independiente alineados a la derecha -->
            <div class="s2-input align-end">
				<button title="Escoja una opción de la lista" type="submit" class="btn bg_botones" id="b_agregar_estudiante" disabled>Guardar</button>
            </div>
        </form>

        <form class="s2-form" method="POST" action="<?php echo base_url();?>gparp">    
            <div class="s2-input">
                <label for="c_busqueda_profesores">Profesores</label>
                <input id="c_busqueda_profesores" type="text" name="txtc_busqueda_profesores" autocomplete="off" placeholder="Ejemplo: CHAVEZ VALDEZ RAMONA EVELIA" required/>

                <div id="nombre_encontrados_p">
                    <!--aqui se colocan los nombres de los profesores-->    
                </div>

                <div id="form_profesores">
                    
                </div>
            </div>

            <!-- Colocar botones en línea independiente alineados a la derecha -->
            <div class="s2-input align-end">
                <button title="Escoja una opción de la lista" type="submit"  class="btn bg_botones" id="b_agregar_profesor" disabled>Guardar</button>
            </div>
        </form>

        <table class='s2-table wide' id="tabla_participantes">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Tipo</th>
                    <th>Carrera</th>
                    <th>N control</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                <!--Obtener Responsable -->
                <?php foreach($datos_r as $dato):?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $dato->apellido1_us?>&nbsp;<?php echo $dato->apellido2_us?>&nbsp;<?php echo $dato->nombre_us?> </td>
                        <td><?php echo $dato->departamento_us?></td>
                        <td>
                            <?php echo $dato->nombre_rol ?>  / Profesor                   
                        </td>
                        <td>
                            ---                    
                        </td>
                        <td>
                            ---                    
                        </td>
                        <td>
                            ---
                        </td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
                <!--Obtener estudiantes -->
                <?php foreach($datos as $dato):?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $dato->apellido1_us?>&nbsp;<?php echo $dato->apellido2_us?>&nbsp;<?php echo $dato->nombre_us?> </td>
                        <td><?php echo $dato->departamento_us?></td>
                        <td>
                            <?php echo $dato->nombre_rol ?>                     
                        </td>
                        <td>
                            <?php 

                                echo $dato->carrera_al; 
            
                            ?>                     
                        </td>
                        <td>
                            <?php 

                                echo $dato->id_al_fk; 
                                    
                            ?>                     
                        </td>
                        <td>
                            <a onclick="eliminar_participante('<?php echo $dato->id_us;?>',<?php echo $dato->id_proy;?>,'<?php echo $dato->apellido1_us;?>','<?php echo $dato->apellido2_us;?>','<?php echo $dato->nombre_us;?>')">
                                <button class="btn bg_botones" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            </a>
                        </td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
                 <!--Obtener profesores -->
                <?php foreach($datos_p as $dato):?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $dato->apellido1_us?>&nbsp;<?php echo $dato->apellido2_us?>&nbsp;<?php echo $dato->nombre_us?> </td>
                        <td><?php echo $dato->departamento_us?></td>
                        <td>
                            <?php echo $dato->nombre_rol ?>  / Profesor                   
                        </td>
                        <td>
                            ---                    
                        </td>
                        <td>
                            ---                    
                        </td>
                        <td>
                            <a onclick="eliminar_participante(<?php echo $dato->id_us;?>,<?php echo $dato->id_proy;?>,'<?php echo $dato->apellido1_us;?>','<?php echo $dato->apellido2_us;?>','<?php echo $dato->nombre_us;?>')">
                                <button  class="btn bg_botones" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!------------------------------------ modal bootstrap/Eliminar------------------------------->
        <div class="modal fade" id="modal_eliminar_participante" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar participante &nbsp;&nbsp;

                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <h5> ¿Estas seguro de eliminar a <span id="nombre_participante_eliminar"> </span> ? <h5>
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

    var base="<?php echo base_url();?>";
    var id_proyecto = "<?php echo $dato->id_proy; ?>";
    var numero_participantes = "<?php echo $i; ?>";

    if(numero_participantes>=6){

        $('.s2-alert').text('Ha alcanzado el número máximo de participantes');
        $('.s2-form').css('display','none');
        $('table').css('margin-top','20px');

    }else{

        $('.s2-alert').css('display','none');
    }
    

    //ajax para mandar llamar nombres de de alumnos
    $('#c_busqueda_estudiantes').on('keyup',function(){
        var dato= $('#c_busqueda_estudiantes').val();
        $('#b_agregar_estudiante').attr('disabled',true);

       
        $.ajax({

            type: 'POST',
            url:base+'de',
            data: {
                dato
            },
            beforeSend:function(){

            },
            success:function(response){
  
                nombres = JSON.parse(response);

                $('#nombre_encontrados').html('');
                
                if(dato!=''){
                    $.each(nombres,function(i,item)
                    {
                        
                        $('#nombre_encontrados').append(
                            "<ul>"+
                            "<li class='lista_nombres' departamento='"+item.departamento+"'  apellido2='"+item.apellido2+"' apellido1='"+item.apellido1+"' nombre='"+item.nombre+"'  numcontrol='"+item.num_control+"' carrera='"+item.carrera+"' id='"+item.id_alumno+"'>"+item.apellido1+" "+item.apellido2+" "+item.nombre+"</li>"+
                            "</ul>"

                        );
                        
                    });                            
                }

                $('.lista_nombres').click('click',function(){

                    id_s = $(this).attr('id');
                    carrera_s = $(this).attr('carrera');
                    departamento_s =$(this).attr('departamento');
                    numcontrol_s =$(this).attr('numcontrol');
                    carrera_s =$(this).attr('carrera');
                    nombre_s =$(this).attr('nombre');
                    apellido1_s =$(this).attr('apellido1');
                    apellido2_s =$(this).attr('apellido2');

                    $('#form_estudiantes').html('');

                    $('#form_estudiantes').append('<input style ="display:none;" type="number" name="id_s" value="'+id_s+'" />');
                    $('#form_estudiantes').append('<input style ="display:none;" type="number" name="tipo_par" value="0" />');
                    $('#form_estudiantes').append('<input style ="display:none;" type="number" name="id_proyecto" value="'+id_proyecto+'" />');
                    $('#form_estudiantes').append('<input style ="display:none;" type="text" name="carrera_s" value="'+carrera_s+'" />');
                    $('#form_estudiantes').append('<input style ="display:none;" type="text" name="departamento_s" value="'+departamento_s+'" />');
                    $('#form_estudiantes').append('<input style ="display:none;" type="text" name="numcontrol_s" value="'+numcontrol_s+'" >');
                    $('#form_estudiantes').append('<input style ="display:none;" type="text" name="carrera_s" value="'+carrera_s+'" >');
                    $('#form_estudiantes').append('<input style ="display:none;" type="text" name="nombre_s" value="'+nombre_s+'"" >');
                    $('#form_estudiantes').append('<input style ="display:none;" type="text" name="apellido1_s" value="'+apellido1_s+'" >');
                    $('#form_estudiantes').append('<input style ="display:none;" type="text" name="apellido2_s" value="'+apellido2_s+'" >');


                    nombre_s_c = $(this).text();

                    $('#c_busqueda_estudiantes').val(nombre_s_c);
                    $('#nombre_encontrados').html('');


                    $('#b_agregar_estudiante').attr('disabled',false);

                });//termina click para agregar      

            }

        });//termina ajax*/

    });//termina funcion keyup


     //ajax para mandar llamar nombres de de profesores
    $('#c_busqueda_profesores').on('keyup',function(){
        var dato_p= $('#c_busqueda_profesores').val();
        $('#b_agregar_profesor').attr('disabled',true);

       
        $.ajax({

            type: 'POST',
            url:base+'dp',
            data: {
                dato_p
                
            },
            success:function(response){
  
                nombres_p = JSON.parse(response);

                $('#nombre_encontrados_p').html('');
                
                if(dato_p!=''){
                    $.each(nombres_p,function(i,item)
                    {

                        $('#nombre_encontrados_p').append(
                            "<ul>"+
                            "<li class='lista_nombres_p' departamento='"+item.departamento+"' apellido2='"+item.apellido2+"' apellido1='"+item.apellido1+"' nombre='"+item.nombre+"' id='"+item.id_empleado+"'>"+item.apellido1+" "+item.apellido2+" "+item.nombre+"</li>"+
                            "</ul>"

                        );
                        
                    });                            
                }

                $('.lista_nombres_p').click(function(){

                    id_p = $(this).attr('id');
                    departamento_p =$(this).attr('departamento');
                    nombre_p =$(this).attr('nombre');
                    apellido1_p =$(this).attr('apellido1');
                    apellido2_p =$(this).attr('apellido2');

                    $('#form_profesores').html('');


                    $('#form_profesores').append('<input style ="display:none;" type="number" name="id_p" value="'+id_p+'" />');
                    $('#form_profesores').append('<input style ="display:none;" type="number" name="tipo_par" value="1" />');
                    $('#form_profesores').append('<input style ="display:none;" type="number" name="id_proyecto" value="'+id_proyecto+'" />');
                    $('#form_profesores').append('<input style ="display:none;" type="text" name="departamento_p" value="'+departamento_p+'" />');
                    $('#form_profesores').append('<input style ="display:none;" type="text" name="nombre_p" value="'+nombre_p+'" />');
                    $('#form_profesores').append('<input style ="display:none;" type="text" name="apellido1_p" value="'+apellido1_p+'" />');
                    $('#form_profesores').append('<input style ="display:none;" type="text" name="apellido2_p" value="'+apellido2_p+'" />');


                    var nombre_s_c = $(this).text();

                    $('#c_busqueda_profesores').val(nombre_s_c);
                    $('#nombre_encontrados_p').html('');


                    $('#b_agregar_profesor').attr('disabled',false);

                });
            }

        });//termina ajax*/

    });//termina funcion keyup

    function eliminar_participante(id_us,id_proy,apellido1,apellido2,nombre)
    {
        $('#nombre_participante_eliminar').css('color','red');
        $('#nombre_participante_eliminar').html(apellido1+' '+apellido2+' '+nombre);
        $('#link_eliminar').attr('href',base+'epar/'+id_us+'/'+id_proy);
        $('#modal_eliminar_participante').modal('show'); 

    }


        	
</script>

</body>
</html>