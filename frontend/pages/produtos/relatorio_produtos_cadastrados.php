<?php
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

$html = '

<html>
    <head>
        <style type="text/css">
       @page {
            margin: 120px 50px 80px 50px;
        }
        table{
            border-collapse: collapse;
            width: 100%;
            position: relative;
        }
        td{
            padding: 3px;
        }
        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            border-top: 1px solid gray;
        }
        #footer .page:after{ 
            content: counter(page); 
        }
        </style>
    </head>
    <body>
<center><h1>Relatório de Produtos Cadastrados</h1></center>';

$html .= '
<br><br>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Categoria</th>
        </tr>
    </thead>
';


include("include/conexao.php");
include("include/banco-produto.php");

$produtos = listaProdutos($conexao);
$html .= '<tbody>';

foreach($produtos as $produto) :
    $html .= '<tr>';
    $html .= '  <td>'. $produto['nome'] .'</td>';
    $html .= '  <td>'. $produto['preco'] .'</td>';
    $html .= '  <td>'. $produto['descricao'] .'</td>';
    $html .= '  <td>'. $produto['categoria_nome'] .'</td>';
    $html .= '</tr>';
endforeach;    

$html .= '</tbody>';
$html .= '</table>';

//define o rodapé da página
$html .='</tbody>
</table>
</div>
<div id="footer">
    <p class="page">Página </p>
</div></body></html>  ';

// Transfora o HTML em PDF
$dompdf->load_html($html);

// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream("ProdutosCadastrados.pdf");