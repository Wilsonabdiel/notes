<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$notes = $db->query('select * from notebook where user_id = 5')->get();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);