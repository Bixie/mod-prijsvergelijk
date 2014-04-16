<?php
/* *
 *	mod-prijsvergelijk
 *  helper.php
 *	Created on 16-4-14 16:46
 *
 *  @author Matthijs
 *  @copyright Copyright (C)2014 Bixie.nl
 *
 */

// no direct access
defined('_JEXEC') or die;

$layout = $params->get('layout', 'default');
switch ($layout) {
	case '_:product':

		break;
	default:
		$data = modBixprijsvergelijkHelper::vergelijkPrijzen();
		break;
}
require JModuleHelper::getLayoutPath('mod_bix_prijsvergelijk', $params->get('layout', 'default'));