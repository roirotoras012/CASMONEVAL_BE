

@props(['objectivesact', 'measures', 'provinces', 'annual_targets','user', 'monthly_targets'])



<table class="table table-bordered ppo-table shadow">
    <thead class="bg-primary text-white">
        <tr>
            <th rowspan="2" class="text-center align-middle">Objectives</th>
            <th rowspan="2" class="text-center align-middle">Measure</th>
            <th colspan="{{ $provinces->count() }}" class="text-center align-middle bg-warning">Annual Target</th>
          
        </tr>
        <tr>
            @foreach ($provinces as $province)
            @if ($province->province_ID ==  $user->province_ID)
            <th class="text-center align-middle bg-danger">{{ $province->province }}</th>
            <th class="text-center align-middle bg-danger">Accomplished</th>
            @endif
                
            @endforeach
            
        </tr>
    </thead>
    <tbody>

        {{-- {{ dd($objectivesact[0]->strategic_measures) }} --}}
        @foreach ($objectivesact as $objective)
            <tr>
                <td rowspan="{{ $objective->measures->count() + 1 }}" class="text-center align-middle">
                    {{ $objective->strategic_objective }}</td>
               {{-- {{ dd($objective->measures) }}      --}}
                @foreach ($objective->measures as $measure)
            <tr>
                <td class="text-center align-middle">{{ $measure->strategic_measure }}</td>
                {{-- @foreach ($provinces as $province) --}}
                    <td class="text-center align-middle">
                        @if (isset($annual_targets[$measure->strategic_measure_ID][$user->province_ID]))
                            {{-- <a href="#" data-bs-toggle="modal"
                                data-bs-target="#<?= $measure->strategic_measure_ID . '_' . $user->province_ID ?>"
                                id="{{ $province->province_ID }}" class="text-success"> --}}
                                {{ $annual_targets[$measure->strategic_measure_ID][$user->province_ID]->first()->annual_target }}
                                
                            {{-- </a> --}}
                            {{-- <x-update_target_modal :measure="$measure->strategic_measure_ID" :province="$province->province_ID" :target="$annual_targets[$measure->strategic_measure_ID][$province->province_ID]->first()
                                ->annual_target_ID" /> --}}
                        @else
                            {{-- <a href="#" data-bs-toggle="modal"
                                data-bs-target="#<?= $measure->strategic_measure_ID . '_' . $user->province_ID ?>"
                                id="{{ $province->province_ID }}" class="text-danger">N/A</a> --}}
                            {{-- <x-add_target_modal :measure="$measure->strategic_measure_ID" :province="$province->province_ID" /> --}}
                        @endif
                    </td>
                    @php
                     if(isset($monthly_targets[$annual_targets[$measure->strategic_measure_ID][$user->province_ID]->first()->annual_target_ID]))
                     {
                        $accom = $monthly_targets[$annual_targets[$measure->strategic_measure_ID][$user->province_ID]->first()->annual_target_ID]->annual_accom;

                     }
                     else{
                        $accom = '';
                     }
                       
                    @endphp
                    <td <?php if (isset($monthly_targets[$annual_targets[$measure->strategic_measure_ID][$user->province_ID]->first()->annual_target_ID]) 
                                        && $annual_targets[$measure->strategic_measure_ID][$user->province_ID]->first()->annual_target > $accom){ ?> style="background: #ff000021;" <?php   } ?> 
                                        class="text-center align-middle">
                        @if (isset($monthly_targets[$annual_targets[$measure->strategic_measure_ID][$user->province_ID]->first()->annual_target_ID]))
                        
                            <span <?php if ($monthly_targets[$annual_targets[$measure->strategic_measure_ID][$user->province_ID]->first()->annual_target_ID]->validated == true){ ?> style="font-weight: bold;" <?php   } ?> >{{ $accom }}</span>
                           
                        @else
                               


                        @endif
                        
                       
                    </td>
                    {{--  --}}
                {{-- @endforeach --}}
            </tr>
        @endforeach
        </tr>
        @endforeach
    </tbody>
</table>


