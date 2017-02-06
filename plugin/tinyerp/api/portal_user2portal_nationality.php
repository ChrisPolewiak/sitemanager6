<?php

$API["msz/portal_user2portal_nationality/get"] = array(
	"name" => "MSZ Get portal_user2portal_nationality",
	"function" => "sm_api_plugin_msz_portal_user2portal_nationality_get",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_user2portal_nationality__id",
	"plugin" => "msz",
	"group" => "portal_user2portal_nationality",
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

function sm_api_plugin_msz_portal_user2portal_nationality_get()
{
	$portal_user2portal_nationality__id = $_REQUEST["id"];

	if ( $row = portal_user2portal_nationality_get( $portal_user2portal_nationality__id ) ) {
		$response[] = array(
			"portal_user2portal_nationality__id" => $row["portal_user2portal_nationality__id"],
			"portal_user2portal_nationality__crmid" => $row["portal_user2portal_nationality__crmid"],
			"portal_user__id" => $row["portal_user__id"],
			"portal_user__crmid" => $row["portal_user__crmid"],
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

$API["msz/portal_user2portal_nationality/fetch"] = array(
	"name" => "MSZ Fetch portal_user2portal_nationality",
	"function" => "sm_api_plugin_msz_portal_user2portal_nationality_fetch",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_user2portal_nationality",
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

/**
* sm_api_plugin_msz_portal_user2portal_nationality_fetch()
*
* @return mixed $response
*/
function sm_api_plugin_msz_portal_user2portal_nationality_fetch()
{
	$portal_user__id = $_REQUEST["id"];

	if ( $result = portal_user2portal_nationality_fetch_by_portal_user( $portal_user__id ) ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_user2portal_nationality__id" => $row["portal_user2portal_nationality__id"],
				"portal_user2portal_nationality__crmid" => $row["portal_user2portal_nationality__crmid"],
				"portal_user__id" => $row["portal_user__id"],
				"portal_user__crmid" => $row["portal_user__crmid"],
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

?>