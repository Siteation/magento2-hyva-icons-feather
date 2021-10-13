<?php declare(strict_types=1);

namespace Siteation\HyvaIconsFeather\ViewModel;

use Magento\Framework\App\CacheInterface;
use Magento\Framework\View\Asset;
use Magento\Framework\View\DesignInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * This generic SvgIcons view model can be used to render any icon set (i.e. subdirectory in web/svg).
 *
 * The icon set can be configured with di.xml or by extending the class. The module ships with FeatherIcons
 *
 * @see FeatherIcons
 */
class SvgIcons implements ArgumentInterface
{
    private const CACHE_TAG = 'SITEATION_ICONS';

    /**
     * @var string Path relative to asset directory Hyva_Theme::svg/
     */
    private $iconSet;

    /**
     * @var Asset\Repository
     */
    private $assetRepository;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var DesignInterface
     */
    private $design;

    /**
     * @var array<string,string>
     */
    private $svgCache = [];

    public function __construct(
        Asset\Repository $assetRepository,
        CacheInterface $cache,
        DesignInterface $design,
        string $iconSet = ''
    ) {
        $this->iconSet = $iconSet;
        $this->assetRepository = $assetRepository;
        $this->cache = $cache;
        $this->design = $design;
    }

    /**
     * Renders an inline SVG icon from the configured icon set
     *
     * The method ends with Html instead of Svg so that the Magento code sniffer understands it is safe HTML and does
     * not need to be escaped.
     *
     * @param string $icon The SVG file name without .svg suffix
     * @param string $classNames CSS classes to add to the root element, space separated
     * @param int|null $width Width in px (recommended to render in correct size without CSS)
     * @param int|null $height Height in px (recommended to render in correct size without CSS)
     * @return string
     */
    public function renderHtml(string $icon, string $classNames = '', ?int $width = null, ?int $height = null): string
    {
        $cacheKey = $this->design->getDesignTheme()->getCode() .
            '/' . $this->iconSet .
            '/' . $icon .
            '/' . $classNames .
            '#' . $width .
            '#' . $height;
        if ($result = $this->cache->load($cacheKey)) {
            return $result;
        }
        $svg = \file_get_contents($this->getFilePath($icon));
        $svgXml = new \SimpleXMLElement($svg);
        if (trim($classNames)) {
            $svgXml['class'] = $classNames;
        }
        if ($width) {
            $svgXml['width'] = (string) $width;
        }
        if ($height) {
            $svgXml['height'] = (string) $height;
        }
        $result = \str_replace("<?xml version=\"1.0\"?>\n", '', $svgXml->asXML());
        $this->cache->save($result, $cacheKey, [self::CACHE_TAG]);
        return $result;
    }

    /**
     * Magic method to allow iconNameHtml() instead of renderHtml('icon-name'). Subclasses may
     * use @method doc blocks to provide autocompletion for available icons.
     */
    public function __call($method, $args)
    {
        if (\preg_match('/^(.*)Html$/', $method, $matches)) {
            return $this->renderHtml(self::camelCaseToKebabCase($matches[1]), ...$args);
        }
        return '';
    }

    /**
     * Convert a CamelCase string into kebab-case
     *
     * For example ArrowUp => arrow-up
     */
    private static function camelCaseToKebabCase(string $in): string
    {
        return strtolower(preg_replace('/(.)([A-Z])/', "$1-$2", $in));
    }

    /**
     * Return full path to icon file, respecting theme fallback
     */
    private function getFilePath(string $icon): string
    {
        $assetFileId = 'Siteation_HyvaIconsFeather::svg/' . $this->iconSet . '/' . $icon . '.svg';
        return $this->assetRepository->createAsset($assetFileId)->getSourceFile();
    }
}
