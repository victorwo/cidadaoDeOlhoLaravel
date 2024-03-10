<x-layout title='De olho nas eleições'>


    <h3>Selecione um mês abaixo para exibir os deputados que mais pediram reembolso de verbas indenizatórias nesse mês </h3>
	<form class="row g-3" action="" method="POST">
        @csrf
		<div class="mb-3">
			<select class="form-select" name="mes">
				<option value="">Escolha um mês</option>
				<option value="1">Janeiro</option>
				<option value="2">Fevereiro</option>
				<option value="3">Março</option>
				<option value="4">Abril</option>
				<option value="5">Maio</option>
				<option value="6">Junho</option>
				<option value="7">Julho</option>
				<option value="8">Agosto</option>
				<option value="9">Setembro</option>
				<option value="10">Outubro</option>
				<option value="11">Novembro</option>
				<option value="12">Dezembro</option>
			</select>
			
			<button type="submit" id="botao-enviar" class=" btn btn-primary mb-3 botao">Enviar</button>
		</div>
	</form>



</x-layout>