/***************************************************************************/
/*                                                                         */
/*  This obfuscated code was created by Javascript Obfuscator Free Version.*/
/*  Javascript Obfuscator Free Version can be downloaded here              */
/*  http://javascriptobfuscator.com                                        */
/*                                                                         */
/***************************************************************************/
var _$_3e76=["views/gettingBills.php","get","hide","#loading","","id","<tr class='danger'><td colspan='8'><center><b>No Bills Found !...</b></center></td></tr>","append","#bills","<tr onclick='showbill(this);'><td>","</td><td>","name","</td><td>Rs ","toLocaleString","amount","paid","balance","date","ddate","</td><td><span class='btn btn-xs btn-info'>","type","</span></td></tr>","getJSON","ready","-","split","html","val","#billno","#customer","#fdate","#tdate","Show all","999","00/00/0000","length","getTime","<tr onclick='showbill(this);' class='success'><td>","<tr class='danger'><td colspan='8'><center><b>No result found..!</b></center></td></tr>","innerHTML","cells","href","location","index.php?page=showBill&billno="];var db;$(document)[_$_3e76[23]](function(){var _0x130AA=_$_3e76[0];$[_$_3e76[22]](_0x130AA,function(_0x130F7){db= TAFFY(_0x130F7);var _0x13191=db()[_$_3e76[1]]();$(_$_3e76[3])[_$_3e76[2]]();if(_0x130F7== _$_3e76[4]|| (_0x13191[0][_$_3e76[5]]== null)){$(_$_3e76[8])[_$_3e76[7]](_$_3e76[6]);return};for(var _0x13144=0;_0x13144< 500;_0x13144++){$(_$_3e76[8])[_$_3e76[7]](_$_3e76[9]+ _0x13191[_0x13144][_$_3e76[5]]+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[11]]+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[14]])[_$_3e76[13]]()+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[15]])[_$_3e76[13]]()+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[16]])[_$_3e76[13]]()+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[17]]+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[18]]+ _$_3e76[19]+ _0x13191[_0x13144][_$_3e76[20]]+ _$_3e76[21])}})});function toDate(_0x13F1A){var _0x13F67=_0x13F1A[_$_3e76[25]](_$_3e76[24]);return  new Date(_0x13F67[2],_0x13F67[1]- 1,_0x13F67[0])}function filter(){$(_$_3e76[8])[_$_3e76[26]](_$_3e76[4]);var _0x13916=$(_$_3e76[28])[_$_3e76[27]]();var _0x13963=$(_$_3e76[29])[_$_3e76[27]]();var _0x13795=$(_$_3e76[30])[_$_3e76[27]]();var _0x139B0=$(_$_3e76[31])[_$_3e76[27]]();var _0x13191;if(!_0x13963|| _0x13963== _$_3e76[32]){_0x13963= _$_3e76[33]};if(_0x13916|| _0x13963!= _$_3e76[33]|| _0x13795!= _$_3e76[34]|| _0x139B0!= _$_3e76[34]){if(_0x13916|| _0x13963!= _$_3e76[33]|| _0x13795!= _$_3e76[34]&& _0x139B0== _$_3e76[34]){var _0x137E2=false;_0x13191= db()[_$_3e76[1]]();for(var _0x13144=0;_0x13144< _0x13191[_$_3e76[35]];_0x13144++){if(_0x13963== _0x13191[_0x13144][_$_3e76[11]]|| _0x13916== _0x13191[_0x13144][_$_3e76[5]]|| toDate(_0x13795)[_$_3e76[36]]()=== toDate(_0x13191[_0x13144][_$_3e76[17]])[_$_3e76[36]]()){_0x137E2= true;$(_$_3e76[8])[_$_3e76[7]](_$_3e76[37]+ _0x13191[_0x13144][_$_3e76[5]]+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[11]]+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[14]])[_$_3e76[13]]()+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[15]])[_$_3e76[13]]()+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[16]])[_$_3e76[13]]()+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[17]]+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[18]]+ _$_3e76[19]+ _0x13191[_0x13144][_$_3e76[20]]+ _$_3e76[21])}};if(!_0x137E2){$(_$_3e76[8])[_$_3e76[7]](_$_3e76[38])};return}else {if(_0x13795!= _$_3e76[34]&& _0x139B0!= _$_3e76[34]){var _0x137E2=false;_0x13191= db()[_$_3e76[1]]();var _0x13748=0;for(var _0x13144=0;_0x13144< _0x13191[_$_3e76[35]];_0x13144++){if(toDate(_0x13191[_0x13144][_$_3e76[17]])[_$_3e76[36]]()>= toDate(_0x13795)[_$_3e76[36]]()&& toDate(_0x13191[_0x13144][_$_3e76[17]])[_$_3e76[36]]()<= toDate(_0x139B0)[_$_3e76[36]]()){_0x137E2= true;$(_$_3e76[8])[_$_3e76[7]](_$_3e76[37]+ _0x13191[_0x13144][_$_3e76[5]]+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[11]]+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[14]])[_$_3e76[13]]()+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[15]])[_$_3e76[13]]()+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[16]])[_$_3e76[13]]()+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[17]]+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[18]]+ _$_3e76[19]+ _0x13191[_0x13144][_$_3e76[20]]+ _$_3e76[21])}};if(!_0x137E2){$(_$_3e76[8])[_$_3e76[7]](_$_3e76[38])};return}}}else {_0x13191= db()[_$_3e76[1]]();var _0x13748=0;for(var _0x13144=0;_0x13144< 500;_0x13144++){$(_$_3e76[8])[_$_3e76[7]](_$_3e76[9]+ _0x13191[_0x13144][_$_3e76[5]]+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[11]]+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[14]])[_$_3e76[13]]()+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[15]])[_$_3e76[13]]()+ _$_3e76[12]+ parseFloat(_0x13191[_0x13144][_$_3e76[16]])[_$_3e76[13]]()+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[17]]+ _$_3e76[10]+ _0x13191[_0x13144][_$_3e76[18]]+ _$_3e76[19]+ _0x13191[_0x13144][_$_3e76[20]]+ _$_3e76[21])}}}function showbill(_0x13E33){var _0x13493=_0x13E33[_$_3e76[40]][0][_$_3e76[39]];window[_$_3e76[42]][_$_3e76[41]]= _$_3e76[43]+ _0x13493}