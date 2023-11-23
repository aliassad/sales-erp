var banks;
getBanks();
function getBanks() {
    var url = 'views/gettingBanks.php';
    $.getJSON(url,function(data){
        banks=TAFFY(data);
    });
}


function onReceivingPaymentModeChange() {

    var mode=$('#receivingPaymentMode');
    var container=$('#receivingPaymentModeContainer');
    container.html('');
    var bankcontainer=$('#receivingChequeBankContainer');
    bankcontainer.html('');
    if ( mode.val() == 2 )
    {

        container.html('<div class="row"> <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">' +
            '<div class="input-group">' +
            '<span class="input-group-addon"><i class="fa  fa-credit-card-alt"></i>&nbsp;Cheque no</span>' +
            '<input id="receivingChequeNo" class="form-control"  type="text"/>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-6">' +
            '<div class="input-group">' +
            '<span class="input-group-addon"><i class="fa  fa-calendar"></i>&nbsp;Due Date</span>' +
            '<input id="receivingChequeDueDate" class="form-control"  type="text" />' +
            '</div>' +
            '</div>' +
            '</div>');
        bankcontainer.html('<div class="input-group">' +
            '<span class="input-group-addon"><i class="fa  fa-bank"></i>&nbsp;Bank</span>' +
            '<input id="receivingChequeBank" class="form-control"  type="text"/>' +
            '</div>' +
            '</div>');

        $('#receivingChequeDueDate').datepicker({
            format: "dd-mm-yyyy"
        });
    }
    else if ( mode.val() == 3 )
    {
        var rows=banks().get();

        var banksList = '<select id="receivingBank" name="receivingBank" class="form-control">';

                        if(rows.length < 1 ) {
                            banksList += '<option value = "">No Bank Available</option>'
                        } else {
                            banksList += '<option value = "">Select Bank</option>'
                        }

                        for (var i=0; i < rows.length; i++ ){
                            banksList += '<option value = "'+rows[i]['id']+'">'+rows[i]['code']+'</option>'
                        }

                       banksList+='</select>';


        container.html('<div class="row"> <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">' +
            '<div class="input-group">' +
            '<span class="input-group-addon"><i class="fa  fa-bank"></i>&nbsp;Bank</span>' +banksList+
            '</div>' +
            '</div>' +
            '<div class="col-md-6">' +
            '<div class="input-group">' +
            '<span class="input-group-addon"><i class="fa  fa-file-o"></i>&nbsp;Deposit Slip No</span>' +
            '<input id="receivingDepositSlipNo" name="receivingDepositSlipNo" class="form-control"  type="text" />' +
            '</div>' +
            '</div>' +
            '</div>');
    }


    if(mode.val()==3){
        $('#receivingPaymentType').val('Credit');
        $('#receivingPaymentType').attr('disabled','true');

    }else{
        $('#receivingPaymentType').removeAttr('disabled');
    }
}

function onPayingPaymentModeChange() {

    var mode=$('#payingPaymentMode');
    var container=$('#payingPaymentModeContainer');
    container.html('');
    var bankcontainer=$('#payingChequeBankContainer');
    bankcontainer.html('');

    if ( mode.val() == 2 )
    {

        container.html('<div class="row"> <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">' +
            '<div class="input-group">' +
            '<span class="input-group-addon"><i class="fa  fa-credit-card-alt"></i>&nbsp;Cheque no</span>' +
            '<input id="payingChequeNo" class="form-control"  type="text"/>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-6">' +
            '<div class="input-group">' +
            '<span class="input-group-addon"><i class="fa  fa-calendar"></i>&nbsp;Due Date</span>' +
            '<input id="payingChequeDueDate" class="form-control"  type="text" />' +
            '</div>' +
            '</div>' +
            '</div>');
        bankcontainer.html('<div class="input-group">' +
            '<span class="input-group-addon"><i class="fa  fa-bank"></i>&nbsp;Bank</span>' +
            '<input id="payingChequeBank" class="form-control"  type="text"/>' +
            '</div>' +
            '</div>');

        $('#payingChequeDueDate').datepicker({
            format: "dd-mm-yyyy"
        });




    }
    else if ( mode.val() == 3 )
    {

        var rows=banks().get();

        var banksList = '<select id="payingBank" name="payingBank" class="form-control">';

        if(rows.length < 1 ) {
            banksList += '<option value = "">No Bank Available</option>'
        } else {
            banksList += '<option value = "">Select Bank</option>'
        }

        for (var i=0; i < rows.length; i++ ){
            banksList += '<option value = "'+rows[i]['id']+'">'+rows[i]['code']+'</option>'
        }

        banksList+='</select>';

        container.html('<div class="row"> <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">' +
            '<div class="input-group">' +
            '<span class="input-group-addon"><i class="fa  fa-bank"></i>&nbsp;Bank</span>' + banksList +
            '</div>' +
            '</div>' +
            '<div class="col-md-6">' +
            '<div class="input-group">' +
            '<span class="input-group-addon"><i class="fa  fa-file-o"></i>&nbsp;Deposit Slip No</span>' +
            '<input id="payingDepositSlipNo" name="payingDepositSlipNo" class="form-control"  type="text" />' +
            '</div>' +
            '</div>' +
            '</div>');
    }

    if(mode.val()==3){
        $('#payingPaymentType').val('Debit');
        $('#payingPaymentType').attr('disabled','true');

    }else{
        $('#payingPaymentType').removeAttr('disabled');
    }
}

function getVendorData()
{
    var url = 'views/VendorData.php?id=' + $("#vendorId").val();
    $.getJSON(url,function(data){

        $.each(data,function(index,data) {
            $("#vendorBalance").val('Rs '+parseFloat(data.ppayment).toLocaleString());
            $("#vendorBalanceFigure").val(data.ppayment);
        });

    });
    $("#payingPaymentMode").focus();

}

function getCustomerData()
{
    var url = 'views/getCustomerData.php?id=' + $("#customerId").val();
    $.getJSON(url,function(data){
        $.each(data,function(index,data) {
            $("#customerBalance").val('Rs '+parseFloat(data.ppayment).toLocaleString());
            $("#customerBalanceFigure").val(data.ppayment);
        });

    });
    $("#receivingPaymentMode").focus();

}

function submitPaymentPayingVoucher()
 {
    if($('#payingPaymentMode').val()==1)
    {
        if(!$('#paymentPayingDate').val())
        {
            swal("Input Error!","Please  enter a valid Date","error");
            return ;
        }
        else
        if(!$('#vendorId').val())
        {
            swal("Input Error!", "Please select a vendor", "error");
            return;
        }
        else
        if(!$('#payingAmount').val())
        {
            swal("Input Error!", "Please enter a amount", "error");
            return;
        }


    }else if($('#payingPaymentMode').val()==2)
    {
        if(!$('#paymentPayingDate').val()||!$('#vendorId').val()||!$('#payingAmount').val()||!$('#payingChequeDueDate').val()||!$('#payingChequeNo').val())
        {
            swal("Input Error!","Please fill all required fields","error");
            return;
        }
    }
    else if($('#payingPaymentMode').val() == 3)
        {

            if(!$('#paymentPayingDate').val())
            {
                swal("Input Error!","Please  enter a valid Date","error");
                return ;
            }
            else
            if(!$('#vendorId').val())
            {
                swal("Input Error!", "Please select a vendor", "error");
                return;
            }
            else
            if(!$('#payingAmount').val())
            {
                swal("Input Error!", "Please enter a amount", "error");
                return;
            }
            else
            if(!$('#payingBank').val())
            {
                swal("Input Error!", "Please select the bank", "error");
                return;
            }

        }



    swal({
            title: "Are you sure?",
            text: "You will cannot  able to undo this step!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,submit it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {

                swal({
                    title:"Updating",
                    type: "warning",
                    text:"Please Wait :)",
                    timer: 1300,
                    showConfirmButton: false
                });

                $.ajax({
                    type:"POST",
                    url:"views/payAmount.php",
                    data: new FormData($('#paymentPayingForm')[0]),
                    contentType:false,
                    cache: false,
                    processData:false,
                    success: function(msg){
                        //alert(msg);
                        swal({
                            title:"Payment  Added!",
                            type: "success",
                            text: "Your action is done.",
                            timer: 1200,
                            showConfirmButton: false
                        });
                    }
                });

                setTimeout('location.href="index.php?page=home"',1500);
            } else {
                swal({
                    title:"Cancelled",
                    type: "error",
                    text: "Payment not Paid",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}

function submitAndPrintPaymentPayingVoucher() {
    if($('#payingPaymentMode').val()==1)
    {
        if(!$('#paymentPayingDate').val())
        {
            swal("Input Error!","Please  enter a valid Date","error");
            return ;
        }
        else
        if(!$('#vendorId').val())
        {
            swal("Input Error!", "Please select a vendor", "error");
            return;
        }
        else
        if(!$('#payingAmount').val())
        {
            swal("Input Error!", "Please enter a amount", "error");
            return;
        }


    }else if($('#payingPaymentMode').val()==2)
    {
        if(!$('#paymentPayingDate').val()||!$('#vendorId').val()||!$('#payingAmount').val()||!$('#payingChequeDueDate').val()||!$('#payingChequeNo').val())
        {
            swal("Input Error!","Please fill all required fields","error");
            return;
        }
    }
    else if($('#payingPaymentMode').val() == 3)
    {

        if(!$('#paymentPayingDate').val())
        {
            swal("Input Error!","Please  enter a valid Date","error");
            return ;
        }
        else
        if(!$('#vendorId').val())
        {
            swal("Input Error!", "Please select a vendor", "error");
            return;
        }
        else
        if(!$('#payingAmount').val())
        {
            swal("Input Error!", "Please enter a amount", "error");
            return;
        }
        else
        if(!$('#payingBank').val())
        {
            swal("Input Error!", "Please select the bank", "error");
            return;
        }

    }




    swal({
            title: "Are you sure?",
            text: "You will cannot  able to undo this step!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,submit it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {

                swal({
                    title:"Updating",
                    type: "warning",
                    text:"Please Wait :)",
                    timer: 1300,
                    showConfirmButton: false
                });

                $.ajax({
                    type:"POST",
                    url:"views/payAmount.php",
                    data: new FormData($('#paymentPayingForm')[0]),
                    contentType:false,
                    cache: false,
                    processData:false,
                    success: function(msg){
                        // alert(msg);
                        swal({
                            title:"Payment  Added!",
                            type: "success",
                            text: "Your action is done.",
                            timer: 1200,
                            showConfirmButton: false
                        });
                    }
                });

                setTimeout('location.href="views/printPaymentPayingVoucher.php?cid='+$('#vendorId').val()+'&amount='+$('#payingAmount').val()+'&detail='+$('#payingDetail').val()+'&date='+$('#paymentPayingDate').val()+'&mode=CASH&balance='+$('#vendorBalanceFigure').val()+'"',1500);
            } else {
                swal({
                    title:"Cancelled",
                    type: "error",
                    text: "Payment not Paid",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });
}


function submitPaymentReceivingVoucher()
{
    if($('#receivingPaymentMode').val()==1)
    {

        if(!$('#paymentReceivingDate').val())
        {
            swal("Input Error!","Please  enter a valid Date","error");
            return;
        }
        else
        if(!$('#customerId').val())
        {
            swal("Input Error!", "Please select a customer", "error");
            return;
        }
        else
        if(!$('#receivingAmount').val())
        {
            swal("Input Error!", "Please enter a amount", "error");
            return;
        }



    }else if($('#receivingPaymentMode').val()==2)
    {
        if(!$('#paymentPayingDate').val()||!$('#vendorId').val()||!$('#payingAmount').val()||!$('#payingChequeDueDate').val()||!$('#payingChequeNo').val())
        {
            swal("Input Error!","Please fill all required fields","error");
            return;
        }
    }
    else if($('#receivingPaymentMode').val() == 3)
    {

        if(!$('#paymentReceivingDate').val())
        {
            swal("Input Error!","Please  enter a valid Date","error");
            return ;
        }
        else
        if(!$('#customerId').val())
        {
            swal("Input Error!", "Please select a customer", "error");
            return;
        }
        else
        if(!$('#receivingAmount').val())
        {
            swal("Input Error!", "Please enter a amount", "error");
            return;
        }
        else
        if(!$('#receivingBank').val())
        {
            swal("Input Error!", "Please select the bank", "error");
            return;
        }

    }




    swal({
            title: "Are you sure?",
            text: "You will cannot  able to undo this step!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,submit it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {

                swal({
                    title:"Updating",
                    type: "warning",
                    text:"Please Wait :)",
                    timer: 1300,
                    showConfirmButton: false
                });

                $.ajax({
                    type: "POST",
                    url: "views/receiveCustomerPayment.php",
                    data: new FormData($('#paymentReceivingForm')[0]),
                    contentType:false,
                    cache: false,
                    processData:false,
                    success: function (msg) {
                        //alert(msg);
                        swal("Payment Added!", "Successfully", "success");

                        setTimeout('location.href="index.php?page=home"', 1500);
                    }
                });


            } else {
                swal({
                    title:"Cancelled",
                    type: "error",
                    text: "Payment not Paid",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}

function submitAndPrintPaymentReceivingVoucher() {
    if($('#receivingPaymentMode').val()==1)
    {

        if(!$('#paymentReceivingDate').val())
        {
            swal("Input Error!","Please  enter a valid Date","error");
            return;
        }
        else
        if(!$('#customerId').val())
        {
            swal("Input Error!", "Please select a customer", "error");
            return;
        }
        else
        if(!$('#receivingAmount').val())
        {
            swal("Input Error!", "Please enter a amount", "error");
            return;
        }



    }else if($('#receivingPaymentMode').val()==2)
    {
        if(!$('#paymentPayingDate').val()||!$('#vendorId').val()||!$('#payingAmount').val()||!$('#payingChequeDueDate').val()||!$('#payingChequeNo').val())
        {
            swal("Input Error!","Please fill all required fields","error");
            return;
        }
    }
    else if($('#receivingPaymentMode').val() == 3)
    {

        if(!$('#paymentReceivingDate').val())
        {
            swal("Input Error!","Please  enter a valid Date","error");
            return ;
        }
        else
        if(!$('#customerId').val())
        {
            swal("Input Error!", "Please select a customer", "error");
            return;
        }
        else
        if(!$('#receivingAmount').val())
        {
            swal("Input Error!", "Please enter a amount", "error");
            return;
        }
        else
        if(!$('#receivingBank').val())
        {
            swal("Input Error!", "Please select the bank", "error");
            return;
        }

    }




    swal({
            title: "Are you sure?",
            text: "You will cannot  able to undo this step!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,submit it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {

                swal({
                    title:"Updating",
                    type: "warning",
                    text:"Please Wait :)",
                    timer: 1300,
                    showConfirmButton: false
                });

                $.ajax({
                    type: "POST",
                    url: "views/receiveCustomerPayment.php",
                    data: new FormData($('#paymentReceivingForm')[0]),
                    contentType:false,
                    cache: false,
                    processData:false,
                    success: function (msg) {
                        // alert(msg);
                        swal("Payment Added!", "Successfully", "success");
                        setTimeout('location.href="views/printPaymentReceivingVoucher.php?cid='+$('#customerId').val()+'&amount='+$('#receivingAmount').val()+'&detail='+$('#receivingDetail').val()+'&date='+$('#paymentReceivingDate').val()+'&mode=CASH&balance='+$('#customerBalanceFigure').val()+'"',1500);
                    }
                });


            } else {
                swal({
                    title:"Cancelled",
                    type: "error",
                    text: "Payment not Paid",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}


function showReceivingVoucher() {
    $('#paymentReceivingVoucher').modal('show');
    $('[data-id="customerId"]').focus();
}