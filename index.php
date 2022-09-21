<?php

require 'vendor/autoload.php';

$api = new Src\ApiService();

//получение ресурсов по пользователю
$api->getUsers([1]);
$api->getUsers([2,3]);
$api->getUsers();

$api->getPosts([1]);
$api->getPosts([2,3]);
$api->getPosts();

$api->getTasks([1]);
$api->getTasks([2,3]);
$api->getTasks();

//создание поста
$api->post('create', [
    'title' => 'New post',
    'body' => 'text',
    'userId' => 90
]);
//изменение поста
$api->post('update', [
    'id' => '4',
    'title' => 'new title',
]);
//удаление поста
$api->post('delete', [
    'id' => '4',

]);
