<?php require 'head.view.php'; ?>
<div id="wrap">
    <div class="grid-container">
        <?php require 'gallery-navbar.view.php'; ?>
        <?php foreach ($imgs as $src) : ?>
        <a class="w3-light-grey w3-btn" href='/assets/img/<?= $src ?>' data-lightbox='<?= $name ?>'><img src="/assets/thumb/<?= $src ?>" alt="" class='w3-padding'></a>
        <?php endforeach; ?>
    </div>
    <?php require 'upload-dialog.view.php' ?>
</div>
<script src="/js/Upload.js"></script>
<script>
    $(document).ready(function(){
        Upload.init($('#wrap'))
    })
</script>