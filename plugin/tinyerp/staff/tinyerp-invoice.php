<?

sm_core_content_user_accesscheck($access_type_id."_READ",1);

if($_REQUEST["ajax"]){
	switch($_REQUEST["action"]){
		case "get_product":
			$invoice_product = invoice_product_get( $_REQUEST["tinyerp_product__id"] );
			echo json_encode($invoice_product);
			break;
	}
	exit;
}

$dane = $_REQUEST["dane"];
$tinyerp_invoice__id = $_REQUEST["tinyerp_invoice__id"];

$dane_invoiceline = $_REQUEST["dane_invoiceline"];
$tinyerp_invoiceline__id = $_REQUEST["tinyerp_invoiceline__id"];

if( isset($action["add"]) || isset($action["edit"]) ){
	$dane=trimall($dane);
	tinyerp_invoice_validate( $dane );
}

if(!is_array($ERROR)) {
	if ( isset($action["add"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_invoice__id = tinyerp_invoice_add($dane);
		header("Location: ?tinyerp_invoice__id=".$tinyerp_invoice__id);
		exit;
	}
	elseif ( isset($action["edit"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_invoice__id = tinyerp_invoice_edit($dane);
		header("Location: ?tinyerp_invoice__id=".$tinyerp_invoice__id);
		exit;
	}
	elseif ( isset($action["delete"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		tinyerp_invoice_delete($dane["tinyerp_invoice__id"]);
		tinyerp_invoice_delete($tinyerp_invoice__id);
		header("Location: ?");
		exit;
	}

	if ( isset($action["invoiceline_add"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$dane_invoiceline["tinyerp_company__id"] = $dane["tinyerp_company__id"];
		$tinyerp_invoiceline__id = tinyerp_invoiceline_add($dane_invoiceline);
		header("Location: ?tinyerp_invoice__id=".$tinyerp_invoice__id);
		exit;
	}
	if ( isset($action["invoiceline_edit"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$dane_invoiceline["tinyerp_company__id"] = $dane_invoice["tinyerp_company__id"];
		$tinyerp_invoiceline__id = tinyerp_invoiceline_edit($dane_invoiceline);
		header("Location: ?tinyerp_invoice__id=".$tinyerp_invoice__id);
		exit;
	}

}
else {
	$tinyerp_invoice__id = $tinyerp_invoice__id ? $tinyerp_invoice__id : "0";
}

if( $tinyerp_invoice__id ) {
	$dane = tinyerp_invoice_dane( $tinyerp_invoice__id );
}
if( $tinyerp_invoiceline__id ) {
	$dane_invoiceline = tinyerp_invoiceline_dane( $tinyerp_invoiceline__id );

print_r($dane_invoiceline);
}

include "_page_header5.php";

$dane = htmlentitiesall($dane);

if (!$tinyerp_invoice__id && $tinyerp_invoice__id!="0") {
	$params = array(
		"button_back" => 1,
		"button_addnew" => 1,
		"dbname" => "tinyerp_invoice",
		"function_fetch" => "tinyerp_invoice_fetch_all()",
		"mainkey" => "tinyerp_invoice__id",
		"columns" => array(
			array( "title"=>"Właściciel", "width"=>"", "value"=>"%%{tinyerp_company__name}%%", "order"=>1, ),
			array( "title"=>"Numer faktury", "width"=>"", "value"=>"%%{tinyerp_invoice__numberstr}%%", "order"=>1, ),
			array( "title"=>"Data wystawienia", "width"=>"", "value"=>"%%{tinyerp_invoice__date_issue}%%", "order"=>1, ),
			array( "title"=>"Wartość brutto", "width"=>"", "value"=>"%%{tinyerp_invoice__totalbrutto}%%", "order"=>1, ),
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
							<a class="btn btn-small btn-info" href="?tinyerp_invoice__id=0"><i class="icon-plus-sign icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__ADD_NEW")?></a>
						</div>
					</div>

					<form action="<?=$page?>" method=post enctype="multipart/form-data" id="sm-form">

						<ul class="nav nav-tabs" id="tabs">
							<li><a href="#tabs-header">Nagłówek</a></li>
							<li><a href="#tabs-customer">Dane klienta</a></li>
							<li><a href="#tabs-inne">Inne</a></li>
<?	if( $tinyerp_invoice__id ) { ?>
							<li><a href="#tabs-invoicelines">Elementy faktury</a></li>
<?	} ?>
						</ul>

						<div class="tab-content">
							<div id="tabs-header" class="tab-pane">
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

<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if($result = tinyerp_invoicegroup_fetch_all()){
			while( $row = $result->fetch(PDO::FETCH_ASSOC) ) {
				$inputfield_options[ $row["tinyerp_invoicegroup__id"] ] = $row["tinyerp_invoicegroup__name"];
			}
		}
?>
									<div class="row-float">
										<div class="span4">
							<?=sm_inputfield(array(
								"type"	=> "select",
								"title"	=> "Grupa fakturowa",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoicegroup__id",
								"name"	=> "dane[tinyerp_invoicegroup__id]",
								"value"	=> $dane["tinyerp_invoicegroup__id"],
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
										<div class="span2">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Numer faktury",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoice__numberstr",
								"name"	=> "dane[tinyerp_invoice__numberstr]",
								"value"	=> $dane["tinyerp_invoice__numberstr"],
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
								"title"	=> "Numer kolejny",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoice__numbercounter",
								"name"	=> "dane[tinyerp_invoice__numbercounter]",
								"value"	=> $dane["tinyerp_invoice__numbercounter"],
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
								"type"	=> "calendar",
								"title"	=> "Data wystawienia",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoice__date_issue",
								"name"	=> "dane[tinyerp_invoice__date_issue]",
								"value"	=> $dane["tinyerp_invoice__date_issue"] ? $dane["tinyerp_invoice__date_issue"] : date("Y-m-d"),
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
								"type"	=> "calendar",
								"title"	=> "Data dostawy",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoice__date_delivery",
								"name"	=> "dane[tinyerp_invoice__date_delivery]",
								"value"	=> $dane["tinyerp_invoice__date_delivery"],
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
							</div>
							<div id="tabs-customer" class="tab-pane">
								<fieldset class="no-legend">
<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if($result = tinyerp_customer_fetch_all()){
			while( $row = $result->fetch(PDO::FETCH_ASSOC) ) {
				$inputfield_options[ $row["tinyerp_customer__id"] ] = $row["tinyerp_customer__name"];
			}
		}
?>
							<?=sm_inputfield(array(
								"type"	=> "select",
								"title"	=> "Klient",
								"help"	=> "",
								"id"	=> "dane_tinyerp_customer__id",
								"name"	=> "dane[tinyerp_customer__id]",
								"value"	=> $dane["tinyerp_customer__id"],
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
								"id"	=> "dane_tinyerp_invoice__customer_name",
								"name"	=> "dane[tinyerp_invoice__customer_name]",
								"value"	=> $dane["tinyerp_invoice__customer_name"],
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
								"id"	=> "dane_tinyerp_invoice__customer_city",
								"name"	=> "dane[tinyerp_invoice__customer_city]",
								"value"	=> $dane["tinyerp_invoice__customer_city"],
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
								"id"	=> "dane_tinyerp_invoice__customer_street",
								"name"	=> "dane[tinyerp_invoice__customer_street]",
								"value"	=> $dane["tinyerp_invoice__customer_street"],
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
								"id"	=> "dane_tinyerp_invoice__customer_postcode",
								"name"	=> "dane[tinyerp_invoice__customer_postcode]",
								"value"	=> $dane["tinyerp_invoice__customer_postcode"],
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
								"id"	=> "dane_tinyerp_invoice__customer_postcity",
								"name"	=> "dane[tinyerp_invoice__customer_postcity]",
								"value"	=> $dane["tinyerp_invoice__customer_postcity"],
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
								"title"	=> "Country",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoice__customer_country",
								"name"	=> "dane[tinyerp_invoice__customer_country]",
								"value"	=> $dane["tinyerp_invoice__customer_country"],
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
									<div class="float-row">
										<div class="span3">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "NIP",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoice__customer_vatcode",
								"name"	=> "dane[tinyerp_invoice__customer_vatcode]",
								"value"	=> $dane["tinyerp_invoice__customer_vatcode"],
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
								"id"	=> "dane_tinyerp_invoice__customer_email",
								"name"	=> "dane[tinyerp_invoice__customer_email]",
								"value"	=> $dane["tinyerp_invoice__customer_email"],
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

							</div>
							<div id="tabs-inne" class="tab-pane">

								<fieldset class="no-legend">
									<div class="float-row">
										<div class="span4">
<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if(isset($TINYERP_PAYMENT_TYPE_ARRAY)){
			foreach($TINYERP_PAYMENT_TYPE_ARRAY AS $k=>$v) {
				$inputfield_options[ $k ] = $v["01"];
			}
		}
?>
							<?=sm_inputfield(array(
								"type"	=> "select",
								"title"	=> "Sposób płatności",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoice__payment_type",
								"name"	=> "dane[tinyerp_invoice__payment_type]",
								"value"	=> $dane["tinyerp_invoice__payment_type"],
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
										<div class="span4">
							<?=sm_inputfield(array(
								"type"	=> "calendar",
								"title"	=> "Termin płatności",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoice__payment_date_limit",
								"name"	=> "dane[tinyerp_invoice__payment_date_limit]",
								"value"	=> $dane["tinyerp_invoice__payment_date_limit"],
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
								"title"	=> "Zapłacono",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoice__payment_done",
								"name"	=> "dane[tinyerp_invoice__payment_done]",
								"value"	=> $dane["tinyerp_invoice__payment_done"],
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
									<div class="float-row">
										<div class="span4">
<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if($result = tinyerp_user_fetch_all()){
			while( $row = $result->fetch(PDO::FETCH_ASSOC) ) {
				$inputfield_options[ $row["tinyerp_user__id"] ] = $row["tinyerp_company__name"]." : ".$row["content_user__username"];
			}
		}
?>
							<?=sm_inputfield(array(
								"type"	=> "select",
								"title"	=> "Wystawił",
								"help"	=> "",
								"id"	=> "dane_tinyerp_user__id",
								"name"	=> "dane[tinyerp_user__id]",
								"value"	=> $dane["tinyerp_user__id"],
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
										<div class="span8">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Wystawił",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoice__issuername",
								"name"	=> "dane[tinyerp_invoice__issuername]",
								"value"	=> $dane["tinyerp_invoice__issuername"],
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
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Odebrał",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoice__receivername",
								"name"	=> "dane[tinyerp_invoice__receivername]",
								"value"	=> $dane["tinyerp_invoice__receivername"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</fieldset>
							</div>
<?

// INVOICE LINE

if( $tinyerp_invoice__id ) {
?>
							<div id="tabs-invoicelines" class="tab-pane">

								<fieldset class="no-legend">
									<table class=table>
										<thead>
											<tr>
												<th>Nr</th>
												<th>Pozycja</th>
												<th>Ilość</th>
												<th>Jedn.</th>
												<th>Cena jedn.</th>
												<th>Wartość netto</th>
												<th>Stawka VAT</th>
												<th>Kwota VAT</th>
												<th>Wartość Brutto</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
<?
	if($result=tinyerp_invoiceline_fetch_by_invoice( $tinyerp_invoice__id )){
		while($row=$result->fetch(PDO::FETCH_ASSOC)){
?>
											<tr>
												<td><?=$row["tinyerp_invoiceline__number"]?></td>
												<td><?=$row["tinyerp_invoiceline__product_name"]?></td>
												<td><?=$row["tinyerp_invoiceline__quantity"]?></td>
												<td><?=$row["tinyerp_invoiceline__unit"]?></td>
												<td><?=$row["tinyerp_invoiceline__price_netto"]?></td>
												<td><?=$row["tinyerp_invoiceline__total_nettoo"]?></td>
												<td><?=$row["tinyerp_invoiceline__vat_code"]?></td>
												<td><?=$row["tinyerp_invoiceline__vat_amount"]?></td>
												<td><?=$row["tinyerp_invoiceline__total_brutto"]?></td>
												<td>
													<a href="?tinyerp_invoice__id=<?=$tinyerp_invoice__id?>&tinyerp_invoiceline__id=<?=$row["tinyerp_invoiceline__id"]?>"><i class="icon-edit"></i></a>
													<a href="?tinyerp_invoice__id=<?=$tinyerp_invoice__id?>&tinyerp_invoiceline__id=<?=$row["tinyerp_invoiceline__id"]?>&action[invoiceline__delete]=1" onclick="return confDelete()"><i class="icon-remove"></i></a>
												</td>
											</tr>
<?
		}
	}
?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="10">
													<a href="?tinyerp_invoice__id=<?=$tinyerp_invoice__id?>&tinyerp_invoiceline__id=0"><?=__("CORE","BUTTON__ADD_NEW")?></a>
												</td>
											</tr>
										<tfoot>
									</table>
<?	
	// FORM
	if (isset($tinyerp_invoiceline__id)) {
?>
									<div class="row-float">
										<div class="span3">

<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if($result = tinyerp_product_fetch_by_company( $dane["tinyerp_company__id"] )){
			while( $row = $result->fetch(PDO::FETCH_ASSOC) ) {
				$inputfield_options[ $row["tinyerp_product__id"] ] = $row["tinyerp_product__name"];
			}
		}
?>

											<?=sm_inputfield(array(
												"type"	=> "select",
												"title"	=> "Produkt (szukaj)",
												"help"	=> "",
												"id"	=> "dane_invoiceline_tinyerp_product__id",
												"name"	=> "dane_invoiceline[tinyerp_product__id]",
												"value"	=> $dane_invoiceline["tinyerp_product__id"],
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
										<div class="span2">
											<?=sm_inputfield(array(
												"type"	=> "text",
												"title"	=> "Index",
												"help"	=> "",
												"id"	=> "dane_invoiceline_tinyerp_invoiceline__product_idx",
												"name"	=> "dane_invoiceline[tinyerp_invoiceline__product_idx]",
												"value"	=> $dane_invoiceline["tinyerp_invoiceline__product_idx"],
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
										<div class="span7">
											<?=sm_inputfield(array(
												"type"	=> "text",
												"title"	=> "Produkt",
												"help"	=> "",
												"id"	=> "dane_invoiceline_tinyerp_invoiceline__product_name",
												"name"	=> "dane_invoiceline[tinyerp_invoiceline__product_name]",
												"value"	=> $dane_invoiceline["tinyerp_invoiceline__product_name"],
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
									<div class="row-float">
										<div class="span2">
											<?=sm_inputfield(array(
												"type"	=> "text",
												"title"	=> "Nr",
												"help"	=> "",
												"id"	=> "dane_invoiceline_tinyerp_invoiceline__number",
												"name"	=> "dane_invoiceline[tinyerp_invoiceline__number]",
												"value"	=> $dane_invoiceline["tinyerp_invoiceline__number"],
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
												"title"	=> "Ilość",
												"help"	=> "",
												"id"	=> "dane_invoiceline_tinyerp_invoiceline__quantity",
												"name"	=> "dane_invoiceline[tinyerp_invoiceline__quantity]",
												"value"	=> $dane_invoiceline["tinyerp_invoiceline__quantity"],
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
												"title"	=> "Jednostka",
												"help"	=> "",
												"id"	=> "dane_invoiceline_tinyerp_invoiceline__unit",
												"name"	=> "dane_invoiceline[tinyerp_invoiceline__unit]",
												"value"	=> $dane_invoiceline["tinyerp_invoiceline__unit"],
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
												"title"	=> "Cena netto",
												"help"	=> "",
												"id"	=> "dane_invoiceline_tinyerp_invoiceline__price_netto",
												"name"	=> "dane_invoiceline[tinyerp_invoiceline__price_netto]",
												"value"	=> $dane_invoiceline["tinyerp_invoiceline__price_netto"],
												"size"	=> "block-level",
												"disabled" => 0,
												"validation" => 0,
												"prepend" => 0,
												"append" => 0,
												"rows" => 3,
												"options" => "",
												"xss_secured" => true
											));?>
										</div>
										<div class="span4">
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
												"id"	=> "dane_invoiceline_tinyerp_invoiceline__vat_code",
												"name"	=> "dane_invoiceline[tinyerp_invoiceline__vat_code]",
												"value"	=> $dane_invoiceline["tinyerp_invoiceline__vat_code"],
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
									<div class="row-float">
										<div class="span2">
											<?=sm_inputfield(array(
												"type"	=> "text",
												"title"	=> "Wartość netto",
												"help"	=> "",
												"id"	=> "dane_invoiceline_tinyerp_invoiceline__total_netto",
												"name"	=> "dane_invoiceline[tinyerp_invoiceline__total_netto]",
												"value"	=> $dane_invoiceline["tinyerp_invoiceline__total_netto"],
												"size"	=> "block-level",
												"disabled" => 0,
												"validation" => 0,
												"prepend" => 0,
												"append" => 0,
												"rows" => 3,
												"options" => "",
												"xss_secured" => true
											));?>
										</div>
										<div class="span2">
											<?=sm_inputfield(array(
												"type"	=> "text",
												"title"	=> "Kwota VAT",
												"help"	=> "",
												"id"	=> "dane_invoiceline_tinyerp_invoiceline__vat_amount",
												"name"	=> "dane_invoiceline[tinyerp_invoiceline__vat_amount]",
												"value"	=> $dane_invoiceline["tinyerp_invoiceline__vat_amount"],
												"size"	=> "block-level",
												"disabled" => 0,
												"validation" => 0,
												"prepend" => 0,
												"append" => 0,
												"rows" => 3,
												"options" => "",
												"xss_secured" => true
											));?>
										</div>
										<div class="span2">
											<?=sm_inputfield(array(
												"type"	=> "text",
												"title"	=> "Kwota brutto",
												"help"	=> "",
												"id"	=> "dane_invoiceline_tinyerp_invoiceline__total_brutto",
												"name"	=> "dane_invoiceline[tinyerp_invoiceline__total_brutto]",
												"value"	=> $dane_invoiceline["tinyerp_invoiceline__total_brutto"],
												"size"	=> "block-level",
												"disabled" => 0,
												"validation" => 0,
												"prepend" => 0,
												"append" => 0,
												"rows" => 3,
												"options" => "",
												"xss_secured" => true
											));?>
										</div>
									</div>


<?		if (sm_core_content_user_accesscheck($access_type_id."_WRITE")) { ?>
									<input type=hidden name="dane_invoiceline[tinyerp_invoiceline__id]" value="<?=$tinyerp_invoiceline__id?>">
									<input type=hidden name="tinyerp_invoiceline__id" value="<?=$tinyerp_invoiceline__id?>">
									<input type=hidden name="dane_invoiceline[tinyerp_invoice__id]" value="<?=$tinyerp_invoice__id?>">
									<input type=hidden name="tinyerp_invoice__id" value="<?=$tinyerp_invoice__id?>">
									<div class="btn-toolbar">
<?			if ($dane_invoiceline["tinyerp_invoiceline__id"]) {?>
										<a class="btn btn-normal btn-info" id="action-invoiceline_edit"><i class="icon-ok icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__SAVE")?></a>
										<a class="btn btn-normal btn-danger" id="action-invoiceline__delete" onclick="return confDelete()"><i class="icon-remove icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__DELETE")?></a>
<?			} else {?>
										<a class="btn btn-normal btn-info" id="action-invoiceline_add"><i class="icon-ok icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__SAVE")?></a>
<?			}?>
									</div>
<script>
$('#action-invoiceline_edit').click(function() {
	$('#sm-form').append('<input type="hidden" name="action[invoiceline_edit]" value=1>');
	$('#sm-form').submit();
});
$('#action-invoiceline__delete').click(function() {
	$('#sm-form').append('<input type="hidden" name="action[invoiceline__delete]" value=1>');
	$('#sm-form').submit();
});
$('#action-invoiceline_add').click(function() {
	$('#sm-form').append('<input type="hidden" name="action[invoiceline_add]" value=1>');
	$('#sm-form').submit();
});

$('#dane_invoiceline_tinyerp_product__id').unbind();
$('#dane_invoiceline_tinyerp_product__id').bind('change', function() {
	tinyerp_product__id = this.value;
	if(tinyerp_product__id) {
		url='tinyerp-product.php?ajax=1&action=get&tinyerp_product__id='+tinyerp_product__id;
		$.ajax({
			url: url,
			dataType: 'json',
			success: function(data) {
				$('#dane_invoiceline_tinyerp_invoiceline__product_idx').val( data.tinyerp_product__idx );
				$('#dane_invoiceline_tinyerp_invoiceline__product_name').val( data.tinyerp_product__name );
				$('#dane_invoiceline_tinyerp_invoiceline__unit').val( data.tinyerp_product__unit );
				$('#dane_invoiceline_tinyerp_invoiceline__price_netto').val( data.tinyerp_product__price_netto );
				$('#dane_invoiceline_tinyerp_invoiceline__vat_code').val( data.tinyerp_product__vat_code );
			},
			error: function(error) {
				alert('error='+error);
			},
		});
	}
});

var tinyerp_vatcode = new Array();
<?
		if(isset($TINYERP_VAT_CODE_ARRAY)){
			foreach($TINYERP_VAT_CODE_ARRAY AS $k=>$v) {
?>
tinyerp_vatcode['<?=$k?>'] = '<?=$v["02"]?>';
<?
			}
		}
?>


$.calculate = function() {
	var quantity = $('#dane_invoiceline_tinyerp_invoiceline__quantity').val();
	var price_netto = $('#dane_invoiceline_tinyerp_invoiceline__price_netto').val();
	var vat_code = $('#dane_invoiceline_tinyerp_invoiceline__vat_code').val();
	var vat_value = tinyerp_vatcode[vat_code];
	
	total_netto = quantity * price_netto;
	vat_amount = quantity * price_netto * vat_value;
	vat_amount = Math.round( vat_amount * 100) / 100;
	total_brutto = total_netto + vat_amount;
	total_brutto = Math.round( total_brutto * 100) / 100;
	
	$('#dane_invoiceline_tinyerp_invoiceline__total_netto').val( total_netto );
	$('#dane_invoiceline_tinyerp_invoiceline__vat_amount').val( vat_amount );
	$('#dane_invoiceline_tinyerp_invoiceline__total_brutto').val( total_brutto );
};

$('#dane_invoiceline_tinyerp_invoiceline__quantity').unbind();
$('#dane_invoiceline_tinyerp_invoiceline__quantity').bind('change', function() {
	$.calculate();
});
$('#dane_invoiceline_tinyerp_invoiceline__price_netto').bind('change', function() {
	$.calculate();
});
$('#dane_invoiceline_tinyerp_invoiceline__vat_code').bind('change', function() {
	$.calculate();
});

</script>
<?		}?>
<?
	}
?>
								</fieldset>
							</div>
<?
}
?>

						</div>

<?	if (sm_core_content_user_accesscheck($access_type_id."_WRITE")) { ?>
						<input type=hidden name="dane[tinyerp_invoice__id]" value="<?=$tinyerp_invoice__id?>">
						<input type=hidden name="tinyerp_invoice__id" value="<?=$tinyerp_invoice__id?>">
						<div class="btn-toolbar">
<?		if ($dane["tinyerp_invoice__id"]) {?>
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

$('#dane_tinyerp_customer__id').unbind();
$('#dane_tinyerp_customer__id').bind('change', function() {
	tinyerp_customer__id = this.value;
	if(tinyerp_customer__id) {
		url='tinyerp-customer.php?ajax=1&action=get&tinyerp_customer__id='+tinyerp_customer__id;
		$.ajax({
			url: url,
			dataType: 'json',
			success: function(data) {
				$('#dane_tinyerp_invoice__customer_name').val( data.tinyerp_customer__name );
				$('#dane_tinyerp_invoice__customer_city').val( data.tinyerp_customer__city );
				$('#dane_tinyerp_invoice__customer_street').val( data.tinyerp_customer__street );
				$('#dane_tinyerp_invoice__customer_postcode').val( data.tinyerp_customer__postcode );
				$('#dane_tinyerp_invoice__customer_postcity').val( data.tinyerp_customer__postcity );
				$('#dane_tinyerp_invoice__customer_country').val( data.tinyerp_customer__country_name );
				$('#dane_tinyerp_invoice__customer_vatcode').val( data.tinyerp_customer__vatcode);
				$('#dane_tinyerp_invoice__customer_email').val( data.tinyerp_customer__email );
			},
			error: function(error) {
				alert('error='+error);
			},
		});
	}
});

$('#dane_content_user__id').unbind();
$('#dane_content_user__id').bind('change', function() {
	tinyerp_user__id = this.value;
	if(tinyerp_user__id) {
		url='tinyerp-user.php?ajax=1&action=get&tinyerp_user__id='+tinyerp_user__id;
		$.ajax({
			url: url,
			dataType: 'json',
			success: function(data) {
				str  = '';
				str += data.content_user__firstname ? data.content_user__firstname : '';
				str += data.content_user__lastname ? ' '+data.content_user__lastname : '';
				$('#dane_tinyerp_invoice__issuername').val( str );
			},
			error: function(error) {
				alert('error='+error);
			},
		});
	}
});

</script>
<?	} ?>

					</form>
<?
}
?>

<? include "_page_footer5.php"; ?>
