<div>

  <p>ID: <?php echo $author->id ?></p>

  <p>Author Name: <?php echo h($author->name) ?></p>

  <p>Birthday: <?php echo h($author->birthday) ?></p>

  <p>Bio:
    <blockquote>
      <?php echo $author->bio, "\n" ?>
    </blockquote>
  </p>

</div>

<hr/>
<?php echo link_to('Back to authors', 'authors') ?>
