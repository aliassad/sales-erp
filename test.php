<td colspan="2">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td class="nocenter"><b>Gross Total:</b></td>
            <td class="nocenter">' + $('#CURRENCY_SIGN').val() + ' ' +
                parseFloat(($('#gross_total').val())).toLocaleString() + '
            </td>
        </tr>
        <tr>
            <td class="nocenter"><b>GST (' + $('#invoice_gst').val() + ')%:</b></td>
            <td class="nocenter">' + $('#CURRENCY_SIGN').val() + ' ' +
                parseFloat(($('#gst_amount').val())).toLocaleString() + '
            </td>
        </tr>
        <tr>
            <td class="nocenter"><b>Net Total:</b></td>
            <td class="nocenter">' + $('#CURRENCY_SIGN').val() + ' ' +
                parseFloat(($('#net_total').val())).toLocaleString() + '
            </td>
        </tr>
        <tr>
            <td class="nocenter"><b>Discount:</b></td>
            <td class="nocenter">' + $('#CURRENCY_SIGN').val() + ' ' +
                parseFloat(($('#discount1').val())).toLocaleString() + '
            </td>
        </tr>
        <tr>
            <td class="nocenter"><b>Amount Paid:</b></td>
            <td class="nocenter">' + $('#CURRENCY_SIGN').val() + ' ' +
                parseFloat(($('#paid').val())).toLocaleString() + '
            </td>
        </tr>
        <tr>
            <td class="nocenter" style="background:lightgrey;"><b>Balance:</b></td>
            <td class="nocenter">' + $('#CURRENCY_SIGN').val() + ' ' +
                parseFloat(($('#fina_total').val())).toLocaleString() + '
            </td>
        </tr>
        </tbody>
    </table>
</td>
