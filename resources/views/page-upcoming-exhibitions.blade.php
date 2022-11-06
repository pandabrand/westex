@php
/**
 * Template Name: Upcoming Exhibitions
 */
@endphp

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header_no-title')
    @includeFirst(['partials.content-upcoming-exhibitions'])
  @endwhile
@endsection

