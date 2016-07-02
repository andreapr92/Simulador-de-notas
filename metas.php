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
$PAGE->set_url(new moodle_url('/local/simulador/prueba2.php'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Inicio');


// Show the page header
echo $OUTPUT->header();

// Here goes the content


//Recuperar id del curso seleccionado
$a=$_GET['idcurso'];
echo "$a";


// Seleccionar nombres del curso

$sql1 = 'SELECT nombre
		FROM mdl_cursos';
$result1 = $DB->get_records_sql ( $sql1 );

$i=1;

foreach ( $result1 as $llave1 => $dato1 ) {
	foreach ( $dato1 as $llave2 => $curso ) {

		${'curso'.$i}=$curso;
		$i++;

	}
}


// Seleccionar id de cada curso

$sql2 = 'SELECT id
		FROM mdl_cursos';
$result2 = $DB->get_records_sql ( $sql2 );

$j=1;

foreach ( $result2 as $llave3 => $dato2 ) {
	foreach ( $dato2 as $llave4 => $id ) {

		${'id'.$j}=$id;
		$j++;

	}
}


//Se seleccionan id de evaluaciones de cada curso


for ($a=1; $a<=$i-1; $a++ )
{
	${'contador'.$a}=0; // contador de evaluaciones de cada curso
	$k=1;

	$sql3 = 'SELECT id
		FROM mdl_evaluaciones WHERE cursoid = ?';
	$params3 = array("${'id'.$a}");
	$result3 = $DB->get_records_sql ( $sql3, $params3 );

	foreach ( $result3 as $llave5 => $dato3 ) {
		foreach ( $dato3 as $llave6 => $idevaluaciones ) {

			${'id'.$a.$k}= $idevaluaciones;
			$k++;
			${'contador'.$a}++;
		}
	}
}

// Se selecciona ponderación de cada evaluación de cada curso


for ($r=1; $r<=$i-1; $r++ )
{
	for ($q=1; $q<= ${'contador'.$r}; $q++)
	{


		$sql6 = 'SELECT ponderacion
		FROM mdl_evaluaciones WHERE id = ?';
		$params6 = array("${'id'.$r.$q}");
		$result6 = $DB->get_records_sql ( $sql6, $params6 );

		foreach ( $result6 as $llave11 => $dato6 ) {
			foreach ( $dato6 as $llave12 => $ponderaciones ) {

				${'ponderacion'.$r.$q}= $ponderaciones;

			}
		}
}
}



// Se seleccionan id de notas de cada evaluacion de cada curso


for ($d=1; $d<=$i-1; $d++ )
{

	for ($m=1; $m<=${'contador'.$d}; $m++ )
	{
		$l=1;

		$sql4 = 'SELECT id
		FROM mdl_notas WHERE evaluacionesid = ?';
		$params4 = array("${'id'.$d.$m}");
		$result4 = $DB->get_records_sql ( $sql4, $params4 );

		foreach ( $result4 as $llave7 => $dato4 ) {
			foreach ( $dato4 as $llave8 => $idnotas ) {

				${'id'.$d.$m.$l}=$idnotas;
				$l++;

			}
		}
}
}

// Se seleccionan notas de cada evaluacion de cada curso

for ($e=1; $e<=$i-1; $e++ )
{

	for ($n=1; $n<=${'contador'.$e}; $n++ )
	{
		for ($p=1; $p<=5; $p++)
		{

			$sql5 = 'SELECT nota
		FROM mdl_notas WHERE id = ?';
			$params5 = array("${'id'.$e.$n.$p}");
			$result5 = $DB->get_records_sql ( $sql5, $params5 );

			foreach ( $result5 as $llave9 => $dato5 ) {
				foreach ( $dato5 as $llave10 => $notas ) {

					${'nota'.$e.$n.$p}=$notas;

				}
			}
	}
}
}


// CÁLCULO DE PROMEDIO POR CURSO

for ($e=1; $e<=$i-1; $e++ )
{
	${'promedio'.$e}=0;

	for ($n=1; $n<=${'contador'.$e}; $n++ )
	{
		${'promedio'.$e.$n}=0;

		for ($p=1; $p<=5; $p++)
		{
				
			${'promedio'.$e.$n}= ${'promedio'.$e.$n} + ${'nota'.$e.$n.$p};
				
		}

		//Promedio de cada evaluación
		${'promedio'.$e.$n}= ${'promedio'.$e.$n}/5;

		${'promedio'.$e}=${'promedio'.$e}+${'promedio'.$e.$n};
	}

	//Promedio de cada curso
	${'promedio'.$e} = round(${'promedio'.$e}/${'contador'.$e} , 1);

}






// Show the page footer
echo $OUTPUT->footer();
?>