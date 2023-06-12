<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 5;

// find the corresponding note
$note = $db->query('select * from notebook where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// authorize that the current user can edit the note
authorize($note['user_id'] === $currentUserId);

// validate the form
$errors = [];

if (! Validator::string($_POST['text'], 1, 1000)) {
    $errors['text'] = 'A body of no more than 1,000 characters is required.';
}

// if no validation errors, update the record in the notes database table.
if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('update notebook set text = :text where id = :id', [
    'id' => $_POST['id'],
    'text' => $_POST['text']
]);

// redirect the user
header('location: /notes');
die();