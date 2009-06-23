<?php

echo html('authors/_form.html.php', null, array('author' => $author, 'method' => 'PUT', 'action' => '/authors/' . $author->id));

?>