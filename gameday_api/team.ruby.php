<?php

require 'gameday_util'
require 'game'
require 'gameday'
require 'schedule'


# This class
class Team {
  
  const START_MONTH = 4;  # April
  const END_MONTH = 10;   # October
  
  public $abrev;
  public $city;
  public $name;
  public $league; 
  public $games;
  
  public static $abbrevs = array();
	$abrevs['ana'] = ['Anaheim','Angels','American'];
	$abrevs['bos'] = ['Boston','Red Sox','American'];
	$abrevs['cha'] = ['Chicago','White Sox','American'];
	$abrevs['chn'] = ['Chicago','Cubs','National'];
	$abrevs['det'] = ['Detroit','Tigers','American'];
	$abrevs['ari'] = ['Arizona','Diamondbacks','National'];
	$abrevs['bal'] = ['Baltimore','Orioles','American'];
	$abrevs['cle'] = ['Cleveland','Indians','American'];
	$abrevs['col'] = ['Colorado','Rockies','National'];
	$abrevs['flo'] = ['Florida','Marlins','National'];
	$abrevs['cin'] = ['Cincinnati','Reds','National'];
	$abrevs['atl'] = ['Atlanta','Braves','National'];
	$abrevs['hou'] = ['Houston','Astros','National'];
	$abrevs['kca'] = ['Kansas City','Royals','American'];
	$abrevs['min'] = ['Minnesota','Twins','American'];
	$abrevs['mil'] = ['Milwaukee','Brewers','National'];
	$abrevs['mon'] = ['Montreal','Expos','National'];
	$abrevs['nya'] = ['New York','Yankees','American'];
	$abrevs['nyn'] = ['New York','Mets','National'];
	$abrevs['oak'] = ['Oakland','As','American'];
	$abrevs['lan'] = ['Los Angeles','Dodgers','National'];
	$abrevs['pit'] = ['Pittsburgh','Pirates','National'];
	$abrevs['phi'] = ['Philadelphi','Phillies','National'];
	$abrevs['usa'] = ['USA','All-Stars'];
	$abrevs['jpn'] = ['Japan','All-Stars'];
	$abrevs['sln'] = ['St. Louis','Cardinals','National'];
	$abrevs['sfn'] = ['SanFrancisco','Giants','National'];
	$abrevs['sea'] = ['Seattle','Mariners','American'];
	$abrevs['sdn'] = ['San Diego','Padres','National'];
	$abrevs['tba'] = ['Tampa Bay','Devil Rays','American'];
	$abrevs['tex'] = ['Texas','Rangers','American'];
	$abrevs['tor'] = ['Toronto','Blue Jays','American'];
	$abrevs['was'] = ['Washington','Nationals','National'];
  
  function __construct($abrev) {
  
  	// Setup team names, abbreviations, and league
  	if ( $abrev && $abrev != '' ) {
  		$this->abrev = $abrev;
  		if ( in_array( $this->abrev, self::$abrevs ) ) {
  			$t = self::$abrevs[$this->abrev];
  			$this->city = $t[0];
  			$this->name = $t[1];
  			if ( $t.length > 2 ) $this->league = $t[2];
  		}
  		else {
  			$this->city = $this->abrev;
  			$this->name = $this->abrev;
  			$this->league = '';
  		}
  	}
  	else {
  		$this->city = $this->name = $this->league = '';
  	}
  	
  }
  
  /* Returns a 2 element array specifying the two associated 
  *	 with the game id (gid) passed in.
  *  @return teams[0] = visitor team object
  *	 @return teams[1] = home team object
  */
  public static function get_teams_for_gid( $gid ) {
  	$teams = array();
  	$info = GamedayUtil::parse_gameday_id( 'gid_' . $gid );
  	$teams[] = new self( $info['away_team_abbrev'] );
  	$teams[] = new self( $info['home_team_abbrev'] );
		return $teams;
  }

  // Returns an array of all games for this team for the specified season
  public static function all_games( $year, $loc = "all" ) {
  	if ( !$this->games || empty( $this->games ) {
  		$results = array();
  		for ( $month = START_MONTH; $month <= END_MONTH; $month++ ) {
  			// From GamedayUtil class, static method
  			$month_s = GamedayUtil::convert_digit_to_string( $month );
  			for ( $date = 1; $date <= 31; $date++ ) {
  				if ( !GamedayUtil::is_date_valid( $month, $date ) ) continue;
  			}
  			$date_s = GamedayUtil::convert_digit_to_string( $date );
  			$games = games_for_date( $year, $month_s, $date_s );
  			if ( !!$games ) {
  				// Make sure postponed games are not included
  				foreach( $games as $g ) {
  					// Calls get_boxscore() from the game object, which
  					// returns a boxscore object with a status_ind property
  					if ( $g->get_boxscore()->status_ind != 'P' ) $results[] = $g;
  				}
  			} // ends if !!$games 
  		} // ends for loop
  		
  		$this->games = $results;
  	}
  	
  	return $this->games;
  }
  
  
  # Returns an array of all home games for this team for the specified season
  def all_home_games(year)
    games = all_games(year)
    results = games.select {|g| g.home_team_abbrev == @abrev }
  end
  
  
  # Returns an array of all away games for this team for the specified season
  def all_away_games(year)
    games = all_games(year)
    results = games.select {|g| g.visit_team_abbrev == @abrev }
  end
  
  
  # Returns an array of the team's game objects for the date passed in.
  def games_for_date(year, month, day)
    games_page = GamedayFetcher.fetch_games_page(year, month, day)
    gids = find_gid_for_date(year, month, day, games_page)
    if gids
      results = gids.collect {|gid| Game.new(gid) }
    else 
      results = nil
    end
    results
  end
  
  
  # Returns an array of BattingAppearance containing the leadoff hitters for each game of the specified season.
  def get_leadoff_hitters_by_year(year)
    results = []
    games = all_games(year)
    games.each do |game|
      boxscore = game.get_boxscore
      leadoffs = boxscore.get_leadoff_hitters
      if game.home_team_abbrev == @abrev
        results << leadoffs[1]
      else
        results << leadoffs[0]
      end
    end
    results
  end
  
  
  # Returns an array of BattingAppearance of all hitters who have led off at least one game during the specified season 
  def get_leadoff_hitters_unique(year)
    hitters = get_leadoff_hitters_by_year(year)
    h = {}
    hitters.each {|hitter| h[hitter.batter_name]=hitter}
    h.values
  end
  
  
  # Returns an array containing the cleanup hitters for each game of the specified season.
  # The cleanup hitter is the 4th hitter in the batting order
  def get_cleanup_hitters_by_year(year)
    results = []
    games = all_games(year)
    games.each do |game|
      boxscore = game.get_boxscore
      hitters = boxscore.get_cleanup_hitters
      if game.home_team_abbrev == @abrev
        results << hitters[1]
      else
        results << hitters[0]
      end
    end
    results
  end
  
  
  # Returns an array of all hitters who have hit in the cleanup spot (4) at least one game during the specified season 
  def get_cleanup_hitters_unique(year)
    hitters = get_cleanup_hitters_by_year(year)
    h = {}
    hitters.each {|hitter| h[hitter.batter_name]=hitter}
    h.values
  end
  
  
  def get_start_pitcher_appearances_by_year(year)
    pitchers = []
    games = all_games(year)
    games.each do |game|
      starters = game.get_starting_pitchers
      if game.home_team_abbrev == @abrev
        pitchers << starters[1]
      else
        pitchers << starters[0]
      end
    end
    pitchers
  end
  
  
  # Returns an array of all pitchers who have started at least one game during the specified season
  def get_starters_unique(year)
    pitchers = get_start_pitcher_appearances_by_year(year)
    h = {}
    pitchers.each {|pitcher| h[pitcher.pitcher_name]=pitcher}
    h.values
  end
  
  
  def get_close_pitcher_appearances_by_year(year)
    pitchers = []
    games = all_games(year)
    games.each do |game|
      closers = game.get_closing_pitchers
      if game.home_team_abbrev == @abrev
        pitchers << closers[1]
      else
        pitchers << closers[0]
      end
    end
    pitchers
  end
  
  
  # Returns an array of all pitchers who have closed at least one game during the specified season
  def get_closers_unique(year)
    pitchers = get_close_pitcher_appearances_by_year(year)
    h = {}
    pitchers.each {|pitcher| h[pitcher.pitcher_name]=pitcher}
    h.values
  end
  
  
  # Returns a count of the number of quality starts for this team for the specified year.
  def quality_starts_count(year)
    count = 0
    games = all_games(year)
    games.each do |game|
      starters = game.get_starting_pitchers
      if game.home_team_abbrev == @abrev
        if starters[1].quality_start?
          count = count + 1
        end
      else
        if starters[0].quality_start?
          count = count + 1
        end
      end
    end
    count
  end
  
  
  # Returns an array of all players who have played at least one game for this team during the specified season.
  def players_for_season(year)
    
  end
  
  
  # Returns an array of all the games for this team for the year and month specified
  def get_games_for_month(year, month)
    
  end
  
  
  # Returns a game object representing the opening day game for this team for
  # the season passed in.
  def get_opening_day_game(year)
    schedule = Schedule.new(year)
    oday = schedule.get_opening_day
    oday_array = GamedayUtil.parse_date_string(oday)
    games = games_for_date(oday_array[0], oday_array[1], oday_array[2])
    if games[0] == nil
      games = games_for_date(oday_array[0], 
                             oday_array[1], 
                             GamedayUtil.convert_digit_to_string(oday_array[2].to_i + 1))
    end
    return games[0]
  end
  
  
  # Returns a Roster object representing the opening day roster for this team
  # for the specified year.
  def opening_day_roster(year)
    game = get_opening_day_game(year)
    rosters = game.get_rosters
    rosters[0].team_name == city + ' ' + name ? rosters[0] : rosters[1]
  end


  private
  
  # Returns an array of the game ids associated with the given date and team
  # because of double-headers it is possible for one team to play more than one game
  # on a single date.
  # Each game listing looks like this:
  #    <li><a href="gid_2009_09_15_kcamlb_detmlb_1/">gid_2009_09_15_kcamlb_detmlb_1/</a></li>
  def find_gid_for_date(year, month, day, games_page)
    begin 
      results = []
      if games_page
        # look for game listings
        @hp = Hpricot(games_page) 
        a = @hp.at('ul')  
        (a/"a").each do |link|
          # game listings include the 'gid' characters
          if link.inner_html.include?('gid') && link.inner_html.include?(@abrev)
            str = link.inner_html
            results << str[5..str.length-2]
          end
        end
        return results
      end
      puts "No games data found for #{year}, #{month}, #{day}, #{@abrev}."
      return nil
    rescue
      puts "Exception in find_gid_for_date: No games data found for #{year}, #{month}, #{day}, #{@abrev}."
    end
  end
  
  
end