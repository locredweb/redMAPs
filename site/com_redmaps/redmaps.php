<?php
/**
 * @version     1.0.0
 * @package     com_redmaps
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ronni K. G. Christiansen <email@redweb.dk> - http://www.redcomponent.com
 */

defined('_JEXEC') or die;

$controller = JControllerLegacy::getInstance('Redmaps');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
