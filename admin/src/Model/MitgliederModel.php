<?php

namespace Rosental\Component\Kgv\Administrator\Model;

use Joomla\CMS\MVC\Model\ListModel;

class MitgliederModel extends ListModel
{
    public function __construct($config = [])
    {
        parent::__construct($config);
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
        $query->from($db->quoteName('#__kgv_mitglieder'));
        return $query;
    }
}