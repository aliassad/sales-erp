/***************************************************************************/
/*                                                                         */
/*  This obfuscated code was created by Javascript Obfuscator Free Version.*/
/*  Javascript Obfuscator Free Version can be downloaded here              */
/*  http://javascriptobfuscator.com                                        */
/*                                                                         */
/***************************************************************************/
var _$_4d12=["views/gettingCustomers.php","hide","#loading","","<tr class='danger'><td colspan='8'><center><b>No Customers Found !...</b></center></td></tr>","append","#vendors","total_balance","<tr onclick=\"showCustomer(this);\" ><td>","id","</td><td>","name","company","city","email","phone","address","</td><td>Rs ","toLocaleString","</td></tr>","#customers","each","Rs ","val","#total_Receivable","getJSON","ready","html","#pno","#pname","#pcity","Show all","999","get","filter","length","<tr class='danger' onclick='showCustomer(this);' ><td colspan='8'><center><b>No result"," found..!</b></center></td></tr>","<tr class=\"success\" onclick=\"showCustomer(this);\" ><td>","#cname","#cemail","#cphone","#caddress","#opening_balance","#ccompany","#ccity","Input Error","Please fill all the fields","error","views/addCustomer.php","post","true","modal","#newCustomerModal","Saved!","success","New customer added successfully:)","location.href=\"index.php?page=customers\"","Database Error","Please wait and try Again!","ajax","innerHTML","cells","href","location","index.php?page=showCustomer&idno="];var db;$(document)[_$_4d12[26]](function(){var _0x1A4F4=_$_4d12[0];$[_$_4d12[25]](_0x1A4F4,function(_0x1A550){db= TAFFY(_0x1A550);$(_$_4d12[2])[_$_4d12[1]]();if(_0x1A550== _$_4d12[3]){$(_$_4d12[6])[_$_4d12[5]](_$_4d12[4]);return};var _0x1A6C0=0;$[_$_4d12[21]](_0x1A550,function(_0x1A664,_0x1A550){_0x1A6C0+= parseFloat(_0x1A550[_$_4d12[7]]);$(_$_4d12[20])[_$_4d12[5]](_$_4d12[8]+ _0x1A550[_$_4d12[9]]+ _$_4d12[10]+ _0x1A550[_$_4d12[11]]+ _$_4d12[10]+ _0x1A550[_$_4d12[12]]+ _$_4d12[10]+ _0x1A550[_$_4d12[13]]+ _$_4d12[10]+ _0x1A550[_$_4d12[14]]+ _$_4d12[10]+ _0x1A550[_$_4d12[15]]+ _$_4d12[10]+ _0x1A550[_$_4d12[16]]+ _$_4d12[17]+ parseFloat(_0x1A550[_$_4d12[7]])[_$_4d12[18]]()+ _$_4d12[19])});$(_$_4d12[24])[_$_4d12[23]](_$_4d12[22]+ parseFloat(_0x1A6C0)[_$_4d12[18]]())})});function filter(){$(_$_4d12[20])[_$_4d12[27]](_$_4d12[3]);var _0x1E040=$(_$_4d12[28])[_$_4d12[23]]();var _0x1E09C=$(_$_4d12[29])[_$_4d12[23]]();var _0x1DFE4=$(_$_4d12[30])[_$_4d12[23]]();var _0x1A608;if(!_0x1E09C|| _0x1E09C== _$_4d12[31]){_0x1E09C= _$_4d12[32]};if(!_0x1DFE4|| _0x1DFE4== _$_4d12[31]){_0x1DFE4= _$_4d12[32]};var _0x1A6C0=0;if(_0x1E040|| _0x1E09C!= _$_4d12[32]|| _0x1DFE4!= _$_4d12[32]){_0x1A608= db()[_$_4d12[34]]([{id:_0x1E040},{name:{likenocase:_0x1E09C}},{city:{likenocase:_0x1DFE4}}])[_$_4d12[33]]();if(_0x1A608[_$_4d12[35]]== 0){_0x1A6C0= 0;$(_$_4d12[20])[_$_4d12[5]](_$_4d12[36]+ _$_4d12[37])}else {_0x1A6C0= 0;for(var _0x1A5AC=0;_0x1A5AC< _0x1A608[_$_4d12[35]];_0x1A5AC++){_0x1A6C0+= parseFloat(_0x1A608[_0x1A5AC][_$_4d12[7]]);$(_$_4d12[20])[_$_4d12[5]](_$_4d12[38]+ _0x1A608[_0x1A5AC][_$_4d12[9]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[11]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[12]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[13]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[14]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[15]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[16]]+ _$_4d12[17]+ parseFloat(_0x1A608[_0x1A5AC][_$_4d12[7]])[_$_4d12[18]]()+ _$_4d12[19])}}}else {_0x1A6C0= 0;_0x1A608= db()[_$_4d12[33]]();for(var _0x1A5AC=0;_0x1A5AC< _0x1A608[_$_4d12[35]];_0x1A5AC++){_0x1A6C0+= parseFloat(_0x1A608[_0x1A5AC][_$_4d12[7]]);$(_$_4d12[20])[_$_4d12[5]](_$_4d12[8]+ _0x1A608[_0x1A5AC][_$_4d12[9]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[11]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[12]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[13]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[14]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[15]]+ _$_4d12[10]+ _0x1A608[_0x1A5AC][_$_4d12[16]]+ _$_4d12[17]+ parseFloat(_0x1A608[_0x1A5AC][_$_4d12[7]])[_$_4d12[18]]()+ _$_4d12[19])}};$(_$_4d12[24])[_$_4d12[23]](_$_4d12[22]+ parseFloat(_0x1A6C0)[_$_4d12[18]]())}function saveCustomer(){n= $(_$_4d12[39])[_$_4d12[23]]();e= $(_$_4d12[40])[_$_4d12[23]]();p= $(_$_4d12[41])[_$_4d12[23]]();ad= $(_$_4d12[42])[_$_4d12[23]]();ob= $(_$_4d12[43])[_$_4d12[23]]();cc= $(_$_4d12[44])[_$_4d12[23]]();cci= $(_$_4d12[45])[_$_4d12[23]]();if(!$(_$_4d12[39])[_$_4d12[23]]()){swal(_$_4d12[46],_$_4d12[47],_$_4d12[48]);return};$[_$_4d12[60]]({url:_$_4d12[49],data:{name:n,email:e,phone:p,address:ad,company:cc,city:cci,opening_balance:ob},type:_$_4d12[50],success:function(_0x1DD60){if(_0x1DD60== _$_4d12[51]){$(_$_4d12[53])[_$_4d12[52]](_$_4d12[1]);swal({title:_$_4d12[54],type:_$_4d12[55],text:_$_4d12[56],timer:2000,showConfirmButton:true});setTimeout(_$_4d12[57],1500)}else {swal(_$_4d12[58],_$_4d12[59],_$_4d12[48]);return}}})}function clearModal(){$(_$_4d12[39])[_$_4d12[23]](_$_4d12[3]);$(_$_4d12[41])[_$_4d12[23]](_$_4d12[3]);$(_$_4d12[40])[_$_4d12[23]](_$_4d12[3]);$(_$_4d12[42])[_$_4d12[23]](_$_4d12[3])}function showCustomer(_0x1DADC){var _0x1DDBC=_0x1DADC[_$_4d12[62]][0][_$_4d12[61]];window[_$_4d12[64]][_$_4d12[63]]= _$_4d12[65]+ _0x1DDBC}