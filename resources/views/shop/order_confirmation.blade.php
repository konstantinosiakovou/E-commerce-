<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shipping informations</title>
</head>
<body>
    <div class="col-md-4 col-md-offset-4">
        <div class="cart">          
            <div class="container">
                <h2>Shipping informations</h2>    
                <table class="table">
                    <thead>
                        <tr>                            
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Zip</th>
                            <th>Vat number</th>
                            <th>Phone</th>
    
                        </tr>
                    </thead>
                    <tbody>
                        <tr>                            
                            <td>{{ Auth::user()->name }}</td>
                            <td>{{ Auth::user()->surname }}</td>
                            <td>{{ Auth::user()->city }}</td>
                            <td>{{ Auth::user()->address }}</td>
                            <td>{{ Auth::user()->zip }}</td>
                            <td>{{ Auth::user()->vatnumber }}</td>
                            <td>{{ Auth::user()->phone }}</td>
                        </tr>
                    </tbody>
                </table>
    
            </div>
        </div>
        <hr>
        <h2>My Orders</h2>
        @foreach ($products as $product)
        <li class="list-group-item">        
            <span class="badge badge-secondary">Quantity: {{ $product['qty'] }}</span><br>
            <span class="badge badge-secondary">Item: {{ $product['item']['title'] }}</span><br>
            <span class="badge badge-secondary">Price: ${{ $product['price'] }}</span>                         
        </li>
        @endforeach   
    </div>
</body>
</html>



