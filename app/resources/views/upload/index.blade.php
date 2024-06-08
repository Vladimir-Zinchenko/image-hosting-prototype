@extends('layouts.app')

@section('content')
    <form action="{{ url('upload') }}" id="uploadForm">
        @csrf
        <div class="my-3">
            <div id="uploadImages" class="dropzone"></div>
        </div>
        <div class="my-3">
            <button type="button" class="btn" id="resetFiles">Reset</button>
            <button type="button" class="btn btn-primary" id="processUpload">Upload</button>
        </div>
    </form>
@endSection
