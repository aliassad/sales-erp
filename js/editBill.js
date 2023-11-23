
var products;
$(document).ready(function(){

     var url = 'views/gettingProducts.php';
      $.getJSON(url,function(data){
            products=TAFFY(data);
//          $.each(data,function(index,data) {         
//        $('#product1').append('<option>'+data.des+'</option>');
//    });

   });
});    


var item=1; // Adding Dynamic rows in invoice 
$(document).ready(function(){

     
    var number=1;
$('.itemno').each(function() {
        $(this).html(number);
     number++;
});
     var i=number;
     $("#add_row").focus(function(){
         $('#invoice').append("<tr><td class='itemno' style='width:5%;' ></td><td  style='width:30%;'><select id='product"+i+"' onchange='loadProductDetail("+i+");' class='form-control'></select></td><td><input type='number'  id='rate"+i+"' placeholder='@' class='form-control' onkeyup='calAmount(this);'></td><td><input type='number'  id='unit"+i+"' placeholder='Qty' class='form-control' onkeyup='calAmount(this);'></td><td><input type='number' tabindex='-1'  id='disc"+i+"' placeholder='Discount' class='form-control' onkeyup='calAmount(this);'></td><td><input type='number' tabindex='-1' id='amount"+i+"'  class='form-control amt'  placeholder='' value='0' readonly></td> <td><button id='"+(i)+"' tabindex='-1' class='btn btn-danger glyphicon glyphicon-remove row-remove' onclick='delete_emp("+(i)+");' > </button></td></tr>");
      
         
         var prods=products().get();
         $('#product'+i).append("<option value=''>Select Product..</option>")
        for(var j=0;j<prods.length;j++)
        {
         $('#product'+i).append('<option>'+prods[j]['des']+'</option>');
        }
         $('#product'+i).focus();
         
var number=1;
$('.itemno').each(function() {
        $(this).html(number);
     number++;
});

         i++; 
         
   dis();
  });
    

});
function loadProductDetail(id)
{

    var prods=products({des:$('#product'+id).val()}).get();
    $('#rate'+id).val(prods[0]['sprice']);
    $('#disc'+id).val(prods[0]['disc']);
    $('#unit'+id).val(1);
    $('#unit'+id).focus();
    $('#unit'+id).keyup();
}


// Deleting rows of invoice 
function delete_emp(id)
{        var grandTotal=0;
         
//       swal({
//  title: "Are you sure?",
//  text: "You will not be able to recover this line item!",
//  type: "warning",
//  showCancelButton: true,
//  confirmButtonColor: "#DD6B55",
//  cancelButtonText: "No, cancel plz!",           
//  confirmButtonText: "Yes,delete it!",
//  closeOnConfirm: false,
//  closeOnCancel: false
//},
//function(isConfirm){
//  if (isConfirm) 
//      {
//          swal({
//  title:"Deleting",
//  type: "warning",
//  text:"Please Wait :)",
//  timer: 1300,
//  showConfirmButton: false
//});
      var row =document.getElementById(id);
  
                            row.parentNode.parentNode.remove(row);
                            var number=1;   
                                   
                            $('.itemno').each(function() {

                            $(this).html(number);
                            number++;
                            });               
                 
                   $('.amt').each(function() {
                        var price = $(this).val();
                      grandTotal=parseFloat(price)+grandTotal;
                                          });         
                  var newtotal =document.getElementById("total");
                    newtotal.value=grandTotal;
                    var ftotal =document.getElementById("ftotal");
                    ftotal.value=grandTotal;
             dis();
         //swal({
//  title:"Deleted!",
//  type: "success",
//  text: "Your line Item has been deleted.",
//  timer: 1400,
//  showConfirmButton: false
//});
//  } else {
//        swal({
//  title:"Cancelled",
//  type: "error",
//  text: "Your line Item is safe :)",
//  timer: 1200,
//  showConfirmButton: false
//});
//  }
//});
                                  
                          
                                            
}

//Calculating Grand Total 
var flag=true;
var c2="";
function calAmount(row)
{


    var newrow=row.parentNode.parentNode;
    var amount=0;
    var grandTotal=0;
    var rate=newrow.cells[2].children[0].value;
    var nunit=newrow.cells[3].children[0].value;
    var disc=newrow.cells[4].children[0].value;
    var prod=newrow.cells[1].children[0].value;

    if(nunit=="")
    {
        return;
    }
    if(nunit<1) {
        newrow.cells[3].children[0].value = 1;
        nunit=1;
    }

    var tproduct;
    var  tunit=0;

    $('#invoice tr').each(function(row, tr)
    {
        tproduct=$(tr).find('td:eq(1)').children().val();
        if(tproduct==prod)
        {
            tunit=parseInt(tunit)+parseInt($(tr).find('td:eq(3)').children().val());
        }

    });

    var pstock=products().filter([{des:{like:prod}}]).get();


    var rstock=parseInt(pstock[0]['stock']);


    if($('#intitle').val()=='Invoice')
    {


        if ((rstock - tunit) < 0) {


            swal({
                title: "Stock is less",
                type: "warning",
                text: "Stock value: " + rstock + ". Unit is greater then product stock",
                timer: 2000,
                showConfirmButton: false

            });
            //newrow.cells[3].children[0].value='';
            //return;
        }


    }

    if(rate&&nunit)
    {
        amount=rate*nunit;
        amount=amount-(amount/disc);
        newrow.cells[5].children[0].value=amount;
    }
    else
    {
        newrow.cells[5].children[0].value=0;
    }

    $('.amt').each(function() {

        var price = $(this).val();
        grandTotal=parseFloat(price)+grandTotal;
    });



    var newtotal =document.getElementById("total");
    newtotal.value=grandTotal;
    var ftotal =document.getElementById("ftotal");
    ftotal.value=grandTotal;
    dis();
}



//Calculating Discount
function dis()
{


 var newrow=document.getElementById('discount');
     
       var grandTotal=0;  
       var paid=newrow.cells[0].children[0].value;
       var dis=newrow.cells[1].children[0].value;
       var r=0.0;
        $('.amt').each(function() {

               var price = $(this).val();
              grandTotal=parseFloat(price)+grandTotal;
        });

       if(paid&&dis)
       {
           r=parseFloat(paid)+parseFloat(dis);
       }
     else if(dis)
     {r=dis;
     }
    else if(paid)
     {r=paid;
     }
    else {r=0.0;}     
    grandTotal=parseFloat(grandTotal)-parseFloat(r);

var newtotal =document.getElementById("total");
newtotal.value=grandTotal;

}

//Making JSON Array of Invoice
function storeValues()
{
    var TableData = new Array();
    $('#invoice tr').each(function(row, tr){
        TableData[row]={
            "no" : $(tr).find('td:eq(0)').text()
            , "product" : $(tr).find('td:eq(1)').children().val()
            , "rate" : $(tr).find('td:eq(2)').children().val()
            , "unit" : $(tr).find('td:eq(3)').children().val()
            , "disc" : $(tr).find('td:eq(4)').children().val()
            , "amount" : $(tr).find('td:eq(5)').children().val()
        }    
    }); 
//    TableData.shift();  // first row will be empty - so remove
    return TableData;
}


//Saving Invoice in DB
//function saveData() {
//  var TableData;
//  TableData = $.toJSON(storeValues());
//  $.ajax({
//    type: "POST",
//    url: "views/updateInvoice.php",
//    data: {
//      type: $('#intitle').val(),
//      notes: $('#notes').val(),
//      customer: $('#cuname').val(),
//      billid: $('#invNo').val(),
//      ndate: $('#ddate').val(),
//      duedate: $('#duedate').val(),
//      pTableData: TableData,
//      total: $('#ftotal').val(),
//      paid: $('#paid').val(),
//      discount: $('#discount1').val(),
//      balance: $('#total').val()
//    },
//    success: function (msg) {
//
//      swal({
//        title: "Bill Updated & Saved!",
//        type: "success",
//        text: "Successfully :)",
//        timer: 1300,
//        showConfirmButton: false
//      });
//
//    }
//  });
//
//}



//function stock()
//{
//  $.ajax({
//           type:"POST",
//           url:"views/updateStock.php",
//           data:{billid:$('#invNo').val(),type:$('#intitle').val()},
//           success: function(msg){ }
//          });
//
//}


function saveInvoice()
{  
       swal({
  title: "Are you sure?",
  text: "You will not be able to recover the Previous Bill !",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  cancelButtonText: "No, cancel plz!",           
  confirmButtonText: "Yes,Update it!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {  
      
        swal({
  title:"Updating",
  type: "warning",
  text:"Please Wait :)",
  timer: 3000,
  showConfirmButton: false
});
      
     var TableData;
  TableData = $.toJSON(storeValues());

  $.ajax({
    type: "POST",
    url: "views/editInvoice.php",
    data: {
      type: $('#intitle').val(),
      notes: $('#notes').val(),
      customer: $('#cuname').val(),
      billid: $('#invNo').val(),
      ndate: $('#ddate').val(),
      duedate: $('#duedate').val(),
      pTableData: TableData,
      total: $('#ftotal').val(),
      paid: $('#paid').val(),
      discount: $('#discount1').val(),
      balance: $('#total').val()
    },
    success: function (msg) {
      swal({
        title: "Bill Updated & Saved!",
        type: "success",
        text: "Successfully :)",
        timer:3000,
        showConfirmButton: false
      });
 setTimeout("location.href='index.php?page=editBill&billno="+$('#invNo').val()+"'",3000);
    }
  });
     
  } else {
        swal({
  title:"Cancelled",
  type: "error",
  text:"Your Bill is not Updated! Bill is safe :)",
  timer: 1300,
  showConfirmButton: false
});
  }
}); 

}


//Saving  Invoice in DB with a print.
function saveprintInvoice()
{
saveData();
setTimeout("location.href='views/printInvoice.php?billid="+$('#invNo').val()+"'",1500);
}

//function clearBill()
//{ 
//    $.ajax({
//           type:"POST",
//           url:"views/clearBill.php",
//           data:{billid:$('#invNo').val()},
//           success: function(msg){}
//          });
//
//}