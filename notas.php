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

// TABLA EVALUACIONES

//Recuperar evaluaciones ingresadas
$nevaluaciones = $_POST ["nevaluaciones"];
$nombre = $_POST ["nombre"];

for ($i=1; $i<= $nevaluaciones; $i++)
{
	${'evaluacion'.$i}= $_POST ["evaluacion$i"];
	${'ponderacion'.$i}= $_POST ["ponderacion$i"];
}



//Llamar al id del curso ingresado
$sql1 = 'SELECT id
		FROM mdl_cursos WHERE nombre = ?';
$params = array("$nombre");

$result = $DB->get_records_sql ( $sql1,$params );

foreach ( $result as $llave1 => $dato1 ) {
	foreach ( $dato1 as $llave2 => $id ) {

	}
}

//Ingresar evaluaciones

//Se crea array vacío
$recordevaluaciones = array();

//Se ingresan los valores de cada evaluación a la base de datos
for ($i=1; $i<= $nevaluaciones; $i++)
{
	${'recordevaluacion'.$i} = new stdClass ();
	
	${'recordevaluacion'.$i}->nombre = ${'evaluacion'.$i};
	${'recordevaluacion'.$i}->ponderacion = ${'ponderacion'.$i};
	${'recordevaluacion'.$i}->cursoid = $id;
	
	array_push($recordevaluaciones, ${'recordevaluacion'.$i});
}


$idevaluaciones = $DB->insert_record ( 'evaluaciones', $recordevaluaciones );

//INGRESAR NOTAS A EVALUACIONES


//Se seleccionan evaluaciones ingresadas de la base de datos
$sql1 = 'SELECT id, nombre
		FROM mdl_evaluaciones';
$result = $DB->get_records_sql ( $sql1 );
	
?>


    <td>Notas</td> 
  </tr>
  <tr>
    <td><select>
  		<option value="Control">Control</option>
 		<option value="Prueba">Prueba</option>
		</select>
	</td>
    <td><input type="number" name="nota" min="1" max="7" step="0.1"></td> 
  </tr>
</table>
<br>
<button onclick="agregarEvaluacion()">Agregar evaluación</button>

<script>
function agregarEvaluacion() {
    var table = document.getElementById("inscripcionNotas");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = <select>
  		<option value="Control">Control</option>
 		<option value="Prueba">Prueba</option>
		</select>;
    cell2.innerHTML = <input type="number" name="nota" min="1" max="7" step="0.1">;
}
</script>


<br><input type="submit" name="Guardar">

</form>

<?php 

// Show the page footer
echo $OUTPUT->footer();
?>