@extends('admin.adminlayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Shoes') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <form action="{{ route('shoes.create') }}" method="GET">
    <!-- Form fields -->
    <button type="submit" class="btn btn-primary">Create Shoe</button>
</form>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($shoes as $shoe)
                                <tr>
                                    <td>{{ $shoe->name }}</td>
                                    <td>₱{{ $shoe->price }}</td>
                                    <td>{{ $shoe->category }}</td>
                                    <td>
                                        <a href="{{ route('shoes.show', $shoe->id) }}" class="btn btn-primary">{{ __('View') }}</a>
                                        <a href="{{ route('shoes.edit', $shoe->id) }}" class="btn btn-secondary">{{ __('Edit') }}</a>

                                        <form action="{{ route('shoes.destroy', $shoe->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No shoes found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
