<?php

$API["msz/portal_language_knowledge_level/get"] = array(
	"name" => "MSZ Get portal_language_knowledge_level",
	"function" => "sm_api_plugin_msz_portal_language_knowledge_level_get",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_language_knowledge_level__id",
	"plugin" => "msz",
	"group" => "portal_language_knowledge_level",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_language_knowledge_level__id", "default" => "required", "detail" => "unique portal_language_knowledge_level__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_language_knowledge_level_get()
{
	$portal_language_knowledge_level__id = $_REQUEST["id"];

	if ( $row = portal_language_knowledge_level_get( $portal_language_knowledge_level__id ) ) {
		$response[] = array(
			"portal_language_knowledge_level__id" => $row["portal_language_knowledge_level__id"],
			"portal_language_knowledge_level__crmid" => $row["portal_language_knowledge_level__crmid"],
			"portal_language_knowledge_level__name_pl" => $row["portal_language_knowledge_level__name_pl"],
			"portal_language_knowledge_level__name_en" => $row["portal_language_knowledge_level__name_en"],
			"portal_language_knowledge_level__name_fr" => $row["portal_language_knowledge_level__name_fr"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}

	return $response;
}

$API["msz/portal_language_knowledge_level/fetch"] = array(
	"name" => "MSZ Fetch portal_language_knowledge_level",
	"function" => "sm_api_plugin_msz_portal_language_knowledge_level_fetch",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_language_knowledge_level",
	"description" => "",
	"arguments" => array(
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_language_knowledge_level_fetch()
{
	if ( $result = portal_language_knowledge_level_fetch_all() ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_language_knowledge_level__id" => $row["portal_language_knowledge_level__id"],
				"portal_language_knowledge_level__crmid" => $row["portal_language_knowledge_level__crmid"],
				"portal_language_knowledge_level__name_pl" => $row["portal_language_knowledge_level__name_pl"],
				"portal_language_knowledge_level__name_en" => $row["portal_language_knowledge_level__name_en"],
				"portal_language_knowledge_level__name_fr" => $row["portal_language_knowledge_level__name_fr"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

$API["msz/portal_language_knowledge_level/delete"] = array(
	"function" => "sm_api_plugin_msz_portal_language_knowledge_level_delete",
	"RequestMethodAllowed" => "POST|DELETE|GET",
	"acl" => "MSZ_API_DELETE",
	"plugin" => "msz",
	"group" => "portal_language_knowledge_level",
	"encryption" => true,
	"description" => "This method delete selected portal_language_knowledge_level objects.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_language_knowledge_level__id", "default" => "required", "detail" => "unique portal_language_knowledge_level ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "deleted", "type" => "string", "description" => "true if succes, false if not" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		"deleted" => "true",
		),
	);

function sm_api_plugin_msz_portal_language_knowledge_level_delete()
{
	$portal_language_knowledge_level__id = $_REQUEST["id"];

	if ( $result = portal_language_knowledge_level_delete( $portal_language_knowledge_level__id ) ) {
		// delete from history
		core_changed_delete_by_id( $portal_language_knowledge_level__id, "portal_language_knowledge_level" );
		$response["deleted"] = true;
	} else {
		$response["deleted"] = false;
	}

	return $response;
}

$API["msz/portal_language_knowledge_level/add"] = array(
	"function" => "sm_api_plugin_msz_portal_language_knowledge_level_add",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_ADD",
	"plugin" => "msz",
	"group" => "portal_language_knowledge_level",
	"encryption" => true,
	"description" => "This method add new portal_language_knowledge_level object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "data[portal_language_knowledge_level__crmid]", "type" => "uid", "valid" => "portal_language_knowledge_level__crmid", "default" => "null", "detail" => "unique portal_language_knowledge_level CRM ID", ),
		array( "argument" => "data[portal_language_knowledge_level__name_pl]", "type" => "string", "valid" => "portal_language_knowledge_level__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_language_knowledge_level__name_en]", "type" => "string", "valid" => "portal_language_knowledge_level__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_language_knowledge_level__name_fr]", "type" => "string", "valid" => "portal_language_knowledge_level__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_language_knowledge_level__id", "type" => "uid", "description" => "new id if added, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_language_knowledge_level__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_language_knowledge_level__name_pl]=Polska",
	"example_response" => array(
		"portal_language_knowledge_level__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_language_knowledge_level_add()
{
	global $ERROR, $data;

	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}

	portal_language_knowledge_level_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		if ( $portal_language_knowledge_level__id = portal_language_knowledge_level_add( $data ) ) {
			core_changed_delete_by_id( $portal_language_knowledge_level__id, "portal_language_knowledge_level" );
			$response["portal_language_knowledge_level__id"] = $portal_language_knowledge_level__id;
		}
	}
	return $response;
}

$API["msz/portal_language_knowledge_level/edit"] = array(
	"function" => "sm_api_plugin_msz_portal_language_knowledge_level_edit",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_WRITE",
	"plugin" => "msz",
	"group" => "portal_language_knowledge_level",
	"encryption" => true,
	"description" => "This method edit new portal_language_knowledge_level object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "portal_language_knowledge_level__id", "default" => "required", "detail" => "unique portal_language_knowledge_level ID", ),
		array( "argument" => "data[portal_language_knowledge_level__crmid]", "type" => "uid", "valid" => "portal_language_knowledge_level__crmid", "default" => "null", "detail" => "unique portal_language_knowledge_level CRM ID", ),
		array( "argument" => "data[portal_language_knowledge_level__name_pl]", "type" => "string", "valid" => "portal_language_knowledge_level__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_language_knowledge_level__name_en]", "type" => "string", "valid" => "portal_language_knowledge_level__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_language_knowledge_level__name_fr]", "type" => "string", "valid" => "portal_language_knowledge_level__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_language_knowledge_level__id", "type" => "uid", "description" => "portal_language_knowledge_level__id if edited, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_language_knowledge_level__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_language_knowledge_level__name_pl]=Polska",
	"example_response" => array(
		"portal_language_knowledge_level__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_language_knowledge_level_edit()
{
	global $ERROR, $data;

	$portal_language_knowledge_level__id = $_REQUEST["id"];

	if ( !$portal_language_knowledge_level__id ) {
		$ERROR[] = "Missing portal_language_knowledge_level__id";
	}elseif ( ! portal_language_knowledge_level_dane( $portal_language_knowledge_level__id ) ) {
		$ERROR[] = "portal_language_knowledge_level__id not exists";
	}
	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}
	portal_language_knowledge_level_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		$data["portal_language_knowledge_level__id"] = $portal_language_knowledge_level__id;
		if ( $portal_language_knowledge_level__id = portal_language_knowledge_level_edit( $data ) ) {
			core_changed_delete_by_id( $portal_language_knowledge_level__id, "portal_language_knowledge_level" );
			$response["portal_language_knowledge_level__id"] = $portal_language_knowledge_level__id;
		}
	}
	return $response;
}

?>