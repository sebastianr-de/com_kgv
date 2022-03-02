<?php

namespace Rosental\Component\Kgv\Administrator\Field\Modal;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;

class MitgliedField extends FormField
{
    protected $type = 'Modal_Mitglied';

    protected function getInput()
    {
        $allowClear = ((string)$this->element['clear'] != 'false');
        $allowSelect = ((string)$this->element['select'] != 'false');

        $value = (int)$this->value > 0 ? (int)$this->value : '';

        $modalId = 'Mitglied_' . $this->id;

        HTMLHelper::_(
            'script',
            'system/fields/modal-fields.min.js',
            ['version' => 'auto', 'relative' => true]
        );

        if ($allowSelect) {
            static $scriptSelect = null;
            if (is_null($scriptSelect)) {
                $scriptSelect = [];
            }
            if (!isset($scriptSelect[$this->id])) {
                Factory::getDocument()->addScriptDeclaration("
				function jSelectMitglied_"
                    . $this->id
                    . "(id, title, object) { window.processModalSelect('Mitglied', '"
                    . $this->id . "', id, title, '', object);}");
                $scriptSelect[$this->id] = true;
            }
        }
        // Setup variables for display.
        $linkMitglieder = 'index.php?option=com_kgv&amp;view=mitglieder&amp;layout=modal&amp;tmpl=component&amp;'
            . Session::getFormToken() . '=1';
        $linkMitglied = 'index.php?option=com_kgv&amp;view=mitglied&amp;layout=modal&amp;tmpl=component&amp;'
            . Session::getFormToken() . '=1';
        $modalTitle = Text::_('COM_KGV_CHANGE_MITGLIED');
        $urlSelect = $linkMitglieder . '&amp;function=jSelectMitglied_' . $this->id;
        if ($value) {
            $db = Factory::getDbo();
            $query = $db->getQuery(true)
                ->select($db->quoteName('name'))
                ->from($db->quoteName('#__kgv_mitglieder'))
                ->where($db->quoteName('id') . ' = ' . (int)$value);
            $db->setQuery($query);
            try {
                $title = $db->loadResult();
            } catch (\RuntimeException $e) {
                Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
            }
        }
        $title = empty($title) ? Text::_('COM_KGV_SELECT_A_MITGLIED') : htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        // The current Mitglied display field.
        $html = '';
        if ($allowSelect || $allowNew || $allowEdit || $allowClear) {
            $html .= '<span class="input-group">';
        }
        $html .= '<input class="form-control" id="' . $this->id . '_name" type="text" value="' . $title . '" readonly size="35">';
        // Select Mitglied button
        if ($allowSelect) {
            $html .= '<button'
                . ' class="btn btn-primary hasTooltip' . ($value ? ' hidden' : '') . '"'
                . ' id="' . $this->id . '_select"'
                . ' data-bs-toggle="modal"'
                . ' type="button"'
                . ' data-bs-target="#ModalSelect' . $modalId . '"'
                . ' title="' . HTMLHelper::tooltipText('COM_KGV_CHANGE_MITGLIED') . '">'
                . '<span class="icon-file" aria-hidden="true"></span> ' . Text::_('JSELECT')
                . '</button>';
        }
        // Clear Mitglied button
        if ($allowClear) {
            $html .= '<button'
                . ' class="btn btn-secondary' . ($value ? '' : ' hidden') . '"'
                . ' id="' . $this->id . '_clear"'
                . ' type="button"'
                . ' onclick="window.processModalParent(\'' . $this->id . '\'); return false;">'
                . '<span class="icon-remove" aria-hidden="true"></span>' . Text::_('JCLEAR')
                . '</button>';
        }
        if ($allowSelect || $allowNew || $allowEdit || $allowClear) {
            $html .= '</span>';
        }
        // Select Mitglied modal
        if ($allowSelect) {
            $html .= HTMLHelper::_(
                'bootstrap.renderModal',
                'ModalSelect' . $modalId,
                [
                    'title' => $modalTitle,
                    'url' => $urlSelect,
                    'height' => '400px',
                    'width' => '800px',
                    'bodyHeight' => 70,
                    'modalWidth' => 80,
                    'footer' => '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'
                        . Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</button>',
                ]
            );
        }
        // Note: class='required' for client side validation.
        $class = $this->required ? ' class="required modal-value"' : '';
        $html .= '<input type="hidden" id="'
            . $this->id . '_id"'
            . $class . ' data-required="' . (int)$this->required
            . '" name="' . $this->name
            . '" data-text="'
            . htmlspecialchars(Text::_('COM_KGV_SELECT_A_MITGLIED', true), ENT_COMPAT, 'UTF-8')
            . '" value="' . $value . '">';
        return $html;
    }
}