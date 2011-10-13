<?php
   
   include('common.php');
   
   $xmlSuppData = simplexml_load_file(CLDR_SUPP .'/supplementalData.xml');
   $xmlSuppMetadata = simplexml_load_file(CLDR_SUPP .'/supplementalMetadata.xml');
   
   CldrMetadata::loadDefaultLocalesFromXml($xmlSuppMetadata);
   CldrMetadata::loadLanguageTerritoryAssignments($xmlSuppData);
   
   $localesToLoad = array('en', 'es', 'en_US', 'es_US', 'ja_JP');
   foreach ($localesToLoad as $loadName) {
      $localeXml = simplexml_load_file(CLDR_MAIN .'/'. $loadName .'.xml');
      $locales[] = new Locale($localeXml);
   }
   
   print_r($locales);
   
