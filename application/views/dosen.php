<div class="content-wrapper">
    <div class="container">
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Data Dosen</li>
            </ol>
        </section>

        <div class="box box-default">
            <div class="box-header with-border">
                <div class="row container-fluid">
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <h3>
                            Kumpulan Data Dosen
                        </h3>    
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3" style="margin-top: 1rem">
                        <div class="col-12 pull-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> Tambah Dosen
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content" style="margin-top: 3rem">
                <div>
                    <table class="table table-bordered table-striped table-responsive bg-gray">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Membimbing</th>
                            <th>Menguji</th>
                            <th colspan="2">Aksi</th>
                        </thead>
                        <tbody>
                        <?php
                    $no=1;
                    foreach ($dosen as $dsn ) :     ?>

                            <tr>
                                <td>
                                    <?php  echo $no++ ?>
                                </td>
                                <td>
                                    <?php  echo $dsn->nama ?>
                                </td>
                                <td>
                                    <?php  echo $dsn->kategori ?>
                                </td>
                                <td>
                                    <?php  echo $dsn->keterangan ?>
                                </td>
                                <td>
                                    <?php  echo $dsn->jumlah_bimbing ?>
                                </td>
                                <td>
                                    <?php  echo $dsn->jumlah_uji ?>
                                </td>
                                <td>
                                    <?php  echo anchor('dosen/editdosen/'.$dsn->id, '<div class = "btn btn-primary btn-sm"><i class= "fa fa-edit"></i></div>')?>
                                </td>
                                <td onclick="javascript: return confirm('Anda yakin hapus?')">
                                    <?php  echo anchor('dosen/hapus/'.$dsn->id, '<div class = "btn btn-danger btn-sm"><i class= "fa fa-trash"></i></div>') ?>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
        </section>
            </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Form Tambah Dosen</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="<?php echo site_url().'/dosen/tambah_aksi'?>">

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                <select class = "form-control" name= "kategori" >
                                <option>RPL</option>
                                <option>KBJ</option>
                                <option>KCV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" class="form-control">
                            </div>

                        

                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>