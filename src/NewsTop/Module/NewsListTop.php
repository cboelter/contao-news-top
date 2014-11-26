<?php


namespace NewsTop\Module;

use Contao\ModuleNewsList;
use NewsTop\Model\NewsTopModel;

class NewsListTop extends ModuleNewsList
{

    /**
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.CamelCaseVariableName)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function compile()
    {
        $offset                   = intval($this->skipFirst);
        $limit                    = null;
        $this->Template->articles = array();

        // Maximum number of items
        if ($this->numberOfItems > 0) {
            $limit = $this->numberOfItems;
        }

        // Handle featured news
        if ($this->news_featured == 'featured') {
            $blnFeatured = true;
        } elseif ($this->news_featured == 'unfeatured') {
            $blnFeatured = false;
        } else {
            $blnFeatured = null;
        }

        // Get the total number of items
        $intTotal = NewsTopModel::countPublishedByPids($this->news_archives, $blnFeatured);

        if ($intTotal < 1) {
            $this->Template        = new \FrontendTemplate('mod_newsarchive_empty');
            $this->Template->empty = $GLOBALS['TL_LANG']['MSC']['emptyList'];
            return;
        }

        $total = $intTotal - $offset;

        // Split the results
        if ($this->perPage > 0 && (!isset($limit) || $this->numberOfItems > $this->perPage)) {
            // Adjust the overall limit
            if (isset($limit)) {
                $total = min($limit, $total);
            }

            // Get the current page
            $newsId   = 'page_n' . $this->id;
            $page = \Input::get($newsId) ?: 1;

            // Do not index or cache the page if the page number is outside the range
            if ($page < 1 || $page > max(ceil($total / $this->perPage), 1)) {
                global $objPage;
                $objPage->noSearch = 1;
                $objPage->cache    = 0;

                // Send a 404 header
                header('HTTP/1.1 404 Not Found');
                return;
            }

            // Set limit and offset
            $limit = $this->perPage;
            $offset += (max($page, 1) - 1) * $this->perPage;
            $skip = intval($this->skipFirst);

            // Overall limit
            if ($offset + $limit > $total + $skip) {
                $limit = $total + $skip - $offset;
            }

            // Add the pagination menu
            $objPagination              = new \Pagination($total, $this->perPage, $GLOBALS['TL_CONFIG']['maxPaginationLinks'], $newsId);
            $this->Template->pagination = $objPagination->generate("\n  ");
        }

        // Get the items
        if (isset($limit)) {
            $objArticles = NewsTopModel::findPublishedByPids($this->news_archives, $blnFeatured, $limit, $offset,
                array('order'));
        } else {
            $objArticles = NewsTopModel::findPublishedByPids($this->news_archives, $blnFeatured, 0, $offset,
                array('order'));
        }

        // No items found
        if ($objArticles === null) {
            $this->Template        = new \FrontendTemplate('mod_newsarchive_empty');
            $this->Template->empty = $GLOBALS['TL_LANG']['MSC']['emptyList'];
        } else {
            $this->Template->articles = $this->parseArticles($objArticles);
        }

        $this->Template->archives = $this->news_archives;
    }
}
