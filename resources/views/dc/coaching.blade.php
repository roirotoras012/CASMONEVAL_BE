@extends('layouts.app')
@section('title')
    {{ 'Division Chief Coaching and Mentoring' }}
@endsection
@section('content')
    <x-user-sidebar>
        <div class="loading-screen">
            <img src="{{ asset('images/loading.gif') }}" alt="Loading...">
        </div>
        <div class="container-fluid px-4 py-5">

            <ol class="breadcrumb mb-4">

                <li class="breadcrumb-item active">
                    <h1>Division Chief Coaching and Mentoring</h1>
                </li>

            </ol>
            <div>

                {{-- @if (isset($eval))
                    <ul class="list-group">
                        <h2>Evaluation without a reason</h2>
                        @foreach ($eval as $eva)
                            <li class="list-group-item">
                                @if ($eva->reason == null)
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item flex-fill">{{ $eva->strategic_measure }}</li>
                                        <li class="list-group-item flex-fill">{{ $eva->monthly_target }}</li>
                                        <li class="list-group-item flex-fill">{{ $eva->monthly_accomplishment }}</li>
                                        <li class="list-group-item flex-fill">
                                            {{ ($eva->monthly_accomplishment / $eva->monthly_target) * 100 }} %</li>
                                        <li class="list-group-item" flex-fill>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#reason<?= $eva->evaluation_ID ?>">
                                                Add Reason for not hitting the target
                                            </a>

                                        </li>
                                        <li class="list-group-item flex-fill">No Remarks yet</li>
                                    </ul>
                                    <x-update_reason_eval_modal :evaluation_ID="$eva->evaluation_ID" />
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif --}}



                {{-- @if (session()->has('alert'))
                    <div class="alert alert-danger">
                        {{ session('alert') }}
                    </div>
                @endif --}}
                @if (session()->has('update'))
                    <div class="alert alert-success">
                        {{ session('update') }}
                    </div>
                @endif
                @if (isset($eval))
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="bg-primary text-white">Measure</th>
                                <th scope="col" class="bg-primary text-white">Month</th>
                                <th scope="col" class="bg-primary text-white">Target</th>
                                <th scope="col" class="bg-primary text-white">Accomplishment</th>
                                <th scope="col" class="bg-primary text-white">Percentage</th>
                                <th scope="col" class="bg-primary text-white">Reason</th>
                                <th scope="col" class="bg-primary text-white">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eval as $eva)
                                <tr>
                                    <th>{{ $eva->strategic_measure }}</th>
                                    <td>{{ $eva->month }}</td>
                                    <td>{{ $eva->monthly_target }}</td>
                                    <td>{{ $eva->monthly_accomplishment }}</td>
                                    <td>{{ ($eva->monthly_accomplishment / $eva->monthly_target) * 100 }} %</td>
                                    @if ($eva->reason == null)
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#reason<?= $eva->evaluation_ID ?>">
                                                Add Reason for not hitting the target
                                            </a>
                                            <x-update_reason_eval_modal :evaluation_ID="$eva->evaluation_ID" />
                                        </td>
                                    @else
                                        <td>{{ $eva->reason }}</td>
                                    @endif
                                    <td>No Remarks yet</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif


            </div>


        </div>

    </x-user-sidebar>
@endsection
