/***************************************************************************/
/*                                                                         */
/*  This obfuscated code was created by Javascript Obfuscator Free Version.*/
/*  Javascript Obfuscator Free Version can be downloaded here              */
/*  http://javascriptobfuscator.com                                        */
/*                                                                         */
/***************************************************************************/
var _$_761f=["views/gettingmembers.php","hide","#loading","<tr onclick=\"showCustomer(this);\" id=\"","id","\" ><td>","</td><td>","name","cno","phone","address","</td></tr>","append","#customers","each","getJSON","ready","","html","val","#pno","#pname","Show all","999","get","filter","length","<tr class='danger' onclick='showCustomer(this);' ><td colspan='5'><center><b>No result found..!</b></center></td></tr>","<tr class=\"success\" onclick=\"showCustomer(this);\" ><td>","<tr onclick=\"showCustomer(this);\" ><td>","#cname","#cemail","#cphone","#caddress","Input Error","Please fill all the fields","error","views/addMember.php","post","true","modal","#newCustomerModal","Saved!","success","New Member added successfully:)","location.href=\"index.php?page=members\"","Database Error","Please wait and try Again!","ajax","href","location","index.php?page=showMember&idno="];var db;$(document)[_$_761f[16]](function(){var _0x1A4F4=_$_761f[0];$[_$_761f[15]](_0x1A4F4,function(_0x1A550){db= TAFFY(_0x1A550);$(_$_761f[2])[_$_761f[1]]();var _0x1A5AC=0;$[_$_761f[14]](_0x1A550,function(_0x1A664,_0x1A550){_0x1A5AC++;$(_$_761f[13])[_$_761f[12]](_$_761f[3]+ _0x1A550[_$_761f[4]]+ _$_761f[5]+ _0x1A5AC+ _$_761f[6]+ _0x1A550[_$_761f[7]]+ _$_761f[6]+ _0x1A550[_$_761f[8]]+ _$_761f[6]+ _0x1A550[_$_761f[9]]+ _$_761f[6]+ _0x1A550[_$_761f[10]]+ _$_761f[11])})})});function filter(){$(_$_761f[13])[_$_761f[18]](_$_761f[17]);var _0x1E040=$(_$_761f[20])[_$_761f[19]]();var _0x1E09C=$(_$_761f[21])[_$_761f[19]]();var _0x1A608;if(!_0x1E09C|| _0x1E09C== _$_761f[22]){_0x1E09C= _$_761f[23]};if(_0x1E040|| _0x1E09C!= _$_761f[23]){_0x1A608= db()[_$_761f[25]]([{cno:{like:_0x1E040}},{name:{likenocase:_0x1E09C}}])[_$_761f[24]]();if(_0x1A608[_$_761f[26]]== 0){$(_$_761f[13])[_$_761f[12]](_$_761f[27])}else {for(var _0x1A5AC=0;_0x1A5AC< _0x1A608[_$_761f[26]];_0x1A5AC++){$(_$_761f[13])[_$_761f[12]](_$_761f[28]+ _0x1A608[_0x1A5AC][_$_761f[4]]+ _$_761f[6]+ _0x1A608[_0x1A5AC][_$_761f[7]]+ _$_761f[6]+ _0x1A608[_0x1A5AC][_$_761f[8]]+ _$_761f[6]+ _0x1A608[_0x1A5AC][_$_761f[9]]+ _$_761f[6]+ _0x1A608[_0x1A5AC][_$_761f[10]]+ _$_761f[11])}}}else {_0x1A608= db()[_$_761f[24]]();for(var _0x1A5AC=0;_0x1A5AC< _0x1A608[_$_761f[26]];_0x1A5AC++){$(_$_761f[13])[_$_761f[12]](_$_761f[29]+ _0x1A608[_0x1A5AC][_$_761f[4]]+ _$_761f[6]+ _0x1A608[_0x1A5AC][_$_761f[7]]+ _$_761f[6]+ _0x1A608[_0x1A5AC][_$_761f[8]]+ _$_761f[6]+ _0x1A608[_0x1A5AC][_$_761f[9]]+ _$_761f[6]+ _0x1A608[_0x1A5AC][_$_761f[10]]+ _$_761f[11])}}}function saveCustomer(){n= $(_$_761f[30])[_$_761f[19]]();e= $(_$_761f[31])[_$_761f[19]]();p= $(_$_761f[32])[_$_761f[19]]();ad= $(_$_761f[33])[_$_761f[19]]();if(!$(_$_761f[30])[_$_761f[19]]()||  !$(_$_761f[31])[_$_761f[19]]()){swal(_$_761f[34],_$_761f[35],_$_761f[36]);return};$[_$_761f[48]]({url:_$_761f[37],data:{name:n,email:e,phone:p,address:ad},type:_$_761f[38],success:function(_0x1DD60){if(_0x1DD60== _$_761f[39]){$(_$_761f[41])[_$_761f[40]](_$_761f[1]);swal({title:_$_761f[42],type:_$_761f[43],text:_$_761f[44],timer:2000,showConfirmButton:true});setTimeout(_$_761f[45],1500)}else {swal(_$_761f[46],_$_761f[47],_$_761f[36]);return}}})}function clearModal(){$(_$_761f[30])[_$_761f[19]](_$_761f[17]);$(_$_761f[32])[_$_761f[19]](_$_761f[17]);$(_$_761f[31])[_$_761f[19]](_$_761f[17]);$(_$_761f[33])[_$_761f[19]](_$_761f[17])}function showCustomer(_0x1DADC){var _0x1DDBC=_0x1DADC[_$_761f[4]];window[_$_761f[50]][_$_761f[49]]= _$_761f[51]+ _0x1DDBC}