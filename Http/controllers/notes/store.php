<?php

use Core\App;
use Core\Database;
use Core\Validator;


$db = App::resolve(Database::class);
$errors = [];
    
    if(! Validator::string($_POST['text'], 1, 1000)){
        $errors['text'] = 'A body is required';
    }
    
    if (! empty($errors)) {
        return view("notes/create.view.php", [
            'heading' => 'Create Note',
            'errors' => $errors
        ]);
    }
    
    if (empty($errors)){
        $db->query('INSERT INTO notebook (text, user_id) VALUES (:text, :user_id)',[
        'text' => $_POST['text'],
        'user_id'=>5
    
    ]);
    header('location: /notes');
    die();
    }   
