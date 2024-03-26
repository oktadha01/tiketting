<style>
    .title {
        font-size: 2.2rem;
        color: #444;
        margin-bottom: 10px;
    }

    .input-field {
        max-width: 380px;
        width: 100%;
        background-color: #f0f0f0;
        margin: 10px 0;
        height: 55px;
        border-radius: 55px;
        display: grid;
        grid-template-columns: 15% 85%;
        padding: 0 0.4rem;
        position: relative;
    }

    .input-field i {
        text-align: center;
        line-height: 55px;
        color: #acacac;
        transition: 0.5s;
        font-size: 1.1rem;
    }

    .toggle-password {
        color: #0047BA;
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }

    .input-field input {
        background: none;
        outline: none;
        border: none;
        line-height: 1;
        font-weight: 600;
        font-size: 1.1rem;
        color: #333;
        width: max-content;
        padding-left: 2rem;
    }

    .input-field input::placeholder {
        color: #aaa;
        font-weight: 500;
    }

    .tittle-haeder-card {
        background: #0047ba;
        color: white;
        font-weight: bold;
        font-size: larger;
        text-align: center;
    }
</style>
<section class="container " style="margin-top: 6rem;height: 100%;margin-bottom: 5rem; text-align: -webkit-center;">
    <div class="card box-shadow" style="max-width: 26rem;">
        <div class="card-header tittle-haeder-card">
            <span>Atur kata sandi baru</span>
        </div>
        <div class="card-body">
            <div class="input-field form-login">
                <input type="password" placeholder="Password" id="password" name="password" required="" autofocus="" autocomplete="current-password">
                <i class="toggle-password fa fa-eye" onclick="togglePasswordVisibility('password')" aria-hidden="true"></i>
            </div>
            <button id="btn-submit-c-pass" class="btn btn-primary mb-4 mt-2 float-right">Submit</button>
        </div>
    </div>
</section>