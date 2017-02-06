<?

function tinyerp_bankaccount_add( $dane ) {
	$dane["tinyerp_bankaccount__id"] = "0";
	return tinyerp_bankaccount_edit( $dane );
}

#
##
#

function tinyerp_bankaccount_edit( $dane ) {

	$dane = trimall($dane);

	if ($dane["tinyerp_bankaccount__id"]) {
		$tmp_dane = tinyerp_bankaccount_dane( $dane["tinyerp_bankaccount__id"] );
		$dane["record_create_date"] = $tmp_dane["record_create_date"];
		$dane["record_create_id"] = $tmp_dane["record_create_id"];
	}
	else {
		$dane["tinyerp_bankaccount__id"] = uuid();
		$dane["record_create_date"] = time();
		$dane["record_create_id"] = $_SESSION["content_user"]["content_user__id"];
	}

	$dane["tinyerp_bankaccount__crmid"] = $dane["tinyerp_bankaccount__crmid"] ? $dane["tinyerp_bankaccount__crmid"] : $tmp_dane["tinyerp_bankaccount__crmid"];
	$dane["record_modify_date"] = time();
	$dane["record_modify_id"] = $_SESSION["content_user"]["content_user__id"];

	$SQL_QUERY  = "REPLACE INTO ".DB_TABLEPREFIX."_tinyerp_bankaccount VALUES (\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_bankaccount__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_bankaccount__name"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_bankaccount__number"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_id"])."'\n";
	$SQL_QUERY .= ")\n";
	
	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_bankaccount_edit()",$SQL_QUERY,$e); }

	return $dane["tinyerp_bankaccount__id"];
}

#
##
#

function tinyerp_bankaccount_dane( $tinyerp_bankaccount__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_bankaccount \n";
	$SQL_QUERY .= "WHERE tinyerp_bankaccount__id='". sm_secure_string_sql( $tinyerp_bankaccount__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_bankaccount_dane()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result->fetch(PDO::FETCH_ASSOC) : 0);
}

#
##
#

function tinyerp_bankaccount_get( $tinyerp_bankaccount__id ) {
	return tinyerp_bankaccount_dane( $tinyerp_bankaccount__id );
}

#
##
#

function tinyerp_bankaccount_delete( $tinyerp_bankaccount__id ) {

	$SQL_QUERY  = "DELETE FROM ".DB_TABLEPREFIX."_tinyerp_bankaccount \n";
	$SQL_QUERY .= "WHERE tinyerp_bankaccount__id='". sm_secure_string_sql( $tinyerp_bankaccount__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_bankaccount_delete()",$SQL_QUERY,$e); }

	return $result->rowCount();
}

#
##
#

function tinyerp_bankaccount_fetch_all() {

	$SQL_QUERY  = "SELECT *, tinyerp_company__name \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_bankaccount AS t1 \n";
	$SQL_QUERY .= "LEFT JOIN ".DB_TABLEPREFIX."_tinyerp_company AS t2 ON t2.tinyerp_company__id=t1.tinyerp_company__id \n";
	$SQL_QUERY .= "ORDER BY tinyerp_bankaccount__name \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_bankaccount_fetch_all()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_bankaccount_fetch_by_company( $tinyerp_company__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_bankaccount \n";
	$SQL_QUERY .= "WHERE tinyerp_company__id='".sm_secure_string_sql($tinyerp_company__id)."' \n";
	$SQL_QUERY .= "ORDER BY tinyerp_bankaccount__name \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_bankaccount_fetch_by_company()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_bankaccount_search( $term ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_bankaccount \n";
	$SQL_QUERY .= "WHERE tinyerp_bankaccount__name LIKE '%".sm_secure_string_sql( $term )."%'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_bankaccount_search()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_bankaccount_validate( $dane ) {
	global $ERROR;

	if ( !$dane["tinyerp_bankaccount__name"] ) {
		$ERROR["tinyerp_bankaccount__name"] = "Podaj nazwę konta";
	}
	if ( !$dane["tinyerp_bankaccount__number"] ) {
		$ERROR["tinyerp_bankaccount__number"] = "Podaj numer konta";
	}
	if( ! is_array($ERROR)){
		return true;
	}
}
?>