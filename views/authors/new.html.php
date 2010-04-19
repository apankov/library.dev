<?php

echo html('authors/_form.html.php', null, array('author' => $author, 'method' => 'POST', 'action' => url_for('authors')));

?>
