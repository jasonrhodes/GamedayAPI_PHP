<?php

	require_once( 'gameday_api/init.php' );
	
	$orioles = new Team( "bal" );
	$vars = get_object_vars( $orioles );
	var_dump( $vars );
	
	echo "<br><br>";
	
	$sb = GamedayUtil::get_games_today();
	$sb_xml = new SimpleXMLElement( $sb );
	var_dump( $sb_xml );
	
	
	