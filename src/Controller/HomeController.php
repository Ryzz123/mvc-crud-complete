<?php
namespace FebriAnandaLubis\CrudMvcTailwind\Controller;
use FebriAnandaLubis\CrudMvcTailwind\App\View;
use FebriAnandaLubis\CrudMvcTailwind\Config\Database;
use FebriAnandaLubis\CrudMvcTailwind\Repository\MahasiswaRepository;

class HomeController
{
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->mahasiswaRepository = new MahasiswaRepository($connection);
    }

    public function index() {
        $data = $this->mahasiswaRepository->selectAll();
        View::render('Home/index', [
            "title" => "HOME"
        ], $data);
    }
}