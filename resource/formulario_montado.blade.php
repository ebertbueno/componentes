<form name="formulario" id="kt_modal_add_event_form" action="{!! $dados['url'] ?? '/' !!}" method="POST"
    enctype="multipart/form-data" onsubmit="return this.kt_account_profile_details_submit.disabled=true">
    @csrf
    <div class="row mb-6">
        @method($dados['formulario']['method'] ?? 'POST')
        @foreach ($dados['formulario'] as $key => $formulario)
            @include('telas.apenas_formulario', [
                'formulario' => $formulario,
            ])
        @endforeach
        @include('telas.script_formulario')
</form>
