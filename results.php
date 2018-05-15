<?php

require_once 'Controllers/InsertionController.php';

$users = Insertion::getGithubUsers('https://api.github.com/users');
$users->insertRows($users->result);