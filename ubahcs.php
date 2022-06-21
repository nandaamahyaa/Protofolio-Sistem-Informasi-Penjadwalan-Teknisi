<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?= base_url();?>cs/Homecs">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Ubah Teknisi</li>
			</ol>
		</div><!--/.row-->
<!--horizontal form-->	
	
<form action="" method="post" style="margin-top:20px">
 <div class="form-group row">
    <label for="id_teknisi" class="col-sm-2 col-form-label">ID Teknisi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="id_teknisi" id="id_teknisi" placeholder="ID Teknisi" value="<?= $teknisi['id_teknisi']; ?>">
    <small class="form-text text-danger"><?= form_error('id_teknisi');?></small>
	</div>
  </div>
 
  <div class="form-group row">
    <label for="nama" class="col-sm-2 col-form-label">Nama Teknisi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nama_teknisi" id="nama_teknisi" placeholder="Nama Teknisi" value="<?= $teknisi['nama_teknisi']; ?>">
    <small class="form-text text-danger"><?= form_error('nama');?></small>
	</div>
  </div>
  
  <div class="form-group row">
    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-10">
      <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat" value="<?= $teknisi['alamat']; ?>">
    </div>
  </div>
  
  <div class="form-group row">
    <label for="No_HP" class="col-sm-2 col-form-label">No. Hp</label>
    <div class="col-sm-10">
      <input type="text" name="No_HP" class="form-control" id="No_HP" placeholder="No Hp" value="<?= $teknisi['No_HP']; ?>">
   <small class="form-text text-danger">
   <?= form_error('No_HP');?>
   </small>
	</div>
  </div>    
  
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" name="ubah" class="btn btn-primary" style="float:right">Ubah</button>
    </div>
  </div>
</form>
		
		<div class="table-responsive lowermost">
		<!--template table-->
	</div>
	</div>	<!--/.main-->
