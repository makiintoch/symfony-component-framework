<?php

// check value is set
$name = $_GET['name'] ?? 'World';

// add header
//header('Content-Type: text/html; charset=utf-8');

// XSS protection
printf('Hello %s', htmlspecialchars($name, ENT_QUOTES, 'UTF-8'));
