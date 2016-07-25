<?php namespace estoque\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Request;
class ProdutoController extends Controller {

    public function lista(){
        $produtos = DB::select('select * from produtos');

        // Renderizar o HTML da resouces/view
        //return view('listagem')->withProdutos($produtos);
        return view('produto.listagem')->with('produtos',$produtos);


        // busca os produtos do banco
    	//return view('listagem')->with('produtos', array());
    }

    public function mostra($id){
 		//$id = Request::route('id'); // precisamos pegar o id de alguma forma
		$resposta = DB::select('select * from produtos where id = ?', [$id]);

		if(empty($resposta)){
			return 'Esse produto não existe';
		}
		// Renderizar o HTML da resouces/view
    	return view('produto.detalhes')->with('p',$resposta[0]);
    }

    public function novo(){
        return view('produto.formulario');
    }

    // deve adicionar os produtos no banco
    public function adiciona(){
        // pegar dados do formulario
        $nome = Request::input('nome');
        $valor = Request::input('valor');
        $descricao = Request::input('descricao');
        $quantidade = Request::input('quantidade');

        // return implode( ', ', array($nome, 
        // $descricao, $valor, $quantidade));

        // salvar no banco de dados
        DB::insert('insert into produtos values (null, ?, ?, ?, ?)', array($nome, $valor, $descricao, $quantidade));

        // retornar alguma view 
        return view('produto.adicionado')->with('nome', $nome);
    }

}

/*    

    public function lista(){

        $html = '<h1>Listagem de produtos com Laravel</h1>';

        $html .= '<ul>';

        $produtos = DB::select('select * from produtos');

        foreach ($produtos as $p) {
            $html .= '<li> Nome: '. $p->nome .', Descrição: '. $p->descricao .'</li>';
        }

        $html .= '</ul>';

        return $html;
    }
public function lista(){
    	$html = '<h1>Listagem de produtos com Laravel</h1>';
    	$produtos = DB::select('select * from produtos'); 
		 foreach ($produtos as $value) {
		 	$html .= 'Nome : '.$value->nome.'<br>'.PHP_EOL;
		 }
        return $html;
    }
}*/