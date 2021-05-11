<div style="margin-top: 10px;" class="s2-container">

   <a class="bc" href="<?php echo base_url();?>"> Menu - VFJI |</a>
   Detalles
   
</div>
<?php echo $this->session->userdata('id_evento'); ?>

<div class='s2-container'>
        <ul class='s2-menulist'>
            <li>
            <a data-toggle='modal' data-target='#modal_numeralia' class='reveal-container anim-reposition' aria-role="button" class='reveal-container anim-reposition'>
                    <h4>Numeralia</h4>
                    <p>Cantidades</p>
                </a>
            </li>
            <li>
                <a data-toggle='modal' data-target='#modal_estudiantes' class='reveal-container anim-reposition' aria-role="button" class='reveal-container anim-reposition'>
                    <h4>Estudiantes</h4>
                    <p>Estudiantes Registrados</p>
                </a>
            </li>
            <li>
                <a data-toggle='modal' data-target='#modal_proyectos' class='reveal-container anim-reposition' aria-role="button" class='reveal-container anim-reposition'>
                    <h4>Proyectos/Difusión Cientifica</h4>
                    <p>Detalles de Proyectos</p>
                </a>
            </li>
            <li>
                <a data-toggle='modal' data-target='#modal_profesores' class='reveal-container anim-reposition' aria-role="button" class='reveal-container anim-reposition'>
                    <h4>Profesores</h4>
                    <p>Porfesores Registrados</p>
                </a>
            </li>
            <li>
                <a data-toggle='modal' data-target='#modal_original' class='reveal-container anim-reposition' aria-role="button" class='reveal-container anim-reposition'>
                    <h4>Original</h4>
                    <p>Detalles Generales</p>
                </a>
            </li>
        </ul>
    </div>

<!------------------------------------ modal bootstrap numeralia--------------------------------------->
<div class="modal fade" id="modal_numeralia" name="modal_numeralia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Numeralia &nbsp;&nbsp;
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div id="modal_contenido">
            <?php $i=0 ?>
            <?php $j=0 ?>
            <?php foreach($proyectos as $proyecto):?>
                <?php
                $concluido=$proyecto->concluido_proy;
                if ($concluido != null) {
                    $j++;
                }
                ?>
                <?php $i++ ?>
			<?php endforeach; ?>
	 		<table class='s2-table wide'>
                <h5>Proyectos</h5>
                <thead>
                    <th>Registrados</th>
                    <th>Concluidos</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $j; ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table class='s2-table wide'>
                <thead>
                    <th>Estudiantes</th>
                    <th>Cantidad</th>
                </thead>
                <tbody>
                <?php foreach($estudiantes as $estudiante):?>
                    <tr>
                        <td><?php echo $estudiante->departamento_us?></td>
                        <td><?php echo $estudiante->departamento?></td>
                    </tr>
			    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <table class='s2-table wide'>
                <thead>
                    <th>Profesores</th>
                    <th>Cantidad</th>
                </thead>
                <tbody>
                <?php foreach($profesores as $profesor):?>
                    <tr>
                        <td><?php echo $profesor->departamento_us?></td>
                        <td><?php echo $profesor->departamento?></td>
                    </tr>
			    <?php endforeach; ?>
                </tbody>
            </table>


	 	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg_botones" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!------------------------------------ modal bootstrap estudiantes--------------------------------------->
<div class="modal fade" id="modal_estudiantes" name="modal_estudiantes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered container-fluid" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Estudiantes &nbsp;&nbsp;
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div id="modal_contenido">
          <?php $i=1 ?>
          <table class='s2-table wide responsive'>
                <thead>
                    <th>No.</th>
                    <th>No. Control</th>
                    <th>Estudiantes</th>
                    <th>Carrera</th>
                    <th>Alfabetización</th>
                    <th>Redacción</th>
                    <th>Artículo</th>
                    <th>Cartel</th>
                </thead>
                <tbody>
                <?php foreach($dEstudiantes as $estudiante):?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $estudiante->id_us?></td>
                        <td><?php echo $estudiante->nombre_us,' ',$estudiante->apellido1_us,' ',$estudiante->apellido2_us?></td>
                        <td><?php echo $estudiante->departamento_us?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php $i++; ?>
			    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <table class='s2-table wide d-flex justify-content-center'>
                <tbody>
                <?php foreach($estudiantes as $estudiante):?>
                    <tr>
                        <td><?php echo $estudiante->departamento_us?></td>
                        <td><?php echo $estudiante->departamento?></td>
                    </tr>
			    <?php endforeach; ?>
                </tbody>
            </table>
	 	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg_botones" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!------------------------------------ modal bootstrap proyectos--------------------------------------->
<div class="modal fade" id="modal_estudiantes" name="modal_estudiantes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered container-fluid" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Proyectos &nbsp;&nbsp;
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div id="modal_contenido">
          <?php $i=1 ?>
          <table class='s2-table wide responsive'>
                <thead>
                    <th>No.</th>
                    <th>Nombre del Proyecto</th>
                    <th>Asesor(es)</th>
                    <th>Participantes</th>
                    <th>Carrera</th>
                </thead>
                <tbody>
                <?php foreach($dEstudiantes as $estudiante):?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td>
                            <?php foreach($dEstudiantes as $estudiante):?>
                            <?php echo $estudiante->id_us?>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php foreach($dEstudiantes as $estudiante):?>
                            <?php echo $estudiante->id_us?>
                            <?php endforeach; ?>
                        </td>
                        <td><?php echo $estudiante->departamento_us?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php $i++; ?>
			    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <table class='s2-table wide d-flex justify-content-center'>
                <tbody>
                <?php foreach($estudiantes as $estudiante):?>
                    <tr>
                        <td><?php echo $estudiante->departamento_us?></td>
                        <td><?php echo $estudiante->departamento?></td>
                    </tr>
			    <?php endforeach; ?>
                </tbody>
            </table>
	 	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg_botones" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!------------------------------------ modal bootstrap profesores--------------------------------------->
<div class="modal fade" id="modal_profesores" name="modal_profesores" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered container-fluid" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Profesores &nbsp;&nbsp;
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div id="modal_contenido">
          <?php $i=1 ?>
          <table class='s2-table wide responsive'>
                <thead>
                    <th>No.</th>
                    <th>Profesor</th>
                    <th>No. Proyectos</th>
                    <th>Carrera</th>
                </thead>
                <tbody>
                <?php foreach($dProfesores as $profesor):?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $profesor->nombre_us,' ',$profesor->apellido1_us,' ',$profesor->apellido2_us?></td>
                        <td><?php echo $profesor->proyectos?></td>
                        <td><?php echo $profesor->departamento_us?></td>
                    </tr>
                    <?php $i++; ?>
			    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <table class='s2-table wide d-flex justify-content-center'>
                <tbody>
                <?php foreach($profesores as $profesor):?>
                    <tr>
                        <td><?php echo $profesor->departamento_us?></td>
                        <td><?php echo $profesor->departamento?></td>
                    </tr>
			    <?php endforeach; ?>
                </tbody>
            </table>
	 	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg_botones" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!------------------------------------ modal bootstrap original--------------------------------------->
<div class="modal fade" id="modal_original" name="modal_original" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered container-fluid" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Original &nbsp;&nbsp;
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div id="modal_contenido">
          <?php $i=1 ?>
          <table class='s2-table wide responsive'>
                <thead>
                    <th>No.</th>
                    <th>No. Control</th>
                    <th>Estudiantes</th>
                    <th>Carrera</th>
                    <th>Alfabetización</th>
                    <th>Redacción</th>
                    <th>Artículo</th>
                    <th>Cartel</th>
                </thead>
                <tbody>
                <?php foreach($dEstudiantes as $estudiante):?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $estudiante->id_us?></td>
                        <td><?php echo $estudiante->nombre_us,' ',$estudiante->apellido1_us,' ',$estudiante->apellido2_us?></td>
                        <td><?php echo $estudiante->departamento_us?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php $i++; ?>
			    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <table class='s2-table wide d-flex justify-content-center'>
                <tbody>
                <?php foreach($estudiantes as $estudiante):?>
                    <tr>
                        <td><?php echo $estudiante->departamento_us?></td>
                        <td><?php echo $estudiante->departamento?></td>
                    </tr>
			    <?php endforeach; ?>
                </tbody>
            </table>
	 	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg_botones" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>