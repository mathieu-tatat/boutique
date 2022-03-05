<?php if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) : ?>
    <div>
        <?php foreach ($_SESSION['errors'] as $error) : ?>
            <h5 class="text-center text-danger"><?= $error ?></h5>
        <?php endforeach ?>
    </div>
<?php  endif; ?>