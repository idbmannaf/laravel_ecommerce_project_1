<style>
.wrapper{
    width: 90%;
    margin:0 auto;
}
.head .invoice{
    text-align: center;

}
.user_details{
    width: 100%;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
}
.user_details div{
    width: 50%;
}
li{
    list-style-type: none;
}
.d {
    border-bottom: 3px solid gray;
    /* border-width: 15px; */
    width: 190px;
    /* height: 3px; */
    margin-bottom: 8px;
    background-color: green;
    display: block;
    text-align: center;
    margin: 0 auto;
}


.invoice_details{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
}
table{
    width: 100%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
  th, td {
    padding: 15px;
  }
  th {
    text-align: left;
    background-color: rgb(14, 145, 233);
  }
  table {
    border-spacing: 5px;
  }
.a{
    text-decoration: none;
}
.foot{
    text-align: center;
}

</style>


    <div class="wrapper">
<div class="head">
    <div class="invoice"><h1>Invoice Details</h1><span class="d"></div>
    <div class="invoice_details">
        <div class="left">
            <ul>
                <li>Order ID: {{ $data->id }} </li>
                <li>Logged User: </li>
                <li>Payment Status:  </li>

            </ul>
        </div>
        <div class="Middile">
            <ul>
                <li>Order_id </li>
                <li>Invoice: 46545 </li>
                <li>Transition ID: 4566 </li>

            </ul>
        </div>
        <div class="right">
            <ul>
                <li>Total Pay: {{ $data->total }}</li>
                <li>Disscount: {{ $data->discount }}</li>
                <li><b>Sub Total: {{ $data->created_at }}</b> </li>
            </ul>
        </div>

    </div>
</div>
<div class="body">
    <div class="order-details">
        <h2 style="text-align: center;">Order Details</h2>
       <table>
           <tr>
               <th> Order_id </th>
               <th> Product name </th>
               <th> Product Price </th>
               <th> Product Quantity </th>
               <th> Order Date </th>
           </tr>
           {{ $order_details }}
           @foreach ($order_details as $order_list)

           @endforeach
           <tr>
               <td>{{ $order_list->order_id }}</td>
               <td>{{ $order_list->product_name }}</td>
               <td>{{ $order_list->product_price }}</td>
               <td>{{ $order_list->product_quantity }}</td>
               <td>{{ $order_list->created_id }}</td>
           </tr>
       </table>
    </div>
    <div class="order_billing_details">
        <h2 style="text-align: center;">Billing Details</h2>
        <table>
            <tr>
                <th> #SL </th>
                <th> Name </th>
                <th> Email </th>
                <th> Phone </th>
                <th> Address </th>
                <th>House/Flat</th>
                <th> Country </th>
                <th> City </th>
                <th> Post Code </th>
                <th> Note </th>
            </tr>
            <tr>
                <td>1</td>
                <td>Apple</td>
                <td>580</td>
                <td>4</td>
                <td>02-02-2021</td>
                <td>02-02-2021</td>
                <td>02-02-2021</td>
                <td>02-02-2021</td>
                <td>02-02-2021</td>
                <td>02-02-2021</td>
            </tr>
        </table>
    </div>
</div>
<div class="foot">
    <p>This invoice created by <a href="{{ url('/') }}">MF Store</a></p>
</div>
    </div>
