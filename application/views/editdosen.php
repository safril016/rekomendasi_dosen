<div class="content-wrapper">
	<section class= "content">
		<?php foreach ($dosen as $dsn) { ?>

		<form action= "<?php echo site_url(). '/dosen/update'; ?>" method= "post">

			<div class = "form-group">
				<label>Nama </label>
				<input type="hidden" name="id" class="form-control" value="<?php echo $dsn->id ?>">
				<input type="text" name="nama" class="form-control" value="<?php echo $dsn->nama ?>">
			</div>

			<div class = "form-group">
				<label>Kategori</label>
			<select class = "form-control" name= "kategori" value="<?php echo $dsn->kategori ?>">
                  <option>RPL</option>
                  <option>KBJ</option>
                  <option>KCV</option>
             </select>
               </div>

			<div class="form-group">
				<label>Keterangan</label>
				<input type="text" name="keterangan" class="form-control" value="<?php echo $dsn->keterangan ?>">
			</div>

				<button type="reset" class= "btn btn-danger" >Reset</button>
				<button type="submit" class= "btn btn-primary" >Simpan</button>

			
		</form>

	<?php } ?>
	</section>
</div>	