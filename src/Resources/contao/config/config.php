<?php

/**
 * NewsTop
 *
 * @package   contao-news-top
 * @author    Christopher Boelter <christopher@boelter.eu>
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @copyright 2014-2020 Christopher Bölter
 * @license   LGPL-3.0-or-later https://github.com/cboelter/contao-news-top/blob/master/LICENSE
 */

// Frontend-Modules
array_insert($GLOBALS['FE_MOD']['news'], count($GLOBALS['FE_MOD']['news']), array
(
   'newslisttop' => 'NewsTop\Module\NewsListTop'
));

// Hooks
$GLOBALS['TL_HOOKS']['parseArticles'][] = [\NewsTop\Hook\ParseArticle::class, 'parseNewsArticle'];
