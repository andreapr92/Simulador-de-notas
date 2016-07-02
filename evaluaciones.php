<?php
// Minimum for Moodle to work, the basic libraries
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/config.php');
global $DB, $USER;

// Moodle pages require a context, that can be system, course or module (activity or resource)
$context = context_system::instance();
$PAGE->set_context($context);

// Check that user is logued in the course.
require_login();

// Page navigation and URL settings.
$PAGE->set_url(new moodle_url('/local/simulador/evaluaciones.php'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Evaluaciones');



// Show the page header
echo $OUTPUT->header();

// variables recibidas de index.php

// TABLA CURSOS
$nombre = required_param ( 'curso', PARAM_ALPHA );
$pdeseado = required_param ( 'pdeseado', PARAM_NUMBER );
$duracion = required_param ( 'duracion', PARAM_ALPHA );
$duracion = $duracion === 'anual' ? 1 : 0;
$grado = required_param ( 'grado', PARAM_INT );
$nevaluaciones = required_param ( 'nevaluaciones', PARAM_INT );

// VER SI VARIABLES SON NULL
echo '<table width=100%>
	<tr bgcolor=#424242 >';
echo '<td align="center" style="color:#FBEFF5"><h3>'. $nombre .'</h3></td>';
echo '<td></td>';
echo '</tr>		<tr bgcolor=#0080FF><td align="center" style="color:#FBEFF5">'.get_string("instruccionponderaciones","local_simulador").'</td></tr></table><br>';

//echo $duracion;
//echo $grado;
//echo $pdeseado;
//echo $nevaluaciones;

// Insertar en la tabla cursos de la base de datos

$recordcursos = new stdClass ();
$recordcursos->nombre = $nombre;
$recordcursos->duracion = $duracion;
$recordcursos->dificultad = $grado;
$recordcursos->pdeseado = $pdeseado;

$idcurso = $DB->insert_record ( 'cursos', $recordcursos );




// INSERTAR EVALUACIONES


echo '
<form action="notas.php" method="post">

<table align="center">
<tr>
<td align="center"> ' . get_string('evaluaciones','local_simulador') . '</td>
<td align="center"> ' . get_string('ponderacion','local_simulador') . '</td>
</tr> ';


for ($i=1; $i<= $nevaluaciones; $i++)
{

echo '
		
<tr>
<td>'.$i.'. <input type="text" name="evaluacion'.$i.'"> = </td>
<td><input type="text" name="ponderacion'.$i.'"> % </td>
</tr>'
;
}

echo '

<input type="hidden" name="nevaluaciones" value=' . $nevaluaciones . '>
<input type="hidden" name="nombre" value=' . $nombre . '>
<tr><td></td><td><input type="submit" name="boton2" value='.get_string("siguiente","local_simulador").'> </td></tr>
</table> 
</form>';

// Show the page footer
echo $OUTPUT->footer();
?>

