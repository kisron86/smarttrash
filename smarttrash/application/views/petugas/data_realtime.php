<!-- Main Container -->
<main id="main-container">
	<!-- Page Content -->
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="block block-themed">
				<div>
				<p id="demo"></p>
				</div>
					<div class="block-header bg-gd-sea">
						<h3 class="block-title"><span class="si si-map"></span> Map Realtime</h3>
					</div>
					<div class="block-content" style="padding: unset;" >
								<div class="col-md" style="height:300px">
									<div id="map" ></div>
								</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="wrapper-table">
		</div>
	</div>
	<!-- END Page Content -->
</main>

<?php $this->load->view('petugas/mapjs')?>
