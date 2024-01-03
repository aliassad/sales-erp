var db;
$(document).ready(function () {

    var url = "views/gettingMentries.php?id=" + $('#email').html();
    $.getJSON(url, function (data) {
        db = TAFFY(data);
        var rows = db().get();
        if (data==""){
            $('#bills').append("<tr class='danger'><td colspan='4'><center><b>No Bills Details Found !...</b></center></td></tr>");
            return;
        }

        for (var i = 0; i < 500; i++)
            $('#bills').append("<tr onclick='showbill(this);'><td>" + (i+1) + "</td><td>" + rows[i]['bid'] + "</td><td>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td></tr>");

    });

});
function toDate(dateStr) {
    var parts = dateStr.split("-");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}

function filter(){

    $('#bills').html("");
    var fdate = $('#fdate').val();
    var tdate = $('#tdate').val();

    var rows;

    if (!fdate) {
        fdate = "00/00/0000";
        tdate = "00/00/0000";
    }
    else if (!tdate) {
        tdate = "00/00/0000";
    }


    if (fdate != "00/00/0000" || tdate != "00/00/0000") {

        if (fdate != "00/00/0000" && tdate == "00/00/0000") {

            var flag = false;
            rows = db().get();

            var c = 0;
            for (var i = 0; i < rows.length; i++) {
                if (toDate(fdate).getTime() === toDate(rows[i]['date']).getTime()) {
                    flag = true;
                    $('#bills').append("<tr class='success' onclick='showbill(this);'><td>" + (i+1) + "</td><td>" + rows[i]['bid'] + "</td><td>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td></tr>");
                }

            }

            if (!flag) {
                $('#bills').append("<tr class='danger'><td colspan='4'><center><b>No result found..!</b></center></td></tr>");
            }

            return;
        }
        else if (fdate != "00/00/0000" && tdate != "00/00/0000") {
            var flag = false;
            rows = db().get();
            for (var i = 0; i < rows.length; i++) {
                if (toDate(rows[i]['date']).getTime() >= toDate(fdate).getTime() && toDate(rows[i]['date']).getTime() <= toDate(tdate).getTime()) {
                    flag = true;
                    $('#bills').append("<tr class='success' onclick='showbill(this);'><td>" + (i+1) + "</td><td>" + rows[i]['bid'] + "</td><td>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td></tr>");
                }

            }

            if (!flag) {
                $('#bills').append("<tr class='danger'><td colspan='4'><center><b>No result found..!</b></center></td></tr>");
            }

            return;
        }

    }
    else {
        rows = db().get();
        for (var i = 0; i < 500; i++) {
            $('#bills').append("<tr onclick='showbill(this);'><td>" + (i+1) + "</td><td>" + rows[i]['bid'] + "</td><td>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td></tr>");
        }

    }









}

function deleteCustomer(id)
{
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Member and thier Bills !",
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


                            $.ajax({
                                type:"POST",
                                url:"views/deleteMember.php",
                                data:{cid:id},
                                success: function(msg){

                                }
                            });

                            swal({
                                title:"Deleted!",
                                type: "success",
                                text: "Your Member has been deleted.",
                                timer: 1200,
                                showConfirmButton: false
                            });

                            setTimeout('location.href="index.php?page=members"',2000);



            } else {
                swal({
                    title:"Cancelled",
                    type: "error",
                    text: "Your Member is safe :)",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}


function loadData()
{
    $('#cname').val('');
    $('#cemail').val('');
    $('#cphone').val('');
    $('#caddress').val('');

    $('#cname').val($('#name').html());
    $('#cemail').val($('#email').html());
    $('#cphone').val($('#phone').html());
    $('#caddress').val($('#address').html());


}
function updateCustomer()
{
    var id=$('#cid').html();
    var name=$('#cname').val();
    var email=$('#cemail').val();
    var phone=$('#cphone').val();
    var address=$('#caddress').val();

    $.ajax({
        type:"POST",
        url:"views/updateMember.php",
        data:{cid:id,cname:name,cemail:email,cphone:phone,caddress:address},
        success:function(msg)
        {
            if(msg=='true')
            {
                $('#CustomerModal').modal('hide');
                swal("Member Detail is updated!!","Successfully :)","success");
            }
            setTimeout('location.href="index.php?page=showMember&idno='+id+'"',2000);
        }

    });


}

function showbill(row)
{
    var id=row.cells[1].innerHTML;
    window.location.href="index.php?page=showBill&billno="+id;
}
/**
 * Created by Ali Asad on 11/10/2016.
 */
