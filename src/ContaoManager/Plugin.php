<?php

/**
 * NewsTop
 *
 * @package   contao-news-top
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @copyright 2014-2020 Christopher Bölter
 * @license   LGPL-3.0-or-later https://github.com/cboelter/contao-news-top/blob/master/LICENSE
 */

declare(strict_types=1);

namespace NewsTop\ContaoManager;

use Codefog\NewsCategoriesBundle\CodefogNewsCategoriesBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\NewsBundle\ContaoNewsBundle;
use NewsTop\NewsTopBundle;

/**
 * Class Plugin
 */
final class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritDoc}
     */
    public function getBundles(ParserInterface $parser) : array
    {
        return [
            BundleConfig::create(NewsTopBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class, ContaoNewsBundle::class, CodefogNewsCategoriesBundle::class])
                ->setReplace(['news-top'])
        ];
    }
}
