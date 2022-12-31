<?php
namespace FebriAnandaLubis\CrudMvcTailwind\Service;

use FebriAnandaLubis\CrudMvcTailwind\Exception\ValidationException;
use FebriAnandaLubis\CrudMvcTailwind\Model\DeleteDataRequest;
use FebriAnandaLubis\CrudMvcTailwind\Model\TambahDataRequest;
use FebriAnandaLubis\CrudMvcTailwind\Model\TambahDataResponse;
use FebriAnandaLubis\CrudMvcTailwind\Model\UpdateDataRequest;
use FebriAnandaLubis\CrudMvcTailwind\Model\UpdateDataResponse;
use FebriAnandaLubis\CrudMvcTailwind\Repository\MahasiswaRepository;
use FebriAnandaLubis\CrudMvcTailwind\User\User;

class MahasiswaService
{
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct(MahasiswaRepository $mahasiswaRepository)
    {
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    public function add(TambahDataRequest $request): TambahDataResponse {
        $this->addValidate($request);

        $user = $this->mahasiswaRepository->selectByname($request->name);

        if ($user != null) {
            throw new ValidationException("Mahasiswa dengan nama $request->name sudah tersedia");
        }

        $user = new User();
        $user->name = $request->name;
        $user->title = $request->title;
        $user->description = $request->description;
        $user->img = $request->img;

        $this->mahasiswaRepository->addMahasiswa($user);

        $response = new TambahDataResponse();

        $response->user = $user;

        return $response;
    }

    private function addValidate(TambahDataRequest $request) {
        if ($request->name == null || $request->title == null || $request->description == null || $request->img == null ||  trim($request->name) == "" || trim($request->title) == "" || trim($request->description) == "") {
            throw new ValidationException("Nama, title, Gambar Tidak boleh kosong");
        }
    }

    public function update(UpdateDataRequest $request): UpdateDataResponse {
        $this->updateValidate($request);

        $user = new User();
        $user->id = $request->id;
        $user->name = $request->name;
        $user->title = $request->title;
        $user->description = $request->description;
        $user->img = $request->img;

        $this->mahasiswaRepository->updateByid($user);

        $response = new UpdateDataResponse();
        $response->user = $user;

        return $response;
    }

    private function updateValidate(UpdateDataRequest $request) {
        if ($request->name == null || $request->title == null || $request->description == null || $request->img == null ||  trim($request->name) == "" || trim($request->title) == "" || trim($request->description) == "") {
            throw new ValidationException("Nama, title, Gambar Tidak boleh kosong");
        }
    }

    public function delete(DeleteDataRequest $request) {
        $user = new User();
        $user->id = $request->id;

        $this->mahasiswaRepository->deleteMahasiswa($user);
    }
}