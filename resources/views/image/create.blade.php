@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Subir nueva imagen</div>
                    <div class="card-body">
                        <form action="{{ route('image.save') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="image_path" class="col-md-3 col-form-label text-md-end">Imagen</label>
                                <div class="col-md-7">
                                    <input type="file" name="image_path" id="image_path"
                                        class="form-control  {{ $errors->has('image_path') ? 'is-invalid' : '' }}"
                                        required />

                                    @error('image_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-3 col-form-label text-md-end">Descripción</label>
                                <div class="col-md-7">
                                    <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                        required></textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-3">
                                    <input type="submit" value="Subir Imagen" class="btn btn-primary"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
