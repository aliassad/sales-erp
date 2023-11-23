<?php
require("helpers.php");

$date=$_GET['fdate'];



$i=1;

 $credit=0;
 $dis;

 $data = array();




$result =query("SELECT concat('Payment Paid: ',v.id,': ',v.name) as dis,vp.amount credit,DATE_FORMAT(vp.date,'%d-%M-%Y') as date FROM vendorpayments vp,vendor v
                    where  v.id=vp.vid 
                    and vp.date < STR_TO_DATE('$date','%d-%M-%Y') and vp.ptype='Credit'");
while($row = mysqli_fetch_array($result)){

    if($row['credit']!=0){
        $row_data = array(
            'id' => $i,
            'dis' => $row['dis'],
            'debit' => 0,
            'credit' => $row['credit'],
            'date' => $row['date']
        );
        array_push($data, $row_data);
        $i=$i+1;
    }
}


$result =query("SELECT concat('Payment Debit: ',v.id,': ',v.name) as dis,vp.amount debit,DATE_FORMAT(vp.date,'%d-%M-%Y') as date FROM vendorpayments vp,vendor v
                    where  v.id=vp.vid 
                    and vp.date < STR_TO_DATE('$date','%d-%M-%Y') and vp.ptype='Debit'");
while($row = mysqli_fetch_array($result)){

    if($row['debit']!=0){
        $row_data = array(
            'id' => $i,
            'dis' => $row['dis'],
            'debit' => $row['debit'],
            'credit' => 0,
            'date' => $row['date']
        );
        array_push($data, $row_data);
        $i=$i+1;
    }
}




 $result =query("SELECT concat(t.discription) as dis,t.debit,t.credit,DATE_FORMAT(t.date, '%d-%M-%Y') as date from accounttransaction t,
                     accounttypes bt ,account b WHERE   t.date < STR_TO_DATE('$date','%d-%M-%Y') and t.aid=b.id and b.type=bt.id and bt.typename!='Bank'");
 while($row = mysqli_fetch_array($result)) {

     if ($row['debit'] != 0 || $row['credit'] != 0) {
         $row_data = array(
             'id' => $i,
             'dis' => $row['dis'],
             'debit' => $row['debit'],
             'credit' => $row['credit'],
             'date' => $row['date']
         );
         array_push($data, $row_data);
         $i = $i + 1;
     }
 }
$result = query("select concat('Amount Received: ',c.id,': ',c.name) as dis,sum(amount) as debit,DATE_FORMAT(date, '%d-%M-%Y') as date from customerpayments,
                     customer c  where ptype='Credit' and c.id =cid and date < STR_TO_DATE('$date','%d-%M-%Y')");

while($row = mysqli_fetch_array($result)){

    if($row['debit']!=0){
        $row_data = array(
            'id' => $i,
            'dis' => $row['dis'],
            'debit' => $row['debit'],
            'credit' => 0,
            'date' => $row['date']
        );
        array_push($data, $row_data);
        $i=$i+1;
    }
}

$result =query("SELECT t.id,concat(b.code,' ',t.discription) as dis,t.debit,t.credit,DATE_FORMAT(t.date, '%d-%M-%Y') as date
                    from accounttransaction t,accounttypes bt ,account b 
                    WHERE t.date < STR_TO_DATE('$date','%d-%M-%Y')
                    and t.aid=b.id and b.type=bt.id and bt.typename='Bank'");
 while($row = mysqli_fetch_array($result)){

     if($row['debit']!=0||$row['credit']!=0){
         $row_data = array(
             'id' => $i,
             'dis' => $row['dis'],
             'debit' => $row['debit'],
             'credit' => $row['credit'],
             'date' => $row['date']
         );
         array_push($data, $row_data);
         $i=$i+1;
     }


 }


$result =query("SELECT concat('Bill Received from ',c.name) as dis,sum(ba.amount) as debit,DATE_FORMAT(ba.date, '%d-%M-%Y') as date from billamounts ba ,bill b,customer c 
                   WHERE  ba.date < STR_TO_DATE('$date','%d-%M-%Y')
                  and ba.bid=b.id and b.cid=c.id and ba.amount > 0");
 while($row = mysqli_fetch_array($result)){

     if($row['debit']!=0)
     {
         $row_data = array(
             'id' => $i,
             'dis' => $row['dis'],
             'debit' => $row['debit'],
             'credit' => 0,
             'date' => $row['date']
         );
         array_push($data, $row_data);
         $i=$i+1;}
 }




echo json_encode($data);
?>