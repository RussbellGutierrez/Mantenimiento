<?php
class Query {

	function anularHabilitarArticulo($anulado,$articulo){
		return "UPDATE oltp.catalogo_detalle SET anulado = ".$anulado." WHERE articulo = ".$articulo." ";
	}

	function articulosAnuladosChess(){
		return "SELECT cd.articulo,CAST (a.anulado AS INTEGER) AS anulado,CAST (a.colector AS INTEGER) AS colector 
				FROM oltp.catalogo_detalle cd 
				INNER JOIN chess.articulos a ON cd.articulo = a.codart ";
	}

	function getCategorias($opcion,$anulado=0){
		if ($opcion == 0) {
			return "SELECT id,descrip 
				FROM oltp.catalogo_categoria  
				WHERE anulado=".$anulado." 
				ORDER BY descrip ASC";
		}else if ($opcion == 1){
			return "SELECT id,descrip 
				FROM oltp.catalogo_categoria  
				WHERE anulado=".$anulado." 
				ORDER BY id ASC";
		}else{
			return "SELECT DISTINCT cc.id,cc.descrip 
				FROM oltp.catalogo_categoria cc 
				INNER JOIN oltp.catalogo_detalle cd ON cc.id=cd.categoria 
				AND cd.anulado=0 
				ORDER BY cc.id ASC";
		}
	}

	function getLineas($categoria,$anulado=0){
		if ($categoria == 0) {
			return "SELECT id,descrip  
				FROM oltp.catalogo_linea  
				WHERE anulado=".$anulado." 
				ORDER BY descrip ASC";
		}else if ($categoria == 1) {
			return "SELECT id,descrip  
				FROM oltp.catalogo_linea  
				WHERE anulado=".$anulado." 
				ORDER BY id ASC";
		}else {
			return "SELECT DISTINCT cl.id,cl.descrip,cd.categoria  
				FROM oltp.catalogo_linea cl 
				INNER JOIN oltp.catalogo_detalle cd ON cl.id=cd.linea 
				AND cd.anulado=0 
				AND ((" . $categoria . " <> 0 AND cd.categoria= " . $categoria . ") OR " . $categoria . " = 0) 
				ORDER BY cl.id ASC";
		}
	}

	function getGenericos($categoria,$linea,$anulado=0){
		if ($categoria == 0 && $linea == 0) {
			return "SELECT id,descrip  
				FROM oltp.catalogo_generico 
				WHERE anulado=".$anulado." 
				ORDER BY descrip ASC";
		}else if ($categoria == 1 && $linea == 1) {
			return "SELECT id,descrip  
				FROM oltp.catalogo_generico 
				WHERE anulado=".$anulado." 
				ORDER BY id ASC";
		}else{
			return "SELECT DISTINCT cg.id,cg.descrip,cd.linea  
				FROM oltp.catalogo_generico cg 
				INNER JOIN oltp.catalogo_detalle cd ON cg.id=cd.generico 
				AND cd.anulado=0 
				AND ((" . $categoria . " <> 0 AND cd.categoria= " . $categoria . ") OR " . $categoria . " = 0) 
				AND ((" . $linea . " <> 0 AND cd.linea= " . $linea . ") OR " . $linea . " = 0) 
				ORDER BY cg.id ASC";
		}
	}

	function getFamilias($categoria,$linea,$generico,$anulado=0){
		if ($linea == 0 && $generico == 0) {
			return "SELECT id,descrip  
				FROM oltp.catalogo_familia 
				WHERE anulado=".$anulado." 
				ORDER BY descrip ASC";
		}else if ($linea == 1 && $generico == 1) {
			return "SELECT id,descrip  
				FROM oltp.catalogo_familia 
				WHERE anulado=".$anulado." 
				ORDER BY id ASC";
		}else{
			return "SELECT DISTINCT cf.id,cf.descrip,cd.generico  
				FROM oltp.catalogo_familia cf 
				INNER JOIN oltp.catalogo_detalle cd ON cf.id=cd.familia 
				AND cd.anulado=0 
				AND ((" . $categoria . " <> 0 AND cd.categoria= " . $categoria . ") OR " . $categoria . " = 0) 
				AND ((" . $linea . " <> 0 AND cd.linea= " . $linea . ") OR " . $linea . " = 0) 
				AND ((" . $generico . " <> 0 AND cd.generico= " . $generico . ") OR " . $generico . " = 0) 
				ORDER BY cf.id ASC";
		}
	}

	function getArticulos($categoria,$linea,$generico,$familia){
		return "SELECT cd.articulo,ISNULL((SELECT ca.descrip 
											FROM oltp.catalogo_articulo ca  
											WHERE ca.id=cd.articulo),a.descrip) AS descrip,
						a.codprecan+ ' x ' +CAST(a.resto AS varchar) AS presentacion,a.ivadif,a.peso,cd.orden,cd.categoria,cd.linea,cd.generico,cd.familia,cd.factor  
				FROM oltp.catalogo_detalle cd 
				INNER JOIN chess.articulos a ON cd.articulo=a.codart 
				AND cd.anulado=0 
				AND cd.familia=" . $familia . " 
				AND cd.generico=" . $generico . "  
				AND cd.linea=" .$linea. " 
				AND cd.categoria=" .$categoria. " ";
	}

	function getArticulosLibres(){
		return "SELECT a.codart AS articulo,a.descrip,a.codprecan+ ' x ' +CAST(a.resto AS varchar) AS presentacion,a.ivadif,a.peso,ISNULL(cd.orden,0) AS orden,ISNULL(cd.categoria,0) AS categoria,ISNULL(cd.linea,0) AS linea,ISNULL(cd.generico,0) AS generico,ISNULL(cd.familia,0) AS familia,cd.factor    
				FROM chess.articulos a 
				INNER JOIN oltp.articulo_categoria ac on a.codart = ac.articulo 			 
				LEFT JOIN oltp.catalogo_detalle cd  ON  a.codart = cd.articulo 
				WHERE a.anulado = 0 
				AND ac.linea <> 998 
				AND ac.generico <> 998 
				AND ac.marca NOT IN (998,1052) 
				AND ac.articulo <> 998 
				AND a.colector <> 0 
				AND (cd.articulo IS NULL OR cd.categoria = 0 OR cd.linea = 0 OR cd.generico = 0 OR cd.familia = 0)";
	}

	function getListaOrdenar($generico,$familia,$articulo,$inicio,$fin){
		return "SELECT a.codart,cd.orden   
				FROM oltp.catalogo_detalle cd   
				INNER JOIN chess.articulos a ON cd.articulo = a.codart    
				INNER JOIN oltp.catalogo_generico cg ON cd.generico = cg.id    
				INNER JOIN oltp.catalogo_familia cf ON cd.familia = cf.id  
				AND cg.id = ".$generico." 
				AND cf.id = ".$familia."  
				AND cd.orden BETWEEN ".$inicio." AND ".$fin."   
				AND cd.articulo <> ".$articulo."  
				AND cd.anulado = 0  
				ORDER BY cd.orden ASC ";
	}

	function getPosicion($generico,$familia,$orden){
		return "SELECT a.codart,cd.orden  
				FROM oltp.catalogo_detalle cd  
				INNER JOIN chess.articulos a ON cd.articulo = a.codart   
				INNER JOIN oltp.catalogo_generico cg ON cd.generico = cg.id    
				INNER JOIN oltp.catalogo_familia cf ON cd.familia = cf.id   
				AND cg.id = ".$generico." 
				AND cf.id = ".$familia."   
				AND cd.orden = ".$orden."  
				AND cd.anulado = 0";
	}

	function articuloDescripcion($articulo){
		return "SELECT COUNT(*) AS total 
				FROM oltp.catalogo_articulo 
				WHERE id= ".$articulo." ";
	}

	function actualizarDescripcion($id,$descrip){
		return "UPDATE oltp.catalogo_articulo SET descrip = '".$descrip."' WHERE id = ".$id." ";
	}

	function setDescripcion($id,$descrip){
		return "INSERT INTO oltp.catalogo_articulo (id,descrip) VALUES (".$id.",'".$descrip."')";
	}

	function setCategoria($id,$descrip){
		return "INSERT INTO oltp.catalogo_categoria (id,descrip,anulado) VALUES (".$id.",'".$descrip."',0)";
	}

	function setLinea($id,$descrip){
		return "INSERT INTO oltp.catalogo_linea (id,descrip,anulado) VALUES (".$id.",'".$descrip."',0)";
	}

	function setGenerico($id,$descrip){
		return "INSERT INTO oltp.catalogo_generico (id,descrip,anulado) VALUES (".$id.",'".$descrip."',0)";
	}

	function setFamilia($id,$descrip){
		return "INSERT INTO oltp.catalogo_familia (id,descrip,anulado) VALUES (".$id.",'".$descrip."',0)";
	}

	function actualizarPosicion($articulo,$orden){
		return "UPDATE oltp.catalogo_detalle SET orden = ".$orden." WHERE articulo = ".$articulo." ";
	}

	function descripcionCategoria($id,$descrip){
		return "UPDATE oltp.catalogo_categoria SET descrip = '".$descrip."' WHERE id = ".$id." ";
	}

	function descripcionLinea($id,$descrip){
		return "UPDATE oltp.catalogo_linea SET descrip = '".$descrip."' WHERE id = ".$id." ";
	}

	function descripcionGenerico($id,$descrip){
		return "UPDATE oltp.catalogo_generico SET descrip = '".$descrip."' WHERE id = ".$id." ";
	}

	function descripcionFamilia($id,$descrip){
		return "UPDATE oltp.catalogo_familia SET descrip = '".$descrip."' WHERE id = ".$id." ";
	}

	function anularHabilitarCategoria($id,$anulado){
		return "UPDATE oltp.catalogo_categoria SET anulado = ".$anulado." WHERE id = ".$id." ";
	}

	function anularHabilitarLinea($id,$anulado){
		return "UPDATE oltp.catalogo_linea SET anulado = ".$anulado." WHERE id = ".$id." ";
	}

	function anularHabilitarGenerico($id,$anulado){
		return "UPDATE oltp.catalogo_generico SET anulado = ".$anulado." WHERE id = ".$id." ";
	}

	function anularHabilitarFamilia($id,$anulado){
		return "UPDATE oltp.catalogo_familia SET anulado = ".$anulado." WHERE id = ".$id." ";
	}

	function anularSegmentoArticulo($id,$opt){
		$sql = "";
		switch(intval($opt)){
			case 1:
				$sql = "UPDATE oltp.catalogo_detalle SET categoria = 0 WHERE categoria = ".$id." ";
				break;
			case 2:
				$sql = "UPDATE oltp.catalogo_detalle SET linea = 0 WHERE linea = ".$id." ";
				break;
			case 3:
				$sql = "UPDATE oltp.catalogo_detalle SET generico = 0 WHERE generico = ".$id." ";
				break;
			case 4:
				$sql = "UPDATE oltp.catalogo_detalle SET familia = 0 WHERE familia = ".$id." ";
				break;
		}
		return $sql;
	}

	function asignarArticuloLibre($articulo,$categoria,$linea,$generico,$familia){
		return "INSERT INTO oltp.catalogo_detalle (articulo,categoria,linea,generico,familia,orden,anulado) VALUES (".$articulo.",".$categoria.",".$linea.",".$generico.",".$familia.",99,0)";
	}

	function asignarArticulo($articulo,$categoria,$linea,$generico,$familia){
		return "UPDATE oltp.catalogo_detalle SET categoria = ".$categoria." ,linea = ".$linea." ,generico = ".$generico." ,familia = ".$familia." WHERE articulo = ".$articulo." ";
	}

	function asignarFactor($articulo,$factor){
		return "UPDATE oltp.catalogo_detalle SET factor = ".$factor." WHERE articulo = ".$articulo." ";
	}

	/**CONSULTAS ANTIGUAS*/
	function getListaMarcas(){
		return "select am.id as codigo,am.descrip as marca,count(*) as cantidad   
				from oltp.articulo_categoria ac   
				inner join chess.articulos a on ac.articulo = a.codart  
				inner join oltp.articulo_marca am on ac.marca = am.id   
				inner join oltp.articulo_generico ag on ac.generico = ag.id  
				inner join oltp.articulo_linea al on ac.linea = al.id   
				and a.anulado = 0   
				and ac.marca <> 998   
				and ac.marca <> 1052  
				and al.id <> 998   
				and ag.id <> 998   
				and ac.articulo <> 998    
				and a.colector <> 0   
				group by am.id,am.descrip   
				order BY am.id ASC";
		/*return "select m.codmarca as codigo,m.descmarca as marca,count(*) as cantidad  
				from chess.articulos a  
				inner join chess.marca m on a.codmarca = m.codmarca 
				inner join chess.geneart ga on a.codgene = ga.codgene 
				inner join chess.genelin g on a.codgene = g.codgene 
				inner join chess.linprodu l on g.codlin = l.codlin 
				and a.anulado = 0 
				and m.codmarca <> 998 
				and l.codlin <> 998 
				and ga.codgene <> 998 
				and a.codart <> 998  
				and a.colector <> 0  
				group by m.codmarca,m.descmarca 
				order by m.codmarca ASC";*/
	}

	function getDetalleListaMarcas(){
		return "select cd.marca as codigo,am.descrip as marca,count(cd.codart) as detalle  
				from oltp.catalogo_detalle_old cd  
				inner join oltp.articulo_marca am on cd.marca = am.id  
				and cd.marca <> 998  
				group by cd.marca,am.descrip  
				order BY cd.marca ASC";
		/*return "select m.codmarca as codigo,m.descmarca as marca,count(d.codart) as detalle  
				from cata.detalle d 
				inner join chess.marca m on d.marca = m.codmarca 
				and m.codmarca <> 998 
				group by m.codmarca,m.descmarca 
				order by m.codmarca ASC";*/
	}

	function getTodoChess($marca,$linea,$generico,$familia){
		return "select ac.marca AS codmarca,am.descrip AS descmarca,al.id AS codlin,al.descrip AS linprodu,ag.id AS codgene,ag.descrip AS descrip,isnull(cd.familia,0) as codfam,isnull(cf.descripcion,'NINGUNO') as familia,a.codart,a.descrip as articulo,a.codprecan+ ' x ' +cast(a.resto as varchar) as presentacion,a.ivadif,a.peso,isnull(cd.orden,0) as orden  
			from oltp.articulo_categoria ac  
			inner join chess.articulos a on ac.articulo = a.codart  
			left join oltp.catalogo_detalle_old cd on ac.articulo = cd.codart   
			left join oltp.catalogo_familia_old cf on cd.familia = cf.codigo   
			inner join oltp.articulo_marca am on ac.marca = am.id    
			inner join oltp.articulo_generico ag on ac.generico = ag.id   
			inner join oltp.articulo_linea al on ac.linea = al.id   
			and a.anulado = 0   
			and ac.marca <> 998   
			and al.id <> 998   
			and ag.id <> 998   
			and ac.articulo <> 998    
			and a.colector <> 0    
			and ((" . $marca . " <> 0 AND ac.marca = " . $marca . ") OR " . $marca . " = 0)  
			and ((" . $linea . " <> 0 AND al.id = " . $linea . ") OR " . $linea . " = 0)  
			and ((" . $generico . " <> 0 AND ag.id = " . $generico . ") OR " . $generico . " = 0) 
			and ((" . $familia . " <> 0 AND cf.codigo = " . $familia . ") OR " . $familia . " = 0)  
			order by ac.marca,al.id,ag.id,cd.orden ASC";
		/*return "select m.codmarca,m.descmarca,l.codlin,l.linprodu,ga.codgene,ga.descrip,isnull(d.familia,0) as codfam,isnull(f.descripcion,'NINGUNO') as familia,a.codart,a.descrip as articulo,a.codprecan+ ' x ' +cast(a.resto as varchar) as presentacion,a.ivadif,a.peso,isnull(d.orden,0) as orden  
			from chess.articulos a  
			left join cata.detalle d on a.codart = d.codart  
			left join cata.familia f on d.familia = f.codigo  
			inner join chess.marca m on a.codmarca = m.codmarca  
			inner join chess.geneart ga on a.codgene = ga.codgene  
			inner join chess.genelin g on a.codgene = g.codgene  
			inner join chess.linprodu l on g.codlin = l.codlin  
			and a.anulado = 0  
			and m.codmarca <> 998  
			and l.codlin <> 998  
			and ga.codgene <> 998  
			and a.codart <> 998   
			and a.colector <> 0   
			and ((" . $marca . " <> 0 AND m.codmarca = " . $marca . ") OR " . $marca . " = 0) 
			and ((" . $linea . " <> 0 AND l.codlin = " . $linea . ") OR " . $linea . " = 0) 
			and ((" . $generico . " <> 0 AND ga.codgene = " . $generico . ") OR " . $generico . " = 0)
			and ((" . $familia . " <> 0 AND f.codigo = " . $familia . ") OR " . $familia . " = 0) 
			order by m.codmarca,l.codlin,ga.codgene,d.orden ASC ";*/
	}

	function setDetalles($codart,$familia,$generico,$linea,$marca,$orden){
		if ($familia > 0) {
			return "insert into oltp.catalogo_detalle_old (codart,familia,generico,linea,marca,orden) values (" . $codart . "," . $familia . "," . $generico . "," . $linea . "," . $marca . "," . $orden . ")";
		}else{
			return "insert into oltp.catalogo_detalle_old (codart,generico,linea,marca,orden) values (" . $codart . "," . $generico . "," . $linea . "," . $marca . "," . $orden . ")";
		}
		/*if ($familia > 0) {
			return "insert into cata.detalle (codart,familia,generico,linea,marca,orden) values (" . $codart . "," . $familia . "," . $generico . "," . $linea . "," . $marca . "," . $orden . ")";
		}else{
			return "insert into cata.detalle (codart,generico,linea,marca,orden) values (" . $codart . "," . $generico . "," . $linea . "," . $marca . "," . $orden . ")";
		}*/
	}

	function setFamilias($descripcion,$generico,$marca){
		return "insert into oltp.catalogo_familia_old (descripcion,generico,marca) values ('" . $descripcion . "'," . $generico . "," . $marca . ")";
		//return "insert into cata.familia (descripcion,generico,marca) values ('" . $descripcion . "'," . $generico . "," . $marca . ")";
	}

	function updatePosicion($codigo,$orden){
		return "update oltp.catalogo_detalle_old set orden = ".$orden." where codart = ".$codigo." ";
		//return "update cata.detalle set orden = ".$orden." where codart = ".$codigo." ";
	}

	function updateFamilia($codigo,$familia){
		return "update oltp.catalogo_detalle_old set familia = ".$familia." where codart = ".$codigo." ";
		//return "update cata.detalle set familia = ".$familia." where codart = ".$codigo." ";
	}

	function updateDescripFamilia($codigo,$descripcion){
		return "update oltp.catalogo_familia_old set descripcion = '".$descripcion."' where codigo = ".$codigo." ";
		//return "update cata.familia set descripcion = '".$descripcion."' where codigo = ".$codigo." ";
	}

	function removeFamiliaArticulo($codigo){
		return "update oltp.catalogo_detalle_old set familia = null where codart = ".$codigo." ";
		//return "update cata.detalle set familia = null where codart = ".$codigo." ";
	}

	function quitarFamilia($codigo){
		return "delete from oltp.catalogo_familia_old where codigo = ".$codigo." ";
		//return "delete from cata.familia where codigo = ".$codigo." ";
	}

	function deleteTodaFamilia($codigo){
		return "delete from oltp.catalogo_familia_old where generico = ".$codigo." ";
		//return "delete from cata.familia where generico = ".$codigo." ";
	}

	function deleteDetalle($codigo){
		return "delete from oltp.catalogo_detalle_old where marca = ".$codigo." ";
		//return "delete from cata.detalle where marca = ".$codigo." ";
	}

	function getMarcas($codigo,$descripcion){
		return "select am.id as codmarca,am.descrip as descmarca  
				from oltp.catalogo_detalle_old cd   
				inner join oltp.articulo_marca am on cd.marca = am.id  
				group BY am.id,am.descrip  
				order by am.id ASC";
		/*return "select m.codmarca,m.descmarca  
				from cata.detalle d  
				inner join chess.marca m on d.marca = m.codmarca  
				group by m.codmarca,m.descmarca  
				order by m.codmarca ASC ";*/
	}

	/*function getFamilias($marca,$generico,$descripgene,$descripfam){
		return "select cf.codigo,cf.descripcion,cf.generico,cf.marca  
				from oltp.catalogo_familia_old cf 
				inner join oltp.articulo_generico ag on cf.generico = ag.id  
				and (('" . $marca . "' <> 0 AND cf.marca = " . $marca . ") OR '" . $marca . "' = 0)  
				and (('" . $generico . "' <> 0 AND ag.id = " . $generico . ") OR '" . $generico . "' = 0)  
				and (('" . $descripgene . "' not like 'ninguno' AND ag.descrip like '" . $descripgene . "') OR '" . $descripgene . "' = 'ninguno')   
				and (('" . $descripfam . "' not like 'ninguno' AND cf.descripcion like '" . $descripfam . "') OR '" . $descripfam . "' = 'ninguno')";
		return "select f.codigo,f.descripcion,f.generico,f.marca  
				from cata.familia f 
				inner join chess.geneart g on f.generico = g.codgene  
				and (('" . $marca . "' <> 0 AND f.marca = " . $marca . ") OR '" . $marca . "' = 0)  
				and (('" . $generico . "' <> 0 AND g.codgene = " . $generico . ") OR '" . $generico . "' = 0)  
				and (('" . $descripgene . "' not like 'ninguno' AND g.descrip like '" . $descripgene . "') OR '" . $descripgene . "' = 'ninguno')   
				and (('" . $descripfam . "' not like 'ninguno' AND f.descripcion like '" . $descripfam . "') OR '" . $descripfam . "' = 'ninguno')";
	}*/

	/*function getPosicion($codigo,$descripcion,$orden){
		return "select a.codart,cd.orden  
				from oltp.catalogo_detalle_old cd  
				inner join chess.articulos a on cd.codart = a.codart   
				inner join oltp.articulo_generico ag on cd.generico = ag.id   
				and ag.id = ".$codigo."  
				and ag.descrip like '" . $descripcion . "'  
				and cd.orden = ".$orden."  
				and a.colector <> 0";
		return "select a.codart,d.orden 
				from cata.detalle d 
				inner join chess.articulos a on d.codart = a.codart   
				inner join chess.geneart g on d.generico = g.codgene   
				and g.codgene = ".$codigo." 
				and g.descrip like '" . $descripcion . "' 
				and d.orden = ".$orden."  
				and a.colector <> 0 ";
	}*/

	/*function getListaOrdenar($codigo,$descripcion,$articulo,$inicio,$fin){
		return "select a.codart,cd.orden   
				from oltp.catalogo_detalle_old cd   
				inner join chess.articulos a on cd.codart = a.codart    
				inner join oltp.articulo_generico ag on cd.generico = ag.id    
				and ag.id = ".$codigo."   
				and ag.descrip like '" . $descripcion . "'  
				and cd.orden between ".$inicio." and ".$fin."   
				and cd.codart <> ".$articulo."  
				and a.colector <> 0  
				order by cd.orden asc";
		return "select a.codart,d.orden 
				from cata.detalle d 
				inner join chess.articulos a on d.codart = a.codart   
				inner join chess.geneart g on d.generico = g.codgene   
				and g.codgene = ".$codigo." 
				and g.descrip like '" . $descripcion . "' 
				and d.orden between ".$inicio." and ".$fin." 
				and d.codart <> ".$articulo."  
				and a.colector <> 0  
				order by d.orden asc ";
	}*/

	function getDetalles($familia,$generico){
		return "select codart as codigo 
				from oltp.catalogo_detalle_old  
				where (('" . $familia . "' <> 0 AND familia = " . $familia . ") OR '" . $familia . "' = 0) 
				and (('" . $generico . "' <> 0 AND generico = " . $generico . ") OR '" . $generico . "' = 0)";
		/*return "select codart as codigo 
				from cata.detalle  
				where (('" . $familia . "' <> 0 AND familia = " . $familia . ") OR '" . $familia . "' = 0) 
				and (('" . $generico . "' <> 0 AND generico = " . $generico . ") OR '" . $generico . "' = 0)";*/
	}

	function getArticuloNoFamilia(){
		return "select cd.marca,am.descrip as descmarca,cd.linea,al.descrip as linprodu,cd.generico,ag.descrip,ISNULL(cd.familia,0) as familia,cd.codart,a.descrip as articulo   
				from oltp.catalogo_detalle_old cd  
				inner join oltp.articulo_marca am on cd.marca = am.id  
				inner join oltp.articulo_linea al on cd.linea = al.id  
				inner join oltp.articulo_generico ag on cd.generico = ag.id  
				inner join chess.articulos a on cd.codart = a.codart  
				and cd.familia is null  
				order by cd.marca,cd.linea,cd.generico,cd.codart ASC";
		/*return "select d.marca,m.descmarca,d.linea,l.linprodu,d.generico,ga.descrip,ISNULL(d.familia,0) as familia,d.codart,a.descrip as articulo   
				from cata.detalle d  
				inner join chess.marca m on d.marca = m.codmarca  
				inner join chess.linprodu l on d.linea = l.codlin   
				inner join chess.geneart ga on d.generico = ga.codgene  
				inner join chess.articulos a on d.codart = a.codart  
				and d.familia is null  
				order by d.marca,d.linea,d.generico,d.codart ASC  ";*/
	}
}