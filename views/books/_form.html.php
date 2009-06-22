<form method="post" >
  <input type="hidden" name="book[id]" id="book_id" value="<?php echo $book->id ?>" />

  <div>
    <p>Book Title:</p>
    <p><input type="text" name="book[title]" id="book_title" value="<?php echo h($book->title) ?>" /></p>
  </div>

  <div>
    <p>Author:</p>
    <p>
      <select name="book[author_id]" id="book_author_id">
        <option id="0"></option>
<?php foreach($authors as $author) { ?>
        <?php echo option_tag($author->id, $author->name, $book->author_id), "\n" ?>
<?php } ?>
      </select>
  </div>

  <div>
    <p>Year:</p>
    <p><input type="text" name="book[year]" id="book_year" value="<?php echo intval($book->year) ?>" /></p>
  </div>

  <div>
    <p>
      <?php echo link_to('Cancel', '/books'), "\n" ?>
      <input type="submit" value="Save" />
    </p>
  </div>

</form>
