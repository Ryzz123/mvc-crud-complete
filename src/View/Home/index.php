<a href="/add/data/mahasiswa" class="btn btn-primary mt-5">Tambah</a>
<table class="table mt-3 table-striped border border-primary">
    <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Gambar</th>
        <th scope="col">Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach ($data as $datas) : ?>
        <tr>
            <th scope="row"><?= $i ?></th>
            <td><?= $datas['name'] ?></td>
            <td><?= $datas['title'] ?></td>
            <td><?= $datas['description'] ?></td>
            <td>
                <img width="40" height="40" class="rounded-circle" src="image/<?= $datas['img'] ?>" alt="">
            </td>
            <td>
                <a class="btn btn-primary" href="/delete/data/mahasiswa?id=<?= $datas['id'] ?>">Delete</a>
                <a class="btn btn-primary" href="/update/data/mahasiswa?id=<?= $datas['id'] ?>">Update</a>
            </td>
        </tr>
        <?php $i++ ?>
    <?php endforeach; ?>
    </tbody>
</table>