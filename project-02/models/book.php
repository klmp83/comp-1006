<?php

  class Book extends ActiveRecord\Model {

    // associations/relationships
    static $belongs_to = array( 'genre' );

    /* Sanitizations */
    // setter
    public function set_name ( $name ) {
      $this->assign_attribute( 'name', filter_var( $name, FILTER_SANITIZE_STRING ) );
    }
    
    public function set_authour_name ( $author_name ) {
    	$this->assign_attribute( 'author_name', filter_var( $author_name, FILTER_SANITIZE_STRING ) );
    }

    public function set_price ( $price ) {
      $this->assign_attribute( 'price', filter_var( $price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
    }

    public function set_pub_date ( $pub_date ) {
    	$this->assign_attribute( 'pub_date', filter_var( $pub_date, FILTER_SANITIZE_STRING ) );
    }
    
    
    // getter
    public function get_name () {
      return htmlentities( $this->read_attribute( 'name' ) );
    }
    
    public function get_author_name () {
    	return htmlentities( $this->read_attribute( 'author_name' ) );
    }
    
    public function get_price_formatted () {
      return '$' . number_format( $this->read_attribute( 'price' ), 2, '.', ',' ); // $1,222.56
    }

    public function get_pub_date_formatted () {
    	return $this->read_attribute( 'pub_date' )->format('Y-m-d');
    }

    /* Validations */
    static $validates_presence_of = array(
      array( 'name', 'message' => 'must be present.' ),
      array( 'author_name', 'message' => 'must be present.' ),
      array( 'price', 'message' => 'must be present.' ),
      array( 'pub_date', 'message' => 'must be present.' )
    );

    static $validates_size_of = array(
      array( 'name', 'maximum' => 100, 'too_long' => 'is way too long.' ),
      array( 'author_name', 'maximum' => 100, 'too_long' => 'is way too long.' )
    );

    static $validates_numeralicity_of = array(
      array( 'price', 'greater_than' => 0.01, 'message' => 'must be greater than 1 cent' )
    );

    static $validates_uniqueness_of = array(
      array( array( 'name', 'genre_id' ), 'message' => 'exists for this genre already.' )
    );

    public function validate () {
      // validate the presence of the genre in the database
      if ( Genre::exists( $this->genre_id ) === false ) {
        $this->errors->add( 'genre_id', "doesn't exist." );
      }
    }
  }