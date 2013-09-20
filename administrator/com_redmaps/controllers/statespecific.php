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
 * Subscription controller class.
 */
class RedmapsControllerStatespecific extends JControllerForm
{

    function __construct() {
        $this->view_list = 'statespecifics';
        parent::__construct();
    }

}