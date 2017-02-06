<?php

$API["msz/portal_skill/get"] = array(
	"name" => "MSZ Get portal_skill",
	"function" => "sm_api_plugin_msz_portal_skill_get",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_skill__id",
	"plugin" => "msz",
	"group" => "portal_skill",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_skill__id", "default" => "required", "detail" => "unique portal_skill__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_skill_get()
{
	$portal_skill__id = $_REQUEST["id"];

	if ( $row = portal_skill_get( $portal_skill__id ) ) {
		$response[] = array(
			"portal_skill__id" => $row["portal_skill__id"],
			"portal_skill__crmid" => $row["portal_skill__crmid"],
			"portal_skill__name_pl" => $row["portal_skill__name_pl"],
			"portal_skill__name_en" => $row["portal_skill__name_en"],
			"portal_skill__name_fr" => $row["portal_skill__name_fr"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}

	return $response;
}

$API["msz/portal_skill/fetch"] = array(
	"name" => "MSZ Fetch portal_skill",
	"function" => "sm_api_plugin_msz_portal_skill_fetch",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_skill",
	"description" => "",
	"arguments" => array(
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_skill_fetch()
{
	if ( $result = portal_skill_fetch_all() ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_skill__id" => $row["portal_skill__id"],
				"portal_skill__crmid" => $row["portal_skill__crmid"],
				"portal_skill__name_pl" => $row["portal_skill__name_pl"],
				"portal_skill__name_en" => $row["portal_skill__name_en"],
				"portal_skill__name_fr" => $row["portal_skill__name_fr"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

$API["msz/portal_skill/delete"] = array(
	"function" => "sm_api_plugin_msz_portal_skill_delete",
	"RequestMethodAllowed" => "POST|DELETE|GET",
	"acl" => "MSZ_API_DELETE",
	"plugin" => "msz",
	"group" => "portal_skill",
	"encryption" => true,
	"description" => "This method delete selected portal_skill objects.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_skill__id", "default" => "required", "detail" => "unique portal_skill ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "deleted", "type" => "string", "description" => "true if succes, false if not" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		"deleted" => "true",
		),
	);

function sm_api_plugin_msz_portal_skill_delete()
{
	$portal_skill__id = $_REQUEST["id"];

	if ( $result = portal_skill_delete( $portal_skill__id ) ) {
		// delete from history
		core_changed_delete_by_id( $portal_skill__id, "portal_skill" );
		$response["deleted"] = true;
	} else {
		$response["deleted"] = false;
	}

	return $response;
}

$API["msz/portal_skill/add"] = array(
	"function" => "sm_api_plugin_msz_portal_skill_add",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_ADD",
	"plugin" => "msz",
	"group" => "portal_skill",
	"encryption" => true,
	"description" => "This method add new portal_skill object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "data[portal_skill__crmid]", "type" => "uid", "valid" => "portal_skill__crmid", "default" => "null", "detail" => "unique portal_skill CRM ID", ),
		array( "argument" => "data[portal_skill__name_pl]", "type" => "string", "valid" => "portal_skill__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_skill__name_en]", "type" => "string", "valid" => "portal_skill__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_skill__name_fr]", "type" => "string", "valid" => "portal_skill__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_skill__id", "type" => "uid", "description" => "new id if added, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_skill__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_skill__name_pl]=Polska",
	"example_response" => array(
		"portal_skill__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_skill_add()
{
	global $ERROR, $data;

	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}

	portal_skill_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		if ( $portal_skill__id = portal_skill_add( $data ) ) {
			core_changed_delete_by_id( $portal_skill__id, "portal_skill" );
			$response["portal_skill__id"] = $portal_skill__id;
		}
	}
	return $response;
}

$API["msz/portal_skill/edit"] = array(
	"function" => "sm_api_plugin_msz_portal_skill_edit",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_WRITE",
	"plugin" => "msz",
	"group" => "portal_skill",
	"encryption" => true,
	"description" => "This method edit new portal_skill object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "portal_skill__id", "default" => "required", "detail" => "unique portal_skill ID", ),
		array( "argument" => "data[portal_skill__crmid]", "type" => "uid", "valid" => "portal_skill__crmid", "default" => "null", "detail" => "unique portal_skill CRM ID", ),
		array( "argument" => "data[portal_skill__name_pl]", "type" => "string", "valid" => "portal_skill__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_skill__name_en]", "type" => "string", "valid" => "portal_skill__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_skill__name_fr]", "type" => "string", "valid" => "portal_skill__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_skill__id", "type" => "uid", "description" => "portal_skill__id if edited, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_skill__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_skill__name_pl]=Polska",
	"example_response" => array(
		"portal_skill__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_skill_edit()
{
	global $ERROR, $data;

	$portal_skill__id = $_REQUEST["id"];

	if ( !$portal_skill__id ) {
		$ERROR[] = "Missing portal_skill__id";
	}elseif ( ! portal_skill_dane( $portal_skill__id ) ) {
		$ERROR[] = "portal_skill__id not exists";
	}
	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}
	portal_skill_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		$data["portal_skill__id"] = $portal_skill__id;
		if ( $portal_skill__id = portal_skill_edit( $data ) ) {
			core_changed_delete_by_id( $portal_skill__id, "portal_skill" );
			$response["portal_skill__id"] = $portal_skill__id;
		}
	}
	return $response;
}

?>