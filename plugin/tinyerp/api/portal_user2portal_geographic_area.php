<?php

$API["msz/portal_user2portal_geographic_area/get"] = array(
	"name" => "MSZ Get portal_user2portal_geographic_area",
	"function" => "sm_api_plugin_msz_portal_user2portal_geographic_area_get",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_user2portal_geographic_area__id",
	"plugin" => "msz",
	"group" => "portal_user2portal_geographic_area",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_user2portal_geographic_area__id", "default" => "required", "detail" => "unique portal_user2portal_geographic_area__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_user2portal_geographic_area_get()
{
	$portal_user2portal_geographic_area__id = $_REQUEST["id"];

	if ( $row = portal_user2portal_geographic_area_get( $portal_user2portal_geographic_area__id ) ) {
		$response[] = array(
			"portal_user2portal_geographic_area__id" => $row["portal_user2portal_geographic_area__id"],
			"portal_user2portal_geographic_area__crmid" => $row["portal_user2portal_geographic_area__crmid"],
			"portal_user__id" => $row["portal_user__id"],
			"portal_user__crmid" => $row["portal_user__crmid"],
			"portal_geographic_area__id" => $row["portal_geographic_area__id"],
			"portal_geographic_area__crmid" => $row["portal_geographic_area__crmid"],
			"portal_geographic_area__name_pl" => $row["portal_geographic_area__name_pl"],
			"portal_geographic_area__name_en" => $row["portal_geographic_area__name_en"],
			"portal_geographic_area__name_fr" => $row["portal_geographic_area__name_fr"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}

	return $response;
}

$API["msz/portal_user2portal_geographic_area/fetch"] = array(
	"name" => "MSZ Fetch portal_user2portal_geographic_area",
	"function" => "sm_api_plugin_msz_portal_user2portal_geographic_area_fetch",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_user__id",
	"plugin" => "msz",
	"group" => "portal_user2portal_geographic_area",
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

function sm_api_plugin_msz_portal_user2portal_geographic_area_fetch()
{
	$portal_user__id = $_REQUEST["id"];

	if ( $result = portal_user2portal_geographic_area_fetch_by_portal_user( $portal_user__id ) ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_user2portal_geographic_area__id" => $row["portal_user2portal_geographic_area__id"],
				"portal_user2portal_geographic_area__crmid" => $row["portal_user2portal_geographic_area__crmid"],
				"portal_user__id" => $row["portal_user__id"],
				"portal_user__crmid" => $row["portal_user__crmid"],
				"portal_geographic_area__id" => $row["portal_geographic_area__id"],
				"portal_geographic_area__crmid" => $row["portal_geographic_area__crmid"],
				"portal_geographic_area__name_pl" => $row["portal_geographic_area__name_pl"],
				"portal_geographic_area__name_en" => $row["portal_geographic_area__name_en"],
				"portal_geographic_area__name_fr" => $row["portal_geographic_area__name_fr"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

?>