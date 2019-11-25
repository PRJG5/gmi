@extends('errors::minimal')

@section('title', @lang('errors.fobidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: @lang('errors.fobidden')))
