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
                            Dosen Pembimbing dan Penguji
                        </h3>    
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3" style="margin-top: 1rem">
                        <div class="col-12 pull-right">
                            <a href="<?= site_url('perhitungan')?>" class="btn btn-primary">Kembali</a>
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
                            <th>Keterangan </th>
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
                                    <?php  echo $dsn->keterangan ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <!-- Button trigger modal -->

    </div>
</div>