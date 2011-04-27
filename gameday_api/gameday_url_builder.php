<?php
	
	require_once( 'gameday_util.php' );
	
	class GamedayUrlBuilder {
	  
	  public static $mlb_base_url = "http://gd2.mlb.com/components/game";
	  public static $year;
	  public static $day;
	  public static $month;
	  
	  public static function build_game_base_url( $gameday_id ) {
	  	$info = GamedayUtil::parse_gameday_id( 'gid_' . $gameday_id );
	  	$url = self::$mlb_base_url . "/mlb/year_" . $info->year . "/month_" . $info->month . "/day_" . $info->day . "/gid_" . $gameday_id; 

			return $url;
	  }
	  
	  
	  public static function build_eventlog_url( $year, $month, $day, $gid ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_" . $gid . "/eventLog.xml"; 

			return $url;
	  }
	  
	  
	  public static function build_epg_url( $year, $month, $day ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/epg.xml"; 

			return $url;
	  }
	  
	  
	  public static function build_scoreboard_url( $year, $month, $day ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/master_scoreboard.xml"; 

			return $url;
	  }
	  
	  
	  public static function build_day_highlights_url( $year, $month, $day ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/media/highlights.xml"; 

			return $url;
	  }
	  
	  
	  public static function build_boxscore_url( $year, $month, $day, $gid ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_". $gid ."/boxscore.xml"; 

			return $url; 
	  }
	  
	  
	  public static function build_game_url( $year, $month, $day, $gid ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_". $gid ."/game.xml"; 

			return $url; 
	  }
	  
	  
	  public static function build_game_events_url( $year, $month, $day, $gid ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_". $gid ."/game_events.xml"; 

			return $url; 
	  }
	  
	  
	  public static function build_gamecenter_url( $year, $month, $day, $gid ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_". $gid ."/gamecenter.xml"; 

			return $url; 
	  }
	
	
	  public static function build_linescore_url( $year, $month, $day, $gid ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_". $gid ."/linescore.xml"; 

			return $url; 
	  }
	  
	
	  public static function build_players_url( $year, $month, $day, $gid ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_". $gid ."/players.xml"; 

			return $url; 
	  }
	  
	  
	  public static function build_batter_url( $year, $month, $day, $gid, $pid ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_". $gid ."/batters/" .  $pid . '.xml'; 

			return $url;
	  }
	  
	  
	  public static function build_pitcher_url( $year, $month, $day, $gid, $pid ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_". $gid ."/pitchers/" . $pid . '.xml'; 

			return $url;
	  }
	  
	  
	  public static function build_inningx_url( $year, $month, $day, $gid, $inning_num ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_". $gid ."/inning/inning_" . $inning_num . ".xml"; 
			echo "Built URL: {$url} <br><br>";
			return $url;
	  }
	  
	  
	  public static function build_inning_scores_url( $year, $month, $day, $gid ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_". $gid ."/inning/inning_Scores.xml"; 

			return $url;
	  }
	  
	  
	  public static function build_inning_hit_url( $year, $month, $day, $gid ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_" . self::$year . "/month_" . self::$month . "/day_" . self::$day . "/gid_". $gid ."/inning/inning_hit.xml"; 

			return $url;
	  }
	  
	
	  public static function build_day_url( $year, $month, $day ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_#" . self::$year . "/month_#" . self::$month . "/day_#" . self::$day . "/"; 

			return $url;
	  }

	  
	  public static function build_month_url( $year, $month ) {
	    self::set_date_vars( $year, $month, $day );
	    $url = self::$mlb_base_url . "/mlb/year_#" . self::$year . "/month_#" . self::$month . "/"; 

			return $url;
	  }
	  
	  
	  public static function set_date_vars( $year, $month, $day ) {
	    self::$year = GamedayUtil::convert_digit_to_string( (int)$year );
	    self::$month = GamedayUtil::convert_digit_to_string( (int)$month );
	    if ( !!$day && !empty( $day ) ) {
	      self::$day = GamedayUtil::convert_digit_to_string( (int)$day );
	    }
	  }
	  
	  
	}