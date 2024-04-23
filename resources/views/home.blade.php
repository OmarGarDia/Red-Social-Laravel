@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes.message')

                @foreach ($images as $image)
                    @include('includes.image', [
                        'image' => $image,
                    ])
                @endforeach

                <!-- PAGINACIÓN -->
                <div class="clearfix"></div>
                {{ $images->links('pagination::bootstrap-4')->with('list', 'list-unstyled') }}
            </div>
        </div>
    </div>
@endsection
