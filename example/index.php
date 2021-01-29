<?php

require __DIR__ . '/../vendor/autoload.php';

use CodeBlog\FeedRss\FeedRss;

$items = [
    [
        'title' => 'Mouse Gamer de última geração',
        'description' => 'Mouse Gamer de última geração',
        'publication' => '2020-12-31 23:10:59',
        'link' => 'https://meusite.com/prouto/mouse-top',
        'image' => [
            'url' => 'https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png',
            'title' => 'Mouse gamer de última geração com alta qualidade'
        ],

        // FACEBOOK ADS
        'facebook_ads' => [
            'id' => 'product_01',
            'image_link' => 'https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png',
            'condition' => 'new',
            'price' => '89.89',
            'availability' => 'in stock',
            'brand' => 'Gapto',
            'google_product_category' => '166',
            // other necessary parameters
        ],

        // GOOGLE MERCHANT
        'google_merchant' => [
            'gtin' => '3234567890126',
            // other necessary parameters
        ]
    ],

    [
        'title' => 'Teclado Gamer de última geração',
        'description' => 'Teclado Gamer de última geração',
        'publication' => '2020-12-27 13:10:00',
        'link' => 'https://meusite.com/prouto/teclado-top',
        'image' => [
            'url' => 'https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png',
            'title' => 'Teclado gamer mecânico de última geração'
        ],

        // FACEBOOK ADS
        'facebook_ads' => [
            'id' => 'product_02',
            'image_link' => 'https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png',
            'condition' => 'new',
            'price' => '154.35',
            'availability' => 'in stock',
            'brand' => 'Full Moll',
            'google_product_category' => '166',
            // other necessary parameters
        ],

        // GOOGLE MERCHANT
        'google_merchant' => [
            'gtin' => '3234567890888',
            // other necessary parameters
        ],
    ],

    [
        'title' => 'Monitor gamer ultra-wide',
        'description' => 'Monitor gamer ultra-wide',
        'publication' => '2021-01-01 15:10:59',
        'link' => 'https://meusite.com/prouto/monitor-ultra-wide',
        'image' => [
            'url' => 'https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png',
            'title' => 'Monitor games ultra-wide de última geração'
        ],

        // FACEBOOK ADS
        'facebook_ads' => [
            'id' => 'product_03',
            'image_link' => 'https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png',
            'condition' => 'new',
            'price' => '1575.14',
            'availability' => 'in stock',
            'brand' => 'Zup Lapto',
            'google_product_category' => '166',
            // other necessary parameters
        ],

        // GOOGLE MERCHANT
        'google_merchant' => [
            'gtin' => '3234567890741',
            // other necessary parameters
        ],
    ],

    [
        'title' => 'Headset 7.1 com alta definição',
        'description' => 'Headset 7.1 com alta definição',
        'publication' => '2021-01-10 12:35:20',
        'link' => 'https://meusite.com/prouto/headset-71',
        'image' => [
            'url' => 'https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png',
            'title' => 'Headset para jogos e filmes'
        ],

        // FACEBOOK ADS
        'facebook_ads' => [
            'id' => 'product_04',
            'image_link' => 'https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png',
            'condition' => 'new',
            'price' => '358.87',
            'availability' => 'in stock',
            'brand' => 'Zengo Trez',
            'google_product_category' => '166',
            // other necessary parameters
        ],

        // GOOGLE MERCHANT
        'google_merchant' => [
            'gtin' => '3234567890128',
            // other necessary parameters
        ],
    ],

    [
        'title' => 'Gabinete Gamer colorido com neon',
        'description' => 'Gabinete Gamer colorido com neon',
        'publication' => '2021-01-13 10:10:59',
        'link' => 'https://meusite.com/prouto/gabinete-gamer',
        'image' => [
            'url' => 'https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png',
            'title' => 'Gabinete Game colorido com muitos neons'
        ],

        // FACEBOOK ADS
        'facebook_ads' => [
            'id' => 'product_05',
            'image_link' => 'https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png',
            'condition' => 'new',
            'price' => '864.25',
            'availability' => 'in stock',
            'brand' => 'Hertz Electro',
            'google_product_category' => '166',
            // other necessary parameters
        ],

        // GOOGLE MERCHANT
        'google_merchant' => [
            'gtin' => '3234567890444',
            // other necessary parameters
        ],
    ],

];


$feed = new FeedRss(true, true);
$feed->setChannel(
    'CodeBlog - Fique sempre atualizado',
    'https://www.codeblog.com.br/',
    'Blog desenvolvido para passar informações sobre Tecnologia, Games, Programação e Entreterimento!'
);
$feed->setChannelImage('https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png');

$feed->renderRss($items);
