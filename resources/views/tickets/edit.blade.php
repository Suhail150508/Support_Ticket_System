<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Ticket</title>
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
        .form-container {
            background-color: #1C1E21;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .form-header {
            text-align: center;
            margin-bottom: 25px;
        }
        .form-header h1 {
            font-size: 28px;
            font-weight: 700;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 18px;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #2A2D31;
            color: white;
            font-size: 16px;
        }
        .form-control:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
        }
        .btn-submit:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>Update a Ticket</h1>
        </div>
        <form action="{{ route('update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This line is important for RESTful updates -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" name="subject" class="form-control" value="{{ $ticket->subject }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" rows="5" required>{{ $ticket->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ $ticket->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Closed" {{ $ticket->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn-submit">Update Ticket</button>
        </form>
    </div>

    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>
</html>
