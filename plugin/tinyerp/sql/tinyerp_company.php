<?

function tinyerp_company_add( $dane ) {
	$dane["tinyerp_company__id"] = "0";
	return tinyerp_company_edit( $dane );
}

#
##
#

function tinyerp_company_edit( $dane ) {

	$dane = trimall($dane);

	if ($dane["tinyerp_company__id"]) {
		$tmp_dane = tinyerp_company_dane( $dane["tinyerp_company__id"] );
		$dane["record_create_date"] = $tmp_dane["record_create_date"];
		$dane["record_create_id"] = $tmp_dane["record_create_id"];
	}
	else {
		$dane["tinyerp_company__id"] = uuid();
		$dane["record_create_date"] = time();
		$dane["record_create_id"] = $_SESSION["content_user"]["content_user__id"];
	}

	$dane["tinyerp_company__crmid"] = $dane["tinyerp_company__crmid"] ? $dane["tinyerp_company__crmid"] : $tmp_dane["tinyerp_company__crmid"];
	$dane["record_modify_date"] = time();
	$dane["record_modify_id"] = $_SESSION["content_user"]["content_user__id"];

	$SQL_QUERY  = "REPLACE INTO ".DB_TABLEPREFIX."_tinyerp_company VALUES (\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__name"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__city"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__street"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__postcode"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__postcity"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__country_id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__vatcode"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__regon"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__email"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_id"])."'\n";
	$SQL_QUERY .= ")\n";
	
	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_company_edit()",$SQL_QUERY,$e); }

	return $dane["tinyerp_company__id"];
}

#
##
#

function tinyerp_company_dane( $tinyerp_company__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_company \n";
	$SQL_QUERY .= "WHERE tinyerp_company__id='". sm_secure_string_sql( $tinyerp_company__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_company_dane()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result->fetch(PDO::FETCH_ASSOC) : 0);
}

#
##
#

function tinyerp_company_get( $tinyerp_company__id ) {
	return tinyerp_company_dane( $tinyerp_company__id );
}

#
##
#

function tinyerp_company_delete( $tinyerp_company__id ) {

	$SQL_QUERY  = "DELETE FROM ".DB_TABLEPREFIX."_tinyerp_company \n";
	$SQL_QUERY .= "WHERE tinyerp_company__id='". sm_secure_string_sql( $tinyerp_company__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_company_delete()",$SQL_QUERY,$e); }

	return $result->rowCount();
}

#
##
#

function tinyerp_company_fetch_all() {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_company \n";
	$SQL_QUERY .= "ORDER BY tinyerp_company__name \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_company_fetch_all()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_company_search( $term ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_company \n";
	$SQL_QUERY .= "WHERE tinyerp_company__name LIKE '%".sm_secure_string_sql( $term )."%'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_company_search()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_company_validate( $dane ) {
	global $ERROR;

	if ( !$dane["tinyerp_company__name"] ) {
		$ERROR["tinyerp_company__name"] = "Podaj nazwę firmy";
	}
	if( ! is_array($ERROR)){
		return true;
	}
}
?>