<form method="post" >
  <input type="hidden" name="author[id]" id="author_id" value="<?php echo $author->id ?>" />

  <div>
    <p>Author Name:</p>
    <p><input type="text" name="author[name]" id="author_name" value="<?php echo h($author->name) ?>" /></p>
  </div>

  <div>
    <p>Birthday:</p>
    <p><input type="text" name="author[birthday]" id="author_birthday" value="<?php echo h($author->birthday) ?>" /></p>
  </div>

  <div>
    <p>Bio:</p>
    <p><textarea name="author[bio]" id="author_bio" rows="4" cols="37"><?php echo h($author->bio) ?></textarea></p>
  </div>

  <div>
    <p>
      <?php echo link_to('Cancel', '/authors'), "\n" ?>
      <input type="submit" value="Save" />
    </p>
  </div>

</form>
