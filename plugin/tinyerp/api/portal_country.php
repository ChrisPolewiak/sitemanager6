<?php

$API["msz/portal_country/get"] = array(
	"function" => "sm_api_plugin_msz_portal_country_get",
	"RequestMethodAllowed" => "GET|POST",
	"acl" => "MSZ_API_READ",
	"plugin" => "msz",
	"group" => "portal_country",
	"encryption" => true,
	"description" => "This method return all information about portal_country object.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_country__id", "default" => "required", "detail" => "unique portal_country ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_country__id", "type" => "uid", "description" => "unique portal_country ID" ),
		array( "path" => "/", "name" => "portal_country__crmid", "type" => "uid", "description" => "unique CRM portal_country ID" ),
		array( "path" => "/", "name" => "portal_country__name_pl", "type" => "string", "description" => "country name" ),
		array( "path" => "/", "name" => "portal_country__name_en", "type" => "string", "description" => "country name" ),
		array( "path" => "/", "name" => "portal_country__name_fr", "type" => "string", "description" => "country name" ),
		array( "path" => "/", "name" => "record_create_date", "type" => "date", "description" => "record create date" ),
		array( "path" => "/", "name" => "record_modify_date", "type" => "date", "description" => "record last modify date" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		"portal_country__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"portal_country__crmid" => "aa13a10a-55ff-11e2-b079-00226bbd589b",
		"portal_country__name_pl" => "Poland",
		"record_create_date" => "1970-01-01 00:00:00 UTC",
		"record_modify_date" => "1970-01-01 00:00:00 UTC",
		),
	);

function sm_api_plugin_msz_portal_country_get()
{
	$portal_country__id = $_REQUEST["id"];

	if ( $row = portal_country_get( $portal_country__id ) ) {
		$response[] = array(
			"portal_country__id" => $row["portal_country__id"],
			"portal_country__crmid" => $row["portal_country__crmid"],
			"portal_country__name_pl" => $row["portal_country__name_pl"],
			"portal_country__name_en" => $row["portal_country__name_en"],
			"portal_country__name_fr" => $row["portal_country__name_fr"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}
	return $response;
}

$API["msz/portal_country/fetch"] = array(
	"function" => "sm_api_plugin_msz_portal_country_fetch",
	"RequestMethodAllowed" => "GET|POST",
	"acl" => "MSZ_API_READ",
	"plugin" => "msz",
	"group" => "portal_country",
	"encryption" => true,
	"description" => "This method return all portal_country objects.",
	"return" => array(
		array( "path" => "/", "name" => "portal_country__id", "type" => "uid", "description" => "unique portal_country ID" ),
		array( "path" => "/", "name" => "portal_country__crmid", "type" => "uid", "description" => "unique CRM portal_country ID" ),
		array( "path" => "/", "name" => "portal_country__name_pl", "type" => "string", "description" => "country name" ),
		array( "path" => "/", "name" => "portal_country__name_en", "type" => "string", "description" => "country name" ),
		array( "path" => "/", "name" => "portal_country__name_fr", "type" => "string", "description" => "country name" ),
		array( "path" => "/", "name" => "record_create_date", "type" => "date", "description" => "record create date" ),
		array( "path" => "/", "name" => "record_modify_date", "type" => "date", "description" => "record last modify date" ),
		),
	"example_query" => "",
	"example_response" => array(
		"portal_country__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"portal_country__crmid" => "aa13a10a-55ff-11e2-b079-00226bbd589b",
		"portal_country__name_pl" => "Poland",
		"record_create_date" => "1970-01-01 00:00:00 UTC",
		"record_modify_date" => "1970-01-01 00:00:00 UTC",
		),
	);

function sm_api_plugin_msz_portal_country_fetch()
{
	if ( $result = portal_country_fetch_all() ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_country__id" => $row["portal_country__id"],
				"portal_country__crmid" => $row["portal_country__crmid"],
				"portal_country__name_pl" => $row["portal_country__name_pl"],
				"portal_country__name_en" => $row["portal_country__name_en"],
				"portal_country__name_fr" => $row["portal_country__name_fr"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}
	return $response;
}

$API["msz/portal_country/delete"] = array(
	"function" => "sm_api_plugin_msz_portal_country_delete",
	"RequestMethodAllowed" => "POST|DELETE|GET",
	"acl" => "MSZ_API_DELETE",
	"plugin" => "msz",
	"group" => "portal_country",
	"encryption" => true,
	"description" => "This method delete selected portal_country objects.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_country__id", "default" => "required", "detail" => "unique portal_country ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "deleted", "type" => "string", "description" => "true if succes, false if not" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		"deleted" => "true",
		),
	);

function sm_api_plugin_msz_portal_country_delete()
{
	$portal_country__id = $_REQUEST["id"];

	if ( $result = portal_country_delete( $portal_country__id ) ) {
		// delete from history
		core_changed_delete_by_id( $portal_country__id, "portal_country" );
		$response["deleted"] = true;
	} else {
		$response["deleted"] = false;
	}

	return $response;
}

$API["msz/portal_country/add"] = array(
	"function" => "sm_api_plugin_msz_portal_country_add",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_ADD",
	"plugin" => "msz",
	"group" => "portal_country",
	"encryption" => true,
	"description" => "This method add new portal_country object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "data[portal_country__crmid]", "type" => "uid", "valid" => "portal_country__crmid", "default" => "null", "detail" => "unique portal_country CRM ID", ),
		array( "argument" => "data[portal_country__name_pl]", "type" => "string", "valid" => "portal_country__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_country__name_en]", "type" => "string", "valid" => "portal_country__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_country__name_fr]", "type" => "string", "valid" => "portal_country__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_country__id", "type" => "uid", "description" => "new id if added, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_country__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_country__name_pl]=Polska",
	"example_response" => array(
		"portal_country__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_country_add()
{
	global $ERROR, $data;

	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}

	portal_country_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		if ( $portal_country__id = portal_country_add( $data ) ) {
			core_changed_delete_by_id( $portal_country__id, "portal_country" );
			$response["portal_country__id"] = $portal_country__id;
		}
	}
	return $response;
}

$API["msz/portal_country/edit"] = array(
	"function" => "sm_api_plugin_msz_portal_country_edit",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_WRITE",
	"plugin" => "msz",
	"group" => "portal_country",
	"encryption" => true,
	"description" => "This method edit new portal_country object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "portal_country__id", "default" => "required", "detail" => "unique portal_country ID", ),
		array( "argument" => "data[portal_country__crmid]", "type" => "uid", "valid" => "portal_country__crmid", "default" => "null", "detail" => "unique portal_country CRM ID", ),
		array( "argument" => "data[portal_country__name_pl]", "type" => "string", "valid" => "portal_country__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_country__name_en]", "type" => "string", "valid" => "portal_country__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_country__name_fr]", "type" => "string", "valid" => "portal_country__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_country__id", "type" => "uid", "description" => "portal_country__id if edited, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_country__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_country__name_pl]=Polska",
	"example_response" => array(
		"portal_country__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_country_edit()
{
	global $ERROR, $data;

$tmpfile = "/home/app/tmp/msz-api-".date("YmdHis")."-".uniqid().".txt";
$fp = fopen($tmpfile, "w");
fputs($fp, var_export($data,true));
fclose($fp);
chmod($tmpfile,0666);


	$portal_country__id = $_REQUEST["id"];

	if ( !$portal_country__id ) {
		$ERROR[] = "Missing portal_country__id";
	}elseif ( ! portal_country_dane( $portal_country__id ) ) {
		$ERROR[] = "portal_country__id not exists";
	}
	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}
	portal_country_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		$data["portal_country__id"] = $portal_country__id;
		if ( $portal_country__id = portal_country_edit( $data ) ) {
			core_changed_delete_by_id( $portal_country__id, "portal_country" );
			$response["portal_country__id"] = $portal_country__id;
		}
	}
	return $response;
}

?>