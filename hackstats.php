<?php
   $date = strtotime("Mar 28 21:04:02");

   $lines = file("/var/log/all.log");
   
   function filter($val, $key) {
      if (is_string($val)) {
         if ((preg_match("/".$key."/i", $val)) && (!preg_match("/hulk/i", $val)) ) {
            return true;
         } else {
            return false;
         }
      }
   }

   function filter_refuse($val) { return filter($val, 'refuse'); }
   function filter_fail($val) { return filter($val, 'fail'); }
   function filter_invalid($val) { return filter($val, 'invalid'); }
   
   $keys = array('refuse','fail','invalid');
   
   $out = array();
   $line = array();
   $counts = array();
   
   foreach ($keys as $idx=>$key) {
      $out[$key] = array();
      $line[$key] = array_filter($lines, "filter_" . $key);
      $counts[$key] = count($line[$key]);

      foreach ($line[$key] as $i=>$val) {
         if (preg_match("/(\d+\.\d+\.\d+\.\d+)/", $line[$key][$i], $matches)) {
            $ip = $matches[1];
         }
         $parts = preg_split("/\s+/", $line[$key][$i]);
         $day = strtotime($parts[0].' '.$parts[1]);
         $date = date("Y-m-d", $day);
         if (!array_key_exists($key, $out)) {
            $out[$key] = array();
         }

         if (!array_key_exists($date, $out[$key])) {
            $out[$key][$date] = 1;
         } else {
            $out[$key][$date]++;
         }
      }
   }

   $newout = array(array('Date', 'Refuse', 'Fail', 'Invalid'));

   foreach ($keys as $idx=>$key) {
      ksort($out[$key]);
   }

   foreach ($out['refuse'] as $idx=>$val) {
      $newout[] = array($idx, $out['refuse'][$idx], $out['fail'][$idx], $out['invalid'][$idx]);
   }

//   file_put_contents("/simple/hacks-latest.js", json_encode($newout));

   if ($newout) {
      header("Content-type: application/json");
      print json_encode($newout);
   }

?>
