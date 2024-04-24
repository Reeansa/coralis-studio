<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if ($this->session->flashdata('success')): ?>
    <div id="flash" class="alert_success">
        <p><?= $this->session->flashdata('success') ?></p>
    </div>
<?php elseif ($this->session->flashdata('error')): ?>
    <div id="flash" class="alert_error">
        <p><?= $this->session->flashdata('error') ?></p>
    </div>
<?php endif; ?>
<section>
    <header style="display: flex; gap: 20px; align-items: center;">
        <a href="<?= site_url('login') ?>">🔙</a>
        <h1>Coralis Studio</h1>
    </header>
    <form class="form_container" action="<?= site_url('settings/forgot_password') ?>" method="post">
    <header>
        <h1>Reset Password</h1>
    </header>
        <div class="input_box">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
        </div>
        <div class="input_submit">
            <button class="button" type="submit">Send Email</button>
            <p>dont have a account? <a href="<?= site_url('register') ?>">register</a></p>
        </div>
    </form>
</section>