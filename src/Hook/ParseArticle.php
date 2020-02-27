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
