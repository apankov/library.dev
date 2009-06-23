<?php

echo html('books/_form.html.php', null, array('book' => $book, 'method' => 'PUT', 'action' => '/books/' . $book->id));

?>