<div class="container">
  <h1 class="page-header">Genres</h1>
  <?php if ( is_authenticated() ): ?>
  <p><a href="index.php?action=create"><i class="fa fa-plus">&nbsp;</i>Create Genre</a></p>
  <?php endif ?>

  <?php if ( isset( $genres ) ): ?>
    <table class="table table-striped table-condensed table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Show</th>
          <?php if ( is_admin() ): ?>
            <th>Edit</th>
            <th>Delete</th>
          <?php endif ?>
        </tr>
      </thead>

      <tbody>
        <?php foreach ( $genres as $genre ): ?>
          <tr>
            <td><?= $genre->name ?></td>
            <td><a href="index.php?action=show&id=<?= $genre->id ?>"><i class="fa fa-eye"></i></a></td>
            <?php if ( is_admin() ): ?>
              <td><a href="index.php?action=edit&id=<?= $genre->id ?>"><i class="fa fa-pencil"></i></a></td>
              <td>
                <form action="controller.php" method="post">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $genre->id ?>">
                  <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure you want to permanently delete <?= $genre->name ?>')">
                    <i class="fa fa-remove"></i>
                  </button>
                </form>
              </td>
            <?php endif ?>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
</div>