<?php

function get_auto_number($table, $field, $pref, $length, $where = "")
{
  $ci = &get_instance();

  $query = "SELECT IFNULL(MAX(CONVERT(MID($field," . (strlen($pref) + 1) . "," . ($length - strlen($pref)) . "),UNSIGNED INTEGER)),0)+1 AS NOMOR
                  FROM $table WHERE LEFT($field," . (strlen($pref)) . ")='$pref' $where";
  $result = $ci->db->query($query)->row();
  $zero = "";
  $num = $length - strlen($pref) - strlen($result->NOMOR);
  for ($i = 0; $i < $num; $i++) {
    $zero = $zero . "0";
  }
  return $pref . $zero . $result->NOMOR;
}
