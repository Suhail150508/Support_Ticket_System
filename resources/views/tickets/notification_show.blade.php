<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

     {{-- toastr --}}
     <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }
        body {
            background-color: #181A1B;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }
        .container {
            background-color: #1C1E21;
            border-radius: 8px;
            width: 80%;
            max-width: 800px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .ticket-header {
            text-align: center;
            border-bottom: 2px solid #343a40;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .ticket-header h1 {
            font-size: 28px;
            font-weight: 700;
        }
        .ticket-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .ticket-table th, .ticket-table td {
            padding: 15px;
            text-align: left;
            font-size: 18px;
        }
        .ticket-table th {
            width: 30%;
            background-color: #343a40;
        }
        .ticket-table td {
            background-color: #2A2D31;
        }
        .ticket-footer {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            padding: 12px 20px;
            border: none;
            color: white;
            cursor: pointer;
            background-color: #007bff;
            border-radius: 5px;
            font-size: 16px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #b52a3a;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div>
        <a href="{{ url('customer-ticket') }}" class="btn btn-primary" style="float: right;margin-top:-15rem">Back</a>
    </div>
    <div class="container">
        <!-- Ticket Header Section -->
        <div class="ticket-header">
            <h1>Ticket Details</h1>
        </div>

        <!-- Ticket Body Section (Using Table) -->
        <table class="ticket-table">
            <tr>
                <th>Subject</th>
                <td>{{ $ticket->subject }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $ticket->description }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $ticket->status }}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td>
                    <img src="{{ URL::asset('/teacher/'.$ticket->image) }}" alt="Ticket Image" style="max-width: 100px; max-height: 100px; object-fit: cover;">

                </td>
            </tr>
        </table>

    </div>


    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>

</html>
