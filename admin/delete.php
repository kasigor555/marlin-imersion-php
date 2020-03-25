<?php
require_once '../init.php';

$id = $_GET['id'];

$db = Database::getInstace()->delete('users', ['id', '=', $id]);

Redirect::to('index.php');
