<?

function tinyerp_invoiceline_add( $dane ) {
	$dane["tinyerp_invoiceline__id"] = "0";
	return tinyerp_invoiceline_edit( $dane );
}

#
##
#

function tinyerp_invoiceline_edit( $dane ) {

	$dane = trimall($dane);

	if ($dane["tinyerp_invoiceline__id"]) {
		$tmp_dane = tinyerp_invoiceline_dane( $dane["tinyerp_invoiceline__id"] );
		$dane["record_create_date"] = $tmp_dane["record_create_date"];
		$dane["record_create_id"] = $tmp_dane["record_create_id"];
	}
	else {
		$dane["tinyerp_invoiceline__id"] = uuid();
		$dane["record_create_date"] = time();
		$dane["record_create_id"] = $_SESSION["content_user"]["content_user__id"];
	}

	$dane["tinyerp_invoiceline__crmid"] = $dane["tinyerp_invoiceline__crmid"] ? $dane["tinyerp_invoiceline__crmid"] : $tmp_dane["tinyerp_invoiceline__crmid"];
	$dane["record_modify_date"] = time();
	$dane["record_modify_id"] = $_SESSION["content_user"]["content_user__id"];

	$SQL_QUERY  = "REPLACE INTO ".DB_TABLEPREFIX."_tinyerp_invoiceline VALUES (\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoiceline__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_product__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoiceline__number"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoiceline__product_name"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoiceline__product_idx"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoiceline__quantity"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoiceline__unit"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoiceline__price_netto"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoiceline__total_netto"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoiceline__vat_code"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoiceline__vat_amount"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoiceline__total_brutto"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_id"])."'\n";
	$SQL_QUERY .= ")\n";
	
	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoiceline_edit()",$SQL_QUERY,$e); }

	return $dane["tinyerp_invoiceline__id"];
}

#
##
#

function tinyerp_invoiceline_dane( $tinyerp_invoiceline__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_invoiceline \n";
	$SQL_QUERY .= "WHERE tinyerp_invoiceline__id='". sm_secure_string_sql( $tinyerp_invoiceline__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoiceline_dane()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result->fetch(PDO::FETCH_ASSOC) : 0);
}

#
##
#

function tinyerp_invoiceline_get( $tinyerp_invoiceline__id ) {
	return tinyerp_invoiceline_dane( $tinyerp_invoiceline__id );
}

#
##
#

function tinyerp_invoiceline_delete( $tinyerp_invoiceline__id ) {

	$SQL_QUERY  = "DELETE FROM ".DB_TABLEPREFIX."_tinyerp_invoiceline \n";
	$SQL_QUERY .= "WHERE tinyerp_invoiceline__id='". sm_secure_string_sql( $tinyerp_invoiceline__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoiceline_delete()",$SQL_QUERY,$e); }

	return $result->rowCount();
}

#
##
#

function tinyerp_invoiceline_fetch_all() {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_invoiceline \n";
	$SQL_QUERY .= "ORDER BY tinyerp_invoiceline__number \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoiceline_fetch_all()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_invoiceline_fetch_by_invoice( $tinyerp_invoice__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_invoiceline \n";
	$SQL_QUERY .= "WHERE tinyerp_invoice__id='".sm_secure_string_sql($tinyerp_invoice__id)."' \n";
	$SQL_QUERY .= "ORDER BY tinyerp_invoiceline__number \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoiceline_fetch_by_invoice()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_invoiceline_fetch_by_product( $tinyerp_product__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_invoiceline \n";
	$SQL_QUERY .= "WHERE tinyerp_product__id='".sm_secure_string_sql($tinyerp_product__id)."' \n";
	$SQL_QUERY .= "ORDER BY tinyerp_invoiceline__name \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoiceline_fetch_by_product()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_invoiceline_search( $term ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_invoiceline \n";
	$SQL_QUERY .= "WHERE tinyerp_invoiceline__name LIKE '%".sm_secure_string_sql( $term )."%'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoiceline_search()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_invoiceline_validate( $dane ) {
	global $ERROR;

	if ( !$dane["tinyerp_invoiceline__name"] ) {
		$ERROR["tinyerp_invoiceline__name"] = "Podaj nazwę konta";
	}
	if ( !$dane["tinyerp_invoiceline__number"] ) {
		$ERROR["tinyerp_invoiceline__number"] = "Podaj numer konta";
	}
	if( ! is_array($ERROR)){
		return true;
	}
}
?>