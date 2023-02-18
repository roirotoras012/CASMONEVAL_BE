@extends('layouts.app')
@section('title')
    {{ 'RD OPCR Target' }}
@endsection
@section('content')
    <x-user-sidebar>
        <div class="container-fluid px-4 py-5">

            <ol class="breadcrumb mb-4">

                <li class="breadcrumb-item active">
                    <h1>Regional Director OPCR TARGET</h1>
                </li>

            </ol>
            <div class="opcr-container">


                <div class="opcr-table">




                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p class="m-0">{{ $message }}</p>
                        </div>
                    @endif


                    <form action="{{ route('add_targets') }}" method="post">
                        <table class="pt-5">
                            <thead>
                                <tr>

                                    <th>Strategic Objectives</th>
                                    <th>Strategic Measures</th>
                                    <th>REGION 10</th>
                                    <th>BUK</th>
                                    <th>CAM</th>
                                    <th>LDN</th>
                                    <th>MISOR</th>
                                    <th>MISOC</th>
                                </tr>
                            </thead>

                            <tbody>



                                @csrf
                                @php
                                    $ctr = 0;
                                @endphp
                                @foreach ($labels as $label)
                                    <tr class="table-tr">
                                        @if ($label->strategic_objective)
                                        @endif
                                        <td>{{ $label->strategic_objective }} <input type="hidden"
                                                name="data[{{ $ctr }}][strategic_objective]"
                                                value="{{ $label->strategic_objective_ID }}"></td>
                                        <td>{{ $label->strategic_measure }}
                                            <input type="hidden" name="data[{{ $ctr }}][strategic_measure]"
                                                value="{{ $label->strategic_measure_ID }}">
                                            <input type="hidden" name="data[{{ $ctr }}][division_ID]"
                                                value="{{ $label->division_ID }}">

                                        </td>

                                        <td><input type="hidden" name="data[{{ $ctr }}][total_targets]"></td>
                                        <td><input type="number" name="data[{{ $ctr }}][BUK]"></td>
                                        <td><input type="number" name="data[{{ $ctr }}][CAM]"></td>
                                        <td><input type="number" name="data[{{ $ctr }}][LDN]"></td>
                                        <td><input type="number" name="data[{{ $ctr }}][MISOR]"></td>
                                        <td><input type="number" name="data[{{ $ctr }}][MISOC]"></td>

                                    </tr>

                                    @php
                                        $ctr++;
                                    @endphp
                                @endforeach





                                {{-- <input type="submit" value="ADD" class="btn btn-success"> --}}
                                <div class="pb-3 opcr-btn">
                                    <button type="submit" class="btn btn-primary" value="ADD" style="background: #0017c5;">
                                        Add OPCR
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        View OPCR
                                    </button>
                                </div>




                            </tbody>

                        </table>
                    </form>

                </div>


            </div>
        </div>

    </x-user-sidebar>
@endsection