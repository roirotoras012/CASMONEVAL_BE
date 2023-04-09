
<head>
    <link rel="stylesheet" href="{{ URL::asset('css/rd.css') }}" />
</head>
@extends('layouts.app')
@section('title')
    {{ 'RPO Save Target' }}
@endsection
@section('content')
    @php
        // var_dump($targets);
    
    @endphp
    <x-user-sidebar>
        <div class="loading-screen">
            <img src="{{ asset('images/loading.gif') }}" alt="Loading...">
          </div>
        
        <div class="container-fluid px-4 py-5">
                
            <ol class="breadcrumb mb-4">
            
                <li class="breadcrumb-item active"><h1 class="province-name bg-primary text-white text-uppercase mb-5 rounded">OPCR #{{$opcr_id}}</h1></li>
              
            </ol>
            <div class="opcr-container">


                <div class="opcr-table">




                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p class="m-0">{{ $message }}</p>
                        </div>
                    @endif


                    <form action="{{ route('update_targets') }}" method="post" id="opcr_form-{{$opcr_id}}">
                        <input type="hidden" name="opcr_id"
                                                value="{{ $opcr_id }}">
                        <table class="table table-bordered ppo-table shadow" id="table">
                            <thead class="bg-primary text-white">
                                <tr>

                                    <th rowspan="2">Strategic Objectives</th>
                                    <th rowspan="2">Strategic Measures</th>
                                    <th rowspan="2">REGION 10</th>
                                    <th colspan="2">BUK</th>

                                    <th colspan="2">CAM</th>
                                    <th colspan="2">LDN</th>
                                    <th colspan="2">MISOR</th>
                                    <th colspan="2">MISOC</th>
                                    
                                </tr>
                                <tr>
                                    <th>Target</th>
                                    <th>Accom</th>
                                    <th>Target</th>
                                    <th>Accom</th>
                                    <th>Target</th>
                                    <th>Accom</th>
                                    <th>Target</th>
                                    <th>Accom</th>
                                    <th>Target</th>
                                    <th>Accom</th>
                                    

                                </tr>
                            </thead>

                            <tbody>



                                @csrf
                                @php
                                $current_objective = '';
                                    $ctr = 0;
                                    $is_edit = false;
                                    $total = 0;
                                @endphp
                               
                                @foreach ($labels as $label)
                                  
                                    <tr class="table-tr">
                                        
                                        @if ($label->strategic_objective != $current_objective)
                                        
                                        @php
                                        $obj_count = 0;
                                        foreach ($labels as $label2) {
                                            if($label2->strategic_objective_ID == $label->strategic_objective_ID){
                                                $obj_count++;

                                            }
                                        }
                                        @endphp
                                        {{-- <h2>{{$qwe}}</h2> --}}
                                        <td rowspan="{{$obj_count}}">
                                        {{ $label->strategic_objective }}
                                    
                                        </td>
                                        @endif
                                       
                                       
                                        <td>{{ $label->strategic_measure }} 
                                            
                                            <input type="hidden"
                                            name="data[{{ $ctr }}][strategic_objective]"
                                            value="{{ $label->strategic_objective_ID }}">
                                            <input type="hidden" name="data[{{ $ctr }}][strategic_measure]"
                                                value="{{ $label->strategic_measure_ID }}">
                                            <input type="hidden" name="data[{{ $ctr }}][strategic_measurez]"
                                                value="{{ $label->strategic_measure }}">
                                            <input type="hidden" name="data[{{ $ctr }}][type]"
                                                value="{{ $label->type }}">
                                            <input type="hidden" name="data[{{ $ctr }}][division_ID]"
                                                value="{{ $label->division_ID }}">

                                        </td>
                                        @php
                                            $total = $label->BUK + $label->CAM + $label->LDN + $label->MISOR + $label->MISOC;
                                        @endphp
                                        <td><input type="hidden" name="data[{{ $ctr }}][total_targets]">
                                        {{$total}}
                                        </td>
                                        <td>

                                            <input type="hidden" name="data[{{ $ctr }}][BUK]" value="">
                                            <input <?php if ($label->BUK != '' && ($is_edit == false)){ ?> disabled style="font-weight: bold;"<?php   } ?> type="text" name="data[{{ $ctr }}][BUK]" value="{{$label->BUK}}">
                                        
                                        </td>
                                        <td>
                                            @if ((isset($monthly_targets[$label->BUK_target])) && $monthly_targets[$label->BUK_target]->validated)
                                               <b>{{ $monthly_targets[$label->BUK_target]->annual_accom }} </b>
                                            @else
                                               @if (isset($label->BUK_accom) && $label->BUK_accom_validated)
                                                   <b>{{ $label->BUK_accom}}</b>
                                               @endif
                                           @endif
                                        </td>
                                        <td>
                                            <input type="hidden" name="data[{{ $ctr }}][CAM]" value="">
                                            <input <?php if ($label->CAM != '' && ($is_edit == false)){ ?> disabled style="font-weight: bold;"<?php   } ?> type="text" name="data[{{ $ctr }}][CAM]" value="{{$label->CAM}}">
                                         
                                        </td>
                                        <td>
                                            @if ((isset($monthly_targets[$label->CAM_target])) && $monthly_targets[$label->CAM_target]->validated)
                                               <b>{{ $monthly_targets[$label->CAM_target]->annual_accom }}</b>
                                            @else
                                            @if (isset($label->CAM_accom) && $label->CAM_accom_validated)
                                            <b>{{ $label->CAM_accom}}</b>
                                            @endif
                                           @endif
                                        </td>
                                        <td>
                                            <input type="hidden" name="data[{{ $ctr }}][LDN]" value="">
                                            <input <?php if ($label->LDN != '' && ($is_edit == false)){ ?> disabled style="font-weight: bold;"<?php   } ?> type="text" name="data[{{ $ctr }}][LDN]" value="{{$label->LDN}}">
                                         
                                        </td>
                                        <td>
                                            @if ((isset($monthly_targets[$label->LDN_target])) && $monthly_targets[$label->LDN_target]->validated)
                                               <b>{{ $monthly_targets[$label->LDN_target]->annual_accom }}</b>
                                              
                                               @else
                                               @if (isset($label->LDN_accom)  && $label->LDN_accom_validated)
                                                   <b>{{ $label->LDN_accom}}</b>
                                               @endif
                                           @endif
                                        </td>
                                        <td>
                                            <input type="hidden" name="data[{{ $ctr }}][MISOR]" value="">
                                            <input <?php if ($label->MISOR != '' && ($is_edit == false)){ ?> disabled style="font-weight: bold;"<?php   } ?> type="text" name="data[{{ $ctr }}][MISOR]" value="{{$label->MISOR}}">
                                          
                                        </td>
                                        <td>
                                            @if ((isset($monthly_targets[$label->MISOR_target])) && $monthly_targets[$label->MISOR_target]->validated)
                                               <b>{{ $monthly_targets[$label->MISOR_target]->annual_accom }}</b>
                                               @else
                                               @if (isset($label->MISOR_accom)  && $label->MISOR_accom_validated)
                                               <b>{{ $label->MISOR_accom}}</b>
                                           @endif
                                           @endif
                                        </td>
                                        <td>
                                            <input type="hidden" name="data[{{ $ctr }}][MISOC]" value="">
                                            <input <?php if ($label->MISOC != '' && ($is_edit == false)){ ?> disabled style="font-weight: bold;"<?php   } ?> type="text" name="data[{{ $ctr }}][MISOC]" value="{{$label->MISOC}}">
                                           
                                        </td>
                                        <td>
                                            @if ((isset($monthly_targets[$label->MISOC_target])) && $monthly_targets[$label->MISOC_target]->validated)
                                               <b>{{ $monthly_targets[$label->MISOC_target]->annual_accom }}</b>
                                               @else
                                               {{-- @if (isset($label->MISOC_accom)  && $label->MISOC_accom_validated)
                                                   <b>{{ $label->MISOC_accom}}</b>
                                               @endif --}}
                                           @endif
                                        </td>

                                    </tr>

                                    @php
                                        $ctr++;
                                        $current_objective = $label->strategic_objective;
                                    @endphp
                                   
                                @endforeach





                                {{-- <input type="submit" value="ADD" class="btn btn-success"> --}}
                                <div class="pb-3 opcr-btn">
                                    <button <?php if ($opcr[0]->is_submitted == true){ ?> disabled <?php   } ?> type="submit" name="submit" class="btn btn-primary" value="update">
                                        Update OPCR
                                    </button>
                                    {{-- <button type="button" class="btn btn-success" onclick="edit()">
                                        Edit OPCR
                                    </button> --}}
                                    <button <?php if ($opcr[0]->status == 'INCOMPLETE' || $opcr[0]->is_submitted == true){ ?> disabled <?php   } ?> type="submit" value="submit" name="submit" class="btn btn-success">
                                        Submit OPCR
                                    </button>
                                    <button <?php if ($opcr[0]->status != 'COMPLETE' && $opcr[0]->is_submitted != true){ ?> disabled <?php   } ?> type="submit" value="done" name="submit" class="btn btn-success">
                                        Mark as Done
                                    </button>
                                    <button type="button" class="btn btn-primary my-2" id="print-button">Print Table</button>
                                </div>
                                @if ($opcr[0]->is_submitted == true)
                                <div class="alert alert-success">
                                    <p class="m-0">OPCR is already submitted.</p>
                                </div>
                                @endif
                                <script>
                                 
                                </script>

                                <h5><b>Year: {{ $opcr[0]->year }}</b> </h5>
                                <h5><b>Description: {{ $opcr[0]->description }}</b> </h5>
                            </tbody>

                        </table>
                    </form>

                </div>


            </div>
        
        </div>

    </x-user-sidebar>

    <script>
        
$(document).ready(function() {
  
//   var opcr_form = document.getElementById('opcr_form-{{$opcr_id}}');

//   opcr_form.addEventListener('submit', (event) => {
//     console.log("WEW");
//         // Prevent the form from submitting normally
//       event.preventDefault();
     
//       // Disable the submit button
//       const button = event.submitter;
//       button.disabled = true;
//       if (button.name === 'update') {
//       console.log('Button 1 was clicked');
//         } else if (button.name === 'button2') {
//         console.log('Button 2 was clicked');
//         }
      
//       event.target.submit();
//     });



  // your code goes here
});
    </script>
@endsection