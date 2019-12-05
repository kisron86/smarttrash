<!-- Main Container -->
<main id="main-container">
	<!-- Page Content -->
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="block block-themed">
					<div class="block-header bg-gd-sea">
						<h3 class="block-title"><span class="si si-info"></span> Pengaturan akun</h3>
					</div>
					<div class="block-content">
						<form action="<?php echo base_url('Pengaturan/update_akun') ?>" method="post">
						  <div class="form-group">
						    <label for="email">Username:</label>
						    <input type="text" name="username" class="form-control" id="email" value="<?php echo $data->username ?>">
						  </div>
						  <div class="form-group">
						    <label for="pwd">Ganti Password:</label>
						    <input type="password" name="password" class="form-control" id="pwd">
						  </div>
							<div class="form-group">
						    <label for="pwd">Ulangi Password:</label>
						    <input type="password" name="retype-password" class="form-control" id="pwd">
						  </div>
						  <button type="submit" class="btn btn-default">Submit</button>
						</form>
						<br>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- END Page Content -->
</main>
<script type="text/javascript">
	$(function() {
		<?php if ($this->session->flashdata('message')) {
			echo $this->session->flashdata('message');
		} ?>
	})
</script>
