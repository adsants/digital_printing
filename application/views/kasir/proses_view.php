
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
					
					<form class="form-horizontal" id="form_standar">
					
					<div class="box-body">
					<div class="row">
					<div class="col-xs-4">
					<table width="100%" >
						<tr>
							<td width="20%" align="right">No WO</td>
							<td width="5%" align="center">:</td>
							<td align=""><h4></b><?php echo $this->oldData->NO_WO; ?></b></h4></td>
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
							<th width="50%" align="center">Barang</th>
							<th width="10%" align="center">Jumlah Qty</th>
							<th width="10%" align="center">Satuan</th>
							<th width="15%" align="center">Harga Qty <br><sub style="color:rgb(224, 226, 114)">Harga sudah berdasarkan database barang</sub></th>
							<th width="25%" align="center">Total</th>
						</tr>
						<?php 
						
						//var_dump($this->dataBarang);
						$hargaTotal = 0;
						foreach ($this->dataBarang as $showBarang) {
						?>
						<tr>
							<td>
								<input name="NAMA_BARANG_<?php echo $showBarang->COUNT_BARANG; ?>" value="<?php echo $showBarang->NAMA_BARANG; ?>" class="form-control">
								<input type="hidden" name="ID_BARANG[]" value="<?php echo $showBarang->COUNT_BARANG; ?>" class="form-control">
							</td>
							<td>
								<input onkeyup="ganti_harga_jumlah_kasir('<?php echo $showBarang->COUNT_BARANG; ?>','<?php echo $this->jumlahBarang; ?>')" id="JUMLAH_QTY_<?php echo $showBarang->COUNT_BARANG; ?>" name="JUMLAH_QTY_<?php echo $showBarang->COUNT_BARANG; ?>" value="<?php echo $showBarang->JUMLAH_QTY; ?>" class="form-control"> 
							</td>
							<td>
								<input name="SATUAN_BARANG_<?php echo $showBarang->COUNT_BARANG; ?>" value="<?php echo $showBarang->SATUAN_BARANG; ?>" class="form-control"> 
							</td>
							<td>
								<input onkeyup="ganti_harga_jumlah_kasir('<?php echo $showBarang->COUNT_BARANG; ?>','<?php echo $this->jumlahBarang; ?>')" id="HARGA_SATUAN_<?php echo $showBarang->COUNT_BARANG; ?>" name="HARGA_SATUAN_<?php echo $showBarang->COUNT_BARANG; ?>" value="<?php echo $showBarang->HARGA_SATUAN; ?>" class="form-control">
							</td>
							<td>
								<input id="TOTAL_HARGA_<?php echo $showBarang->COUNT_BARANG; ?>" name="TOTAL_HARGA_<?php echo $showBarang->COUNT_BARANG; ?>" readonly value="<?php echo $showBarang->TOTAL_HARGA; ?>" class="form-control">
							</td>
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
							<td colspan="3" align="right"><h4>Harga Total</h4></td>
							<td colspan="2" align="center">
							<input type="hidden" name="ID_ORDER" value="<?php echo $this->oldData->ID_ORDER; ?>">
							<input type="hidden" name="harga_total" id="harga_total" value="<?php echo $hargaTotal; ?>">
							<h4 id="text_harga_total"><?php echo format_rupiah($hargaTotal); ?></h4></td>
						</tr>
						
						
						
						
							
						
						<tr>
							<td  align="right" colspan="3">Discount (Rp.) </td>
							<td  align="center" colspan=2><input type="text" class="form-control input-sm" value="<?php echo ($this->oldData->DISCOUNT == '' ? '0' : $this->oldData->DISCOUNT) ?>" onkeyup="hitung_discount()" id="DISCOUNT" name="DISCOUNT" placeholder="discount (Rp.)"></td>
						</tr>					
						<tr>
							<td colspan="3" align="right"><h4>Total Bayar</h4></td>
							<td colspan="2" align="center"><h4 id="total_bayar_rp"><?php echo ($this->oldData->DISCOUNT == '' ? format_rupiah($hargaTotal) : format_rupiah($this->oldData->TOTAL_BAYAR)) ?></h4>
							<input type="hidden" name="TOTAL_BAYAR" id="TOTAL_BAYAR" value="<?php echo ($this->oldData->DISCOUNT == '' ? $hargaTotal : $this->oldData->TOTAL_BAYAR) ?>">
							</td>
						</tr>
						<tr>
							<td colspan="10">
							
								<table width="100%" class="table table-bordered table-striped">
									<tr>
										<td width="33%">
											<?php //echo $this->oldData->TGL_AMBIL; ?>
											<select name="TGL_AMBIL" class="form-control required">
												<option value="">silahkan pilih </option>
												<option <?php echo ($this->oldData->TGL_AMBIL != '' ? "" : "selected") ?> value="S">Barang Sudah diambil</option>
												<option <?php echo ($this->oldData->TGL_AMBIL == '' ? "" : "selected") ?> value="B">Barang Belum diambil</option>
											</select>
										</td>
										<td  width="33%">
											<select name="JENIS_BAYAR" class="form-control required">
												<option value="">silahkan pilih </option>
												<option value="CASH">Cash</option>
												<option value="TRANSFER">Transfer</option>
												<option value="Debit BCA">Debit BCA</option>
												<option value="Debit Mandiri">Debit Mandiri</option>
												<option value="Debit Bank Lain">Debit Bank Lain</option>
												<option value="Credit Card">Credit Card</option>
												<option value="Email Transfer">Email Transfer</option>
												<option value="Voucher">Voucher</option>
												<option value="Surat Jalan">Surat Jalan</option>
												<option value="Invoice">Invoice</option>
												<option value="Faktu Penjualan">Faktu Penjualan</option>
												<option value="ACC (Compliment dari Owner)">ACC (Compliment dari Owner)</option>
											</select>
										</td>
										<td  width="33%">
											<select name="STATUS_BAYAR" class="form-control required">
												<option value="">silahkan pilih </option>
												<option <?php echo ($this->oldData->STATUS_BAYAR == 'L' ? "" : "selected") ?> value="L">Lunas</option>
												<option <?php echo ($this->oldData->STATUS_BAYAR != 'L' ? "" : "selected") ?> value="BL">Belum Lunas</option>
											</select>
										</td>
									</tr>
								</table>
							</td>
						</tr>					
						<tr>
							<td colspan="3" align="center">
								<?php
								if($this->oldData->TOTAL_BAYAR != ''){
								?>
									<a href="<?=base_url();?>/cetak/nota/<?php echo $this->oldData->ID_ORDER; ?>" target="_blank"><span type="submit" class="btn btn-success btn-lg"> Cetak Nota</span></a>
								<?php
								}
								?>
							
							</td>
							<td colspan="2" align="">
							
							
								<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
								<img src="<?php echo base_url();?>assets/img/loading.gif" id="loading" style="display:none">
								<p id="pesan_error" style="display:none" class="text-warning" style="display:none"></p>
								
								
								
								
							</td>
						</tr>
						
					</table>
					
					</div>
					</div>
					</div>
					
				
					</div>
					
					
					
					
					<div class="row">
					<div class="col-xs-12">
					<div class="box">		
					
					<div class="box-body">
					
					
					<table class="table table-striped table-bordered">
						<tr>
							<th width="20%" align="center">Nama Karyawan</th>
							<th width="20%" align="center">Dari - Ke</th>
							<th width="15%" align="center">Waktu</th>
							<th width="45%" align="center">Catatan</th>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
  
