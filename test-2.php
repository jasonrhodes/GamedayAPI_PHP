<?php

	require_once( 'gameday_api/game.php' );
	require_once( 'gameday_api/gameday_fetcher.php' );
	
	$gid1 = '2011_04_24_nyamlb_balmlb_1';
	$gid2 = '2011_04_07_oakmlb_tormlb_1';

	$game = new Game( '2011_04_24_nyamlb_balmlb_1' );
	
	//$inningx = GamedayFetcher::fetch_inningx( $gid1, 1 );
	
	$highlights = GamedayFetcher::fetch_day_highlights( 2011, 4, 24 );
	
	var_dump( $highlights );
	
	