<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Uid\Uuid;

$connectionParams = [
    'url' => 'postgres://postgres:postgres@postgres/sensorario',
];

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

$conn->executeStatement('drop table idee_nuovi_video');

$conn->executeStatement('
    create table if not exists idee_nuovi_video (
        id varchar(36) not null,
        titolo varchar(255) not null
    );
');

$conn->executeStatement('delete from idee_nuovi_video;');

$idee = [];
$idee[] = 'composer';
$idee[] = 'test driven development';
$idee[] = 'versionamento semantico';
$idee[] = 'symfony';
$idee[] = 'laravel';
$idee[] = 'yii';
$idee[] = 'oop';
$idee[] = 'design patterns';
$idee[] = 'principi solid';
$idee[] = 'makefile';
$idee[] = 'creare un template engine from scratch';
$idee[] = 'creare un router from scratch';
$idee[] = 'creare un mvc from scratch';
$idee[] = 'value objects';
$idee[] = 'aggiungere un client angular';
$idee[] = 'aggiungere un client react';

foreach($idee as $idea) {
    $stmt = $conn->prepare("insert into idee_nuovi_video (id, titolo) values (:id, :idea);");
    $stmt->bindValue('id', Uuid::v4()->toRfc4122());
    $stmt->bindValue('idea', $idea);
    $stmt->execute();
}

$result = $conn->query('select * from idee_nuovi_video');
$idee = $result->fetchAllAssociative();
foreach($idee as $key => $value) {
    $titolo = $value['titolo'];
    $id = $value['id'];
    echo <<<HTML
        <li>$id > $titolo</li>
    HTML;
}
