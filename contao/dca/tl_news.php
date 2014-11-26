<?php

/**
 * Add a new field to tl_news
 */
$GLOBALS['TL_DCA']['tl_news']['fields']['newstop_count'] = array
(
    'sql' => "int(11) NOT NULL default '0'"
);
