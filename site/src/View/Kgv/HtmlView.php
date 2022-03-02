<?php

namespace Rosental\Component\Kgv\Site\View\Kgv;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    public function display($tpl = null)
    {
        $this->message = $this->get('message');
        parent::display($tpl);
    }
}