<!-- Modal -->

@props(['month', 'division_ID', 'monthly_target', 'strategic_measure'])



<div class="modal fade" id="<?=$month.'_'.$monthly_target?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="jan_35" style="text-transform: uppercase;">Monthly Target for {{$month}} </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form method="POST" action="{{ route('dc.store-accom')}}" id="addAccom-{{$monthly_target}}">
                    @csrf
                    
                        <input type="hidden" name="monthly_target_ID" value="{{$monthly_target}}">
                        <input type="hidden" name="strategic_measure" value="{{$strategic_measure}}">
                        <input type="hidden" name="month" value="{{$month}}">
                        <div class="row">
                            <label for="monthly_target"
                                class="col-form-label text-md-start">{{ __('Monthly Accomplishment') }}</label>

                            <div>
                                <input pattern="^(0|[1-9]\d*)$" type="text" id="monthly_accom"
                                    class="form-control @error('monthly_accom') is-invalid @enderror"
                                    name="monthly_accom" value="{{ old('monthly_accom') }}" required autofocus
                                    oninvalid="this.setCustomValidity('Please enter postive whole integers')" oninput="this.setCustomValidity('')"
                                    />


                                @error('monthly_accom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                            </div>
                        </div>


                        <div class="d-grid col-10 mx-auto my-3">
                            <button class="btn btn-primary" type="submit">{{ __('Add Monthly Accomplishment') }}</button>
                        </div>
                    </div>
                </form>
              
            </div>
            

        </div>
    </div>
</div>
<script>

    
$(document).ready(function() {
  
  var accom_form = document.getElementById('addAccom-{{$monthly_target}}');

  accom_form.addEventListener('submit', (event) => {

      // Prevent the form from submitting normally
      event.preventDefault();
     
      // Disable the submit button
      const button = event.submitter;
      button.disabled = true;
      
      // Submit the form
      
      event.target.submit();
    });



  // your code goes here
});
</script>