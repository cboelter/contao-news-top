<?php

declare(strict_types=1);

namespace NewsTop\ContaoManager;

use Codefog\NewsCategoriesBundle\CodefogNewsCategoriesBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\NewsBundle\ContaoNewsBundle;
use NewsTop\NewsTopBundle;

final class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser) : array
    {
        return [
            BundleConfig::create(NewsTopBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class, ContaoNewsBundle::class, CodefogNewsCategoriesBundle::class])
                ->setReplace(['news-top'])
        ];
    }
}
