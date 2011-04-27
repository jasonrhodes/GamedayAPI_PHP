<?php

class Team {
  
  private $start_month = 4;  // April
  private $end_month = 10;   // October
  
  public $abbrev;
  public $city;
  public $name;
  public $league; 
  public $games;
  
  public static $abbrevs = array(
	  'ana' => array( 'Anaheim','Angels','American' ),
	  'bos' => array( 'Boston','Red Sox','American' ),
	  'cha' => array( 'Chicago','White Sox','American' ),
	  'chn' => array( 'Chicago','Cubs','National' ),
	  'det' => array( 'Detroit','Tigers','American' ),
	  'ari' => array( 'Arizona','Diamondbacks','National' ),
	  'bal' => array( 'Baltimore','Orioles','American' ),
	  'cle' => array( 'Cleveland','Indians','American' ),
	  'col' => array( 'Colorado','Rockies','National' ),
	  'flo' => array( 'Florida','Marlins','National' ),
	  'cin' => array( 'Cincinnati','Reds','National' ),
	  'atl' => array( 'Atlanta','Braves','National' ),
	  'hou' => array( 'Houston','Astros','National' ),
	  'kca' => array( 'Kansas City','Royals','American' ),
	  'min' => array( 'Minnesota','Twins','American' ),
	  'mil' => array( 'Milwaukee','Brewers','National' ),
	  'mon' => array( 'Montreal','Expos','National' ),
	  'nya' => array( 'New York','Yankees','American' ),
	  'nyn' => array( 'New York','Mets','National' ),
	  'oak' => array( 'Oakland','As','American' ),
	  'lan' => array( 'Los Angeles','Dodgers','National' ),
	  'pit' => array( 'Pittsburgh','Pirates','National' ),
	  'phi' => array( 'Philadelphi','Phillies','National' ),
	  'usa' => array( 'USA','All-Stars' ),
	  'jpn' => array( 'Japan','All-Stars' ),
	  'sln' => array( 'St. Louis','Cardinals','National' ),
	  'sfn' => array( 'SanFrancisco','Giants','National' ),
	  'sea' => array( 'Seattle','Mariners','American' ),
	  'sdn' => array( 'San Diego','Padres','National' ),
	  'tba' => array( 'Tampa Bay','Devil Rays','American' ),
	  'tex' => array( 'Texas','Rangers','American' ),
	  'tor' => array( 'Toronto','Blue Jays','American' ),
	  'was' => array( 'Washington','Nationals','National' )
	 );
  
  function __construct($abbrev) {
  
  	// Setup team names, abbreviations, and league
  	if ( $abbrev && $abbrev != '' ) {
  		$this->abbrev = $abbrev;
  		if ( in_array( $this->abbrev, self::$abbrevs ) ) {
  			$t = self::$abbrevs[$this->abbrev];
  			$this->city = $t[0];
  			$this->name = $t[1];
  			if ( $t.length > 2 ) $this->league = $t[2];
  		}
  		else {
  			$this->city = $this->abbrev;
  			$this->name = $this->abbrev;
  			$this->league = '';
  		}
  	}
  	else {
  		$this->city = $this->name = $this->league = '';
  	}
  	
  }
  
  
  
}