<?php
/* *
 *	mod-prijsvergelijk
 *  helper.php
 *	Created on 16-4-14 16:56
 *  
 *  @author Matthijs
 *  @copyright Copyright (C)2014 Bixie.nl
 *
 */

// No direct access
defined('_JEXEC') or die;


/**
 * Class modBixprijsvergelijkHelper
 */
class modBixprijsvergelijkHelper {

	/**
	 * @param string $product
	 * @return array
	 */
	public static function vergelijkPrijzen ($product = '') {
		$rConfig = new JRegistry;
		$rConfig->loadString(file_get_contents('producten.json'));
		$prods = $rConfig->get('producten');
		if (!empty($product)) {
			$prods = array($prods[$product]);
		}
		$return = array();
		foreach ($prods as $productNaam => $sites) {
			$return[$productNaam] = array();
			foreach ($sites as $siteNaam => $siteInfo) {

				$html = new DOMDocument();
				@$html->loadHtmlFile($siteInfo->url);
				$xpath = new DOMXPath($html);
				$nodelist = $xpath->query($siteInfo->xpath);
				foreach ($nodelist as $n) {
					$clean = trim(str_replace($siteInfo->filter, '', $n->nodeValue));
					$return[$productNaam][$siteNaam] = array('clean' => $clean, 'raw' => $n->nodeValue);
				}
			}
		}
		return $return;
	}
}