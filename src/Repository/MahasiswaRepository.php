<?php

namespace FebriAnandaLubis\CrudMvcTailwind\Repository;
use FebriAnandaLubis\CrudMvcTailwind\User\User;

class MahasiswaRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function selectAll()
    {
        $statement = $this->connection->query("SELECT * FROM mahasiswa");
        return $statement;
    }

    public function selectByname(string $name) {
        $statement = $this->connection->prepare("SELECT * FROM mahasiswa WHERE name = ?");
        $statement->execute([$name]);
        $data = $statement->fetch();
        return $data;
    }

    public function addMahasiswa(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO mahasiswa(name, title, description, img) VALUES (?,?,?,?)");
        $statement->execute([
            $user->name,
            $user->title,
            $user->description,
            $user->img,
        ]);
        return $user;
    }

    public function mahasiswaByid(string $id): ?User {
        $statement = $this->connection->prepare("SELECT * FROM mahasiswa WHERE id = ?");
        $statement->execute([
            $id
        ]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->name = $row['name'];
                $user->title = $row['title'];
                $user->description = $row['description'];
                $user->img = $row['img'];

                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function updateByid(User $user): ?User {
        $statement = $this->connection->prepare("UPDATE mahasiswa SET id = ?, name = ?, title = ?, description = ?, img = ? WHERE id = ?");
        $statement->execute([
            $user->id,
            $user->name,
            $user->title,
            $user->description,
            $user->img,
            $user->id,
        ]);
        return $user;
    }

    public function deleteMahasiswa(User $user) {
        $statement = $this->connection->prepare("DELETE FROM mahasiswa WHERE id = ?");
        $statement->execute([$user->id]);
    }
}