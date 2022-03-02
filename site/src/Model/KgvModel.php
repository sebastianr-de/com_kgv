<?php

namespace Rosental\Component\Kgv\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class KgvModel extends BaseDatabaseModel
{
    protected $message;

    /**
     * @return mixed
     */
    public function getMessage()
    {
        $app = Factory::getApplication();
        $this->message = $app->input->get('show_text', "Hi");

        return $this->message;
    }
}