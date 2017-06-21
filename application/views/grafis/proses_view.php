
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
                    <?php
                    if( $this->oldData->POSISI_ORDER=='FINISH-DESIGN' || $this->oldData->POSISI_ORDER=='KASIR' ){}
                    else{
                        ?>
					<br>
					<table border="0" width="100%">
						<tr>
							<td align="right">
							<span class="btn btn-warning btn-sm" data-toggle="modal" 
                            data-target="#modal_selesai_desain">Klik 
                            Disini untuk Finish tahap Design</span>
							</td>
						</tr>
						
					</table>
					<?php } ?>
					</div>
					</div>
					</div>
					
					
					</div>
					
					
					
					
					<div class="row">
					<form class="form-horizontal" id="form_standar">
                    <input type="hidden"  name="ID_ORDER" value="<?php echo $this->oldData->ID_ORDER; ?>">
                    <input type="hidden" name="NO_ORDER" value="<?php echo $this->oldData->NO_ORDER; ?>">
					<div class="col-xs-12">
					<div class="box">		
					<div class="box-header">
						
					</div>
					<div class="box-body">
					<table width="100%">
						<tr>
							<td align="right" width="20%">Tgl Order</td>
							<td align="center">:</td>
							<td ><?php echo $this->oldData->TGL_ORDER; ?></td>
						</tr>
						<tr>
							<td align="right">Jenis Member</td>
							<td align="center">:</td>
							<td ><?php echo ($this->oldData->LOG_MEMBER == 'Y' ? 'Member' : 'Bukan Member' ) ?></td>
						</tr>
					</table>
					<hr>
					<table class="table table-striped table-bordered">
						<tr>
							<td>
								<input class="form-control" id="NAMA_BARANG_AUTOCOMPLETE" 
                                placeholder="ketikkan nama barang">
								<input type="hidden" value="1" id="id_barang_grafis">
								<input type="hidden" id="ID_BARANG_FORM">
							</td>
							<td width="10%">
								<input class="form-control" type="number" id="JUMLAH_QTY_FORM" onkeyup="hitung_harga_barang()"  placeholder="jumlah Qty">
                                
								<input type="hidden" id="HARGA_QTY_FORM">
								<input type="hidden" id="TOTAL_QTY_FORM">
							</td>
							<td width="15%">
								<input class="form-control" id="SATUAN_BARANG_FORM" 
                                placeholder="Satuan">
							</td>
							<td width="5%"><span class="btn btn-success btn-sm" onclick="tambah_barang()">Tambah</span></td>
						<tr>
					</table>
					<hr>
					<table class="table table-striped table-bordered">
						<thead>
						<tr>
							<th width="75%" align="center">Nama Barang</th>
							<th width="15%" align="center">Jumlah Qty</th>
							<th width="15%" align="center">Satuan</th>
							<th width="5%" align="center"></th>
						</tr>
						</thead>
						<tbody id="tabel_op_grafis">
                        
                        </tbody>
						
					</table>
                    <br>
					<table border="0" width="100%">
						<tr>
							<td align="right">
                                
                                <p id="pesan_error" style="display:none" class="text-warning" style="display:none"></p>
                                 <img src="<?php echo base_url();?>assets/img/loading.gif" id="loading" style="display:none"><br>
                                <button class="btn btn-primary btn-lg">Simpan Work Order ( WO )</button>
							</td>
						</tr>
						
					</table>
					</div>
					</div>
					</div>
					
					
					</form>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->


<div class="modal fade" id="modal_selesai_desain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
    <form class="form-horizontal" id="form_finish_design">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Form Finish 
                tahap Design</h4>
               
			</div>
			<div class="modal-body">
                
                    <div class="form-group">
                         <div class="col-sm-10"><b>CS-GRAFIS  &#10132; FINISH-DESIGN</b></div>
                    </div>	
                    <div class="form-group">
                       
                        <div class="col-sm-12">
                            <textarea class="form-control" 
                            id="keterangan_finish_design" name="keterangan_finish_design" required
                            placeholder="Catatan untuk tahap Design" ></textarea>
                            <input type="hidden" id="id_order_finish_design" name="id_order_finish_design"
                            value="<?php echo $this->oldData->ID_ORDER; ?>">
                        </div>
                    </div>	
                
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <img src="<?php echo base_url();?>assets/img/loading.gif" id="loading_finish_design" style="display:none">
                            <p id="pesan_error_finish_design" style="display:none" class="text-warning" style="display:none"></p>
                        </div>
                    </div>	
             
            </div>
			<div class="modal-footer">
                <span  class="btn btn-warning" data-dismiss="modal">Batal</span>
				<button type="submit"  class="btn btn-primary">Simpan</button>
			</div>
		</div>
	</div>
    </form>
</div>
  
