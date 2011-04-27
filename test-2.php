<?php

	require_once( 'gameday_api/init.php' );
	
	$orioles = new Team( "bal" );
	
	$vars = get_object_vars( $orioles );
	var_dump( $vars );
	
	