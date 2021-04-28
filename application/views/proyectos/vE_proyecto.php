<div style="margin-top: 10px;" class="s2-container">

   <a class="bc" href="<?php echo base_url();?>"> Menu - VFJI |</a>
   <a class="bc" href="<?php echo base_url();?>vproy"> Mis proyectos |</a>
   Editar de proyectos
</div>

<div class='s2-container'>
		<h1>Edición de proyectos</h1>
        <form class="s2-form" method="POST" action="<?php echo base_url();?>gproye" id="r_proyecto">
			<!-- Usar autofocus en el primer campo del formulario, si el formulario es acción principal -->
            <div class="s2-input" style="display: none;">
                <input id="id_proy" type="number" name="txtid_proy" maxlength="255" autocomplete="off" value="<?php echo $proyecto->id_proy ?>" />
            </div>
            <div class="s2-input">
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" name="txtnombre" maxlength="255" required autofocus autocomplete="off" value="<?php echo $proyecto->nombre_proy ?>" />
			</div>
			
            <div class="s2-input">
                <label for="problematica">Problematica planteada</label>
                <textarea maxlength="255" required id="problematica" rows="6" name="txtproblematica" form="r_proyecto"><?php echo $proyecto->problematica_proy ?></textarea>
            </div>
            
            <div class="s2-input">
                <label for="objetivo">Objetivo general</label>
                <textarea maxlength="255" required id="objetivo" rows="6" name="txtobjetivo" form="r_proyecto"><?php echo $proyecto->objetivo_proy ?></textarea>
            </div>	
            
			<div class="s2-input" id="g_competencias">
                <label for="comperencias">Competencias previas</label>
                <textarea required id="comperencias" rows="6" name="txtcompetencias" placeholder="Ejemplo: Lenguaje de programacion python, diseño de bases de datos, tecnologias de internet" form="r_proyecto"><?php echo $proyecto->competencia_proy ?></textarea>
               
            </div>
	
			<!-- Colocar botones en línea independiente alineados a la derecha -->
            <div class="s2-input align-end">
				<button type="submit" class="btn bg_botones" id="guardar_proyecto">Guardar</button>
            </div>
        </form>



	</script>
</body>
</html>