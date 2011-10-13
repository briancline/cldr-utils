<?php

   class Locale {
      public $code;
      public $languageCode = NULL;
      public $territoryCode = NULL;
      public $localeDisplayPattern;
   
      public $languageNames = array();
      public $territoryNames = array();
   
   
      public function __construct($input = false) {
         if ($input instanceof SimpleXmlElement) {
            $this->loadFromXml($input);
         }
      }
      
      
      public function loadFromXml(SimpleXmlElement $root) {
         $identity = XML::findSingle($root, '/ldml/identity/language');
         $this->code = (string) $identity['type'];
         $this->languageCode = $this->code;
         $this->localeDisplayPattern = XML::findSingle($root, '/ldml/localeDisplayNames/localePattern');
         
         $bits = array();
         if (RX::matchElements('/^([^_]+)_(.*)$/', $this->languageCode, $bits)) {
            $this->languageCode = $bits[1];
            $this->territoryCode = $bits[2];
         }
         
         $languages = XML::findMulti($root, '/ldml/localeDisplayNames/languages/language');
         foreach ($languages as $languageNode) {
            $code = (string) $languageNode['type'];
            $name = (string) $languageNode;
            
            if (CldrMetadata::isLanguageCodeExcluded($code)) {
               continue;
            }
            
            $this->languageNames[$code] = $name;
         }
      
         $territories = XML::findMulti($root, '/ldml/localeDisplayNames/territories/territory');
         foreach ($territories as $territoryNode) {
            $code = (string) $territoryNode['type'];
            $name = (string) $territoryNode;
         
            if (CldrMetadata::isRegionCodeExcluded($code)) {
               continue;
            }
            
            $this->territoryNames[$code] = $name;
         }
      }
      
   }
