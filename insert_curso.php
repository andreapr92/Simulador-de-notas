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
global $DB, $USER;

// Moodle pages require a context, that can be system, course or module (activity or resource)
$context = context_system::instance();
$PAGE->set_context($context);

// Check that user is logued in the course.
require_login();

// Page navigation and URL settings.
$PAGE->set_url(new moodle_url('/local/simulador/insert_curso.php'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Curso agregado');

// Show the page header
echo $OUTPUT->header();

// Here goes the content

//Recuperar hidden
$nevaluaciones = $_POST ["nevaluaciones"];
$nombrecurso = $_POST ["nombre"];
$idcurso = $_POST ["id"];


// INGRESAR NOTAS A BASE DE DATOS

//Recuperar notas ingresadas

for ($i=1; $i<= $nevaluaciones; $i++)
{
	for ($n=1; $n<= 5; $n++)
	{
	${'nota'.$i.$n}= $_POST ["nota$i$n"];
	}
}


//Se seleccionan id de evaluaciones

$sql1 = 'SELECT id
		FROM mdl_evaluaciones WHERE cursoid = ?';
$params1 = array("$idcurso");
$result1 = $DB->get_records_sql ( $sql1, $params1 );

$i=1;

foreach ( $result1 as $llave1 => $dato1 ) {
	foreach ( $dato1 as $llave2 => $idevaluaciones ) {
		
		${'idevaluacion'.$i}=$idevaluaciones;
		$i++;

	}
}


// Se ingresan las notas a la base de datos

for ($m=1; $m<=$nevaluaciones; $m++)
{
	for ($b=1; $b<=5; $b++)
	{
		
	${'recordevaluacion'.$m.$b} = new stdClass ();
	
	${'recordevaluacion'.$m.$b}->nota = ${'nota'.$m.$b};
	${'recordevaluacion'.$m.$b}->evaluacionesid = ${'idevaluacion'.$m};
	
	${'idnotas'.$m.$b} = $DB->insert_record ( 'notas', ${'recordevaluacion'.$m.$b} );
	
	}
}
echo "<center>";
echo " Se ha ingresado exitosamente su curso ";
echo "<br><br>";


//Redirigir a Inicio de cursos
echo'<br><br><a href="'.new moodle_url("/local/simulador/inicio.php").'" > SEGUIR </a>';

echo "</center>";






// Show the page footer
echo $OUTPUT->footer();
?>