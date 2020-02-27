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

namespace NewsTop\Model;

use Contao\NewsModel;

/**
 * Handles the custom finding queries for news top.
 *
 * @package NewsTop
 */
class NewsTopModel extends NewsModel
{

    /**
     * Find all published news by pids.
     *
     * @param array $arrPids     All pids that would be searched.
     * @param null  $blnFeatured Show featured news.
     * @param int   $intLimit    Limit for the records.
     * @param int   $intOffset   Offset for the records.
     * @param array $arrOptions  Options for the query.
     *
     * @codingStandardsIgnoreStart
     *
     * @return \Model\Collection|null
     */
    public static function findPublishedByPids(
        $arrPids,
        $blnFeatured = null,
        $intLimit = 0,
        $intOffset = 0,
        array $arrOptions = array()
    ) {
        if (!is_array($arrPids) || empty($arrPids)) {
            return null;
        }

        $table      = static::$strTable;
        $arrColumns = array("$table.pid IN(" . implode(',', array_map('intval', $arrPids)) . ")");

        if ($blnFeatured === true) {
            $arrColumns[] = "$table.featured=1";
        } elseif ($blnFeatured === false) {
            $arrColumns[] = "$table.featured=''";
        }

        // Never return unpublished elements in the back end, so they don't end up in the RSS feed
        if (!BE_USER_LOGGED_IN || TL_MODE == 'BE') {
            $tableime     = time();
            $arrColumns[] = "($table.start='' OR $table.start<$tableime) AND ($table.stop='' OR $table.stop>$tableime) "
                            . "AND $table.published=1";
        }

        if (!isset($arrOptions['order'])) {
            $arrOptions['order'] = "$table.newstop_count DESC";
        }

        $arrOptions['limit']  = $intLimit;
        $arrOptions['offset'] = $intOffset;

        return static::findBy($arrColumns, null, $arrOptions);
        // @codingStandardsIgnoreEnd
    }
}
