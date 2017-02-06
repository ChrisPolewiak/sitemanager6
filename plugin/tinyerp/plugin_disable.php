<?

$config=core_config_get_by_name("TINYERP");
$config_install = json_decode($config,1);
#echo "<pre>";
print_r($config_install["install"]);
if(isset($config_install["install"]["new_in_db"])) {
	foreach($config_install["install"]["new_in_db"] AS $table=>$idx) {
		foreach($idx AS $id) {
			$SQL_QUERY  = "DELETE FROM ".DB_TABLEPREFIX."_".$table." WHERE ".$table."__id='".$id."'";
#			echo "$SQL_QUERY\n";
			$SM_PDO->query( $SQL_QUERY );
		}
	}
}
if(isset($config_install["install"]["new_file"])) {
	foreach($config_install["install"]["new_file"] AS $filepath) {
		unlink($ROOT_DIR."/".$filepath);
	}
}


// DROP DATABASE
$TABLES2DELETE = array(
	"tinyerp_bankaccount",
	"tinyerp_company",
	"tinyerp_customer",
	"tinyerp_invoice",
	"tinyerp_invoicegroup",
	"tinyerp_invoiceline",
	"tinyerp_product",
	"tinyerp_user",
);
foreach($TABLES2DELETE AS $table) {
	$SQL_QUERY  = "DROP TABLE ".DB_TABLEPREFIX."_".$table;
#	echo "$SQL_QUERY\n";
	$SM_PDO->query( $SQL_QUERY );
}

?>