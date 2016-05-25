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
require_once($CFG->libdir.'/adminlib.php');

// Moodle pages require a context, that can be system, course or module (activity or resource)
$context = context_system::instance();
$PAGE->set_context($context);

// Check that user is logued in the course.
require_login();

// Page navigation and URL settings.
$PAGE->set_url(new moodle_url('/local/simulador/visor.php'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Cursos');



// Show the page header
echo $OUTPUT->header();

// Here goes the content

?>

<center>Cursos</center>
<br>

<?php

//Se seleccionan cursos ingresados de la base de datos
$sql1 = 'SELECT nombre 
		FROM mdl_cursos';
$sql2 = 'SELECT nota
		FROM mdl_notas';
$sql3 = 'SELECT ponderacion
		FROM mdl_evaluaciones';

$result = $DB->get_records_sql ( $sql1 );
$result2 = $DB->get_records_sql ( $sql2 );
$result3 = $DB->get_records_sql ( $sql3 );


//calculo de promedio
foreach ($result3 as $ponderacion)
{
	$ponderacion = $ponderacion/100;
}

$promediopond = result3 * (array_sum($result2)/count($result2));
$promedio = array_sum($promediopond);



$i;
//Mostrar cada curso en una fila de la tabla

echo '<table style="width:100%"><tr>';
		
foreach ($result as $curso)
{
	echo '
	<td>
		$curso 
	</td>';
$i++;
if ($i%2==0){
	echo '</tr><tr>';
		}
}
echo '</table>';
		

// Show the page footer
echo $OUTPUT->footer();
?>

