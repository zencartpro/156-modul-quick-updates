<?php
/**
 * @package Quick Updates
 * @copyright Portions Copyright 2006 Paul Mathot http://www.beterelektro.nl/zen-cart
 * @copyright Copyright 2006 Andrew Berezin andrew@eCommerce-service.com
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: quick_updates_functions.php 2019-10-15 09:35:04 webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
   
function install_quick_updates() {
	global $db;
	$project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
  if (substr($project,0,3) == "1.5") {
		$db->Execute("INSERT INTO ".TABLE_CONFIGURATION_GROUP." (configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('Quick Updates', 'Quick Updates Configuration', '1', '1')");
		$group_id = $db->Insert_ID();
		$db->Execute("UPDATE ".TABLE_CONFIGURATION_GROUP." SET sort_order = ".$group_id." WHERE configuration_group_id = ".$group_id);
        zen_register_admin_page('quick_updates_config', 'BOX_CATALOG_QUICK_UPDATES','FILENAME_CONFIGURATION', 'gID='.$group_id, 'configuration', 'Y', 103);
		$db->Execute("INSERT INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)  VALUES 
		('Display the ID.',                          'QUICKUPDATES_DISPLAY_ID',          'true',  'Enable/Disable the products id displaying',                     ".$group_id.", '1', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'), 
		('Display the thumbnail.',                   'QUICKUPDATES_DISPLAY_THUMBNAIL',   'true',  'Enable/Disable the products thumbnail displaying',              ".$group_id.", '2', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Modify the model.',                        'QUICKUPDATES_MODIFY_MODEL',        'true',  'Enable/Disable the products model displaying and modification', ".$group_id.", '3', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Modify the name.',                         'QUICKUPDATES_MODIFY_NAME',         'true',  'Enable/Disable the products name editing',                      ".$group_id.", '4', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Modify the Description.',                  'QUICKUPDATES_MODIFY_DESCRIPTION',  'true',  'Enable/Disable the displaying and modification of products description', ".$group_id.", '5', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Modify the status of the products.',       'QUICKUPDATES_MODIFY_STATUS',       'true',  'Allow/Disallow the Status displaying and modification',       ".$group_id.", '6',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Modify the weight of the products.',       'QUICKUPDATES_MODIFY_WEIGHT',       'true',  'Allow/Disallow the Weight displaying and modification?',      ".$group_id.", '7',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Modify the quantity of the products.',     'QUICKUPDATES_MODIFY_QUANTITY',     'true',  'Allow/Disallow the quantity displaying and modification',     ".$group_id.", '8',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Modify the manufacturer of the products.', 'QUICKUPDATES_MODIFY_MANUFACTURER', 'false', 'Allow/Disallow the Manufacturer displaying and modification', ".$group_id.", '9',  NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Modify the class of tax of the products.', 'QUICKUPDATES_MODIFY_TAX',          'false', 'Allow/Disallow the Class of tax displaying and modification', ".$group_id.", '10', NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Modify the category.',                     'QUICKUPDATES_MODIFY_CATEGORY',     'true',  'Enable/Disable the products category modify',                 ".$group_id.", '11', NULL, NOW(), NULL,  'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Display price with all included of tax.',  'QUICKUPDATES_DISPLAY_TVA_OVER',    'true',  'Enable/Disable the displaying of the Price with all tax included when your mouse is over a product', ".$group_id.", '20', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Display the link towards the products information page.',                       'QUICKUPDATES_DISPLAY_PREVIEW',            'false', 'Enable/Disable the display of the link towards the products information page ',                      ".$group_id.", '30', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Display the link towards the page where you will be able to edit the product.', 'QUICKUPDATES_DISPLAY_EDIT',               'true',  'Enable/Disable the display of the link towards the page where you will be able to edit the product', ".$group_id.", '31', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Activate or desactivate the commercial margin.',                                'QUICKUPDATES_ACTIVATE_COMMERCIAL_MARGIN', 'false',  'Do you want that the commercial margin be activate or not ?',".$group_id.", '40', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Modify the sort order.',                   'QUICKUPDATES_MODIFY_SORT_ORDER',        'true', 'Enable/Disable the products sort order modify',               ".$group_id.", '12', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('Use popup edit.',                          'QUICKUPDATES_MODIFY_DESCRIPTION_POPUP', 'true', 'Enable/Disable using popup edit link to description editing', ".$group_id.", '13', NULL, NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),') ");
		$db->Execute("REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description) VALUES
		('Zeige Artikel ID', 'QUICKUPDATES_DISPLAY_ID', 43, 'Anzeige der Artikel ID an/aus'),
    ('Zeige Artikelbild (Thumbnail)', 'QUICKUPDATES_DISPLAY_THUMBNAIL', 43, 'Anzeige des Artikelbilds (Thumbnail) an/aus'),
    ('Artikelnummer editierbar', 'QUICKUPDATES_MODIFY_MODEL', 43, 'Die Artikelnummer wird angezeigt und ist editierbar an/aus'),
    ('Artikelname editierbar', 'QUICKUPDATES_MODIFY_NAME', 43, 'Der Artikelname wird angezeigt und ist editierbar an/aus'),
    ('Artikelbeschreibung editierbar', 'QUICKUPDATES_MODIFY_DESCRIPTION', 43, 'Die Artikelbeschreibung wird angezeigt und ist editierbar an/aus<br />Wenn die Einstellung Nutze Popup Edit aktiviert ist, dann wird anstelle der Beschreibung ein Button angezeigt, der bei Klick die Beschreibung in einem Popup Fester öffnet.'),
    ('Artikelstatus editierbar', 'QUICKUPDATES_MODIFY_STATUS', 43, 'Der Artikelstatus wird angezeigt und ist editierbar an/aus'),
    ('Artikelgewicht editierbar', 'QUICKUPDATES_MODIFY_WEIGHT', 43, 'Das Artikelgewicht wird angezeigt und ist editierbar an/aus'),
    ('Lagerbestand editierbar', 'QUICKUPDATES_MODIFY_QUANTITY', 43, 'Der Lagerbestand wird angezeigt und ist editierbar an/aus'),
    ('Hersteller editierbar', 'QUICKUPDATES_MODIFY_MANUFACTURER', 43, 'Der Hersteller wird angezeigt und ist editierbar an/aus'),
    ('Steuerklasse editierbar', 'QUICKUPDATES_MODIFY_TAX', 43, 'Die Steuerklasse wird angezeigt und ist editierbar an/aus'),
    ('Kategorie editierbar', 'QUICKUPDATES_MODIFY_CATEGORY', 43, 'Die Kategorie wird angezeigt und ist editierbar an/aus'),
    ('Bruttopreis editierbar', 'QUICKUPDATES_DISPLAY_TVA_OVER', 43, 'Der Bruttopreis wird angezeigt und ist editierbar an/aus'),
    ('Link zur Artikelvorschau', 'QUICKUPDATES_DISPLAY_PREVIEW', 43, 'Anzeige eines Links zur Artikelvorschau an/aus'),
    ('Link zur Artikelbearbeitung', 'QUICKUPDATES_DISPLAY_EDIT', 43, 'Anzeige eines Links zur normalen Artikelbearbeitung an/aus'),
    ('Genereller Preisaufschlag', 'QUICKUPDATES_ACTIVATE_COMMERCIAL_MARGIN', 43, 'Sie können oberhalb der Artikelanzeige einen generellen Preisaufschlag eingeben (fixer Betrag oder Prozentwert) an/aus'),
    ('Sortierung editierbar', 'QUICKUPDATES_MODIFY_SORT_ORDER', 43, 'Die Sortierung wird angezeigt und ist editierbar an/aus'),
    ('Nutze Popup Edit', 'QUICKUPDATES_MODIFY_DESCRIPTION_POPUP', 43, 'Öffnet ein Popup Fenster zum Editieren der Artikelbeschreibung, sofern Sie oben als edititerbar eingestellt wurde an/aus');");
	} else { // unsupported version 
		// i should do something here!
	} 
}

function remove_quick_updates() {
	global $db;
	$project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
	if (substr($project,0,3) == "1.5") {
		$sql = "SELECT configuration_group_id FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_title = 'Quick Updates' LIMIT 1";
		$result = $db->Execute($sql);
		if ($result->RecordCount() > 0) { 
			$group_id =  $result->fields['configuration_group_id'];
			$db->Execute("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_group_id = ".$group_id);
			$db->Execute("DELETE FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_id = ".$group_id);
			$db->Execute("DELETE FROM ".TABLE_ADMIN_PAGES." WHERE page_key = 'quick_updates'");
			$db->Execute("DELETE FROM ".TABLE_ADMIN_PAGES." WHERE page_key = 'quick_updates_config'");
		}
	} else { // unsupported version 
	} 
}