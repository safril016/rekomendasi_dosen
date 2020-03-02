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
                </div>
            </div>
            <section class="content"> <!-- style="margin-top: 3rem" -->
                <table class="table table-bordered table-responsive">
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <td><?= $nama ?></td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td><?= $nim ?></td>
                        </tr>
                        <tr>
                            <th>Judul Skripsi</th>
                            <td><?= $judul ?></td>
                        </tr>
                        <!-- <tr>
                            <th>Peminatan</th>
                            <td><?= $peminatan ?></td>
                        </tr> -->
                    </tbody>
                </table>
                <form action="<?= site_url('perhitungan/tambah_skripsi') ?>" method="post">
                <div style="margin-top: 3rem">
                    <table class="table table-bordered table-striped table-responsive bg-gray">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                        </thead>
                        <tbody>
                        <?php
                    $no=1;
                    foreach ($rekomendasi_dosen as $dsn ) :     ?>
                    
                            <tr>
                                <td>
                                    <?php  echo $no++ ?>
                                </td>
                                <td>
                                <input type="hidden" name="nama" value="<?= $nama ?>">
                                <input type="hidden" name="nim" value="<?= $nim ?>">
                                <input type="hidden" name="judul" value="<?= $judul ?>">
                                    <?php
                                    // var baru supaya list dosen tidak bertambah di selectnya
                                        $select_dosen = $list_dosen;
                                        $select_dosen[ $dsn->id ] = $dsn->nama;
                                        $form = array(
                                            'name' => 'dosen_id'.($no-1),
                                            'id' => 'dosen_id'.($no-1),
                                            'options' => $select_dosen,
                                            'selected' => $dsn->id,
                                            'class' => 'form-control',
                                        );
                                        echo form_dropdown( $form )
                                    ?>
                                </td>
                                <td>
                                    <?php  echo $dsn->keterangan ?>
                                </td>
                            
                            </tr>
                            <?php endforeach; 
                        ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Tambah Skripsi</button>
                </div>
                </form>
            </section>
        </div>
        <!-- Button trigger modal -->

        
    </div>
</div>

