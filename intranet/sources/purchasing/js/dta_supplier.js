function chk(getPar){
	nomorSupplier=document.getElementById("inp[nomorSupplier]").value;		
	var xmlHttp = getXMLHttp();		
	xmlHttp.onreadystatechange = function(){	
		if(xmlHttp.readyState == 4 && xmlHttp.status==200){			
			if(xmlHttp.responseText){					
				alert(xmlHttp.responseText);										
			}else{
				if(validation(document.form)){
					document.getElementById("form").submit();
				}
			}
		}
	}
	
	xmlHttp.open("GET", "ajax.php?par[mode]=cek&inp[nomorSupplier]=" + nomorSupplier + getPar, true);
	xmlHttp.send(null);
	return false;
}
function update(getPar){
	kodePropinsi = document.getElementById('inp[kodePropinsi]').value;
	kodeKota = document.getElementById('inp[kodeKota]').value;
	nomorSupplier = document.getElementById('inp[nomorSupplier]').value;
	namaSupplier = document.getElementById('inp[namaSupplier]').value;
	aliasSupplier = document.getElementById('inp[aliasSupplier]').value;
	alamatSupplier = document.getElementById('inp[alamatSupplier]').value;
	teleponSupplier = document.getElementById('inp[teleponSupplier]').value;
	faxSupplier = document.getElementById('inp[faxSupplier]').value;
	emailSupplier = document.getElementById('inp[emailSupplier]').value;
	webSupplier = document.getElementById('inp[webSupplier]').value;		
	logoSupplier = document.getElementById('logoSupplier').files[0];	
	statusSupplier = document.getElementById('true').checked == true ? 't' : 'f';

	siupIdentity = document.getElementById('inp[siupIdentity]').value;
	siupIdentity_file = document.getElementById('siupIdentity_file').files[0];
	tdpIdentity = document.getElementById('inp[tdpIdentity]').value;
	tdpIdentity_file = document.getElementById('tdpIdentity_file').files[0];
	idIdentity = document.getElementById('inp[idIdentity]').value;
	idIdentity_file = document.getElementById('idIdentity_file').files[0];
	npwpIdentity = document.getElementById('inp[npwpIdentity]').value;
	npwpIdentity_file = document.getElementById('npwpIdentity_file').files[0];
	alamatIdentity = document.getElementById('inp[alamatIdentity]').value;		
	
	var xmlHttp=new XMLHttpRequest();
	xmlHttp.onreadystatechange=function(){
		if (xmlHttp.readyState==4 && xmlHttp.status==200){
			if(xmlHttp.responseText) alert(xmlHttp.responseText);
		}
	}
	
	xmlHttp.open("POST","ajax.php?par[mode]=update" + getPar,true);
	xmlHttp.setRequestHeader("Enctype", "multipart/form-data")
	var formData = new FormData();
	
	formData.append("inp[kodePropinsi]", kodePropinsi);	
	formData.append("inp[kodeKota]", kodeKota);
	formData.append("inp[nomorSupplier]", nomorSupplier);
	formData.append("inp[namaSupplier]", namaSupplier);
	formData.append("inp[aliasSupplier]", aliasSupplier);
	formData.append("inp[alamatSupplier]", alamatSupplier);	
	formData.append("inp[teleponSupplier]", teleponSupplier);
	formData.append("inp[faxSupplier]", faxSupplier);
	formData.append("inp[emailSupplier]", emailSupplier);
	formData.append("inp[webSupplier]", webSupplier);    
	formData.append("logoSupplier", logoSupplier);
	formData.append("inp[statusSupplier]", statusSupplier);

	formData.append("inp[siupIdentity]", siupIdentity);
	formData.append("siupIdentity_file", siupIdentity_file);
	formData.append("inp[tdpIdentity]", tdpIdentity);
	formData.append("tdpIdentity_file", tdpIdentity_file);
	formData.append("inp[idIdentity]", idIdentity);
	formData.append("idIdentity_file", idIdentity_file);
	formData.append("inp[npwpIdentity]", npwpIdentity);
	formData.append("npwpIdentity_file", npwpIdentity_file);
	formData.append("inp[alamatIdentity]", alamatIdentity);	
	
	xmlHttp.send(formData);		
	
}
function getKota(getPar){
	kodePropinsi = document.getElementById('inp[kodePropinsi]');
	kodeKota = document.getElementById('inp[kodeKota]');
	var xmlHttp = getXMLHttp();		
	xmlHttp.onreadystatechange = function(){	
		if(xmlHttp.readyState == 4 && xmlHttp.status==200){			
			for(var i=kodeKota.options.length-1; i>=0; i--){
				kodeKota.remove(i);
			}
			if(xmlHttp.responseText){
				var arr = xmlHttp.responseText.split("\n");						
				var opt = document.createElement("OPTION");
				opt.value = "";		
				opt.text = "";
				kodeKota.options.add(opt);
				for(var i=0; i<arr.length; i++){							
					var opt = document.createElement("OPTION");
					var val = arr[i].split("\t");
					opt.value = val[0];		 
					opt.text = val[1];
					if(opt.value) kodeKota.options.add(opt);
				}
			}
		}
	}
	xmlHttp.open("GET", "ajax.php?par[mode]=kta&par[kodePropinsi]="+ kodePropinsi.value + getPar, true);
	xmlHttp.send(null);
	return false;
}
function getProduk(){	
	document.getElementById("inp[kodeKategori]").value = "";
	document.getElementById("inp[namaKategori]").value = "";
}
function setProduk(kodeProduk, kodeKategori, getPar){
	var xmlHttp = getXMLHttp();
	xmlHttp.onreadystatechange = function(){
		if(xmlHttp.readyState == 4 && xmlHttp.status==200){	
			response = xmlHttp.responseText;
			if(response){
				namaKategori = response;
				parent.document.getElementById("inp[kodeProduk]").value = kodeProduk;
				parent.document.getElementById("inp[kodeKategori]").value = kodeKategori;				
				parent.document.getElementById("inp[namaKategori]").value = namaKategori;
				closeBox();
			}
		}
	}
	
	xmlHttp.open("GET", "ajax.php?par[mode]=setProduk&par[kodeProduk]=" + kodeProduk + "&par[kodeKategori]=" + kodeKategori + getPar, true);
	xmlHttp.send(null);
	return false;
}
// google maps
var geocoder;
var map;
var marker;
function initialize() {
	var lat = document.getElementById('inp[latitudeAddress]').value;
	var lng = document.getElementById('inp[longitudeAddress]').value;
	geocoder = new google.maps.Geocoder();
	var latLng = new google.maps.LatLng(lat, lng);
	var myMapParams = { zoom: 16, center: latLng, mapTypeId: google.maps.MapTypeId.ROADMAP };
	map = new google.maps.Map(document.getElementById('mapCanvas'), myMapParams);
	var myMarkerParams = { position: latLng, map: map, draggable: true };
	marker = new google.maps.Marker(myMarkerParams);
	updateMarkerPosition(latLng);
	geocodePosition(latLng);
	google.maps.event.addListener(marker, 'dragstart', 
		function() {
			updateMarkerAddress('Dragging...,Dragging...');
		});
	google.maps.event.addListener(marker, 'drag', 
		function() {              
			updateMarkerPosition(marker.getPosition());
		});
	google.maps.event.addListener(marker, 'dragend', 
		function() {                
			geocodePosition(marker.getPosition());
		});
}
function setGeocode(getPar) {
	var kodeKota = document.getElementById('inp[kodeKota]').value;
	var xmlHttp = getXMLHttp();	
	xmlHttp.onreadystatechange = function(){	
		if(xmlHttp.readyState == 4 && xmlHttp.status==200){									
			if(xmlHttp.responseText){
				var alamatAddress = document.getElementById('inp[alamatAddress]').value;
				var address = alamatAddress.concat(',', xmlHttp.responseText, ',', 'ID');
				geocoder.geocode({ 'address': address },
					function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							marker.setMap(null);
							map.setCenter(results[0].geometry.location);
							var myMarkerParams = { position: results[0].geometry.location, map: map, draggable: true };
							marker = new google.maps.Marker(myMarkerParams);

							updateMarkerPosition(results[0].geometry.location);
							geocodePosition(results[0].geometry.location);

							google.maps.event.addListener(marker, 'dragstart',
								function() {
									updateMarkerAddress('Dragging...,Dragging...');
								});
							google.maps.event.addListener(marker, 'drag',
								function() {
									updateMarkerPosition(marker.getPosition());
								});
							google.maps.event.addListener(marker, 'dragend',
								function() {
									geocodePosition(marker.getPosition());
								});
						} else {
							alert('error ' + status);
						}
					});
			}
		}
	}
	xmlHttp.open("GET", "ajax.php?par[mode]=geo&par[kodeKota]="+ kodeKota + getPar, true);
	xmlHttp.send(null);
	return false;
}
function geocodePosition(pos) {
	geocoder.geocode({ latLng: pos },
		function(results) {
			if (results && results.length > 0) {
				updateMarkerAddress(results[0].formatted_address);
			} else {
				updateMarkerAddress('-,-');
			}
		});
}        
function updateMarkerPosition(latLng) {
	document.getElementById('inp[latitudeAddress]').value = latLng.lat();
	document.getElementById('inp[longitudeAddress]').value = latLng.lng();
}
function updateMarkerAddress(str) {
	var arrStr = str.split(',');
	document.getElementById('inp[alamatAddress]').value = arrStr[0];
}
var isSubmit = false;
jQuery(document).ready(function(){
	formatNumberTabProduk();
	jQuery("#btnAddProduct").live("click", function (e) {
		if (jQuery("#form").valid()) {
			if (jQuery("#btnProdukBaru").length > 0) {
				e.preventDefault();
				alert("Silakan simpan data produk terlebih dahulu");
				jQuery("#btnProdukBaru").focus(100);
			} else {
          //load service
          openBox('popup.php?par[mode]=getProduk' + document.getElementById("getPar").value, 800, 450);
      }
  } else {
  	e.preventDefault();
  	showTab("paket");
  	jQuery("#inp\\[paketPenawaran\\]").focus(40);
  	alert("Silakan melengkapi form paket terlebih dahulu.");
  }
});
});
function formatNumberTabProduk() {
	jQuery(".mnumdp").each(function () {
		var id = jQuery(this).attr('id');
		jQuery("#" + id).autoNumeric('init', {aSign: "", wEmpty: 'zero', pSign: "p", dGroup: '3', aSep: ',', aDec: '.', mDec: 0, vMin: -99999999999999999999999999, vMax: 99999999999999999999999999});
	});
	jQuery(".mnumdps").each(function () {
		var id = jQuery(this).attr('id');
		jQuery("#" + id).autoNumeric('init', {aSign: "", wEmpty: 'zero', pSign: "p", dGroup: '3', aSep: ',', aDec: '.', mDec: 0, vMin: 1, vMax: 99999999999999999999999999});
	});
}
function productAddRows(serviceIds) {
	var actionUrl = "ajax.php?par[mode]=getData&par[dataType]=productList&par[dataIds]=" + serviceIds + document.getElementById("getPar").value;
	jQuery.ajax({
		url: actionUrl,
		success: function (data) {
			var _count = 0;
			var _no = jQuery("#dtProduct tbody tr").length;
			_no++;
			if (jQuery("#dtProduct tbody tr").length > 0) {
				var maxNum = 0;
				jQuery("#dtProduct tbody input[id^='dtlProdukId_']").each(function () {
					var num = parseInt(jQuery(this).attr("id").split("_")[1]);
					if (num > maxNum) {
						maxNum = num;
					}
				});
				_count = maxNum;
			}
			_count++;
			var firstItem = "#dtlProdukKtr_" + _count;
			var tmplHeader = "<tr class='trProdukHeader'><td colspan='9' style='font-weight:bolder'>:: DATA BARU ::</td></tr>";
			jQuery("#dtProduct tbody").append(tmplHeader);
			jQuery(data).each(function () {
				var tmplRow = "<input type='hidden' id='dtlProdukArray_" + _count + "' value='" + this.kodeProduk + "~" + _count + "~" + this.namaProduk + "~" + this.namaKategori + "' />";
				tmplRow += "<input type='hidden' id='dtlProdukId_" + _count + "' name='dtlProdukId[]' value='" + _count + "'  />";
				tmplRow += "<input type='hidden' id='dtlProdukKodeProduk_" + _count + "' name='dtlProdukKode[]' value='" + this.kodeProduk + "'  />";
				tmplRow += "<input type='hidden' id='dtlProdukKodeKategori_" + _count + "' name='dtlProdukKategori[]' value='" + this.kodeKategori + "'  />";
				tmplRow += "<input type='hidden' id='dtlProdukTipeKategori_" + _count + "' name='dtlProdukTipeKategori[]' value='" + this.tipeKategori + "'  />";
				tmplRow += "<input type='hidden' class='mnumdp' id='dtlProdukHargaDasar_" + _count + "' name='dtlProdukHargaDasar[]' value='" + this.hargaJual + "'  />";
				tmplRow += "<input type='hidden' id='dtlProdukNamaProduk_" + _count + "' name='dtlProdukNamaProduk[]' value='" + this.namaProduk + "'  />";
				tmplRow += "<td style='width: 20px;'>" + " " + "</td>";
				tmplRow += "<td>" + this.tipeKategori + "</td>";
				tmplRow += "<td>" + this.namaKategori + "</td>";
				tmplRow += "<td style='width: 200px;'><input type='text' style='width:200px;' id='dtlProdukKtr_" + _count + "' name='dtlProdukKtr[]' value=''/></td>";
				tmplRow += "<td style='width: 200px;'>";
				tmplRow += "	<input type='text' id='fileTemp_" + _count + "' name='fileTemp_" + _count + "' class='input' style='width:150px;' maxlength='100' />";
				tmplRow += "	<div class='fakeupload' style='width: 195px'>";
				tmplRow += "		<input type='file' id='dtlProdukFile_" + _count + "' name='dtlProdukFile_" + _count + "' class='realupload' style='width: 200px' size='50' onchange='this.form.fileTemp_" + _count + ".value = this.value;' />";
				tmplRow += "	</div>";
				tmplRow += "</td>";
				tmplRow += "<td style='width: 90px;'><input type='text' class='mnumdp' style='text-align:right;width:90px;' id='dtlProdukHrg_" + _count + "' name='dtlProdukHrg[]' value='" + (this.hargaProduk ? this.hargaProduk : 0) + "'/></td>";
				tmplRow += "<td style='width: 60px;text-align:center;'>";
				tmplRow += "<a class='delete delRow' href='#deProduk' title='Hapus Data' onclick=\"if(confirm('Are you sure to delete this data ?')) { jQuery(this).parent().parent().remove(); }\"><span>Remove</span></a>";
				tmplRow += "</td>";
				jQuery("#dtProduct tbody").append("<tr id='trProduct_" + _count + "'>" + tmplRow + "</tr>");
				_count++;
				_no++;
			});
formatNumberTabProduk();
tmplHeader = "<tr class='trProdukHeader'><td colspan='7' style='font-weight:bolder;text-align:right'><a href='#' onclick='formatTableProduk();' id='btnProdukBaru' class='btn btn_orange btn_archive'><span>Simpan data baru</span></a></td></tr>";
jQuery("#dtProduct tbody").append(tmplHeader);
closeBox();
jQuery(firstItem).focus(100);
}
});
}
function formatTableProduk() {
	var productArray = jQuery("input[id^='dtlProdukArray_']").map(function () {
		return [this.value.split("~")];
	}).get();
	productArray.sort(function (a, b) {
		var a1 = a[2], b1 = b[2];
		if (a1 == b1)
			return 0;
		return a1 > b1 ? 1 : -1;
	});
	var kodeProduk = -99;
	var namaProduk = "";
	var c = 0, no = 0, subTotal = 0;
	jQuery("#dtProduct .trProdukHeader").remove();
	jQuery("#dtProduct .trProdukSubtotal").remove();
	jQuery.each(productArray, function () {
		var _kodeProduk = this[0];
		var _namaProduk = this[2];
		var _rownum = this[1];
		if (kodeProduk !== _kodeProduk) {
			kodeProduk = _kodeProduk;
			namaProduk = _namaProduk;
			subTotal = 0;
			no = 0;
			var tmplHeader = "<tr class='trProdukHeader'><td colspan='7' style='font-weight:bolder'>" + namaProduk + "</td></tr>";
			jQuery("#dtProduct tbody").append(tmplHeader);
		}
		var tmplRow = jQuery("#trProduct_" + _rownum).closest('tr');
		jQuery("#dtProduct tbody").append(tmplRow);
		c++;
	});
	formatNumberTabProduk();
}
var comboData = '';
function setCombo(combo){
	comboData = combo;
}
jQuery(document).ready(function () {
	ot = jQuery('#datatable').dataTable({
		"bSort": true,
		"bFilter": true,
		"iDisplayStart": 0,
		"iDisplayLength": 25,
		"aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
		"sPaginationType": "full_numbers",
		"aoColumnDefs": [
		{'bSortable': false, 'aTargets': [0]},
		{'bVisible': false, 'aTargets': [1]},
		],
		"fnInitComplete": function (oSettings) {
			oSettings.oLanguage.sZeroRecords = "No data available";
		},
		"sDom": "<'top'f>rt<'bottom'lip><'clear'>",
		"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			jQuery("td:first", nRow).html((iDisplayIndexFull + 1) + ".");
			return nRow;
		},
		"bProcessing": true,
		"oLanguage": {
			"sProcessing": "<img src=\"styles/images/loader.gif\" />"
		}
	});
	jQuery('#chkProducts').click(function (e) {
		if (jQuery(this).is(':checked')) {
			jQuery(this).parents('tr').addClass('selected');
		} else {
			jQuery(this).parents('tr').removeClass('selected');
		}
		jQuery('#datatable tbody input[type=checkbox]').prop("checked", this.checked);
	});
	jQuery('#datatable tbody input[type=checkbox]').click(function () {
		if (jQuery(this).is(':checked')) {
			jQuery(this).parents('tr').addClass('selected');
		} else {
			jQuery(this).parents('tr').removeClass('selected');
		}
	});
	jQuery('#datatable_wrapper #datatable_filter').css("float", "left").css("position", "relative").css("margin-left", "14px").css("font-size", "14px");
	jQuery("#datatable_wrapper #datatable_filter label").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Produk</b>&nbsp;:&nbsp;" + comboData);
	jQuery("#datatable_wrapper .top").append("<div id=\"right_panel\" class='dataTables_filter' style='float:right;'><input type=\"button\" class=\"add\" id=\"btnSetProduct\" value=\"Tambahkan\" style=\"float:right;\"/></div>");
	jQuery("#btnSetProduct").live("click", function (e) {
		if (jQuery('input[id=chkProduct]:checked', ot.fnGetNodes()).length > 0) {
			jQuery(this).attr("disabled", true);
			var serviceListId = "";
			jQuery('input[id=chkProduct]:checked', ot.fnGetNodes()).each(function () {
				serviceListId += "'" + jQuery(this).val() + "',";
			});
			parent.productAddRows(serviceListId.substring(0, serviceListId.length - 1));
		} else {
			alert("Tidak ada Data yang dipilih!");
		}
	});
	jQuery("#par\\[kodeProduk\\]").live("change", function () {
		var tsearch = jQuery(this).val();
		ot.fnFilter(tsearch, 1);
	});
});
jQuery.fn.dataTableExt.afnSortData['dom-checkbox'] = function (oSettings, iColumn) {
	var aData = [];
	jQuery('td:eq(' + (iColumn-1) + ') input', oSettings.oApi._fnGetTrNodes(oSettings)).each(function () {
		aData.push(this.checked === true ? "1" : "0");
	});
	return aData;
};