@extends('user.layout')

@section('title', 'Suhadak Akbar')
@section('body', 'homepage')

@section('logo')
<div id="logo">
    <h1><a href="{{ url('/') }}">Suhadak Akbar</a></h1>
    <p>{{ __('content.logo.subtitle') }}</p>
</div>
@endsection

@section('highlights')
<section id="highlights" class="wrapper style3">
    <div class="title">{{ __('content.project.title') }}</div>
    <div class="container">
        <div class="row aln-center">
            @if ($projects->isEmpty())
                <div class="col-12 col-12-medium">
                    <section class="highlight">
                        <span class="empty">{{ __('content.project.not_found') }}</span>
                    </section>
                </div>
            @else
                @foreach ($projects as $project)
                    <div class="col-4 col-12-medium">
                        <section class="highlight">
                            <a href="{{ route('project.show', ['project' => $project->slug]) }}" class="image featured"><img src="{{ asset('images/pic02.jpg') }}" alt="{{ $project->title }}" /></a>
                            <h3><a href="{{ route('project.show', ['project' => $project->slug]) }}">{{ $project->title }}</a></h3>
                            <p>{{ $project->subtitle }}</p>
                            <ul class="actions">
                                <li><a href="{{ route('project.show', ['project' => $project->slug]) }}" class="button style1">Detail</a></li>
                            </ul>
                        </section>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection