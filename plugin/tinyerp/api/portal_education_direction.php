<?php

$API["msz/portal_education_direction/get"] = array(
	"name" => "MSZ Get portal_education_direction",
	"function" => "sm_api_plugin_msz_portal_education_direction_get",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_education_direction__id",
	"plugin" => "msz",
	"group" => "portal_education_direction",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_education_direction__id", "default" => "required", "detail" => "unique portal_education_direction__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_education_direction_get()
{
	$portal_education_direction__id = $_REQUEST["id"];

	if ( $row = portal_education_direction_get( $portal_education_direction__id ) ) {
		$response[] = array(
			"portal_education_direction__id" => $row["portal_education_direction__id"],
			"portal_education_direction__crmid" => $row["portal_education_direction__crmid"],
			"portal_education_direction__name_pl" => $row["portal_education_direction__name_pl"],
			"portal_education_direction__name_en" => $row["portal_education_direction__name_en"],
			"portal_education_direction__name_fr" => $row["portal_education_direction__name_fr"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}

	return $response;
}

$API["msz/portal_education_direction/fetch"] = array(
	"name" => "MSZ Fetch portal_education_direction",
	"function" => "sm_api_plugin_msz_portal_education_direction_fetch",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_education_direction",
	"description" => "",
	"arguments" => array(
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_education_direction_fetch(  )
{
	if ( $result = portal_education_direction_fetch_all() ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_education_direction__id" => $row["portal_education_direction__id"],
				"portal_education_direction__crmid" => $row["portal_education_direction__crmid"],
				"portal_education_direction__name_pl" => $row["portal_education_direction__name_pl"],
				"portal_education_direction__name_en" => $row["portal_education_direction__name_en"],
				"portal_education_direction__name_fr" => $row["portal_education_direction__name_fr"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

$API["msz/portal_education_direction/delete"] = array(
	"function" => "sm_api_plugin_msz_portal_education_direction_delete",
	"RequestMethodAllowed" => "POST|DELETE|GET",
	"acl" => "MSZ_API_DELETE",
	"plugin" => "msz",
	"group" => "portal_education_direction",
	"encryption" => true,
	"description" => "This method delete selected portal_education_direction objects.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_education_direction__id", "default" => "required", "detail" => "unique portal_education_direction ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "deleted", "type" => "string", "description" => "true if succes, false if not" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		"deleted" => "true",
		),
	);

function sm_api_plugin_msz_portal_education_direction_delete()
{
	$portal_education_direction__id = $_REQUEST["id"];

	if ( $result = portal_education_direction_delete( $portal_education_direction__id ) ) {
		// delete from history
		core_changed_delete_by_id( $portal_education_direction__id, "portal_education_direction" );
		$response["deleted"] = true;
	} else {
		$response["deleted"] = false;
	}

	return $response;
}

$API["msz/portal_education_direction/add"] = array(
	"function" => "sm_api_plugin_msz_portal_education_direction_add",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_ADD",
	"plugin" => "msz",
	"group" => "portal_education_direction",
	"encryption" => true,
	"description" => "This method add new portal_education_direction object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "data[portal_education_direction__crmid]", "type" => "uid", "valid" => "portal_education_direction__crmid", "default" => "null", "detail" => "unique portal_education_direction CRM ID", ),
		array( "argument" => "data[portal_education_direction__name_pl]", "type" => "string", "valid" => "portal_education_direction__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_education_direction__name_en]", "type" => "string", "valid" => "portal_education_direction__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_education_direction__name_fr]", "type" => "string", "valid" => "portal_education_direction__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_education_direction__id", "type" => "uid", "description" => "new id if added, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_education_direction__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_education_direction__name_pl]=Polska",
	"example_response" => array(
		"portal_education_direction__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_education_direction_add()
{
	global $ERROR, $data;

	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}

	portal_education_direction_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		if ( $portal_education_direction__id = portal_education_direction_add( $data ) ) {
			core_changed_delete_by_id( $portal_education_direction__id, "portal_education_direction" );
			$response["portal_education_direction__id"] = $portal_education_direction__id;
		}
	}
	return $response;
}

$API["msz/portal_education_direction/edit"] = array(
	"function" => "sm_api_plugin_msz_portal_education_direction_edit",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_WRITE",
	"plugin" => "msz",
	"group" => "portal_education_direction",
	"encryption" => true,
	"description" => "This method edit new portal_education_direction object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "portal_education_direction__id", "default" => "required", "detail" => "unique portal_education_direction ID", ),
		array( "argument" => "data[portal_education_direction__crmid]", "type" => "uid", "valid" => "portal_education_direction__crmid", "default" => "null", "detail" => "unique portal_education_direction CRM ID", ),
		array( "argument" => "data[portal_education_direction__name_pl]", "type" => "string", "valid" => "portal_education_direction__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_education_direction__name_en]", "type" => "string", "valid" => "portal_education_direction__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_education_direction__name_fr]", "type" => "string", "valid" => "portal_education_direction__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_education_direction__id", "type" => "uid", "description" => "portal_education_direction__id if edited, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_education_direction__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_education_direction__name_pl]=Polska",
	"example_response" => array(
		"portal_education_direction__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_education_direction_edit()
{
	global $ERROR, $data;

	$portal_education_direction__id = $_REQUEST["id"];

	if ( !$portal_education_direction__id ) {
		$ERROR[] = "Missing portal_education_direction__id";
	}elseif ( ! portal_education_direction_dane( $portal_education_direction__id ) ) {
		$ERROR[] = "portal_education_direction__id not exists";
	}
	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}
	portal_education_direction_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		$data["portal_education_direction__id"] = $portal_education_direction__id;
		if ( $portal_education_direction__id = portal_education_direction_edit( $data ) ) {
			core_changed_delete_by_id( $portal_education_direction__id, "portal_education_direction" );
			$response["portal_education_direction__id"] = $portal_education_direction__id;
		}
	}
	return $response;
}

?>