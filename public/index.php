<?php
require_once __DIR__ . '/../vendor/autoload.php';

use FebriAnandaLubis\CrudMvcTailwind\App\Router;
use FebriAnandaLubis\CrudMvcTailwind\Controller\HomeController;
use FebriAnandaLubis\CrudMvcTailwind\Controller\MahasiswaController;
use FebriAnandaLubis\CrudMvcTailwind\Config\Database;

Database::getConnection('prod');

// Home Controller
Router::add('GET','/',HomeController::class,'index', []);

// User Controller
Router::add('GET',"/add/data/mahasiswa", MahasiswaController::class, 'add', []);
Router::add('POST',"/add/data/mahasiswa", MahasiswaController::class, 'addPost', []);

// User controller update
Router::add('GET',"/update/data/mahasiswa", MahasiswaController::class, 'update', []);
Router::add('POST',"/update/data/mahasiswa", MahasiswaController::class, 'updatePost', []);

Router::add('GET',"/delete/data/mahasiswa", MahasiswaController::class, 'delete', []);

Router::run();