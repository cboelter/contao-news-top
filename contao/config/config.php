<?php

// Frontend-Modules
array_insert($GLOBALS['FE_MOD']['news'], count($GLOBALS['FE_MOD']['news']), array
(
   'newslisttop' => 'NewsTop\Module\NewsListTop'
));

// Hooks
$GLOBALS['TL_HOOKS']['parseArticles'][] = array('NewsTop\Hook\ParseArticle', 'parseNewsArticle');
