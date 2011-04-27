<?php
	
	# This class provides a variety of utility methods that are used in other classes
	class GamedayUtil {
	  
	  # Parses a string with the date format of YYYYMMDD into an array
	  # with the following elements:
	  #    [0] = year
	  #    [1] = month
	  #    [2] = day
	  public static function parse_date_string( $date ) {
	  	$results = array();
	  	$results[] = substr( $date, 0, 4 );
	  	$results[] = substr( $date, 4, 2 );
	  	$results[] = substr( $date, 6, 2 );
	  	
	  	return $results;
	  }
	  
	  # Converts a digit into a 2 character string, prepended with '0' if necessary
	  public static function convert_digit_to_string( $digit ) {
	  	return $digit < 10 ? '0' . $digit : (string)$digit;
	  }

	  
	  # Example gameday_gid = gid_2009_06_21_milmlb_detmlb_1
	  public static function parse_gameday_id( $gid ) {
	  	$info = array();
	  	$info['year'] = substr( $gid, 4, 4 );
	  	$info['month'] = substr( $gid, 9, 2 );
	  	$info['day'] = substr( $gid, 12, 2 );
	  	$info['visiting_team_abbrev'] = substr( $gid, 15, 3 );
	  	$info['home_team_abbrev'] = substr( $gid, 22, 3 );
	  	$info['game_number'] = substr( $gid, 29 );
	  	
	  	// Cast associative array as anonymous object, return
	  	return (object)$info;
	  }
	
	  
	  public static function is_date_valid( $month, $day ) {
	  	
	    if (
	    	( $month == 4 && $day > 30 ) ||  
	      ( $month == 6 && $day > 30 ) ||
	      ( $month == 9 && $day > 30 ) ||
	      ( $month == 11 && $day > 30 ) ||
	      ( $month < 4 ) ||
	      ( $month > 11 ) ||
	      ( $day > 31 )
	     ) return false;
	       
	       return true;
	  }
	  
	}