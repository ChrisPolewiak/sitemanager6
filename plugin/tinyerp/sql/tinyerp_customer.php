<?

function tinyerp_customer_add( $dane ) {
	$dane["tinyerp_customer__id"] = "0";
	return tinyerp_customer_edit( $dane );
}

#
##
#

function tinyerp_customer_edit( $dane ) {

	$dane = trimall($dane);

	if ($dane["tinyerp_customer__id"]) {
		$tmp_dane = tinyerp_customer_dane( $dane["tinyerp_customer__id"] );
		$dane["record_create_date"] = $tmp_dane["record_create_date"];
		$dane["record_create_id"] = $tmp_dane["record_create_id"];
	}
	else {
		$dane["tinyerp_customer__id"] = uuid();
		$dane["record_create_date"] = time();
		$dane["record_create_id"] = $_SESSION["content_user"]["content_user__id"];
	}

	$dane["tinyerp_customer__crmid"] = $dane["tinyerp_customer__crmid"] ? $dane["tinyerp_customer__crmid"] : $tmp_dane["tinyerp_customer__crmid"];
	$dane["record_modify_date"] = time();
	$dane["record_modify_id"] = $_SESSION["content_user"]["content_user__id"];

	$SQL_QUERY  = "REPLACE INTO ".DB_TABLEPREFIX."_tinyerp_customer VALUES (\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__name"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__city"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__street"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__postcode"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__postcity"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__country_id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__vatcode"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__regon"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__email"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__payment_type"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_customer__payment_days_limit"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_id"])."'\n";
	$SQL_QUERY .= ")\n";
	
	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_customer_edit()",$SQL_QUERY,$e); }

	return $dane["tinyerp_customer__id"];
}

#
##
#

function tinyerp_customer_dane( $tinyerp_customer__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_customer \n";
	$SQL_QUERY .= "WHERE tinyerp_customer__id='". sm_secure_string_sql( $tinyerp_customer__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_customer_dane()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result->fetch(PDO::FETCH_ASSOC) : 0);
}

#
##
#

function tinyerp_customer_get( $tinyerp_customer__id ) {

	$SQL_QUERY  = "SELECT t1.*,content_peeklistitem__value01 AS tinyerp_customer__country_name \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_customer AS t1 \n";
	$SQL_QUERY .= "LEFT JOIN ".DB_TABLEPREFIX."_content_peeklistitem AS t2 ON t2.content_peeklistitem__id=t1.tinyerp_customer__country_id \n";
	$SQL_QUERY .= "LEFT JOIN ".DB_TABLEPREFIX."_content_peeklist AS t3 ON t3.content_peeklist__id=t2.content_peeklist__id \n";
	$SQL_QUERY .= "WHERE tinyerp_customer__id='". sm_secure_string_sql( $tinyerp_customer__id)."'";
	$SQL_QUERY .= "  AND t3.content_peeklist__sysname='COUNTRY'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_customer_dane()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result->fetch(PDO::FETCH_ASSOC) : 0);
}

#
##
#

function tinyerp_customer_delete( $tinyerp_customer__id ) {

	$SQL_QUERY  = "DELETE FROM ".DB_TABLEPREFIX."_tinyerp_customer \n";
	$SQL_QUERY .= "WHERE tinyerp_customer__id='". sm_secure_string_sql( $tinyerp_customer__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_customer_delete()",$SQL_QUERY,$e); }

	return $result->rowCount();
}

#
##
#

function tinyerp_customer_fetch_all() {

	$SQL_QUERY  = "SELECT *, tinyerp_company__name \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_customer AS t1 \n";
	$SQL_QUERY .= "LEFT JOIN ".DB_TABLEPREFIX."_tinyerp_company AS t2 ON t2.tinyerp_company__id=t1.tinyerp_company__id \n";
	$SQL_QUERY .= "ORDER BY tinyerp_customer__name \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_customer_fetch_all()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_customer_fetch_by_company( $tinyerp_company__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_customer \n";
	$SQL_QUERY .= "WHERE tinyerp_company__id='".sm_secure_string_sql($tinyerp_company__id)."' \n";
	$SQL_QUERY .= "ORDER BY tinyerp_customer__name \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_customer_fetch_by_company()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_customer_search( $term ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_customer \n";
	$SQL_QUERY .= "WHERE tinyerp_customer__name LIKE '%".sm_secure_string_sql( $term )."%'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_customer_search()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_customer_validate( $dane ) {
	global $ERROR;

	if ( !$dane["tinyerp_customer__name"] ) {
		$ERROR["tinyerp_customer__name"] = "Podaj nazwę firmy";
	}
	if( ! is_array($ERROR)){
		return true;
	}
}
?>