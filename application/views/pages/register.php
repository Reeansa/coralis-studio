<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section>
    <header>
        <h1>Coralis Studio</h1>
    </header>
    <form class="form_container" action="<?= site_url('register/process') ?>" method="post" enctype="multipart/form-data">
        <div class="input_box">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
        </div>
        <div class="input_box">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="input_box">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="input_box">
            <label for="profile_picture">Photo Profile</label>
            <input type="file" name="profile_picture" id="profile_picture" required>
        </div>
        <div class="input_submit">
            <button class="button" type="submit">Register</button>
            <p>have a account? <a href="<?= site_url('login') ?>">login</a></p>
        </div>
    </form>
</section>