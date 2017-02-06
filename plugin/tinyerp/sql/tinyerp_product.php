<?

function tinyerp_product_add( $dane ) {
	$dane["tinyerp_product__id"] = "0";
	return tinyerp_product_edit( $dane );
}

#
##
#

function tinyerp_product_edit( $dane ) {

	$dane = trimall($dane);

	if ($dane["tinyerp_product__id"]) {
		$tmp_dane = tinyerp_product_dane( $dane["tinyerp_product__id"] );
		$dane["record_create_date"] = $tmp_dane["record_create_date"];
		$dane["record_create_id"] = $tmp_dane["record_create_id"];
	}
	else {
		$dane["tinyerp_product__id"] = uuid();
		$dane["record_create_date"] = time();
		$dane["record_create_id"] = $_SESSION["content_user"]["content_user__id"];
	}

	$dane["tinyerp_product__crmid"] = $dane["tinyerp_product__crmid"] ? $dane["tinyerp_product__crmid"] : $tmp_dane["tinyerp_product__crmid"];
	$dane["record_modify_date"] = time();
	$dane["record_modify_id"] = $_SESSION["content_user"]["content_user__id"];

	$SQL_QUERY  = "REPLACE INTO ".DB_TABLEPREFIX."_tinyerp_product VALUES (\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_product__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_product__name"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_product__idx"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_product__unit"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_product__price_netto"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_product__vat_code"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_id"])."'\n";
	$SQL_QUERY .= ")\n";
	
	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_product_edit()",$SQL_QUERY,$e); }

	return $dane["tinyerp_product__id"];
}

#
##
#

function tinyerp_product_dane( $tinyerp_product__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_product \n";
	$SQL_QUERY .= "WHERE tinyerp_product__id='". sm_secure_string_sql( $tinyerp_product__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_product_dane()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result->fetch(PDO::FETCH_ASSOC) : 0);
}

#
##
#

function tinyerp_product_get( $tinyerp_product__id ) {
	return tinyerp_product_dane( $tinyerp_product__id );
}

#
##
#

function tinyerp_product_delete( $tinyerp_product__id ) {

	$SQL_QUERY  = "DELETE FROM ".DB_TABLEPREFIX."_tinyerp_product \n";
	$SQL_QUERY .= "WHERE tinyerp_product__id='". sm_secure_string_sql( $tinyerp_product__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_product_delete()",$SQL_QUERY,$e); }

	return $result->rowCount();
}

#
##
#

function tinyerp_product_fetch_all() {

	$SQL_QUERY  = "SELECT *, tinyerp_company__name \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_product AS t1 \n";
	$SQL_QUERY .= "LEFT JOIN ".DB_TABLEPREFIX."_tinyerp_company AS t2 ON t2.tinyerp_company__id=t1.tinyerp_company__id \n";
	$SQL_QUERY .= "ORDER BY tinyerp_product__name \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_product_fetch_all()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_product_fetch_by_company( $tinyerp_company__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_product \n";
	$SQL_QUERY .= "WHERE tinyerp_company__id='".sm_secure_string_sql($tinyerp_company__id)."' \n";
	$SQL_QUERY .= "ORDER BY tinyerp_product__name \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_product_fetch_by_company()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_product_search( $term ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_product \n";
	$SQL_QUERY .= "WHERE tinyerp_product__name LIKE '%".sm_secure_string_sql( $term )."%'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_product_search()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_product_validate( $dane ) {
	global $ERROR;

	if ( !$dane["tinyerp_product__name"] ) {
		$ERROR["tinyerp_product__name"] = "Podaj nazwę konta";
	}
	if ( !$dane["tinyerp_product__unit"] ) {
		$ERROR["tinyerp_product__unit"] = "Podaj jednostkę";
	}
	if ( !$dane["tinyerp_product__price_netto"] ) {
		$ERROR["tinyerp_product__price_netto"] = "Podaj cenę";
	}
	if ( !$dane["tinyerp_product__vat_code"] ) {
		$ERROR["tinyerp_product__vat_code"] = "Wybierz stawkę VAT";
	}
	if( ! is_array($ERROR)){
		return true;
	}
}
?>