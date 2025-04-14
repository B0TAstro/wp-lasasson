<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <!-- <?php
                if (wp_is_mobile()) {
                    get_header('mobile');
                } else {
                    get_header('desktop');
                }
                ?> -->
        <?php wp_nav_menu(array('menu' => 'primary_menu')); ?>
        <a href="index.php"> <img src="./logo.png" alt="Mon logo"></a>
        <ul>
            <li><a href="">Qui sommes-nous ?</a></li>
            <li><a href="">Nos dispositifs</a></li>
            <li><a href="">Notre actualité</a></li>
            <li><a href="">Infos pratiques</a></li>
            <li><a href="">Nous contacter</a></li>
        </ul>
        <a href="">>Recrutement</a>
    </header>