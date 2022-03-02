<?php

namespace Rosental\Component\Kgv\Administrator\Model;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\ListModel;

class KgvModel extends ListModel
{
    public function __construct($config = array(), MVCFactoryInterface $factory = null)
    {
        parent::__construct($config, $factory);
    }

    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        // Select the required fields from the table.
        $query->select(
            $db->quoteName(['id', 'name', 'alias'])
        );
        $query->from($db->quoteName('#__kgv_details'));
        return $query;
    }
}