# Siteation - Hyva Icon Pack - FeatherIcons

[![Packagist Version](https://img.shields.io/packagist/v/siteation/hyva-icons-feather?style=for-the-badge)](https://packagist.org/packages/siteation/hyva-icons-feather)
![Supported Magento Versions](https://img.shields.io/badge/magento-%202.4-brightgreen.svg?logo=magento&longCache=true&style=for-the-badge)
[![Hyva Themes Module](https://img.shields.io/badge/Hyva_Themes-Module-3df0af.svg?longCache=true&style=for-the-badge)](https://hyva.io/)
![License](https://img.shields.io/github/license/fylgja/fylgja?color=%23234&style=for-the-badge)

This Magento 2 module adds the option to use FeatherIcons in your Hyva frontend.

This requires that you have a working Hyva frontend,
this icon pack was made specifically for Hyva and will not work out of the box with any other frontend.

_If you are looking for a Luma based option [checkout this icon pack instead](https://github.com/GrimLink/magento2-icon-packs)._

## Installation

Install the package via;

```bash
composer require siteation/hyva-icons-feather
bin/magento setup:upgrade
```

> This Module requires Magento 2.4 or higher and requires Hyva!
> For more requirements see the `composer.json`.

## How to use

By default this module loads nothing.

To use this icon pack instead of the default Hyva icons, add the following to your phtml file;

```php
<?php
use Hyva\Theme\Model\ViewModelRegistry;
use Siteation\HyvaIconsFeather\ViewModel\FeatherIcons;

/** @var FeatherIcons $featherIcons */
$featherIcons = $viewModels->require(FeatherIcons::class);
```

and use the FeatherIcons just as the HeroIcons in Hyva;

```php
<?= $featherIcons->menuHtml('') ?>
```
