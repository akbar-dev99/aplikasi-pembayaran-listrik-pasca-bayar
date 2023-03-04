<?php

/**
 * Helper GetAutoNumber
 *
 * @description Helper untuk generate auto number pada sebuah kolom tabel pada database
 *
 * @package     Helper
 * @subpackage  GetAutoNumber
 * @category    Helpers
 * @param string $table nama table
 * @param string $field
 * @param string $field
 * @param int $length
 * @param string $where
 * @return string
 */
function GetAutoNumber($table, $field, $pref, $length, $where = "")
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
