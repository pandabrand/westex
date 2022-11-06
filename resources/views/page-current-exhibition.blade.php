@php
/**
 * Template Name: Current Exhibitions
 */
@endphp
@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    @includeFirst(['partials.content-current-exhibitions'])
  @endwhile
@endsection

