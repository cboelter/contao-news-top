<?php

/**
 * NewsTop
 *
 * PHP Version 5.3
 *
 * @copyright  Christopher Bölter 2014
 * @author     Christopher Bölter <github@boelter.eu>
 * @package    contao-news-top
 * @license    LGPL-3.0+
 */

// Frontend-Modules
array_insert($GLOBALS['FE_MOD']['news'], count($GLOBALS['FE_MOD']['news']), array
(
   'newslisttop' => 'NewsTop\Module\NewsListTop'
));

// Hooks
$GLOBALS['TL_HOOKS']['parseArticles'][] = array('NewsTop\Hook\ParseArticle', 'parseNewsArticle');
