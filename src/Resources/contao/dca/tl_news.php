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

// Fields
$GLOBALS['TL_DCA']['tl_news']['fields']['newstop_count'] = array
(
    'sql' => "int(11) NOT NULL default '0'"
);
