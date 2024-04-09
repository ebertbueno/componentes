<?php
use App\Repositories\Componentes;

$geraImagem = '';


$formato = ( !empty($formato) ? $formato : 'png' );
$largura = ( !empty($largura) ? $largura : 600 );
$altura = ( !empty($altura) ? $altura : 1200 );
$conteudo = ( !empty($conteudo) ? $conteudo : 'Texto de teste' );

// Set the content-type
header('Content-Type: image/png');

// Create the image
$im = imagecreatetruecolor($largura, $altura);

// Create some colors
$amarelo = imagecolorallocate($im, 244, 244, 182);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, $largura, $altura, $amarelo);

// The text to draw
$text = ___('Comprovante de transferência');
// Replace path by your own font path
$font = ''.resource_path().('\arial.ttf').'';

// Add some shadow to the text
imagettftext($im, 20, 0, 11, 21, $amarelo, $font, $text);

// Add the text
imagettftext($im, 20, 0, 10, 20, $black, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
$geraImagem = imagepng($im);
imagedestroy($im);
exit;

// http://html2canvas.hertzen.com/