<?php echo link_to('Main page', '/') ?>
<hr/>

<ul>
<?php foreach ($authors as $author) { ?>
  <li>
    <?php echo link_to($author->name, '/authors/', $author->id, 'show') ?> (<?php echo $author->birthday ?>)
    <?php echo link_to("Edit", '/authors/', $author->id, 'edit') ?>
  </li>
<?php } ?>
</ul>

<hr/>
<?php echo link_to('New author', '/authors/new')?>
