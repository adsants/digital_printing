
<!-- Content Header (Page header) -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">		
				<div class="box-header">
					<h4><?php echo $this->template_view->nama_menu('nama_menu'); ?></h4>
					<h5><?php echo $this->template_view->nama_menu('judul_menu'); ?></h5>
					<hr>			
				</div>
				<div class="box-body">
					<div class="row">
					<div class="col-xs-12">
					<div class="box">		
					
					<div class="box-body">
					<table width="100%">
						<tr>
							<td width="15%" align="right">No WO</td>
							<td width="5%" align="center">:</td>
							<td align=""><h4><?php echo $this->oldData->NO_ORDER; ?></h4></td>
						</tr>
						<tr>
							<td align="right">Tgl Order</td>
							<td align="center">:</td>
							<td ><?php echo $this->oldData->TGL_ORDER; ?></td>
						</tr>
						<tr>
							<td align="right">Catatan WO</td>
							<td align="center">:</td>
							<td ><?php echo $this->oldData->CATATAN; ?></td>
						</tr>
					</table>
					
					<br>
					<table class="table table-striped">
						<tr>
							<th width="75%" align="center">Barang</th>
							<th width="25%" align="center">Jumlah</th>
						</tr>
						<?php 
						
						//var_dump($this->dataBarang);
						
						foreach ($this->dataBarang as $showBarang) {
						?>
						<tr>
							<td><?php echo $showBarang->NAMA_BARANG; ?></td>
							<td><?php echo $showBarang->JUMLAH_QTY; ?></td>
						</tr>
						<?php							
						}
						?>
					</table>
					
					</div>
					</div>
					</div>
					
					
					</div>
					
					
					
					
					<div class="row">
					<div class="col-xs-7">
					<div class="box">		
					<div class="box-header">
						Log Alur WO		
					</div>
					<div class="box-body">
					
					<table class="table table-striped">
						<tr>
							<th width="35%" align="center">Nama Karyawan</th>
							<th width="15%" align="center">Dari - Ke</th>
							<th width="25%" align="center">Waktu</th>
							<th width="25%" align="center">Catatan</th>
						</tr>
						<?php 
						
						//var_dump($this->dataBarang);
						
						foreach ($this->logAlur as $showLog) {
						?>
						<tr>
							<td><?php echo $showLog->NAMA_KARYAWAN; ?></td>
							<td><?php echo $showLog->DARI; ?> &#10132; <?php echo $showLog->KE; ?></td>
							<td><?php echo $showLog->TGL_LOG_ORDER ; ?></td>
							<td><?php echo $showLog->CATATAN_LOG_ORDER ; ?></td>
						</tr>
						<?php							
						}
						?>
					</table>
					</div>
					</div>
					</div>
					
					<div class="col-xs-5">
					<div class="box">		
					<div class="box-header">
						Proses WO		
					</div>
					<div class="box-body">
					
					<form class="form-horizontal" id="form_standar">
						<div class="form-group">
							<label class="control-label col-sm-3" for="email">Ke Proses :</label>
							<div class="col-sm-6">
								<input type="hidden" name="ID_ORDER" value="<?php echo $this->oldData->ID_ORDER; ?>">
								<input type="hidden" name="DARI" value="<?php echo $this->oldData->POSISI_ORDER; ?>">
								<select class="form-control required" name="KE">
									<?php
									if($this->oldData->JENIS_ORDER == 1){
										echo '<option value="OP-PRINT">Ke OP-PRINTING</option>';
									}
									else{
										echo '<option value="KASIR">Ke KASIR</option>';
									}
									?>
									?>
								</select>
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label col-sm-3" for="email">Catatan :</label>
							<div class="col-sm-9">
								<input type="input" class="form-control required" maxlength="250" id="CATATAN" name="CATATAN">
							</div>
						</div>
					
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<img src="<?php echo base_url();?>assets/img/loading.gif" id="loading" style="display:none">
								<p id="pesan_error" style="display:none" class="text-warning" style="display:none"></p>
							</div>
						</div>			
						<div class="form-group">        
							<div class="col-sm-offset-3 col-sm-9">
								<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
								<a href="<?=base_url()."".$this->uri->segment(1);?>">
									<span class="btn btn-warning"><i class="fa fa-remove"></i> Batal</span>
								</a>
							</div>
						</div>
					</form>
					
					
					</div>
					</div>
					</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
  
