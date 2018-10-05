<?php $title = "Error Controller" ?>

<?php ob_start() ?>
    <h1><?=$error?></h1>
<?php $content = ob_get_clean() ?>

<?php include __DIR__.'/../base.php' ?>