<?php

$API["msz/portal_user2portal_skill/get"] = array(
	"name" => "MSZ Get portal_user2portal_skill",
	"function" => "sm_api_plugin_msz_portal_user2portal_skill_get",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_user2portal_skill",
	"description" => "This method return information about selected skill for user.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_user2portal_skill__id", "default" => "required", "detail" => "unique portal_user2portal_skill__id ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_user2portal_skill__id", "type" => "uid", "description" => "unique portal_user2portal_skill ID" ),
		array( "path" => "/", "name" => "portal_user2portal_skill__crmid", "type" => "uid", "description" => "unique portal_user2portal_skill CRM ID" ),
		array( "path" => "/", "name" => "portal_user__id", "type" => "uid", "description" => "portal_user ID" ),
		array( "path" => "/", "name" => "portal_user__crmid", "type" => "uid", "description" => "portal_user CRM ID" ),
		array( "path" => "/", "name" => "portal_skill__id", "type" => "uid", "description" => "portal_skill ID" ),
		array( "path" => "/", "name" => "portal_skill__crmid", "type" => "uid", "description" => "portal_skill CRM ID" ),
		array( "path" => "/", "name" => "portal_skill__name_pl", "type" => "string", "description" => "portal_skill name_pl" ),
		array( "path" => "/", "name" => "portal_skill__name_en", "type" => "string", "description" => "portal_skill name_en" ),
		array( "path" => "/", "name" => "portal_skill__name_fr", "type" => "string", "description" => "portal_skill name_fr" ),
		array( "path" => "/", "name" => "portal_user2portal__skill_info", "type" => "string", "description" => "portal_skill information" ),
		array( "path" => "/", "name" => "record_create_date", "type" => "date", "description" => "record create date" ),
		array( "path" => "/", "name" => "record_modify_date", "type" => "date", "description" => "record last modify date" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_user2portal_skill_get(  )
{
	$portal_user2portal_skill__id = $_REQUEST["id"];

	if ( $row = portal_user2portal_skill_get( $portal_user2portal_skill__id ) ) {
		$response[] = array(
			"portal_user2portal_skill__id" => $row["portal_user2portal_skill__id"],
			"portal_user2portal_skill__crmid" => $row["portal_user2portal_skill__crmid"],
			"portal_user__id" => $row["portal_user__id"],
			"portal_user__crmid" => $row["portal_user__crmid"],
			"portal_skill__id" => $row["portal_skill__id"],
			"portal_skill__crmid" => $row["portal_skill__crmid"],
			"portal_skill__name_pl" => $row["portal_skill__name_pl"],
			"portal_skill__name_en" => $row["portal_skill__name_en"],
			"portal_skill__name_fr" => $row["portal_skill__name_fr"],
			"portal_user2portal__skill_info" => $row["portal_user2portal__skill_info"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}

	return $response;
}

// #

$API["msz/portal_user2portal_skill/fetch"] = array(
	"name" => "MSZ Fetch portal_user2portal_skill",
	"function" => "sm_api_plugin_msz_portal_user2portal_skill_fetch",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_user2portal_skill",
	"description" => "This method return information all skills for selected user.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_user__id", "default" => "required", "detail" => "unique portal_user__id ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_user2portal_skill__id", "type" => "uid", "description" => "unique portal_user2portal_skill ID" ),
		array( "path" => "/", "name" => "portal_user2portal_skill__crmid", "type" => "uid", "description" => "unique portal_user2portal_skill CRM ID" ),
		array( "path" => "/", "name" => "portal_user__id", "type" => "uid", "description" => "portal_user ID" ),
		array( "path" => "/", "name" => "portal_user__crmid", "type" => "uid", "description" => "portal_user CRM ID" ),
		array( "path" => "/", "name" => "portal_skill__id", "type" => "uid", "description" => "portal_skill ID" ),
		array( "path" => "/", "name" => "portal_skill__crmid", "type" => "uid", "description" => "portal_skill CRM ID" ),
		array( "path" => "/", "name" => "portal_skill__name_pl", "type" => "string", "description" => "portal_skill name_pl" ),
		array( "path" => "/", "name" => "portal_skill__name_en", "type" => "string", "description" => "portal_skill name_en" ),
		array( "path" => "/", "name" => "portal_skill__name_fr", "type" => "string", "description" => "portal_skill name_fr" ),
		array( "path" => "/", "name" => "portal_user2portal__skill_info", "type" => "string", "description" => "portal_skill information" ),
		array( "path" => "/", "name" => "record_create_date", "type" => "date", "description" => "record create date" ),
		array( "path" => "/", "name" => "record_modify_date", "type" => "date", "description" => "record last modify date" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_user2portal_skill_fetch(  )
{
	$portal_user__id = $_REQUEST["id"];

	if ( $result = portal_user2portal_skill_fetch_by_portal_user( $portal_user__id ) ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_user2portal_skill__id" => $row["portal_user2portal_skill__id"],
				"portal_user2portal_skill__crmid" => $row["portal_user2portal_skill__crmid"],
				"portal_user__id" => $row["portal_user__id"],
				"portal_user__crmid" => $row["portal_user__crmid"],
				"portal_skill__id" => $row["portal_skill__id"],
				"portal_skill__crmid" => $row["portal_skill__crmid"],
				"portal_skill__name_pl" => $row["portal_skill__name_pl"],
				"portal_skill__name_en" => $row["portal_skill__name_en"],
				"portal_skill__name_fr" => $row["portal_skill__name_fr"],
				"portal_user2portal__skill_info" => $row["portal_user2portal__skill_info"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

?>