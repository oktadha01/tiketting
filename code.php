<center>
    <h1 id="demo" style="font-family: fantasy; letter-spacing: 2px;"></h1>
    <?php
    $currentDateTime = date($data->tgl_transaksi);
    $newDateTime = date('m-d-Y H:i:s', strtotime($currentDateTime . ' +1 hours'));

    $dateString = $newDateTime;
    $date = DateTime::createFromFormat('n-j-Y H:i:s', $dateString);

    if ($date !== false) {
        // Format tanggal sebagai bulan
        $formattedDate = $date->format('M d, Y');

        // Format jam
        $formattedTime = $date->format('H:i:s');

        // Output dengan pemisah antara tanggal dan jam
        // echo $formattedDate . ' | ' . $formattedTime;
    } else {
        echo 'Format tanggal tidak valid';
    }
    ?>
    <h6>Payment limit <?= $formattedDate . ' | ' . $formattedTime; ?></h6>
    <input type="text" id="batas-waktu" value="<?= $newDateTime; ?>" hidden>
</center>
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