<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package local
 * @subpackage tics331
 * @copyright 2012-onwards Jorge Villalon <jorge.villalon@uai.cl>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
// Minimum for Moodle to work, the basic libraries
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
global $DB, $USER;

// Moodle pages require a context, that can be system, course or module (activity or resource)
$context = context_system::instance();
$PAGE->set_context($context);

// Check that user is logued in the course.
require_login();

// Page navigation and URL settings.
$PAGE->set_url(new moodle_url('/local/simulador/notas.php'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Inscripcion de notas');



// Show the page header
echo $OUTPUT->header();

echo '<table width=100%>
	<tr bgcolor=#424242 >';
echo '<td align="center" style="color:#FBEFF5"><h3>' . get_string('notas_titulo','local_simulador') . '</h3></td>';
echo '<td></td>';
echo '</tr></table><br>';




// INGRESAR EVALUACIONES A BASE DE DATOS

//Recuperar hidden
$nevaluaciones = $_POST ["nevaluaciones"];
$nombrecurso = $_POST ["nombre"];


//Recuperar evaluaciones ingresadas
for ($i=1; $i<= $nevaluaciones; $i++)
{
	${'evaluacion'.$i}= $_POST ["evaluacion$i"];
	${'ponderacion'.$i}= $_POST ["ponderacion$i"];
}


//Llamar al id del curso ingresado
$sql1 = 'SELECT id
		FROM mdl_cursos WHERE nombre = ?';
$params = array("$nombrecurso");

$result = $DB->get_records_sql ( $sql1,$params );

foreach ( $result as $llave1 => $dato1 ) {
	foreach ( $dato1 as $llave2 => $id ) {

	}
}

//Ingresar evaluaciones
//Se ingresan los valores de cada evaluaciÃ³n a la base de datos
for ($i=1; $i<= $nevaluaciones; $i++)
{
	${'recordevaluacion'.$i} = new stdClass ();

	${'recordevaluacion'.$i}->nombre = ${'evaluacion'.$i};
	${'recordevaluacion'.$i}->ponderacion = ${'ponderacion'.$i};
	${'recordevaluacion'.$i}->cursoid = $id;

	${'idevaluaciones'.$i} = $DB->insert_record ( 'evaluaciones', ${'recordevaluacion'.$i} );
}









//INGRESAR NOTAS A EVALUACIONES


//Se seleccionan evaluaciones ingresadas de la base de datos
$sql2 = 'SELECT id, nombre
		FROM mdl_evaluaciones WHERE cursoid = ?';
$params2 = array("$id");
$result2 = $DB->get_records_sql ( $sql2, $params2 );


//Mostrar cada curso en una fila de la tabla

$j=0;
echo '
<form action="insert_curso.php" method="post">
<table align="center">';

		
		
foreach ($result2 as $llave3 => $dato2)
{
	foreach ($dato2 as $llave4 => $evaluacion)
	{

		$nombre[$j][$llave4]=$evaluacion;


	}
	$j++;
}

echo '<tr>';

for ($j=0; $j<=count($nombre)-1; $j++ )
{
	echo '
	<td>
	<center>
	' . $nombre[$j]["nombre"] . '
	</center>
	</td>';
}
echo '</tr>
	<tr>';

for ($l=1; $l<=count($nombre); $l++ )
{
echo '<td>';

echo '
	<table align="center">';
			// Por cada evaluación se ingresan notas en el formulario
			for ($n=1; $n<= 5; $n++)
			{
			echo '
			<tr>
			<td> ' . $n .'. <input type="number" name="nota'.$l.''.$n.'" min="1" max="7" step="0.1"></td>
			</tr>
			';}
echo '</table>
	</td>';
}
echo 
	'</tr>
	</table>
	<br><br>
	<center>
<br><input type="hidden" name="nevaluaciones" value=' . $nevaluaciones . '>
<br><input type="hidden" name="nombre" value=' . $nombrecurso . '>
<br><input type="hidden" name="id" value=' . $id . '>
	<input type="submit" name="boton3">
	</center>
	</form>';
	
	
	
	
	

// Show the page footer
echo $OUTPUT->footer();
?>