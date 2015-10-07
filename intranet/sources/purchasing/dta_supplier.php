<?php
if(!isset($menuAccess[$s]["view"])) echo "<script>logout();</script>";

$fFile = "images/supplier/";
$dFile = "files/supplier/";

function cek(){
	global $inp,$par;
	if(getField("select nomorSupplier from dta_supplier where nomorSupplier='$inp[nomorSupplier]' and kodeSupplier!='$par[kodeSupplier]'"))
		return "sorry, account no. \" $inp[nomorSupplier] \" already exist";
}

function kota(){
	global $s,$id,$inp,$par,$arrParameter;				
	$data = arrayQuery("select concat(kodeData, '\t', namaData) from mst_data where statusData='t' and kodeInduk='$par[kodePropinsi]' and kodeCategory='".$arrParameter[16]."' order by namaData");		
	return implode("\n", $data);
}		

function hapusNote(){
	global $s,$inp,$par,$cUsername;		
	$sql="delete from dta_supplier_note where kodeSupplier='$par[kodeSupplier]' and kodeNote='$par[kodeNote]'";
	db($sql);
	echo "<script>window.location='?par[mode]=edit&tab=6".getPar($par,"mode,kodeNote")."';</script>";
}

function ubahNote(){
	global $s,$inp,$par,$cUsername;		

	repField();
	$sql="update dta_supplier_note set namaNote='$inp[namaNote]', keteranganNote='$inp[keteranganNote]', updateBy='$cUsername', updateTime='".date('Y-m-d H:i:s')."' where kodeSupplier='$par[kodeSupplier]' and kodeNote='$par[kodeNote]'";
	db($sql);
	echo "<script>window.parent.location='index.php?par[mode]=edit&tab=6".getPar($par,"mode,kodeNote")."';</script>";
}

function tambahNote(){
	global $s,$inp,$par,$cUsername;
	$kodeNote=getField("select kodeNote from dta_supplier_note where kodeSupplier='$par[kodeSupplier]' order by kodeNote desc limit 1")+1;			

	repField();
	$sql="insert into dta_supplier_note (kodeSupplier, kodeNote, namaNote, keteranganNote, createBy, createTime) values ('$par[kodeSupplier]', '$kodeNote', '$inp[namaNote]', '$inp[keteranganNote]', '$cUsername', '".date('Y-m-d H:i:s')."')";
	db($sql);		
	echo "<script>window.parent.location='index.php?par[mode]=edit&tab=6".getPar($par,"mode,kodeNote")."';</script>";
}

function hapusBank(){
	global $s,$inp,$par,$cUsername;		
	$sql="delete from dta_supplier_bank where kodeSupplier='$par[kodeSupplier]' and kodeBank='$par[kodeBank]'";
	db($sql);
	echo "<script>window.location='?par[mode]=edit&tab=5".getPar($par,"mode,kodeBank")."';</script>";
}

function ubahBank(){
	global $s,$inp,$par,$cUsername;		

	repField();
	$sql="update dta_supplier_bank set namaBank='$inp[namaBank]', rekeningBank='$inp[rekeningBank]', pemilikBank='$inp[pemilikBank]', updateBy='$cUsername', updateTime='".date('Y-m-d H:i:s')."' where kodeSupplier='$par[kodeSupplier]' and kodeBank='$par[kodeBank]'";
	db($sql);
	echo "<script>window.parent.location='index.php?par[mode]=edit&tab=5".getPar($par,"mode,kodeBank")."';</script>";
}

function tambahBank(){
	global $s,$inp,$par,$cUsername;
	$kodeBank=getField("select kodeBank from dta_supplier_bank where kodeSupplier='$par[kodeSupplier]' order by kodeBank desc limit 1")+1;			

	repField();
	$sql="insert into dta_supplier_bank (kodeSupplier, kodeBank, namaBank, rekeningBank, pemilikBank, createBy, createTime) values ('$par[kodeSupplier]', '$kodeBank', '$inp[namaBank]', '$inp[rekeningBank]', '$inp[pemilikBank]', '$cUsername', '".date('Y-m-d H:i:s')."')";
	db($sql);		
	echo "<script>window.parent.location='index.php?par[mode]=edit&tab=5".getPar($par,"mode,kodeBank")."';</script>";
}

function hapusContact(){
	global $s,$inp,$par,$cUsername;		
	$sql="delete from dta_supplier_contact where kodeSupplier='$par[kodeSupplier]' and kodeContact='$par[kodeContact]'";
	db($sql);
	echo "<script>window.location='?par[mode]=edit&tab=4".getPar($par,"mode,kodeContact")."';</script>";
}

function ubahContact(){
	global $s,$inp,$par,$cUsername;		

	repField();
	$sql="update dta_supplier_contact set namaContact='$inp[namaContact]', jabatanContact='$inp[jabatanContact]', emailContact='$inp[emailContact]', teleponContact='$inp[teleponContact]', kantorContact='$inp[kantorContact]', faxContact='$inp[faxContact]', keteranganContact='$inp[keteranganContact]', updateBy='$cUsername', updateTime='".date('Y-m-d H:i:s')."' where kodeSupplier='$par[kodeSupplier]' and kodeContact='$par[kodeContact]'";
	db($sql);
	echo "<script>window.parent.location='index.php?par[mode]=edit&tab=4".getPar($par,"mode,kodeContact")."';</script>";
}

function tambahContact(){
	global $s,$inp,$par,$cUsername;
	$kodeContact=getField("select kodeContact from dta_supplier_contact where kodeSupplier='$par[kodeSupplier]' order by kodeContact desc limit 1")+1;			

	repField();
	$sql="insert into dta_supplier_contact (kodeSupplier, kodeContact, namaContact, jabatanContact, emailContact, teleponContact, kantorContact, faxContact, keteranganContact, createBy, createTime) values ('$par[kodeSupplier]', '$kodeContact', '$inp[namaContact]', '$inp[jabatanContact]', '$inp[emailContact]', '$inp[teleponContact]', '$inp[kantorContact]', '$inp[faxContact]', '$inp[keteranganContact]', '$cUsername', '".date('Y-m-d H:i:s')."')";
	db($sql);		
	echo "<script>window.parent.location='index.php?par[mode]=edit&tab=4".getPar($par,"mode,kodeContact")."';</script>";
}				

function setProduk(){
	global $s,$id,$inp,$par,$arrParameter;						
	return getField("select concat(tipeKategori,' -- ',namaKategori) from dta_produk_kategori where kodeProduk='$par[kodeProduk]' and kodeKategori='$par[kodeKategori]'");
}

function hapusFProduct(){
	global $s,$inp,$par,$dFile,$cUsername;			

	$fileProduk = getField("select fileProduk from dta_supplier_produk where kodeSupplier='$par[kodeSupplier]' and kodeProduk='$par[kodeProduk]' and kodeKategori='$par[kodeKategori]'");
	if(file_exists($dFile.$fileProduk) and $fileProduk!="")unlink($dFile.$fileProduk);

	$sql="update dta_supplier_produk set fileProduk='' where kodeSupplier='$par[kodeSupplier]' and kodeProduk='$par[kodeProduk]' and kodeKategori='$par[kodeKategori]'";
	db($sql);		

	echo "<script>window.location='?par[mode]=editProduct".getPar($par,"mode")."';</script>";
}

function hapusProduct(){
	global $s,$inp,$par,$cUsername;		
	$sql="delete from dta_supplier_produk where kodeSupplier='$par[kodeSupplier]' and kodeProduk='$par[kodeProduk]' and kodeKategori='$par[kodeKategori]'";
	db($sql);
	echo "<script>window.location='?par[mode]=edit&tab=2".getPar($par,"mode,kodeProduk,kodeKategori")."';</script>";
}

function ubahProduct(){
	global $s,$inp,$par,$cUsername;		
	$fileProduk =uploadProduct($par[kodeSupplier], $inp[kodeProduk], $inp[kodeKategori]);

	repField();
	$sql="update dta_supplier_produk set kodeProduk='$inp[kodeProduk]', kodeKategori='$inp[kodeKategori]', keteranganProduk='$inp[keteranganProduk]', hargaProduk='".setAngka($inp[hargaProduk])."', fileProduk='$fileProduk', updateBy='$cUsername', updateTime='".date('Y-m-d H:i:s')."' where kodeSupplier='$par[kodeSupplier]' and kodeProduk='$par[kodeProduk]' and kodeKategori='$par[kodeKategori]'";
	db($sql);
	echo "<script>window.parent.location='index.php?par[mode]=edit&tab=2".getPar($par,"mode,kodeProduk,kodeKategori")."';</script>";
}

function tambahProduct(){
	global $s,$inp,$par,$cUsername;		
	$fileProduk =uploadProduct($par[kodeSupplier], $inp[kodeProduk], $inp[kodeKategori]);

	repField();
	$sql="insert into dta_supplier_produk (kodeSupplier, kodeProduk, kodeKategori, keteranganProduk, hargaProduk, fileProduk, createBy, createTime) values ('$par[kodeSupplier]', '$inp[kodeProduk]', '$inp[kodeKategori]', '$inp[keteranganProduk]', '".setAngka($inp[hargaProduk])."', '$fileProduk', '$cUsername', '".date('Y-m-d H:i:s')."')";
	db($sql);		
	echo "<script>window.parent.location='index.php?par[mode]=edit&tab=2".getPar($par,"mode,kodeProduk,kodeKategori")."';</script>";
}

function hapusAddress(){
	global $s,$inp,$par,$cUsername;		
	$sql="delete from dta_supplier_address where kodeSupplier='$par[kodeSupplier]' and kodeAddress='$par[kodeAddress]'";
	db($sql);
	echo "<script>window.location='?par[mode]=edit&tab=1".getPar($par,"mode,kodeAddress")."';</script>";
}

function ubahAddress(){
	global $s,$inp,$par,$cUsername;
	repField();

	$sql="update dta_supplier_address set kodePropinsi='$inp[kodePropinsi]', kodeKota='$inp[kodeKota]', kategoriAddress='$inp[kategoriAddress]', alamatAddress='$inp[alamatAddress]', teleponAddress='$inp[teleponAddress]', faxAddress='$inp[faxAddress]', latitudeAddress='$inp[latitudeAddress]', longitudeAddress='$inp[longitudeAddress]', keteranganAddress='$inp[keteranganAddress]', updateBy='$cUsername', updateTime='".date('Y-m-d H:i:s')."' where kodeSupplier='$par[kodeSupplier]' and kodeAddress='$par[kodeAddress]'";
	db($sql);
	echo "<script>window.parent.location='index.php?par[mode]=edit&tab=1".getPar($par,"mode,kodeAddress")."';</script>";
}

function tambahAddress(){
	global $s,$inp,$par,$cUsername;
	$kodeAddress=getField("select kodeAddress from dta_supplier_address where kodeSupplier='$par[kodeSupplier]' order by kodeAddress desc limit 1")+1;

	repField();

	$sql="insert into dta_supplier_address (kodeSupplier, kodeAddress, kodePropinsi, kodeKota, kategoriAddress, alamatAddress, teleponAddress, faxAddress, latitudeAddress, longitudeAddress, keteranganAddress, createBy, createTime) values ('$par[kodeSupplier]', '$kodeAddress', '$inp[kodePropinsi]', '$inp[kodeKota]', '$inp[kategoriAddress]', '$inp[alamatAddress]', '$inp[teleponAddress]', '$inp[faxAddress]', '$inp[latitudeAddress]', '$inp[longitudeAddress]', '$inp[keteranganAddress]', '$cUsername', '".date('Y-m-d H:i:s')."')";
	db($sql);		
	echo "<script>window.parent.location='index.php?par[mode]=edit&tab=1".getPar($par,"mode,kodeAddress")."';</script>";
}		

function uploadProduct(){
	global $s,$inp,$par,$dFile;		
	$fileUpload = $_FILES["fileProduk"]["tmp_name"];
	$fileUpload_name = $_FILES["fileProduk"]["name"];
	if(($fileUpload!="") and ($fileUpload!="none")){				
		fileUpload($fileUpload,$fileUpload_name,$dFile);			
		$fileProduk = "produk-".$par[kodeSupplier].".".$inp[kodeProduk].".".$inp[kodeKategori].".".getExtension($fileUpload_name);
		fileRename($dFile, $fileUpload_name, $fileProduk);
	}
	if(empty($fileProduk)) $fileProduk = getField("select fileProduk from dta_supplier_produk where kodeSupplier='$par[kodeSupplier]' and kodeProduk='$par[kodeProduk]' and kodeKategori='$par[kodeKategori]'");

	return $fileProduk;
}

function uploadProductNew($count, $productId, $kategoriId){
	global $s,$inp,$par,$dFile;		
	$fileUpload = $_FILES["dtlProdukFile_".$count]["tmp_name"];
	$fileUpload_name = $_FILES["dtlProdukFile_".$count]["name"];
	if(($fileUpload!="") and ($fileUpload!="none") and ($fileUpload != null)){		
		$fileProduk = getField("select fileProduk from dta_supplier_produk where kodeSupplier='$par[kodeSupplier]' and kodeProduk='$produkId' and kodeKategori='$kategoriId'");
		if(file_exists($dFile.$fileProduk) and $fileProduk!="")unlink($dFile.$fileProduk);					

		fileUpload($fileUpload,$fileUpload_name,$dFile);			
		$fileProduk = "produk-".$par[kodeSupplier].".".$productId.".".$kategoriId.".".getExtension($fileUpload_name);
		fileRename($dFile, $fileUpload_name, $fileProduk);
	}
	if(empty($fileProduk)) $fileProduk = getField("select fileProduk from dta_supplier_produk where kodeSupplier='$par[kodeSupplier]' and kodeProduk='$productId' and kodeKategori='$kategoriId'");

	return $fileProduk;
}

function uploadNpwp($kodeSupplier){
	global $s,$inp,$par,$dFile;		
	$fileUpload = $_FILES["npwpIdentity_file"]["tmp_name"];
	$fileUpload_name = $_FILES["npwpIdentity_file"]["name"];
	if(($fileUpload!="") and ($fileUpload!="none")){						
		fileUpload($fileUpload,$fileUpload_name,$dFile);			
		$npwpIdentity_file = "npwp-".$kodeSupplier.".".getExtension($fileUpload_name);
		fileRename($dFile, $fileUpload_name, $npwpIdentity_file);			
	}
	if(empty($npwpIdentity_file)) $npwpIdentity_file = getField("select npwpIdentity_file from dta_supplier_identity where kodeSupplier='$kodeSupplier'");

	return $npwpIdentity_file;
}

function uploadId($kodeSupplier){
	global $s,$inp,$par,$dFile;		
	$fileUpload = $_FILES["idIdentity_file"]["tmp_name"];
	$fileUpload_name = $_FILES["idIdentity_file"]["name"];
	if(($fileUpload!="") and ($fileUpload!="none")){						
		fileUpload($fileUpload,$fileUpload_name,$dFile);			
		$idIdentity_file = "id-".$kodeSupplier.".".getExtension($fileUpload_name);
		fileRename($dFile, $fileUpload_name, $idIdentity_file);			
	}
	if(empty($idIdentity_file)) $idIdentity_file = getField("select idIdentity_file from dta_supplier_identity where kodeSupplier='$kodeSupplier'");

	return $idIdentity_file;
}

function uploadTdp($kodeSupplier){
	global $s,$inp,$par,$dFile;		
	$fileUpload = $_FILES["tdpIdentity_file"]["tmp_name"];
	$fileUpload_name = $_FILES["tdpIdentity_file"]["name"];
	if(($fileUpload!="") and ($fileUpload!="none")){						
		fileUpload($fileUpload,$fileUpload_name,$dFile);			
		$tdpIdentity_file = "tdp-".$kodeSupplier.".".getExtension($fileUpload_name);
		fileRename($dFile, $fileUpload_name, $tdpIdentity_file);			
	}
	if(empty($tdpIdentity_file)) $tdpIdentity_file = getField("select tdpIdentity_file from dta_supplier_identity where kodeSupplier='$kodeSupplier'");

	return $tdpIdentity_file;
}

function uploadSiup($kodeSupplier){
	global $s,$inp,$par,$dFile;		
	$fileUpload = $_FILES["siupIdentity_file"]["tmp_name"];
	$fileUpload_name = $_FILES["siupIdentity_file"]["name"];
	if(($fileUpload!="") and ($fileUpload!="none")){						
		fileUpload($fileUpload,$fileUpload_name,$dFile);			
		$siupIdentity_file = "siup-".$kodeSupplier.".".getExtension($fileUpload_name);
		fileRename($dFile, $fileUpload_name, $siupIdentity_file);			
	}
	if(empty($siupIdentity_file)) $siupIdentity_file = getField("select siupIdentity_file from dta_supplier_identity where kodeSupplier='$kodeSupplier'");

	return $siupIdentity_file;
}

function uploadLogo($kodeSupplier){
	global $s,$inp,$par,$fFile;		
	$fileUpload = $_FILES["logoSupplier"]["tmp_name"];
	$fileUpload_name = $_FILES["logoSupplier"]["name"];
	if(($fileUpload!="") and ($fileUpload!="none")){						
		fileUpload($fileUpload,$fileUpload_name,$fFile);			
		$logoSupplier = "logo-".$kodeSupplier.".".getExtension($fileUpload_name);
		fileRename($fFile, $fileUpload_name, $logoSupplier);			
	}
	if(empty($logoSupplier)) $logoSupplier = getField("select logoSupplier from dta_supplier where kodeSupplier='$kodeSupplier'");

	return $logoSupplier;
}

function hapusNpwp(){
	global $s,$inp,$par,$dFile,$cUsername;			

	$npwpIdentity_file = getField("select npwpIdentity_file from dta_supplier_identity where kodeSupplier='$par[kodeSupplier]'");
	if(file_exists($dFile.$npwpIdentity_file) and $npwpIdentity_file!="")unlink($dFile.$npwpIdentity_file);

	$sql="update dta_supplier_identity set npwpIdentity_file='' where kodeSupplier='$par[kodeSupplier]'";
	db($sql);		

	echo "<script>window.location='?par[mode]=edit&tab=3".getPar($par,"mode")."';</script>";
}

function hapusId(){
	global $s,$inp,$par,$dFile,$cUsername;	

	$idIdentity_file = getField("select idIdentity_file from dta_supplier_identity where kodeSupplier='$par[kodeSupplier]'");
	if(file_exists($dFile.$idIdentity_file) and $idIdentity_file!="")unlink($dFile.$idIdentity_file);

	$sql="update dta_supplier_identity set idIdentity_file='' where kodeSupplier='$par[kodeSupplier]'";
	db($sql);		

	echo "<script>window.location='?par[mode]=edit&tab=3".getPar($par,"mode")."';</script>";
}

function hapusTdp(){
	global $s,$inp,$par,$dFile,$cUsername;	

	$tdpIdentity_file = getField("select tdpIdentity_file from dta_supplier_identity where kodeSupplier='$par[kodeSupplier]'");
	if(file_exists($dFile.$tdpIdentity_file) and $tdpIdentity_file!="")unlink($dFile.$tdpIdentity_file);

	$sql="update dta_supplier_identity set tdpIdentity_file='' where kodeSupplier='$par[kodeSupplier]'";
	db($sql);		

	echo "<script>window.location='?par[mode]=edit&tab=3".getPar($par,"mode")."';</script>";
}

function hapusSiup(){
	global $s,$inp,$par,$dFile,$cUsername;			

	$siupIdentity_file = getField("select siupIdentity_file from dta_supplier_identity where kodeSupplier='$par[kodeSupplier]'");
	if(file_exists($dFile.$siupIdentity_file) and $siupIdentity_file!="")unlink($dFile.$siupIdentity_file);

	$sql="update dta_supplier_identity set siupIdentity_file='' where kodeSupplier='$par[kodeSupplier]'";
	db($sql);		

	echo "<script>window.location='?par[mode]=edit&tab=3".getPar($par,"mode")."';</script>";
}

function hapusLogo(){
	global $s,$inp,$par,$fFile,$cUsername;			

	$logoSupplier = getField("select logoSupplier from dta_supplier where kodeSupplier='$par[kodeSupplier]'");
	if(file_exists($fFile.$logoSupplier) and $logoSupplier!="")unlink($fFile.$logoSupplier);

	$sql="update dta_supplier set logoSupplier='' where kodeSupplier='$par[kodeSupplier]'";
	db($sql);		

	echo "<script>window.location='?par[mode]=edit".getPar($par,"mode")."';</script>";
}

function hapus(){
	global $s,$inp,$par,$fFile,$dFile,$cUsername;			

	$logoSupplier = getField("select logoSupplier from dta_supplier where kodeSupplier='$par[kodeSupplier]'");
	if(file_exists($fFile.$logoSupplier) and $logoSupplier!="")unlink($fFile.$logoSupplier);

	$sql="select * from dta_supplier_identity where kodeSupplier='$par[kodeSupplier]'";
	$res=db($sql);
	$r=mysql_fetch_array($res);		
	if(file_exists($dFile.$r[siupIdentity_file]) and $r[siupIdentity_file]!="")unlink($dFile.$r[siupIdentity_file]);
	if(file_exists($dFile.$r[tdpIdentity_file]) and $r[tdpIdentity_file]!="")unlink($dFile.$r[tdpIdentity_file]);
	if(file_exists($dFile.$r[idIdentity_file]) and $r[idIdentity_file]!="")unlink($dFile.$r[idIdentity_file]);
	if(file_exists($dFile.$r[npwpIdentity_file]) and $r[npwpIdentity_file]!="")unlink($dFile.$r[npwpIdentity_file]);

	$sql="delete from dta_supplier where kodeSupplier='$par[kodeSupplier]'";
	db($sql);
	$sql="delete from dta_supplier_address where kodeSupplier='$par[kodeSupplier]'";
	db($sql);
	$sql="delete from dta_supplier_produk where kodeSupplier='$par[kodeSupplier]'";
	db($sql);
	$sql="delete from dta_supplier_identity where kodeSupplier='$par[kodeSupplier]'";
	db($sql);
	$sql="delete from dta_supplier_contact where kodeSupplier='$par[kodeSupplier]'";
	db($sql);
	$sql="delete from dta_supplier_bank where kodeSupplier='$par[kodeSupplier]'";
	db($sql);

	echo "<script>window.location='?".getPar($par,"mode,kodeSupplier")."';</script>";
}

function ubah($update=""){
	global $s,$inp,$par,$cUsername,$dFile;		
	$logoSupplier=uploadLogo($par[kodeSupplier]);		
	$siupIdentity_file=uploadSiup($par[kodeSupplier]);
	$tdpIdentity_file=uploadTdp($par[kodeSupplier]);
	$idIdentity_file=uploadId($par[kodeSupplier]);
	$npwpIdentity_file=uploadNpwp($par[kodeSupplier]);
	repField();

	$sql = "select * from dta_supplier_produk where kodeSupplier='$par[kodeSupplier]'";
	$res = db($sql);

	while($r=mysql_fetch_array($res)){
		$prods["$r[kodeSupplier]"]["$r[kodeProduk]"]["$r[kodeKategori]"] = $r[fileProduk];
	}

	$sql = "delete from dta_supplier_produk where kodeSupplier='$par[kodeSupplier]'";
	db($sql);

	$dtlProdukIds = $_POST["dtlProdukId"];
	$cm = 0;
	foreach ($dtlProdukIds as $dtlProdukId) {
		$dtlspKodeProduk = $_POST["dtlProdukKode"][$cm];
		$dtlspKodeKategori = $_POST["dtlProdukKategori"][$cm];
		$dtlProdukHrg = $_POST["dtlProdukHrg"][$cm];
		$dtlProdukKtr = $_POST["dtlProdukKtr"][$cm];

		$fileProduk = uploadProductNew($cm+1, $dtlspKodeProduk, $dtlspKodeKategori);
		$fileProduk = empty($fileProduk) ? $prods[$par[kodeSupplier]][$dtlspKodeProduk][$dtlspKodeKategori] : $fileProduk;

		$sql="insert into dta_supplier_produk (kodeSupplier, kodeProduk, kodeKategori, keteranganProduk, hargaProduk, fileProduk, createBy, createTime) values ('$par[kodeSupplier]', '$dtlspKodeProduk', '$dtlspKodeKategori', '$dtlProdukKtr', '".setAngka($dtlProdukHrg)."', '$fileProduk', '$cUsername', '".date('Y-m-d H:i:s')."')";
		db($sql);	

		$cm++;
	}
	$sql="update dta_supplier set kodePropinsi='$inp[kodePropinsi]', kodeKota='$inp[kodeKota]', nomorSupplier='$inp[nomorSupplier]', namaSupplier='$inp[namaSupplier]', aliasSupplier='$inp[aliasSupplier]', alamatSupplier='$inp[alamatSupplier]', teleponSupplier='$inp[teleponSupplier]', faxSupplier='$inp[faxSupplier]', emailSupplier='$inp[emailSupplier]', webSupplier='$inp[webSupplier]', logoSupplier='$logoSupplier', statusSupplier='$inp[statusSupplier]', updateBy='$cUsername', updateTime='".date('Y-m-d H:i:s')."' where kodeSupplier='$par[kodeSupplier]'";
	db($sql);						

		# dta_supplier_identity
	$sql=getField("select kodeIdentity from dta_supplier_identity where kodeSupplier='$par[kodeSupplier]'")?

	"update dta_supplier_identity set siupIdentity='$inp[siupIdentity]', siupIdentity_file='$siupIdentity_file', tdpIdentity='$inp[tdpIdentity]', tdpIdentity_file='$tdpIdentity_file', idIdentity='$inp[idIdentity]', idIdentity_file='$idIdentity_file', npwpIdentity='$inp[npwpIdentity]', npwpIdentity_file='$npwpIdentity_file', alamatIdentity='$inp[alamatIdentity]', updateBy='$cUsername', updateTime='".date('Y-m-d H:i:s')."' where kodeSupplier='$par[kodeSupplier]'":

	"insert into dta_supplier_identity (kodeSupplier, kodeIdentity, siupIdentity, siupIdentity_file, tdpIdentity, tdpIdentity_file, idIdentity, idIdentity_file, npwpIdentity, npwpIdentity_file, alamatIdentity, createBy, createTime) values ('$par[kodeSupplier]', '$par[kodeSupplier]', '$inp[siupIdentity]', '$siupIdentity_file', '$inp[tdpIdentity]', '$tdpIdentity_file', '$inp[idIdentity]', '$idIdentity_file', '$inp[npwpIdentity]', '$npwpIdentity_file', '$inp[alamatIdentity]', '$cUsername', '".date('Y-m-d H:i:s')."')";

	db($sql);

	if(empty($update)) echo "<script>window.location='?".getPar($par,"")."';</script>";
}

function tambah(){
	global $s,$inp,$par,$cUsername;		
	$kodeMenu = $s;
	$kodeSupplier=getField("select kodeSupplier from dta_supplier order by kodeSupplier desc limit 1")+1;
	$nomorSupplier="SPL".str_pad($kodeSupplier, 3, "0", STR_PAD_LEFT);
	$logoSupplier=uploadLogo($kodeSupplier);		
	repField();

	$sql="insert into dta_supplier (kodeSupplier, kodeMenu, kodePropinsi, kodeKota, nomorSupplier, namaSupplier, aliasSupplier, alamatSupplier, teleponSupplier, faxSupplier, emailSupplier, webSupplier, logoSupplier, statusSupplier, createBy, createTime) values ('$kodeSupplier', '$kodeMenu', '$inp[kodePropinsi]', '$inp[kodeKota]', '$nomorSupplier', '$inp[namaSupplier]','$inp[aliasSupplier]', '$inp[alamatSupplier]', '$inp[teleponSupplier]', '$inp[faxSupplier]', '$inp[emailSupplier]', '$inp[webSupplier]', '$logoSupplier', '$inp[statusSupplier]', '$cUsername', '".date('Y-m-d H:i:s')."')";
	db($sql);				

	$kodeIdentity = $kodeSupplier;
	$sql="insert into dta_supplier_identity (kodeSupplier, kodeIdentity, siupIdentity, tdpIdentity, idIdentity, npwpIdentity, alamatIdentity, createBy, createTime) values ('$kodeSupplier', '$kodeIdentity', '$inp[siupIdentity]', '$inp[tdpIdentity]', '$inp[idIdentity]', '$inp[npwpIdentity]', '$inp[alamatIdentity]', '$cUsername', '".date('Y-m-d H:i:s')."')";
	db($sql);

	$sql = "delete from dta_supplier_produk where kodeSupplier='$kodeSupplier'";
	db($sql);

	$dtlProdukIds = $_POST["dtlProdukId"];
	$cm = 0;
	foreach ($dtlProdukIds as $dtlProdukId) {
		$dtlspKodeProduk = $_POST["dtlProdukKode"][$cm];
		$dtlspKodeKategori = $_POST["dtlProdukKategori"][$cm];
		$dtlProdukHrg = $_POST["dtlProdukHrg"][$cm];
		$dtlProdukKtr = $_POST["dtlProdukKtr"][$cm];

		$fileProduk = uploadProductNew($cm, $dtlspKodeProduk, $dtlspKodeKategori);
		
		$sql="insert into dta_supplier_produk (kodeSupplier, kodeProduk, kodeKategori, keteranganProduk, hargaProduk, fileProduk, createBy, createTime) values ('$kodeSupplier', '$dtlspKodeProduk', '$dtlspKodeKategori', '$dtlProdukKtr', '".setAngka($dtlProdukHrg)."', '$fileProduk', '$cUsername', '".date('Y-m-d H:i:s')."')";
		db($sql);	
		$cm++;
	}

	echo "<script>window.location='?par[mode]=edit&par[kodeSupplier]=$kodeSupplier".getPar($par,"mode,kodeSupplier")."';</script>";
}

function formNote(){
	global $s,$inp,$par,$arrTitle,$arrParameter,$menuAccess;

	$sql="select * from dta_supplier_note where kodeSupplier='$par[kodeSupplier]' and kodeNote='$par[kodeNote]'";
	$res=db($sql);
	$r=mysql_fetch_array($res);											

	setValidation("is_null","inp[namaNote]","anda harus mengisi kategori");		
	setValidation("is_null","inp[keteranganNote]","anda harus mengisi catatan");		
	$text = getValidation();
	$text.="<div class=\"centercontent contentpopup\">
	<div class=\"pageheader\">
		<h1 class=\"pagetitle\">Note</h1>
		".getBread(ucwords(str_replace("Note","",$par[mode])." note"))."
	</div>
	<div id=\"contentwrapper\" class=\"contentwrapper\">
		<form id=\"form\" name=\"form\" method=\"post\" class=\"stdform\" action=\"?_submit=1".getPar($par)."\" onsubmit=\"return validation(document.form);\" enctype=\"multipart/form-data\">	
			<div id=\"general\" class=\"subcontent\">	
				<p>
					<label class=\"l-input-small\">Kategori</label>
					<div class=\"field\">
						<input type=\"text\" id=\"inp[namaNote]\" name=\"inp[namaNote]\"  size=\"50\" value=\"$r[namaNote]\" class=\"mediuminput\" style=\"width:350px;\" maxlength=\"150\"/>
					</div>	
				</p>
				<p>
					<label class=\"l-input-small\">Catatan</label>
					<div class=\"field\">
						<textarea id=\"inp[keteranganNote]\" name=\"inp[keteranganNote]\" rows=\"3\" cols=\"50\" class=\"longinput\" style=\"height:50px; width:350px;\">$r[keteranganNote]</textarea>
					</div>
				</p>
				<p>
					<input type=\"submit\" class=\"submit radius2\" name=\"btnSave\" value=\"Save\"/>
					<input type=\"button\" class=\"cancel radius2\" value=\"Cancel\" onclick=\"closeBox();\"/>
				</p>
			</div>
		</form>	
	</div>";		
	return $text;
}		

function formBank(){
	global $s,$inp,$par,$arrTitle,$arrParameter,$menuAccess;

	$sql="select * from dta_supplier_bank where kodeSupplier='$par[kodeSupplier]' and kodeBank='$par[kodeBank]'";
	$res=db($sql);
	$r=mysql_fetch_array($res);											

	setValidation("is_null","inp[namaBank]","anda harus mengisi bank name");		
	setValidation("is_null","inp[rekeningBank]","anda harus mengisi account no.");
	setValidation("is_null","inp[pemilikBank]","anda harus mengisi account name");
	$text = getValidation();
	$text.="<div class=\"centercontent contentpopup\">
	<div class=\"pageheader\">
		<h1 class=\"pagetitle\">Banking</h1>
		".getBread(ucwords(str_replace("Bank","",$par[mode])." banking"))."
	</div>
	<div id=\"contentwrapper\" class=\"contentwrapper\">
		<form id=\"form\" name=\"form\" method=\"post\" class=\"stdform\" action=\"?_submit=1".getPar($par)."\" onsubmit=\"return validation(document.form);\" enctype=\"multipart/form-data\">	
			<div id=\"general\" class=\"subcontent\">	
				<p>
					<label class=\"l-input-small\">Bank Name</label>
					<div class=\"field\">
						<input type=\"text\" id=\"inp[namaBank]\" name=\"inp[namaBank]\"  size=\"50\" value=\"$r[namaBank]\" class=\"mediuminput\" style=\"width:350px;\" maxlength=\"150\"/>
					</div>	
				</p>
				<p>
					<label class=\"l-input-small\">No Akun</label>
					<div class=\"field\">
						<input type=\"text\" id=\"inp[rekeningBank]\" name=\"inp[rekeningBank]\"  size=\"50\" value=\"$r[rekeningBank]\" class=\"mediuminput\" style=\"width:350px;\" maxlength=\"50\"/>
					</div>	
				</p>								
				<p>
					<label class=\"l-input-small\">Account Name</label>
					<div class=\"field\">
						<input type=\"text\" id=\"inp[pemilikBank]\" name=\"inp[pemilikBank]\"  size=\"50\" value=\"$r[pemilikBank]\" class=\"mediuminput\" style=\"width:350px;\" maxlength=\"150\"/>
					</div>	
				</p>
				<p>
					<input type=\"submit\" class=\"submit radius2\" name=\"btnSave\" value=\"Save\"/>
					<input type=\"button\" class=\"cancel radius2\" value=\"Cancel\" onclick=\"closeBox();\"/>
				</p>
			</div>
		</form>	
	</div>";		
	return $text;
}	

function formContact(){
	global $s,$inp,$par,$arrTitle,$arrParameter,$menuAccess;

	$sql="select * from dta_supplier_contact where kodeSupplier='$par[kodeSupplier]' and kodeContact='$par[kodeContact]'";
	$res=db($sql);
	$r=mysql_fetch_array($res);											

	setValidation("is_null","inp[jabatanContact]","anda harus mengisi jabatan");		
	setValidation("is_null","inp[namaContact]","anda harus mengisi nama");		
	$text = getValidation();
	$text.="<div class=\"centercontent contentpopup\">
	<div class=\"pageheader\">
		<h1 class=\"pagetitle\">Contact</h1>
		".getBread(ucwords(str_replace("Contact","",$par[mode])." contact"))."
	</div>
	<div id=\"contentwrapper\" class=\"contentwrapper\">
		<form id=\"form\" name=\"form\" method=\"post\" class=\"stdform\" action=\"?_submit=1".getPar($par)."\" onsubmit=\"return validation(document.form);\" enctype=\"multipart/form-data\">	
			<div id=\"general\" class=\"subcontent\">												
				<p>
					<label class=\"l-input-small\">Jabatan</label>
					<div class=\"field\">
						<input type=\"text\" id=\"inp[jabatanContact]\" name=\"inp[jabatanContact]\"  size=\"50\" value=\"$r[jabatanContact]\" class=\"mediuminput\" style=\"width:350px;\" maxlength=\"150\"/>
					</div>
				</p>
				<p>
					<label class=\"l-input-small\">Nama</label>
					<div class=\"field\">
						<input type=\"text\" id=\"inp[namaContact]\" name=\"inp[namaContact]\"  size=\"50\" value=\"$r[namaContact]\" class=\"mediuminput\" style=\"width:350px;\" maxlength=\"150\"/>
					</div>
				</p>
				<p>
					<label class=\"l-input-small\">Email</label>
					<div class=\"field\">
						<input type=\"text\" id=\"inp[emailContact]\" name=\"inp[emailContact]\"  value=\"$r[emailContact]\" class=\"mediuminput\" style=\"width:200px;\" maxlength=\"50\"/>
					</div>
				</p>
				<p>
					<label class=\"l-input-small\">Handphone</label>
					<div class=\"field\">
						<input type=\"text\" id=\"inp[teleponContact]\" name=\"inp[teleponContact]\"  value=\"$r[teleponContact]\" class=\"mediuminput\" style=\"width:200px;\" maxlength=\"50\" onkeyup=\"cekPhone(this);\"/>
					</div>
				</p>					
				<p>
					<label class=\"l-input-small\">Tlp. Kantor</label>
					<div class=\"field\">
						<input type=\"text\" id=\"inp[kantorContact]\" name=\"inp[kantorContact]\"  value=\"$r[kantorContact]\" class=\"mediuminput\" style=\"width:200px;\" maxlength=\"50\" onkeyup=\"cekPhone(this);\"/>
					</div>
				</p>
				<p>
					<label class=\"l-input-small\">Fax</label>
					<div class=\"field\">
						<input type=\"text\" id=\"inp[faxContact]\" name=\"inp[faxContact]\"  value=\"$r[faxContact]\" class=\"mediuminput\" style=\"width:200px;\" maxlength=\"50\" onkeyup=\"cekPhone(this);\"/>
					</div>
				</p>
				<p>
					<label class=\"l-input-small\">Keterangan</label>
					<div class=\"field\">
						<textarea id=\"inp[keteranganContact]\" name=\"inp[keteranganContact]\" rows=\"3\" cols=\"50\" class=\"longinput\" style=\"height:50px; width:350px;\">$r[keteranganContact]</textarea>
					</div>
				</p>
				<p>
					<input type=\"submit\" class=\"submit radius2\" name=\"btnSave\" value=\"Save\"/>
					<input type=\"button\" class=\"cancel radius2\" value=\"Cancel\" onclick=\"closeBox();\"/>
				</p>
			</div>
		</form>	
	</div>";		
	return $text;
}	

function formProduct(){
	global $s,$inp,$par,$arrTitle,$arrParameter,$menuAccess;

	$sql="select * from dta_supplier_produk where kodeSupplier='$par[kodeSupplier]' and kodeProduk='$par[kodeProduk]' and kodeKategori='$par[kodeKategori]'";
	$res=db($sql);
	$r=mysql_fetch_array($res);											

	setValidation("is_null","inp[kodeProduk]","anda harus mengisi kategori");		
	setValidation("is_null","inp[kodeKategori]","anda harus mengisi produk");		
	$text = getValidation();
	$text.="<div class=\"centercontent contentpopup\">
	<div class=\"pageheader\">
		<h1 class=\"pagetitle\">Produk</h1>
		".getBread(ucwords(str_replace("Product","",$par[mode])." product"))."
	</div>
	<div id=\"contentwrapper\" class=\"contentwrapper\">
		<form id=\"form\" name=\"form\" method=\"post\" class=\"stdform\" action=\"?_submit=1".getPar($par)."\" onsubmit=\"return validation(document.form);\" enctype=\"multipart/form-data\">	
			<div id=\"general\" class=\"subcontent\">										
				<p>
					<label class=\"l-input-small\">Kategori</label>
					<div class=\"field\">
						".comboData("select * from dta_produk where statusProduk='t' order by nomorProduk","kodeProduk","namaProduk","inp[kodeProduk]"," ",$r[kodeProduk],"onchange=\"getProduk();\"", "360px")."
					</div>
				</p>
				<p>
					<label class=\"l-input-small\">Produk</label>
					<div class=\"field\">
						<input type=\"hidden\" id=\"inp[kodeKategori]\" name=\"inp[kodeKategori]\"  size=\"50\" value=\"$r[kodeKategori]\" />
						<input type=\"text\" id=\"inp[namaKategori]\" name=\"inp[namaKategori]\"  size=\"50\" value=\"".getField("select concat(tipeKategori, ' -- ', namaKategori) from dta_produk_kategori where kodeProduk='$par[kodeProduk]' and kodeKategori='$par[kodeKategori]'")."\" class=\"mediuminput\" style=\"width:350px;\" readonly=\"readonly\" />
						<input type=\"button\" class=\"cancel radius2\" value=\"...\" onclick=\"openBox('popup.php?par[mode]=getProduk&par[kodeProduk]=' + document.getElementById('inp[kodeProduk]').value + '".getPar($par,"mode,kodeProduk,kodeKategori")."',800,425);\" />
					</div>
				</p>
				<p>
					<label class=\"l-input-small\">Keterangan</label>
					<div class=\"field\">
						<textarea id=\"inp[keteranganProduk]\" name=\"inp[keteranganProduk]\" rows=\"3\" cols=\"50\" class=\"longinput\" style=\"height:50px; width:350px;\">$r[keteranganProduk]</textarea>
					</div>
				</p>
				<p>
					<label class=\"l-input-small\">File</label>
					<div class=\"fieldB\">";
						$text.=empty($r[fileProduk])?
						"<input type=\"text\" id=\"tempProduk\" name=\"tempProduk\" class=\"input\" style=\"width:235px;\" maxlength=\"100\" />
						<div class=\"fakeupload\" style=\"width:300px;\">
							<input type=\"file\" id=\"fileProduk\" name=\"fileProduk\" class=\"realupload\" size=\"50\" onchange=\"this.form.tempProduk.value = this.value;\" />
						</div>":
						"<a href=\"download.php?d=supp&f=".$r[kodeSupplier].".".$r[kodeProduk].".".$r[kodeKategori]."\"><img src=\"".getIcon($dFile."/".$r[fileProduk])."\" align=\"left\" style=\"padding-right:5px; padding-bottom:5px; max-width:50px; max-height:50px;\"></a>
						<input type=\"file\" id=\"fileProduk\" name=\"fileProduk\" style=\"display:none;\" />
						<a href=\"?par[mode]=delFProduct".getPar($par,"mode")."\" onclick=\"return confirm('are you sure to delete this file?')\" class=\"action delete\"><span>Delete</span></a>
						<br clear=\"all\">";
						$text.="</div>
					</p>
					<p>
						<label class=\"l-input-small\">Harga</label>
						<div class=\"field\">						
							<input type=\"text\" id=\"inp[hargaProduk]\" name=\"inp[hargaProduk]\"  size=\"50\" value=\"".getAngka($r[hargaProduk])."\" class=\"mediuminput\" style=\"text-align:right; width:150px;\" onkeyup=\"cekAngka(this);\"/>
						</div>
					</p>
					<p>
						<input type=\"submit\" class=\"submit radius2\" name=\"btnSave\" value=\"Save\"/>
						<input type=\"button\" class=\"cancel radius2\" value=\"Cancel\" onclick=\"closeBox();\"/>
					</p>
				</div>
			</form>	
		</div>";		
		return $text;
	}	
	
	function formAddress(){
		global $s,$inp,$par,$arrTitle,$arrParameter,$menuAccess;
		
		$sql="select * from dta_supplier_address where kodeSupplier='$par[kodeSupplier]' and kodeAddress='$par[kodeAddress]'";
		$res=db($sql);
		$r=mysql_fetch_array($res);											
		
		if(empty($r[latitudeAddress])) $r[latitudeAddress] = "-6.264563";
		if(empty($r[longitudeAddress])) $r[longitudeAddress] = "106.766342";		
		
		setValidation("is_null","inp[alamatAddress]","anda harus mengisi alamat");				
		$text = getValidation();
		$text.="<script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?sensor=false\"></script>
		<div class=\"centercontent contentpopup\">
			<div class=\"pageheader\">
				<h1 class=\"pagetitle\">Alamat</h1>
				".getBread(ucwords(str_replace("Address","",$par[mode])." address"))."
				<ul class=\"hornav\">
					<li class=\"current\"><a href=\"#detail\" onclick=\"document.getElementById('dMap').style.visibility = 'collapse';\">Detail</a></li>
					<li><a href=\"#map\" onclick=\"document.getElementById('dMap').style.visibility = 'visible';\">Map</a></li>
				</ul>
			</div>
			<div id=\"contentwrapper\" class=\"contentwrapper\">
				<form id=\"form\" name=\"form\" method=\"post\" class=\"stdform\" action=\"?_submit=1".getPar($par)."\" onsubmit=\"return validation(document.form);\" enctype=\"multipart/form-data\">	
					<div id=\"detail\" class=\"subcontent\">									
						<p>
							<label class=\"l-input-small\">Kategori</label>
							<div class=\"field\">
								<input type=\"text\" id=\"inp[kategoriAddress]\" name=\"inp[kategoriAddress]\"  size=\"50\" value=\"$r[kategoriAddress]\" class=\"mediuminput\" style=\"width:350px;\" maxlength=\"150\"/>
							</div>	
						</p>								
						<p>
							<label class=\"l-input-small\">Alamat</label>
							<div class=\"field\">
								<textarea id=\"inp[alamatAddress]\" name=\"inp[alamatAddress]\" rows=\"3\" cols=\"50\" class=\"longinput\" style=\"height:50px; width:350px;\">$r[alamatAddress]</textarea>
							</div>
						</p>					
						<p>
							<label class=\"l-input-small\">Propinsi</label>
							<div class=\"field\">
								".comboData("select * from mst_data where statusData='t' and kodeCategory='".$arrParameter[15]."' order by namaData","kodeData","namaData","inp[kodePropinsi]"," ",$r[kodePropinsi],"onchange=\"getKota('".getPar($par,"mode,kodePropinsi")."');\"", "210px")."
							</div>
						</p>
						<p>
							<label class=\"l-input-small\">Kota</label>
							<div class=\"field\">
								".comboData("select * from mst_data where statusData='t' and kodeCategory='".$arrParameter[16]."' and kodeInduk='$r[kodePropinsi]' order by namaData","kodeData","namaData","inp[kodeKota]"," ",$r[kodeKota],"onchange=\"setGeocode('".getPar($par,"mode,kodeKota")."')\"", "210px")."
							</div>
						</p>
						<p>
							<label class=\"l-input-small\">Telepon</label>
							<div class=\"field\">
								<input type=\"text\" id=\"inp[teleponAddress]\" name=\"inp[teleponAddress]\"  value=\"$r[teleponAddress]\" class=\"mediuminput\" style=\"width:200px;\" maxlength=\"50\" onkeyup=\"cekPhone(this);\"/>
							</div>
						</p>
						<p>
							<label class=\"l-input-small\">Fax</label>
							<div class=\"field\">
								<input type=\"text\" id=\"inp[faxAddress]\" name=\"inp[faxAddress]\"  value=\"$r[faxAddress]\" class=\"mediuminput\" style=\"width:200px;\" maxlength=\"50\" onkeyup=\"cekPhone(this);\"/>
							</div>
						</p>
						<p>
							<label class=\"l-input-small\">Diskripsi</label>
							<div class=\"field\">
								<textarea id=\"inp[keteranganAddress]\" name=\"inp[keteranganAddress]\" rows=\"3\" cols=\"50\" class=\"longinput\" style=\"height:50px; width:350px;\">$r[keteranganAddress]</textarea>
							</div>
						</p>					
					</div>
					<div id=\"map\" class=\"subcontent\" style=\"display:none;\">					

					</div>								

					<table width=\"100%\" id=\"dMap\" style=\"visibility:collapse;\">
						<tr>
							<td>
								<p>
									<div id=\"mapCanvas\" style=\"width: 100%; height: 200px; border: 1px solid #a3a3a3; margin: 10px 0 5px 0px;\"></div>
									<div id=\"map_canvas\"></div>
									<div style=\"display:none\" id=\"markerStatus\"><i>Click and drag the marker</i></div>
									<div style=\"display:none\" id=\"info\"></div>
									<div style=\"display:none\" id=\"address\"></div>						
								</p>
								<p>
									<label>Latitude</label>
									<input type=\"text\" id=\"inp[latitudeAddress]\"  name=\"inp[latitudeAddress]\" class=\"smallinput\" value=\"$r[latitudeAddress]\" />
								</p>
								<p>
									<label>Longitude</label>
									<input type=\"text\" id=\"inp[longitudeAddress]\" name=\"inp[longitudeAddress]\" class=\"smallinput\" value=\"$r[longitudeAddress]\" />
								</p>
								<script>initialize();</script>
							</td>
						</tr>
					</table>

					<p>
						<input type=\"submit\" class=\"submit radius2\" name=\"btnSave\" value=\"Save\"/>
						<input type=\"button\" class=\"cancel radius2\" value=\"Cancel\" onclick=\"closeBox();\"/>
					</p>

				</div>
			</form>	
		</div>";		
		return $text;
	}
	
	function form(){
		global $s,$inp,$par,$tab,$arrTitle,$fFile,$dFile,$arrParameter,$menuAccess;
		
		$sql="select * from dta_supplier where kodeSupplier='$par[kodeSupplier]'";
		$res=db($sql);
		$r=mysql_fetch_array($res);					
		
		if(empty($r[kodeTipe])) $r[kodeTipe] = $par[kodeTipe];
		
		$false =  $r[statusSupplier] == "f" ? "checked=\"checked\"" : "";
		$true =  empty($false) ? "checked=\"checked\"" : "";
		
		setValidation("is_null","inp[nomorSupplier]","you must fill no. akun");
		setValidation("is_null","inp[namaSupplier]","you must fill nama supplier");
		setValidation("is_null","inp[alamatSupplier]","you must fill alamat");		
		$text = getValidation();
		
		$dAddress = " style=\"display: none;\"";
		$dProduct = " style=\"display: none;\"";
		$dIdentity = " style=\"display: none;\"";
		$dContact = " style=\"display: none;\"";
		$dBanking = " style=\"display: none;\"";
		$dNote = " style=\"display: none;\"";
		$dGeneral = " style=\"display: none;\"";
		
		if($tab == 1){
			$tAddress = "class=\"current\"";
			$dAddress = " style=\"display: block;\"";
		}else if($tab == 2){
			$tProduct = "class=\"current\"";
			$dProduct = " style=\"display: block;\"";
		}else if($tab == 3){
			$tIdentity = "class=\"current\"";
			$dIdentity = " style=\"display: block;\"";
		}else if($tab == 4){
			$tContact = "class=\"current\"";
			$dContact = " style=\"display: block;\"";
		}else if($tab == 5){
			$tBanking = "class=\"current\"";
			$dBanking = " style=\"display: block;\"";
		}else if($tab == 6){
			$tNote = "class=\"current\"";
			$dNote = " style=\"display: block;\"";
		}else{
			$tGeneral = "class=\"current\"";
			$dGeneral = " style=\"display: block;\"";
		}
		
		$mode = empty($r[nomorSupplier]) ? "add" : "edit";
		$text.="
		<script>
			jQuery(document).ready(function(){ jQuery(\".togglemenu\").click(); });
		</script>
		<div class=\"pageheader\">
			<h1 class=\"pagetitle\">".$arrTitle[$s]."</h1>
			".getBread(ucwords($mode." data"))."
			<ul class=\"hornav\">
				<li $tGeneral><a href=\"#general\">Umum</a></li>
				<li $tAddress><a href=\"#address\">Alamat</a></li>
				<li $tProduct><a href=\"#product\">Produk</a></li>
				<li $tIdentity><a href=\"#identity\">Identitas</a></li>
				<li $tContact><a href=\"#contact\">Kontak</a></li>
				<li $tBanking><a href=\"#banking\">Bank</a></li>
				<li $tNote><a href=\"#note\">Note</a></li>
			</ul>
		</div>
		<div id=\"contentwrapper\" class=\"contentwrapper\">
			<form id=\"form\" name=\"form\" method=\"post\" class=\"stdform\" action=\"?_submit=1".getPar($par)."\" onsubmit=\"return validation(document.form);\" enctype=\"multipart/form-data\">
				<div style=\"top:70px; right:35px; position:absolute\">
					<input type=\"submit\" class=\"submit radius2\" name=\"btnSave\" value=\"Save\" onclick=\"return chk('".getPar($par,"mode")."');\"/>
					<input type=\"button\" class=\"cancel radius2\" value=\"Cancel\" onclick=\"window.location='?".getPar($par,"mode, kodeSupplier")."';\"/>
				</div>";

				# TAB GENERAL
				$text.="<div id=\"general\" class=\"subcontent\" $dGeneral >					
				<p>
					<label class=\"l-input-small\">No Akun</label>
					<div class=\"fieldB\">
						<input type=\"text\" id=\"inp[nomorSupplier]\" name=\"inp[nomorSupplier]\"  value=\"$r[nomorSupplier]\" class=\"mediuminput\" style=\"width:150px;\" maxlength=\"30\"/>
					</div>
				</p>
				<p>
					<label class=\"l-input-small\">Nama Supplier</label>
					<div class=\"fieldB\">
						<input type=\"text\" id=\"inp[namaSupplier]\" name=\"inp[namaSupplier]\"  value=\"$r[namaSupplier]\" class=\"mediuminput\" style=\"width:400px;\" maxlength=\"150\"/>
					</div>
				</p>
				<p>
					<label class=\"l-input-small\">Alias</label>
					<div class=\"fieldB\">
						<input type=\"text\" id=\"inp[aliasSupplier]\" name=\"inp[aliasSupplier]\"  value=\"$r[aliasSupplier]\" class=\"mediuminput\" style=\"width:250px;\" maxlength=\"150\"/>
					</div>
				</p>
				<p>
					<label class=\"l-input-small\">Logo</label>
					<div class=\"fieldB\">";
						$text.=empty($r[logoSupplier])?
						"<input type=\"text\" id=\"fileTemp\" name=\"fileTemp\" class=\"input\" style=\"width:250px;\" maxlength=\"100\" />
						<div class=\"fakeupload\" style=\"width:300px;\">
							<input type=\"file\" id=\"logoSupplier\" name=\"logoSupplier\" class=\"realupload\" size=\"50\" onchange=\"this.form.fileTemp.value = this.value;\" />
						</div>":
						"<img src=\"".$fFile."/".$r[logoSupplier]."\" align=\"left\" style=\"padding-right:5px; padding-bottom:5px; max-width:50px; max-height:50px;\">
						<input type=\"file\" id=\"logoSupplier\" name=\"logoSupplier\" style=\"display:none;\" />
						<a href=\"?par[mode]=delLogo".getPar($par,"mode")."\" onclick=\"return confirm('are you sure to delete this logo?')\" class=\"action delete\"><span>Delete</span></a>
						<br clear=\"all\">";
						$text.="</div>
					</p>
					<p>
						<label class=\"l-input-small\">Alamat</label>
						<div class=\"fieldB\">
							<textarea id=\"inp[alamatSupplier]\" name=\"inp[alamatSupplier]\" rows=\"3\" cols=\"50\" class=\"longinput\" style=\"height:50px; width:400px;\">$r[alamatSupplier]</textarea>
						</div>
					</p>
					<table style=\"width:100%\">
						<tr>
							<td style=\"width:50%\">										
								<p>
									<label class=\"l-input-small2\">Propinsi</label>
									<div class=\"fieldA\">
										".comboData("select * from mst_data where statusData='t' and kodeCategory='".$arrParameter[15]."' order by namaData","kodeData","namaData","inp[kodePropinsi]"," ",$r[kodePropinsi],"onchange=\"getKota('".getPar($par,"mode,kodePropinsi")."');\"", "260px")."
									</div>
								</p>						
								<p>
									<label class=\"l-input-small2\">Telepon</label>
									<div class=\"fieldA\">
										<input type=\"text\" id=\"inp[teleponSupplier]\" name=\"inp[teleponSupplier]\"  value=\"$r[teleponSupplier]\" class=\"mediuminput\"  maxlength=\"50\" onkeyup=\"cekPhone(this);\"/>
									</div>
								</p>
								<p>
									<label class=\"l-input-small2\">Email</label>
									<div class=\"fieldA\">
										<input type=\"text\" id=\"inp[emailSupplier]\" name=\"inp[emailSupplier]\"  value=\"$r[emailSupplier]\" class=\"mediuminput\"  maxlength=\"50\"/>
									</div>
								</p>
								<p>
									<label class=\"l-input-small2\">Status</label>
									<div class=\"fieldA\" style='width:100%;'>											
										<input type=\"radio\" id=\"true\" name=\"inp[statusSupplier]\" value=\"t\" $true /> <span class=\"sradio\">Active</span>
										<input type=\"radio\" id=\"false\" name=\"inp[statusSupplier]\" value=\"f\" $false /> <span class=\"sradio\">Not Active</span>					
									</div>
								</p>
							</td>
							<td style=\"width:50%\">
								<p>
									<label class=\"l-input-small3\">Kota</label>
									<div class=\"fieldC\">
										".comboData("select * from mst_data where statusData='t' and kodeCategory='".$arrParameter[16]."' and kodeInduk='$r[kodePropinsi]' order by namaData","kodeData","namaData","inp[kodeKota]"," ",$r[kodeKota],"", "260px")."
									</div>
								</p>
								<p>
									<label class=\"l-input-small3\">Fax</label>
									<div class=\"fieldC\">
										<input type=\"text\" id=\"inp[faxSupplier]\" name=\"inp[faxSupplier]\"  value=\"$r[faxSupplier]\" class=\"mediuminput\"  maxlength=\"50\" onkeyup=\"cekPhone(this);\"/>
									</div>
								</p>							
								<p>
									<label class=\"l-input-small3\">Website</label>
									<div class=\"fieldC\">
										<input type=\"text\" id=\"inp[webSupplier]\" name=\"inp[webSupplier]\" value=\"$r[webSupplier]\" class=\"mediuminput\"  maxlength=\"50\"/>
									</div>
								</p>						
							</td>
						</tr>
					</table>																		
				</div>";

				# TAB ADDRESS
				$text.="<div id=\"address\" class=\"subcontent\" $dAddress >";
				if(isset($menuAccess[$s]["add"]))
					$text.="<a href=\"#Add\" class=\"btn btn1 btn_document\" onclick=\"update('".getPar($par,"mode")."'); openBox('popup.php?par[mode]=addAddress".getPar($par,"mode,kodeAddress")."',825,550);\" style=\"float:right; margin-bottom:10px;\"><span>Add Alamat</span></a>";
				$text.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"stdtable stdtablequick\">
				<thead>
					<tr>
						<th width=\"20\">No.</th>
						<th width=\"200\">Kategori</th>	
						<th>Alamat</th>
						<th width=\"200\">Kota</th>	
						<th width=\"150\">Telepon</th>";
						if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"])) $text.="<th width=\"50\">Kontrol</th>";
						$text.="</tr>
					</thead>
					<tbody>";								

						$sql="select * from dta_supplier_address t1 join mst_data t2 on (t1.kodeKota=t2.kodeData) where t1.kodeSupplier='$par[kodeSupplier]' order by t1.kodeAddress";
						$res=db($sql);
						$no=1;
						while($r=mysql_fetch_array($res)){
							$text.="<tr>
							<td>$no.</td>
							<td>$r[kategoriAddress]</td>
							<td>$r[alamatAddress]</td>
							<td>$r[namaData]</td>
							<td>$r[teleponAddress]</td>";
							if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"])){
								$text.="<td align=\"center\">";				
								if(isset($menuAccess[$s]["edit"])) $text.="<a href=\"#Edit\" title=\"Edit Data\" class=\"edit\"  onclick=\"update('".getPar($par,"mode")."'); openBox('popup.php?par[mode]=editAddress&par[kodeAddress]=$r[kodeAddress]".getPar($par,"mode,kodeAddress")."',825,550);\"><span>Edit</span></a>";
								if(isset($menuAccess[$s]["delete"])) $text.="<a href=\"?par[mode]=delAddress&par[kodeAddress]=$r[kodeAddress]".getPar($par,"mode,kodeAddress")."\" onclick=\"update('".getPar($par,"mode")."'); return confirm('anda yakin akan menghapus data ini ?');\" title=\"Delete Data\" class=\"delete\"><span>Delete</span></a>";
								$text.="</td>";
							}
							$text.="</tr>";
							$no++;
						}

						if($no == 1){
							$text.="<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>";				
							if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"]))
								$text.="<td>&nbsp;</td>";
							$text.="</tr>";
						}

						$text.="</tbody>
					</table>
				</div>";

				# TAB PRODUCT				
				$text.="
				<div id=\"product\" class=\"subcontent\" $dProduct >";					
					if(isset($menuAccess[$s]["add"]))
						$text.="
					<input type=\"button\" class=\"add\" id=\"btnAddProduct\" value=\"Tambah Produk\" style=\"float:right; margin-top: -20px;\"/>";
					$text.="
					<br class=\"all\">
					<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"stdtable stdtablequick\" id=\"dtProduct\">
						<thead>
							<tr>
								<th style=\"width: 20px;\">NO</th>
								<th style=\"width: 50px;\">TIPE</th>
								<th>PRODUK</th>
								<th>KETERANGAN</th>
								<th>FILE</th>
								<th style=\"width: 50px;\">Harga</th>
								<th style=\"width: 80px;\">KONTROL</th>
							</thead>
							<tbody>";

								$sql="select t1.*, t3.namaProduk, t2.namaKategori, t2.tipeKategori from dta_supplier_produk t1 join dta_produk_kategori t2 on (t1.kodeProduk=t2.kodeProduk and t1.kodeKategori=t2.kodeKategori) JOIN dta_produk t3 ON t3.kodeProduk = t2.kodeProduk where t1.kodeSupplier='$par[kodeSupplier]' order by t1.kodeProduk, t1.kodeKategori";
								$res=db($sql);
								$kodeProdukS = -99;
								$namaProdukS = "";
								$subTotalS = 0;
								$no = 1;
								$ctd = 1;
								$totalProdukQty = 0;
								$totalProduk = 0;
								$totalHppProduk = 0;
								while($r=mysql_fetch_array($res)){
									if ($kodeProdukS != $r[kodeProduk]) {
										$kodeProdukS = $r[kodeProduk];
										$namaProdukS = $r[namaProduk];
										$no = 1;
										$subTotalS = 0;
                //HEADER
										$text.="<tr class='trProdukHeader'><td colspan='7' style='font-weight:bolder'>" . $namaProdukS . "</td></tr>";
									}
									$tmplRow = "<tr id='trProduct_" . $ctd . "'>";
									$tmplRow .= "<input type='hidden' id='dtlProdukArray_" . $ctd . "' value='" . $r[kodeProduk] . "~" . $ctd . "~" . $r[namaProduk] . "~" . $r[namaKategori] . "' />";
									$tmplRow .= "<input type='hidden' id='dtlProdukId_" . $ctd . "' name='dtlProdukId[]' value='" . $ctd . "'  />";
									$tmplRow .= "<input type='hidden' id='dtlProdukKodeProduk_" . $ctd . "' name='dtlProdukKode[]' value='" . $r[kodeProduk] . "'  />";
									$tmplRow .= "<input type='hidden' id='dtlProdukKodeKategori_" . $ctd . "' name='dtlProdukKategori[]' value='" . $r[kodeKategori] . "'  />";
									$tmplRow .= "<input type='hidden' id='dtlProdukTipeKategori_" . $ctd . "' name='dtlProdukTipeKategori[]' value='" . $r[tipeKategori] . "'  />";
									$tmplRow .= "<input type='hidden' class='mnumdp' id='dtlProdukHargaDasar_" . $ctd . "' name='dtlProdukHargaDasar[]' value='" . $r[dasarDetail] . "'  />";
//                $tmplRow .= "<input type='hidden' class='mnumdp' id='dtlProdukDepresiasi_" . $ctd . "' name='dtlProdukDepresiasi[]' value='$r[depresiasiDetail]'  />";
									$tmplRow .= "<input type='hidden' id='dtlProdukNamaProduk_" . $ctd . "' name='dtlProdukNamaProduk[]' value='" . $r[namaProduk] . "'  />";
									$tmplRow .= "<td style='width: 20px;'>" . $no . "</td>";
									$tmplRow .= "<td>" . $r[tipeKategori] . "</td>";
									$tmplRow .= "<td>" . $r[namaKategori] . "</td>";
									$tmplRow .= "<td style='width: 200px;'><input type='text' style='width:200px;' id='dtlProdukKtr_" . $ctd . "' name='dtlProdukKtr[]' value='$r[keteranganProduk]'/></td>";
									if (empty($r[fileProduk])) {
										$tmplRow .= "
										<td style='width: 200px;'>
											<input type=\"text\" id=\"fileTemp_".$ctd."\" name=\"fileTemp_".$ctd."\" class=\"input\" style=\"width:150px;\" maxlength=\"100\" />
											<div class=\"fakeupload\" style=\"width: 195px\">
												<input type=\"file\" id=\"dtlProdukFile_".$ctd."\" name=\"dtlProdukFile_".$ctd."\" class=\"realupload\" style=\"width: 200px\" size=\"50\" onchange=\"this.form.fileTemp_".$ctd.".value = this.value;\" multiple=\"multiple\" />
											</div>
										</td>";
									}else{
										$tmplRow.="
										<td style='width: 200px; vertical-align: middle' align=\"center\">
											<a href=\"download.php?d=supp&f=".$r[kodeSupplier].".".$r[kodeProduk].".".$r[kodeKategori] . "\" title=\"Download File\"><img src=\"" . getIcon($r[fileProduk]) . "\"></a>
										</td>";
									}
									$tmplRow .= "<td style='width: 90px;'><input type='text' class='mnumdp' style='text-align:right;width:90px;' id='dtlProdukHrg_" . $ctd . "' name='dtlProdukHrg[]' value='".getAngka($r[hargaProduk], 2)."'/></td>";
									$tmplRow .= "<td style='width: 60px;text-align:center;'>";
									$tmplRow .= "<a class='delete delRow' href='#deProduk' title='Hapus Data' onclick=\"if(confirm('Are you sure to delete this data ?')) { jQuery(this).parent().parent().remove(); }\"><span>Remove</span></a>";
									$tmplRow .= "</td>";
									$tmplRow .= "</tr>";
									$text.=$tmplRow;
									$ctd++;
									$no++;
									$subTotalS+=$r[qtyProduk];
									$totalProdukQty+=$r[qtyProduk];
								}
								$text.="
							</tbody>
						</table>
						<input type=\"hidden\" id=\"getPar\" value=\"".getPar($par, "mode,kodeSupplier")."\">
					</div>";

  # TAB IDENTITY
					$sql="select * from dta_supplier_identity where kodeSupplier='$par[kodeSupplier]'";
					$res=db($sql);
					$r=mysql_fetch_array($res);

					$text.="<div id=\"identity\" class=\"subcontent\" $dIdentity >
					<table width=\"100%\">
						<tr>
							<td width=\"50%\" nowrap=\"nowrap\" style=\"vertical-align:top\">
								<p>
									<label class=\"l-input-small\">SIUP</label>
									<div class=\"field\">
										<input type=\"text\" id=\"inp[siupIdentity]\" name=\"inp[siupIdentity]\"  value=\"$r[siupIdentity]\" class=\"mediuminput\" style=\"width:250px;\" maxlength=\"50\"/>
									</div>
								</p>
								<p>
									<label class=\"l-input-small\">TDP</label>
									<div class=\"field\">
										<input type=\"text\" id=\"inp[tdpIdentity]\" name=\"inp[tdpIdentity]\"  value=\"$r[tdpIdentity]\" class=\"mediuminput\" style=\"width:250px;\" maxlength=\"50\"/>
									</div>
								</p>
								<p>
									<label class=\"l-input-small\">ID</label>
									<div class=\"field\">
										<input type=\"text\" id=\"inp[idIdentity]\" name=\"inp[idIdentity]\"  value=\"$r[idIdentity]\" class=\"mediuminput\" style=\"width:250px;\" maxlength=\"50\"/>
									</div>
								</p>
								<p>
									<label class=\"l-input-small\">NPWP</label>
									<div class=\"field\">
										<input type=\"text\" id=\"inp[npwpIdentity]\" name=\"inp[npwpIdentity]\"  value=\"$r[npwpIdentity]\" class=\"mediuminput\" style=\"width:250px;\" maxlength=\"50\"/>
									</div>
								</p>
								<p>
									<label class=\"l-input-small\">Alamat</label>
									<div class=\"field\">
										<textarea id=\"inp[alamatIdentity]\" name=\"inp[alamatIdentity]\" rows=\"3\" cols=\"50\" class=\"longinput\" style=\"height:50px; width:400px;\">$r[alamatIdentity]</textarea>
									</div>
								</p>
							</td>
							<td width=\"50%\" nowrap=\"nowrap\" style=\"vertical-align:top\">
								<p>
									<label class=\"l-input-small\">File</label>
									<div class=\"fieldB\">";
										$text.=empty($r[siupIdentity_file])?
										"<input type=\"text\" id=\"fileTemp_siup\" name=\"fileTemp_siup\" class=\"input\" style=\"width:235px;\" maxlength=\"100\" />
										<div class=\"fakeupload\" style=\"width:300px;\">
											<input type=\"file\" id=\"siupIdentity_file\" name=\"siupIdentity_file\" class=\"realupload\" size=\"50\" onchange=\"this.form.fileTemp_siup.value = this.value;\" />
										</div>":
										"<a href=\"download.php?d=sup&f=siup.$r[kodeSupplier]\"><img src=\"".getIcon($dFile."/".$r[siupIdentity_file])."\" align=\"left\" style=\"padding-right:5px; padding-bottom:5px; max-width:50px; max-height:50px;\"></a>
										<input type=\"file\" id=\"siupIdentity_file\" name=\"siupIdentity_file\" style=\"display:none;\" />
										<a href=\"?par[mode]=delSiup".getPar($par,"mode")."\" onclick=\"return confirm('are you sure to delete this file?')\" class=\"action delete\"><span>Delete</span></a>
										<br clear=\"all\">";
										$text.="</div>
									</p>
									<p>
										<label class=\"l-input-small\">File</label>
										<div class=\"fieldB\">";
											$text.=empty($r[tdpIdentity_file])?
											"<input type=\"text\" id=\"fileTemp_tdp\" name=\"fileTemp_tdp\" class=\"input\" style=\"width:235px;\" maxlength=\"100\" />
											<div class=\"fakeupload\" style=\"width:300px;\">
												<input type=\"file\" id=\"tdpIdentity_file\" name=\"tdpIdentity_file\" class=\"realupload\" size=\"50\" onchange=\"this.form.fileTemp_tdp.value = this.value;\" />
											</div>":
											"<a href=\"download.php?d=sup&f=tdp.$r[kodeSupplier]\"><img src=\"".getIcon($dFile."/".$r[tdpIdentity_file])."\" align=\"left\" style=\"padding-right:5px; padding-bottom:5px; max-width:50px; max-height:50px;\"></a>
											<input type=\"file\" id=\"tdpIdentity_file\" name=\"tdpIdentity_file\" style=\"display:none;\" />
											<a href=\"?par[mode]=delTdp".getPar($par,"mode")."\" onclick=\"return confirm('are you sure to delete this file?')\" class=\"action delete\"><span>Delete</span></a>
											<br clear=\"all\">";
											$text.="</div>
										</p>
										<p>
											<label class=\"l-input-small\">File</label>
											<div class=\"fieldB\">";
												$text.=empty($r[idIdentity_file])?
												"<input type=\"text\" id=\"fileTemp_id\" name=\"fileTemp_id\" class=\"input\" style=\"width:235px;\" maxlength=\"100\" />
												<div class=\"fakeupload\" style=\"width:300px;\">
													<input type=\"file\" id=\"idIdentity_file\" name=\"idIdentity_file\" class=\"realupload\" size=\"50\" onchange=\"this.form.fileTemp_id.value = this.value;\" />
												</div>":
												"<a href=\"download.php?d=sup&f=id.$r[kodeSupplier]\"><img src=\"".getIcon($dFile."/".$r[idIdentity_file])."\" align=\"left\" style=\"padding-right:5px; padding-bottom:5px; max-width:50px; max-height:50px;\"></a>
												<input type=\"file\" id=\"idIdentity_file\" name=\"idIdentity_file\" style=\"display:none;\" />
												<a href=\"?par[mode]=delId".getPar($par,"mode")."\" onclick=\"return confirm('are you sure to delete this file?')\" class=\"action delete\"><span>Delete</span></a>
												<br clear=\"all\">";
												$text.="</div>
											</p>
											<p>
												<label class=\"l-input-small\">File</label>
												<div class=\"fieldB\">";
													$text.=empty($r[npwpIdentity_file])?
													"<input type=\"text\" id=\"fileTemp_npwp\" name=\"fileTemp_npwp\" class=\"input\" style=\"width:235px;\" maxlength=\"100\" />
													<div class=\"fakeupload\" style=\"width:300px;\">
														<input type=\"file\" id=\"npwpIdentity_file\" name=\"npwpIdentity_file\" class=\"realupload\" size=\"50\" onchange=\"this.form.fileTemp_npwp.value = this.value;\" />
													</div>":
													"<a href=\"download.php?d=sup&f=npwp.$r[kodeSupplier]\"><img src=\"".getIcon($dFile."/".$r[npwpIdentity_file])."\" align=\"left\" style=\"padding-right:5px; padding-bottom:5px; max-width:50px; max-height:50px;\"></a>
													<input type=\"file\" id=\"npwpIdentity_file\" name=\"npwpIdentity_file\" style=\"display:none;\" />
													<a href=\"?par[mode]=delNpwp".getPar($par,"mode")."\" onclick=\"return confirm('are you sure to delete this file?')\" class=\"action delete\"><span>Delete</span></a>
													<br clear=\"all\">";
													$text.="</div>
												</p>
											</td>
										</tr>
									</table>
								</div>";

  			# TAB CONTACT
								$text.="<div id=\"contact\" class=\"subcontent\" $dContact >";
								if(isset($menuAccess[$s]["add"]))
									$text.="<a href=\"#Add\" class=\"btn btn1 btn_document\" onclick=\"update('".getPar($par,"mode")."'); openBox('popup.php?par[mode]=addContact".getPar($par,"mode,kodeCatatan")."',725,500);\" style=\"float:right; margin-bottom:10px;\"><span>Add Kontak</span></a>";
								$text.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"stdtable stdtablequick\">
								<thead>
									<tr>
										<th width=\"20\">No.</th>
										<th style=\"min-width:175px;\">Jabatan</th>
										<th style=\"min-width:175px;\">Nama</th>
										<th width=\"150\">Email</th>
										<th width=\"100\">Handphone</th>
										<th width=\"100\">Tlp. Kantor</th>";
										if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"])) $text.="<th width=\"50\">Kontrol</th>";
										$text.="</tr>
									</thead>
									<tbody>";				

										$sql="select * from dta_supplier_contact where kodeSupplier='$par[kodeSupplier]' order by kodeContact";
										$res=db($sql);
										$no=1;
										while($r=mysql_fetch_array($res)){
											$text.="<tr>
											<td>$no.</td>
											<td>$r[jabatanContact]</td>
											<td>$r[namaContact]</td>
											<td>$r[emailContact]</td>
											<td>$r[teleponContact]</td>
											<td>$r[kantorContact]</td>";
											if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"])){
												$text.="<td align=\"center\">";				
												if(isset($menuAccess[$s]["edit"])) $text.="<a href=\"#Edit\" title=\"Edit Data\" class=\"edit\" onclick=\"update('".getPar($par,"mode")."'); openBox('popup.php?par[mode]=editContact&par[kodeContact]=$r[kodeContact]".getPar($par,"mode,kodeContact")."',725,500);\"><span>Edit</span></a>";
												if(isset($menuAccess[$s]["delete"])) $text.="<a href=\"?par[mode]=delContact&par[kodeContact]=$r[kodeContact]".getPar($par,"mode,kodeContact")."\" onclick=\"update('".getPar($par,"mode")."'); return confirm('anda yakin akan menghapus data ini ?');\" title=\"Delete Data\" class=\"delete\"><span>Delete</span></a>";
												$text.="</td>";
											}
											$text.="</tr>";
											$no++;
										}	

										if($no == 1){
											$text.="<tr>
											<td>&nbsp;</td>								
											<td>&nbsp;</td>
											<td>&nbsp;</td>								
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>";			
											if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"]))
												$text.="<td>&nbsp;</td>";
											$text.="</tr>";
										}

										$text.="</tbody>
									</table>
								</div>";

  # TAB BANKING
								$text.="<div id=\"banking\" class=\"subcontent\" $dBanking >";
								if(isset($menuAccess[$s]["add"]))
									$text.="<a href=\"#Add\" class=\"btn btn1 btn_document\" onclick=\"update('".getPar($par,"mode")."'); openBox('popup.php?par[mode]=addBank".getPar($par,"mode,kodeBank")."',725,300);\" style=\"float:right; margin-bottom:10px;\"><span>Add Bank</span></a>";
								$text.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"stdtable stdtablequick\">
								<thead>
									<tr>
										<th width=\"20\">No.</th>
										<th>Nama Bank</th>
										<th width=\"150\">No Akun</th>							
										<th>Nama Akun</th>";
										if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"])) $text.="<th width=\"50\">Kontrol</th>";
										$text.="</tr>
									</thead>
									<tbody>";			

										$sql="select * from dta_supplier_bank where kodeSupplier='$par[kodeSupplier]' order by kodeBank";
										$res=db($sql);
										$no=1;
										while($r=mysql_fetch_array($res)){
											$text.="<tr>
											<td>$no.</td>
											<td>$r[namaBank]</td>
											<td>$r[rekeningBank]</td>
											<td>$r[pemilikBank]</td>";
											if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"])){
												$text.="<td align=\"center\">";				
												if(isset($menuAccess[$s]["edit"])) $text.="<a href=\"#Edit\" title=\"Edit Data\" class=\"edit\"  onclick=\"update('".getPar($par,"mode")."'); openBox('popup.php?par[mode]=editBank&par[kodeBank]=$r[kodeBank]".getPar($par,"mode,kodeBank")."',725,300);\"><span>Edit</span></a>";
												if(isset($menuAccess[$s]["delete"])) $text.="<a href=\"?par[mode]=delBank&par[kodeBank]=$r[kodeBank]".getPar($par,"mode,kodeBank")."\" onclick=\"update('".getPar($par,"mode")."'); return confirm('anda yakin akan menghapus data ini ?');\" title=\"Delete Data\" class=\"delete\"><span>Delete</span></a>";
												$text.="</td>";
											}
											$text.="</tr>";
											$no++;
										}

										if($no == 1){
											$text.="<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>";			
											if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"]))
												$text.="<td>&nbsp;</td>";
											$text.="</tr>";
										}

										$text.="</tbody>
									</table>
								</div>";

# TAB NOTE
								$text.="<div id=\"note\" class=\"subcontent\" $dNote >";
								if(isset($menuAccess[$s]["add"]))
									$text.="<a href=\"#Add\" class=\"btn btn1 btn_document\" onclick=\"update('".getPar($par,"mode")."'); openBox('popup.php?par[mode]=addNote".getPar($par,"mode,kodeNote")."',725,300);\" style=\"float:right; margin-bottom:10px;\"><span>Add Note</span></a>";
								$text.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"stdtable stdtablequick\">
								<thead>
									<tr>
										<th width=\"20\">No.</th>
										<th>Kategori</th>
										<th>Catatan</th>";
										if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"])) $text.="<th width=\"50\">Kontrol</th>";
										$text.="</tr>
									</thead>
									<tbody>";

										$sql="select * from dta_supplier_note where kodeSupplier='$par[kodeSupplier]' order by kodeNote";
										$res=db($sql);
										$no=1;
										while($r=mysql_fetch_array($res)){
											$text.="<tr>
											<td>$no.</td>
											<td>$r[namaNote]</td>
											<td>".nl2br($r[keteranganNote])."</td>";
											if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"])){
												$text.="<td align=\"center\">";				
												if(isset($menuAccess[$s]["edit"])) $text.="<a href=\"#Edit\" title=\"Edit Data\" class=\"edit\"  onclick=\"update('".getPar($par,"mode")."'); openBox('popup.php?par[mode]=editNote&par[kodeNote]=$r[kodeNote]".getPar($par,"mode,kodeNote")."',725,300);\"><span>Edit</span></a>";
												if(isset($menuAccess[$s]["delete"])) $text.="<a href=\"?par[mode]=delNote&par[kodeNote]=$r[kodeNote]".getPar($par,"mode,kodeNote")."\" onclick=\"update('".getPar($par,"mode")."'); return confirm('anda yakin akan menghapus data ini ?');\" title=\"Delete Data\" class=\"delete\"><span>Delete</span></a>";
												$text.="</td>";
											}
											$text.="</tr>";
											$no++;
										}	

										if($no == 1){
											$text.="<tr>
											<td>&nbsp;</td>								
											<td>&nbsp;</td>
											<td>&nbsp;</td>";				
											if(isset($menuAccess[$s]["edit"]) || isset($menuAccess[$s]["delete"]))
												$text.="<td>&nbsp;</td>";
											$text.="</tr>";
										}

										$text.="</tbody>
									</table>
								</div>		
							</form>";
							return $text;
						}
						function lihat(){
							global $s,$inp,$par,$arrTitle,$arrParameter,$menuAccess,$brandName;		
							$kodeMenu = $s;

							$text.="<div class=\"pageheader\">
							<h1 class=\"pagetitle\">".$arrTitle[$s]."</h1>
							".getBread()."
							<span class=\"pagedesc\">&nbsp;</span>
						</div>			
						<div id=\"contentwrapper\" class=\"contentwrapper\">
							<form action=\"\" method=\"post\" class=\"stdform\">
								<div id=\"pos_l\" style=\"float:left;\">
									<table>
										<tr>
											<td>Search : </td>
											<td>".comboArray("par[jenis]", array('All', 'Supplier', 'Kota','Industri'), $par[jenis])."</td>
											<td>
												<input type=\"text\" id=\"par[filter]\" name=\"par[filter]\" style=\"width:250px;\" value=\"$par[filter]\" class=\"mediuminput\" />					
											</td>
											<td><input type=\"submit\" value=\"GO\" class=\"btn btn_search btn-small\"/></td>
										</tr>
									</table>
								</p>
							</div>
							<div id=\"pos_r\">";
								if(isset($menuAccess[$s]["add"])) $text.="<a href=\"?par[mode]=add".getPar($par,"mode,kodeSupplier")."\" class=\"btn btn1 btn_document\"><span>Add Data</span></a>";
								$text.="</div>
							</form>
							<br clear=\"all\" />
							<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"stdtable stdtablequick\" id=\"dyntable\">
								<thead>
									<tr>
										<th width=\"20\">No.</th>
										<th width=\"100\">No Akun</th>
										<th>Nama Supplier</th>
										<th width=\"150\">Kota</th>
										<th width=\"150\">Industri</th>
										<th width=\"50\">Status</th>
										<th width=\"75\">Kontrol</th>
									</tr>
								</thead>
								<tbody>";				

									$filter ="where t1.namaSupplier!='' and t1.kodeMenu='$kodeMenu'";

									if($par[jenis]=="Supplier"){
										$filter.=" and (lower(t1.namaSupplier) like '%".strtolower($par[filter])."%' or lower(t1.aliasSupplier) like '%".strtolower($par[filter])."%')";
									}else if($par[jenis]=="Kota"){
										$filter.=" and lower(t2.namaData) like '%".strtolower($par[filter])."%'";
									}else{
										$filter.=" and (
											lower(t1.namaSupplier) like '%".strtolower($par[filter])."%'
											or lower(t1.aliasSupplier) like '%".strtolower($par[filter])."%'
											or lower(t2.namaData) like '%".strtolower($par[filter])."%'
											)";
}

$sql="select * from dta_supplier t1 left join mst_data t2 on (t1.kodeKota = t2.kodeData) $filter
order by t1.namaSupplier";
$res=db($sql);
while($r=mysql_fetch_array($res)){
	$no++;
	if ($r[aliasSupplier] != "")  $brandName = "(".$r[aliasSupplier].")";

	if($r[statusSupplier] == "p")
		$statusSupplier = "<img src=\"styles/images/p.png\" title='Prospect'>";
	else if($r[statusSupplier] == "t")
		$statusSupplier = "<img src=\"styles/images/t.png\" title='Active'>";
	else
		$statusSupplier = "<img src=\"styles/images/f.png\" title='Not Active'>";

	$text.="<tr>
	<td>$no.</td>
	<td>$r[nomorSupplier]</td>
	<td>$r[namaSupplier] $brandName</td>
	<td>$r[namaKota]</td>
	<td>$r[namaIndustri]</td>
	<td align=\"center\">$statusSupplier</td>
	<td align=\"center\">
		<a href=\"?par[mode]=det&par[kodeSupplier]=$r[kodeSupplier]".getPar($par,"mode,kodeSupplier")."\" title=\"Detail Data\" class=\"detail\"><span>Detail</span></a>
		";
		if(isset($menuAccess[$s]["edit"]))
			$text.="<a href=\"?par[mode]=edit&par[kodeSupplier]=$r[kodeSupplier]".getPar($par,"mode,kodeSupplier")."\" title=\"Edit Data\" class=\"edit\"><span>Edit</span></a>";				

		if(isset($menuAccess[$s]["delete"])) $text.="<a href=\"?par[mode]=del&par[kodeSupplier]=$r[kodeSupplier]".getPar($par,"mode,kodeSupplier")."\" onclick=\"return confirm('are you sure to delete data ?');\" title=\"Delete Data\" class=\"delete\"><span>Delete</span></a>";
		$text.="</td>
	</tr>";

	$kodeData  = $r[kodeData];
	$brandName = "";
}	

$text.="</tbody>
</table>
</div>";
return $text;
}

function detail(){
	global $s,$inp,$par,$tab,$arrTitle,$fFile,$dFile,$arrParameter,$menuAccess;

	$sql="select * from dta_supplier where kodeSupplier='$par[kodeSupplier]'";
	$res=db($sql);
	$r=mysql_fetch_array($res);					

	if(empty($r[kodeTipe])) $r[kodeTipe] = $par[kodeTipe];

	if($r[statusSupplier] == "p")
		$statusSupplier = "Prospect";
	else if($r[statusSupplier] == "t")
		$statusSupplier = "Active";
	else
		$statusSupplier = "Not Active";		

	$dAddress = " style=\"display: none;\"";
	$dProduct = " style=\"display: none;\"";
	$dIdentity = " style=\"display: none;\"";
	$dContact = " style=\"display: none;\"";
	$dBanking = " style=\"display: none;\"";
	$dGeneral = " style=\"display: none;\"";

	if($tab == 1){
		$tAddress = "class=\"current\"";
		$dAddress = " style=\"display: block;\"";
	}else if($tab == 2){
		$tProduct = "class=\"current\"";
		$dProduct = " style=\"display: block;\"";
	}else if($tab == 3){
		$tIdentity = "class=\"current\"";
		$dIdentity = " style=\"display: block;\"";
	}else if($tab == 4){
		$tContact = "class=\"current\"";
		$dContact = " style=\"display: block;\"";
	}else if($tab == 5){
		$tBanking = "class=\"current\"";
		$dBanking = " style=\"display: block;\"";
	}else{
		$tGeneral = "class=\"current\"";
		$dGeneral = " style=\"display: block;\"";
	}

	$text.="<div class=\"pageheader\">
	<h1 class=\"pagetitle\">".$arrTitle[$s]."</h1>
	".getBread(ucwords("detail data"))."
	<ul class=\"hornav\">
		<li $tGeneral><a href=\"#general\">General</a></li>
		<li $tAddress><a href=\"#address\">Address</a></li>
		<li $tProduct><a href=\"#product\">Product</a></li>
		<li $tIdentity><a href=\"#identity\">Identity</a></li>
		<li $tContact><a href=\"#contact\">Contact</a></li>
		<li $tBanking><a href=\"#banking\">Banking</a></li>
	</div>
	<div id=\"contentwrapper\" class=\"contentwrapper\">
		<form id=\"form\" name=\"form\" method=\"post\" class=\"stdform\" action=\"?_submit=1".getPar($par)."\" onsubmit=\"return validation(document.form);\" enctype=\"multipart/form-data\">
			<div style=\"top:70px; right:35px; position:absolute\">
				<input type=\"button\" class=\"cancel radius2\" style=\"float:right;\" value=\"Back\" onclick=\"window.location='?".getPar($par,"mode, kodeSupplier")."';\"/>
			</div>";

		# TAB GENERAL
			$text.="<div id=\"general\" class=\"subcontent\" $dGeneral >					
			<p>
				<label class=\"l-input-small\">No Akun</label>
				<span class=\"field\">$r[nomorSupplier]&nbsp;</span>
			</p>
			<p>
				<label class=\"l-input-small\">Nama Supplier</label>
				<span class=\"field\">$r[namaSupplier]&nbsp;</span>
			</p>
			<p>
				<label class=\"l-input-small\">Alias</label>
				<span class=\"field\">$r[aliasSupplier]&nbsp;</span>
			</p>
			<p>
				<label class=\"l-input-small\">Logo</label>
				<div class=\"field\">";
					$text.=empty($r[logoSupplier])?"":
					"<img src=\"".$fFile."/".$r[logoSupplier]."\" align=\"left\" style=\"padding-right:5px; padding-bottom:5px; max-width:50px; max-height:50px;\">
					<br clear=\"all\">";
					$text.="</div>
				</p>
				<p>
					<label class=\"l-input-small\">Alamat</label>
					<span class=\"field\">".nl2br($r[alamatSupplier])."&nbsp;</span>
				</p>
				<table style=\"width:100%\">
					<tr>
						<td style=\"width:50%\">										
							<p>
								<label class=\"l-input-small2\">Propinsi</label>
								<span class=\"fieldA\">".getField("select namaData from mst_data where kodeData='$r[kodePropinsi]'")."&nbsp;</span>
							</p>						
							<p>
								<label class=\"l-input-small2\">Telepon</label>
								<span class=\"fieldA\">$r[teleponSupplier]&nbsp;</span>
							</p>
							<p>
								<label class=\"l-input-small2\">Email</label>
								<span class=\"fieldA\">$r[emailSupplier]&nbsp;</span>
							</p>
							<p>
								<label class=\"l-input-small2\">Status</label>
								<span class=\"fieldA\">$statusSupplier&nbsp;</span>
							</p>
						</td>
						<td style=\"width:50%\">
							<p>
								<label class=\"l-input-small2\">Kota</label>
								<span class=\"fieldA\">".getField("select namaData from mst_data where kodeData='$r[kodeKota]'")."&nbsp;</span>
							</p>
							<p>
								<label class=\"l-input-small2\">Fax</label>
								<span class=\"fieldA\">$r[faxSupplier]&nbsp;</span>
							</p>							
							<p>
								<label class=\"l-input-small2\">Website</label>
								<span class=\"fieldA\">$r[webSupplier]&nbsp;</span>
							</p>						
						</td>
					</tr>
				</table>																		
			</div>";

		# TAB ADDRESS
			$text.="<div id=\"address\" class=\"subcontent\" $dAddress >
			<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"stdtable stdtablequick\">
				<thead>
					<tr>
						<th width=\"20\">No.</th>
						<th width=\"200\">Kategori</th>	<th>Alamat</th>
						<th width=\"200\">Kota</th>	<th width=\"150\">Telepon</th>
					</tr>
				</thead>
				<tbody>";								

					$sql="select * from dta_supplier_address t1 join mst_data t2 on (t1.kodeKota=t2.kodeData) where t1.kodeSupplier='$par[kodeSupplier]' order by t1.kodeAddress";
					$res=db($sql);
					$no=1;
					while($r=mysql_fetch_array($res)){
						$text.="<tr>
						<td>$no.</td>
						<td>$r[kategoriAddress]</td>
						<td>$r[alamatAddress]</td>
						<td>$r[namaData]</td>
						<td>$r[teleponAddress]</td>
					</tr>";
					$no++;
				}	

				if($no == 1){
					$text.="<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>";
			}

			$text.="</tbody>
		</table>
	</div>";

# TAB PRODUCT				
	$text.="<div id=\"product\" class=\"subcontent\" $dProduct >
	<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"stdtable stdtablequick\">
		<thead>
			<tr>
				<th width=\"20\">No.</th>
				<th>Product</th>
				<th width=\"125\">Harga</th>
				<th width=\"50\">File</th>
			</tr>
		</thead>
		<tbody>";

			$sql="select * from dta_supplier_produk t1 join dta_produk_kategori t2 on (t1.kodeProduk=t2.kodeProduk and t1.kodeKategori=t2.kodeKategori) where t1.kodeSupplier='$par[kodeSupplier]' order by t1.kodeProduk, t1.kodeKategori";
			$res=db($sql);
			$no=1;
			while($r=mysql_fetch_array($res)){
				$text.="<tr>
				<td>$no.</td>
				<td>$r[tipeKategori] -- $r[namaKategori]</td>
				<td align=\"right\">".getAngka($r[hargaProduk])."</td>
				<td align=\"center\">";
					if(!empty($r[fileProduk]))
						$text.="<a href=\"download.php?d=supp&f=".$r[kodeSupplier].".".$r[kodeProduk].".".$r[kodeKategori]."\"><img src=\"".getIcon($dFile."/".$r[fileProduk])."\" style=\"padding-right:5px; padding-bottom:5px;\"></a>";
					$text.="</td>
				</tr>";
				$no++;
			}	

			if($no == 1){
				$text.="<tr>
				<td>&nbsp;</td>								
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>";
		}

		$text.="</tbody>
	</table>
</div>";

# TAB IDENTITY
$sql="select * from dta_supplier_identity where kodeSupplier='$par[kodeSupplier]'";
$res=db($sql);
$r=mysql_fetch_array($res);

$text.="<div id=\"identity\" class=\"subcontent\" $dIdentity >
<table width=\"100%\">
	<tr>
		<td width=\"50%\" nowrap=\"nowrap\" style=\"vertical-align:top\">
			<p>
				<label class=\"l-input-small\">SIUP</label>
				<span class=\"field\">$r[siupIdentity]&nbsp;</span>
			</p>
			<p>
				<label class=\"l-input-small\">TDP</label>
				<span class=\"field\">$r[tdpIdentity]&nbsp;</span>
			</p>
			<p>
				<label class=\"l-input-small\">ID</label>
				<span class=\"field\">$r[idIdentity]&nbsp;</span>
			</p>
			<p>
				<label class=\"l-input-small\">NPWP</label>
				<span class=\"field\">$r[npwpIdentity]&nbsp;</span>
			</p>
			<p>
				<label class=\"l-input-small\">Alamat</label>
				<span class=\"field\">".nl2br($r[alamatIdentity])."&nbsp;</span>
			</p>
		</td>
		<td width=\"50%\" nowrap=\"nowrap\" style=\"vertical-align:top\">
			<p>
				<label class=\"l-input-small\">File</label>
				<div class=\"field\">";
					$text.=empty($r[siupIdentity_file])?"":
					"<a href=\"download.php?d=sup&f=siup.$r[kodeSupplier]\"><img src=\"".getIcon($dFile."/".$r[siupIdentity_file])."\" align=\"left\" style=\"padding-right:5px; padding-bottom:5px; max-width:50px; max-height:50px;\"></a>";
					$text.="</div>
				</p>
				<p>
					<label class=\"l-input-small\">File</label>
					<div class=\"field\">";
						$text.=empty($r[tdpIdentity_file])?"":
						"<a href=\"download.php?d=sup&f=tdp.$r[kodeSupplier]\"><img src=\"".getIcon($dFile."/".$r[tdpIdentity_file])."\" align=\"left\" style=\"padding-right:5px; padding-bottom:5px; max-width:50px; max-height:50px;\"></a>";
						$text.="</div>
					</p>
					<p>
						<label class=\"l-input-small\">File</label>
						<div class=\"field\">";
							$text.=empty($r[idIdentity_file])?"":
							"<a href=\"download.php?d=sup&f=id.$r[kodeSupplier]\"><img src=\"".getIcon($dFile."/".$r[idIdentity_file])."\" align=\"left\" style=\"padding-right:5px; padding-bottom:5px; max-width:50px; max-height:50px;\"></a>";
							$text.="</div>
						</p>
						<p>
							<label class=\"l-input-small\">File</label>
							<div class=\"field\">";
								$text.=empty($r[npwpIdentity_file])?"":
								"<a href=\"download.php?d=sup&f=id.$r[kodeSupplier]\"><img src=\"".getIcon($dFile."/".$r[npwpIdentity_file])."\" align=\"left\" style=\"padding-right:5px; padding-bottom:5px; max-width:50px; max-height:50px;\"></a>";
								$text.="</div>
							</p>
						</td>
					</tr>
				</table>
			</div>";

			# TAB CONTACT
			$text.="<div id=\"contact\" class=\"subcontent\" $dContact >
			<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"stdtable stdtablequick\">
				<thead>
					<tr>
						<th width=\"20\">No.</th>
						<th style=\"min-width:175px;\">Posisi</th>
						<th style=\"min-width:175px;\">Nama</th>
						<th width=\"150\">Email</th>
						<th width=\"100\">HP</th>
						<th width=\"100\">Tlp Kantor</th>
					</tr>
				</thead>
				<tbody>";				
					
					$sql="select * from dta_supplier_contact where kodeSupplier='$par[kodeSupplier]' order by kodeContact";
					$res=db($sql);
					$no=1;
					while($r=mysql_fetch_array($res)){
						$text.="<tr>
						<td>$no.</td>
						<td>$r[jabatanContact]</td>
						<td>$r[namaContact]</td>
						<td>$r[emailContact]</td>
						<td>$r[teleponContact]</td>
						<td>$r[kantorContact]</td>
					</td>
				</tr>";
				$no++;
			}	

			if($no == 1){
				$text.="<tr>
				<td>&nbsp;</td>								
				<td>&nbsp;</td>
				<td>&nbsp;</td>								
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>";
		}

		$text.="</tbody>
	</table>
</div>";

# TAB BANKING
$text.="<div id=\"banking\" class=\"subcontent\" $dBanking >
<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"stdtable stdtablequick\">
	<thead>
		<tr>
			<th width=\"20\">No.</th>
			<th>Nama Bank</th>
			<th width=\"150\">No Akun</th>							
			<th>Nama Akun</th>
		</tr>
	</thead>
	<tbody>";				

		$sql="select * from dta_supplier_bank t1 join mst_data t2 on (t1.kodeBank=t2.kodeData) where t1.kodeSupplier='$par[kodeSupplier]' order by t1.kodeBank";
		$res=db($sql);
		$no=1;
		while($r=mysql_fetch_array($res)){
			$text.="<tr>
			<td>$no.</td>
			<td>$r[namaBank]</td>
			<td>$r[rekeningBank]</td>
			<td>$r[pemilikBank]</td>
		</tr>";
		$no++;
	}	

	if($no == 1){
		$text.="<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>";
}

$text.="</tbody>
</table>
</div>
</form>";
return $text;
}

function getProduk(){
	global $s, $inp, $par, $arrTitle, $arrParameter, $menuAccess;
	if (empty($par[kodeProduk]))
		$par[kodeProduk] = "";
	$filter = "where t1.kodeKategori>0 and t1.statusKategori='t' ";

	$text.="
	<script>
		combo = \"".comboData("select * from dta_produk where statusProduk='t' order by namaProduk", "kodeProduk", "namaProduk", "par[kodeProduk]", "All", $par[kodeProduk], "", "")."\";
		setCombo(combo);

	</script>
	<div class=\"centercontent contentpopup\">
		<div class=\"pageheader\">
			<h1 class=\"pagetitle\">Daftar Produk </h1>
			" .getBread() . "
			<span class=\"pagedesc\">&nbsp;</span>
		</div>
		<div id=\"contentwrapper\" class=\"contentwrapper\">
			<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"stdtable stdtablequick full-width\" id=\"datatable\">
				<thead>
					<tr>
						<th style=\"width:20px;\">No.</th>
						<th style=\"width:0px;\">&nbsp;</th>
						<th style=\"width:75px;\">Tipe</th>
						<th style=\"min-width: 300px;\">Produk</th>
						<th style=\"width:75px;\">Satuan</th>
						<th style=\"width:50px;text-align: center\"><input type=\"checkbox\" style=\"width: 20px;\" id=\"chkProducts\" /></th>
					</tr>
				</thead>
				<tbody>";
					$kodeStatus = 951; # stok free
					if (!empty($par[kodeProduk])) {
						$filter.=" AND t1.kodeProduk='$par[kodeProduk]' ";
					}
					$sql = "SELECT 
					t3.namaData namaSatuan, t2.jumlahStok, t1.*
					FROM
					dta_produk_kategori t1
					JOIN dta_produk t5 ON t5.kodeProduk=t1.kodeProduk AND t5.statusProduk='t'
					LEFT JOIN dta_produk_stok t2 ON 
					t1.kodeProduk = t2.kodeProduk
					AND t1.kodeKategori = t2.kodeKategori
					AND t2.kodeStatus = '951'
					JOIN mst_data t3 ON t1.kodeSatuan=t3.kodeData
					$filter
					ORDER BY
					t1.kodeProduk, t1.kodeKategori
					";
					$res = db($sql);
					while ($r = mysql_fetch_array($res)) {
						$text.="
						<tr>
							<td style=\"width:20px;\"> </td>
							<td style=\"width:0px;\">$r[kodeProduk]</td>
							<td style=\"width:75px;\">$r[tipeKategori]</td>
							<td style=\"min-width: 300px;\">$r[namaKategori]</td>
							<td style=\"width:100px;\">$r[namaSatuan]</td>
							<td style=\"width:50px; text-align: center;\"><input type=\"checkbox\" style=\"width:50px\" id=\"chkProduct\" value=\"$r[kodeProduk]~$r[kodeKategori]\" /></td>
						</tr>";
					}
					$text.="
				</tbody>
			</table>
		</div>
	</div>";
	return $text;
}

function getContent($par){
	global $s,$_submit,$menuAccess,$fFile,$dFile,$cUsername;
	switch($par[mode]){
		case "cek":
		$text = cek();
		break;
		case "kta":
		$text = kota();
		break;					

		case "geo":
		$text = getField("select namaData from mst_data where kodeData='$par[kodeKota]'");
		break;

		case "delNote":
		if(isset($menuAccess[$s]["delete"])) $text = hapusNote(); else $text = lihat();
		break;
		case "editNote":
		if(isset($menuAccess[$s]["edit"])) $text = empty($_submit) ? formNote() : ubahNote(); else $text = lihat();
		break;
		case "addNote":
		if(isset($menuAccess[$s]["add"])) $text = empty($_submit) ? formNote() : tambahNote(); else $text = lihat();
		break;

		case "delBank":
		if(isset($menuAccess[$s]["delete"])) $text = hapusBank(); else $text = lihat();
		break;
		case "editBank":
		if(isset($menuAccess[$s]["edit"])) $text = empty($_submit) ? formBank() : ubahBank(); else $text = lihat();
		break;
		case "addBank":
		if(isset($menuAccess[$s]["add"])) $text = empty($_submit) ? formBank() : tambahBank(); else $text = lihat();
		break;

		case "delContact":
		if(isset($menuAccess[$s]["delete"])) $text = hapusContact(); else $text = lihat();
		break;
		case "editContact":
		if(isset($menuAccess[$s]["edit"])) $text = empty($_submit) ? formContact() : ubahContact(); else $text = lihat();
		break;
		case "addContact":
		if(isset($menuAccess[$s]["add"])) $text = empty($_submit) ? formContact() : tambahContact(); else $text = lihat();
		break;						


		case "getProduk":
		$text = getProduk();
		break;
		case "setProduk":
		$text = setProduk();
		break;
		case "delFProduct":
		if(isset($menuAccess[$s]["delete"])) $text = hapusFProduct(); else $text = lihat();
		break;
		case "delProduct":
		if(isset($menuAccess[$s]["delete"])) $text = hapusProduct(); else $text = lihat();
		break;
		case "editProduct":
		if(isset($menuAccess[$s]["edit"])) $text = empty($_submit) ? formProduct() : ubahProduct(); else $text = lihat();
		break;
		case "addProduct":
		if(isset($menuAccess[$s]["add"])) $text = empty($_submit) ? formProduct() : tambahProduct(); else $text = lihat();
		break;
		case "getData":
		include 'dta_supplier_data.php';
		break;

		case "delAddress":
		if(isset($menuAccess[$s]["delete"])) $text = hapusAddress(); else $text = lihat();
		break;
		case "editAddress":
		if(isset($menuAccess[$s]["edit"])) $text = empty($_submit) ? formAddress() : ubahAddress(); else $text = lihat();
		break;
		case "addAddress":
		if(isset($menuAccess[$s]["add"])) $text = empty($_submit) ? formAddress() : tambahAddress(); else $text = lihat();
		break;			

		case "update":
		if(isset($menuAccess[$s]["edit"])) $text = ubah("update");
		break;
		case "delNpwp":
		if(isset($menuAccess[$s]["edit"])) $text = hapusNpwp(); else $text = lihat();
		break;
		case "delId":
		if(isset($menuAccess[$s]["edit"])) $text = hapusId(); else $text = lihat();
		break;
		case "delTdp":
		if(isset($menuAccess[$s]["edit"])) $text = hapusTdp(); else $text = lihat();
		break;
		case "delSiup":
		if(isset($menuAccess[$s]["edit"])) $text = hapusSiup(); else $text = lihat();
		break;
		case "delLogo":
		if(isset($menuAccess[$s]["edit"])) $text = hapusLogo(); else $text = lihat();
		break;
		case "del":
		if(isset($menuAccess[$s]["delete"])) $text = hapus(); else $text = lihat();
		break;
		case "edit":
		if(isset($menuAccess[$s]["add"])) $text = empty($_submit) ? form() : ubah(); else $text = lihat();
		break;
		case "add":				
		$text = isset($menuAccess[$s]["add"]) ? tambah() : lihat();
		break;
		case "det":				
		$text = detail();
		break;
		default:									
		$sql="select * from dta_supplier where namaSupplier='' and createBy='$cUsername'";
		$res=db($sql);
		while($r=mysql_fetch_array($res)){
			if(file_exists($fFile.$r[logoSupplier]) and $r[logoSupplier]!="")unlink($fFile.$r[logoSupplier]);

			$sql_="select * from dta_supplier_identity where kodeSupplier='$r[kodeSupplier]'";
			$res_=db($sql_);
			$r_=mysql_fetch_array($res_);		
			if(file_exists($dFile.$r_[siupIdentity_file]) and $r_[siupIdentity_file]!="")unlink($dFile.$r_[siupIdentity_file]);
			if(file_exists($dFile.$r_[tdpIdentity_file]) and $r_[tdpIdentity_file]!="")unlink($dFile.$r_[tdpIdentity_file]);
			if(file_exists($dFile.$r_[idIdentity_file]) and $r_[idIdentity_file]!="")unlink($dFile.$r_[idIdentity_file]);
			if(file_exists($dFile.$r_[npwpIdentity_file]) and $r_[npwpIdentity_file]!="")unlink($dFile.$r_[npwpIdentity_file]);

			db("delete from dta_supplier where kodeSupplier='$r[kodeSupplier]'");
			db("delete from dta_supplier_address where kodeSupplier='$r[kodeSupplier]'");
			db("delete from dta_supplier_produk where kodeSupplier='$r[kodeSupplier]'");
			db("delete from dta_supplier_identity where kodeSupplier='$r[kodeSupplier]'");
			db("delete from dta_supplier_contact where kodeSupplier='$r[kodeSupplier]'");
			db("delete from dta_supplier_bank where kodeSupplier='$r[kodeSupplier]'");
		}
		$text = lihat();
		break;
	}
	return $text;
}	
?>