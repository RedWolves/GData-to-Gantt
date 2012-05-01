<?php

  //ini_set("display_errors", 1);
  include_once "config.php";
  set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__));
  require_once 'Zend/Loader.php';

  Zend_Loader::loadClass('Zend_Gdata');
  Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
  Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');
  Zend_Loader::loadClass('Zend_Gdata_App_AuthException');
  Zend_Loader::loadClass('Zend_Http_Client');


  try {
     $client = Zend_Gdata_ClientLogin::getHttpClient($email, $passwd, 'wise');
  } catch (Zend_Gdata_App_CaptchaRequiredException $cre) {
      echo 'URL of CAPTCHA image: ' . $cre->getCaptchaUrl() . "\n";
      echo 'Token ID: ' . $cre->getCaptchaToken() . "\n";
  } catch (Zend_Gdata_App_AuthException $ae) {
     echo 'Problem authenticating: ' . $ae->exception() . "\n";
  }
   


  $spreadsheetService = new Zend_Gdata_Spreadsheets($client);
  $feed = $spreadsheetService->getSpreadsheetFeed();

  foreach ($feed->entries as $sheet) {
    $title = $sheet->title->text;
    $title_key = "[gantt]";
    if (substr_compare($title, $title_key, 0, strlen($title_key)) == 0) {
      echo "<a href='sheet.php?id=". get_key($sheet->id->text) . "'>" . substr($title, 8, strlen($title)) . "</a><br/>\n";
    }
  }

  function get_key( $url ){
    $url = explode('/', $url);
    return array_pop($url);
  }

?>