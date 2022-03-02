<?php

namespace Rosental\Component\Kgv\Administrator\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;

class MitgliedModel extends AdminModel
{
    protected $formName = 'mitglied';
    public $typeAlias = 'com_kgv.mitglied';

    /**
     * @inheritDoc
     */
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm($this->typeAlias, $this->formName, ['control' => 'jform', 'load_data' => $loadData]);
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
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
     *
     * @return  void
     *
     * @since   __BUMP_VERSION__
     */
    protected function prepareTable($table)
    {
        $table->generateAlias();
    }
}