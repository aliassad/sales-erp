/***************************************************************************/
/*                                                                         */
/*  This obfuscated code was created by Javascript Obfuscator Free Version.*/
/*  Javascript Obfuscator Free Version can be downloaded here              */
/*  http://javascriptobfuscator.com                                        */
/*                                                                         */
/***************************************************************************/
var _$_87dc=["","html","#bankList","views/gettingBankDetails.php","get","id","<tr class='danger'><td colspan='5'><center><b>No Banks Found !...</b></center></td></tr>","append","<tr><td>","</td><td class='nocenter'>","acno","</td><td class='nocenter'>Rs ","toLocaleString","debit","credit","</td><td>","obalance","</td></tr>","getJSON","val","#bankname","filter","length","<tr class='danger'><td colspan='5'><center><b>No result found..!</b></center></td></tr>","<tr class='success'><td>","#fdate","#tdate","<tr id=\"loading\" style=\"display:none;\" ><td colspan=\"5\"><center > <img src=\"img/loading.gif\"> </center></td></tr>","#dayTransactions","show","#loading","views/gettingDayTransactions.php?fdate=","&tdate=","log","<tr class='danger'><td colspan='5'><center><b>No Transactions Found !...</b></center></td></tr>","#totalcash","#totaldebit","#totalcredit","credit asec","order","dis","each","#daycashn","Rs ","hide","views/gettingPreTransactions.php?fdate=","#daycash","#daydate","Select Date!","You must select the date first","error","No Transactions!","Soory you do not have any transations to print","location.href='views/printdaybook.php?billid=","&pre=","'"];var db1;function loadDetails(){$(_$_87dc[2])[_$_87dc[1]](_$_87dc[0]);var _0x1A4F4=_$_87dc[3];$[_$_87dc[18]](_0x1A4F4,function(_0x1A550){db1= TAFFY(_0x1A550);var _0x1A608=db1()[_$_87dc[4]]();if(_0x1A550== _$_87dc[0]|| (_0x1A608[0][_$_87dc[5]]== null)){$(_$_87dc[2])[_$_87dc[7]](_$_87dc[6]);return};for(var _0x1A5AC=0;_0x1A5AC< 500;_0x1A5AC++){$(_$_87dc[2])[_$_87dc[7]](_$_87dc[8]+ _0x1A608[_0x1A5AC][_$_87dc[5]]+ _$_87dc[9]+ _0x1A608[_0x1A5AC][_$_87dc[10]]+ _$_87dc[11]+ parseFloat(_0x1A608[_0x1A5AC][_$_87dc[13]])[_$_87dc[12]]()+ _$_87dc[11]+ parseFloat(_0x1A608[_0x1A5AC][_$_87dc[14]])[_$_87dc[12]]()+ _$_87dc[15]+ (parseFloat(_0x1A608[_0x1A5AC][_$_87dc[16]])+ (parseFloat(_0x1A608[_0x1A5AC][_$_87dc[14]])- parseFloat(_0x1A608[_0x1A5AC][_$_87dc[13]])))[_$_87dc[12]]()+ _$_87dc[17])}})}function filterbank(){$(_$_87dc[2])[_$_87dc[1]](_$_87dc[0]);var _0x1E268=$(_$_87dc[20])[_$_87dc[19]]();if(_0x1E268){rows= db1()[_$_87dc[21]]([{acno:{likenocase:_0x1E268}}])[_$_87dc[4]]();if(rows[_$_87dc[22]]== 0){$(_$_87dc[2])[_$_87dc[7]](_$_87dc[23])}else {for(var _0x1A5AC=0;_0x1A5AC< rows[_$_87dc[22]];_0x1A5AC++){$(_$_87dc[2])[_$_87dc[7]](_$_87dc[24]+ rows[_0x1A5AC][_$_87dc[5]]+ _$_87dc[9]+ rows[_0x1A5AC][_$_87dc[10]]+ _$_87dc[11]+ parseFloat(rows[_0x1A5AC][_$_87dc[13]])[_$_87dc[12]]()+ _$_87dc[11]+ parseFloat(rows[_0x1A5AC][_$_87dc[14]])[_$_87dc[12]]()+ _$_87dc[15]+ (parseFloat(rows[_0x1A5AC][_$_87dc[16]])+ (parseFloat(rows[_0x1A5AC][_$_87dc[13]])- parseFloat(rows[_0x1A5AC][_$_87dc[14]])))[_$_87dc[12]]()+ _$_87dc[17])}}}else {rows= db1()[_$_87dc[4]]();for(var _0x1A5AC=0;_0x1A5AC< 500;_0x1A5AC++){$(_$_87dc[2])[_$_87dc[7]](_$_87dc[8]+ rows[_0x1A5AC][_$_87dc[5]]+ _$_87dc[9]+ rows[_0x1A5AC][_$_87dc[10]]+ _$_87dc[11]+ parseFloat(rows[_0x1A5AC][_$_87dc[13]])[_$_87dc[12]]()+ _$_87dc[11]+ parseFloat(rows[_0x1A5AC][_$_87dc[14]])[_$_87dc[12]]()+ _$_87dc[15]+ (parseFloat(rows[_0x1A5AC][_$_87dc[16]])+ (parseFloat(rows[_0x1A5AC][_$_87dc[13]])- parseFloat(rows[_0x1A5AC][_$_87dc[14]])))[_$_87dc[12]]()+ _$_87dc[17])}}}var db;function loadData(){if(!$(_$_87dc[25])[_$_87dc[19]]()||  !$(_$_87dc[26])[_$_87dc[19]]()){return};loadpre();$(_$_87dc[28])[_$_87dc[1]](_$_87dc[27]);$(_$_87dc[30])[_$_87dc[29]]();var _0x1A4F4=_$_87dc[31]+ $(_$_87dc[25])[_$_87dc[19]]()+ _$_87dc[32]+ $(_$_87dc[26])[_$_87dc[19]]();console[_$_87dc[33]](_0x1A4F4);$[_$_87dc[18]](_0x1A4F4,function(_0x1A550){console[_$_87dc[33]](_0x1A550);var $tdebit=0;var $tcredit=0;db= TAFFY(_0x1A550);var _0x1A608=db()[_$_87dc[4]]();if(_0x1A550== _$_87dc[0]|| (_0x1A608[0][_$_87dc[5]]== null)){$(_$_87dc[28])[_$_87dc[7]](_$_87dc[34]);$(_$_87dc[35])[_$_87dc[19]](0);$(_$_87dc[36])[_$_87dc[19]](0);$(_$_87dc[37])[_$_87dc[19]](0);return};var _0x1E434=db()[_$_87dc[39]](_$_87dc[38])[_$_87dc[4]]();var _0x1A5AC=1;$[_$_87dc[41]](_0x1E434,function(_0x1A664,_0x1A550){$tcredit+= parseFloat(_0x1A550[_$_87dc[14]]);$tdebit+= parseFloat(_0x1A550[_$_87dc[13]]);$(_$_87dc[28])[_$_87dc[7]](_$_87dc[8]+ _0x1A5AC+ _$_87dc[9]+ _0x1A550[_$_87dc[40]]+ _$_87dc[11]+ parseFloat(_0x1A550[_$_87dc[14]])[_$_87dc[12]]()+ _$_87dc[11]+ parseFloat(_0x1A550[_$_87dc[13]])[_$_87dc[12]]()+ _$_87dc[17]);_0x1A5AC++});var _0x1E37C=0;$(_$_87dc[35])[_$_87dc[19]](0);$(_$_87dc[36])[_$_87dc[19]](0);$(_$_87dc[37])[_$_87dc[19]](0);if($(_$_87dc[42])[_$_87dc[19]]()){_0x1E37C= $(_$_87dc[42])[_$_87dc[19]]()};$(_$_87dc[37])[_$_87dc[19]](_$_87dc[43]+ parseFloat($tcredit)[_$_87dc[12]]());$(_$_87dc[36])[_$_87dc[19]](_$_87dc[43]+ parseFloat($tdebit)[_$_87dc[12]]());var _0x1E3D8=0;var _0x1E3D8=((parseFloat(_0x1E37C)+ parseFloat($tdebit))- parseFloat($tcredit))[_$_87dc[12]]();$(_$_87dc[35])[_$_87dc[19]](_$_87dc[43]+ _0x1E3D8)});$(_$_87dc[30])[_$_87dc[44]]()}function loadpre(){var _0x1A4F4=_$_87dc[45]+ $(_$_87dc[25])[_$_87dc[19]]();console[_$_87dc[33]](_0x1A4F4);$[_$_87dc[18]](_0x1A4F4,function(_0x1A550){var $tdebit=0;var $tcredit=0;$[_$_87dc[41]](_0x1A550,function(_0x1A664,_0x1A550){$tcredit+= parseFloat(_0x1A550[_$_87dc[14]]);$tdebit+= parseFloat(_0x1A550[_$_87dc[13]])});var _0x1E3D8=(parseFloat($tdebit)- parseFloat($tcredit))[_$_87dc[12]]();$(_$_87dc[46])[_$_87dc[19]](_$_87dc[43]+ _0x1E3D8);$(_$_87dc[42])[_$_87dc[19]](parseFloat($tdebit)- parseFloat($tcredit))})}function printdaybook(){if(!$(_$_87dc[35])[_$_87dc[19]]()&&  !$(_$_87dc[47])[_$_87dc[19]]()){swal(_$_87dc[48],_$_87dc[49],_$_87dc[50])}else {if(!$(_$_87dc[35])[_$_87dc[19]]()){swal(_$_87dc[51],_$_87dc[52],_$_87dc[50])}};if(($(_$_87dc[47])[_$_87dc[19]]())&& $(_$_87dc[35])[_$_87dc[19]]()){setTimeout(_$_87dc[53]+ $(_$_87dc[47])[_$_87dc[19]]()+ _$_87dc[54]+ $(_$_87dc[42])[_$_87dc[19]]()+ _$_87dc[55],500)}}