<form action="/update/data/mahasiswa" enctype="multipart/form-data" method="post">
    <div style="width: 40%" class="box m-auto mt-5">

        <?php if(isset($model['error'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $model['error'] ?? '' ?>
            </div>
        <?php endif; ?>
        <input type="hidden" name="id" value="<?= $model['user']['id'] ?? '' ?>">
        <input type="hidden" name="gambarLama" value="<?= $model['user']['img'] ?? '' ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" value="<?= $model['user']['name'] ?? '' ?>" name="nama">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $model['user']['title'] ?? '' ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= $model['user']['description'] ?? '' ?></textarea>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input class="form-control" name="gambar" type="file" id="gambar">
        </div>
        <button class="btn btn-primary" type="submit">TAMBAH</button>
    </div>
</form>