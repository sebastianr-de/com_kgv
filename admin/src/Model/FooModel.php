<?php

namespace Rosental\Component\Kgv\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;

class FooModel extends AdminModel
{

    public $typeAlias = 'com_kgv.foo';

    /**
     * @inheritDoc
     */
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm($this->typeAlias, 'foo', ['control' => 'jform', 'load_data' => $loadData]);

        if (!empty($form))
            return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     * @since   __BUMP_VERSION__
     */
    protected function loadFormData()
    {
        $app = Factory::getApplication();

        $data = $this->getItem();

        $this->preprocessData($this->typeAlias, $data);

        return $data;
    }

    /**
     * Prepare and sanitise the table prior to saving.
     *
     * @param \Joomla\CMS\Table\Table $table The Table object
     * @return  void
     * @since   __BUMP_VERSION__
     */
    protected function prepareTable($table)
    {
        $table->generateAlias();
    }
}