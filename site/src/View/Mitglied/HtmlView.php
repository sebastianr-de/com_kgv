<?php

namespace Rosental\Component\Kgv\Site\View\Mitglied;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    /**
     * The item object details
     *
     * @var    \JObject
     * @since  __BUMP_VERSION__
     */
    protected $item;

    public function display($tpl = null)
    {
        $this->item = $this->get('Item');
        parent::display($tpl);
    }
}