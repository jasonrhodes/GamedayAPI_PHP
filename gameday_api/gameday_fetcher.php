<?php

	require_once( 'gameday_url_builder.php' );

	class GamedayFetcher {
	  
	  public static function gd_fetch( $url ) {
	    
	    //echo "THE URL IS " . $url . "--- <br><br> ";
	    /**
			* Initialize the cURL session
			*/
			$ch = curl_init();
			/**
			* Set the URL of the page or file to download.
			*/			
			curl_setopt($ch, CURLOPT_URL, $url);
			/**
			* Ask cURL to return the contents in a variable
			* instead of simply echoing them to the browser.
			*/
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			/**
			* Execute the cURL session
			*/
			$contents = curl_exec ($ch);
			/**
			* Close cURL session
			*/
			curl_close ($ch);
			
			return $contents;
	    
	  }
	  
	  
	  public static function fetch_epg( $year, $month, $day ) {
	    $url = GamedayUrlBuilder::build_epg_url( $year, $month, $day );
	    return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetch the master scoreboard file
	  # Sample URL:  http://gd2.mlb.com/components/game/mlb/year_2008/month_04/day_07/master_scoreboard.xml
	  public static function fetch_scoreboard( $year, $month, $day ) {
	    $url = GamedayUrlBuilder::build_scoreboard_url( $year, $month, $day );
	    return self::gd_fetch( $url );
	  }
	  
	  
	  public static function fetch_day_highlights( $year, $month, $day ) {
	    $url = GamedayUrlBuilder::build_day_highlights_url( $year, $month, $day );
	    return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetch the bench.xml file
	  # Sample URL:  http://gd2.mlb.com/components/game/mlb/year_2008/month_04/day_07/gid_2008_04_07_atlmlb_colmlb_1/bench.xml
	  public static function fetch_bench( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/bench.xml';
	    return self::gd_fetch( $url );   
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetch the benchO.xml file
	  # Sample URL:  http://gd2.mlb.com/components/game/mlb/year_2008/month_04/day_07/gid_2008_04_07_atlmlb_colmlb_1/benchO.xml
	  public static function fetch_bencho( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/benchO.xml';
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetches the boxscore.xml file and returns its contents
	  # Sample URL: http://gd2.mlb.com/components/game/mlb/year_2009/month_05/day_08/gid_2009_05_08_detmlb_clemlb_1/boxscore.xml
	  public static function fetch_boxscore( $gid ) {
	    $gameday_info = GamedayUtil::parse_gameday_id( 'gid_' . $gid );
	    $url = GamedayUrlBuilder::build_boxscore_url( $gameday_info->year , $gameday_info->month, $gameday_info->day , $gid );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetch the emailSource.xml file
	  # Sample URL:  http://gd2.mlb.com/components/game/mlb/year_2008/month_04/day_07/gid_2008_04_07_atlmlb_colmlb_1/emailSource.xml
	  public static function fetch_emailsource( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/emailSource.xml';
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url ); 
	  }
	  
	  
	  # Fetches the eventLog.xml file and returns its contents
	  # Sample URL: http://gd2.mlb.com/components/game/mlb/year_2008/month_04/day_07/gid_2008_04_07_flomlb_wasmlb_1/eventLog.xml
	  public static function fetch_eventlog( $gid ) {
	    $gameday_info = GamedayUtil::parse_gameday_id('gid_' . $gid );
	    $url = GamedayUrlBuilder::build_eventlog_url( $gameday_info->year , $gameday_info->month, $gameday_info->day , $gid );
	    return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetches the game.xml file and returns its contents
	  public static function fetch_game_xml( $gid ) {
	    $gameday_info = GamedayUtil::parse_gameday_id( 'gid_' . $gid );
	    $url = GamedayUrlBuilder::build_game_url( $gameday_info->year , $gameday_info->month, $gameday_info->day , $gid );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  public static function fetch_game_events( $gid ) {
	    $gameday_info = GamedayUtil::parse_gameday_id('gid_' . $gid );
	    $url = GamedayUrlBuilder::build_game_events_url( $gameday_info->year , $gameday_info->month, $gameday_info->day , $gid );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetches the gamecenter.xml file and returns its contents
	  public static function fetch_gamecenter_xml( $gid ) {
	    $gameday_info = GamedayUtil::parse_gameday_id('gid_' . $gid );
	    $url = GamedayUrlBuilder::build_gamecenter_url( $gameday_info->year , $gameday_info->month, $gameday_info->day , $gid );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetch the gameday_Syn.xml file
	  # Sample URL:  http://gd2.mlb.com/components/game/mlb/year_2008/month_04/day_07/gid_2008_04_07_atlmlb_colmlb_1/gameday_Syn.xml
	  public static function fetch_gamedaysyn( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/gameday_Syn.xml';
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );    
	  }
	  
	  
	  # Fetch the linescore.xml file
	  # Sample URL:  http://gd2.mlb.com/components/game/mlb/year_2008/month_04/day_07/gid_2008_04_07_atlmlb_colmlb_1/linescore.xml
	  public static function fetch_linescore( $gid ) {
	    $gameday_info = GamedayUtil::parse_gameday_id('gid_' . $gid );
	    $url = GamedayUrlBuilder::build_linescore_url( $gameday_info->year , $gameday_info->month, $gameday_info->day , $gid );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetch the miniscoreboard.xml file
	  # Sample URL:  http://gd2.mlb.com/components/game/mlb/year_2008/month_04/day_07/gid_2008_04_07_atlmlb_colmlb_1/miniscoreboard.xml
	  public static function fetch_miniscoreboard( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/miniscoreboard.xml';
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );   
	  }
	  
	  
	  # Fetches the players.xml file and returns its contents
	  public static function fetch_players( $gid ) {
	    $gameday_info = GamedayUtil::parse_gameday_id('gid_' . $gid );
	    $url = GamedayUrlBuilder::build_players_url( $gameday_info->year , $gameday_info->month, $gameday_info->day, $gid );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetch the plays.xml file
	  # Sample URL:  http://gd2.mlb.com/components/game/mlb/year_2008/month_04/day_07/gid_2008_04_07_atlmlb_colmlb_1/plays.xml
	  public static function fetch_plays( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/plays.xml';
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetches the batters/(pid).xml file
	  public static function fetch_batter( $gid, $pid ) {
	    $gameday_info = GamedayUtil::parse_gameday_id('gid_' . $gid );
	    $url = GamedayUrlBuilder::build_batter_url( $gameday_info->year , $gameday_info->month, $gameday_info->day , $gid, $pid );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetches the pitchers/(pid).xml file
	  public static function fetch_pitcher( $gid, $pid ) {
	    $gameday_info = GamedayUtil::parse_gameday_id('gid_' . $gid );
	    $url = GamedayUrlBuilder::build_pitcher_url( $gameday_info->year , $gameday_info->month, $gameday_info->day , $gid, $pid );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  #     inning/inning_X.xml 
	  public static function fetch_inningx( $gid, $inning_num ) {
	    $gameday_info = GamedayUtil::parse_gameday_id('gid_' . $gid );
	    $url = GamedayUrlBuilder::build_inningx_url( $gameday_info->year , $gameday_info->month, $gameday_info->day , $gid, $inning_num );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	
	
	#     inning/inning_Score.xml
	  public static function fetch_inning_scores( $gid ) { 
	    $gameday_info = GamedayUtil::parse_gameday_id('gid_' . $gid );
	    $url = GamedayUrlBuilder::build_inning_scores_url( $gameday_info->year , $gameday_info->month, $gameday_info->day , $gid );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	
	#     inning/inning_hit.xml
	  public static function fetch_inning_hit( $gid ) {
	    $gameday_info = GamedayUtil::parse_gameday_id('gid_' . $gid );
	    $url = GamedayUrlBuilder::build_inning_hit_url( $gameday_info->year , $gameday_info->month, $gameday_info->day , $gid );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetches the HTML page that lists all games for the specified date
	  public static function fetch_games_page( $year, $month, $day ) {
	    $url = GamedayUrlBuilder::build_day_url( $year, $month, $day );
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetches the HTML page that lists all games for the specified date
	  public static function fetch_batters_page( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/batters/';
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  # Fetches the HTML page that lists all games for the specified date
	  public static function fetch_pitchers_page( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/pitchers/';
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	
	  
	  public static function fetch_media_highlights( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/media/highlights.xml';
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  public static function fetch_media_mobile( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/media/mobile.xml';
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  public static function fetch_onbase_linescore( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/onbase/linescore.xml';
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  public static function fetch_onbase_plays( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . '/onbase/plays.xml';
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  public static function fetch_notifications_inning( $gid, $inning ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) . "/notifications/notifications_#" . $inning . ".xml";
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	  
	  
	  public static function fetch_notifications_full( $gid ) {
	    $url = GamedayUrlBuilder::build_game_base_url( $gid ) + "/notifications/notifications_full.xml";
	    return self::gd_fetch( $url );
	    #fetcher = CacheFetcher.new();
	    #return fetcher.return self::gd_fetch( $url );
	  }
	
	  
	}