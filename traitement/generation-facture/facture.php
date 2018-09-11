<?php
	require('fpdf.php');

	//Declaration du PDF
	$pdf=new FPDF('P','mm','A4');

	include_once('../php/connexion_sql.php');

	$var_id_commande = $_GET['id_commande'];

	// on sup les 2 cm en bas
	$pdf->SetAutoPagebreak(False);
	$pdf->SetMargins(0,0,0);

	// nb de page pour le multi-page
	$reponse=$bdd->query('SELECT COUNT(*) AS nb FROM ligne_commande WHERE codCom='.$var_id_commande.'') or die(print_r($bdd->errorInfo()));
	$nb_page=0;
	while($donnees=$reponse->fetch())
	{
		$nb_page=$donnees['nb'];
	}

	$reponse1=$bdd->query('SELECT ABS(FLOOR(-' . $nb_page . '/18)) AS nb') or die(print_r($bdd->errorInfo()));
	while($donnees1=$reponse1->fetch())
	{
		$nb_page=$donnees1['nb'];
	}

	$num_page = 1;
	$limit_inf = 0;
	$limit_sup = 18;

	while($num_page<=$nb_page)
	{
		$pdf->AddPage();

		// logo : 80 de largeur et 55 de hauteur
		$pdf->Image('../../media/logo_societe.png', 10, 10, 80, 55);

		// n° page en haute à droite
		$pdf->SetXY(120,5);
		$pdf->SetFont("Arial","B",12);
		$pdf->Cell(160,8,$num_page.'/'.$nb_page,0,0,'C');

		// n° commande, date commande, montant commande et montant


		$reponse3=$bdd->query('SELECT dateCom, adresse, SUM(prix_total) AS total, nom FROM commande, ligne_commande, client WHERE commande.id='.$var_id_commande.' AND commande.id=ligne_commande.codCom AND client.codCli=commande.codeCli GROUP BY commande.id') or die(print_r($bdd->errorInfo()));

		$champ_date=NULL;
		$champ_total=NULL;
		$champ_adresse=NULL;
		$champ_nom_client=NULL;

		while($donnees3=$reponse3->fetch())
		{
			$champ_date=date_parse($donnees3['dateCom']);
			$champ_total=$donnees3['total'];
			$champ_adresse=$donnees3['adresse'];
			$champ_nom_client=$donnees3['nom'];
		}

		$annee=$champ_date['year'];
		$num_fact=iconv('UTF-8','ISO-8859-15',"FACTURE N° ").$annee.'-'.$var_id_commande;
		$pdf->SetLineWidth(0.1);
		$pdf->SetFillColor(192);
		$pdf->Rect(120,15,85,8,"DF");
		$pdf->SetXY(120,15);
		$pdf->SetFont("Arial","B",12);
		$pdf->Cell(85,8,$num_fact,0,0,'C');

		//Nom du fichier final
		$nom_file="fact_".$annee.'-'.$var_id_commande.".pdf";

		//Date facture
		$date_fact=$champ_date['day'].'/'.$champ_date['month'].'/'.$champ_date['year'];
		$pdf->SetFont('Arial','',11);
		$pdf->SetXY(122,30);
		$pdf->Cell(60,8,"Dakar, le ".$date_fact,0,0,'');

		if($num_page==$nb_page)
		{
			// les totaux, on n'affiche que le HT. le cadre après les lignes, demarre a 213
			$pdf->SetLineWidth(0.1);
			$pdf->SetFillColor(192);
			$pdf->Rect(120,213,85,8,"DF");
			// reglement
			$pdf->SetXY( 5, 225 );
			$pdf->Cell( 38, 5, iconv('UTF-8','ISO-8859-15',"Mode de Règlement :"), 0, 0, 'R');
			// observations
			$pdf->SetFont( "Arial", "BU", 10 );
			$pdf->SetXY( 5, 75 ) ;
			$pdf->Cell($pdf->GetStringWidth("Observations"), 0, "Observations", 0, "L");

			// adresse du client
			$pdf->SetFont('Arial','B',11);
			$x = 110 ;
			$y = 50;
			$pdf->SetXY( $x, $y );
			$pdf->Cell( 100, 8, $champ_nom_client, 0, 0, '');
			$y += 4;
			if($champ_adresse)
			{
				$pdf->SetXY( $x, $y );
				$pdf->Cell( 100, 8, $champ_adresse, 0, 0, '');
				$y += 4;
			}
			
			// le cadre des articles
			// cadre avec 18 lignes max ! et 118 de hauteur --> 95 + 118 = 213 pour les traits verticaux
			$pdf->SetLineWidth(0.1);
			$pdf->Rect(5, 95, 200, 118, "D");
			// cadre titre des colonnes
			$pdf->Line(5, 105, 205, 105);
			// les traits verticaux colonnes
			$pdf->Line(120, 95, 120, 213);
			$pdf->Line(151, 95, 151, 213);
			$pdf->Line(178, 95, 178, 213);
			// titre colonne
			$pdf->SetXY( 1, 96 ); $pdf->SetFont('Arial','B',8);
			$pdf->Cell( 120, 8, iconv('UTF-8','ISO-8859-15',"Libellé"), 0, 0, 'C');
			$pdf->SetXY( 145, 96 );
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell( -20, 8, iconv('UTF-8','ISO-8859-15',"Quantité"), 0, 0, 'C');
			$pdf->SetXY( 156, 96 );
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell( 17, 8, iconv('UTF-8','ISO-8859-15',"Prix unitaire"), 0, 0, 'C');
			$pdf->SetXY( 185, 96 );
			$pdf->SetFont('Arial','B',8); $pdf->Cell( 12, 8, "Total", 0, 0, 'C');

			// Les articles
			$pdf->SetFont('Arial','',8);
			$y = 97;
			// 1ere page = LIMIT 0,18 ;  2eme page = LIMIT 18,36 etc...

			$reponse2=$bdd->query('SELECT designation, qteCom, prixUnitaire ,prix_total FROM ligne_commande lc, produit p, commande c WHERE p.codProd=lc.codProd AND c.id=lc.codCom AND codCom='.$var_id_commande.' ORDER BY designation LIMIT '.$limit_inf.','.$limit_sup.'') or die(print_r($bdd->errorInfo()));

			while($donnees2=$reponse2->fetch())
			{
				// Libelle
				$pdf->SetXY( 7, $y+9 );
			    $pdf->Cell( 140, 5, $donnees2['designation'], 0, 0, 'L');
				// Quantite
				$pdf->SetXY( 145, $y+9 );
				$pdf->Cell( -7, 5, $donnees2['qteCom'], 0, 0, 'R');
				// Prix unitaire
				$nombre_format_francais = $donnees2['prixUnitaire'];
				$pdf->SetXY( 158, $y+9 );
				$pdf->Cell( 10, 5, $nombre_format_francais, 0, 0, 'R');
				// Total de la ligne
				$nombre_format_francais = $donnees2['prix_total'];
				$pdf->SetXY( 187, $y+9 );
				$pdf->Cell( 11, 5, $nombre_format_francais, 0, 0, 'R');

				$pdf->Line(5, $y+14, 205, $y+14);
				$y += 6;
			}

			// Si c'est la derniere page alors afficher le montant net a payer
			if ($num_page == $nb_page)
			{
				$nombre_format_francais = iconv('UTF-8','ISO-8859-15',"Net à payer TTC :    "). $champ_total;
				$pdf->SetFont('Arial','B',12);
				$pdf->SetXY( 5, 213 );
				$pdf->Cell( 305, 8, $nombre_format_francais, 0, 0, 'C');
				// En bas à droite
				$pdf->SetFont('Arial','B',8);
				$pdf->SetXY( 181, 239 );
				$pdf->Cell( 24, 6, iconv('UTF-8','ISO-8859-15',"Signature : "), 0, 0, 'R');
			}

			// pied de page
			$pdf->SetLineWidth(0.1);
			$pdf->Rect(5, 260, 200, 6, "D");
			$pdf->SetXY( 1, 260 );
			$pdf->SetFont('Arial','',7);
			$pdf->Cell( $pdf->GetPageWidth(), 7, iconv('UTF-8','ISO-8859-15',"Clause de réserve de propriété (loi 80.335 du 12 mai 1980) : Les marchandises vendues demeurent notre propriété jusqu'au paiement intégral de celles-ci."), 0, 0, 'C');
			$y1 = 270;

			//Positionnement en bas et tout centrer
			$pdf->SetXY( 1, $y1 ); $pdf->SetFont('Arial','B',10);
			$pdf->Cell( $pdf->GetPageWidth(), 5, "REF BANCAIRE : FR76 xxx - BIC : xxxx", 0, 0, 'C');

			$pdf->SetFont('Arial','',10);

			$pdf->SetXY( 1, $y1 + 4 );
			$pdf->Cell( $pdf->GetPageWidth(), 5, "St sarl", 0, 0, 'C');

			$pdf->SetXY( 1, $y1 + 8 );
			$pdf->Cell( $pdf->GetPageWidth(), 5, "Dakar, Senegal", 0, 0, 'C');

			$pdf->SetXY( 1, $y1 + 12 );
			$pdf->Cell( $pdf->GetPageWidth(), 5, "Tel : +221 33 888 88 88", 0, 0, 'C');

			// par page de 18 lignes
			$num_page++;
			$limit_inf += 18;
			$limit_sup += 18;
			}
			$pdf->Output("I", $nom_file);
	}
