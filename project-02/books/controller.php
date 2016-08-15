<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once __DIR__ . '/../config.php';

  /* VIEWS */
  // create
  function create () {
    $genres = Genre::all();
    return get_included_file_contents( 'views/create.php', ['genres' => $genres] );
  }


  // edit
  function edit ( $get ) {
    if ( !isset( $get['id'] ) || !Book::exists( $get['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a book to edit.';
      header( 'Location: ../genres/index.php?action=index' );
      exit;
    }

    $book = Book::find( $get['id'] );
    $genres = Genre::all();
    return get_included_file_contents( 'views/edit.php', ['genres' => $genres, 'book' => $book] );
  }


  /* PROCESSES */
  // add
  function add ( $post ) {
    // create the new book
    $book = New Book;

    // assign the values
    $book->name = $post['name'];
    $book->author_name = $post['author_name'];
    $book->price = $post['price'];
    $book->pub_date = $post['pub_date'];
    $book->genre_id = $post['genre_id'];

    // save the image
    $book->save();

    // redirect with an error if the book is invalid
    if ( $book->is_invalid() ) {
      $_SESSION['fail'][] = $book->errors->full_messages();
      $_SESSION['fail'][] = 'The book could not be created.';

      header( 'Location: index.php?action=create' );
      exit;
    }

    // redirect with a success if book was saved
    $_SESSION['success'] = 'Book was created successfully.';
    header( 'Location: ../genres/index.php?action=show&id=' . $book->genre->id );
    exit;
  }


  // update
  function update ( $post ) {
    // redirect if the id wasn't passed or the book does not exist
    if ( !isset( $post['id'] ) || !Book::exists( $post['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a book to edit.';
      header( 'Location: ../genres/index.php?action=index' );
      exit;
    }

    // find the book
    $book = Book::find( $post['id'] );

    // assign the values to book
    $book->name = $post['name'];
    $book->author_name = $post['author_name'];
    $book->price = $post['price'];
    $book->pub_date = $post['pub_date'];
    $book->genre_id = $post['genre_id'];
    

    // save the book
    $book->save();

    // if there are validation errors, redirect with an error message
    if ( $book->is_invalid() ) {
      $_SESSION['fail'][] = $book->error->full_messages();
      $_SESSION['fail'][] = 'The book could not be updated.';

      header( 'Location: index.php?action=edit&id=' . $book->id );
      exit;
    }

    // redirect with a success message
    $_SESSION['success'] = 'Book was updated successfully.';
    header( 'Location: ../genres/index.php?action=show&id=' . $book->genre->id );
    exit;
  }


  // delete
  function delete ( $post ) {
    if ( !isset( $post['id'] ) || !Book::exists( $post['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a book to edit.';
      header( 'Location: ../genres/index.php?action=index' );
      exit;
    }

    $book = Book::find( $post['id'] );
    $genre = $book->genre;
    $book->delete();

    $_SESSION['success'] = 'The book was deleted successfully.';
    header( 'Location: ../genres/index.php?action=show&id=' . $genre->id );
  }


  /* Authentication Block */
  request_is_authenticated($_REQUEST, ['create', 'add']);

  // action handler for REQUEST
  $yield = action_handler( ['add', 'update', 'delete', 'create', 'edit'], $_REQUEST );