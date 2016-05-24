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
	elseif ($_POST["grado"] == "grado3")
	{
		$grado=3;
	}
	elseif ($_POST["grado"] == "grado4")
	{
		$grado=4;
	}
	elseif ($_POST["grado"] == "grado5")
	{
		$grado=5;
	}
	elseif ($_POST["grado"] == "grado6")
	{
		$grado=6;
	}
	elseif ($_POST["grado"] == "grado7")
	{
		$grado=7;
	}
	elseif ($_POST["grado"] == "grado8")
	{
		$grado=8;
	}
	elseif ($_POST["grado"] == "grado9")
	{
		$grado=9;
	}
	elseif ($_POST["grado"] == "grado10")
	{
		$grado=10;
	}
	
	
//VER SI VARIABLES SON NULL
	echo $nombre;
	echo $duracion;
	echo $grado;
	echo $pdeseado;
	
//Insertar en la tabla cursos de la base de datos
	
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
