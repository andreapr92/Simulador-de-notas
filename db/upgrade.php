<?php
function xmldb_local_simulador_upgrade($oldversion) {
	global $DB;
	$dbman = $DB->get_manager ();
	// / Add a new column newcol to the mdl_myqtype_options
	
	if ($oldversion < 2016051600) {
		
		// Define table cursos to be created.
		$table = new xmldb_table ( 'cursos' );
		
		// Adding fields to table cursos.
		$table->add_field ( 'id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null );
		$table->add_field ( 'nombre', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null );
		$table->add_field ( 'duracion', XMLDB_TYPE_BINARY, null, null, XMLDB_NOTNULL, null, null );
		$table->add_field ( 'dificultad', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '5' );
		$table->add_field ( 'pdeseado', XMLDB_TYPE_NUMBER, '2, 1', null, XMLDB_NOTNULL, null, null );
		
		// Adding keys to table cursos.
		$table->add_key ( 'primary', XMLDB_KEY_PRIMARY, array (
				'id' 
		) );
		
		// Conditionally launch create table for cursos.
		if (! $dbman->table_exists ( $table )) {
			$dbman->create_table ( $table );
		}
		
		// Simulador savepoint reached.
		upgrade_plugin_savepoint ( true, 2016051600, 'local', 'simulador' );
	}
	
	return true;
}