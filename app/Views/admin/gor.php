<?= $this->extend('admin/main'); ?>
<?= $this->section('content'); ?>


<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Admin</a>
            </li>
            <li class="breadcrumb-item active">GOR</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editGor"><i class="fa fa-edit"></i></a>
                Data <?= $gor['nama_gor'] ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="/upload/gor/<?= $gor['foto_muka'] ?>" target="_blank"><img src="/upload/gor/<?= $gor['foto_muka'] ?>" width="100%" alt=""></a>
                    </div>
                    <div class="col-sm-6">
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <td><?= $gor['nama_gor'] ?></td>
                            </tr>
                            <tr>
                                <th>Profil</th>
                                <td><?= $gor['profil'] ?></td>
                            </tr>
                            <tr>
                                <th>Fasilitas
                                    <center><button data-toggle="modal" data-target="#tambahFasilitas" class="btn btn-sm btn-warning">+</button></center>
                                </th>
                                <td>
                                    <ul class="list-group list-group-flush">
                                        <?php
                                        $no = 1;
                                        foreach ($fasilitas as $r) {
                                        ?>
                                            <li class="list-group-item"><a href="#" data-target="#fas_<?= $r['id_fasilitas'] ?>" data-toggle="modal"><?= $no++ . ". " . $r['nama_fasilitas'] ?></a></li>
                                            <div class="modal fade" id="fas_<?= $r['id_fasilitas'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?= $r['nama_fasilitas'] ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="col-sm-5">
                                                                        <center>
                                                                            <hr>
                                                                            <h6>Gambar Fasilitas</h6>
                                                                            <hr>
                                                                        </center><img class="card-img-top" src="/upload/fasilitas/<?= $r['foto_fasilitas'] ?>" alt="Card image cap">
                                                                    </div>
                                                                    <div class="col-sm-7">
                                                                        <div class="card-body">
                                                                            <form action="/goradm/editFasilitas" method="POST" enctype="multipart/form-data">
                                                                                <input type="hidden" value="<?= $r['id_fasilitas'] ?>" name="id_fasilitas">
                                                                                <div class="form-group">
                                                                                    <label>Nama Fasilitas</label>
                                                                                    <input type="text" class="form-control" name="nama_fasilitas" value="<?= $r['nama_fasilitas'] ?>">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Keterangan</label>
                                                                                    <textarea name="keterangan" class="form-control" cols="30" rows="5"><?= $r['keterangan'] ?></textarea>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Ubah Foto</label>
                                                                                    <input type="file" name="gambar" class="form-control">
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="centang_gambar" id="exampleCheck1">
                                                                                    <label class="form-check-label" for="exampleCheck1">Centang jika ingin mengubah gambar.</label>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="/goradm/hapusFasilitas/<?= $r['id_fasilitas'] ?>" class="btn btn-danger" style="float: right" onclick="return confirm('Anda ingin menghapus fasilitas ini?')"><i class="fa fa-trash"></i> Hapus Fasilitas</a>
                                                            <button type="submit" class="btn btn-warning">Ubah</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <hr>
                        <center>
                            <div class="alert alert-warning">TARIF</div>
                        </center>
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Biaya</th>
                                <th><a href="#tambahTarif" data-toggle="modal" class="btn btn-warning btn-sm">+</a></th>
                            </tr>
                            <?php
                            foreach ($tarif as $r) {
                            ?>
                                <tr>
                                    <td><?= $r['uraian'] ?></td>
                                    <td><?= $r['kategori'] ?></td>
                                    <td>Rp.<?= number_format($r['tarif']) ?>/<?= $r['satuan'] ?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#tarif_<?= $r['id_tarif'] ?>"><i class="fa fa-edit"></i></a>
                                        <a href="/goradm/hapusTarif/<?= $r['id_tarif'] ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" style="color: red"><i class=" fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <!-- Tambah Tarif -->
                                <div class="modal fade" id="tarif_<?= $r['id_tarif'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><?= $r['uraian'] ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <form action="/goradm/editTarif" method="POST">
                                                        <input type="hidden" value="<?= $r['id_tarif'] ?>" name="id_tarif">
                                                        <div class="form-group">
                                                            <label>Kategori</label>
                                                            <select name="kategori" class="form-control" required>
                                                                <option <?php if ($r['kategori'] == "Pertandingan/Perlombaan") echo "SELECTED " ?> value="Pertandingan/Perlombaan">Pertandingan/Perlombaan</option>
                                                                <option <?php if ($r['kategori'] == "Latihan") echo "SELECTED " ?> value="Latihan">Latihan</option>
                                                                <option <?php if ($r['kategori'] == "Kegiatan Lain") echo "SELECTED " ?> value="Kegiatan Lain">Kegiatan Lain</option>
                                                                <option <?php if ($r['kategori'] == "Pertemuan") echo "SELECTED " ?> value="Pertemuan">Pertemuan</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Tarif</label>
                                                            <input type="text" class="form-control" name="nama_tarif" required value="<?= $r['uraian'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <label>Biaya</label>
                                                                    <input type="text" class="form-control" name="biaya" required value="<?= $r['tarif'] ?>">
                                                                </div>
                                                                <div class="col-sm-4"><label>Satuan</label>
                                                                    <select name="satuan" class="form-control" required>
                                                                        <option <?php if ($r['satuan'] == "PER HARI") echo "SELECTED " ?> value="PER HARI">Per hari</option>
                                                                        <option <?php if ($r['satuan'] == "PER BULAN") echo "SELECTED " ?> value="PER BULAN">Per bulan</option>
                                                                        <option <?php if ($r['satuan'] == "PER JAM") echo "SELECTED " ?> value="PER JAM">Per jam</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                <input type="submit" value="Simpan" class="btn btn-warning">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Edit GOR -->
<div class="modal fade" id="editGor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $gor['nama_gor'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="/goradm/editGor" method="POST" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $gor['nama_gor'] ?>" name="nama_gor">
                        <input type="hidden" value="<?= $gor['id_gor'] ?>" name="id_gor">
                        <div class="form-group">
                            <label>Nama GOR</label>
                            <input type="text" class="form-control" name="nama_gor" value="<?= $gor['nama_gor'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Profil</label>
                            <textarea name="profil" class="form-control" cols="30" rows="5" required><?= $gor['profil'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Ubah Foto</label><br>
                            <img src="/upload/gor/<?= $gor['foto_muka'] ?>" alt="" width="100px"><br><br>
                            <input type="file" name="gambar" class="form-control">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="centang_gambar" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Centang jika ingin mengubah gambar.</label>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <input type="submit" value="Simpan" class="btn btn-warning">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Tambah Tarif -->
<div class="modal fade" id="tambahTarif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $gor['nama_gor'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="/goradm/tambahTarif" method="POST">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control" required>
                                <option value="Pertandingan/Perlombaan">Pertandingan/Perlombaan</option>
                                <option value="Pertemuan">Pertemuan</option>
                                <option value="Latihan">Latihan</option>
                                <option value="Kegiatan Lain">Kegiatan Lain</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Tarif</label>
                            <input type="text" class="form-control" name="nama_tarif" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label>Biaya</label>
                                    <input type="text" class="form-control" name="biaya" required>
                                </div>
                                <div class="col-sm-4"><label>Satuan</label>
                                    <select name="satuan" class="form-control" required>
                                        <option value="PER HARI">Per hari</option>
                                        <option value="PER BULAN">Per bulan</option>
                                        <option value="PER JAM">Per jam</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <input type="submit" value="Simpan" class="btn btn-warning">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- IFasilitas -->
<div class="modal fade" id="tambahFasilitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="/goradm/tambahFasilitas" method="POST" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $gor['nama_gor'] ?>" name="nama_gor">
                        <div class="form-group">
                            <label>Nama Fasilitas</label>
                            <input type="text" class="form-control" name="nama_fasilitas" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control" cols="30" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto Fasilitas</label>
                            <input type="file" name="gambar" class="form-control" required>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <input type="submit" value="Simpan" class="btn btn-warning">
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>