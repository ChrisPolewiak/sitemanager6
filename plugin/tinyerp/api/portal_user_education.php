<?php

$API["msz/portal_user_education/get"] = array(
	"name" => "MSZ Get portal_user_education",
	"function" => "sm_api_plugin_msz_portal_user_education_get",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_user_education__id",
	"plugin" => "msz",
	"group" => "portal_user_education",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_user_education__id", "default" => "required", "detail" => "unique portal_user_education__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_user_education_get()
{
	$portal_user_education__id = $_REQUEST["id"];

	if ( $row = portal_user_education_get( $portal_user_education__id ) ) {
		$response[] = array(
			"portal_user_education__id" => $row["portal_user_education__id"],
			"portal_user_education__crmid" => $row["portal_user_education__crmid"],
			"portal_user__id" => $row["portal_user__id"],
			"portal_education_professional_title__id" => $row["portal_education_professional_title__id"],
			"portal_education_professional_title__crmid" => $row["portal_education_professional_title__crmid"],
			"portal_education_professional_title__name_pl" => $row["portal_education_professional_title__name_pl"],
			"portal_education_professional_title__name_en" => $row["portal_education_professional_title__name_en"],
			"portal_education_professional_title__name_fr" => $row["portal_education_professional_title__name_fr"],
			"portal_user_education__school_name" => $row["portal_user_education__school_name"],
			"portal_user_education__departament_name" => $row["portal_user_education__departament_name"],
			"portal_education_direction__id" => $row["portal_education_direction__id"]?$row["portal_education_direction__id"]:"",
			"portal_education_direction__crmid" => $row["portal_education_direction__crmid"],
			"portal_education_direction__name_pl" => $row["portal_education_direction__name_pl"],
			"portal_education_direction__name_en" => $row["portal_education_direction__name_en"],
			"portal_education_direction__name_fr" => $row["portal_education_direction__name_fr"],
			"portal_education_direction__othername" => $row["portal_education_direction__othername"],
			"portal_user_education__specialization" => $row["portal_user_education__specialization"],
			"portal_user_education__start" => $row["portal_user_education__start"],
			"portal_user_education__end" => $row["portal_user_education__end"],
			"portal_user_education__city" => $row["portal_user_education__city"],
			"portal_country__id" => $row["portal_country__id"],
			"portal_country__crmid" => $row["portal_country__crmid"],
			"portal_country__name_pl" => $row["portal_country__name_pl"],
			"portal_country__name_en" => $row["portal_country__name_en"],
			"portal_country__name_fr" => $row["portal_country__name_fr"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}
	return $response;
}

// #

$API["msz/portal_user_education/fetch"] = array(
	"name" => "MSZ Fetch portal_user_education",
	"function" => "sm_api_plugin_msz_portal_user_education_fetch",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_user__id",
	"plugin" => "msz",
	"group" => "portal_user_education",
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

function sm_api_plugin_msz_portal_user_education_fetch(  )
{
	$portal_user__id = $_REQUEST["id"];

	if ( $result = portal_user_education_fetch_by_portal_user( $portal_user__id ) ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_user_education__id" => $row["portal_user_education__id"],
				"portal_user_education__crmid" => $row["portal_user_education__crmid"],
				"portal_user_education__school_name" => $row["portal_user_education__school_name"],
				"portal_user_education__departament_name" => $row["portal_user_education__departament_name"],
				"portal_user_education__start" => $row["portal_user_education__start"],
				"portal_user_education__end" => $row["portal_user_education__end"],
				"portal_user_education__city" => $row["portal_user_education__city"],
				"portal_education_professional_title__id" => $row["portal_education_professional_title__id"],
				"portal_education_professional_title__crmid" => $row["portal_education_professional_title__crmid"],
				"portal_education_professional_title__name_pl" => $row["portal_education_professional_title__name_pl"],
				"portal_education_professional_title__name_en" => $row["portal_education_professional_title__name_en"],
				"portal_education_professional_title__name_fr" => $row["portal_education_professional_title__name_fr"],
				"portal_education_direction__id" => $row["portal_education_direction__id"]?$row["portal_education_direction__id"]:"",
				"portal_education_direction__crmid" => $row["portal_education_direction__crmid"],
				"portal_education_direction__name_pl" => $row["portal_education_direction__name_pl"],
				"portal_education_direction__name_en" => $row["portal_education_direction__name_en"],
				"portal_education_direction__name_fr" => $row["portal_education_direction__name_fr"],
				"portal_education_direction__othername" => $row["portal_education_direction__othername"],
				"portal_user__id" => $row["portal_user__id"],
				"portal_user__crmid" => $row["portal_user__crmid"],
				"portal_country__id" => $row["portal_country__id"],
				"portal_country__crmid" => $row["portal_country__crmid"],
				"portal_country__name_pl" => $row["portal_country__name_pl"],
				"portal_country__name_en" => $row["portal_country__name_en"],
				"portal_country__name_fr" => $row["portal_country__name_fr"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

?>