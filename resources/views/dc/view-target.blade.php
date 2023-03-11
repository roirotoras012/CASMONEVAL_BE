@extends('layouts.app')
@section('title')
    {{ 'Division Chief View Target' }}
@endsection
@section('content')
    <x-user-sidebar>
        <div class="loading-screen">
            <img src="{{ asset('images/loading.gif') }}" alt="Loading...">
          </div>
        <div class="container-fluid px-4 py-5">
            {{ $userDetails->province_ID }}
            <h1>{{ match ($userDetails->province_ID) {
                1 => 'Bukidnon BDD Division',
                2 => 'Lanao Del Norte',
                3 => 'Misamis Oriental',
                4 => 'Misamis Occidental',
                5 => 'Camiguin',
                default => 'other',
            } }}
            </h1>

            <div class="col-md-12">
                <button class="btn btn-primary my-2" onclick="printTable()" id="print-button">Print Table</button>
                <table class="table table-bordered border-primary" id="table">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle">Drivers</th>
                            <th rowspan="2" class="text-center align-middle">Measure</th>
                            <th rowspan="2" class="text-center align-middle">Div</th>
                            <th colspan="1" class="text-center align-middle">Annual Target</th>
                            <th colspan="12" class="text-center align-middle">Month</th>
                        </tr>
                        <tr>
                            <th class="text-center align-middle">
                                {{ match ($userDetails->province_ID) {
                                    1 => 'Bukidnon ',
                                    2 => 'Lanao Del Norte',
                                    3 => 'Misamis Oriental',
                                    4 => 'Misamis Occidental',
                                    5 => 'Camiguin',
                                    default => 'other',
                                } }}
                            </th>
                            {{-- loop for the months of the year header part --}}
                            @for ($i = 1; $i <= 12; $i++)
                                <?php $month = Carbon\Carbon::createFromDate(null, $i, 1); ?>
                                <th class="text-center align-middle">{{ $month->format('M') }}</th>
                            @endfor
                            {{-- end of loop for the months of the year header part --}}
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($driversact as $driver)
                            @php
                                $divisionName = match ($userDetails->province_ID) {
                                    1 => 'Business Development Division',
                                    2 => 'Consumer Protection Division',
                                    3 => 'Finance Administrative Division',
                                    default => 'other',
                                };
                                $measures = $driver->measures->where('division.division', $divisionName);
                                $measure_count = $measures->count();
                            @endphp

                            @if ($measure_count > 0)
                                <tr>
                                    <td rowspan="{{ $measure_count + 1 }}" class="text-center align-middle">
                                        {{ $driver->driver }}</td>
                                </tr>

                                @foreach ($measures as $measure)
                                    <tr>
                                        <td class="text-center align-middle">{{ $measure->measure }}</td>
                                        <td class="text-center align-middle">{{ $measure->division->division }}</td>

                                        @foreach ($provinces as $province)
                                            @php
                                                $provinceName = match ($userDetails->province_ID) {
                                                    2 => 'Lanao Del Norte',
                                                    3 => 'Misamis Oriental',
                                                    4 => 'Misamis Occidental',
                                                    5 => 'Camiguin',
                                                    default => 'Bukidnon',
                                                };
                                            @endphp

                                            @if ($province->province == $provinceName)
                                                <td class="text-center align-middle">
                                                    @if (isset($annual_targets[$measure->strategic_measure_ID][$province->province_ID]))
                                                        <p>{{ $annual_targets[$measure->strategic_measure_ID][$province->province_ID]->first()->annual_target }}
                                                        </p>
                                                    @else
                                                        <p>N/A</p>
                                                    @endif
                                                </td>
                                                {{-- loop for the months of the year monthly target area --}}
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <?php $month = Carbon\Carbon::createFromDate(null, $i, 1); ?>

                                                    @if (isset(
                                                            $monthly_targets[strtolower($month->format('M'))][
                                                                $annual_targets[$measure->measure_ID][$province->province_ID]->first()->annual_target_ID
                                                            ]))
                                                        <td class="text-center align-middle">
                                                            {{ $monthly_targets[strtolower($month->format('M'))][$annual_targets[$measure->measure_ID][$province->province_ID]->first()->annual_target_ID]->first()->monthly_target }}
                                                        </td>
                                                    @else
                                                        <td class="text-center align-middle">
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#<?= strtolower($month->format('M')) . '_' . $annual_targets[$measure->measure_ID][$province->province_ID]->first()->annual_target_ID ?>"
                                                                id="#<?= strtolower($month->format('M')) . '_' . $annual_targets[$measure->measure_ID][$province->province_ID]->first()->annual_target_ID ?>"
                                                                class="text-danger">N/A</a>
                                                        </td>
                                                        <x-update_monthly_target_modal :month="strtolower($month->format('M'))" :division_ID="1"
                                                            :annual_target="$annual_targets[$measure->measure_ID][
                                                                $province->province_ID
                                                            ]->first()->annual_target_ID" />
                                                    @endif
                                                @endfor
                                                {{-- end of loop for the months of the year monthly target area --}}
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>


            </div>




        </div>

    </x-user-sidebar>
@endsection
