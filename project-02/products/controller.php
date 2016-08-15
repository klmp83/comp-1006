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
    if ( !isset( $get['id'] ) || !Product::exists( $get['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a product to edit.';
      header( 'Location: ../genres/index.php?action=index' );
      exit;
    }

    $product = Product::find( $get['id'] );
    $genres = Genre::all();
    return get_included_file_contents( 'views/edit.php', ['genres' => $genres, 'product' => $product] );
  }


  /* PROCESSES */
  // add
  function add ( $post ) {
    // create the new product
    $product = New Product;

    // assign the values
    $product->name = $post['name'];
    $product->price = $post['price'];
    $product->genre_id = $post['genre_id'];

    // save the image
    $product->save();

    // redirect with an error if the product is invalid
    if ( $product->is_invalid() ) {
      $_SESSION['fail'][] = $product->errors->full_messages();
      $_SESSION['fail'][] = 'The product could not be created.';

      header( 'Location: index.php?action=create' );
      exit;
    }

    // redirect with a success if product was saved
    $_SESSION['success'] = 'Product was created successfully.';
    header( 'Location: ../genres/index.php?action=show&id=' . $product->genre->id );
    exit;
  }


  // update
  function update ( $post ) {
    // redirect if the id wasn't passed or the product does not exist
    if ( !isset( $post['id'] ) || !Product::exists( $post['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a product to edit.';
      header( 'Location: ../genres/index.php?action=index' );
      exit;
    }

    // find the product
    $product = Product::find( $post['id'] );

    // assign the values to product
    $product->name = $post['name'];
    $product->price = $post['price'];
    $product->genre_id = $post['genre_id'];

    // save the product
    $product->save();

    // if there are validation errors, redirect with an error message
    if ( $product->is_invalid() ) {
      $_SESSION['fail'][] = $product->error->full_messages();
      $_SESSION['fail'][] = 'The product could not be updated.';

      header( 'Location: index.php?action=edit&id=' . $product->id );
      exit;
    }

    // redirect with a success message
    $_SESSION['success'] = 'Product was updated successfully.';
    header( 'Location: ../genres/index.php?action=show&id=' . $product->genre->id );
    exit;
  }


  // delete
  function delete ( $post ) {
    if ( !isset( $post['id'] ) || !Product::exists( $post['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a product to edit.';
      header( 'Location: ../genres/index.php?action=index' );
      exit;
    }

    $product = Product::find( $post['id'] );
    $genre = $product->genre;
    $product->delete();

    $_SESSION['success'] = 'The product was deleted successfully.';
    header( 'Location: ../genres/index.php?action=show&id=' . $genre->id );
  }


  /* Authentication Block */
  request_is_authenticated($_REQUEST, ['create', 'add']);

  // action handler for REQUEST
  $yield = action_handler( ['add', 'update', 'delete', 'create', 'edit'], $_REQUEST );