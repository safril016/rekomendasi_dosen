<div class="content-wrapper">
    <div class="container">
        <section class="content-header">
            <h1>
            Kumpulan Data Dosen
            <small>Teknik Informatika</small>
        </h1>
        </section>

        <section class="content">
            <div class="box box-default">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Nama </th>
                        <th>Kategori</th>
                    </tr>

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
                        
                        </tr>
                        <?php endforeach; ?>

                </table>
            </div>

        </section>
    </div>
</div>