<?php

$API["msz/portal_substantive_area/get"] = array(
	"name" => "MSZ Get portal_substantive_area",
	"function" => "sm_api_plugin_msz_portal_substantive_area_get",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_substantive_area__id",
	"plugin" => "msz",
	"group" => "portal_substantive_area",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_substantive_area__id", "default" => "required", "detail" => "unique portal_substantive_area__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_substantive_area_get()
{
	$portal_substantive_area__id = $_REQUEST["id"];

	if ( $row = portal_substantive_area_get( $portal_substantive_area__id ) ) {
		$response[] = array(
			"portal_substantive_area__id" => $row["portal_substantive_area__id"],
			"portal_substantive_area__crmid" => $row["portal_substantive_area__crmid"],
			"portal_substantive_area__name_pl" => $row["portal_substantive_area__name_pl"],
			"portal_substantive_area__name_en" => $row["portal_substantive_area__name_en"],
			"portal_substantive_area__name_fr" => $row["portal_substantive_area__name_fr"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}

	return $response;
}

$API["msz/portal_substantive_area/fetch"] = array(
	"name" => "MSZ Fetch portal_substantive_area",
	"function" => "sm_api_plugin_msz_portal_substantive_area_fetch",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_substantive_area",
	"description" => "",
	"arguments" => array(
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_substantive_area_fetch()
{
	if ( $result = portal_substantive_area_fetch_all() ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_substantive_area__id" => $row["portal_substantive_area__id"],
				"portal_substantive_area__crmid" => $row["portal_substantive_area__crmid"],
				"portal_substantive_area__name_pl" => $row["portal_substantive_area__name_pl"],
				"portal_substantive_area__name_en" => $row["portal_substantive_area__name_en"],
				"portal_substantive_area__name_fr" => $row["portal_substantive_area__name_fr"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

$API["msz/portal_substantive_area/delete"] = array(
	"function" => "sm_api_plugin_msz_portal_substantive_area_delete",
	"RequestMethodAllowed" => "POST|DELETE|GET",
	"acl" => "MSZ_API_DELETE",
	"plugin" => "msz",
	"group" => "portal_substantive_area",
	"encryption" => true,
	"description" => "This method delete selected portal_substantive_area objects.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_substantive_area__id", "default" => "required", "detail" => "unique portal_substantive_area ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "deleted", "type" => "string", "description" => "true if succes, false if not" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		"deleted" => "true",
		),
	);

function sm_api_plugin_msz_portal_substantive_area_delete()
{
	$portal_substantive_area__id = $_REQUEST["id"];

	if ( $result = portal_substantive_area_delete( $portal_substantive_area__id ) ) {
		// delete from history
		core_changed_delete_by_id( $portal_substantive_area__id, "portal_substantive_area" );
		$response["deleted"] = true;
	} else {
		$response["deleted"] = false;
	}

	return $response;
}

$API["msz/portal_substantive_area/add"] = array(
	"function" => "sm_api_plugin_msz_portal_substantive_area_add",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_ADD",
	"plugin" => "msz",
	"group" => "portal_substantive_area",
	"encryption" => true,
	"description" => "This method add new portal_substantive_area object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "data[portal_substantive_area__crmid]", "type" => "uid", "valid" => "portal_substantive_area__crmid", "default" => "null", "detail" => "unique portal_substantive_area CRM ID", ),
		array( "argument" => "data[portal_substantive_area__name_pl]", "type" => "string", "valid" => "portal_substantive_area__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_substantive_area__name_en]", "type" => "string", "valid" => "portal_substantive_area__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_substantive_area__name_fr]", "type" => "string", "valid" => "portal_substantive_area__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_substantive_area__id", "type" => "uid", "description" => "new id if added, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_substantive_area__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_substantive_area__name]=Polska",
	"example_response" => array(
		"portal_substantive_area__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_substantive_area_add()
{
	global $ERROR, $data;

	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}

	portal_substantive_area_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		if ( $portal_substantive_area__id = portal_substantive_area_add( $data ) ) {
			core_changed_delete_by_id( $portal_substantive_area__id, "portal_substantive_area" );
			$response["portal_substantive_area__id"] = $portal_substantive_area__id;
		}
	}
	return $response;
}

$API["msz/portal_substantive_area/edit"] = array(
	"function" => "sm_api_plugin_msz_portal_substantive_area_edit",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_WRITE",
	"plugin" => "msz",
	"group" => "portal_substantive_area",
	"encryption" => true,
	"description" => "This method edit new portal_substantive_area object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "portal_substantive_area__id", "default" => "required", "detail" => "unique portal_substantive_area ID", ),
		array( "argument" => "data[portal_substantive_area__crmid]", "type" => "uid", "valid" => "portal_substantive_area__crmid", "default" => "null", "detail" => "unique portal_substantive_area CRM ID", ),
		array( "argument" => "data[portal_substantive_area__name_pl]", "type" => "string", "valid" => "portal_substantive_area__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_substantive_area__name_en]", "type" => "string", "valid" => "portal_substantive_area__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_substantive_area__name_fr]", "type" => "string", "valid" => "portal_substantive_area__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_substantive_area__id", "type" => "uid", "description" => "portal_substantive_area__id if edited, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_substantive_area__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_substantive_area__name]=Polska",
	"example_response" => array(
		"portal_substantive_area__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_substantive_area_edit()
{
	global $ERROR, $data;

	$portal_substantive_area__id = $_REQUEST["id"];

	if ( !$portal_substantive_area__id ) {
		$ERROR[] = "Missing portal_substantive_area__id";
	}elseif ( ! portal_substantive_area_dane( $portal_substantive_area__id ) ) {
		$ERROR[] = "portal_substantive_area__id not exists";
	}
	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}
	portal_substantive_area_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		$data["portal_substantive_area__id"] = $portal_substantive_area__id;
		if ( $portal_substantive_area__id = portal_substantive_area_edit( $data ) ) {
			core_changed_delete_by_id( $portal_substantive_area__id, "portal_substantive_area" );
			$response["portal_substantive_area__id"] = $portal_substantive_area__id;
		}
	}
	return $response;
}

?>