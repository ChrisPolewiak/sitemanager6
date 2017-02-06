<?php

$API["msz/portal_form_of_delegation/get"] = array(
	"name" => "MSZ Get portal_form_of_delegation",
	"function" => "sm_api_plugin_msz_portal_form_of_delegation_get",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_form_of_delegation__id",
	"plugin" => "msz",
	"group" => "portal_form_of_delegation",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_form_of_delegation__id", "default" => "required", "detail" => "unique portal_form_of_delegation__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_form_of_delegation_get()
{
	$portal_form_of_delegation__id = $_REQUEST["id"];

	if ( $row = portal_form_of_delegation_get( $portal_form_of_delegation__id ) ) {
		$response[] = array(
			"portal_form_of_delegation__id" => $row["portal_form_of_delegation__id"],
			"portal_form_of_delegation__crmid" => $row["portal_form_of_delegation__crmid"],
			"portal_form_of_delegation__name_pl" => $row["portal_form_of_delegation__name_pl"],
			"portal_form_of_delegation__name_en" => $row["portal_form_of_delegation__name_en"],
			"portal_form_of_delegation__name_fr" => $row["portal_form_of_delegation__name_fr"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}

	return $response;
}

$API["msz/portal_form_of_delegation/fetch"] = array(
	"name" => "MSZ Fetch portal_form_of_delegation",
	"function" => "sm_api_plugin_msz_portal_form_of_delegation_fetch",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_form_of_delegation",
	"description" => "",
	"arguments" => array(
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_form_of_delegation_fetch()
{
	if ( $result = portal_form_of_delegation_fetch_all() ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_form_of_delegation__id" => $row["portal_form_of_delegation__id"],
				"portal_form_of_delegation__crmid" => $row["portal_form_of_delegation__crmid"],
				"portal_form_of_delegation__name_pl" => $row["portal_form_of_delegation__name_pl"],
				"portal_form_of_delegation__name_en" => $row["portal_form_of_delegation__name_en"],
				"portal_form_of_delegation__name_fr" => $row["portal_form_of_delegation__name_fr"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

$API["msz/portal_form_of_delegation/delete"] = array(
	"function" => "sm_api_plugin_msz_portal_form_of_delegation_delete",
	"RequestMethodAllowed" => "POST|DELETE|GET",
	"acl" => "MSZ_API_DELETE",
	"plugin" => "msz",
	"group" => "portal_form_of_delegation",
	"encryption" => true,
	"description" => "This method delete selected portal_form_of_delegation objects.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_form_of_delegation__id", "default" => "required", "detail" => "unique portal_form_of_delegation ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "deleted", "type" => "string", "description" => "true if succes, false if not" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		"deleted" => "true",
		),
	);

function sm_api_plugin_msz_portal_form_of_delegation_delete()
{
	$portal_form_of_delegation__id = $_REQUEST["id"];

	if ( $result = portal_form_of_delegation_delete( $portal_form_of_delegation__id ) ) {
		// delete from history
		core_changed_delete_by_id( $portal_form_of_delegation__id, "portal_form_of_delegation" );
		$response["deleted"] = true;
	} else {
		$response["deleted"] = false;
	}

	return $response;
}

$API["msz/portal_form_of_delegation/add"] = array(
	"function" => "sm_api_plugin_msz_portal_form_of_delegation_add",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_ADD",
	"plugin" => "msz",
	"group" => "portal_form_of_delegation",
	"encryption" => true,
	"description" => "This method add new portal_form_of_delegation object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "data[portal_form_of_delegation__crmid]", "type" => "uid", "valid" => "portal_form_of_delegation__crmid", "default" => "null", "detail" => "unique portal_form_of_delegation CRM ID", ),
		array( "argument" => "data[portal_form_of_delegation__name_pl]", "type" => "string", "valid" => "portal_form_of_delegation__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_form_of_delegation__name_en]", "type" => "string", "valid" => "portal_form_of_delegation__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_form_of_delegation__name_fr]", "type" => "string", "valid" => "portal_form_of_delegation__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_form_of_delegation__id", "type" => "uid", "description" => "new id if added, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_form_of_delegation__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_form_of_delegation__name_pl]=Polska",
	"example_response" => array(
		"portal_form_of_delegation__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_form_of_delegation_add()
{
	global $ERROR, $data;

	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}
	portal_form_of_delegation_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		if ( $portal_form_of_delegation__id = portal_form_of_delegation_add( $data ) ) {
			core_changed_delete_by_id( $portal_form_of_delegation__id, "portal_form_of_delegation" );
			$response["portal_form_of_delegation__id"] = $portal_form_of_delegation__id;
		}
	}
	return $response;
}

$API["msz/portal_form_of_delegation/edit"] = array(
	"function" => "sm_api_plugin_msz_portal_form_of_delegation_edit",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_WRITE",
	"plugin" => "msz",
	"group" => "portal_form_of_delegation",
	"encryption" => true,
	"description" => "This method edit new portal_form_of_delegation object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "portal_form_of_delegation__id", "default" => "required", "detail" => "unique portal_form_of_delegation ID", ),
		array( "argument" => "data[portal_form_of_delegation__crmid]", "type" => "uid", "valid" => "portal_form_of_delegation__crmid", "default" => "null", "detail" => "unique portal_form_of_delegation CRM ID", ),
		array( "argument" => "data[portal_form_of_delegation__name_pl]", "type" => "string", "valid" => "portal_form_of_delegation__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_form_of_delegation__name_en]", "type" => "string", "valid" => "portal_form_of_delegation__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_form_of_delegation__name_fr]", "type" => "string", "valid" => "portal_form_of_delegation__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_form_of_delegation__id", "type" => "uid", "description" => "portal_form_of_delegation__id if edited, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_form_of_delegation__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_form_of_delegation__name_pl]=Polska",
	"example_response" => array(
		"portal_form_of_delegation__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_form_of_delegation_edit()
{
	global $ERROR, $data;

	$portal_form_of_delegation__id = $_REQUEST["id"];

	if ( !$portal_form_of_delegation__id ) {
		$ERROR[] = "Missing portal_form_of_delegation__id";
	}elseif ( ! portal_form_of_delegation_dane( $portal_form_of_delegation__id ) ) {
		$ERROR[] = "portal_form_of_delegation__id not exists";
	}
	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}
	portal_form_of_delegation_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		$data["portal_form_of_delegation__id"] = $portal_form_of_delegation__id;
		if ( $portal_form_of_delegation__id = portal_form_of_delegation_edit( $data ) ) {
			core_changed_delete_by_id( $portal_form_of_delegation__id, "portal_form_of_delegation" );
			$response["portal_form_of_delegation__id"] = $portal_form_of_delegation__id;
		}
	}
	return $response;
}

?>