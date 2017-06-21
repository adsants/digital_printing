<link rel="stylesheet" href="<?=base_url();?>assets/bootstrap/css/bootstrap.min.css">
<style>
	body{
		font-size:10px;
		}
</style>
<body>
<table width="100%" style="border-collapse:collapse;    border: 1px solid #ddd;" border="1" >
<tr valign="top">
<td width="40%" valign="top">
<table width="100%" >
	
	<tr>
		
		<td align=""><h3>&nbsp;<b><?php echo $this->oldData->NO_WO; ?></b></h3></td>
	</tr>
	<tr>
		
		<td >&nbsp;&nbsp;<?php echo $this->oldData->TGL_ORDER; ?></td>
	</tr>
	
</table>
</td>
<td width="60%" valign="top">

<table width="100%">

	<tr>
		
		<td ><h4>&nbsp;&nbsp;<?php echo $this->oldData->NAMA_CUSTOMER; ?></h4></td>
	</tr>
	<tr>
		
		<td >&nbsp;&nbsp;<?php echo $this->oldData->ALAMAT_CUSTOMER; ?></td>
	</tr>
	<tr>
		
		<td >&nbsp;&nbsp;<?php echo $this->oldData->HP_CUSTOMER; ?><br><br></td>
	</tr>
</table>
</td>
</tr>
</table>
<hr>
<table class="table table-bordered">
	<tr>
		<th width="45%" align="center">Barang</th>
		<th width="15%" align="center">Quantity</th>
		<th width="20%" align="center">Harga Satuan</th>
		<th width="25%" align="center">Jumlah</th>
	</tr>
	<?php 
	
	//var_dump($this->dataBarang);
	$hargaTotal = 0;
	foreach ($this->dataBarang as $showBarang) {
	?>
	<tr>
		<td><?php echo $showBarang->NAMA_BARANG; ?></td>
		<td><?php echo $showBarang->JUMLAH_QTY; ?> <?php echo $showBarang->SATUAN_BARANG; ?></td>
		<td><?php echo format_rupiah($showBarang->HARGA_SATUAN); ?></td>
		<td><?php echo format_rupiah($showBarang->TOTAL_HARGA); ?></td>
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
		<td colspan="2" align="right">Sub Total</td>
		<td colspan="2" align="center"><?php echo format_rupiah($hargaTotal); ?></td>
	</tr>
	
	<tr>
		<td  align="right" colspan="2">Discount</td>
		<td  align="center" colspan="2" ><?php echo format_rupiah($this->oldData->DISCOUNT); ?></td>
		
	</tr>					
	<tr>
		<td colspan="2" align="right">Total</td>
		<td colspan="2" align="center"><?php echo format_rupiah($this->oldData->TOTAL_BAYAR); ?></td>
	</tr>	


</table>
					
</body>
  
<script>window.print();</script>
