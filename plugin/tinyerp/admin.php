<?

if ( sm_core_content_user_accesscheck("TINYERP_ADMINPANEL_READ") ) {
	$plugin_menu["5plugin_tinyerp00"] = array(
		"level" => 0,
		"name" => "Tiny ERP"
	);
	if ( sm_core_content_user_accesscheck("TINYERP_ADMINPANEL_READ") ) {
		$plugin_menu["5plugin_tinyerp_01_company"] = array(
			"access_type_id" => "TINYERP_DB",
			"level" => "5plugin_tinyerp00", "name" => "Firma", "url" => "tinyerp-company.php",
			"file" => $SM_PLUGINS["TINYERP"]["dir"]."/staff/tinyerp-company.php",
			"info-short" => "",
		);

		$plugin_menu["5plugin_tinyerp_02_user"] = array(
			"access_type_id" => "TINYERP_DB",
			"level" => "5plugin_tinyerp00", "name" => "Użytkownicy", "url" => "tinyerp-user.php",
			"file" => $SM_PLUGINS["TINYERP"]["dir"]."/staff/tinyerp-user.php",
			"info-short" => "",
		);

		$plugin_menu["5plugin_tinyerp_03_customer"] = array(
			"access_type_id" => "TINYERP_DB",
			"level" => "5plugin_tinyerp00", "name" => "Klienci", "url" => "tinyerp-customer.php",
			"file" => $SM_PLUGINS["TINYERP"]["dir"]."/staff/tinyerp-customer.php",
			"info-short" => "",
		);

		$plugin_menu["5plugin_tinyerp_04_bankaccount"] = array(
			"access_type_id" => "TINYERP_DB",
			"level" => "5plugin_tinyerp00", "name" => "Konta bankowe", "url" => "tinyerp-bankaccount.php",
			"file" => $SM_PLUGINS["TINYERP"]["dir"]."/staff/tinyerp-bankaccount.php",
			"info-short" => "",
		);

		$plugin_menu["5plugin_tinyerp_05_invoicegroup"] = array(
			"access_type_id" => "TINYERP_DB",
			"level" => "5plugin_tinyerp00", "name" => "Grupy faktur", "url" => "tinyerp-invoicegroup.php",
			"file" => $SM_PLUGINS["TINYERP"]["dir"]."/staff/tinyerp-invoicegroup.php",
			"info-short" => "",
		);

		$plugin_menu["5plugin_tinyerp_06_invoice"] = array(
			"access_type_id" => "TINYERP_DB",
			"level" => "5plugin_tinyerp00", "name" => "Faktury", "url" => "tinyerp-invoice.php",
			"file" => $SM_PLUGINS["TINYERP"]["dir"]."/staff/tinyerp-invoice.php",
			"info-short" => "",
		);

		$plugin_menu["5plugin_tinyerp_06_product"] = array(
			"access_type_id" => "TINYERP_DB",
			"level" => "5plugin_tinyerp00", "name" => "Produkty", "url" => "tinyerp-product.php",
			"file" => $SM_PLUGINS["TINYERP"]["dir"]."/staff/tinyerp-product.php",
			"info-short" => "",
		);

		$plugin_menu["5plugin_tinyerp_07_vatcode"] = array(
			"access_type_id" => "TINYERP_DB",
			"level" => "5plugin_tinyerp00", "name" => "Kody VAT", "url" => "tinyerp-vatcode.php",
			"file" => $ROOT_DIR."/staff/content_peeklistitem.php",
			"info-short" => "",
			"config" => array(
				"peeklist_sysname" => "VAT_CODE",
				"peeklist_plugin" => "TINYERP",
			),
		);

		$plugin_menu["5plugin_tinyerp_08_payment_type"] = array(
			"access_type_id" => "TINYERP_DB",
			"level" => "5plugin_tinyerp00", "name" => "Sposoby płatności", "url" => "tinyerp-payment_type.php",
			"file" => $ROOT_DIR."/staff/content_peeklistitem.php",
			"info-short" => "",
			"config" => array(
				"peeklist_sysname" => "PAYMENT_TYPE",
				"peeklist_plugin" => "TINYERP",
			),
		);

		$plugin_menu["5plugin_tinyerp_09_country"] = array(
			"access_type_id" => "TINYERP_DB",
			"level" => "5plugin_tinyerp00", "name" => "Lista państw", "url" => "tinyerp-country.php",
			"file" => $ROOT_DIR."/staff/content_peeklistitem.php",
			"info-short" => "",
			"config" => array(
				"peeklist_sysname" => "COUNTRY",
				"peeklist_plugin" => "TINYERP",
			),
		);

		$plugin_menu["5plugin_tinyerp_10_acl"] = array(
			"access_type_id" => "TINYERP_DB",
			"level" => "5plugin_tinyerp00", "name" => "Uprawnienia", "url" => "tinyerp-acl.php",
			"file" => $ROOT_DIR."/staff/content_peeklistitem.php",
			"info-short" => "",
			"config" => array(
				"peeklist_sysname" => "ACL",
				"peeklist_plugin" => "TINYERP",
			),
		);
	}
}

?>
