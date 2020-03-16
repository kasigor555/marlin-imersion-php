<?php
require_once 'app/controllers/Session.php';
session_start();



echo Session::flash('success');