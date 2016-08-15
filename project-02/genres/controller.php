<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once __DIR__ . '/../config.php';

  /* VIEWS */
  // index
  function index () {
    $genres = Genre::all( array( 'order' => 'name' ) );
    return get_included_file_contents( 'views/index.php', ['genres' => $genres] );
  }


  // show
  function show ( $get ) {
    // redirect user if here accidentally
    if ( !isset( $get['id'] ) || !Genre::exists( $get['id'] ) ) {
      $_SESSION['fail'] = "You must select a genre.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    $genre = Genre::find( $get['id'] );
    return get_included_file_contents( 'views/show.php', ['genre' => $genre] );
  }


  // create
  function create () {
    return get_included_file_contents( 'views/create.php' );
  }


  // edit
  function edit ( $get ) {
   if ( !isset( $get['id'] ) || !Genre::exists( $get['id'] ) ) {
      $_SESSION['fail'] = "You must select a genre.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    $genre = Genre::find( 'first', $get['id'] );
    return get_included_file_contents( 'views/edit.php', ['genre' => $genre] );
  }


  /* PROCESSES */
  // add
  function add ( $post ) {
    // create a new record
    $genre = new Genre;

    // assign the values
    $genre->name = $post['name'];

    // when we save, we apply our assigned properties and write them to the database
    $genre->save();

    // redirect if there is an error
    if ( $genre->is_invalid() ) {
      // set the fail messages
      $_SESSION['fail'][] = $genre->errors->full_messages();
      $_SESSION['fail'][] = 'The genre could not be created.';

      // redirect
      header( 'Location: index.php?action=create' );
      exit;
    }

    // set the success message
    $_SESSION['success'] = 'Genre was created successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  // update
  function update ( $post ) {
    // redirect user if here accidentally
    if ( !isset( $post['id'] ) || !Genre::exists( $post['id'] ) ) {
      $_SESSION['fail'] = "You must select a genre.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    // get existing record
    $genre = Genre::find( $post['id'] );

    // assign the values
    $genre->name = $post['name'];

    // when we save, we apply our assigned properties and write them to the database
    $genre->save();

    // redirect if there is an error
    if ( $genre->is_invalid() ) {
      // set the fail messages
      $_SESSION['fail'][] = $genre->errors->full_messages();
      $_SESSION['fail'][] = 'The genre could not be updated.';

      // redirect
      header( 'Location: index.php?action=edit&id=' . $genre->id );
      exit;
    }

    // set the success message
    $_SESSION['success'] = 'Genre was updated successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  // delete
  function delete ( $post ) {
    // redirect user if here accidentally
    if ( !isset( $post['id'] ) || !Genre::exists( $post['id'] ) ) {
      $_SESSION['fail'] = "You must select a genre.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    // delete the record
    $genre = Genre::find( $post['id'] );
    $genre->delete();

    $_SESSION['success'] = 'The genre was deleted successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  /* Authentication Block */
  request_is_authenticated($_REQUEST, ['index', 'show']); // allowed functions

  // action handler for REQUEST
  $yield = action_handler( ['add', 'update', 'delete', 'index', 'show', 'create', 'edit'], $_REQUEST );