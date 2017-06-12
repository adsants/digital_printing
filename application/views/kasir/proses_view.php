
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
					
					<?php
					if($this->oldData->TOTAL_BAYAR == ''){
						echo '<form class="form-horizontal" id="form_standar">';
					}
					?>
					
					<div class="box-body">
					<div class="row">
					<div class="col-xs-4">
					<table width="100%" >
						<tr>
							<td width="15%" align="right">No WO</td>
							<td width="5%" align="center">:</td>
							<td align=""><h3></b><?php echo $this->oldData->NO_ORDER; ?></b></h3></td>
						</tr>
						<tr>
							<td align="right">Tgl Order</td>
							<td align="center">:</td>
							<td ><?php echo $this->oldData->TGL_ORDER; ?></td>
						</tr>
						
					</table>
					</div>
					<div class="col-xs-8">
					
					<table width="100%">
					
						<tr>
							<td width="15%" align="right">Nama Pembeli</td>
							<td align="center">:</td>
							<td ><h4><?php echo $this->oldData->NAMA_CUSTOMER; ?></h4></td>
						</tr>
						<tr>
							<td align="right">Alamat</td>
							<td align="center">:</td>
							<td ><?php echo $this->oldData->ALAMAT_CUSTOMER; ?></td>
						</tr>
						<tr>
							<td align="right">No HP</td>
							<td align="center">:</td>
							<td ><?php echo $this->oldData->HP_CUSTOMER; ?></td>
						</tr>
					</table>
					</div>
					</div>
					<hr>
					<table class="table table-bordered">
						<tr>
							<th width="55%" align="center">Barang</th>
							<th width="15%" align="center">Jumlah Qty</th>
							<th width="20%" align="center">Harga Qty</th>
							<th width="25%" align="center">Total</th>
						</tr>
						<?php 
						
						//var_dump($this->dataBarang);
						$hargaTotal = 0;
						foreach ($this->dataBarang as $showBarang) {
						?>
						<tr>
							<td><?php echo $showBarang->NAMA_BARANG; ?></td>
							<td><?php echo $showBarang->JUMLAH_QTY; ?> <?php echo $showBarang->SATUAN; ?></td>
							<td><?php echo $showBarang->HARGA_SATUAN; ?></td>
							<td><?php echo $showBarang->TOTAL_HARGA; ?></td>
						</tr>
						<?php				
						$hargaTotal += $showBarang->TOTAL_HARGA;
						}
						
						
						function format_rupiah($angka){
							$rupiah=number_format($angka,0,',','.');
							return "Rp. ".$rupiah.",00";
						}
						?>
						<tr>
							<td colspan="2" align="right"><h3>Harga Total</h3></td>
							<td colspan="2" align="center">
							<input type="hidden" name="ID_ORDER" value="<?php echo $this->oldData->ID_ORDER; ?>">
							<input type="hidden" name="harga_total" id="harga_total" value="<?php echo $hargaTotal; ?>">
							<h3><?php echo format_rupiah($hargaTotal); ?></h3></td>
						</tr>
						<?php
						if($this->oldData->TOTAL_BAYAR == ''){
						?>
						<tr>
							<td  align="right" colspan="2">Discount (Rp.) </td>
							<td  align="center"><input type="text" class="form-control input-sm" value="0" onkeyup="hitung_discount()" id="DISCOUNT" name="DISCOUNT" placeholder="discount (Rp.)"></td>
							<td align="center"></td>
						</tr>					
						<tr>
							<td colspan="2" align="right"><h2>Total Bayar</h2></td>
							<td colspan="2" align="center"><h2 id="total_bayar_rp"><?php echo format_rupiah($hargaTotal); ?></h2>
							<input type="hidden" name="TOTAL_BAYAR" id="TOTAL_BAYAR" value="<?php echo $hargaTotal; ?>">
							</td>
						</tr>					
						<tr>
							<td colspan="2" align="right"></td>
							<td colspan="2" align="">
							
							
								<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
								<img src="<?php echo base_url();?>assets/img/loading.gif" id="loading" style="display:none">
								<p id="pesan_error" style="display:none" class="text-warning" style="display:none"></p>
							</td>
						</tr>
						<?php
						}
						else{
						?>
						<tr>
							<td  align="right" colspan="2"><h4 >Discount (Rp.) </h4></td>
							<td  align="center" colspan="2" ><h4><?php echo format_rupiah($this->oldData->DISCOUNT); ?></h4></td>
							
						</tr>					
						<tr>
							<td colspan="2" align="right"><h2>Total Bayar</h2></td>
							<td colspan="2" align="center"><h2 ><?php echo format_rupiah($this->oldData->TOTAL_BAYAR); ?></h2></td>
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
							<th width="25%" align="center">Nama Karyawan</th>
							<th width="25%" align="center">Dari - Ke</th>
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
					<?php
					
					if($this->oldData->POSISI_ORDER == 'KASIR' && $this->oldData->TOTAL_BAYAR !=""){
					?>
					<div class="col-xs-5">
					<div class="box">		
					<div class="box-header">
						Proses WO		
					</div>
					<div class="box-body">
					
					<form class="form-horizontal" id="form_standar">
					
						<input type="hidden" name="TOTAL_BAYAR" id="TOTAL_BAYAR" value="<?php echo $this->oldData->TOTAL_BAYAR; ?>">
					
						<div class="form-group">
							<label class="control-label col-sm-3" for="email">Ke Proses :</label>
							<div class="col-sm-6">
								<input type="hidden" name="ID_ORDER" value="<?php echo $this->oldData->ID_ORDER; ?>">
								<input type="hidden" name="DARI" value="<?php echo $this->oldData->POSISI_ORDER; ?>">
								<select class="form-control required" name="KE">
									<option value="BAYAR">Ke Proses Bayar</option>
								</select>
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label col-sm-3" for="email">Jenis Pembayaran :</label>
							<div class="col-sm-6">
								<select class="form-control required" name="JENIS_BAYAR">
									<option value="">Silahkan Pilih</option>
									<option value="TUNAI">Tunai</option>
									<option value="TRANSFER">Transfer ATM</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="email">Status Pembayaran :</label>
							<div class="col-sm-6">
								<select class="form-control required" name="STATUS_BAYAR">
									<option value="L">LUNAS</option>
									<option value="BL">Belum LUNAS</option>
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
					
					<?php							
					}
					if($this->oldData->POSISI_ORDER == "BAYAR"){
					?>	
					<div class="col-xs-5">
					<div class="box">		
					<div class="box-header">
						Proses WO		
					</div>
					<div class="box-body">
					
						<center>
						<a href="<?=base_url()."cetak/nota/".$this->oldData->ID_ORDER;?>" target="blank">
							<span class="btn btn-success btn-lg"><i class="fa fa-print"></i> Cetak Nota</span>
						</a>
						</center>
					
					</div>
					</div>
					</div>
					
					<?php					
					}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
  
