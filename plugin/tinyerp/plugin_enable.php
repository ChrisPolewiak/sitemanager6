<?

$content_user__id = $_SESSION["content_user"]["content_user__id"];

// CREATE DATABASE
$sqlfile = file($SM_PLUGINS[$_GET["plugin"]]["dir"]."/init.sql") or die("Missing init.sql file");
$sqlquery = "";
foreach( $sqlfile AS $line ) {
	$line = trim($line);
	$sqlquery .= $line . "\n";
	if(preg_match( "/;$/", $line)) {
		$sqlquery = preg_replace("/(%prefix%)/is", DB_TABLEPREFIX, $sqlquery);
		$SM_PDO->query( $sqlquery );
		$sqlquery = "";
	}
}

// Create ACL - Access
$content_access__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_access \n";
$SQL_QUERY .= "VALUES ('".$content_access__id."', 'Tiny ERP Admin', '|TINYERP_ADMINPANEL_ADD|TINYERP_ADMINPANEL_READ|TINYERP_ADMINPANEL_WRITE|TINYERP_ADMINPANEL_DELETE|TINYERP_DB_ADD|TINYERP_DB_READ|TINYERP_DB_WRITE|TINYERP_DB_DELETE|', '0', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );
$_core_config["install"]["new_in_db"]["content_access"][] = $content_access__id;

// Create ACL - User Group
$content_usergroup__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_usergroup \n";
$SQL_QUERY .= "VALUES ('".$content_usergroup__id."', 'Tiny ERP Admin', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );
$_core_config["install"]["new_in_db"]["content_usergroup"][] = $content_usergroup__id;

// Create ACL - Access 2 User Group
$content_usergroupacl__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_usergroupacl \n";
$SQL_QUERY .= "VALUES ('".$content_usergroupacl__id."', '".$content_access__id."', '".$content_usergroup__id."', '1', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );
$_core_config["install"]["new_in_db"]["content_usergroupacl"][] = $content_usergroupacl__id;

// Add current User to new UserGroup
$content_usergroupacl__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_user2content_usergroup \n";
$SQL_QUERY .= "VALUES ('".$content_usergroupacl__id."', '".$content_user__id."', '".$content_usergroup__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );
$_core_config["install"]["new_in_db"]["content_usergroupacl"][] = $content_usergroupacl__id;


//
// Create PeekList for Vat Code
//
$content_peeklist__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklist \n";
$SQL_QUERY .= "VALUES ('".$content_peeklist__id."', 'TINYERP', 'Kody VAT', 'VAT_CODE', 'Nazwa stawki VAT', 'Wartość stawki VAT', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );
$_core_config["install"]["new_in_db"]["content_peeklist"][] = $content_peeklist__id;

// Create PeekListItem for VatCode 22%
$content_peeklistitem__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklistitem \n";
$SQL_QUERY .= "VALUES ('".$content_peeklistitem__id."', '".$content_peeklist__id."', '', '22%', '0.22', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );

// Create PeekListItem for VatCode 7%
$content_peeklistitem__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklistitem \n";
$SQL_QUERY .= "VALUES ('".$content_peeklistitem__id."', '".$content_peeklist__id."', '', '7%', '0.7', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );

// Create PeekListItem for VatCode 0%
$content_peeklistitem__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklistitem \n";
$SQL_QUERY .= "VALUES ('".$content_peeklistitem__id."', '".$content_peeklist__id."', '', '0%', '0.0', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );

// Create PeekListItem for VatCode zw
$content_peeklistitem__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklistitem \n";
$SQL_QUERY .= "VALUES ('".$content_peeklistitem__id."', '".$content_peeklist__id."', '', 'zw', '0.0', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );

$_core_config["install"]["new_in_db"]["content_peeklistitem"][] = $content_peeklist__id;

// Rebuild PeekList for VatCode
content_peeklist_rebuild( $content_peeklist__id );
$_core_config["install"]["new_file"][] = "cache/tinyerp-vat_code.php";


//
// Create PeekList for PaymentType
//
$content_peeklist__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklist \n";
$SQL_QUERY .= "VALUES ('".$content_peeklist__id."', 'TINYERP', 'Sposób płatności', 'PAYMENT_TYPE', 'Sposób płatności', '', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );
$_core_config["install"]["new_in_db"]["content_peeklist"][] = $content_peeklist__id;

// Create PeekListItem for PaymentType cash
$content_peeklistitem__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklistitem \n";
$SQL_QUERY .= "VALUES ('".$content_peeklistitem__id."', '".$content_peeklist__id."', '', 'gotówka', '', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );

// Create PeekListItem for PaymentType income
$content_peeklistitem__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklistitem \n";
$SQL_QUERY .= "VALUES ('".$content_peeklistitem__id."', '".$content_peeklist__id."', '', 'przelew', '', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );

$_core_config["install"]["new_in_db"]["content_peeklistitem"][] = $content_peeklist__id;

// Rebuild PeekList for PaymentType
content_peeklist_rebuild( $content_peeklist__id );
$_core_config["install"]["new_file"][] = "cache/tinyerp-paymenttype.php";


//
// Create PeekList for Country
//
$content_peeklist__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklist \n";
$SQL_QUERY .= "VALUES ('".$content_peeklist__id."', 'TINYERP', 'Państwo', 'COUNTRY', 'Nazwa państwa', '', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );
$_core_config["install"]["new_in_db"]["content_peeklist"][] = $content_peeklist__id;

// Create PeekListItem for Country PL
$content_peeklistitem__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklistitem \n";
$SQL_QUERY .= "VALUES ('".$content_peeklistitem__id."', '".$content_peeklist__id."', '', 'Polska', '', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );

$_core_config["install"]["new_in_db"]["content_peeklistitem"][] = $content_peeklist__id;

// Rebuild PeekList for Country
content_peeklist_rebuild( $content_peeklist__id );
$_core_config["install"]["new_file"][] = "cache/tinyerp-country.php";


//
// Create PeekList for ACL
//
$content_peeklist__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklist \n";
$SQL_QUERY .= "VALUES ('".$content_peeklist__id."', 'TINYERP', 'Uprawnienia', 'ACL', 'Nazwa uprawnienia', '', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );
$_core_config["install"]["new_in_db"]["content_peeklist"][] = $content_peeklist__id;

// Create PeekListItem for ACL Admin
$content_peeklistitem__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklistitem \n";
$SQL_QUERY .= "VALUES ('".$content_peeklistitem__id."', '".$content_peeklist__id."', '', 'Administrator', '', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );

// Create PeekListItem for ACL RO
$content_peeklistitem__id = uuid();
$SQL_QUERY  = "INSERT INTO ".DB_TABLEPREFIX."_content_peeklistitem \n";
$SQL_QUERY .= "VALUES ('".$content_peeklistitem__id."', '".$content_peeklist__id."', '', 'Read-Only', '', '', '', '', '', '', '', '', '', '".time()."', '".$content_user__id."', '".time()."', '".$content_user__id."')";
$SM_PDO->query( $SQL_QUERY );

$_core_config["install"]["new_in_db"]["content_peeklistitem"][] = $content_peeklist__id;

// Rebuild PeekList for ACL
content_peeklist_rebuild( $content_peeklist__id );
$_core_config["install"]["new_file"][] = "cache/tinyerp-acl.php";


core_config_edit(array(
	"core_config__name" => "TINYERP",
	"core_config__value" => json_encode($_core_config)
));

?>