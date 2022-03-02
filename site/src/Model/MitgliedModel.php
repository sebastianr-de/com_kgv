<?php

namespace Rosental\Component\Kgv\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class MitgliedModel extends BaseDatabaseModel
{
    /**
     * @var string item
     */
    protected $_item;

    /**
     * Get the mitglied
     *
     * @param integer $pk Id for the mitglied
     *
     * @return  mixed Object or null
     *
     * @since   __BUMP_VERSION__
     */
    public function getItem($pk = null)
    {
        $app = Factory::getApplication();

        $pk = $app->input->getInt('id');
        if ($this->_item === null) {
            $this->_item = array();
        }
        if (!isset($this->_item[$pk])) {
            try {
                $db = $this->getDbo();
                $query = $db->getQuery(true);
                $query->select('*')
                    ->from($db->quoteName('#__kgv_mitglieder', 'a'))
                    ->where('a.id = ' . (int)$pk);
                $db->setQuery($query);
                $data = $db->loadObject();
                if (empty($data)) {
                    throw new \Exception(Text::_('COM_KGV_ERROR_MITGLIED_NOT_FOUND'), 404);
                }
                $this->_item[$pk] = $data;
            } catch (\Exception $e) {
                if ($e->getCode() == 404) {
                    // Need to go through the error handler to allow Redirect to work.
                    throw $e;
                } else {
                    $this->setError($e);
                    $this->_item[$pk] = false;
                }
            }
        }

        return $this->_item[$pk];
    }
}