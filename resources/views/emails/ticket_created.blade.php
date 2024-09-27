<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">

    @php
        use App\Models\User;
        $user = User::where('id',$ticket->user_id)->first();
    @endphp

    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1); padding: 20px;">
        <!-- Header Section -->
        <div style="text-align: center; border-bottom: 2px solid #007bff; padding-bottom: 20px; margin-bottom: 20px;">
            <h1 style="color: #007bff; margin: 0;">New Ticket Created</h1>
        </div>

        <!-- Ticket Information -->
        <h2 style="color: #333333;">Hello, Admin Sir</h2>
        <p style="color: #555555; font-size: 16px; line-height: 1.5;">
            A new ticket has been created with the following details:
        </p>

        <!-- Ticket Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
            <tr>
                <td style="background-color: #007bff; color: white; padding: 10px; width: 30%;">Customer Name</td>
                <td style="background-color: #f4f4f4; padding: 10px;">{{ $user->name }}</td>
            </tr>
            <tr>
                <td style="background-color: #007bff; color: white; padding: 10px; width: 30%;">Subject</td>
                <td style="background-color: #f4f4f4; padding: 10px;">{{ $ticket->subject }}</td>
            </tr>
            <tr>
                <td style="background-color: #007bff; color: white; padding: 10px;">Description</td>
                <td style="background-color: #f4f4f4; padding: 10px;">{{ $ticket->description }}</td>
            </tr>
            <tr>
                <td style="background-color: #007bff; color: white; padding: 10px;">Status</td>
                <td style="background-color: #f4f4f4; padding: 10px;">{{ $ticket->status }}</td>
            </tr>
        </table>

        <!-- Footer Section -->
        <div style="text-align: center; margin-top: 20px;">
            <p style="color: #999999; font-size: 14px;">
                Thank you for contacting our support team.
            </p>
        </div>
    </div>
</body>

</html>


