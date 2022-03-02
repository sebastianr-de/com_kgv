<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;

$displayData = [
    'textPrefix' => 'COM_KGV',
    'formURL' => 'index.php?option=com_kgv',
    'helpURL' => 'https://github.com/sebastianr-de/com_kgv/blob/main/README.md',
    'icon' => 'icon-copy',
];
$user = Factory::getApplication()->getIdentity();
if ($user->authorise('core.create', 'com_kgv') || count($user->getAuthorisedCategories('com_kgv', 'core.create')) > 0) {
    $displayData['createURL'] = 'index.php?option=com_kgv&task=mitglied.add';
}
echo LayoutHelper::render('joomla.content.emptystate', $displayData);
