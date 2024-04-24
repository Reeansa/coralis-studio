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
    <header>
        <h1>Coralis Studio</h1>
    </header>
    <form class="form_container" action="<?= site_url('login/process') ?>" method="POST">
        <div class="input_box">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
        </div>
        <div class="input_box">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="input_submit">
            <button class="button" type="submit">Login</button>
            <a href="<?= site_url('settings') ?>">forgot password?</a>
            <p>dont have a account? <a href="<?= site_url('register') ?>">register</a></p>
        </div>
    </form>
</section>