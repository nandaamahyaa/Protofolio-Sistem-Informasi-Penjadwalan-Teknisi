<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="<?= base_url();?>cs/Homecs" class="fa fa-home"></a></li>
			<li class="active">Tambah Teknisi</li>
		</ol>
	</div><!--/.row-->
	
	<!--flashdata-->
		<?php if($this->session->flashdata('flash')) : ?>
		<div class="row">
			<div class="col-lg-12">     
				<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Teknisi <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>. <a href="cs/Teknisics" class="pull-right"><em class="fa fa-lg fa-close"></em></a></div>
			</div>
		</div><!--/.row-->		
		<?php endif;?>
	
	<!--horizontal form-->		
	
	<form action="" method="post" style="margin-top:20px">
		<div class="form-group row">
			<label for="id_teknisi" class="col-sm-2 col-form-label">ID Teknisi</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="id_teknisi" id="id_teknisi" placeholder="ID Teknisi">
					<small class="form-text text-danger"><?= form_error('id_teknisi');?></small>
				</div>
		</div>
	 
		<div class="form-group row">
			<label for="nama" class="col-sm-2 col-form-label">Nama Teknisi</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="nama_teknisi" id="nama_teknisi" placeholder="Nama Teknisi">
					<small class="form-text text-danger"><?= form_error('nama_teknisi');?></small>
				</div>
		</div>
	  
		<div class="form-group row">
			<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
				<div class="col-sm-10">
					<input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat">
				</div>
		</div> 
	  
		<div class="form-group row">
			<label for="No_HP" class="col-sm-2 col-form-label">No. Hp</label>
				<div class="col-sm-10">
					<input type="text" name="No_HP" class="form-control" id="No_HP" placeholder="No Hp">
					<small class="form-text text-danger"><?= form_error('No_HP');?></small>
				</div>
		</div>   
	  
		<div class="form-group row">
			<div class="col-sm-12">
				<button type="submit" name="tambah" class="btn btn-primary" style="float:right">Tambah</button>
			</div>
		</div>
	</form>
</div>	<!--/.main-->
