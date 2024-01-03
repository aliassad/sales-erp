var db;
$(document).ready(function(){
      $('#productions').html('<tr id="loading" ><td colspan="10"><center > <img src="img/loading.gif"> </center></td></tr>');
     var url = 'views/gettingProduction.php';
      $.getJSON(url,function(data){
          var cl='danger';
          var txt='Pending';
          db=TAFFY(data);
         var rows=db().get();
            $('#productions').html('');
        if (data==""||(rows[0]['id']==null)){
            $('#productions').append("<tr class='danger'><td colspan='10'><center><b>No Orders Found !...</b></center></td></tr>");
            return;
        }   
        for(var i=0;i<500;i++){
            if(rows[i]['status']==0)
            {
                cl='danger';
                txt='Pending';
            }
            else 
            {
                cl='success';
                txt='Completed';
            }
          $('#productions').append("<tr><td>"+rows[i]['id']+"</td><td>"+rows[i]['iid']+"</td><td>"+rows[i]['name']+"</td><td>"+rows[i]['product']+"</td><td>"+rows[i]['des']+"</td><td>"+rows[i]['unit']+"</td><td>"+rows[i]['date']+"</td><td><button class='btn btn-sm btn-info' onclick='loadNotes(this);'>Notes</button></td><td><button class='btn btn-sm btn-"+cl+"'>"+txt+"</button></td><td><button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#changeModal'  onclick='load(this);'><i class='fa fa-edit'></i>Change</button></td></tr>"); 
        }
   });

});
                

function filter(){
    
      $('#productions').html("");
      var sid=$('#billno').val();
      var sname=$('#customer').val();
      var fdate=$('#fdate').val();
      var tdate=$('#tdate').val();
      var rows;
    
  
  
  
      if(!sname||sname=="Show all")
        sname="999";
       
         if(!fdate)
         { fdate="00/00/0000";
           tdate="00/00/0000";
         }
         else
         if(!tdate)        
         {tdate="00/00/0000";}
                 
      if(sid||sname!="999"||fdate!="00/00/0000"||tdate!="00/00/0000"){
         
         if(fdate!="00/00/0000"&&tdate=="00/00/0000")
         {rows=db().filter([{name:{like:sname}},{id:sid},{date:fdate}]).get();}
         else if(fdate!="00/00/0000"&&tdate!="00/00/0000")  
         rows=db().filter([{name:{like:sname}},{id:sid},{date:{gte:fdate,lte:tdate}}]).get(); 
         else 
         rows=db().filter([{name:{like:sname}},{id:sid}]).get();              

           
       if(rows.length==0)
       {
           $('#productions').append("<tr class='danger'><td colspan='10'><center><b>No result found..!</b></center></td></tr>")
       }
      else
       {
         for(var i=0;i<rows.length;i++){
          if(rows[i]['status']==0)
            {
                cl='danger';
                txt='Pending';
            }
            else 
            {
                cl='success';
                txt='Completed';
            }
          $('#productions').append("<tr class='success'><td>"+rows[i]['id']+"</td><td>"+rows[i]['iid']+"</td><td>"+rows[i]['name']+"</td><td>"+rows[i]['product']+"</td><td>"+rows[i]['des']+"</td><td>"+rows[i]['unit']+"</td><td>"+rows[i]['date']+"</td><td><button class='btn btn-sm btn-info' onclick='loadNotes(this);'>Notes</button></td><td><button class='btn btn-sm btn-"+cl+"'>"+txt+"</button></td><td><button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#changeModal'  onclick='load(this);'><i class='fa fa-edit'></i>Change</button></td></tr>"); 
         }
       }
      
      
      }
    else
    {   
        rows=db().get();
        for(var i=0;i<500;i++){
            if(rows[i]['status']==0)
            {
                cl='danger';
                txt='Pending';
            }
            else 
            {
                cl='success';
                txt='Completed';
            }
          $('#productions').append("<tr><td>"+rows[i]['id']+"</td><td>"+rows[i]['iid']+"</td><td>"+rows[i]['name']+"</td><td>"+rows[i]['product']+"</td><td>"+rows[i]['des']+"</td><td>"+rows[i]['unit']+"</td><td>"+rows[i]['date']+"</td><td><button class='btn btn-sm btn-info' onclick='loadNotes(this);'>Notes</button></td><td><button class='btn btn-sm btn-"+cl+"'>"+txt+"</button></td><td><button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#changeModal'  onclick='load(this);'><i class='fa fa-edit'></i>Change</button></td></tr>"); 
            
        }
              
    }
    }


function load(id)
{
    var s=id.parentNode.parentNode.children[7].children[0].innerHTML;
    if(s=='Pending')
        s=0;
    else
        s=1;
        
    $('#oid').val(id.parentNode.parentNode.children[0].innerHTML);
    $('#oiid').val(id.parentNode.parentNode.children[1].innerHTML);
    $('#ostatus').val(s);

}
function loadNotes(id)
{
   var s=id.parentNode.parentNode.children[0].innerHTML;
    var row=db().filter([{id:s}]).get();
    
 $('#bnotes').html(row[0]['notes']);
 $('#notesModal').modal('show');
}


function change()
{
     

    swal({
  title: "Are you sure?",
  text: "You can be able to recover this  Data !",
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
      $.ajax({
        url:'views/ChangeStatus.php',
        type:"POST",
        data:{rid:$('#oiid').val(),st:$('#ostatus').val()},
        success:function(msg)
        { 
//             alert(msg);
             swal({
                                title:"Status Updated!",
                                type: "success",
                                text: "Your action is done.",
                                timer: 1200,
                                showConfirmButton: false
                                });
             setTimeout('location.href="index.php?page=production"',1500);
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



function storeValues()
{
    var TableData = new Array();
    $('#productions tr').each(function(row, tr){
        TableData[row]={
            "id" : $(tr).find('td:eq(0)').html()
            , "iid" : $(tr).find('td:eq(1)').html()
            , "name" : $(tr).find('td:eq(2)').html()
            , "product" : $(tr).find('td:eq(3)').html()
            , "dis" : $(tr).find('td:eq(4)').html()
            , "unit" : $(tr).find('td:eq(5)').html()
            , "date" : $(tr).find('td:eq(6)').html()
            , "status" : $(tr).find('td:eq(8)').children().html()
        
        }
    }); 

    var fTableData = $.toJSON(TableData); 
  window.location.href="views/printProductionSheet.php?TableData="+fTableData;
}