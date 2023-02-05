@extends('errors::minimal')

@section('title', __('Ошибка 500'))
@section('code', '500')
@section('message', $exception->getMessage())
