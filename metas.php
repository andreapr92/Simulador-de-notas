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
include('style.css');


// Moodle pages require a context, that can be system, course or module (activity or resource)
$context = context_system::instance();
$PAGE->set_context($context);

// Check that user is logued in the course.
require_login();

// Page navigation and URL settings.
$PAGE->set_url(new moodle_url('/local/simulador/visor.php'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Metas');


// Show the page header
echo $OUTPUT->header();

// Here goes the content


//Recuperar id del curso seleccionado
$idcurso=$_GET['idcurso'];
$promediocurso=$_GET['promediocurso'];




// Seleccionar nombre del curso

$sql1 = 'SELECT nombre
		FROM mdl_cursos WHERE id = ?';
$params1 = array("$idcurso");
$result1 = $DB->get_records_sql ( $sql1, $params1 );


foreach ( $result1 as $llave1 => $dato1 ) {
	foreach ( $dato1 as $llave2 => $curso ) {

	}
}

// Seleccionar nombre de las evaluaciones del curso

$sql2 = 'SELECT nombre
		FROM mdl_evaluaciones WHERE cursoid = ?';
$params2 = array("$idcurso");
$result2 = $DB->get_records_sql ( $sql2, $params2 );

$i=1;

foreach ( $result2 as $llave3 => $dato2 ) {
	foreach ( $dato2 as $llave4 => $evaluaciones ) {
	
	${'evaluacion'.$i} = $evaluaciones;
	$i++;

	}
}

// Seleccionar id de las evaluaciones del curso

$sql3 = 'SELECT id
		FROM mdl_evaluaciones WHERE cursoid = ?';
$params3 = array("$idcurso");
$result3 = $DB->get_records_sql ( $sql3, $params3 );

$j=1;

foreach ( $result3 as $llave5 => $dato3 ) {
	foreach ( $dato3 as $llave6 => $idevaluaciones ) {

		${'idevaluacion'.$j} = $idevaluaciones;
		$j++;

	}
}


// Seleccionar id de notas cada evaluacion del curso


for ($k=1; $k<=$i-1; $k++)
{
	
$sql4 = 'SELECT id
		FROM mdl_notas WHERE evaluacionesid = ?';
$params4 = array("${'idevaluacion'.$k}");
$result4 = $DB->get_records_sql ( $sql4, $params4 );

$l=1;
foreach ( $result4 as $llave7 => $dato4 ) {
	foreach ( $dato4 as $llave8 => $idnotas ) {

		${'id'.$k.$l} = $idnotas;
		$l++;

	}
}
}


// Seleccionar notas de cada evaluacion

for ($k=1; $k<=$i-1; $k++)
{
	for ($l=1; $l<=5; $l++)
	{

	$sql5 = 'SELECT nota
		FROM mdl_notas WHERE id = ?';
	$params5 = array("${'id'.$k.$l}");
	$result5 = $DB->get_records_sql ( $sql5, $params5 );

	foreach ( $result5 as $llave9 => $dato5 ) {
		foreach ( $dato5 as $llave10 => $notasevaluacion ) {

			${'nota'.$k.$l} = $notasevaluacion;

	}
}
}
}

// Promedio de cada evaluación


for ($e=1; $e<=$i-1; $e++ )
	{
		${'promedio'.$e}=0;
		$contadornotas=0;

		for ($p=1; $p<=5; $p++)
		{
				
			${'promedio'.$e}= ${'promedio'.$e} + ${'nota'.$e.$p};
			if (${'nota'.$e.$p} != "0")
			{
				$contadornotas++;
			}
				
		}

		//Promedio de cada evaluación
		${'promedio'.$e}= ${'promedio'.$e}/$contadornotas;

	}

//Seleccionar promedio deseado del curso

$sql5 = 'SELECT pdeseado
	FROM mdl_cursos WHERE id = ?';
$params5 = array("$idcurso");
$result5 = $DB->get_records_sql ( $sql5, $params5 );


foreach ( $result5 as $llave9 => $dato5 ) {
	foreach ( $dato5 as $llave10 => $pdeseado ) {

	}
}
	

// Seleccionar ponderacion de las evaluaciones del curso

for ($t=1; $t<=$i-1; $t++)
{
$sql6 = 'SELECT ponderacion
		FROM mdl_evaluaciones WHERE id = ?';
$params6 = array("${'idevaluacion'.$t}");
$result6 = $DB->get_records_sql ( $sql6, $params6 );



foreach ( $result6 as $llave11 => $dato6 ) {
	foreach ( $dato6 as $llave12 => $ponderaciones ) {

		${'ponderacion'.$t} = $ponderaciones;

	}
}
}



// Se muestra el informe de notas
echo '<table width=100%>
	<tr bgcolor=#424242 >';
echo '<td align="center" style="color:#FBEFF5"><h3>'. $curso .'</h3></td>';
echo '<td></td>';
echo '</tr></table>';



echo '<table width="100%" ><tr><td>';

for ($a=1; $a<=$i-1; $a++)
{
	echo "<center><h4>${'evaluacion'.$a}</h4></center>";
	
	for ($n=1; $n<=5; $n++)
	{
		echo "</td>";
		echo "<td>";
		if (${'nota'.$a.$n} == "0")
		{
			echo "-";
		}
		else 
		{
		echo "${'nota'.$a.$n}";
		}
	}
	echo'</td><td align="center">';
	$promedioredondeado = round(${'promedio'.$a}, 1);
	echo '<i>'.get_string("PF","local_simulador").'</i>';
	echo " ";
	echo  "<b>$promedioredondeado</b>";
	
	echo "</td></tr>";
	echo "<tr><td>";
}

echo "</td></tr></table>";

$diferencia = ($pdeseado - $promediocurso)*10;
$diferenciaabsoluta = abs ($diferencia);


echo '<table width="100%"><tr bgcolor=#01A9DB><td>';
echo '<h5><font color="white">';
echo '<div align="center"> '.get_string("promedio_curso","local_simulador").'</div>';
echo '</font></h5>';
echo "</td><td>";
echo '<h5><font color="white">';
echo  $promediocurso;
echo '</font></h5>';
echo "</td></tr>";
echo "<tr bgcolor=#0040FF ><td>";
echo '<h5><font color="white">';
echo '<div align="center"> '.get_string("promedio_deseado","local_simulador").'</div>';
echo '</font></h5>';
echo "</td><td>";
echo '<h5><font color="white">';
echo  $pdeseado;
echo '</font></h5>';
echo "</td></tr></table>";
echo "<br><br>";


// Mensaje sobre la diferencia

if ($diferencia > 1)
{
	echo '<div align="center">';
	echo get_string("faltan","local_simulador");
	echo  '<b>'.$diferenciaabsoluta.'</b> ' ; 
	echo get_string("decimas_menos","local_simulador");// décimas para llegar al Promedio Deseado<br>"
    echo "<br>";
    echo '</div>';
}
elseif ($diferencia < 1)
{
	echo '<div align="center">';
	echo get_string("pasado","local_simulador");
	echo  '<b>'.$diferenciaabsoluta.'</b> ';
	echo ''.get_string("decimas_mas","local_simulador").'';// décimas para llegar al Promedio Deseado<br>"
	echo "<br>";
	echo '</div>';
}
else 
{
	echo '<div align="center">';
	echo get_string("promedio_justo","local_simulador");
	echo '</div>';
}


// RECOMENDACIONES

echo '<div align="center">';
echo "<h5><u>";
echo get_string("recomendaciones","local_simulador");
echo "</u></h5><br>";
echo '</div>';


// Encontrar evaluación débil

$arrayevaluaciones = array();
for ($e=1; $e<=$i-1; $e++)
{
	$ponderacioncurso = ${'promedio'.$e}*${'ponderacion'.$e}/100;
	array_push($arrayevaluaciones, "$ponderacioncurso");
}
$evaluaciondebil = min ($arrayevaluaciones);

$posicion = array_search("$evaluaciondebil",$arrayevaluaciones)+1;

// Recomendación 1
echo '<div align="center"><li>';
echo get_string("evaluacion_debil","local_simulador");
echo '<b> '.${'evaluacion'.$posicion}.'</b>';
echo get_string("evaluacion_debil_consejo","local_simulador");
echo '</li></div><br>';



// Evaluación con mayor ponderación
$arrayponderaciones = array();

for ($e=1; $e<=$i-1; $e++)
{
	array_push($arrayponderaciones, "${'ponderacion'.$e}");
}
$ponderacionmasalta = max($arrayponderaciones);
$posicionealta = array_search("$ponderacionmasalta",$arrayponderaciones)+1;


// Recomendación 2
echo '<div align="center"><li>';
echo get_string("evaluacion_mayor_ponderacion","local_simulador");
echo '<b>'.${'evaluacion'.$posicionealta}.'</b>';
echo get_string("evaluacion_mayor_ponderacion_consejo","local_simulador");
echo '</li></div>';

//Redirigir a Visor de cursos
echo'<br><br><center><a href="'.new moodle_url("/local/simulador/visor.php").'" class="inicio" >'.get_string("volver","local_simulador").'</a><hr></center>';


// Show the page footer
echo $OUTPUT->footer();
?>