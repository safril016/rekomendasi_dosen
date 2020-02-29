<div class="content-wrapper">
	<section class= "content">
		<?php foreach ($skripsi as $skr) { ?>

		<form action= "<?php echo site_url(). '/skripsi/update'; ?>" method= "post">

			<div class = "form-group">
				<label>Nama </label>
				<input type="hidden" name="id" class="form-control" value="<?php echo $skr->id ?>">
				<input type="text" name="nama" class="form-control" value="<?php echo $skr->nama ?>">
			</div>

			<div class = "form-group">
				<label>Nim</label>
				<input type="text" name="nim" class="form-control" value="<?php echo $skr->nim ?>">
			</div>

			<div class = "form-group">
				<label>Tahun Lulus</label>
				<input type="text" name="tahun_lulus" class="form-control" value="<?php echo $skr->tahun_lulus ?>">
			</div>

			<div class = "form-group">
				<label>Judul Skripsi</label>
				<input type="text" name="judul_skripsi" class="form-control" value="<?php echo $skr->judul_skripsi ?>">
			</div>

				<button type="reset" class= "btn btn-danger" >Reset</button>


				<button type="submit" class= "btn btn-primary" >Simpan</button>

			
		</form>

	<?php } ?>
	</section>
</div>	