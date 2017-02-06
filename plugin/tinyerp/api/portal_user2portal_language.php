<?php

$API["msz/portal_user2portal_language/get"] = array(
	"name" => "MSZ Get portal_user2portal_language",
	"function" => "sm_api_plugin_msz_portal_user2portal_language_get",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_user2portal_language__id",
	"plugin" => "msz",
	"group" => "portal_user2portal_language",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_user2portal_language__id", "default" => "required", "detail" => "unique portal_user2portal_language__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_user2portal_language_get()
{
	$portal_user2portal_language__id = $_REQUEST["id"];

	if ( $row = portal_user2portal_language_get( $portal_user2portal_language__id ) ) {
		$response[] = array(
			"portal_user2portal_language__id" => $row["portal_user2portal_language__id"],
			"portal_user2portal_language__crmid" => $row["portal_user2portal_language__crmid"],
			"portal_user__id" => $row["portal_user__id"],
			"portal_user__crmid" => $row["portal_user__crmid"],
			"portal_language__id" => $row["portal_language__id"],
			"portal_language__crmid" => $row["portal_language__crmid"],
			"portal_language__name_pl" => $row["portal_language__name_pl"],
			"portal_language__name_en" => $row["portal_language__name_en"],
			"portal_language__name_fr" => $row["portal_language__name_fr"],
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

$API["msz/portal_user2portal_language/fetch"] = array(
	"name" => "MSZ Fetch portal_user2portal_language",
	"function" => "sm_api_plugin_msz_portal_user2portal_language_fetch",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_user__id",
	"plugin" => "msz",
	"group" => "portal_user2portal_language",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_user__id", "default" => "required", "detail" => "unique portal_user__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_user2portal_language_fetch()
{
	$portal_user__id = $_REQUEST["id"];

	if ( $result = portal_user2portal_language_fetch_by_portal_user( $portal_user__id ) ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_user2portal_language__id" => $row["portal_user2portal_language__id"],
				"portal_user2portal_language__crmid" => $row["portal_user2portal_language__crmid"],
				"portal_user__id" => $row["portal_user__id"],
				"portal_user__crmid" => $row["portal_user__crmid"],
				"portal_language__id" => $row["portal_language__id"],
				"portal_language__crmid" => $row["portal_language__crmid"],
				"portal_language__name_pl" => $row["portal_language__name_pl"],
				"portal_language__name_en" => $row["portal_language__name_en"],
				"portal_language__name_fr" => $row["portal_language__name_fr"],
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

?>