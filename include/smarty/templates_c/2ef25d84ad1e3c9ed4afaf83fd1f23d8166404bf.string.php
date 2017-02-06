<?php /* Smarty version Smarty-3.0.8, created on 2013-01-20 23:48:19
         compiled from "string:" */ ?>
<?php /*%%SmartyHeaderCode:1490450fc74334defe3-83320834%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ef25d84ad1e3c9ed4afaf83fd1f23d8166404bf' => 
    array (
      0 => 'string:',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1490450fc74334defe3-83320834',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
Na stronie <?php echo $_smarty_tpl->getVariable('template')->value['http_host'];?>
 zostało założone konto z adresu IP <?php echo $_smarty_tpl->getVariable('template')->value['remote_addr'];?>
.

Wprowadzone dane:
Imię: <?php echo $_smarty_tpl->getVariable('template')->value['firstname'];?>

Nazwisko: <?php echo $_smarty_tpl->getVariable('template')->value['lastname'];?>

Adres e-mail: <?php echo $_smarty_tpl->getVariable('template')->value['email'];?>


W celu potwierdzenia swojej rejestracji prosimy o kliknięcie na link poniżej lub skopiowanie go do pola adresu w przeglądarce.

<?php echo $_smarty_tpl->getVariable('template')->value['url'];?>
