<?php
// Minimum for Moodle to work, the basic libraries
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/config.php');
global $DB, $USER;

// variables recibidas de index.php

// TABLA CURSOS
$nombre = required_param ( 'curso', PARAM_ALPHA );
$pdeseado = required_param ( 'pdeseado', PARAM_NUMBER );
$duracion = required_param ( 'duracion', PARAM_ALPHA );
$duracion = $duracion === 'anual' ? 1 : 0;
$grado = required_param ( 'grado', PARAM_INT );

// VER SI VARIABLES SON NULL
echo $nombre;
echo $duracion;
echo $grado;
echo $pdeseado;

// Insertar en la tabla cursos de la base de datos

$recordcursos = new stdClass ();
$recordcursos->nombre = $nombre;
$recordcursos->duracion = $duracion;
$recordcursos->dificultad = $grado;
$recordcursos->pdeseado = $pdeseado;

$idcurso = $DB->insert_record ( 'cursos', $recordcursos );

// TABLA EVALUACIONES

$evaluacion = $_POST ["evaluacion"];
$ponderacion = $_POST ["ponderacion"];
$evaluacion2 = $_POST ["evaluacion2"];
$ponderacion2 = $_POST ["ponderacion2"];


//evaluacion 1
$recordevaluacion1 = new stdClass ();

$recordevaluacion1->nombre = $evaluacion;
$recordevaluacion1->ponderacion = $ponderacion;
$recordevaluacion1->cursoid = $idcurso;

//evaluacion 2
$recordevaluacion2 = new stdClass ();

$recordevaluacion2->nombre = $evaluacion2;
$recordevaluacion2->ponderacion = $ponderacion2;
$recordevaluacion2->cursoid = $idcurso;

$recordevaluaciones = array($recordevaluacion1, $recordevaluacion2);


$idevaluaciones = $DB->insert_record ( 'evaluaciones', $recordevaluaciones );
