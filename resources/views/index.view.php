<!DOCTYPE html>
<html lang="en">
    <?php echo $renderer->render('header',["name"=>$name]) ?>
<body>
    <b>name : </b><?php e($name) ?> <br>
    <b>id : </b><?php e($id) ?> <br>
    <b>db name : </b><?php echo getenv('DB_NAME') ?>
</body>
</html>
