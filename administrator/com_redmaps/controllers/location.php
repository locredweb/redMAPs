<?php
/**
 * @version     1.0.0
 * @package     com_redmaps
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Notification controller class.
 */
class RedmapsControllerLocation extends JControllerForm
{

    function __construct() {
        $this->view_list = 'locations';
        parent::__construct();
    }

}