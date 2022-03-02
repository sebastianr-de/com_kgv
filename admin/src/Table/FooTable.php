<?php

namespace Rosental\Component\Kgv\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class FooTable extends Table
{
    /**
     * Constructor
     *
     * @param DatabaseDriver $db Database connector object
     * @since   __BUMP_VERSION__
     */
    public function __construct(DatabaseDriver $db)
    {
        $this->typeAlias = 'com_kgv.foo';
        parent::__construct('#__kgv_details', 'id', $db);
    }

    public function generateAlias()
    {
        if (empty($this->alias)) {
            $this->alias = $this->name;
        }
        $this->alias = ApplicationHelper::stringURLSafe($this->alias, $this->language);
        if (trim(str_replace('-', '', $this->alias)) == '') {
            $this->alias = Factory::getDate()->format('Y-m-d-H-i-s');
        }
        return $this->alias;
    }
}