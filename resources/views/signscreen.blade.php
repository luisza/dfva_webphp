@extends('layout')

@section('content')

<div class="row">
        <div class="col-md-10 offset-md-1">
                  
                <br><br><br>
                <h1 class="text-heading"> Documento a firmar:</h1>
                <pre>
                {{ $doc->resumen }}
                </pre>
                
                <button  class="btn btn-success"  id="BotonDeFirmar"
        data-fva="true" data-url="/sign/{{ $id_doc}}"
                          data-urlconsultafirma="/check_sign/{{$id_doc}}"
                          data-dominio="{{ $domain }}"
                          data-successurl="/download/{{$id_doc}}"
                          data-parautenticarse="al Sitio de Verificaci&oacute;n"
                          data-mensajedeerror="No se pudo realizar la firma en el sitio de verificaci&oacute;n."
                          > Firmar aceptación de documento </button>

  
                              
        </div>
    </div>
    
@endsection

@section('javascript_extra')
<script src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('js/Bccr.Fva.ClienteInterno.Firmador-1.0.3.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/firma-verificacion-1.0.3.js') }}"></script>
    
@endsection