<?php

/*
Plugin Name: Hello Nádej
Plugin URI: https://www.facebook.com/yablko.smrdi
Description: Baterky má vypálené
Author: Vašislav
Version: 0.01
Author URI: http://yablko.sk
*/


/**
 * FUNCTIONS
 * - tento riadok hovori, ze ak neexistuje funkcia hello_nadej_get_lyric, vytvor ju
 */
if ( ! function_exists('hello_nadej_get_lyric') ) :

    /**
     * GET LYRIC
     * - ulozime si text kvalitnej piesne Kamaratka Nadej od Vasmajstera
     * - je to jeden velky blok textu
     * - tento blok textu rozbijeme (cez explode) na samostatne riadky
     * - vyberieme jeden nahodny riadok
     * - tato funkcia oddychuje, kym je nezavolame
     * - ked ju zavolame, dostanem z nej jeden nahodny riadok ocisteny od bordelu
     * - tento riadok potom mozeme zobrazit do stranky
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

        // rozbijeme kus textu na riadky
        $lyrics = explode( "\n", $lyrics );

        // vyberieme z neho nahodny riadok a odstranime nadbytocne medzery, taby, entery, atd...
        return wptexturize( trim( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] ) );
    }

endif;



/**
 * ADMIN CSS
 * - toto je ten wodpress system eventov / hookov
 * - ked nastane udalost, ze wordpress v "admin" rozhrani vyrabat "head" element, spustime funkciu "nadej_css"
 * - ta funkcia do HTML kodu prida CSS
 * - ktore velmi jemne poupravi vyzor admin rozhrania
 */
add_action( 'admin_head', 'nadej_css' );
function nadej_css()
{
    ?>

    <style type='text/css'>
        body.wp-admin {
            background: #fdf5ae url('<?php echo HELLO_NADEJ_PLUGIN_URL ?>/assets/img/bigvasho.png') 0 0 no-repeat;
            background-size: 100%;
        }

        #nadej h1 {
            color: #fff;
            margin: 0;
            padding: 60px 60px 20px;
            text-shadow: 2px 2px 0 #ff3251, 2px 3px 0 #ffc22f;
            font-size: 52px;
            font-family: 'Arial Rounded MT Bold', sans-serif;
            line-height: 1.2;
            text-align: center;
            font-style: italic;
        }

        #nadej h1::before {
            content: '♪';
            color: #ffc22f;
            font-style: normal;
            margin-right: 10px;
        }
    </style>

    <?php
}



/**
 * INIT NADEJ
 * - znova eventy/hooky
 * - na miesto, kam wordpress vypisuje informativne spravy typu "uspesne si vymazal prispevok!" pridame kod
 * - v prvom riadku zavolame funkciu hello_nadej_get_lyric(), z ktorej sa nam vrati jeden nahodny riadok
 * - tento nahodny riadok obalime do h1 elementu a supneme do stranky
 * - kde bude pekne nastylovany, pretoze vyssie sme do stranky uz pridali CSSko
 */
add_action( 'admin_notices', 'hello_nadej' );
function hello_nadej()
{
	$chosen = hello_nadej_get_lyric();

	echo "<div id='nadej'>
		<h1>$chosen</h1>
	</div>";
}