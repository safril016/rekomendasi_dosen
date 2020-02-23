<div class="content-wrapper">

    <section class="content-header">
        <h1>
        Kumpulan Skripsi
        <small></small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Skripsi</li>
        </ol>
    </section>

    <section class="content">
        <table class="table">
            <tr>
                <th>No</th>
                <th>Nama </th>
                <th>Nim</th>
                <th>Tahun Lulus</th>
                <th>Judul Skripsi</th>
                <th colspan="2">Aksi</th>
            </tr>

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
                        <?php  echo $skr->tahun_lulus ?>
                    </td>
                    <td>
                        <?php  echo $skr->judul_skripsi ?>
                    </td>
                </tr>
                <?php endforeach; ?>

        </table>

    </section>
    <!-- Button trigger modal -->

    <!-- Modal -->
   

</div>