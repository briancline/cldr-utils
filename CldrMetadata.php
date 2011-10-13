<?php

   class CldrMetadata {
      const Bar = '_';
      const PatternStrictLL = '/^[a-z]{2}$/';
      const PatternStrictRR = '/^([A-Z]{2}|[0-9]{3})$/';
      const PatternStrictLLRR = '/^[a-z]{2}_([A-Z]{2}|[0-9]{3})$/';
      const LoadStrictLLRR = true;
      
      public static $defaultLocales = array();
      public static $localeCodes = array();
      
      
      public static function loadDefaultLocalesFromXml(SimpleXmlElement $xml) {
         $defaultContent = XML::findSingle($xml, '/supplementalData/metadata/defaultContent');
         
         $defaultLocales = RX::splitDelimited($defaultContent['locales']);
         foreach ($defaultLocales as $localeCode) {
            if (self::isLocaleCodeExcluded($localeCode)) {
               continue;
            }
            
            self::$defaultLocales[] = $localeCode;
         }
         
         print_r(self::$defaultLocales);
      }
      
      public static function loadLanguageTerritoryAssignments(SimpleXmlElement $xml) {
         $languageResults = XML::findMulti($xml, '/supplementalData/languageData/language');
         foreach ($languageResults as $languageNode) {
            $languageCode = (string) $languageNode['type'];
            $scriptList = (string) $languageNode['scripts'];
            $territoryList = (string) $languageNode['territories'];
            $variantList = (string) $languageNode['variants'];
            $altList = (string) $languageNode['alt'];
            
            $territories = RX::splitDelimited($languageNode['territories']);
            
            foreach ($territories as $territoryCode) {
               $localeCode = 
                  $languageCode . self::Bar .
                  $territoryCode;
               
               $localeCode = trim($localeCode, '_');
               
               if (self::isLocaleCodeExcluded($localeCode)) {
                  continue;
               }
               
               if (!in_array($localeCode, self::$localeCodes)) {
                  self::$localeCodes[] = $localeCode;
               }
            }
         }
         
         print_r(self::$localeCodes);
      }
      
      public static function isLocaleCodeExcluded($localeCode) {
         return static::LoadStrictLLRR && !RX::match(self::PatternStrictLLRR, $localeCode);
      }
      public static function isLanguageCodeExcluded($languageCode) {
         return static::LoadStrictLLRR && !RX::match(self::PatternStrictLL, $languageCode);
      }
      public static function isRegionCodeExcluded($regionCode) {
         return static::LoadStrictLLRR && !RX::match(self::PatternStrictRR, $regionCode);
      }
   }

