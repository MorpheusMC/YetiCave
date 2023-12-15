<?php
$is_auth = rand(0, 1);

$user_name = 'Фарид'; // укажите здесь ваше имя

$categories = [
    'boards' => 'Доски и лыжи',
    'attachment' => 'Крепления',
    'boots' => 'Ботинки',
    'clothing' => 'Одежда',
    'tools' => 'Инструменты',
    'other' => 'Разное'
];

$goods = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'project' => $categories['boards'],
        'price' => '10999',
        'url_img' => 'img/lot-1.jpg',
        'date_finish'=>'2023-11-07'
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'project' => $categories['boards'],
        'price' => '159999',
        'url_img' => 'img/lot-2.jpg',
        'date_finish'=>'2023-11-08'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'project' => $categories['attachment'],
        'price' => '8000',
        'url_img' => 'img/lot-3.jpg',
        'date_finish'=>'2023-11-09'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'project' => $categories['boots'],
        'price' => 10999,
        'url_img' => 'img/lot-4.jpg',
        'date_finish'=>'2023-11-10'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'project' => $categories['clothing'],
        'price' => '7500',
        'url_img' => 'img/lot-5.jpg',
        'date_finish'=>'2023-11-06'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'project' => $categories['other'],
        'price' => '5400',
        'url_img' => 'img/lot-6.jpg',
        'date_finish'=>'2023-11-05'
    ],
];