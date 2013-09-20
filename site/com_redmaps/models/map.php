<?php

/**

 *
 * @version 1.0.0
 * @package com_redmaps
 * @copyright Copyright (C) 2013. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * @author Ronni K. G. Christiansen <email@redweb.dk> -
 *         http://www.redcomponent.com
 */
defined('_JEXEC') or die();

jimport('joomla.application.component.modelitem');

/**
 * Methods supporting a list of Redmaps records.
 */
class RedmapsModelMap extends JModelItem
{
	public $app = null;

	public $input = null;

	public $option = null;

    public $pk = null;

	public function __construct($config = array())
	{
		$this->app = JFactory::getApplication();
		$this->input = $this->app->input;
		$this->option = $this->input->getString('option', 'com_redmaps');

        $this->pk = $this->input->getInt('mid', 0);

		parent::__construct($config);
	}

    public function getItem()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select($this->getState('list.select', '*'));
        $query->from('#__redmaps_maps');
        $query->where('id=' . (int) $this->pk);

        $db->setQuery($query);

        $data = $db->loadObject();

        $params = json_decode($data->params);
        $states = implode(',', $params->states);

        $data->states = $this->getCountry($states);
        $data->locations = $this->getLocations($states);

        $this->_item[$this->pk] = $data;

        return $this->_item[$this->pk];
    }

    private function getLocations($ids)
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        $mid = $this->input->getInt('mid', 0);

        // Select the required fields from the table.
        $query->select('*');
        $query->from('#__redmaps_locations');
        $query->where('statespecific_id IN (' . $ids . ') AND state=1');

        $db->setQuery($query);

        $list = $db->loadObjectList();

        return $list;
    }

    private function getCountry($ids)
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('s.id, s.name, s.params, c.id as cid, c.name as continent');
        $query->from('#__redmaps_statespecifics s');
        $query->join('INNER', '#__redmaps_continents c ON s.parent_id = c.id');
        $query->where('s.id IN (' . $ids . ') AND s.state=1');

        $db->setQuery($query);

        $list = array();

        $items = $db->loadObjectList();

        foreach($items as $item)
        {
            $params = json_decode($item->params);
            $item->sid = $params->name;
            $list[$item->cid]['name'] = $item->continent;
            $list[$item->cid]['states'][] = $item;
        }

        return $list;
    }

}
