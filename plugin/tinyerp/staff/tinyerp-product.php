<?

sm_core_content_user_accesscheck($access_type_id."_READ",1);

if($_REQUEST["ajax"]){
	switch($_REQUEST["action"]){
		case "get":
			$tinyerp_product = tinyerp_product_get( $_REQUEST["tinyerp_product__id"] );
			echo json_encode($tinyerp_product);
			break;
	}
	exit;
}

$dane = $_REQUEST["dane"];
$tinyerp_product__id = $_REQUEST["tinyerp_product__id"];

if( isset($action["add"]) || isset($action["edit"]) ){
	$dane=trimall($dane);
	tinyerp_product_validate( $dane );
}

if(!is_array($ERROR)) {
	if ( isset($action["add"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_product__id = tinyerp_product_add($dane);
		header("Location: ?tinyerp_product__id=".$tinyerp_product__id);
		exit;
	}
	elseif ( isset($action["edit"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_product__id = tinyerp_product_edit($dane);
		header("Location: ?tinyerp_product__id=".$tinyerp_product__id);
		exit;
	}
	elseif ( isset($action["delete"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		tinyerp_product_delete($dane["tinyerp_product__id"]);
		tinyerp_product_delete($tinyerp_product__id);
		header("Location: ?");
		exit;
	}
}
else {
	$tinyerp_product__id = $tinyerp_product__id ? $tinyerp_product__id : "0";
}

if( $tinyerp_product__id ) {
	$dane = tinyerp_product_dane( $tinyerp_product__id );
}

include "_page_header5.php";

$dane = htmlentitiesall($dane);

if (!$tinyerp_product__id && $tinyerp_product__id!="0") {

	foreach($TINYERP_VAT_CODE_ARRAY AS $k=>$v) {
		$tinyerp_vat_code_valuesmatch[$k] = $v["01"];
	}

	$params = array(
		"button_back" => 1,
		"button_addnew" => 1,
		"dbname" => "tinyerp_product",
		"function_fetch" => "tinyerp_product_fetch_all()",
		"mainkey" => "tinyerp_product__id",
		"columns" => array(
			array( "title"=>"Właściciel", "width"=>"", "value"=>"%%{tinyerp_company__name}%%", "order"=>1, ),
			array( "title"=>"Nazwa produktu", "width"=>"", "value"=>"%%{tinyerp_product__name}%%", "order"=>1, ),
			array( "title"=>"Cena", "width"=>"", "value"=>"%%{tinyerp_product__price_netto}%%", "order"=>1, ),
			array( "title"=>"Jednostka", "width"=>"", "value"=>"%%{tinyerp_product__unit}%%", "order"=>1, ),
			array( "title"=>"Stawka VAT", "width"=>"", "value"=>"%%{tinyerp_product__vat_code}%%", "order"=>1, "valuesmatch"=>$tinyerp_vat_code_valuesmatch),
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
							<a class="btn btn-small btn-info" href="?tinyerp_product__id=0"><i class="icon-plus-sign icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__ADD_NEW")?></a>
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
								"title"	=> "Nazwa produktu",
								"help"	=> "",
								"id"	=> "dane_tinyerp_product__name",
								"name"	=> "dane[tinyerp_product__name]",
								"value"	=> $dane["tinyerp_product__name"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>

							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Index produktu",
								"help"	=> "",
								"id"	=> "dane_tinyerp_product__idx",
								"name"	=> "dane[tinyerp_product__idx]",
								"value"	=> $dane["tinyerp_product__idx"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>

							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Jednostka",
								"help"	=> "",
								"id"	=> "dane_tinyerp_product__unit",
								"name"	=> "dane[tinyerp_product__unit]",
								"value"	=> $dane["tinyerp_product__unit"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>

							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Cena netto",
								"help"	=> "",
								"id"	=> "dane_tinyerp_product__price_netto",
								"name"	=> "dane[tinyerp_product__price_netto]",
								"value"	=> $dane["tinyerp_product__price_netto"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>

<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if(isset($TINYERP_VAT_CODE_ARRAY)){
			foreach($TINYERP_VAT_CODE_ARRAY AS $k=>$v) {
				$inputfield_options[ $k ] = $v["01"];
			}
		}
?>

							<?=sm_inputfield(array(
								"type"	=> "select",
								"title"	=> "Stawka VAT",
								"help"	=> "",
								"id"	=> "dane_tinyerp_product__vat_code",
								"name"	=> "dane[tinyerp_product__vat_code]",
								"value"	=> $dane["tinyerp_product__vat_code"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => $inputfield_options,
								"xss_secured" => true
							));?>

						</fieldset>

<?	if (sm_core_content_user_accesscheck($access_type_id."_WRITE")) { ?>
						<input type=hidden name="dane[tinyerp_product__crmid]" value="<?=$dane["tinyerp_product__crmid"]?>">
						<input type=hidden name="dane[tinyerp_product__id]" value="<?=$tinyerp_product__id?>">
						<input type=hidden name="tinyerp_product__id" value="<?=$tinyerp_product__id?>">
						<div class="btn-toolbar">
<?		if ($dane["tinyerp_product__id"]) {?>
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
