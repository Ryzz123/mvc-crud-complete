<?php

namespace FebriAnandaLubis\CrudMvcTailwind\Controller;

use FebriAnandaLubis\CrudMvcTailwind\App\View;
use FebriAnandaLubis\CrudMvcTailwind\Config\Database;
use FebriAnandaLubis\CrudMvcTailwind\Exception\ValidationException;
use FebriAnandaLubis\CrudMvcTailwind\Model\DeleteDataRequest;
use FebriAnandaLubis\CrudMvcTailwind\Model\TambahDataRequest;
use FebriAnandaLubis\CrudMvcTailwind\Model\UpdateDataRequest;
use FebriAnandaLubis\CrudMvcTailwind\Repository\MahasiswaRepository;
use FebriAnandaLubis\CrudMvcTailwind\Service\MahasiswaService;

class MahasiswaController
{
    private MahasiswaService $mahasiswaService;
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->mahasiswaRepository = new MahasiswaRepository($connection);
        $this->mahasiswaService = new MahasiswaService($this->mahasiswaRepository);
    }

    public function add() {
        View::render("User/Tambah",[
            "title" => "Tambah Data"
        ]);
    }

    public function addPost() {
        require __DIR__ . './../Service/upload.php';

        $request = new TambahDataRequest();
        $request->name = $_POST['nama'];
        $request->title = $_POST['title'];
        $request->description = $_POST['description'];
        $request->img = upload();

        try {
            $this->mahasiswaService->add($request);
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::render("User/Tambah", [
                'title' => "Tambah Data",
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function update() {
        $id = $_GET['id'];
        $user = $this->mahasiswaRepository->mahasiswaByid($id);
        View::render("User/Update",[
            "title" => "Update User",
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "title" => $user->title,
                "description" => $user->description,
                "img" => $user->img
            ]
        ]);
    }

    public function updatePost() {
        require __DIR__ . './../Service/upload.php';

        $request = new UpdateDataRequest();
        $request->id = $_POST['id'];
        $request->name = $_POST['nama'];
        $request->title = $_POST['title'];
        $request->description = $_POST['description'];

        $gambarLama = $_POST['gambarLama'];

        if ($_FILES['gambar']['error'] == 4) {
            $gambar = $gambarLama;
        } else {
            $gambar = upload();
        }

        $request->img = $gambar;

        try {
            $this->mahasiswaService->update($request);
            View::redirect('/');
        }catch (ValidationException $exception) {
            View::render('User/Update',[
                'title' => 'Update User',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function delete() {
        $id = $_GET['id'];
        $request = new DeleteDataRequest();
        $request->id = $id;
        $this->mahasiswaService->delete($request);
        View::redirect('/');
    }
}