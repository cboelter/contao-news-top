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

// Fields
$GLOBALS['TL_DCA']['tl_news']['fields']['newstop_count'] = array
(
    'sql' => "int(11) NOT NULL default '0'"
);
