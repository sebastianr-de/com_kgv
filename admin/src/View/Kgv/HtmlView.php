<?php

namespace Rosental\Component\Kgv\Administrator\View\Kgv;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{

    protected $items;

    public function display($tpl = null)
    {
        $this->items = $this->get('Items');

        if (!count($this->items) && $this->get('IsEmptyState')) {
            $this->setLayout('emptystate');
        }
        $this->addToolbar();

        parent::display($tpl);
    }

    protected function addToolbar()
    {
        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');
        ToolbarHelper::title(Text::_('COM_KGV_MANAGER_KGV'), 'address mitglied');
        $toolbar->addNew('mitglied.add');
    }
}