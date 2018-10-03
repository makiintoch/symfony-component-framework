<?php $title = "Home Controller" ?>

<?php ob_start() ?>
    <h1>Controller: <?=$controller?></h1>
    <h2>Action: <?=$action?></h2>
<?php $content = ob_get_clean() ?>

<?php include __DIR__.'/../base.php' ?>