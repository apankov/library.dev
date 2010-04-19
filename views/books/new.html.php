<?php

echo html('books/_form.html.php', null, array('book' => $book, 'method' => 'POST', 'action' => url_for('books')));

?>
