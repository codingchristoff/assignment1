
<?php require('view/template/header.phtml'); ?>

<?php

$password = '123456';

//$hash = password_hash($password,PASSWORD_DEFAULT);

$hash = '$2y$10$PgxdeX2b9C/iFwCDV25cJuG5uTEKsW.v2PrO1k8pZQjl8MB6pMshG';

echo var_dump($hash);

$verify = password_verify('123456', $hash);

echo "hello" . var_dump($verify); ?>

<?php require('view/template/footer.phtml'); ?>
