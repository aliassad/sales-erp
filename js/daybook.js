var db1;
function loadDetails(){
    
$('#bankList').html("");
  var url = 'views/gettingBankDetails.php';
    
      $.getJSON(url,function(data){
          db1=TAFFY(data);
         var rows=db1().get();
        if (data==""||(rows[0]['id']==null)){
            
            $('#bankList').append("<tr class='danger'><td colspan='5'><center><b>No Banks Found !...</b></center></td></tr>");
            return;
        }    
        for(var i=0;i<500;i++){
          $('#bankList').append("<tr><td>"+rows[i]['id']+"</td><td class='nocenter'>"+rows[i]['acno']+"</td><td class='nocenter'>Rs "+parseFloat(rows[i]['debit']).toLocaleString()+"</td><td class='nocenter'>Rs "+parseFloat(rows[i]['credit']).toLocaleString()+"</td><td>"+(parseFloat(rows[i]['obalance'])+(parseFloat(rows[i]['credit'])-parseFloat(rows[i]['debit']))).toLocaleString()+"</td></tr>");  
       }

   });
}

function filterbank(){
    
      $('#bankList').html("");
      var name=$('#bankname').val();
   
    if(name){
        
        
       
        rows=db1().filter([{acno:{likenocase:name}}]).get();
       if(rows.length==0)
       {
           $('#bankList').append("<tr class='danger'><td colspan='5'><center><b>No result found..!</b></center></td></tr>")
       }
      else
       {
         for(var i=0;i<rows.length;i++)
          $('#bankList').append("<tr class='success'><td>"+rows[i]['id']+"</td><td class='nocenter'>"+rows[i]['acno']+"</td><td class='nocenter'>Rs "+parseFloat(rows[i]['debit']).toLocaleString()+"</td><td class='nocenter'>Rs "+parseFloat(rows[i]['credit']).toLocaleString()+"</td><td>"+(parseFloat(rows[i]['obalance'])+(parseFloat(rows[i]['debit'])-parseFloat(rows[i]['credit']))).toLocaleString()+"</td></tr>");       
       }
      
      }
    else
    {   
        rows=db1().get();
        for(var i=0;i<500;i++)
     $('#bankList').append("<tr><td>"+rows[i]['id']+"</td><td class='nocenter'>"+rows[i]['acno']+"</td><td class='nocenter'>Rs "+parseFloat(rows[i]['debit']).toLocaleString()+"</td><td class='nocenter'>Rs "+parseFloat(rows[i]['credit']).toLocaleString()+"</td><td>"+(parseFloat(rows[i]['obalance'])+(parseFloat(rows[i]['debit'])-parseFloat(rows[i]['credit']))).toLocaleString()+"</td></tr>");      
    }
    
}



var db;
function loadData()
{
    
    
    
 if(!$('#fdate').val()||!$('#tdate').val())
   return;
    
      loadpre();

$('#dayTransactions').html('<tr id="loading" style="display:none;" ><td colspan="5"><center > <img src="img/loading.gif"> </center></td></tr>');
     $('#loading').show();
  var url = 'views/gettingDayTransactions.php?fdate='+$('#fdate').val()+'&tdate='+$('#tdate').val();
    console.log(url);
      $.getJSON(url,function(data){

          console.log(data);
          var $tdebit=0;
          var $tcredit=0;
         db=TAFFY(data);
         var rows=db().get();
        if (data==""||(rows[0]['id']==null)){
               
            $('#dayTransactions').append("<tr class='danger'><td colspan='5'><center><b>No Transactions Found !...</b></center></td></tr>");
             $('#totalcash').val(0);
             $('#totaldebit').val(0);
          $('#totalcredit').val(0);
            return;
        }   
          var sorteddata=db().order("credit asec").get(); // sorts by col1 then col2
         
          var i=1;
          $.each(sorteddata,function(index,data){

            $tcredit+=parseFloat(data.credit);
            $tdebit+=parseFloat(data.debit);
       
//            <td class='nocenter'>"+data.date+"</td>
          $('#dayTransactions').append("<tr><td>"+i+"</td><td class='nocenter'>"+data.dis+"</td><td class='nocenter'>Rs "+parseFloat(data.credit).toLocaleString()+"</td><td class='nocenter'>Rs "+parseFloat(data.debit).toLocaleString()+"</td></tr>");  
            i++;
          });
             
          var daycash=0;
           $('#totalcash').val(0);
          $('#totaldebit').val(0);
          $('#totalcredit').val(0);
         if($('#daycashn').val())
          daycash=$('#daycashn').val();
         $('#totalcredit').val('Rs '+parseFloat($tcredit).toLocaleString()); 
         $('#totaldebit').val('Rs '+parseFloat($tdebit).toLocaleString());
          //alert(daycash);
          var n=0;
          var n=((parseFloat(daycash)+parseFloat($tdebit))-parseFloat($tcredit)).toLocaleString();
        
          
         $('#totalcash').val('Rs '+n);
   });

  
  
    
    
      $('#loading').hide();  
    
    

}

function loadpre()
{
    
    var url = 'views/gettingPreTransactions.php?fdate='+$('#fdate').val();
    console.log(url);
    $.getJSON(url,function(data){
          var $tdebit=0;
          var $tcredit=0;
          $.each(data,function(index,data){   
        
            $tcredit+=parseFloat(data.credit);
            $tdebit+=parseFloat(data.debit);
       
       });
             
          // alert($tcredit);
          var n=(parseFloat($tdebit)-parseFloat($tcredit)).toLocaleString();
            
                $('#daycash').val('Rs '+n);
                $('#daycashn').val(parseFloat($tdebit)-parseFloat($tcredit));
     
   });


}



function printdaybook()
{
    if(!$('#totalcash').val()&&!$('#daydate').val())
   {
       swal('Select Date!','You must select the date first','error');
   } else if(!$('#totalcash').val())
    {
        swal('No Transactions!','Soory you do not have any transations to print','error');
    }
    if(($('#daydate').val())&&$('#totalcash').val())
setTimeout("location.href='views/printdaybook.php?billid="+$('#daydate').val()+"&pre="+$('#daycashn').val()+"'",500);
 
}


