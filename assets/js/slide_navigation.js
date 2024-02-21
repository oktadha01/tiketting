cekTipePerangkat();

$('#load-data-navi').hide();

function cekTipePerangkat() {
	// Mendapatkan lebar jendela saat ini
	var lebarJendela = window.innerWidth;

	// Tentukan batas lebar untuk mobile
	var batasMobile = 600; // Anda dapat menyesuaikan angka ini sesuai kebutuhan

	// Cek apakah lebar jendela kurang dari batasMobile
	if (lebarJendela < batasMobile) {
		// Kondisi untuk perangkat mobile
		console.log('Perangkat Mobile');
		$('#navigasi').addClass('bottom').removeClass('top');
		$('.btn-navigasi').attr('data-nav', 'bottom');
		// Lakukan tindakan untuk perangkat mobile di sini
	} else {
		// Kondisi untuk perangkat desktop
		console.log('Perangkat Desktop');
		$('#navigasi').removeClass('bottom').addClass('top');
		$('.btn-navigasi').attr('data-nav', 'top');
		// Lakukan tindakan untuk perangkat desktop di sini
	}
}

$('.btn-navigasi').click(function () {
	
	if ($(this).data('menu') == $('#span-text-navi').text()) {
		$('#navigasi').removeClass('nav-active');
		$('#span-text-navi').text('');
	} else {
		if ($(this).data('nav') == 'top') {
			$('#eventclick').val('menu-navi');
			if ($('#navigasi').attr('class') == 'nav top') {
				$('#navigasi').toggleClass('nav-active');
			}
			$('#load-data-navi').show();
			if ($(this).data('menu') == 'Transaksi') {
				transaksi();
				$('#span-text-navi').text('Transaksi')
			} else {
				tiket();
				$('#span-text-navi').text('Tiket')
			}
		} else {
			$('#eventclick').val('menu-navi');
			if ($('#navigasi').attr('class') == 'nav bottom') {
				$('#navigasi').toggleClass('nav-active');
			}
			$('#load-data-navi').show();
			if ($(this).data('menu') == 'Transaksi') {
				transaksi();
				$('#span-text-navi').text('Transaksi');
			} else {
				tiket();
				$('#span-text-navi').text('Tiket');
			}
		}
	}

});
$('.close-top').click(function () {
	$('#eventclick').val('');
	$('#load-data-navi').html('').hide();
	$('.top').toggleClass('nav-active');
	$('.bottom').toggleClass('nav-active');
	$('.menu-link').removeClass('is-active');
	$('#span-text-navi').text('');
});
$('.btn-user').click(function () {
	// alert(';')
	$('#navigasi').removeClass('nav-active');
})

function transaksi() {
	$.ajax({
		url: url_transaksi,
		cache: false,
		processData: false,
		contentType: false,
		success: function (data) {
			$('#load-data-navi').html(data);
			btn_detail_trans();

		},
		error: function () {
			alert("Data Gagal Diupload");
		}
	});
};

function btn_detail_trans() {
	$('.btn-detail-trans-m').click(function () {
		let formData = new FormData();
		formData.append('code_bayar', $(this).data('cb'));
		$.ajax({
			type: 'POST',
			url: url_detail_trans,
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
				$('#load-data-detail-trans-m').html(data);
				batalkan_transaksi();
			},
			error: function () {
				alert("Data Gagal Diupload");
			}
		});
	});
}

function batalkan_transaksi() {
	$('.btn-btl-trans').click(function () {
		let formData = new FormData();
		formData.append('code-bayar', $('#del-code_transaksi').val());
		$.ajax({
			type: 'POST',
			url: url + 'Transaction/batalkan_transaksi',
			// url: "<?php echo site_url('Transaction/batalkan_transaksi'); ?>",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
				transaksi();
			},
			error: function () {
				alert("Data Gagal Diupload");
			}
		});
	})
}

function tiket() {
	$.ajax({
		url: url_tiket,
		cache: false,
		processData: false,
		contentType: false,
		success: function (data) {
			$('#load-data-navi').html(data);
			download_e_tiket();
			btn_detail_e_tiket();
			$('.detail-e-tiket').click(function () {
				$('#nm-e-tiket').text('E-Tiket - ' + $(this).data('event'))
			});
		},
		error: function () {
			alert("Data Gagal Diupload");
		}
	});
};


function btn_detail_e_tiket() {
	$('.detail-e-tiket').click(function () {
		// $('#detail-qr-m').attr('src', url_qr + 'qr-' + $(this).data('file') + '.png');
		$('#btn-download-m').attr('data-file', $(this).data('file')).attr('data-link', $(this).data('link'));

		let formData = new FormData();
		formData.append('code_tiket', $(this).data('file'));
		$.ajax({
			type: 'POST',
			url: url_detail_tiket,
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
				$('#load-data-detail-tiket-m').html(data);
				// download_e_tiket();
			},
			error: function () {
				alert("Data Gagal Diupload");
			}
		});
	});

	$('#btn-close-modal-tiket').click(function () {
		$('#load-data-detail-tiket-m').html('');
		$('#btn-download-m').removeAttr('data-file').removeAttr('data-link');
	});
}

function download_e_tiket() {
	$('.download-file').click(function () {
		// Replace 'path/to/your/file.pdf' with the actual path to your PDF file

		var pdfFilePath = url_download_tiket + 'pdf-' + $(this).data('file') + '.pdf';

		// Create a temporary anchor element
		var link = document.createElement('a');
		link.href = pdfFilePath;

		// Set the download attribute with the desired file name
		link.download = $(this).data('link') + '.pdf';

		// Append the anchor element to the document
		document.body.appendChild(link);

		// Trigger a click event on the anchor element to start the download
		link.click();

		// Remove the anchor element from the document
		document.body.removeChild(link);
		$('#btn-download-m').removeAttr('data-file').removeAttr('data-link');
	});
}



// $('.t-left').click(function () {
// 	$('.left').toggleClass('nav-active');
// });
