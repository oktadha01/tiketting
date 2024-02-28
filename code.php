<style>
    /* body {
        text-align: center;
        background: #00ECB9;
        font-family: sans-serif;
        font-weight: 100;
    }

    h1 {
        color: #396;
        font-weight: 100;
        font-size: 40px;
        margin: 25vh 0px 20px;
    }

    .clockdiv {
        font-family: sans-serif;
        color: #fff;
        display: block;
        font-weight: 100;
        text-align: center;
        font-size: 30px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .clockdiv>div {
        padding: 15px;
        border-radius: 3px;
        background: #00BF96;
        margin: 10px;
        width: 90px;
    }

    .clockdiv div>span {
        padding: 15px;
        font-size: 22px;
        border-radius: 3px;
        background: #00816A;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
    }

    .smalltext {
        margin-top: 10px;
        font-size: 13px;
    } */
</style>
<h1>Countdown</h1>
<!-- <div class="col-lg-4 col-md-4 col-12">
    <div style="display:grid;">

        <span class="smal">Menunggu Pembayaran</span>
        <div class="clockdiv" data-date="02-27-2024 12:00:00">
            <div>
                <span class="days"></span>
                <div class="smalltext">days</div>
            </div>
            <div>
                <span class="hours"></span>
                <div class="smalltext">hours</div>
            </div>
            <div>
                <span class="minutes"></span>
                <div class="smalltext">minutes</div>
            </div>
            <div>
                <span class="seconds"></span>
                <div class="smalltext">seconds</div>
            </div>
        </div>
    </div>
</div> -->
<!-- <div class="clockdiv" data-date="December 22, 2021 18:22:23">
    <div>
        <span class="days"></span>
        <div class="smalltext">days</div>
    </div>
    <div>
        <span class="hours"></span>
        <div class="smalltext">hours</div>
    </div>
    <div>
        <span class="minutes"></span>
        <div class="smalltext">minutes</div>
    </div>
    <div>
        <span class="seconds"></span>
        <div class="smalltext">seconds</div>
    </div>
</div>
<div class="clockdiv" data-date="December 22, 2020 12:55:11">
    <div>
        <span class="days"></span>
        <div class="smalltext">days</div>
    </div>
    <div>
        <span class="hours"></span>
        <div class="smalltext">hours</div>
    </div>
    <div>
        <span class="minutes"></span>
        <div class="smalltext">minutes</div>
    </div>
    <div>
        <span class="seconds"></span>
        <div class="smalltext">seconds</div>
    </div>
</div>
<div class="clockdiv" data-date="02-27-2024 12:00:00">
    <div>
        <span class="days"></span>
        <div class="smalltext">days</div>
    </div>
    <div>
        <span class="hours"></span>
        <div class="smalltext">hours</div>
    </div>
    <div>
        <span class="minutes"></span>
        <div class="smalltext">minutes</div>
    </div>
    <div>
        <span class="seconds"></span>
        <div class="smalltext">seconds</div>
    </div>
</div> -->
<script>
    document.addEventListener('readystatechange', event => {
        if (event.target.readyState === "complete") {
            var clockdiv = document.getElementsByClassName("clockdiv");
            var countDownDate = new Array();
            for (var i = 0; i < clockdiv.length; i++) {
                countDownDate[i] = new Array();
                countDownDate[i]['el'] = clockdiv[i];
                countDownDate[i]['time'] = new Date(clockdiv[i].getAttribute('data-date')).getTime();
                countDownDate[i]['days'] = 0;
                countDownDate[i]['hours'] = 0;
                countDownDate[i]['seconds'] = 0;
                countDownDate[i]['minutes'] = 0;
            }

            var countdownfunction = setInterval(function() {
                for (var i = 0; i < countDownDate.length; i++) {
                    var now = new Date().getTime();
                    var distance = countDownDate[i]['time'] - now;
                    countDownDate[i]['days'] = Math.floor(distance / (1000 * 60 * 60 * 24));
                    countDownDate[i]['hours'] = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    countDownDate[i]['minutes'] = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    countDownDate[i]['seconds'] = Math.floor((distance % (1000 * 60)) / 1000);

                    if (distance < 0) {
                        countDownDate[i]['el'].querySelector('.days').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.hours').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.minutes').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.seconds').innerHTML = 0;
                    } else {
                        countDownDate[i]['el'].querySelector('.days').innerHTML = countDownDate[i]['days'];
                        countDownDate[i]['el'].querySelector('.hours').innerHTML = countDownDate[i]['hours'];
                        countDownDate[i]['el'].querySelector('.minutes').innerHTML = countDownDate[i]['minutes'];
                        countDownDate[i]['el'].querySelector('.seconds').innerHTML = countDownDate[i]['seconds'];
                    }

                }
            }, 1000);
        }
    });
</script>