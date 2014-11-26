<?php

// Hooks
$GLOBALS['TL_HOOKS']['parseArticles'][] = array('NewsTop\Hooks\ParseArticle', 'parseArticle');