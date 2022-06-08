@extends('layouts.app')

 
@section('content')
                                         
    <form method="POST" action="{{ route('lead.create') }}" accept-charset="UTF-8" enctype="multipart/form-data" class="needs-validation mx-1" name="form_lead" novalidate>
        {{ csrf_field() }}                
        <div class="row g-3">
            @foreach ($questions->data as $question)  
                <div class="{{ $question->datatype == 'textarea' ? 'col-md-12' : 'col-md-6' }} form-check">    

                    <input type="hidden" name="lead[{{$question->id}}][text]" value="{{$question->text}}">                        
                    <label class="form-label fw-bold">{{$question->text}} {{ $question->alow_null == 0 ? '*' : '' }}</label>

                    <div class="input-group"> 
                        @if ($question->datatype == 'text')                
                            @if ($question->html_class == 'money') 
                                <div class="input-group-prepend"> <span class="input-group-text">R$</span> </div>
                            @elseif ($question->html_class == 'email') 
                                <div class="input-group-prepend"> <span class="input-group-text">@</span> </div>
                            @endif
                            {{ Form::text(
                                'lead[' . $question->id . '][value]',
                                '',                          
                                array(                            
                                    'class' => 'form-control ' . $question->html_class,                                                       
                                    $question->placeholder != '' ? 'placeholder=' . "'" . $question->placeholder . "'" : '',
                                    $question->html5_pattern != '' ? 'pattern=' . "'" . $question->html5_pattern . "'" : '',
                                    $question->alow_null == 0 ? 'required' : ''                          
                                )
                            )}}    
                            <div class="invalid-feedback">{{ $question->invalid_feedback }}</div>                             

                        @elseif ($question->datatype == 'textarea') 
                            
                            <textarea 
                                class="form-control" 
                                name="lead[{{$question->id}}][value]" 
                                rows="4" cols="33" 
                                {{ $question->placeholder != '' ? 'placeholder=' . "'" . $question->placeholder . "'" : '' }}
                                {{ $question->alow_null == 0 ? 'required' : '' }}></textarea>
                            <div class="invalid-feedback">{{ $question->invalid_feedback }}</div> 

                        @elseif ($question->datatype == 'check') 
                        
                            @foreach ($question->answers as $answer)                                             
                                <div class="form-check {{  $loop->count <= 3 ? 'form-check-inline' : '' }}">    
                                    <input class="form-check-input" type="checkbox" name="lead[{{$question->id}}][value][]" value="{{ $answer->text }}">
                                    <label class="form-check-label">{{ $answer->text }}</label>
                                </div>
                            @endforeach

                        @elseif ($question->datatype == 'radio')  
                        
                            @foreach ($question->answers as $answer)                                                             
                                <div class="form-check form-check-inline">    
                                    <input class="form-check-input" type="radio" name="lead[{{$question->id}}][value]" value="{{ $answer->text }}" {{ $question->alow_null == 0 ? 'required' : 'required' }}>
                                    <label class="form-check-label">{{ $answer->text }}</label>
                                </div>                
                            @endforeach                    

                        @elseif ($question->datatype == 'date') 
                            {{ Form::text(
                                'lead[' . $question->id . '][value]',
                                '',                          
                                array(                            
                                    'class' => 'form-control ' . $question->html_class,                                                                                   
                                    $question->html5_pattern != '' ? 'pattern=' . "'" . $question->html5_pattern . "'" : '',
                                    $question->alow_null == 0 ? 'required' : ''                          
                                )
                            )}}                     
                            <span class="input-group-append">
                                <span class="input-group-text bg-light d-block">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>                               
                        @endif                      
                    </div>    
                </div>                                     
            @endforeach                   
            <div class="d-grid gap-2">                
                <button class="btn btn-success btn-block form-check" type="submit">Clique Aqui Para Enviar&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-arrow-right"></i>
                </button>                
            </div>
        </div>
    </form>
 
@endsection

@push('scripts')
        
    <script type="text/javascript">          
        
        // Example starter JavaScript for disabling form submissions if there are invalid fields        
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })            
        
        })()
        
        $('.date').mask('00/00/0000');
        $('.cpf').mask('000.000.000-00', {reverse: true});
        $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
        $('.cep').mask('00000-000');
        $('.phone_with_ddd').mask('(00) 00000-0000');
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
        $('.money2').mask("#.##0,00", {reverse: true});        

        
        var path = "{{ route('city.autocomplete') }}";
        $('input.city').typeahead({            
            source:  function (query, process) {
                if (query.length > 4)  {
                    return $.get(path, { query: query }, function (data) {
                        return process(data);
                    });
                }
            }
        });
        
        $( ".datepicker" ).datepicker({
            dateFormat: 'dd/mm/yy',
            closeText:"Fechar",
            prevText:"&#x3C;Anterior",
            nextText:"Próximo&#x3E;",
            currentText:"Hoje",
            monthNames: ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
            monthNamesShort:["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
            dayNames:["Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sábado"],
            dayNamesShort:["Dom","Seg","Ter","Qua","Qui","Sex","Sáb"],
            dayNamesMin:["Dom","Seg","Ter","Qua","Qui","Sex","Sáb"],
            weekHeader:"Sm",
            firstDay:1
        });

    </script>


@endpush
  



