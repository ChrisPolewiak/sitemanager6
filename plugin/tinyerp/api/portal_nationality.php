<?php

$API["msz/portal_nationality/get"] = array(
	"name" => "MSZ Get portal_nationality",
	"function" => "sm_api_plugin_msz_portal_nationality_get",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_nationality__id",
	"plugin" => "msz",
	"group" => "portal_nationality",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_nationality__id", "default" => "required", "detail" => "unique portal_nationality__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_nationality_get()
{
	$portal_nationality__id = $_REQUEST["id"];

	if ( $row = portal_nationality_get( $portal_nationality__id ) ) {
		$response[] = array(
			"portal_nationality__id" => $row["portal_nationality__id"],
			"portal_nationality__crmid" => $row["portal_nationality__crmid"],
			"portal_nationality__name_pl" => $row["portal_nationality__name_pl"],
			"portal_nationality__name_en" => $row["portal_nationality__name_en"],
			"portal_nationality__name_fr" => $row["portal_nationality__name_fr"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}

	return $response;
}

$API["msz/portal_nationality/fetch"] = array(
	"name" => "MSZ Fetch portal_nationality",
	"function" => "sm_api_plugin_msz_portal_nationality_fetch",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_nationality",
	"description" => "",
	"arguments" => array(
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_nationality_fetch()
{
	if ( $result = portal_nationality_fetch_all() ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_nationality__id" => $row["portal_nationality__id"],
				"portal_nationality__crmid" => $row["portal_nationality__crmid"],
				"portal_nationality__name_pl" => $row["portal_nationality__name_pl"],
				"portal_nationality__name_en" => $row["portal_nationality__name_en"],
				"portal_nationality__name_fr" => $row["portal_nationality__name_fr"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

$API["msz/portal_nationality/delete"] = array(
	"function" => "sm_api_plugin_msz_portal_nationality_delete",
	"RequestMethodAllowed" => "POST|DELETE|GET",
	"acl" => "MSZ_API_DELETE",
	"plugin" => "msz",
	"group" => "portal_nationality",
	"encryption" => true,
	"description" => "This method delete selected portal_nationality objects.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_nationality__id", "default" => "required", "detail" => "unique portal_nationality ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "deleted", "type" => "string", "description" => "true if succes, false if not" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		"deleted" => "true",
		),
	);

function sm_api_plugin_msz_portal_nationality_delete()
{
	$portal_nationality__id = $_REQUEST["id"];

	if ( $result = portal_nationality_delete( $portal_nationality__id ) ) {
		// delete from history
		core_changed_delete_by_id( $portal_nationality__id, "portal_nationality" );
		$response["deleted"] = true;
	} else {
		$response["deleted"] = false;
	}

	return $response;
}

$API["msz/portal_nationality/add"] = array(
	"function" => "sm_api_plugin_msz_portal_nationality_add",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_ADD",
	"plugin" => "msz",
	"group" => "portal_nationality",
	"encryption" => true,
	"description" => "This method add new portal_nationality object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "data[portal_nationality__crmid]", "type" => "uid", "valid" => "portal_nationality__crmid", "default" => "null", "detail" => "unique portal_nationality CRM ID", ),
		array( "argument" => "data[portal_nationality__name_pl]", "type" => "string", "valid" => "portal_nationality__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_nationality__name_en]", "type" => "string", "valid" => "portal_nationality__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_nationality__name_fr]", "type" => "string", "valid" => "portal_nationality__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_nationality__id", "type" => "uid", "description" => "new id if added, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_nationality__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_nationality__name_pl]=Polska",
	"example_response" => array(
		"portal_nationality__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_nationality_add()
{
	global $ERROR, $data;

	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}

	portal_nationality_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		if ( $portal_nationality__id = portal_nationality_add( $data ) ) {
			core_changed_delete_by_id( $portal_nationality__id, "portal_nationality" );
			$response["portal_nationality__id"] = $portal_nationality__id;
		}
	}
	return $response;
}

$API["msz/portal_nationality/edit"] = array(
	"function" => "sm_api_plugin_msz_portal_nationality_edit",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_WRITE",
	"plugin" => "msz",
	"group" => "portal_nationality",
	"encryption" => true,
	"description" => "This method edit new portal_nationality object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "portal_nationality__id", "default" => "required", "detail" => "unique portal_nationality ID", ),
		array( "argument" => "data[portal_nationality__crmid]", "type" => "uid", "valid" => "portal_nationality__crmid", "default" => "null", "detail" => "unique portal_nationality CRM ID", ),
		array( "argument" => "data[portal_nationality__name_pl]", "type" => "string", "valid" => "portal_nationality__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_nationality__name_en]", "type" => "string", "valid" => "portal_nationality__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_nationality__name_fr]", "type" => "string", "valid" => "portal_nationality__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_nationality__id", "type" => "uid", "description" => "portal_nationality__id if edited, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_nationality__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_nationality__name_pl]=Polska",
	"example_response" => array(
		"portal_nationality__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_nationality_edit()
{
	global $ERROR, $data;

	$portal_nationality__id = $_REQUEST["id"];

	if ( !$portal_nationality__id ) {
		$ERROR[] = "Missing portal_nationality__id";
	}elseif ( ! portal_nationality_dane( $portal_nationality__id ) ) {
		$ERROR[] = "portal_nationality__id not exists";
	}
	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}
	portal_nationality_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		$data["portal_nationality__id"] = $portal_nationality__id;
		if ( $portal_nationality__id = portal_nationality_edit( $data ) ) {
			core_changed_delete_by_id( $portal_nationality__id, "portal_nationality" );
			$response["portal_nationality__id"] = $portal_nationality__id;
		}
	}
	return $response;
}

?>