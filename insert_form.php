<?php

//Insertar en la base de datos
function curso(){
	global $DB, $USER;
	
	//variables recibidas de index.php 
	
	//TABLA CURSOS
	$nombre = $_POST["curso"];
	$duracion;
	$grado;
	$pdeseado = $_POST["pdeseado"];
	
	
	
	if ($_POST["duracion"] == "semestral")
	{
		$duracion=0;
	}
	elseif ($_POST["duracion"] == "anual")
	{
		$duracion=1;
	}
	
	if ($_POST["grado"] == "grado1")
	{
		$grado=1;
	}
	elseif ($_POST["grado"] == "grado2")
	{
		$grado=2;
	}
	//SEGUIR AGREGANDO

	echo $nombre;
	echo $duracion;
	echo $grado;
	echo $pdeseado;
	
$recordcursos = new stdClass();
$recordcursos->nombre         = $nombre;
$recordcursos->duracion         = $duracion;
$recordcursos->dificultad         = $grado;
$recordcursos->pdeseado         = $pdeseado;


$DB->insert_record('cursos', $recordcursos);

//TABLA EVALUACIONES

$evaluacion = $_POST["evaluacion"];
$ponderacion = $_POST["ponderacion"];


$recordevaluacion = new stdClass();
$recordcursos->nombre         = $evaluacion;
$recordcursos->ponderacion         = $ponderacion;

$DB->insert_record('evaluaciones', $recordevaluacion);

}

curso();
