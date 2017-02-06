<?

function tinyerp_user_add( $dane ) {
	$dane["tinyerp_user__id"] = "0";
	return tinyerp_user_edit( $dane );
}

#
##
#

function tinyerp_user_edit( $dane ) {

	$dane = trimall($dane);

	if ($dane["tinyerp_user__id"]) {
		$tmp_dane = tinyerp_user_dane( $dane["tinyerp_user__id"] );
		$dane["record_create_date"] = $tmp_dane["record_create_date"];
		$dane["record_create_id"] = $tmp_dane["record_create_id"];
	}
	else {
		$dane["tinyerp_user__id"] = uuid();
		$dane["record_create_date"] = time();
		$dane["record_create_id"] = $_SESSION["content_user"]["content_user__id"];
	}

	$dane["tinyerp_user__crmid"] = $dane["tinyerp_user__crmid"] ? $dane["tinyerp_user__crmid"] : $tmp_dane["tinyerp_user__crmid"];
	$dane["record_modify_date"] = time();
	$dane["record_modify_id"] = $_SESSION["content_user"]["content_user__id"];

	$SQL_QUERY  = "REPLACE INTO ".DB_TABLEPREFIX."_tinyerp_user VALUES (\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_user__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_company__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["content_user__id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["tinyerp_user__acl"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_create_id"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_date"])."',\n";
	$SQL_QUERY .= "'". sm_secure_string_sql( $dane["record_modify_id"])."'\n";
	$SQL_QUERY .= ")\n";
	
	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_user_edit()",$SQL_QUERY,$e); }

	return $dane["tinyerp_user__id"];
}

#
##
#

function tinyerp_user_dane( $tinyerp_user__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_user \n";
	$SQL_QUERY .= "WHERE tinyerp_user__id='". sm_secure_string_sql( $tinyerp_user__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_user_dane()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result->fetch(PDO::FETCH_ASSOC) : 0);
}

#
##
#

function tinyerp_user_get( $tinyerp_user__id ) {

	$SQL_QUERY  = "SELECT t1.*, \n";
	$SQL_QUERY .= "  t2.content_user__username, t2.content_user__firstname, t2.content_user__surname, t2.content_user__email, \n";
	$SQL_QUERY .= "  t3.* \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_user AS t1 \n";
	$SQL_QUERY .= "LEFT JOIN ".DB_TABLEPREFIX."_content_user AS t2 ON t2.content_user__id=t1.content_user__id \n";
	$SQL_QUERY .= "LEFT JOIN ".DB_TABLEPREFIX."_tinyerp_company AS t3 ON t3.tinyerp_company__id=t1.tinyerp_company__id \n";
	$SQL_QUERY .= "WHERE tinyerp_user__id='". sm_secure_string_sql( $tinyerp_user__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_user_dane()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result->fetch(PDO::FETCH_ASSOC) : 0);
}

#
##
#

function tinyerp_user_delete( $tinyerp_user__id ) {

	$SQL_QUERY  = "DELETE FROM ".DB_TABLEPREFIX."_tinyerp_user \n";
	$SQL_QUERY .= "WHERE tinyerp_user__id='". sm_secure_string_sql( $tinyerp_user__id)."'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_user_delete()",$SQL_QUERY,$e); }

	return $result->rowCount();
}

#
##
#

function tinyerp_user_fetch_all() {

	$SQL_QUERY  = "SELECT *, content_user__username, tinyerp_company__name \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_user AS t1 \n";
	$SQL_QUERY .= "LEFT JOIN ".DB_TABLEPREFIX."_content_user AS t2 ON t2.content_user__id=t1.content_user__id \n";
	$SQL_QUERY .= "LEFT JOIN ".DB_TABLEPREFIX."_tinyerp_company AS t3 ON t3.tinyerp_company__id=t1.tinyerp_company__id \n";
	$SQL_QUERY .= "ORDER BY t1.content_user__id \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_user_fetch_all()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_user_fetch_by_company( $tinyerp_company__id ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_user \n";
	$SQL_QUERY .= "WHERE tinyerp_company__id='".sm_secure_string_sql($tinyerp_company__id)."' \n";
	$SQL_QUERY .= "ORDER BY tinyerp_user__name \n";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_user_fetch_by_company()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_user_search( $term ) {

	$SQL_QUERY  = "SELECT * \n";
	$SQL_QUERY .= "FROM ".DB_TABLEPREFIX."_tinyerp_user \n";
	$SQL_QUERY .= "WHERE tinyerp_user__name LIKE '%".sm_secure_string_sql( $term )."%'";

	try { $result = $GLOBALS["SM_PDO"]->query($SQL_QUERY); } catch(PDOException $e) { sqlerr("tinyerp_user_search()",$SQL_QUERY,$e); }

	return ($result->rowCount()>0 ? $result : 0);       
}

#
##
#

function tinyerp_user_validate( $dane ) {
	global $ERROR;

	if ( !$dane["tinyerp_company__id"] ) {
		$ERROR["tinyerp_company__id"] = "Wybierz firmę";
	}
	if ( !$dane["content_user__id"] ) {
		$ERROR["content_user__id"] = "Wybierz użytkownika";
	}
	if ( !$dane["tinyerp_user__acl"] ) {
		$ERROR["tinyerp_user__acl"] = "Wybierz uprawnienia";
	}
	if( ! is_array($ERROR)){
		return true;
	}
}
?>