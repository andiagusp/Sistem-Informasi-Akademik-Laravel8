$('.custom-file-input').on('change', function() {
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass("selected").html(fileName);
 });

$(function (){

	$('.modal-daftar').on('click', function (){
		
		const daftar = $(this).data('daftar');
		const nama = $(this).data('nama');
		const foto = $(this).data('foto');

		$('#modal-title-bayar').html(nama+' '+daftar);
		$('.modal-daftar-bayar').attr('src', 'http://localhost/s/assets/img/upload/'+foto);

	});

});