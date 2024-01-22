<script>
    $(document).ready(function() {
        // Set the date we're counting down to
        var tgl_transaksi = $('#batas-waktu').val();
        // var tgl_transaksi = '01-08-2024 11:30:49'

        var end = new Date(tgl_transaksi);
        var _second = 1000;
        var _minute = _second * 60;
        var _hour = _minute * 60;
        var _day = _hour * 24;
        var timer;

        function showRemaining() {
            var now = new Date();
            var distance = end - now;
            var days = Math.floor(distance / _day);
            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);

            document.getElementById("demo").innerHTML = "00:" + minutes + ":" + seconds;

            if (distance < 0) {
                clearInterval(timer);
                document.getElementById("demo").innerHTML = "EXPIRED!";
                delete_tagihan();
                return;
            }
        }
        timer = setInterval(showRemaining, 1000);

        
    });
</script>