<?php
/**
* @package Quick Updates
* @copyright Copyright 2003-2019 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: sanitize_quick_updates.php 2019-10-15 09:35:04 webchills $
*/
 
if ( class_exists('AdminRequestSanitizer') ) {
	$sanitizer = AdminRequestSanitizer::getInstance();
	$group = array('quick_updates_new', 'markup_checked', 'quick_updates_old');
	if ( method_exists($sanitizer, 'addSimpleSanitization') ) {
		$sanitizer->addSimpleSanitization('STRICT_SANITIZE_VALUES', $group);
	} elseif ( method_exists($sanitizer, 'addSanitizationGroup') ) {
		$sanitizer->addSanitizationGroup('STRICT_SANITIZE_VALUES', $group);
	}
}
