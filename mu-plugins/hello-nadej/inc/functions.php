<?php

if ( ! function_exists('hello_nadej_get_lyric') ) :

	/**
	 * GET LYRIC
	 *
	 * @return string
	 */
	function hello_nadej_get_lyric()
	{
		$lyrics = "Kamarátka Nádej, baterky mám vypálené
			Moja láska má dnes jednu malú zmenu v mene
			Vždy sa nájde niekto, kto je trochu múdrejší
			V pravej chvíli vie to, bez zábran a sladkých rečí
			Kamarátka Nádej, dnes je vo mne vypredané
			Voľnosť v očiach nájde, tunel s názvom zabúdanie
			Všetko krásne stíchlo, zhasli svetlá nápadov
			Odišla si rýchlo, zostala len hromada slov
			To je život, krásne nás trápi
			Ale dobre je s ním
			Náruživo, všetko mu vrátim
			Už viac nenaletím
			Kamarátka Nádej, baterky mám vypálené
			Moja láska má dnes jednu malú zmenu v mene
			To je život, krásne nás trápi
			Ale dobre je s ním
			Náruživo, všetko mu vrátim
			Už viac nenaletím
			Kamarátka Nádej, dnes je vo mne vypredané
			Voľnosť v očiach nájde, tunel s názvom zabúdanie
			Všetko krásne stíchlo, zhasli svetlá nápadov
			Odišla si rýchlo, zostala len hromada slov";

		// Here we split it into lines
		$lyrics = explode( "\n", $lyrics );

		// And then randomly choose a line
		return wptexturize( trim( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] ) );
	}

endif;