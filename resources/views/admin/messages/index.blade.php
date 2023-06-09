@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Messages
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($messages as $message)
                                    <tr>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->body }}</td>
                                        <td>
                                            <a href="{{ url("/admin/messages/{$message->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">No message available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $messages->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
