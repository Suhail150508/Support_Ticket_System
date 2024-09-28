<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Mail\TicketCreated;
use App\Mail\TicketClosed;
use App\Models\ClosedTicket;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function tickets()
    {
        return view('tickets.index');
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'subject' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $ticket = new Ticket();
        $ticket->user_id = $request->user_id;
        $ticket->subject = $request->subject;
        $ticket->description = $request->description;
        $ticket->status = $request->status;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('teacher', $fileName);
            $ticket->image = $fileName;
        }
        $ticket->save();

        // Send email to admin
        $user = User::where('role','admin')->first();
        Mail::to($user->email)->send(new TicketCreated($ticket));

        Toastr::success('Ticket Created Successfully', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect('customer-ticket');
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }
    public function view($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.ticket_show', compact('ticket'));
    }
    public function edit($id)
    {
       $ticket = Ticket::findOrFail($id);
        return view('tickets.edit', compact('ticket'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            ]);

            $update = Ticket::findOrFail($id);

            $update->subject = $request->subject;
            $update->description = $request->description;
            $update->status = $request->status;

            if ($request->image) {
                if ($update->image) {

                    unlink(public_path('teacher/' . $update->image));
                }

                $file = $request->image;
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $file->move('teacher', $fileName);
                $update->image = $fileName;
            }
            $update->save();
            Toastr::success('Ticket Updated Successfully', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect('customer-ticket');
    }

    public function adminTicket()
    {
        $user = Session()->get('user');
        $tickets = Ticket::paginate(15);
        return view('admin.dashboard', compact('tickets'));

    }
    public function customerTicket()
    {
        $user = Session()->get('user');
        $tickets = Ticket::where('user_id',$user->id)->paginate(15);
        return view('customer.dashboard', compact('tickets'));


    }

    public function updateStatus(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'status' => 'closed',
        ]);

        $user = Session()->get('user');
        
        $close = new ClosedTicket();
        $close->user_id = $user->id;
        $close->subject = $ticket->subject;
        $close->description = $ticket->description;
        $close->status = $ticket->status;
        $close->save();
        // Send email to customer
        $user = User::where('id',$ticket->user_id)->first();
        Mail::to($user->email)->send(new TicketClosed($ticket));

        Toastr::success('Ticket Closed Successfully', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect('admin-ticket');
    }

    public function delete($id)
    {
       $ticket = Ticket::findOrFail($id)->delete();
       Toastr::success('Ticket Deleted Successfully', 'Title', ["positionClass" => "toast-top-right"]);
       return redirect('admin-ticket');
    }

    public function customerTicketDelete($id)
    {
       $ticket = Ticket::findOrFail($id)->delete();

       Toastr::success('Ticket Deleted Successfully', 'Title', ["positionClass" => "toast-top-right"]);
       return redirect('customer-ticket');
    }
}


