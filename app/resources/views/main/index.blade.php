@extends('layouts.app')

@section('content')
    <div class="pb-3">
        <x-sort-link title="Uploaded" column="uploaded_at" />
        <x-sort-link title="Name" column="source_filename" />
    </div>
    <div class="row">
    @foreach ($images as $image)
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="{{ url($image->getUrl()) }}" target="_blank">
                            <img src="{{ $image->getThumbUrl() }}" class="img-fluid rounded-start" alt="{{ $image->source_name  }}">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $image->source_filename  }}</h5>
                            <p class="card-text"><a href="#">download as *.zip</a></p>
                            <p class="card-text"><small class="text-body-secondary">{{ $image->uploaded_at  }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <div>
        {{ $images->appends(Request::query())->links() }}
    </div>
@endSection
