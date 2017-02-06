<?php

$API["msz/portal_institution/get"] = array(
	"name" => "MSZ Get portal_institution",
	"function" => "sm_api_plugin_msz_portal_institution_get",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_institution__id",
	"plugin" => "msz",
	"group" => "portal_institution",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_institution__id", "default" => "required", "detail" => "unique portal_institution__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_institution_get()
{
	$portal_institution__id = $_REQUEST["id"];

	if ( $row = portal_institution_get( $portal_institution__id ) ) {
		$response[] = array(
			"portal_institution__id" => $row["portal_institution__id"],
			"portal_institution__crmid" => $row["portal_institution__crmid"],
			"portal_institution__name_pl" => $row["portal_institution__name_pl"],
			"portal_institution__name_en" => $row["portal_institution__name_en"],
			"portal_institution__name_fr" => $row["portal_institution__name_fr"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}

	return $response;
}

// #

$API["msz/portal_institution/fetch"] = array(
	"name" => "MSZ Fetch portal_institution",
	"function" => "sm_api_plugin_msz_portal_institution_fetch",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_institution",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_user2portal_nationality__id", "default" => "required", "detail" => "unique portal_user2portal_nationality__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_institution_fetch()
{
	if ( $result = portal_institution_fetch_all() ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_institution__id" => $row["portal_institution__id"],
				"portal_institution__crmid" => $row["portal_institution__crmid"],
				"portal_institution__name_pl" => $row["portal_institution__name_pl"],
				"portal_institution__name_en" => $row["portal_institution__name_en"],
				"portal_institution__name_fr" => $row["portal_institution__name_fr"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

$API["msz/portal_institution/delete"] = array(
	"function" => "sm_api_plugin_msz_portal_institution_delete",
	"RequestMethodAllowed" => "POST|DELETE|GET",
	"acl" => "MSZ_API_DELETE",
	"plugin" => "msz",
	"group" => "portal_institution",
	"encryption" => true,
	"description" => "This method delete selected portal_institution objects.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_institution__id", "default" => "required", "detail" => "unique portal_institution ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "deleted", "type" => "string", "description" => "true if succes, false if not" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		"deleted" => "true",
		),
	);

function sm_api_plugin_msz_portal_institution_delete()
{
	$portal_institution__id = $_REQUEST["id"];

	if ( $result = portal_institution_delete( $portal_institution__id ) ) {
		// delete from history
		core_changed_delete_by_id( $portal_institution__id, "portal_institution" );
		$response["deleted"] = true;
	} else {
		$response["deleted"] = false;
	}

	return $response;
}

$API["msz/portal_institution/add"] = array(
	"function" => "sm_api_plugin_msz_portal_institution_add",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_ADD",
	"plugin" => "msz",
	"group" => "portal_institution",
	"encryption" => true,
	"description" => "This method add new portal_institution object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "data[portal_institution__crmid]", "type" => "uid", "valid" => "portal_institution__crmid", "default" => "null", "detail" => "unique portal_institution CRM ID", ),
		array( "argument" => "data[portal_institution__name_pl]", "type" => "string", "valid" => "portal_institution__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_institution__name_en]", "type" => "string", "valid" => "portal_institution__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_institution__name_fr]", "type" => "string", "valid" => "portal_institution__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_institution__id", "type" => "uid", "description" => "new id if added, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_institution__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_institution__name_pl]=Polska",
	"example_response" => array(
		"portal_institution__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_institution_add()
{
	global $ERROR, $data;

	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}

	portal_institution_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		if ( $portal_institution__id = portal_institution_add( $data ) ) {
			core_changed_delete_by_id( $portal_institution__id, "portal_institution" );
			$response["portal_institution__id"] = $portal_institution__id;
		}
	}
	return $response;
}

$API["msz/portal_institution/edit"] = array(
	"function" => "sm_api_plugin_msz_portal_institution_edit",
	"RequestMethodAllowed" => "POST|GET",
	"acl" => "MSZ_API_WRITE",
	"plugin" => "msz",
	"group" => "portal_institution",
	"encryption" => true,
	"description" => "This method edit new portal_institution object. Send data array or json encoded string. If arguments include data array, json will me skipped",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "portal_institution__id", "default" => "required", "detail" => "unique portal_institution ID", ),
		array( "argument" => "data[portal_institution__crmid]", "type" => "uid", "valid" => "portal_institution__crmid", "default" => "null", "detail" => "unique portal_institution CRM ID", ),
		array( "argument" => "data[portal_institution__name_pl]", "type" => "string", "valid" => "portal_institution__name_pl", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_institution__name_en]", "type" => "string", "valid" => "portal_institution__name_en", "default" => "required", "detail" => "country name", ),
		array( "argument" => "data[portal_institution__name_fr]", "type" => "string", "valid" => "portal_institution__name_fr", "default" => "required", "detail" => "country name", ),
		array( "argument" => "json", "type" => "string", "valid" => "json array of data", "default" => "null", "detail" => "Alternative - all data in json array. Json data is secondary data", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_institution__id", "type" => "uid", "description" => "portal_institution__id if edited, null if not" ),
		array( "path" => "/", "name" => "error", "type" => "array", "description" => "error info if not added" ),
		),
	"example_query" => "?data[portal_institution__crmid]=5abf08cc-f39d-4e39-8401-2b3c6f067fb6&data[portal_institution__name_pl]=Polska",
	"example_response" => array(
		"portal_institution__id" => "5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
		"error" => "null",
		),
	);

function sm_api_plugin_msz_portal_institution_edit()
{
	global $ERROR, $data;

	$portal_institution__id = $_REQUEST["id"];

	if ( !$portal_institution__id ) {
		$ERROR[] = "Missing portal_institution__id";
	}elseif ( ! portal_institution_dane( $portal_institution__id ) ) {
		$ERROR[] = "portal_institution__id not exists";
	}
	if ( !is_array( $data ) ) {
		$ERROR[] = "Missing Data";
	}
	portal_institution_validate( $data );
	if ( is_array( $ERROR ) ) {
		$response["error"] = $ERROR;
	} else {
		$data["portal_institution__id"] = $portal_institution__id;
		if ( $portal_institution__id = portal_institution_edit( $data ) ) {
			core_changed_delete_by_id( $portal_institution__id, "portal_institution" );
			$response["portal_institution__id"] = $portal_institution__id;
		}
	}
	return $response;
}

?>