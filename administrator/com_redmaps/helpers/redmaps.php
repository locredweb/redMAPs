<?php
/**
 * @version     1.0.0
 * @package     com_redmaps
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

class RedmapsHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_REDMAPS_TITLE_MAPS'),
			'index.php?option=com_redmaps&view=maps',
			$vName == 'maps'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_REDMAPS_TITLE_STATESPECIFICS'),
			'index.php?option=com_redmaps&view=statespecifics',
			$vName == 'statespecifics'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_REDMAPS_TITLE_LOCATIONS'),
			'index.php?option=com_redmaps&view=locations',
			$vName == 'locations'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_redmaps';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}
