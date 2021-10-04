<?php declare(strict_types=1);

namespace Fylgja\Theme\ViewModel;

use Magento\Framework\App\CacheInterface;
use Magento\Framework\View\Asset;
use Magento\Framework\View\DesignInterface;
use Hyva\Theme\ViewModel\SvgIcons;

/**
 * This class exists to offer autocompletion, it could have been a virtual type otherwise
 */
class FeatherIcons extends SvgIcons
{
    public function __construct(
        Asset\Repository $assetRepository,
        CacheInterface $cache,
        DesignInterface $design
    ) {
        parent::__construct($assetRepository, $cache, $design, 'feather');
    }
}
