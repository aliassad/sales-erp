
var db;
$(document).ready(function () {


    var url = 'views/gettingAccounts.php';
    $.getJSON(url, function (data) {
        db = TAFFY(data);
        var rows = db().get();
        if (data == "" || (rows[0]['acode'] == null)) {
            $('#accounts').append("<tr class='danger'><td colspan='4'><center><b>No Accounts Found !...</b></center></td></tr>");
            return;
        }

        for (var i = 0; i < 500; i++)
            $('#accounts').append("<tr onclick='showAccount(this);'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['acode'] + "</td><td>" + rows[i]['atype'] + "</td><td>" + rows[i]['acurrency'] + "</td></tr>");

    });


     url = 'views/getAccountTypes.php';
    $.getJSON(url, function (data) {

        $.each(data, function (index, data) {
            $('#acc_type').append("<option value="+data.id+">"+data.type+"</option>");
        });




    });
    
        url = 'views/getCurrency.php';
    $.getJSON(url, function (data) {

        $.each(data, function (index, data) {
            $('#acc_currency').append("<option value="+data.id+">"+data.code+"</option>");
        });




    });


});

var products;
$(document).ready(function(){

    var url = 'views/gettingProducts.php';
    $.getJSON(url,function(data){
        products=TAFFY(data);
        $('#vproduct').append("<option value=''>Select Product..</option>");
        $.each(data,function(index,data) {
            $('#vproduct').append('<option>'+data.des+'</option>');
        });

    });
});

function loadProductDetail()
{

    var prods=products({des:$('#vproduct').val()}).get();
    $('#vrate').val(prods[0]['pprice']);
    $('#vqty').val(1);
    $('#vqty').focus();
}





function saveAccount()
{


if(!$("#acc_code").val()||!$('#acc_type').val()||!$('#acc_currency').val())
{
 swal("Input Error!","Please fill all required fields","error");
 return;
}


     $.ajax({
                  url:"views/addAccount.php",
                  type: "POST",           
                  data: new FormData($('#accountform')[0]),
                  contentType:false,       
                  cache: false,             
                  processData:false,    
                  success:function (msg) {
                        
                   if (msg == 'true') {
                    $('#newAccountModal').modal('hide');
                    swal({
                     title: "Saved!",
                     type: "success",
                     text: "New Account is added successfully:)",
                     timer:2000,
                     showConfirmButton:true
                    });
                    setTimeout("location.href='index.php?page=accounts'",2000);
                   }
                  }
                  
                  });
                   
                         
                            
 }
      

















            
function filter(){
    
      $('#accounts').html("");
      var id=$('#aid').val();
      var type=$('#btype').val();
      var rows;
  
      if(!type||type=="Show all")
        type="999";
       
                 
      if(id||type!="999"){
         
         if(id)
         {rows=db().filter([{id:{like:id}}]).get();} 
         else 
         rows=db().filter([{atype:{like:type}}]).get();              

           
       if(rows.length==0)
       {
           $('#accounts').append("<tr class='danger'><td colspan='4'><center><b>No result found..!</b></center></td></tr>")
       }
      else
       {
         for(var i=0;i<rows.length;i++)
        $('#accounts').append("<tr class='success' onclick='showAccount(this);'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['acode'] + "</td><td>" + rows[i]['atype'] + "</td><td>" + rows[i]['acurrency'] + "</td></tr>");
     
       }
      
      
      }
    else
    {   
        rows=db().get();
        for(var i=0;i<500;i++)
          $('#accounts').append("<tr onclick='showAccount(this);'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['acode'] + "</td><td>" + rows[i]['atype'] + "</td><td>" + rows[i]['acurrency'] + "</td></tr>");     
    }
    }

function showAccount(row)
{
var id=row.cells[0].innerHTML;
window.location.href="index.php?page=showAccount&Accountno="+id;
}

function saveHead()
{
var name=$('#hname').val();
    if(!$('#hname').val())
    {
        swal('Input Error!','Please Enter Head Name..','error');
        return;
    }
    $('#hname').val('');
   


     $.ajax({
                  url:"views/addAccountHead.php",
                  type: "POST",           
                  data: {hname:name},  
                  success:function (msg) {
                        
                   if (msg == 'true') {

                    swal({
                     title: "Saved!",
                     type: "success",
                     text: "New Account Head is added successfully:)",
                     timer:2000,
                     showConfirmButton:true
                    });
                    setTimeout("location.href='index.php?page=accounts'",2000);

                   }
                         else
                            { alert(msg);
                            }
                      
                  }
          
                  
                  });
                   


}


function deleteArow(id)
{

   var rowid=id.parentNode.parentNode.children[0].innerHTML;

    
    
    swal({
  title: "Are you sure?",
  text: "You will not be able to recover this  Data !",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  cancelButtonText: "No, cancel plz!",           
  confirmButtonText: "Yes,delete it!",
  closeOnConfirm: false,
  closeOnCancel: false   
},
function(isConfirm){
  if (isConfirm) {                $.ajax({
        url:'views/deleteAccountHead.php',
        type:"POST",
        data:{rid:rowid},
        success:function(msg)
        { 
       
         var d = id.parentNode.parentNode.rowIndex;
      document.getElementById('accountHead').deleteRow(d);  
             swal({
                                title:"Data Deleted!",
                                type: "success",
                                text: "Your action is done.",
                                timer: 1200,
                                showConfirmButton: false
                                });
             setTimeout('location.href="index.php?page=accounts"',1500);
        }
    });

                     
  } else {
        swal({
  title:"Cancelled",
  type: "error",
  text: "Your data is safe :)",
  timer: 1200,
  showConfirmButton: false
});
  }
});


}





function saveV()
{


    $.ajax({
        url:'views/addTransaction.php',
        type:"POST",
        data:{aid:$('#vatype').val(),dis:$('#vdis').val(),debit:$('#vreceived').val(),credit:$('#vpaid').val(),tdate:$('#avdate').val()},
        success:function(msg)
        {
            //alert(msg);

            var url = 'views/gettingTr.php?id='+msg;
            $.getJSON(url, function (data) {
                $.each(data, function (index, data) {
                    $('#avoucher').append("<tr><td>"+data.id+"</td><td>"+data.name+"</td><td>"+data.dis+"</td><td>"+data.credit+"</td><td>"+data.debit+"</td><td><a class='btn btn-sm btn-danger glyphicon glyphicon-remove row-remove' style='padding-top: 0px;border-bottom-width: 0px;padding-bottom: 0px;border-top-width: 0px;'  onclick='deletetr(this);'></a></td></tr>");
                });
            });
        }
    });
    $('#vdis').val('');
    $('#vpaid').val('');
    $('#vreceived').val('');
    $('[data-id="vatype"]').focus();

}
function deletetr(id)
{
    var rid=id.parentNode.parentNode.children[0].innerHTML;
    $.ajax({
        url:'views/deleteTransaction.php',
        type:"POST",
        data:{id:rid},
        success:function(msg)
        {
             var d = id.parentNode.parentNode.rowIndex;
      document.getElementById('ava').deleteRow(d); 
            
        }
    });
    
}



function saveVendorVoucher()
{
   
    if(!$("#vid").val())
    {
         swal("Vendor not selected!","Please Select the vendor first.","error");
            return;
    }
        else if($("#avoucher").html()=="")
    {
        swal("No data Entered!","Please Enter any data first.","error");
            return;
    }
    
            
    var TableData = new Array();
    $('#vendorvoucher tr').each(function(row, tr){
        TableData[row]={
             "product" : $(tr).find('td:eq(1)').html() 
            , "rate" : $(tr).find('td:eq(2)').html()
            , "qty" : $(tr).find('td:eq(3)').html()
            
        }

    }); 

fTableData = $.toJSON(TableData);
    // alert(fTableData);
 $.ajax({
    type: "POST",
    url:"views/saveVendorVoucher.php",
    data: {vid:$("#vid").val(),pTableData:fTableData,payment:$("#vpayment").val(),bno:$('#bno').val(),vdate:$('#vdate').val(),ptype:$("#ptype").val(),pdetail:$("#pdetail").val(),advance:$("#vad").val(),dadvance:$("#vdad").val()},
    success: function(msg){
               // alert(msg);
                     swal({
                                title:"Voucher Saved!!",
                                type: "success",
                                text: "Your action is done.",
                                timer: 1200,
                                showConfirmButton: false
                                });
        $("#avoucher").html("");

        return;
    }
        });






}

var prates;
function getVendorData()
{



    var url = 'views/VendorData.php?id=' + $("#vid").val();
    
      $.getJSON(url,function(data){
            
          $.each(data,function(index,data) {         
                    $("#padvance").val(data.padvance);
                    $("#ppayment").val(data.ppayment);
    });

   });
$("#vproduct").focus();

}

function calpay()
{

    $pay = 0; 
    $ad = 0;
    $dad = 0;

    if ($('#vpayment').val())
        $pay = $('#vpayment').val();

    if ($('#vad').val())
        $ad = $('#vad').val();

    if ($('#vdad').val())
        $dad = $('#vdad').val();


    $('#fpay').val(parseFloat($pay) + parseFloat( parseFloat($ad) - parseFloat($dad) ));




}






function saveVo()
{

   
    
if(!$('#vproduct').val()||!$('#vqty').val()||!$('#vrate').val())
{
     swal("Input Error!","Please fill all required fields","error");
return;
}
    //alert($('#vproduct').val());


 $('#vendorvoucher').append("<tr><td class='itemno'></td><td>"+$('#vproduct').val()+"</td><td>"+$('#vrate').val()+"</td><td>"+$('#vqty').val()+"</td><td class='amt'>"+parseFloat($('#vqty').val())*parseFloat($('#vrate').val())+"</td><td><a style='padding: 2px 6px;' class='btn btn-danger glyphicon glyphicon-remove row-remove'  onclick='deletetrV(this);'></a></td></tr>"); 
   
    //$('#vrate').val('');
    $('#vqty').val('');
    $('#vproduct').val('');
    $('#vproduct').focus();

    
     var number=1;                 
                            $('.itemno').each(function() {

                            $(this).html(number);
                            number++;
                            });    
    
    
     var grandTotal=0;
 $('.amt').each(function() {
                        var price = $(this).html();
                      grandTotal=parseFloat(price)+grandTotal;
                                          }); 
 
                  var newtotal =document.getElementById("totalpayment");
                    newtotal.value=grandTotal;                                       

}
function deletetrV(id)
{        var grandTotal=0;


                           id.parentNode.parentNode.remove(id);
 
 
                            var number=1;                 
                            $('.itemno').each(function() {

                            $(this).html(number);
                            number++;
                            });               
                 

      
                   $('.amt').each(function() {
                        var price = $(this).html();
                      grandTotal=parseFloat(price)+grandTotal;
                                          }); 
 
                  var newtotal =document.getElementById("totalpayment");
                    newtotal.value=grandTotal;
                     
}


function getRate()
{
    row=prates().filter([{name:{likenocase:$("#vproduct").val()}}]).get();
  
    
    if(row.length!=0){

    $('#vrate').val(row[0]['rate']);
    $('#vqty').focus();    
    }
}



$("#vid").change( function(){

$('[data-id="vproduct"]').focus();
});

 $('#newPaymentVoucher').on('shown.bs.modal', function () {
    $('[data-id="vid"]').focus();
       
}); 



 $('#newAccountVoucher').on('shown.bs.modal', function () {
    $('[data-id="vatype"]').focus();
       
}); 

$('#vatype').change(function () {
    $('#vdis').focus(); 
}); 



$("#btn_e").keydown(function (e) {    
  if (e.which == 9) {       
    $('[data-id="vatype"]').focus();
    e.preventDefault();
  }
});

$("#btn_close").keydown(function (e) {    
  if (e.which == 9) {       
     $('[data-id="vid"]').focus();
    e.preventDefault();
  }
});

$("#btn_close").keydown(function (e) {    
  if (e.which == 9) {       
     $('[data-id="mname"]').focus();
    e.preventDefault();
  }
});


$("#entry").keydown(function (e) {    
  if (e.which == 9) {       
    $("#vproduct").focus();
    e.preventDefault();
  }
});
