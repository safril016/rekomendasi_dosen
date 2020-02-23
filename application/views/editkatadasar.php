<div class="content-wrapper">
	<section class= "content">
		<?php foreach ($katadasar as $dsr) { ?>

		<form action= "<?php echo site_url(). '/katadasar/update'; ?>" method= "post">

			<div class = "form-group">
				<label>kata Dasar </label>
				<input type="hidden" name="id" class="form-control" value="<?php echo $dsr->id ?>">
				<input type="text" name="kata_dasar" class="form-control" value="<?php echo $dsr->kata_dasar ?>">
			</div>

			<div class = "form-group">
				<label>Kategori</label>
			<select class = "form-control" name= "kategori" value="<?php echo $dsr->kategori ?>">
                  <option>RPL</option>
                  <option>KBJ</option>
                  <option>KCV</option>
                   
                 </select>
			</div>

			

				<button type="reset" class= "btn btn-danger" >Reset</button>


				<button type="submit" class= "btn btn-primary" >Simpan</button>

			
		</form>

	<?php } ?>
	</section>
</div>	