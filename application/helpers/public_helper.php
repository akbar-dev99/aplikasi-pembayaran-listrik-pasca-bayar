<?php
function Rupiah($val)
{
  return "Rp " . number_format($val, 2, ",", ".");
}


function IsStrIncludes($match, $val)
{
  return strpos($match, $val);
}

function AdminFee($format = "number")
{

  if ($format === "rupiah") {
    return Rupiah(2000);
  } else {
    return 2500;
  }
}

function PrettyPrintArr($array = [])
{
  return "<pre>" . print_r($array, true) . "</pre>";
}
