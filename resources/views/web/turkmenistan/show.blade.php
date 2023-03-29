@extends('layouts.app')

@include('web.include.tour', ['data' => ['type' => __('Turkmenistan'), 'tour' => $tour]])
