<?php

/**
 * NewsTop
 *
 * @package   contao-news-top
 * @author    Christopher Bölter <christopher@boelter.eu>
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @copyright 2014-2020 Christopher Bölter
 * @license   LGPL-3.0-or-later https://github.com/cboelter/contao-news-top/blob/master/LICENSE
 */

// Palettes
// @codingStandardsIgnoreStart
$GLOBALS['TL_DCA']['tl_module']['palettes']['newslisttop'] = '{title_legend},name,headline,type'
    . ';{config_legend},news_archives,news_filterCategories,news_filterDefault,news_filterPreserve,numberOfItems'
    . ',news_featured,perPage,skipFirst'
    . ';{template_legend:hide},news_metaFields,news_template,imgSize'
    . ';{protected_legend:hide},protected'
    . ';{expert_legend:hide},guests,cssID,space';
// @codingStandardsIgnoreEnd
