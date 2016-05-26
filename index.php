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
echo '<meta charset = UTF-8>';
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');

// Moodle pages require a context, that can be system, course or module (activity or resource)
$context = context_system::instance();
$PAGE->set_context($context);

// Check that user is logued in the course.
require_login();

// Page navigation and URL settings.
$PAGE->set_url(new moodle_url('/local/simulador/index.php'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Inscripcion de cursos');



// Show the page header
echo $OUTPUT->header();

// Here goes the content
echo 
'<center>' . get_string('tituloindex','local_simulador') . '</center>
<br>

<form action="insert_form.php" method="post">'


. get_string('nombrecurso','local_simulador') .': <input type="text" name="curso">
 ' . get_string('duracioncurso','local_simulador') . '
<select name="duracion">
  <option value="semestral"> ' . get_string('semestral','local_simulador') . '</option>
  <option value="anual"> ' . get_string('anual','local_simulador') . '</option>
</select>


<br>


<table style="width:100%">
  <tr>
    <td> ' . get_string('evaluaciones','local_simulador') . '</td>
    <td> ' . get_string('ponderacion','local_simulador') . '</td>
  </tr>
  <tr>
    <td><input type="text" name="evaluacion"></td>
    <td><input type="text" name="ponderacion"></td>
  </tr>
  <tr>
    <td><input type="text" name="evaluacion2"></td> 
    <td><input type="text" name="ponderacion2"></td>
  </tr>
    		
</table>



 ' . get_string('grado','local_simulador') . '
<select name="grado">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
<br>
 ' . get_string("pdeseado","local_simulador") . ':
<input type="text" name="pdeseado">

<br><input type="submit" name="boton">

</form>
<br>';

// Show the page footer
echo $OUTPUT->footer();
?>
