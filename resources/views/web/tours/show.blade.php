@extends('layouts.app')

@include('web.include.tour', ['data' => ['type' => __('Tour'), 'tour' => $tour]])
