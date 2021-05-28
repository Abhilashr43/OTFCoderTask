@extends('layout')

@section('content')
<div id="errormode" class="alert alert-dark hide" role="alert">

</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('PDF') }}</div>
                <div class="card-body">
                    <form id="pdf-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="pdf-file1" class="col-md-4 col-form-label text-md-right">{{ __('PDF') }}</label>
                            <div class="col-md-6">
                                <input id="pdf-file" type="file" name="pdf_file" required accept="application/pdf">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input name="submit" type="submit" id="pdf-btn-form" class="btn btn-primary"
                                    value="{{ __('Submit') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vednor-script-content-bottom')

<script type="text/javascript">
    $(document).ready(function(){
   

            $("#pdf-form").submit(function(e){

                e.preventDefault();

                var formData = new FormData();
                formData.append("pdf_file", $("#pdf-file").prop('files')[0]);
                formData.append("_token", $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: '{{ route("pdf-upload") }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) { 
                        alert('data'); 
                    },
                    error: function(xhr, textStatus, error){
                        console.log(xhr, textStatus, error);
                        if (xhr.responseText == null || xhr.responseText == "") {
                            $("#errormode").removeClass('hide');
                            $("#errormode").addClass('show').append('Internal Error ');
                            setTimeout(() => {
                                $("#errormode").removeClass('show');
                                $("#errormode").addClass('hide')
                            }, 4000);
                        }else{
                            $("#errormode").removeClass('hide');
                            $("#errormode").addClass('show').append(xhr.responseText);
                             setTimeout(() => {
                                $("#errormode").removeClass('show');
                                $("#errormode").addClass('hide');
                            }, 4000);
                        }
                    }
                }); 
            });});
</script>

@endsection