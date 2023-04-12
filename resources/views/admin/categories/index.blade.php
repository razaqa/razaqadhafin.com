@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Categories

                            <a href="{{ url('admin/categories/create') }}" class="btn btn-default pull-right">Create New</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Post Count</th>
                                    <th>Headline Post</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->desc }}</td>
                                        <td>{{ $category->posts_count }}</td>
                                        <?php $has_headline = false ?>
                                        @foreach($category->posts as $post)
                                            @if($post->is_headline == true)
                                                <?php $has_headline = true ?>
                                                <td>{{ $post->title }}</td>
                                            @endif
                                        @endforeach
                                        @if ($has_headline == false)
                                            <td>
                                                Tidak ada
                                            </td>
                                        @endif
                                        <td>
                                            @if ($category->is_special == false)
                                                <a href="{{ url("/admin/categories/{$category->id}/edit") }}" class="btn btn-xs btn-info">Edit</a>
                                                <a href="{{ url("/admin/categories/{$category->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">No category available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $categories->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
