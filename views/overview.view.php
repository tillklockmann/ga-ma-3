<?php require 'head.view.php'; ?>
<div id="wrap">
    <div class="grid-container">
        <?php require 'gallery-navbar.view.php'; ?>
        <?php foreach($galleries as $name => $img) : ?>
        
                <a href="/gallery/<?= urlencode($name) ?>" class="w3-btn w3-light-grey gallery-thumb ">
                    <div class="img-card w3-opacity w3-hover-opacity-off">
                    <img src="assets/thumb/<?= $img ?>" alt="<?= $name ?>" class="fg-thumb">
                    <img src="assets/thumb/<?= $img ?>" alt="<?= $name ?>" class="bg-thumb w3-grayscale-max">
                    </div>
                    
                    <div class="w3-container w3-center card-name">
                        <span><?= $name ?></span>
                    </div>
                </a>
        <?php endforeach; ?>
    </div>
    <?php require 'new-folder-dialog.view.php' ?>
</div>
<script src="/js/NewFolder.js"></script>
<script>
    $(document).ready(function(){
        NewFolder.init($('#wrap'))
    })
</script>