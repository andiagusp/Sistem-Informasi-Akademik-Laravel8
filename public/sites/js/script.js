$(function (){
	
	$('.tampilLayar').on('click', function (){

		const foto = $(this).data('foto');
		const nama = $(this).data('nama');
		const daftar = $(this).data('daftar');

		$('#modal-popupimg').html('Foto Pembayaran ' + nama);
		$('.img-bayar').attr('src', 'http://localhost/s/assets/img/upload/'+foto);
	});

});




