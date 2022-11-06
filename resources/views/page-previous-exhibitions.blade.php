@php
/**
 * Template Name: Previous Exhibitions
 */
@endphp
@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    @includeFirst(['partials.content-previous-exhibitions'])
  @endwhile
@endsection

