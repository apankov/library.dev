<?php echo link_to('Main page', '/') ?>
<hr/>

<ul>
<?php foreach ($books as $book) { ?>
  <li>
    <?php echo link_to($book->title, '/books/', $book->id, 'show') ?> (<?php echo $book->year ?>)
    <?php echo link_to("Edit", '/books/', $book->id, 'edit') ?>
  </li>
<?php } ?>
</ul>

<hr/>
<?php echo link_to('New book', '/books/new')?>
