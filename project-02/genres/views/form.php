<form action="controller.php" method="post">
  
  <fieldset>
    <legend>Genre Information</legend>

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" value="<?= isset( $genre ) ? $genre->name : '' ?>" required maxlength="100">
    </div>

    <div class="form-group">
      <input type="hidden" name="action" value="<?= isset( $action ) ? $action : 'add' ?>">

      <?php if ( isset( $action ) && $action == 'update' ): ?>
        <input type="hidden" name="id" value="<?= $genre->id ?>">
        <button type="submit" class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Update Genre</button>
      <?php else: ?>
        <button type="submit" class="btn btn-danger"><i class="fa fa-plus">&nbsp;</i>Add Genre</button>
      <?php endif ?>
    </div>
  </fieldset>

</form>