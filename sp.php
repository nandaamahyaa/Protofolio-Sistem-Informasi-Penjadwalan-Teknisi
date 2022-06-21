<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="<?= base_url();?>sp/Homesp"><em class="fa fa-home"></em></a></li>
			<li class="active">Teknisi</li>
		</ol>
	</div><!--/.row-->
		<!--flashdata-->
		<?php if($this->session->flashdata('flash')) : ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Teknisi <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>. <a href="sp/Teknisisp" class="pull-right"><em class="fa fa-lg fa-close"></em></a></div>
			</div>
		</div><!--/.row-->		
		<?php endif;?>
		
				
	<div class="table-responsive lowermost">
		<?php if (empty($teknisi)) :?>
			<div class="alert alert-danger" role="alert">
			  Data Teknisi tidak ditemukan
			</div>
		<?php endif; ?>
		
		<!--tombol search-->
		<form action="" role="search" method="post" style="float:right">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="Cari Data Teknisi.." name="keyword">
			</div>
		</form>
		<!--tombol tambah teknisi-->
		<a href="<?= base_url();?>sp/Teknisisp/tambah" class="btn btn-primary" type="tambah" name="tambah" style="margin:5px 5px 5px 5px"> Tambah  Teknisi </a>
			<!--template table-->
			<table class="table table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Teknisi</th>
					<th>Alamat</th>
					<th>No Hp</th>
					<th>Pengaturan</th>
				</tr>
			</thead>
			<tbody>
			<?php $i= 1 ; ?>
			<?php foreach($teknisi as $row):?>
				<tr>
					<td><?= $i ?></td>
					<td><?= $row["nama_teknisi"];?></td>
					<td><?= $row["alamat"];?></td>
					<td><?= $row["No_HP"];?></td>
					<td>
						<a href="<?= base_url();?>sp/Teknisisp/ubah/<?=$row['id_teknisi'];?>" style="color:black"class="fa fa-pencil-square-o"></a>
						<a href="<?= base_url();?>sp/Teknisisp/hapus/<?=$row['id_teknisi'];?>" style="color:black"class="fa fa-trash-o" onclick="return confirm('yakin?');">&nbsp;</a>
					</td>
				</tr>
			<?php $i ++; ?>
			<?php endforeach;?>
			</tbody>
			</table>
	</div>		
</div>	<!--/.main-->