# FeedRss Simple Generate 

[![Maintainer](http://img.shields.io/badge/maintainer-@whallysson-blue.svg?style=flat-square)](https://twitter.com/whallysson)
[![Source Code](http://img.shields.io/badge/source-codeblog/feedrssgenerate-blue.svg?style=flat-square)](https://github.com/whallysson/feedrss-generate)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/codeblog/feedrss-generate.svg?style=flat-square)](https://packagist.org/packages/codeblog/feedrss-generate)
[![Latest Version](https://img.shields.io/github/release/whallysson/feedrss-generate.svg?style=flat-square)](https://github.com/whallysson/feedrss-generate/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/whallysson/feedrss-generate.svg?style=flat-square)](https://scrutinizer-ci.com/g/whallysson/feedrss-generate)
[![Quality Score](https://img.shields.io/scrutinizer/g/whallysson/feedrss-generate.svg?style=flat-square)](https://scrutinizer-ci.com/g/whallysson/feedrss-generate)
[![Total Downloads](https://img.shields.io/packagist/dt/codeblog/feedrss-generate.svg?style=flat-square)](https://packagist.org/packages/codeblog/feedrss-generate)

###### FeedRss is a simple component that helps in creating rss feeds, where it generates an xml file for the engines. The same can also be used for Facebook Ads and Google Merchant.

FeedRss é um componente simples que auxilia na criação de feeds rss, onde gera um arquivo xml para os mecanismos. O mesmo também pode ser usado para Facebook Ads e Google Merchant.


### Highlights

- Simple installation (Instalação simples)
- Simplified rss feed creation (Criação de feed rss simplificada)
- Can be used with Facebook ADS (Pode ser usada com o Facebook ADS)
- Can be used with Google Merchant (Pode ser usada com o Google Merchant)

## Installation

FeedRss is available via Composer:

```bash
"codeblog/feedrss-generate": "^1.0"
```

or run

```bash
composer require codeblog/feedrss-generate
```

## Documentation

###### For details on how to use, see a sample folder in the component directory. In it you will have an example of use for each class. It works like this:

Para mais detalhes sobre como usar, veja uma pasta de exemplo no diretório do componente. Nela terá um exemplo de uso para cada classe. Ele funciona assim:

#### Create FeedRss simple:

```php
<?php

require 'vendor/autoload.php';

use CodeBlog\FeedRss\FeedRss;

$feed = new FeedRss();
$feed->setChannel(
    'CodeBlog - Fique sempre atualizado',
    'https://www.codeblog.com.br/',
    'Blog desenvolvido para passar informações sobre Tecnologia, Games, Programação e Entreterimento!'
);

$items = [
    [
        'title' => 'Mouse Gamer de última geração',
        'description' => 'Mouse Gamer de última geração',
        'publication' => '2020-12-31 23:10:21',
        'link' => 'https://meusite.com/prouto/mouse-top',
        'image' => [
            'url' => 'https://www.codeblog.com.br/themes/codeblog/assets/images/CodeBlogLogo.png',
            'title' => 'Mouse gamer de última geração com alta qualidade'
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
        ]
    ]
];

$feed->renderRss($items);
```

#### Create FeedRss with Facebook Ads and Google Merchant:
###### You must pass the parameters "facebook_ads" and "google_merchant" as an array each.
Você deve passar os parametros "facebook_ads" e "google_merchant" como um array cada.

```php
<?php

require 'vendor/autoload.php';

use CodeBlog\FeedRss\FeedRss;

$feed = new FeedRss(true, true);
$feed->setChannel(
    'CodeBlog - Fique sempre atualizado',
    'https://www.codeblog.com.br/',
    'Blog desenvolvido para passar informações sobre Tecnologia, Games, Programação e Entreterimento!'
);

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
];

$feed->renderRss($items);
```


## Contributing

Please see [CONTRIBUTING](https://github.com/whallysson/feedrss-generate/blob/master/CONTRIBUTING.md) for details.

## Support

###### Security: If you discover any security related issues, please email whallysson.dev@gmail.com instead of using the issue tracker.

Se você descobrir algum problema relacionado à segurança, envie um e-mail para whallysson.dev@gmail.com em vez de usar o rastreador de problemas.

Thank you

## Credits

- [Whallysson Avelino](https://github.com/whallysson) (Developer)
- [CodBlog](https://github.com/whallysson) (Team)
- [All Contributors](https://github.com/whallysson/feedrss-generate/contributors) (This Rock)

## License

The MIT License (MIT). Please see [License File](https://github.com/whallysson/feedrss-generate/blob/master/LICENSE) for more information.
