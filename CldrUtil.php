<?php

   class CldrUtil {
      public static function autoLoad($className) {
         require(ROOT .'/'. $className .'.php');
      }
   }

   class RX {
      public static function splitDelimited($input) {
         return self::split('/\s+/', $input, NULL, PREG_SPLIT_NO_EMPTY);
      }
      public static function split($pattern, $input, $flags = 0) {
         return preg_split($pattern, $input, NULL, $flags);
      }
      
      public static function match($pattern, $input) {
         return preg_match($pattern, $input);
      }
      
      public static function matchElements($pattern, $input, $bits) {
         return preg_match($pattern, $input, $bits);
      }
   }

   class XML {
      public static function findSingle(SimpleXmlElement $xml, $path) {
         $result = self::findMulti($xml, $path);
         if (!is_array($result) || count($result) == 0) {
            return NULL;
         }
         
         return $result[0];
      }
      
      public static function findMulti(SimpleXmlElement $xml, $path) {
         return $xml->xpath($path);
      }
   }

