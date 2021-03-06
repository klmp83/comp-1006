<form action="controller.php" method="post">
  
  <fieldset>
    <legend>Book Information</legend>

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" maxlength="100" required value="<?= isset( $book ) ? $book->name : '' ?>">
    </div>

    <div class="form-group">
      <label for="author_name">Author Name</label>
      <input class="form-control" type="text" name="author_name" maxlength="100" required value="<?= isset( $book ) ? $book->author_name : '' ?>">
    </div>

    <div class="form-group">
      <label for="price">Price</label>
      <input class="form-control" type="number" name="price" min="0.01" step="any" required value="<?= isset( $book ) ? $book->price : '' ?>">
    </div>

    <div class="form-group">
      <label for="pub_date">Publish Date</label>
      <input class="form-control" type="date" name="pub_date" maxlength="100" required value="<?= isset( $book ) ? $book->pub_date : '' ?>">
    </div>

    <div class="form-group">
      <label for="genre_id">Genre</label>
      <select class="form-control" name="genre_id" required>
        <option value="">...select a genre...</option>
        <?php foreach ( $genres as $genre ): ?>
          <option value="<?= $genre->id ?>" <?= isset( $book ) && $book->genre->id == $genre->id ? 'selected' : '' ?>><?= $genre->name ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="form-group">
      <input type="hidden" name="action" value="<?= isset( $action ) ? $action : 'add' ?>">

      <?php if ( isset( $action ) && $action == 'update' ): ?>
        <input type="hidden" name="id" value="<?= $book->id ?>">
        <button type="submit" class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Update Book</button>
      <?php else: ?>
        <button type="submit" class="btn btn-danger"><i class="fa fa-plus">&nbsp;</i>Add Book</button>
      <?php endif ?>
    </div>
  </fieldset>

</form>