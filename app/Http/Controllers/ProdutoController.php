<?php namespace estoque\Http\Controllers;
use Illuminate\Support\Facades\DB;
use estoque\Produto;
use Request;
class ProdutoController extends Controller {

   public function lista(){
        $produtos = Produto::all();
        return view('produto.listagem')
            ->with('produtos', $produtos);
    }

    public function mostra($id){
        $produto = Produto::find($id);
        if(empty($produto)) {
            return "Esse produto não existe";
        }
        return view('produto.detalhes')
            ->with('p', $produto);
    }

    public function novo(){
        return view('produto.formulario');
    }

    public function adiciona(){

        Produto::create(Request::all());

        return redirect()
            ->action('ProdutoController@lista')
            ->withInput(Request::only('nome'));
    }

    public function listaJson(){
        $produtos = Produto::all();
        return response()->json($produtos);
    }

    public function remove($id){
        $produto = Produto::find($id);
        $produto->delete();
        return redirect()
            ->action('ProdutoController@lista');
    }
    
    /*public function editar($id){
        Produto::create(Request::all());

        return redirect()
            ->action('ProdutoController@lista')
            ->withInput(Request::only('nome'));
    }*/

}


//     public function lista(){

//         $produtos = Produto::all();
    
//         // $produtos = DB::select('select * from produtos');

//         // Renderizar o HTML da resouces/view
//         //return view('listagem')->withProdutos($produtos);
//         return view('produto.listagem')->with('produtos',$produtos);


//         // busca os produtos do banco
//     	//return view('listagem')->with('produtos', array());
//     }

//     public function mostra($id){
//  		//$id = Request::route('id'); // precisamos pegar o id de alguma forma
// 		// $resposta = DB::select('select * from produtos where id = ?', [$id]);
//         $produto = Produto::find($id);

// 		if(empty($produto)){
// 			return 'Esse produto não existe';
// 		}
// 		// Renderizar o HTML da resouces/view
//     	return view('produto.detalhes')->with('p',$produto);
//     }

//     public function novo(){
//         return view('produto.formulario');
//     }

//     // deve adicionar os produtos no banco
//     public function adiciona(){
//         // pegar dados do formulario
//         Produto::create(Request::all());

//         // $params = Request::all();
//         // $produto = new Produto($params);
//         // $produto->$nome = Request::input('nome');
//         // $produto->$valor = Request::input('valor');
//         // $produto->$descricao = Request::input('descricao');
//         // $produto->$quantidade = Request::input('quantidade');

//         // return implode( ', ', array($nome, 
//         // $descricao, $valor, $quantidade));

//         // salvar no banco de dados
//         //DB::insert('insert into produtos values (null, ?, ?, ?, ?)', array($nome, $valor, $descricao, $quantidade));
//         //$produto->save();

//         return redirect()->action('ProdutoController@lista')->withInput(Request::only('nome'));
//         //return redirect()->action('ProdutoController@index')->withInput(Request::only('nome'));
//         // listar os produtos
//         // $produtos = DB::select('select * from produtos');
//         // retornar alguma view 
//         // return view('produto.listagem')->with('nome', $nome);
//     }
//     public function remove($id){
//     // ...
//         $produto = Produto::find($id);
//         $produto->delete();
//         return redirect()->action('ProdutoController@lista');
// }

//     public function listaJson(){
//         $produtos = Produto::all();
//         return response()->json($produtos);
//         // $produtos = DB::select('select * from produtos');
//         // return $produtos;

//         //Acessar um método com esse retorno resultaria no download do arquivo presente no caminho especificado
//         return response()->download($caminhoParaUmArquivo);
//     }


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