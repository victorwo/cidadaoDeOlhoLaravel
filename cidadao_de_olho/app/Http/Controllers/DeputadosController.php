<?php
	
	namespace App\Http\Controllers;
	
	use App\Models\Deputado;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Http\Request;

	ini_set('max_execution_time', 300);

	
	class DeputadosController{
		
		public function listar(){
			$deputado = Deputado::all();
            
			return view('deputados.index')->with('deputados', $deputado);
		}

		public function cadastrar(){
			
			$infoDeputados = file_get_contents("http://dadosabertos.almg.gov.br/ws/deputados/situacao/1?formato=json");
			$decode = json_decode($infoDeputados, true);
			$numero = 0;
			$numDeDeputados = 77;
			
			#Percorre cada index do json e salva cada um deles no banco de dados
			foreach($decode as $chave => $valor){
				while ($numero < $numDeDeputados){
					
					$deputado = new Deputado();
					$deputado->id = $valor[$numero]["id"];
					$deputado->nome = $valor[$numero]["nome"];
					$deputado->partido = $valor[$numero]["partido"];
					$deputado->verba = 0;
					$deputado->save();
						
							
					$numero = $numero +1;
				}		
			}

			return view('deputados.pesquisar');
		}

		public function pesquisar(){

			return view('deputados.pesquisar');
		}

		public function listarDeputados($mes){

			$meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
			$novoMes = $meses[$mes - 1];

			$deputado = Deputado::select('id','nome','verba','partido')
                   ->orderBy('verba', 'desc')
				   ->take(5)
                   ->get();
			
			$redesSociais = $this->listarRedesSociais();

			return view('deputados.exibir', compact('novoMes', 'deputado', 'redesSociais'));
		}

		public function calcularVerbas(Request $request){
			$mes = $request -> input('mes');

			#echo $mes;

			
			$deputados = Deputado::all();
			foreach ($deputados as $deputado) {
				$idDeputado = $deputado -> id;
				$valorIndenizado = 0;
				$verbas = file_get_contents("https://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/deputados/$idDeputado/2019/$mes?formato=json");
				$jsonDecode = json_decode($verbas, true);
				

				//Percorre todos os gastos de cada deputado
				foreach($jsonDecode as $chave => $valor){
					
					$tamanhoArray = count($valor);
							
					for($j = 0; $j < $tamanhoArray; $j++){
						$valorIndenizado += $valor[$j]["valor"];
					}
				}
				$dep = Deputado::find($idDeputado);
				$dep->verba = $valorIndenizado;
				$dep->update();

			}


			return $this->listarDeputados($mes);
		}

		//Faz um exibição das redes sociais mais utilizadas
		public function listarRedesSociais(){
			$listaTel = file_get_contents("https://dadosabertos.almg.gov.br/ws/deputados/lista_telefonica?formato=json");
			$listaDecode = json_decode($listaTel, true);
			
			$listaRedes = array(
				"Facebook" => 0,
				"Twitter" => 0,
				"LinkedIn" => 0,
				"WhatsApp" => 0,
				"Instagram" => 0,
				"Youtube" => 0,
				"Flickr" => 0,
				"Telegram" => 0,
				"TikTok" => 0,
				"SoundCloud" => 0,
			);
			
			
			foreach($listaDecode as $key => $value){
				$tamanhoArray = count($value);
								
				for($i = 0; $i < $tamanhoArray; $i++){
					$redes = $value[$i]["redesSociais"];
					$numRedes = count($redes);
					
					for($j=0; $j<$numRedes; $j++){
						$nomeRede = $redes[$j]["redeSocial"]["nome"];
						$listaRedes[$nomeRede] += 1;
					}
				}
			}

			asort($listaRedes);
			$reversed = array_reverse($listaRedes);
			$reversed = array_keys($reversed);

			$redesMaisUtilizadas = array();
			for($i=0; $i < count($reversed); $i++ ){
				 $redesMaisUtilizadas[]  =$reversed[$i] ;

			}
			return $redesMaisUtilizadas;
		}


	
	}


?>