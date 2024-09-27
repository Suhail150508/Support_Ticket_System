
@extends('layouts.app')
@section('content')

<style>
    .custom-modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */

    top: 0;
    width: 80%; /* Full width */
    height: 100%; /* Full height */
    background-color: rgba(0, 0, 0, 0.4); Black background with opacity
    /* float: right; */
    }

    /* Modal Content */
    .custom-modal-content {
    background-color: #000;
    margin: 2rem;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    }

    /* The Close Button */
    .close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close-btn:hover,
    .close-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
    }
</style>

<div class="container">
    <h1>Tickets</h1>
    @php
        $user = Session()->get('user');
    @endphp

    @if ($user && $user->role === 'customer')
        <button id="openModalBtn" class="btn btn-primary" style="float: right">Open New Ticket</button>
    @endif

    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row " style="margin-top:-4rem ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="color:white"> Id </th>
                          <th style="color:white"> Image </th>
                          <th style="color:white"> User Id </th>
                          <th style="color:white"> Subject </th>
                          <th style="color:white"> Description </th>
                          <th style="color:white"> Status </th>
                          <th style="color:white"> Actions </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($tickets as $ticket)
                        <tr>

                          <td> 00{{ $ticket->id }} </td>
                          <td>
                            <img src="{{ URL::asset('/teacher/'.$ticket->image) }}" alt="image">
                          </td>
                          <td> {{ $ticket->user_id }} </td>
                          <td> {{ $ticket->subject }} </td>
                          <td> {{ $ticket->description }} </td>
                          <td> {{ $ticket->status }} </td>
                          <td>
                            <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                            <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown" style="width:20px;margin-left:23rem">
                                <div  style="margin-left:3rem;padding:7px">
                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-success" style="padding:4px 7.7px">View Ticket</a>
                                </div>
                                <div  style="margin-left:3rem;padding:7px">
                                    <a href="{{url('/tickets-edit/'.$ticket->id)}}" class="btn btn-info" style="padding:4px 7.7px">Edit Ticket</a>
                                </div>
                                <div  style="margin-left:3rem;padding:4px">
                                    {{-- <a href="{{ url('tickets-delete', $ticket->id) }}" class="btn btn-danger" style="padding:5px">Delete Ticket</a> --}}
                                    <form method="post" action="{{ url('/customer-tickets-delete/'.$ticket->id ) }}" style="margin-left:.1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding:4px"> Delete Ticket</button>

                                    </form>
                                </div>

                            </div>
                          </td>
                        </tr>
                        @endforeach

                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- content-wrapper ends -->

        <!-- partial -->
      </div>

        <!-- Custom Modal Create -->
        <div id="customModal" class="container custom-modal">
        <!-- Modal content -->
            <div class="custom-modal-content">
                <span class="close-btn">&times;</span>
                <h1 style="margin: 2rem">Open a New Ticket</h1>
            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="form-group">
                    <label for="subject">Subject<span style="color: red">*</span></label>
                    <input type="text" name="subject" class="form-control" style="color:aliceblue" required>
                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description<span style="color: red">*</span></label>
                    <textarea name="description" class="form-control" style="color:aliceblue" required></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Status<span style="color: red">*</span></label>
                    <select class="form-control" name="status" style="color:aliceblue"  required>
                        <option value="pending">pending</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/jpeg, image/png">
                </div>

                <button type="submit" class="btn btn-success">Submit Ticket</button>
            </form>
            </div>
      </div>


</div>

<!-- Add your custom JS -->

<script>
    // Get the modal
var modal = document.getElementById("customModal");

// Get the button that opens the modal
var btn = document.getElementById("openModalBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close-btn")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


</script>
<script src="assets/js/custom.js"></script>

@endsection
