<?php

namespace Rosental\Component\Kgv\Administrator\Controller;

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController
{

    protected $default_view = 'kgv';

    public function display($cachable = false, $urlparams = [])
    {
        return parent::display();
    }
}