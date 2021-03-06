function toRp(angka){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
}


// Standard Form
$('#form_standar').validate({
	rules: {
		PASSWORD: "required",
		REPASS: {
		  equalTo: "#PASSWORD"
		}
	},
	submitHandler: function(form) {	
		
		
		$.ajax({
			url: base_url+''+uri_1+'/'+uri_2+'_data',
			type:'POST',
			dataType:'json',
			data: $('#form_standar').serialize(),
			beforeSend: function(){	
				$('#loading').show();
				$('#pesan_error').hide();
			},
			success: function(data){
				if( data.status ){	
					if(data.pesan_modal){
						$('.main-footer').append('<div class="modal fade" id="container-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h4 class="modal-title" id="myModalLabel">Pesan Pemberitahuan</h4></div><div class="modal-body">'+data.pesan_modal+'</div><div class="modal-footer"><a href="'+data.redirect_link+'"> <button type="button" class="btn btn-primary">Ok</button></a></div></div></div></div>');
						$('#container-modal').modal('show');
					}
					else{
						$('.main-footer').append('<div class="modal fade" id="container-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h4 class="modal-title" id="myModalLabel">Pesan Pemberitahuan</h4></div><div class="modal-body"><b>Data berhasil disimpan.</b></div><div class="modal-footer"><a href="'+data.redirect_link+'"> <button type="button" class="btn btn-primary">Ok</button></a></div></div></div></div>');
						$('#container-modal').modal('show');
					}
				}
				else{				
					$('#loading').hide(); $('#pesan_error').show(); $('#pesan_error').html(data.pesan);					 
				}
			},
			error : function(data) {
				$('#pesan_error').html('maaf telah terjadi kesalahan dalam program, silahkan anda mengakses halaman lainnya.'); $('#pesan_error').show(); $('#loading').hide();
				//$('#pesan_error').html( '<h3>Error Response : </h3><br>'+JSON.stringify( data ));
			}
		})
	}
});


$('#PASSWORD_LOGIN').keydown(function(event){ 
    var keyCode = (event.keyCode ? event.keyCode : event.which);   
    if (keyCode == 13) {
        $('#startSearch').trigger('click');
    }
});

$('#form_login').validate({
	submitHandler: function(form) {	
		$.ajax({
			url: base_url+'login/login_data',
			type:'POST',
			dataType:'json',
			data: $('#form_login').serialize(),
			beforeSend: function(){	
				$('#loading_login').show();
				$('#pesan_error_login').hide();
			},
			success: function(data){
				if( data.status ){		
					if($('#forAction').val()=='disableModal'){
						$('#modalLogin').hide('scale',function(){
							location.reload();
						});					
					}
					else{
						$('#modalLogin').slideUp('scale',function(){
							location.href= data.redirect_link;
						});						
					}
				}
				else{				
					$('#loading_login').hide(); $('#pesan_error_login').show(); $('#pesan_error_login').html(data.pesan);					 
				}
			},
			error : function(data) {
				$('#pesan_error_login').html('maaf telah terjadi kesalahan dalam program, silahkan anda mengakses halaman lainnya.'); $('#pesan_error_login').show(); $('#loading_login').hide();
				//$('#pesan_error').html( '<h3>Error Response : </h3><br>'+JSON.stringify( data ));
			}
		})
	}
});


$('#form_finish_design').validate({
	submitHandler: function(form) {	
	
		$.ajax({
			url: base_url+''+uri_1+'/add_data_finish_design',
			type:'POST',
			dataType:'json',
			data: $('#form_finish_design').serialize(),
			beforeSend: function(){	
				$('#loading_finish_design').show();
			},
			success: function(data){
				location.reload();
			},
			error : function(data) {
				alert(data);
				$('#loading_finish_design').hide();
				$('#pesan_error_finish_design').html('maaf telah terjadi kesalahan dalam program, silahkan anda mengakses halaman lainnya.');
			}
		})
	}	
});




$('#form_harga_barang').validate({
	submitHandler: function(form) {	
	
		if(parseInt($('#MIN_BARANG').val()) > parseInt($('#MAX_BARANG').val())){
			alert('Jumlah maximal harus lebih besar');
		}
		else{
	
			$.ajax({
				url: base_url+''+uri_1+'/add_data_harga_barang',
				type:'POST',
				dataType:'json',
				data: $('#form_harga_barang').serialize(),
				beforeSend: function(){	
					$('#loading_harga_barang').show();
				},
				success: function(data){
					if( data.status ){		
						location.reload();
					}
					else{				
						alert(data.pesan);	
						$('#loading_harga_barang').hide();
					}
				},
				error : function(data) {
					alert(data);
					$('#loading_harga_barang').hide();
				}
			})
		}
	}
	
});
/**
function keterangan_alur_order(){
	$('.main-footer').append('<div class="modal fade" id="container-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h4 class="modal-title" id="myModalLabel">Pesan Konfirmasi</h4></div><div class="modal-body"><ul>Jika anda memilih Kasir, maka WO akan dilanjutkan langsung menuju halaman menu kasir.<br>Contoh jika customer membeli Alat Banner saja.</ul><ol>Jika anda memilih OP Print &#10132; Kasir, maka WO akan dilanjutkan ke menu Operator Print. Setelah itu dari menu Operator Print dapat diteruskan menuju halaman menu kasir.<br>contoh : jika customer/pelanggan hanya membeli jasa Cetak tanpa proses Desain.</ol><ol>Jika anda memilih OP Grafis &#10132; Kasir, maka WO akan dilanjutkan ke menu Operator Grafis. Setelah itu dari menu Operator Grafis dapat diteruskan menuju halaman menu kasir.<br>contoh : jika customer/pelanggan hanya membeli jasa Desain tanpa proses printing.</ol><ol>Jika anda memilih OP Grafis &#10132; OP Print &#10132; Kasir, maka WO akan dilanjutkan ke menu Operator Grafis. Setelah itu dari menu Operator Grafis dapat diteruskan menuju halaman menu Operator Print.  Dari Operator Print dapat Diteruskan ke Kasir jika desain sudah Oke. Namun jika desain ada kesalahan dapat dikembalikan ke Menu Operator Desain.</ol></div><div class="modal-footer"><div class="pull-left"><button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button></div></div></div></div></div>');
	$('#container-modal').modal('show');
}**/

function keterangan_alur_order(){
	$('.main-footer').append('<div class="modal fade" id="container-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h4 class="modal-title" id="myModalLabel">Pesan Pemberitahuan</h4></div><div class="modal-body"><ol>Jika anda memilih OP Print &#10132; Kasir, maka WO akan dilanjutkan ke menu Operator Print. Setelah itu dari menu Operator Print dapat diteruskan menuju halaman menu kasir.<br>contoh : jika customer/pelanggan hanya membeli jasa Cetak tanpa proses Desain.</ol><ol>Jika anda memilih OP Grafis &#10132; OP Print &#10132; Kasir, maka WO akan dilanjutkan ke menu Operator Grafis. Setelah itu dari menu Operator Grafis dapat diteruskan menuju halaman menu Operator Print.  Dari Operator Print dapat Diteruskan ke Kasir jika desain sudah Oke. Namun jika desain ada kesalahan dapat dikembalikan ke Menu Operator Desain.</ol></div><div class="modal-footer"><div class="pull-left"><button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button></div></div></div></div></div>');
	$('#container-modal').modal('show');
}


function tampil_pesan_hapus(pesan_hapus,link_hapus){
	$('.main-footer').append('<div class="modal fade" id="container-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h4 class="modal-title" id="myModalLabel">Pesan Konfirmasi</h4></div><div class="modal-body">Apakah anda yakin akan menghapus data <b>'+pesan_hapus+'</b> ..?</div><div class="modal-footer"><div class="pull-left"><button type="button" class="btn btn-warning" data-dismiss="modal">Tidak</button></div><a href="'+link_hapus+'"> <button type="button" class="btn btn-primary">Ya</button></a></div></div></div></div>');
	$('#container-modal').modal('show');

}

function showModalLogOut(link){
	$('.main-footer').append('<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h4 class="modal-title" id="myModalLabel">Pesan Konfirmasi</h4></div><div class="modal-body">Apakah anda yakin akan keluar  ..?</div><div class="modal-footer"><div class="pull-left"><button type="button" class="btn btn-warning" data-dismiss="modal">Tidak</button></div><a href="'+link+'"> <button type="button" class="btn btn-primary">Ya</button></a></div></div></div></div>');
	$('#modalLogout').modal('show');

}

function checkAllDeleteButton(){
	if ($('#checkAllDelete').is(':checked')) {
		$('input:checkbox').prop('checked', true);
	}
	else{
		$('input:checkbox').prop('checked', false);
	}
}

$("#NAMA_KARYAWAN_AUTOCOMPLETE").autocomplete({
	source:base_url+'karyawan/search_karyawan/',
	select: function (e, ui) {
		$("#ID_KARYAWAN").val(ui.item.id_karyawan);
	}
});

$("#NAMA_BARANG_AUTOCOMPLETE").autocomplete({
	source:base_url+'barang/search_barang/',
	select: function (e, ui) {
		hilang_jumlah_barang_form();
		
		$("#JUMLAH_QTY_FORM").focus();
		$("#ID_BARANG_FORM").val(ui.item.id_barang);
		$("#SATUAN_BARANG_FORM").val(ui.item.satuan_barang);
	}
});


function tambah_barang(){
	
		$('#tabel_op_grafis').append('<tr id="tr_barang_'+$('#id_barang_grafis').val()+'">   <td>     <input type="hidden" name="ID_BARANG_GRAFIS[]" value="'+$('#id_barang_grafis').val()+'">  <input type="hidden" name="NAMA_BARANG_'+$('#id_barang_grafis').val()+'" value="'+$('#NAMA_BARANG_AUTOCOMPLETE').val()+'"> <input type="hidden" name="JUMLAH_QTY_'+$('#id_barang_grafis').val()+'" value="'+$('#JUMLAH_QTY_FORM').val()+'"> <input type="hidden" name="SATUAN_BARANG_'+$('#id_barang_grafis').val()+'" value="'+$('#SATUAN_BARANG_FORM').val()+'">    <input type="hidden" name="HARGA_QTY_'+$('#id_barang_grafis').val()+'" value="'+$('#HARGA_QTY_FORM').val()+'">    <input type="hidden" name="TOTAL_QTY_'+$('#id_barang_grafis').val()+'" value="'+$('#TOTAL_QTY_FORM').val()+'">                                                                                                                                                                                                                                                                      '+$('#NAMA_BARANG_AUTOCOMPLETE').val()+'</td><td>'+$('#JUMLAH_QTY_FORM').val()+'</td><td>'+$('#SATUAN_BARANG_FORM').val()+'</td><td  class="text-center" ><i class="fa fa-trash text-danger" onclick="hapus_barang('+$('#id_barang_grafis').val()+')"></i></td></tr>');
		
		//$('#tabel_op_grafis').append('<tr id="tr_barang_'+$('#id_kerja_grafis').val()+'"><td><input type="hidden" name="nama_barang[]" value="'+$('#NAMA_BARANG_AUTOCOMPLETE').val()+'">'+$('#NAMA_BARANG_AUTOCOMPLETE').val()+'</td><td>'+$('#JUMLAH_QTY_FORM').val()+'</td><td>'+$('#SATUAN_BARANG_FORM').val()+'</td><td  class="text-center" ><i class="fa fa-trash text-danger" onclick="hapus_barang('+$('#id_barang_grafis').val()+')"></i></td></tr>');
		
		var newId = parseInt($('#id_barang_grafis').val()) + 1;
		$('#id_barang_grafis').val(newId);
		
		$('#NAMA_BARANG_AUTOCOMPLETE').val('');
		$('#JUMLAH_QTY_FORM').val('');
		$('#SATUAN_BARANG_FORM').val('');
		$('#NAMA_BARANG_AUTOCOMPLETE').focus();
		

}
function hapus_barang(id){
	//alert(id);
	$("#tr_barang_" + id).remove();
}




function jenis_harga(){
	if($('#JENIS_HARGA').val()=='SAMA'){		
		$('#div_harga_satuan').show();
		$('#div_form_harga').hide();
		$('#HARGA_SATUAN').addClass('required');
	}
	else{
		$('#div_harga_satuan').hide();
		$('#div_form_harga').show();
		$('#HARGA_SATUAN').removeClass('required');
		$('#HARGA_SATUAN').val('');
	}
}

function search_member(){
	var hp = $('#HP_CUSTOMER').val();
	if(hp.length > 7){
		$.ajax({
			url: base_url+'customer/getDataByNoHP',
			type:'POST',
			dataType:'json',
			data: { no_hp : hp },	
			success: function(data){
				if(data.status){
					$('#div_pesan_member').html('<p class="text-success"><i class="fa fa-exclamation-triangle "></i>&nbsp; Member</p>');
					$('#NAMA_CUSTOMER').val(data.nama);
					$('#ALAMAT_CUSTOMER').val(data.alamat);
					
					$('#ID_CUSTOMER').val(data.id_customer);
					$('#LOG_MEMBER').val('Y');
					
					$('#NAMA_CUSTOMER').prop('readonly', true);
					$('#ALAMAT_CUSTOMER').prop('readonly', true);
				}
				else{
					$('#div_pesan_member').html(' <p class="text-danger"><i class="fa fa-exclamation-triangle "></i>&nbsp; Bukan Member</p>');
					$('#NAMA_CUSTOMER').val('');
					$('#ALAMAT_CUSTOMER').val('');
					$('#NAMA_CUSTOMER').prop('readonly', false);
					$('#ALAMAT_CUSTOMER').prop('readonly', false);
					$('#ID_CUSTOMER').val('');
					$('#LOG_MEMBER').val('N');
				}
			}
		})
		
	}

}

function hitung_harga_barang(){
	
	$.ajax({
		url: base_url+'barang/get_data_harga',
		type:'POST',
		dataType:'json',
		data: { id_barang : $('#ID_BARANG_FORM').val() , jumlah : $('#JUMLAH_QTY_FORM').val() },	
		success: function(data){
			if(data.status){
				
				var total = parseInt($('#JUMLAH_QTY_FORM').val()) *  parseInt(data.harga_qty);				
				
				$('#HARGA_QTY_FORM').val(data.harga_qty);
				$('#TOTAL_QTY_FORM').val(total);
				
			}
			else{
				alert('Not Found !');
			}
		}
	})
	
	
}

function hilang_jumlah_barang_form(){
	$('#JUMLAH_QTY_FORM').val('') ;
	$('#ID_BARANG_FORM').val('') ;
	$('#HARGA_SATUAN_FORM').val('') ;
	$('#TOTAL_HARGA_FORM').val('') ;
	$('#harga_barang').html('');
	$("#satuan_barang").html("");
	
}


function hitung_discount(){
	
	
	
	var totalBayar = parseInt($('#harga_total').val()) - parseInt($('#DISCOUNT').val());
	
	$('#TOTAL_BAYAR').val(totalBayar);
	$('#total_bayar_rp').html(toRp(totalBayar));
}

function ganti_harga_jumlah_kasir(id,jumlah_barang){ 
	
	var total = parseInt($('#JUMLAH_QTY_'+id).val()) * parseInt($('#HARGA_SATUAN_'+id).val());	
	$('#TOTAL_HARGA_'+id).val(total);
	
	var total_harga =  0 ;
	for (i = 1; i <= jumlah_barang; i++) {		
		var harga = parseInt($('#TOTAL_HARGA_'+i).val());		
		total_harga +=  harga;		
		
	} 
	
	$('#harga_total').val(total_harga);
	$('#text_harga_total').html(toRp(total_harga));
	
	
	$('#TOTAL_BAYAR').val(total_harga);
	$('#total_bayar_rp').html(toRp(total_harga));
	
	
}



