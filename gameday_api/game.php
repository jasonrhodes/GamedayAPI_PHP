<?php

	require_once( 'team.php' );
	require_once( 'gameday_fetcher.php' );
	require_once( 'gameday_util.php' );
	
	class Game {
	
		function __construct( $gid ) {
	    $this->innings = array();
	    $team = new Team('');
	    if ( !!$gid ) {
	      $this->gid = $gid;    
	      $this->xml_data = GamedayFetcher::fetch_game_xml( $gid );
	      
	      //var_dump( $this->xml_data );
	      
	      if ( $this->xml_data && !empty( $this->xml_data ) ) {
	        $this->xml_doc = new SimpleXMLElement( $this->xml_data );
	        $this->game_attr = $this->xml_doc->attributes();
	        $this->game_type = $this->game_attr["type"];
	        $this->game_time = $this->game_attr["local_game_time"];   
	        $info = GamedayUtil::parse_gameday_id( 'gid_' . $gid );
	        $this->home_team_abbrev = $info->home_team_abbrev;
	        $this->visit_team_abbrev = $info->visiting_team_abbrev;
	        $this->visiting_team = new Team( $this->visit_team_abbrev );
	        $this->home_team = new Team( $this->home_team_abbrev );
	        $this->year = $info->year;
	        $this->month = $info->month;
	        $this->day = $info->day;
	        $this->game_number = $info->game_number;
	        if ( isset( Team::$abbrevs[$this->home_team_abbrev] ) ) {
	          $this->home_team_name = Team::$abbrevs[$this->home_team_abbrev][0];
	        }
	        else {
	          $this->home_team_name = $this->home_team_abbrev;
	        }
	        if ( isset( Team::$abbrevs[$this->visit_team_abbrev] ) ) {
	          $this->visit_team_name = Team::$abbrevs[$this->visit_team_abbrev][0];
	        }
	        else {
	          $this->visit_team_name = $this->visit_team_abbrev;
	        }
	      }
	      else {
	        // raise ArgumentError, "Could not find game.xml"
	      }
	    }
	  }
	  
	  
	  
	
	}