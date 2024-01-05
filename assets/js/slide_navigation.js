$('#data-transaksi').hide();
$('.t-top').click(function () {
	$('.top').toggleClass('active');
	$('#data-transaksi').show();
});
$('.close-top').click(function () {
	$('.top').toggleClass('active');
	$('#data-transaksi').hide();
});
$('.t-left').click(function () {
	$('.left').toggleClass('active');
});
$('.t-right').click(function () {
	$('.right').toggleClass('active');
});
$('.t-bottom').click(function () {
	$('.bottom').toggleClass('active');
});
