<?php
use DinoDev\MySql\Classes\MySql;

require_once __DIR__ . '/../vendor/autoload.php';

$MySql = new MySql('localhost', 'root', 'MySql', 'dada', $state);