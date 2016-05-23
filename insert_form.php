<?php

//Insertar en la base de datos
function curso(){
	global $DB, $USER;
	
	//variables recibidas de index.php
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
	
$record = new stdClass();
$record->nombre         = $nombre;
$record->duracion         = $duracion;
$record->dificultad         = $grado;
$record->pdeseado         = $pdeseado;
$record->id = $USER->id;



$lastinsertid = $DB->insert_record('cursos', $record);

}

curso();
