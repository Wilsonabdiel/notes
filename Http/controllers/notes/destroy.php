<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$currentUserId = 5;

$note = $db->query('select * from notebook where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query('delete from notebook where id = :id', [
    'id' => $_POST['id']
]);

header('location: /notes');
exit();