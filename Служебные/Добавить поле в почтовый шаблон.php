<? /*В init.php*/?>
<? 
AddEventHandler('main', 'OnBeforeEventSend', Array("MyForm", "my_OnBeforeEventSend"));
    class MyForm
  {
      function my_OnBeforeEventSend(&$arFields, &$arTemplate)
      {
          $rsSites = CSite::GetByID(SITE_ID);
          $arSite = $rsSites->Fetch();
          $arFields['EMAIL_TO'] = $arSite['EMAIL'];
          $arFields['DEFAULT_EMAIL_FROM'] = COption::GetOptionString('main','email_from');
     }
  }
  ?>
