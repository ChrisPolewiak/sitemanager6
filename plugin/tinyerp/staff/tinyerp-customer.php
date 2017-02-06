<?

sm_core_content_user_accesscheck($access_type_id."_READ",1);

if($_REQUEST["ajax"]){
	switch($_REQUEST["action"]){
		case "get":
			$tinyerp_customer = tinyerp_customer_get( $_REQUEST["tinyerp_customer__id"] );
			echo json_encode($tinyerp_customer);
			break;
	}
	exit;
}

$dane = $_REQUEST["dane"];
$tinyerp_customer__id = $_REQUEST["tinyerp_customer__id"];

if( isset($action["add"]) || isset($action["edit"]) ){
	$dane=trimall($dane);
	tinyerp_customer_validate( $dane );
}

if(!is_array($ERROR)) {
	if ( isset($action["add"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_customer__id = tinyerp_customer_add($dane);
		header("Location: ?tinyerp_customer__id=".$tinyerp_customer__id);
		exit;
	}
	elseif ( isset($action["edit"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_customer__id = tinyerp_customer_edit($dane);
		header("Location: ?tinyerp_customer__id=".$tinyerp_customer__id);
		exit;
	}
	elseif ( isset($action["delete"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		tinyerp_customer_delete($dane["tinyerp_customer__id"]);
		tinyerp_customer_delete($tinyerp_customer__id);
		header("Location: ?");
		exit;
	}
}
else {
	$tinyerp_customer__id = $tinyerp_customer__id ? $tinyerp_customer__id : "0";
}

if( $tinyerp_customer__id ) {
	$dane = tinyerp_customer_dane( $tinyerp_customer__id );
}

include "_page_header5.php";

$dane = htmlentitiesall($dane);

if (!$tinyerp_customer__id && $tinyerp_customer__id!="0") {
	$params = array(
		"button_back" => 1,
		"button_addnew" => 1,
		"dbname" => "tinyerp_customer",
		"function_fetch" => "tinyerp_customer_fetch_all()",
		"mainkey" => "tinyerp_customer__id",
		"columns" => array(
			array( "title"=>"Właściciel", "width"=>"", "value"=>"%%{tinyerp_company__name}%%", "order"=>1, ),
			array( "title"=>"Nazwa firmy", "width"=>"", "value"=>"%%{tinyerp_customer__name}%%", "order"=>1, ),
			array( "title"=>"NIP", "width"=>"", "value"=>"%%{tinyerp_customer__vatcode}%%", "order"=>1, ),
			array( "title"=>"Miasto", "width"=>"", "value"=>"%%{tinyerp_customer__city}%%", "order"=>1, ),
			array( "title"=>"E-mail", "width"=>"", "value"=>"%%{tinyerp_customer__email}%%", "order"=>1, ),
		),
		"row_per_page_default" => 100,
	);
	include "_datatable_list5.php";
}
else {
?>
					<div class="btn-toolbar">
						<div class="btn-group">
							<a class="btn btn-small btn-info" href="?"><i class="icon-list icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__BACK_TO_LIST")?></a>
							<a class="btn btn-small btn-info" href="?tinyerp_customer__id=0"><i class="icon-plus-sign icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__ADD_NEW")?></a>
						</div>
					</div>

					<form action="<?=$page?>" method=post enctype="multipart/form-data" id="sm-form">

						<div class="fieldset-title">
							<div>institution</div>
						</div>
						<fieldset class="no-legend">
<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if($result = tinyerp_company_fetch_all()){
			while( $row = $result->fetch(PDO::FETCH_ASSOC) ) {
				$inputfield_options[ $row["tinyerp_company__id"] ] = $row["tinyerp_company__name"];
			}
		}
?>
							<?=sm_inputfield(array(
								"type"	=> "select",
								"title"	=> "Właściciel",
								"help"	=> "",
								"id"	=> "dane_tinyerp_company__id",
								"name"	=> "dane[tinyerp_company__id]",
								"value"	=> $dane["tinyerp_company__id"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => $inputfield_options,
								"xss_secured" => true
							));?>

							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Nazwa",
								"help"	=> "",
								"id"	=> "dane_tinyerp_customer__name",
								"name"	=> "dane[tinyerp_customer__name]",
								"value"	=> $dane["tinyerp_customer__name"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
							<div class="float-row">
								<div class="span3">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Miasto",
								"help"	=> "",
								"id"	=> "dane_tinyerp_customer__city",
								"name"	=> "dane[tinyerp_customer__city]",
								"value"	=> $dane["tinyerp_customer__city"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span3">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Ulica",
								"help"	=> "",
								"id"	=> "dane_tinyerp_customer__street",
								"name"	=> "dane[tinyerp_customer__street]",
								"value"	=> $dane["tinyerp_customer__street"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span2">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Kod pocztowy",
								"help"	=> "",
								"id"	=> "dane_tinyerp_customer__postcode",
								"name"	=> "dane[tinyerp_customer__postcode]",
								"value"	=> $dane["tinyerp_customer__postcode"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span2">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Poczta",
								"help"	=> "",
								"id"	=> "dane_tinyerp_customer__postcity",
								"name"	=> "dane[tinyerp_customer__postcity]",
								"value"	=> $dane["tinyerp_customer__postcity"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span2">
<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if(isset($TINYERP_COUNTRY_ARRAY)){
			foreach($TINYERP_COUNTRY_ARRAY AS $k=>$v) {
				$inputfield_options[ $k ] = $v["01"];
			}
		}
?>
							<?=sm_inputfield(array(
								"type"	=> "select",
								"title"	=> "Country",
								"help"	=> "",
								"id"	=> "dane_tinyerp_customer__country_id",
								"name"	=> "dane[tinyerp_customer__country_id]",
								"value"	=> $dane["tinyerp_customer__country_id"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => $inputfield_options,
								"xss_secured" => true
							));?>
								</div>
							</div>
							<div class="float-row">
								<div class="span3">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "NIP",
								"help"	=> "",
								"id"	=> "dane_tinyerp_customer__vatcode",
								"name"	=> "dane[tinyerp_customer__vatcode]",
								"value"	=> $dane["tinyerp_customer__vatcode"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span2">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Regon",
								"help"	=> "",
								"id"	=> "dane_tinyerp_customer__regon",
								"name"	=> "dane[tinyerp_customer__regon]",
								"value"	=> $dane["tinyerp_customer__regon"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span4">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "E-mail",
								"help"	=> "",
								"id"	=> "dane_tinyerp_customer__email",
								"name"	=> "dane[tinyerp_customer__email]",
								"value"	=> $dane["tinyerp_customer__email"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
							</div>
						</fieldset>

<?	if (sm_core_content_user_accesscheck($access_type_id."_WRITE")) { ?>
						<input type=hidden name="dane[tinyerp_customer__crmid]" value="<?=$dane["tinyerp_customer__crmid"]?>">
						<input type=hidden name="dane[tinyerp_customer__id]" value="<?=$tinyerp_customer__id?>">
						<input type=hidden name="tinyerp_customer__id" value="<?=$tinyerp_customer__id?>">
						<div class="btn-toolbar">
<?		if ($dane["tinyerp_customer__id"]) {?>
							<a class="btn btn-normal btn-info" id="action-edit"><i class="icon-ok icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__SAVE")?></a>
							<a class="btn btn-normal btn-danger" id="action-delete"><i class="icon-remove icon-white" onclick="return confDelete()"></i>&nbsp;<?=__("CORE", "BUTTON__DELETE")?></a>
<?		} else {?>
							<a class="btn btn-normal btn-info" id="action-add"><i class="icon-ok icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__SAVE")?></a>
<?		}?>
						</div>
<script>
$('#action-edit').click(function() {
	$('#sm-form').append('<input type="hidden" name="action[edit]" value=1>');
	$('#sm-form').submit();
});
$('#action-delete').click(function() {
	$('#sm-form').append('<input type="hidden" name="action[delete]" value=1>');
	$('#sm-form').submit();
});
$('#action-add').click(function() {
	$('#sm-form').append('<input type="hidden" name="action[add]" value=1>');
	$('#sm-form').submit();
});
</script>
<?	} ?>

					</form>
<?
}
?>

<? include "_page_footer5.php"; ?>
