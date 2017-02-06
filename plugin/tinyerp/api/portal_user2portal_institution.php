<?php

$API["msz/portal_user2portal_institution/get"] = array(
	"name" => "MSZ Get portal_user2portal_institution",
	"function" => "sm_api_plugin_msz_portal_user2portal_institution_get",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_user2portal_institution__id",
	"plugin" => "msz",
	"group" => "portal_user2portal_institution",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_user2portal_institution__id", "default" => "required", "detail" => "unique portal_user2portal_institution__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_user2portal_institution_get()
{
	$portal_user2portal_institution__id = $_REQUEST["id"];

	if ( $row = portal_user2portal_institution_get( $portal_user2portal_institution__id ) ) {
		$response[] = array(
			"portal_user2portal_institution__id" => $row["portal_user2portal_institution__id"],
			"portal_user2portal_institution__crmid" => $row["portal_user2portal_institution__crmid"],
			"portal_user__id" => $row["portal_user__id"],
			"portal_user__crmid" => $row["portal_user__crmid"],
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

$API["msz/portal_user2portal_institution/fetch"] = array(
	"name" => "MSZ Fetch portal_user2portal_institution",
	"function" => "sm_api_plugin_msz_portal_user2portal_institution_fetch",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_user__id",
	"plugin" => "msz",
	"group" => "portal_user2portal_institution",
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

function sm_api_plugin_msz_portal_user2portal_institution_fetch()
{
	$portal_user__id = $_REQUEST["id"];

	if ( $result = portal_user2portal_institution_fetch_by_portal_user( $portal_user__id ) ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_user2portal_institution__id" => $row["portal_user2portal_institution__id"],
				"portal_user2portal_institution__crmid" => $row["portal_user2portal_institution__crmid"],
				"portal_user__id" => $row["portal_user__id"],
				"portal_user__crmid" => $row["portal_user__crmid"],
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

?>