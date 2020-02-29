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
            <section class="content" style="margin-top: 3rem">
                <form action= "<?php echo site_url(). '/perhitungan/proses'; ?>" method= "post">
                    <div class = "form-group">
                        <label>Nama </label>
                        <input type="text" name="name" class="form-control" value="a" >

                        <label>NIM</label>
                        <input type="text" name="registration_number" class="form-control" value="a"  >

                        <label>Judul Penelitian </label>
                        <input type="text" name="title" class="form-control" value="RANCANG BANGUN GAME EDUKASI PUZZEL KEBUDAYAAN SULAWESI TENGGARA DENGAN ALGORITMA FISHER YATES SHUFFEL" >
                    </div>
                    <button type="reset" class= "btn btn-danger" >Reset</button>
                    <button type="submit" class= "btn btn-primary" >Kirim</button>
                </form>
            </section>
            </div>
        <!-- Button trigger modal -->
    </div>
</div>