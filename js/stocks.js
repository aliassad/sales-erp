var db;
$(document).ready(function(){

     var url = 'views/gettingProducts.php';
      $.getJSON(url,function(data){
            db=TAFFY(data);
          if (data == "") {
              $('#products').append("<tr class='danger'><td colspan='9'><center><b>No Products Found !...</b></center></td></tr>");
              return;
          }
          $.each(data,function(index,data) {
                    $('#products').append('<tr><td>'+data.id+'</td><td>'+data.des+'</td><td>'+data.stock+'</td><td>Rs '+parseFloat(data.sprice).toLocaleString()+'</td><td>Rs '+parseFloat(data.pprice).toLocaleString()+'</td><td>'+parseFloat(data.disc).toLocaleString()+' %</td><td>'+data.minstock+'</td><td><a class="btn btn-primary btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="editProduct(this);"><i class="fa fa-edit"></i>&nbsp;Edit</a></td><td><a class="btn btn-danger btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="deleteProduct(this);"><i class=" fa fa-trash"></i>&nbsp;Delete</a></td></tr>');
    });

   });
});
                
function filter(){
    
      $('#products').html("");
      var pid=$('#pno').val();
      var pname=$('#pname').val();
      var rows;
    

       if(!pname||pname=="Show all")
          pname="999";

                 
      if(pid||pname!="999"){
                      
      rows=db().filter([{id:pid},{des:{likenocase:pname}}]).get();
       if(rows.length==0)
       {
           $('#products').append("<tr class='danger' ><td colspan='9'><center><b>No result found..!</b></center></td></tr>");
       }
      else
       {
         for(var i=0;i<rows.length;i++)
             $('#products').append('<tr class="success"><td>'+rows[i]['id']+'</td><td>'+rows[i]['des']+'</td><td>'+rows[i]['stock']+'</td><td>Rs '+parseFloat(rows[i]['sprice']).toLocaleString()+'</td><td>Rs '+parseFloat(rows[i]['pprice']).toLocaleString()+'</td><td>'+parseFloat(rows[i]['disc']).toLocaleString()+' %</td><td>'+rows[i]['minstock']+'</td><td><a class="btn btn-primary btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="editProduct(this);"><i class="fa fa-edit"></i>&nbsp;Edit</a></td><td><a class="btn btn-danger btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="deleteProduct(this);"><i class=" fa fa-trash"></i>&nbsp;Delete</a></td></tr>');
     
       }
      }
    else
    {   
        rows=db().get();
           for(var i=0;i<rows.length;i++)
               $('#products').append('<tr><td>'+rows[i]['id']+'</td><td>'+rows[i]['des']+'</td><td>'+rows[i]['stock']+'</td><td>Rs '+parseFloat(rows[i]['sprice']).toLocaleString()+'</td><td>Rs '+parseFloat(rows[i]['pprice']).toLocaleString()+'</td><td>'+parseFloat(rows[i]['disc']).toLocaleString()+' %</td><td>'+rows[i]['minstock']+'</td><td><a class="btn btn-primary btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="editProduct(this);"><i class="fa fa-edit"></i>&nbsp;Edit</a></td><td><a class="btn btn-danger btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="deleteProduct(this);"><i class=" fa fa-trash"></i>&nbsp;Delete</a></td></tr>');
    }


    }

function saveProduct(){


  if(!$('#discrip').val())
  {
      swal("Input Error","Please enter product name","error");
      return;
  }

                                 $.ajax({
                                        url: "views/addProduct.php",
                                        data:{dis:$('#discrip').val(),stock:$('#stock').val(),sprice:$('#sprice').val(),pprice:$('#pprice').val(),disc:$('#disc').val(),minstock:$('#minstock').val()},
                                        type:"post",
                                            success: function(msg){
                                               $("#newProductModal").modal('hide');
                                                swal({
                                              title:"Saved!",
                                              type: "success",
                                              text: "New Product added successfully:)",
                                              timer:2000,
                                              showConfirmButton: true
                                            
                                                });
                                               setTimeout('location.href="index.php?page=stock"',1500);
                                         }
                                 });
                                                 
                            
 }
function clearModal()
{

    $('#newProductModal').modal('show');
  $('#discrip').val('');
  $('#discrip').focus();
  $('#stock').val('');
  $('#sprice').val('');
  $('#pprice').val('');



}

 function deleteProduct(id)
{
    swal({
  title: "Are you sure?",
  text: "You will not be able to recover this  Product !",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  cancelButtonText: "No, cancel plz!",
  confirmButtonText: "Yes,delete it!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
              swal({
  title:"Deleting",
  type: "warning",
  text: "Deleting the Product.....",
  timer: 1200,
  showConfirmButton: false
});
                   var rid=id.parentNode.parentNode.children[0].innerHTML;
    $.ajax({
        url:'views/deleteProduct.php',
        type:"POST",
        data:{id:rid},
        success:function(msg)
        {
             var d = id.parentNode.parentNode.rowIndex;
      document.getElementById('aPa').deleteRow(d); 
            
        }
    });             

                    swal({
  title:"Product Deleted",
  type: "success",
  text: "Transaction deleted successfully!",
  timer: 1200,
  showConfirmButton: false
});  

  } else {
        swal({
  title:"Cancelled",
  type: "error",
  text: "Your Product is safe :)",
  timer: 1200,
  showConfirmButton: false
});
  }
});

    
}

function editProduct(id)
{

    $('#dtitle').html(id.parentNode.parentNode.children[1].innerHTML);
    $('#epname').val(id.parentNode.parentNode.children[1].innerHTML);
    $('#estock').val(id.parentNode.parentNode.children[2].innerHTML);
    $('#esprice').val(id.parentNode.parentNode.children[3].innerHTML.replace(/[^0-9\.\-]+/g,""));
    $('#epprice').val(id.parentNode.parentNode.children[4].innerHTML.replace(/[^0-9\.\-]+/g,""));
    $('#ediscount').val(id.parentNode.parentNode.children[5].innerHTML.replace(/[^0-9\.\-]+/g,""));
    $('#eminstock').val(id.parentNode.parentNode.children[6].innerHTML);
    $('#editStockModal').modal('show');


}

function saveEditProduct()
{



    if(!$('#epname').val()||!$('#estock').val()||!$('#esprice').val()||!$('#epprice').val())
    {
        swal("Input Error","Please fill all the fields","error");
        return;
    }


    $.ajax({
        url: "views/editProduct.php",
        data:{title:$('#dtitle').html(),dis:$('#epname').val(),stock:$('#estock').val(),sprice:$('#esprice').val(),pprice:$('#epprice').val(),disc:$('#ediscount').val(),minstock:$('#eminstock').val()},
        type:"post",
        success: function(msg){
            $("#newProductModal").modal('hide');
            swal({
                title:"Saved!",
                type: "success",
                text: "Product Updated successfully:)",
                timer:2000,
                showConfirmButton: true

            });
            setTimeout('location.href="index.php?page=stock"',1500);
        }
    });

}