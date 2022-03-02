<?php

namespace Rosental\Component\Kgv\Administrator\Controller;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;

class MitgliedController extends FormController
{
    public function cancel($key = null)
    {
        $return = parent::cancel($key);
        $this->setRedirect(Route::_('index.php?option=com_kgv'));
        return $return;
    }
}