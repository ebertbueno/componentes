<?php
$retorno = '<div class="form-group row">
<label class="col-sm-'.$tamLabel.' col-form-label">'.$required_label . ___('Senha').'</label>
<div class="col-sm-'.$tamDiv.'">
'.( !empty($mostraIconeA) ? '<div class="input-group m-b">'.$mostraIconeA : Null ).'
<input '.$campoLivre.' autocomplete="off" '.$required.' '.$readonly.' '.$minlength.' '.$maxlength.' name="'.$nome_no_banco_de_dados.'" type="password" id="senha" onkeyup="javascript:verifica()" class="'.$cssAdicionalInput.'" value=""></div>
'.( !empty($mostraIconeA) ? '</div>' : Null ).'
</div>';

if( $confirmacao === 0 ){
	$retorno .= '<div class="form-group row">
	<label class="col-sm-'.$tamLabel.' col-form-label">'.$required_label . ___('Confirme sua senha').'</label>
	<div class="col-sm-'.$tamDiv.'">
	'.( !empty($mostraIconeA) ? '<div class="input-group m-b">'.$mostraIconeA : Null ).'
	<input '.$campoLivre.' autocomplete="off" '.$required.' '.$readonly.' '.$minlength.' '.$maxlength.' name="re-'.$nome_no_banco_de_dados.'" type="password" id="senha" onkeyup="javascript:verifica()" class="'.$cssAdicionalInput.'" value="">
	'.( !empty($mostraIconeA) ? '</div>' : Null ).'
	</div>
	</div>';

	$retorno .= '<div class="form-group row">
	<label class="col-sm-'.$tamLabel.' col-form-label"></label>
	<div class="col-sm-'.$tamDiv.'">
	<script type="text/javascript">$(function () {$("#'.$nome_no_banco_de_dados.'").complexify({}, function (valid, complexity) {});});
	</script>
	<script>
	$(function (){
		$("#senha").keyup(function (e){
			var senha = $(this).val();        
			if(senha == ""){
				$("#senhaBarra").hide();
				}else{
					var fSenha = forcaSenha(senha);
					var texto = "";
					$("#senhaForca").css("width", fSenha+"%");
					$("#senhaForca").removeClass();
					$("#senhaForca").addClass("progress-bar");
					if(fSenha <= 40){
						texto = "'.___('Senha fraca').'";
						$("#senhaForca").addClass("progress-bar-danger");
					}

					if(fSenha > 40 && fSenha <= 70){
						texto = "'.___('Senha média').'";
					}

					if(fSenha > 70 && fSenha <= 90){
						texto = "'.___('Senha boa').'";
						$("#senhaForca").addClass("progress-bar-success");
					}

					if(fSenha > 90){
						texto = "'.___('Senha muito boa').'";
						$("#senhaForca").addClass("progress-bar-success");
					}

					$("#senhaForca").text(texto);

					$("#senhaBarra").show();
				}
				});
				});

				function forcaSenha(senha){
					var forca = 0;

					var regLetrasMa     = /[A-Z]/;
					var regLetrasMi     = /[a-z]/;
					var regNumero       = /[0-9]/;
					var regEspecial     = /[!@#$%&*?]/;

					var tam         = false;
					var tamM        = false;
					var letrasMa    = false;
					var letrasMi    = false;
					var numero      = false;
					var especial    = false;

					if(senha.length >= 6) tam = true;
					if(senha.length >= 10) tamM = true;
					if(regLetrasMa.exec(senha)) letrasMa = true;
					if(regLetrasMi.exec(senha)) letrasMi = true;
					if(regNumero.exec(senha)) numero = true;
					if(regEspecial.exec(senha)) especial = true;

					if(tam) forca += 10;
					if(tamM) forca += 10;
					if(letrasMa) forca += 10;
					if(letrasMi) forca += 10;
					if(letrasMa && letrasMi) forca += 20;
					if(numero) forca += 20;
					if(especial) forca += 20;

					return forca;
				}
				</script>
				<div style="height: 20px !important; background-color: #f8f8f8 !important; width:100%; margin:auto; border-radius: 50px;">
				<barraProgresso id="senhaBarra" class="progress" style="display: none; border-radius: 50px;">
				<barraProgresso id="senhaForca" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%; border-radius: 50px;"></barraProgresso>
				</barraProgresso>
				</div>
				</div>
				</div>
				';
			}