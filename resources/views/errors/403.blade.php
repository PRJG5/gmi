@extends('errors::minimal')

@section('title', @lang('errors.forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: @lang('errors.forbidden')))
