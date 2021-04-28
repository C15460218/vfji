<div class="s2-container">
	<div class="row">
		<div class="col-12" style="margin-top: 10px;">
			<div class="form-group">
			    <label for="filtro_depa"><h5>Filtros por departamento</h5></label>
			    <select class="form-control" id="filtro_depa">
			    	<option value="1">TODOS</option>
			    	<?php $valor=""; ?>
			    	<?php foreach ($datos as $dato): ?>
		    			<?php if($valor==$dato->departamento_us){ ?>
		    					<?php continue; ?>
		    			<?php }else{ ?>	
	    					<option value="<?php echo str_replace(' ', '', $dato->departamento_us); ?>">
	    						<?php echo $dato->departamento_us; ?>
	    						<?php $valor=$dato->departamento_us;?>
	    					</option>
		    			<?php } ?>
			    	<?php endforeach ?>
			    </select>
			 </div>
		</div>
	</div>
	<div class="row">
		<?php foreach ($proyectos as $proyecto): ?>
		<div class="col-md-6 proyectos <?php echo str_replace(' ', '', $proyecto->departamento_us); ?>">
			<div class="card" style="margin-top: 20px;">
				  <div class="card-header">
				  	<h5 class="card-title"><?php echo $proyecto->nombre_proy ?></h5>
				  </div>
				  <div class="card-body">
				    	<h5>Problematica</h5>
				    	<p class="card-text" style="text-align: justify;"><?php echo $proyecto->problematica_proy ?></p>
				    	<h5>Objevito</h5>
				    	<p class="card-text" style="text-align: justify;"><?php echo $proyecto->objetivo_proy ?></p>
				    	<h5>Competencias</h5>
				    	<?php

				    		$competencia = explode(",", $proyecto->competencia_proy);

				    	?>
				    	<p class="card-text">
				    		
				    		<?php  foreach($competencia as $com): ?>

				    			<li><?php echo $com ?></li>

				    		<?php endforeach; ?>

				    	</p>
				    	<hr>
				  		<h5>Responsable Administrativo</h5>
				    	<p class="card-text">
				    		<b>
				    		<?php echo $proyecto->apellido1_us ?> 
				    		<?php echo $proyecto->apellido2_us ?> 		
				    		<?php echo $proyecto->nombre_us ?>
				    		</b>		
				    	</p>
				  </div>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>

<script type="text/javascript">
	
	$('#filtro_depa').change(function(){

		var valor_s = $(this).val();

		if(valor_s=='1'){

			$('.proyectos').css('display','block');

		}else{

			$('.proyectos').css('display','none');
			$('.'+valor_s).css('display','block');

		}

	});

</script>