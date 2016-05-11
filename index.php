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
$PAGE->set_url(new moodle_url('/local/tics331'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Inscripcion de cursos');



// Show the page header
echo $OUTPUT->header();

// Here goes the content



?>
<center>Inscripción de Curso </center>
<br>

<form action="hola.php" method="post">


 Nombre Curso: <input type="text" name="curso">
 Duración
<select>
  <option value="duracion1">Semestral</option>
  <option value="duracion2">Anual</option>
</select>


<br>


<table style="width:100%">
  <tr>
    <td>Evaluaciones</td>
    <td>N° de evaluaciones</td> 
    <td>Ponderación</td>
  </tr>
  <tr>
    <td><input type="text" name="evaluacion"></td>
    <td><input type="text" name="nevaluacion"></td> 
    <td><input type="text" name="ponderacion"></td>
  </tr>
</table>



Grado de dificultad
<select>
  <option value="grado1">1</option>
  <option value="grado2">2</option>
  <option value="grado2">3</option>
  <option value="grado2">4</option>
  <option value="grado2">5</option>
  <option value="grado2">6</option>
  <option value="grado2">7</option>
  <option value="grado2">8</option>
  <option value="grado2">9</option>
  <option value="grado2">10</option>
</select>
<br>
Promedio Deseado:
<input type="text" name="pdeseado">

<br><input type="submit">

</form>

<?php 
// Show the page footer
echo $OUTPUT->footer();
?>
