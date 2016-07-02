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
$PAGE->set_url(new moodle_url('/local/simulador/index.php'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Inscripcion de cursos');



// Show the page header
echo $OUTPUT->header();
echo '<table width=100%>
	<tr bgcolor=#424242 >';
echo '<td align="center" style="color:#FBEFF5"><h3>' . get_string('tituloindex','local_simulador') . '</h3></td>';
echo '<td></td>';
echo '</tr></table><br>';

// FORMULARIO CURSOS
echo '
<table align=center>
<form action="evaluaciones.php" method="post">
	
<tr><td><h6>'. get_string('nombrecurso','local_simulador') .':</h6></td><td> <input type="text" name="curso" id=1></td></tr>
 <tr><td><h6>' . get_string('duracioncurso','local_simulador') . ':</h6></td><td>
 			
 		
<select name="duracion" id=2>
  <option value="semestral"> ' . get_string('semestral','local_simulador') . '</option>
  <option value="anual"> ' . get_string('anual','local_simulador') . '</option>
</select>
</td></tr>
<tr><td><h6> ' . get_string('numero_evaluaciones','local_simulador') . ' :</h6><br><br></td> <td> <input type="number" name="nevaluaciones" min="1" id=11><br><i>' . get_string('ejemplonevaluaciones','local_simulador') . '</i><br></td></tr>

<tr><td><h6> ' . get_string('grado','local_simulador') . ':</h6></td> <td>
<select name="grado" id=9>
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
</td></tr>
		
<tr><td> <h6> ' . get_string("pdeseado","local_simulador") . ':</h6></td> <td>
<input type="number" name="pdeseado" min="1" max="7" step="0.1" id=10></td></tr>
 		
<tr><td> </td> <td><input type="submit" name="boton" value='.get_string("siguiente","local_simulador").'></td></tr>

		
</form>
</table>';


	
// Show the page footer
echo $OUTPUT->footer();
?>