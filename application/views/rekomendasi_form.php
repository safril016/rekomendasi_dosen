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
                            Rekomendasi Dosen
                        </h3>    
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3" style="margin-top: 1rem">
                        <div class="col-12 pull-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> Tambah Judul
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
                            <th>Nama </th>
                            <th>Nim</th>
                            <th>Judul Skripsi</th>
                            <th colspan="2">Aksi</th>
                        </thead>
                        <tbody>
                        <?php
                    $no=1;
                    foreach ($skripsi as $skr ) :     ?>

                            <tr>
                                <td>
                                    <?php  echo $no++ ?>
                                </td>
                                <td>
                                    <?php  echo $skr->nama ?>
                                </td>
                                <td>
                                    <?php  echo $skr->nim ?>
                                </td>
                                <td>
                                    <?php  echo $skr->judul_skripsi ?>
                                </td>
                                <td>
                                    <?php  echo anchor('perhitungan/dosen/'.$skr->id, '<div class = "btn btn-primary btn-sm"><i class= "fa fa-eye"></i></div>')?>
                                    <?php  echo anchor('perhitungan/hapus/'.$skr->id, '<div class = "btn btn-danger btn-sm" onclick="javascript: return confirm(\'Anda yakin hapus?\')"><i class= "fa fa-trash"></i></div>')?>
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
                        <h4 class="modal-title" id="exampleModalLabel">Form Input Skripsi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action= "<?php echo site_url(). '/perhitungan/proses'; ?>" method= "post">
                            <div class = "form-group">
                                <label>Nama </label>
                                <input type="text" name="name" class="form-control" placeholder="Nama">

                                <label>NIM</label>
                                <input type="text" name="registration_number" class="form-control" placeholder="NIM">

                                <label>Judul Penelitian </label>
                                <input type="text" name="title" class="form-control" placeholder="Judul Penelitian">
                            </div>
                            <button type="reset" class= "btn btn-danger" >Reset</button>
                            <button type="submit" class= "btn btn-primary" >Kirim</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>