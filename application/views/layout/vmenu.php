<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/siitec2.min.css" />
    <script src="<?php echo base_url()?>assets/js/siitec2.js"></script>
    <title>VFJI</title>
</head>
<body>
    <header id="s2Header">
        <div class="s2-container">
            <a class="logo-s2 reveal-container item" role="button" title="Página principal"
                href="https://itcolima.edu.mx/siitec2"></a>
            <ul class="commands">
                <li class='reveal-container'>
                    <a href="#" title="Salir (Cerrar sesión)" role="button">
                        <span class='s2-ws' data-char="Í"></span>
                    </a>
                </li>
            </ul>
        </div>
    </header>
    <div class='s2-container'>
        <ul class='breadcrumbs' tabindex="0" title="ubicación">
            <li><a href="#" tabindex="-1">Menú principal</a></li>
            <li><a href="#" tabindex="-1">Mis Calificaciones</a></li>
            <li><a href="#" tabindex="-1">Kardex en lista</a></li>
        </ul>
        <h1>Menú principal</h1>
        <ul class='s2-menulist'>
            <li>
                <a href="<?php echo base_url()?>vproy" class='reveal-container anim-reposition' aria-role="button">
                    <h4>Proyectos</h4>
                    <p>Máximo dos proyectos</p>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url()?>lproy" class='reveal-container anim-reposition' aria-role="button" class='reveal-container anim-reposition'>
                    <h4>Lista de Proyectos</h4>
                    <p>Estudiantes</p>
                </a>
            </li>
            <!--
            <li>
                <a href="#" class='reveal-container anim-reposition'>
                    <h4>Mis calificaciones</h4>
                    <p>Mis calificaciones, kárdex y reportes</p>
                </a>
            </li>
            <li>
                <a href="#" class='reveal-container anim-reposition'>
                    <h4>Mis datos y correo institucional</h4>
                    <p>Datos personales, cambiar contraseña, verificar estado de la
                        cuenta de correo institucional.
                    </p>
                </a>
            </li>
            <li>
                <a href="#" class='reveal-container anim-reposition'>
                    <h4>Mis grupos</h4>
                    <p>Mis grupos actuales
                    </p>
                </a>
            </li>
            <li>
                <a href="#" class='reveal-container anim-reposition'>
                    <h4>Mis pagos</h4>
                    <p>Pagos y recibos
                    </p>
                </a>
            </li>
            <li>
                <a href="#" class='reveal-container anim-reposition'>
                    <h4>Moodle</h4>
                    <p>Acceso a la plataforma moodle del Instituto
                    </p>
                </a>
            </li>
            <li>
                <a href="#" class='reveal-container anim-reposition'>
                    <h4>Servicios bibliotecarios</h4>
                    <p>Acceso a servicios bibliotecarios
                    </p>
                </a>
            </li>
        -->
        </ul>
    </div>
</body>
</html>