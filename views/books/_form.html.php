<form method="POST" action="<?php echo $action ?>">
  <input type="hidden" name="_method" id="_method" value="<?php echo $method ?>" />

  <div>
    <p>Book Title:</p>
    <p><input type="text" name="book[title]" id="book_title" value="<?php echo h($book->title) ?>" /></p>
  </div>

  <div>
    <p>Author:</p>
    <p>
      <select name="book[author_id]" id="book_author_id">
        <option id="0"></option>
<?php
    foreach ($authors as $author) {
        echo option_tag($author->id, $author->name, $book->author_id), "\n";
    }
?>
      </select>
  </div>

  <div>
    <p>Publication Year:</p>
    <p><input type="text" name="book[year]" id="book_year" value="<?php echo $book->year ?>" /></p>
  </div>

  <div>
    <p>
      <?php echo link_to('Cancel', 'books'), "\n" ?>
      <input type="submit" value="Save" />
    </p>
  </div>

</form>
