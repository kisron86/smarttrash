<!-- Side Navigation -->
<div class="content-side content-side-full">
	<ul class="nav-main">
		<li class="nav-main-heading"><span class="sidebar-mini-visible"></span><span class="sidebar-mini-hidden">Menu Utama</span></li>
		<li>
			<a href="<?=base_url('Dashboard');?>" <?php if($menu=='dashboard'){echo 'class=active';}?> ><i class="si si-home"></i><span class="sidebar-mini-hide">Dashboard</span></a>
		</li>
		<li>
			<a href="<?=base_url('Data_ketinggian');?>" <?php if($menu=='data_ketinggian'){echo 'class=active';}?>><i class="si si-list"></i><span class="sidebar-mini-hide">Data Realtime</span></a>
		</li>
		<li class="nav-main-heading"><span class="sidebar-mini-visible"></span><span class="sidebar-mini-hidden">Pengaturan</span></li>
		<li>
			<a href="<?php echo base_url('Pengaturan') ?>" <?php if($menu=='pengaturan'){echo 'class=active';}?>><i class="si si-settings"></i><span class="sidebar-mini-hide">Pengaturan Akun</span></a>
		</li>
	</ul>
</div>
<!-- END Side Navigation -->
