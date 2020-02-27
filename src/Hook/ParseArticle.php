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

namespace NewsTop\Hook;

/**
 * Handle the parseArticle-Hook.
 *
 * @package NewsTop
 */
class ParseArticle
{

    /**
     * Handle the parseArticle-Hook and set the counter to the database and the template.
     *
     * @param object $objTemplate The current news template.
     * @param array  $arrArticle  The current article row.
     * @param object $objModule   The current news module.
     *
     * @return void
     */
    public function parseNewsArticle($objTemplate, $arrArticle, $objModule)
    {
        $count = $arrArticle['newstop_count'];

        if ($objModule->type == 'newsreader') {
            $objNews = \NewsModel::findPublishedByParentAndIdOrAlias($arrArticle['id'], array($arrArticle['pid']));

            $objNews->newstop_count = ($objNews->newstop_count + 1);
            $objNews->save();

            $count = $objNews->newstop_count;
        }

        $objTemplate->newstop_count = $count;
    }
}
