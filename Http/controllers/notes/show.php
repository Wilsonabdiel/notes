<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 5;

$note = $db->query('select * from notebook where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);