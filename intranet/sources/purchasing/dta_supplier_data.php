<?php
global $s, $inp, $par, $arrTitle, $arrParameter, $menuAccess, $sUser, $cUsername;
$par[dataIds] = preg_replace('/[^\da-z\,\'\~]/i', '', $par[dataIds]);
//$par[dataIds] = urldecode($par[dataIds]);
//echo $par[dataIds];
//die();
switch ($par[dataType]) {
  case "serviceList":
    header("Content-type: application/json");
    $sql = "SELECT * FROM dta_layanan_komponen WHERE CONCAT(idLayanan,'~',idKomponen) IN ($par[dataIds]) ORDER BY idLayanan, idKomponen";
    $res = db($sql);
    $ret = array();
    while ($r = mysql_fetch_assoc($res)) {
      $ret[] = $r;
    }
    echo json_encode($ret);
    break;
  case "dynaServiceList":
    header("Content-type: application/json");
    $sql = "SELECT * FROM dta_layanan_formula ORDER BY nomorFormula";
    $res = db($sql);
    $ret = array();
    while ($r = mysql_fetch_assoc($res)) {
      $ret[] = $r;
    }
    echo json_encode($ret);
    break;
  case "productList":
    header("Content-type: application/json");
    $sql = "SELECT t1.kodeProduk, t1.kodeKategori, t1.tipeKategori, t2.namaProduk, t1.namaKategori,
            t1.markupKategori hargaJual, t1.hppKategori
            FROM dta_produk_kategori t1
            JOIN dta_produk t2 ON t1.kodeProduk=t2.kodeProduk
            WHERE CONCAT(t1.kodeProduk,'~',t1.kodeKategori) IN ($par[dataIds]) 
            ORDER BY t1.kodeProduk, t1.kodeKategori ";
//    echo $sql;
    $res = db($sql);
    $ret = array();
    while ($r = mysql_fetch_assoc($res)) {
      $ret[] = $r;
    }
    echo json_encode($ret);
    break;
  case "hygieneProductList":
    header("Content-type: application/json");
    $sql = "
      	SELECT GROUP_CONCAT(CONCAT('''',t1.kodeProduk,'~',t1.kodeKategori,'''') SEPARATOR ',') result
        FROM dta_layanan_komponen_produk t1
        WHERE CONCAT(t1.idLayanan,'~',t1.idKomponen)='$par[dataIds]'
      ";
    $res = db($sql);
    $ret = array();
    while ($r = mysql_fetch_assoc($res)) {
      $ret[] = $r;
    }
    echo json_encode($ret);
    break;
  case "checkPnw":
    break;
  default:
    header("Content-type: application/json");
    break;
}