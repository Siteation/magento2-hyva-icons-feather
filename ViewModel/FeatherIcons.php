<?php declare(strict_types=1);
/**
 * Siteation - https://siteation.dev/
 * Copyright © Siteation. All rights reserved.
 * See LICENSE file for details.
 */

namespace Siteation\HyvaIconsFeather\ViewModel;

use Magento\Framework\App\CacheInterface;
use Magento\Framework\View\Asset;
use Magento\Framework\View\DesignInterface;

class FeatherIcons extends SvgIcons implements FeatherIconsInterface
{
    private const FEATHERICONS = 'feather';

    public function __construct(
        Asset\Repository $assetRepository,
        CacheInterface $cache,
        DesignInterface $design
    ) {
        parent::__construct($assetRepository, $cache, $design, self::FEATHERICONS);
    }
}
