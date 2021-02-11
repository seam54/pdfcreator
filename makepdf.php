<?php

// read library 
require('tfpdf/tfpdf.php');
// create instance
$pdf = new tFPDF;

//$pdf->AddPage();

// AddFont( [フォントの種類] ,[フォントのスタイル] ,[フォントのファイル], [UTF-8を使うか])  
$pdf->AddFont('ShipporiMincho','', 'ShipporiMincho-TTF-Regular.ttf', true);
// SetFont( [フォントの種類] ,[フォントのスタイル] ,[フォントのファイル])
//$pdf->SetFont('ShipporiMincho', '', 20);
// Cell( [横幅], [縦幅], [表示したい文字], [傍線]) 横幅0:右端まで全て伸ばす
// B は Bottom の略で、下にボーダーを引きます。 他には、T(Top) や L(Left) R(Right)があり、
// 全方位囲むには 1 を指定します。
//$pdf->Cell(40,10,'Hello World!');
// Ln( [縦の長さ]) 改行
// $pdf->Ln(10);

$names = explode("\n", $_GET['names']);

foreach ($names as $name) {
	$pdf->SetFont('ShipporiMincho','',20);
 	$pdf->AddPage();
	$pdf->Cell(0,10,"たし算練習プリント");
	$pdf->Ln(5);
	$pdf->Cell(100);
	
	$pdf->Cell(90,10,"名前 : $name","B");
	
	$pdf->Ln(40);

	$Y = $pdf->getY();

	make_contents();
	
	$pdf->SetFont('ShipporiMincho','',18);
	$pdf->setXY(180,270);
	$pdf->Cell(22,6,"return","B","","","","http://localhost/pdfcreator/form.html");
	
}

$pdf->Output();

function make_contents() {
	// 関数の外で宣言されている$pdfを宣言
	global $pdf;
	
	$contents = explode("\n", $_GET['contents']);
	$count = 0;
	$Y = $pdf->getY();
	
	foreach($contents as $content) {
		$count++;
		if($count == 10) {
			$pdf->setY($Y);
		}
		if($count >= 10) {
			$pdf->setX(110);
		}
		
		$pdf->SetFont('ShipporiMincho','',25);
		$pdf->Cell(20,10,"($count)");
		$pdf->SetFont('ShipporiMincho','',30);
		$pdf->Cell(80,10,"$content =");
		$pdf->Ln(25);
	}
	
}

?>