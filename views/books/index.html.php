<?php echo link_to('Main page', '/') ?>
<hr/>

<ul>
<?php foreach ($books as $book) { ?>
  <li>
    <?php echo link_to($book->title, 'books', $book->id) ?> (<?php echo $book->year ?>)
    <?php echo link_to("Edit", 'books', $book->id, 'edit') ?>
    <a href="<?php echo url_for('books', $book->id);?>" onclick="if (confirm('Are you sure?')) { var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href; var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', '_method'); m.setAttribute('value', 'DELETE'); f.appendChild(m); f.submit(); };return false;">Delete</a>
  </li>
<?php } ?>
</ul>

<hr/>
<?php echo link_to('New book', 'books/new') ?>
