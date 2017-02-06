<?php

$API["msz/portal_language/get"] = array(
	"name" => "MSZ Get portal_language",
	"function" => "sm_api_plugin_msz_portal_language_get",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_language__id",
	"plugin" => "msz",
	"group" => "portal_language",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_language__id", "default" => "required", "detail" => "unique portal_language__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_language_get()
{
	$portal_language__id = $_REQUEST["id"];

	if ( $row = portal_language_get( $portal_language__id ) ) {
		$response[] = array(
			"portal_language__id" => $row["portal_language__id"],
			"portal_language__crmid" => $row["portal_language__crmid"],
			"portal_language__name_pl" => $row["portal_language__name_pl"],
			"portal_language__name_en" => $row["portal_language__name_en"],
			"portal_language__name_fr" => $row["portal_language__name_fr"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}

	return $response;
}

$API["msz/portal_language/fetch"] = array(
	"name" => "MSZ Fetch portal_language",
	"function" => "sm_api_plugin_msz_portal_language_fetch",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_language",
	"description" => "",
	"arguments" => array(
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_language_fetch()
{
	if ( $result = portal_language_fetch_all() ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_language__id" => $row["portal_language__id"],
				"portal_language__crmid" => $row["portal_language__crmid"],
				"portal_language__name_pl" => $row["portal_language__name_pl"],
				"portal_language__name_en" => $row["portal_language__name_en"],
				"portal_language__name_fr" => $row["portal_language__name_fr"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

$API["msz/portal_language/delete"] = array(
	"function" => "sm_api_plugin_msz_portal_language_delete",
	"RequestMethodAllowed" => "POST|DELETE|GET",
	"acl" => "MSZ_API_DELETE",
	"plugin" => "msz",
	"group" => "portal_language",
	"encryption" => true,
	"description" => "This method delete selected portal_language objects.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_language__id", "default" => "required", "detail" => "unique portal_language ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "deleted", "type" => "string", "description" => "true if succes, false if not" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		"deleted" => "true",
		),
	);

function sm_api_plugin_msz_portal_language_delete()
{
	$portal_language__id = $_REQUEST["id"];

	if ( $result = portal_language_delete( $portal_language__id ) ) {
		// delete from history
		core_changed_delete_by_id( $portal_language__id, "portal_language" );
		$response["deleted"] = true;
	} else {
		$response["deleted"] = false;
	}

	return $response;
}

$API["msz/portal_language/add"] = array(
	"function" => "sm_api_plugin_msz_portal_language_add",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_ADD",
	"plugin" => "msz",
	"group" => "portal_language",
	"encryption" => true,
	"description" => "This method add new portal_language object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "data[portal_language__crmid]", "type" => "uid", "valid" => "portal_language__crmid", "default" => "null", "detail" => "unique portal_language CRM ID", ),
		array( "argument" => "data[portal_language__name_pl]", "type" => "string", "valid" => "portal_language__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_language__name_en]", "type" => "string", "valid" => "portal_language__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_language__name_fr]", "type" => "string", "valid" => "portal_language__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_language__id", "type" => "uid", "description" => "new id if added, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_language__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_language__name_pl]=Polska",
	"example_response" => array(
		"portal_language__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_language_add()
{
	global $ERROR, $data;

	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}

	portal_language_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		if ( $portal_language__id = portal_language_add( $data ) ) {
			core_changed_delete_by_id( $portal_language__id, "portal_language" );
			$response["portal_language__id"] = $portal_language__id;
		}
	}
	return $response;
}

$API["msz/portal_language/edit"] = array(
	"function" => "sm_api_plugin_msz_portal_language_edit",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_WRITE",
	"plugin" => "msz",
	"group" => "portal_language",
	"encryption" => true,
	"description" => "This method edit new portal_language object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "portal_language__id", "default" => "required", "detail" => "unique portal_language ID", ),
		array( "argument" => "data[portal_language__crmid]", "type" => "uid", "valid" => "portal_language__crmid", "default" => "null", "detail" => "unique portal_language CRM ID", ),
		array( "argument" => "data[portal_language__name_pl]", "type" => "string", "valid" => "portal_language__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_language__name_en]", "type" => "string", "valid" => "portal_language__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_language__name_fr]", "type" => "string", "valid" => "portal_language__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_language__id", "type" => "uid", "description" => "portal_language__id if edited, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_language__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_language__name]=Polska",
	"example_response" => array(
		"portal_language__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_language_edit()
{
	global $ERROR, $data;

	$portal_language__id = $_REQUEST["id"];

	if ( !$portal_language__id ) {
		$ERROR[] = "Missing portal_language__id";
	}elseif ( ! portal_language_dane( $portal_language__id ) ) {
		$ERROR[] = "portal_language__id not exists";
	}
	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}
	portal_language_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		$data["portal_language__id"] = $portal_language__id;
		if ( $portal_language__id = portal_language_edit( $data ) ) {
			core_changed_delete_by_id( $portal_language__id, "portal_language" );
			$response["portal_language__id"] = $portal_language__id;
		}
	}
	return $response;
}

?>