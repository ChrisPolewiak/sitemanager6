<?

$PLUGIN["TINYERP"]["lib"] = array(
	"lang.php",
	"lib.php",
	"cronfunction.php",
#	"vars.php",
	"api.php",
	"sql/tinyerp_bankaccount.php",
	"sql/tinyerp_company.php",
	"sql/tinyerp_customer.php",
	"sql/tinyerp_invoice.php",
	"sql/tinyerp_invoicegroup.php",
	"sql/tinyerp_invoiceline.php",
	"sql/tinyerp_product.php",
	"sql/tinyerp_user.php",
);

@include $ROOT_DIR."/cache/tinyerp-country.php";
@include $ROOT_DIR."/cache/tinyerp-acl.php";
@include $ROOT_DIR."/cache/tinyerp-payment_type.php";
@include $ROOT_DIR."/cache/tinyerp-vat_code.php";

$PLUGIN_STAFF_MENU["TINYERP"]="admin.php";

$SYSTEM_DEFINED_ROLEACTION["TINYERP"] = array(
	"A" => array("tag"=>"ADD", "name"=>"Utworzenie"),
	"R" => array("tag"=>"READ", "name"=>"Odczyt"),
	"W" => array("tag"=>"WRITE", "name"=>"Zmiana"),
	"D" => array("tag"=>"DELETE", "name"=>"Usuniecie"),
);

$SYSTEM_DEFINED_ROLES["TINYERP"] = array(
	"ADMINPANEL"=> array("name"=>"Dostep do panelu zarządzania", "actions"=>"ARWD"),
	"DB"		=> array("name"=>"Dostęp do bazy danych", "actions"=>"ARWD"),
	"API"		=> array("name"=>"Dostęp do API", "actions"=>"ARWD"),
);

?>