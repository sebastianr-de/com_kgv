<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;

$displayData = [
    'textPrefix' => 'COM_KGVS',
    'formURL' => 'index.php?option=com_kgv',
    'icon' => 'icon-copy',
];
$user = Factory::getApplication()->getIdentity();
if ($user->authorise('core.create', 'com_kgv') || count($user->getAuthorisedCategories('com_kgv', 'core.create')) > 0) {
    $displayData['createURL'] = 'index.php?option=com_kgv&task=foo.add';
}
echo LayoutHelper::render('joomla.content.emptystate', $displayData);