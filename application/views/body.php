
  <!-- Full Width Column -->
  <div class="content-wrapper" style="min-height: 526px;">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Kumpulan Judul Skripsi 
          <small>Teknik Informatika</small>
        </h1>

      <!-- Main content -->
      <section class="content">
        <div class="box box-default">
          <div class="box-header with-border">
          </div>
          <div>
            <table class="table table-bordered table-striped table-responsive">
            <tr>
                <th>No</th>
                <th>Nama </th>
                <th>Nim</th>
                <th>Tahun Lulus</th>
                <th>Judul Skripsi</th>
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
          </div>
          <!-- /.box-body -->
        </div>
            
        
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->