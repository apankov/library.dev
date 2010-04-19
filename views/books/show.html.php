<div>

  <p>ID: <?php echo $book->id ?></p>

  <p>Book Title: <?php echo h($book->title) ?></p>

  <p>Author: <?php echo h($book->author_name) ?></p>

  <p>Publication Year: <?php echo h($book->year) ?></p>

</div>

<hr/>
<?php echo link_to('Back to books', 'books') ?>
