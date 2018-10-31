<h4 class="c-grey-900 mB-20">Lista de Artigos</h4>
<?php
	if (!Yii::app()->user->isGuest)
	{
		echo CHtml::button('Novo Artigo', array('class'=>'btn cur-p btn-primary', 'onClick'=>'window.location.href = "'. Yii::app()->createUrl("artigo/formulario") . '"'));
		echo '<br /><br />';
	}
	
	$this->renderPartial('filtro', array(
		'arrFiltros'=>$arrFiltros,
		'filtroUsado'=>$filtroUsado,
		'imgFiltro'=>$imgFiltro,
	));
	
	echo '<div class="table-responsive">';
		$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$dataProvider,
			'itemsCssClass'=>'table table-striped table-bordered table-condensed',
			'columns'=>array(
				array(
					'header'=>'Nome',
					'value'=>'$data->NomeArtigo',
				),
				array(
					'header'=>'Tema da Pesquisa',
					'value'=>'$data->ObjetoPesquisa->NomeObjetoPesquisa',
				),
				array(
					'header'=>'Revista / Periódico',
					'value'=>'(!empty($data->NomeRevistaConferencia) ? $data->NomeRevistaConferencia : "-")',
				),
				array(
					'header'=>'Ano de Publicação',
					'value'=>'$data->AnoPublicacao',
				),
				array(
					'header'=>'Autor(es)',
					'value'=>'$data->Autor->getNomeAutores($data->CodArtigo)',
				),
				array(
					'htmlOptions'=>array('style'=>"width: 30px; text-align: center;"),
					'header'=>'Visualizar',
					'class'=>'CButtonColumn',
					'template'=>'{view} {update}',
					'buttons'=>array(
						'view'=>array
						(
							'label'=>'Visualizar',
							'imageUrl'=>Yii::app()->request->baseUrl.'/images/documento.png',
							'url'=>'Yii::app()->createUrl("artigo/visualizar", array("CodArtigo"=>"$data->CodArtigo"))',
						),
						'update' => array
						(
							'label'=>'Editar',
							'imageUrl'=>Yii::app()->request->baseUrl.'/images/editar.png',
							'url'=>'Yii::app()->createUrl("artigo/formulario", array("CodArtigo"=>"$data->CodArtigo"))',
							'visible'=>'Yii::app()->user->isGuest ? false : true',
						),
					)
				),
			),
		));
	echo '</div>';
?>
<script>
	$(document).ready(function() {
		$('.toggleField').unbind('click');
	    
		$('.toggleField').click(function() {
	        if($(this).attr('src')=='<?php echo Yii::app()->baseUrl; ?>/images/contrair.gif') 
			{
	            $(this).attr('src','<?php echo Yii::app()->baseUrl; ?>/images/expandir.gif');
	        } else 
			{
	            $(this).attr('src','<?php echo Yii::app()->baseUrl; ?>/images/contrair.gif');
	        }
	        $('#divFieldset').slideToggle();
	    });
	    
		$('#Filtro_AnoPublicacao').mask('0000');
	});
	
	function enviarFiltros()
	{
		if ($('#Filtro_NomeArtigo').val() == '')
			$('#iptCodArtigo').val('');
		
		if ($('#Filtro_NomeInstituicao').val() == '')
			$('#iptCodInstituicao').val('');
	
		if ($('#Filtro_NomeAutor').val() == '')
			$('#iptCodAutor').val('');

		if ($('#Filtro_NomePalavra').val() == '')
			$('#iptCodPalavra').val('');
		
		$("#frmFiltro").submit();
	}
	
	function limparFiltros()
	{
		$('#frmFiltro *').filter(':input').each(function(){
			$(this).val('');
		});
	}
</script>