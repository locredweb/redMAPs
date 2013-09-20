<?php
/**
 * @package     RedSHOP.Frontend
 * @subpackage  Template
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

$document = JFactory::getDocument();
$url = JURI::base(true) . '/components/com_redmaps/assets';
$document->addScript($url . '/worldmap.js');
$document->addScript($url . '/mapdata.js');
$document->addStyleSheet($url . '/css/redmaps.css');


$states = $this->item->states;
$locations = $this->item->locations;
$main_setting = json_decode($this->item->params);

$app = JFactory::getApplication();
$input = $app->input;
$continent = $input->getInt('cid', 0);

$script = 'simplemaps_worldmap_mapdata.locations = {';

// Locations
$map_array = array();
foreach ($locations as $i => $location)
{
	$_str = $i . ': {';

	$params = json_decode($location->params);
	$attribute_array = array('name: "'.$location->name.'"');

	foreach ($params as $k => $v)
	{
		if(!is_numeric($v))
		{
			$v = "'" . $v . "'";
		}
        if (!empty($v))
        {
        	$attribute_array[] = $k.": ".$v;
        }
    }

    $_str .= implode(",", $attribute_array);

	$_str .= "}";

	$map_array[] = $_str;
}

$script .= implode(",", $map_array) . "};";


$script .= "simplemaps_worldmap_mapdata.main_settings = {";

// Main setting
$map_array = array();
foreach($main_setting as $i => $v)
{
	if(!is_numeric($v))
	{
		$v = "'" . $v . "'";
	}

    if (!empty($v))
    {
       	$map_array[] = $i.": ".$v;
    }
}

$script .= implode(",", $map_array) . "};";


$document->addScriptDeclaration($script);

?>

<?php if(count($states) > 0) { ?>
<div class="redmaps">
<div class="redback"><a href="javascript:;" onclick="simplemaps_worldmap();">Back</a></div>
<div style="float: left; position:absolute; z-index: 1000;">
	<div class="controlmap">
	<ul>
	<?php foreach($states as $i => $v) { ?>
		<li>
			<a href="javascript:;" onclick="simplemaps_worldmap_zoom(<?php echo ($i-1) ?>);"><?php echo $v['name'] ?></a>
			<ul>
			<?php foreach($v['states'] as $country) { ?>
				<li><a href="javascript:;" onclick="simplemaps_worldmap_state_zoom('<?php echo $country->sid ?>')"><?php echo $country->name ?></a></li>
			<?php } ?>
			</ul>
		</li>
	<?php } ?>
	</ul>
</div>
</div>
<?php } ?>

<div style="float: right;" id="map"></div>
</div>

<style type="text/css" media="screen">
	#tt_custom_sm{width: 300px;}
</style>

<?php
if(!empty($continent))
{
	$continent--;
?>

<script type="text/javascript">
	setTimeout(function(){simplemaps_worldmap_zoom('<?php echo $continent ?>');},1000)
</script>
<?php } ?>
