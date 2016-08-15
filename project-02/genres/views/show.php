<div class="container">
  <h1 class="page-header"><?= $genre->name ?></h1>
  <?php if ( is_authenticated() ): ?>
  <p><a href="../books/index.php?action=create"><i class="fa fa-plus">&nbsp;</i>Create Book</a></p>
  <?php endif ?>

  <?php if ( $genre->books ): ?>
    <table class="table table-striped table-condensed table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <?php if ( is_authenticated() ): ?>
          <th>Edit</th>
          <th>Delete</th>
          <?php endif ?>
        </tr>
      </thead>

      <tbody>
        <?php foreach ( $genre->books as $book ): ?>
          <tr>
            <td><?= $book->name ?></td>
            <td><?= $book->price_formatted ?></td>
            <?php if ( is_authenticated() ): ?>
            <td><a href="../books/index.php?action=edit&id=<?= $book->id ?>"><i class="fa fa-pencil"></i></a></td>
            <td>
              <form action="../books/controller.php">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= $book->id ?>">
                <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure you want to delete <?= $book->name ?>')"><i class="fa fa-remove"></i></button>
              </form>
            </td>
            <?php endif ?>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
</div>