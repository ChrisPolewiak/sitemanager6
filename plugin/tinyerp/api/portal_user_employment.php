<?php

$API["msz/portal_user_employment/get"] = array(
	"name" => "MSZ Get portal_user_employment",
	"function" => "sm_api_plugin_msz_portal_user_employment_get",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_user_employment",
	"description" => "This method return all information about portal_user_employment object.",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_user_employment__id", "default" => "required", "detail" => "unique portal_user_employment ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_user_employment__id", "type" => "uid", "description" => "unique employment ID" ),
		array( "path" => "/", "name" => "portal_user_employment__crmid", "type" => "uid", "description" => "unique CRM employment ID" ),
		array( "path" => "/", "name" => "portal_user_employment__name", "type" => "string", "description" => "Employer name" ),
		array( "path" => "/", "name" => "portal_user_employment__position", "type" => "string", "description" => "Work position" ),
		array( "path" => "/", "name" => "portal_user_employment__sector", "type" => "string", "description" => "Employer sector" ),
		array( "path" => "/", "name" => "portal_user_employment__start", "type" => "string", "description" => "Start date" ),
		array( "path" => "/", "name" => "portal_user_employment__end", "type" => "string", "description" => "End date" ),
		array( "path" => "/", "name" => "portal_user_employment__information", "type" => "string", "description" => "Information about position" ),
		array( "path" => "/", "name" => "portal_user_employment__postcode", "type" => "string", "description" => "Employer post code" ),
		array( "path" => "/", "name" => "portal_user_employment__street", "type" => "string", "description" => "Employer street" ),
		array( "path" => "/", "name" => "portal_user_employment__street_number", "type" => "string", "description" => "Employer street number" ),
		array( "path" => "/", "name" => "portal_user_employment__foreign_service", "type" => "string", "description" => "Work for foreign service status" ),
		array( "path" => "/", "name" => "portal_user_employment__management_position", "type" => "string", "description" => "Work on management position" ),
		array( "path" => "/", "name" => "portal_user_employment__international_organization", "type" => "string", "description" => "Work for international organization" ),
		array( "path" => "/", "name" => "portal_user__id", "type" => "string", "description" => "User ID" ),
		array( "path" => "/", "name" => "portal_user__crmid", "type" => "string", "description" => "User CRM ID" ),
		array( "path" => "/", "name" => "portal_country__id", "type" => "string", "description" => "Employer country ID" ),
		array( "path" => "/", "name" => "portal_country__crmid", "type" => "string", "description" => "Employer country CRM ID" ),
		array( "path" => "/", "name" => "portal_country__name_pl", "type" => "string", "description" => "Employer country name" ),
		array( "path" => "/", "name" => "portal_country__name_en", "type" => "string", "description" => "Employer country name" ),
		array( "path" => "/", "name" => "portal_country__name_fr", "type" => "string", "description" => "Employer country name" ),
		array( "path" => "/", "name" => "record_create_date", "type" => "date", "description" => "Record create date" ),
		array( "path" => "/", "name" => "record_modify_date", "type" => "date", "description" => "Record last modify date" ),
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_user_employment_get()
{
	$portal_user_employment__id = $_REQUEST["id"];

	if ( $row = portal_user_employment_get( $portal_user_employment__id ) ) {
		$response[] = array(
			"portal_user_employment__id" => $row["portal_user_employment__id"],
			"portal_user_employment__crmid" => $row["portal_user_employment__crmid"],
			"portal_user_employment__name" => $row["portal_user_employment__name"],
			"portal_user_employment__position" => $row["portal_user_employment__position"],
			"portal_user_employment__sector" => $row["portal_user_employment__sector"],
			"portal_user_employment__start" => $row["portal_user_employment__start"],
			"portal_user_employment__end" => $row["portal_user_employment__end"],
			"portal_user_employment__information" => $row["portal_user_employment__information"],
			"portal_user_employment__postcode" => $row["portal_user_employment__postcode"],
			"portal_user_employment__city" => $row["portal_user_employment__city"],
			"portal_user_employment__street" => $row["portal_user_employment__street"],
			"portal_user_employment__street_number" => $row["portal_user_employment__street_number"],
			"portal_user_employment__foreign_service" => $row["portal_user_employment__foreign_service"],
			"portal_user_employment__management_position" => $row["portal_user_employment__management_position"],
			"portal_user_employment__international_organization" => $row["portal_user_employment__international_organization"],
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

	return $response;
}

// #

$API["msz/portal_user_employment/fetch"] = array(
	"function" => "sm_api_plugin_msz_portal_user_employment_fetch",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_user__id",
	"plugin" => "msz",
	"group" => "portal_user_employment",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_user__id", "default" => "required", "detail" => "unique portal_user__id ID", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "portal_user_employment__id", "type" => "uid", "description" => "unique employment ID" ),
		array( "path" => "/", "name" => "portal_user_employment__crmid", "type" => "uid", "description" => "unique CRM employment ID" ),
		array( "path" => "/", "name" => "portal_user_employment__name", "type" => "string", "description" => "Employer name" ),
		array( "path" => "/", "name" => "portal_user_employment__position", "type" => "string", "description" => "Work position" ),
		array( "path" => "/", "name" => "portal_user_employment__sector", "type" => "string", "description" => "Employer sector" ),
		array( "path" => "/", "name" => "portal_user_employment__start", "type" => "string", "description" => "Start date" ),
		array( "path" => "/", "name" => "portal_user_employment__end", "type" => "string", "description" => "End date" ),
		array( "path" => "/", "name" => "portal_user_employment__information", "type" => "string", "description" => "Information about position" ),
		array( "path" => "/", "name" => "portal_user_employment__postcode", "type" => "string", "description" => "Employer post code" ),
		array( "path" => "/", "name" => "portal_user_employment__street", "type" => "string", "description" => "Employer street" ),
		array( "path" => "/", "name" => "portal_user_employment__street_number", "type" => "string", "description" => "Employer street number" ),
		array( "path" => "/", "name" => "portal_user_employment__foreign_service", "type" => "string", "description" => "Work for foreign service status" ),
		array( "path" => "/", "name" => "portal_user_employment__management_position", "type" => "string", "description" => "Work on management position" ),
		array( "path" => "/", "name" => "portal_user_employment__international_organization", "type" => "string", "description" => "Work for international organization" ),
		array( "path" => "/", "name" => "portal_user__id", "type" => "string", "description" => "User ID" ),
		array( "path" => "/", "name" => "portal_user__crmid", "type" => "string", "description" => "User CRM ID" ),
		array( "path" => "/", "name" => "portal_country__id", "type" => "string", "description" => "Employer country ID" ),
		array( "path" => "/", "name" => "portal_country__crmid", "type" => "string", "description" => "Employer country CRM ID" ),
		array( "path" => "/", "name" => "portal_country__name_pl", "type" => "string", "description" => "Employer coutnry name" ),
		array( "path" => "/", "name" => "portal_country__name_en", "type" => "string", "description" => "Employer coutnry name" ),
		array( "path" => "/", "name" => "portal_country__name_fr", "type" => "string", "description" => "Employer coutnry name" ),
		array( "path" => "/", "name" => "record_create_date", "type" => "date", "description" => "Record create date" ),
		array( "path" => "/", "name" => "record_modify_date", "type" => "date", "description" => "Record last modify date" ),
		),
	"example_query" => "",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_user_employment_fetch( $params )
{
	$portal_user__id = $_REQUEST["id"];

	if ( $result = portal_user_employment_fetch_by_portal_user( $portal_user__id ) ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_user_employment__id" => $row["portal_user_employment__id"],
				"portal_user_employment__crmid" => $row["portal_user_employment__crmid"],
				"portal_user_employment__name" => $row["portal_user_employment__name"],
				"portal_user_employment__position" => $row["portal_user_employment__position"],
				"portal_user_employment__sector" => $row["portal_user_employment__sector"],
				"portal_user_employment__start" => $row["portal_user_employment__start"],
				"portal_user_employment__end" => $row["portal_user_employment__end"],
				"portal_user_employment__information" => $row["portal_user_employment__information"],
				"portal_user_employment__postcode" => $row["portal_user_employment__postcode"],
				"portal_user_employment__city" => $row["portal_user_employment__city"],
				"portal_user_employment__street" => $row["portal_user_employment__street"],
				"portal_user_employment__street_number" => $row["portal_user_employment__street_number"],
				"portal_user_employment__foreign_service" => $row["portal_user_employment__foreign_service"],
				"portal_user_employment__management_position" => $row["portal_user_employment__management_position"],
				"portal_user_employment__international_organization" => $row["portal_user_employment__international_organization"],
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