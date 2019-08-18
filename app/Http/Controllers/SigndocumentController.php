<?php

namespace App\Http\Controllers;

use App\Signdocument;
use App\dfva_php\DfvaClient;
use Illuminate\Http\Request;

class SigndocumentController extends Controller
{
    public function create_signdocument(){
        $uploadedFile = request()->file('file_uploaded');
        $data_b64_uploaded = base64_encode(file_get_contents($uploadedFile));
        
        $doc = new Signdocument;
        $doc->file_uploaded = $data_b64_uploaded;
        $doc->file_name = $uploadedFile->getClientOriginalName();
        $doc->identificacion= request('identificacion');
        $doc->resumen=request('resumen');
        $doc->doc_format=request('doc_format');
        $doc->razon=request('razon');
        $doc->lugar=request('lugar');
        $doc->save();
        return redirect('/create_sign/'.$doc->id);
    }

    public function sign_screen(Request $request, $id){
        $doc = Signdocument::find($id);
        return view('signscreen', [
            'id_doc'=> $id,
            'domain' => $request->HTTP_HOST,
            'doc' => $doc
        ] );
    }
    public function sign($id){
        $doc = Signdocument::find($id);
        $file = $doc->file_uploaded;
        $client = new DfvaClient;
   
        $response = $client->sign($doc->identificacion, $file, 
                $doc->resumen, $_format=$doc->doc_format, $reason=$doc->razon,
            $place=$doc->lugar);

        $success = $response["status"] == 0;
        # JSON Response
        return ['FueExitosaLaSolicitud'=> $success,
        'TiempoMaximoDeFirmaEnSegundos'=> 240,
        'TiempoDeEsperaParaConsultarLaFirmaEnSegundos'=> 2,
        'CodigoDeVerificacion'=> $response['code'],
        'IdDeLaSolicitud'=> $response['id_transaction'],
        'DebeMostrarElError'=> !$success,
        'DescripcionDelError'=> $response['status_text'],
        'ResumenDelDocumento'=> $doc->resumen
        ];
    }
    public function sign_check($id){
        $client = new DfvaClient;
        $callback = request('callback');
        $id_transaction = request('IdDeLaSolicitud');

        $response = $client->sign_check($id_transaction);
        $status = $response['status'] == 0;
        $done = $response['received_notification'];
        if ($status && $done){
            $doc = Signdocument::find($id);
            $doc->file_signed = $response['sign_document'];
            $doc->file_signed_hash = $response['hash_docsigned'];
            $doc->signed=true;
            $doc->save();
            $client->sign_delete($id_transaction);
        }

        $dfva_response = $callback."(".json_encode(
                ["ExtensionData" =>  [],
                 "DebeMostrarElError" =>  !$status,
                 "DescripcionDelError" => $response['status_text'],
                 "FueExitosa"=> $status,
                 "SeRealizo"=> $done]
            ).")";
        

        return  $dfva_response;
    }

    public function download($id){
        $doc = Signdocument::find($id);
        $content = base64_decode($doc->file_signed);
        return response($content)
            ->withHeaders([
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename='.$doc->file_name
            ]);
    }
}
