<head>
	<meta charset="UTF-8">

  <title><?=$titulo_pagina?></title>
  
	<meta name="description" content="<?=$descr_site?>" />
	<meta name="author" content="Ellos Design - Criação de Sites e Marketing Digital"/>
	<meta name="reply-to" content="contato@site.com.br"/>
	<meta http-equiv="cache-control" content="public"/> 
	<meta http-equiv="Pragma" content="public"/>  
	<meta name="language" content="pt-br"/>
	<meta name="owner" content="Nome da Empresa"/>
	<meta name="Audience" content="ALL"/>
	<meta name="rating" content="general"/>
	<meta name="GOOGLEBOT" content="index,follow"/>
	<meta name="MSNBot" content="index,follow"/>
	<meta name="InktomiSlurp" content="index,follow"/>
	<meta name="Unknownrobot" content="index,follow"/>
	<meta name="Robots" content="index,follow"/>
  <meta name="revisit-after" content="1day"/>
  
  <meta name="theme-color" content="#7f277a" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<!-- SHARE TAGS -->
	<?
	$og_title = $og_title != "" ? $og_title : $titulo_pagina;
	$og_description = $og_description != "" ? $og_description : Tools::limitarTexto($descr_site, 100);
  $og_image = $og_image != "" ? $og_image : URL."logo.png";	
  $og_type = $og_type != "" ? $og_type : "website";
	$og_url = $og_url != "" ? $og_url : "https://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];	
	$canonical = $canonical != "" ? $canonical : URL;	
	?>
	<meta property="og:title" content="<?=$og_title?>" />
	<meta property="og:description" content="<?=$og_description?>" />
  <meta property="og:image" content="<?=$og_image?>" />
  <link rel="canonical" href="<?=$canonical?>"/>	
	<meta property="og:url" content="<?=$og_url?>" />
  <meta property="og:type" content="<?=$og_type?>" />
  <meta property="og:locale" content="pt_BR" />
  <!-- //SHARE TAGS -->
  
	<!-- FONTS -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

	<!-- CSS -->
	<link rel="stylesheet" href="<?=URL_APP?>assets/dist/css/style.min.css?v=101">
	
	<link rel="shortcut icon" href="<?=URL?>favicon.ico"/>

</head>
