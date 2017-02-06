<?

function tinyerp_invoice_add( $dane ) {
	$dane["tinyerp_invoice__id"] = "0";
	return tinyerp_invoice_edit( $dane );
}

#
##
#

function tinyerp_invoice_edit( $dane ) {

	$dane = trimall($dane);

	if ($dane["tinyerp_invoice__id"]) {
		$tmp_dane = tinyerp_invoice_dane( $dane["tinyerp_invoice__id"] );
		$dane["record_create_date"] = $tmp_dane["record_create_date"];
		$dane["record_create_id"] = $tmp_dane["record_create_id"];
	}
	else {
		$dane["tinyerp_invoice__id"] = uuid();
		$dane["record_create_date"] = time();
		$dane["record_create_id"] = $_SESSION["content_user"]["content_user__id"];
	}

	$dane["tinyerp_invoice__crmid"] = $dane["tinyerp_invoice__crmid"] ? $dane["tinyerp_invoice__crmid"] : $tmp_dane["tinyerp_invoice__crmid"];
	$dane["record_modify_date"] = time();
	$dane["record_modify_id"] = $_SESSION["content_user"]["content_user__id"];

	$SQL_QUERY  = "REPLACE INTO ".DB_TABLEPREFIX."_tinyerp_invoice VALUES (\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoicegroup__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__numberstr"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__numbercounter"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__date_issue"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__date_delivery"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__customer_name"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__customer_city"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__customer_street"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__customer_postcode"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__customer_postcity"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__customer_country"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__customer_vatcode"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__payment_type"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__payment_date_limit"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__payment_done"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_user__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__issuername"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_invoice__receivername"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_bankaccount__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_id"])."'\n";
	$SQL_QUERY .= ")\n";
	
	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoice_edit()",$SQL_QUERY,$e); }

	return $dane["tinyerp_invoice__id"];
}

#
##
#

function tinyerp_invoice_dane( $tinyerp_invoice__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_invoice \n";
	$SQL_QUERY .= "WHERE tinyerp_invoice__id='". sm_secure_string_sql( $tinyerp_invoice__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoice_dane()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result->fetch(PDO::FETCH_ASSOC) : 0);
}

#
##
#

function tinyerp_invoice_get( $tinyerp_invoice__id ) {
	return tinyerp_invoice_dane( $tinyerp_invoice__id );
}

#
##
#

function tinyerp_invoice_delete( $tinyerp_invoice__id ) {

	$SQL_QUERY  = "DELETE FROM ".DB_TABLEPREFIX."_tinyerp_invoice \n";
	$SQL_QUERY .= "WHERE tinyerp_invoice__id='". sm_secure_string_sql( $tinyerp_invoice__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoice_delete()",$SQL_QUERY,$e); }

	return $result->rowCount();
}

#
##
#

function tinyerp_invoice_fetch_all() {

	$SQL_QUERY  = "SELECT *, tinyerp_company__name \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_invoice AS t1 \n";
	$SQL_QUERY .= "LEFT JOIN ".DB_TABLEPREFIX."_tinyerp_company AS t2 ON t2.tinyerp_company__id=t1.tinyerp_company__id \n";
	$SQL_QUERY .= "ORDER BY tinyerp_invoice__date_issue \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoice_fetch_all()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_invoice_fetch_by_company( $tinyerp_company__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_invoice \n";
	$SQL_QUERY .= "WHERE tinyerp_company__id='".sm_secure_string_sql($tinyerp_company__id)."' \n";
	$SQL_QUERY .= "ORDER BY tinyerp_invoice__name \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoice_fetch_by_company()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_invoice_fetch_by_invoicegroup( $tinyerp_invoicegroup__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_invoice \n";
	$SQL_QUERY .= "WHERE tinyerp_invoicegroup__id='".sm_secure_string_sql($tinyerp_invoicegroup__id)."' \n";
	$SQL_QUERY .= "ORDER BY tinyerp_invoice__name \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoice_fetch_by_invoicegroup()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_invoice_get_last_free( $tinyerp_invoicegroup__id ) {

	$SQL_QUERY  = "SELECT tinyerp_invoice__numbercounter \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_invoice \n";
	$SQL_QUERY .= "WHERE tinyerp_invoicegroup__id='". sm_secure_string_sql( $tinyerp_invoicegroup__id)."'";
	$SQL_QUERY .= "  AND YEAR(FROM_UNIXTIME(tinyerp_invoice__date_issue)) = YEAR(CURDATE()) ";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoice_get_last_free()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result->fetch(PDO::FETCH_ASSOC) : 0);
}

#
##
#

function tinyerp_invoice_search( $term ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_invoice \n";
	$SQL_QUERY .= "WHERE tinyerp_invoice__name LIKE '%".sm_secure_string_sql( $term )."%'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_invoice_search()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_invoice_validate( $dane ) {
	global $ERROR;

//	if ( !$dane["tinyerp_invoice__name"] ) {
//		$ERROR["tinyerp_invoice__name"] = "Podaj nazwę firmy";
//	}
	if( ! is_array($ERROR)){
		return true;
	}
}
?>