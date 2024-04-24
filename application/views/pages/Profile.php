<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section>
    <header>
        <h1>Profile Pages</h1>
    </header>
    <div class="form_container">
        <div class="profile">
            <h2>Welcome <?= $user['name']; ?></h2>
            <p>Email: <?= $user['email']; ?></p>
            <img src="<?= base_url('assets/images/profile/' . $user['profile_picture']) ?>" width="200" height="200"
                alt="<?= $user['name'] ?>">
            <a class="button" href="<?= site_url('login/logout'); ?>">Logout</a>
        </div>
    </div>
</section>