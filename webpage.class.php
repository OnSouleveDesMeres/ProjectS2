<?php

class WebPage {
    /**
     * @var string Texte compris entre <head> et </head>
     */
    private $head  = '<!doctype html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">' ;
    /**
     * @var string Texte compris entre <title> et </title>
     */
    private $title = null ;
    /**
     * @var string Texte compris entre <body> et </body>
     */
    private $body  = null ;

    /**
     * Constructeur
     * @param string $title Titre de la page
     */
    public function __construct($title=null) {
        $this->title .= '<title>'.$title.'</title>';
    }

    /**
     * Retourner le contenu de $this->body
     *
     * @return string
     */
    public function body() {
        return $this->body;
    }

    /**
     * Retourner le contenu de $this->head
     *
     * @return string
     */
    public function head() {
        return $this->head;
    }

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web
     * @see http://php.net/manual/en/function.htmlentities.php
     * @param string $string La chaîne à protéger
     *
     * @return string La chaîne protégée
     */
    public static function escapeString($string) {
        return htmlEntities($string, ENT_QUOTES);
    }

    /**
     * Affecter le titre de la page
     * @param string $title Le titre
     */
    public function setTitle($title) {
        $this->title .= '<title>'.$title.'</title>';
    }

    /**
     * Ajouter un contenu dans head
     * @param string $content Le contenu à ajouter
     *
     * @return void
     */
    public function appendToHead($content) {
        $this->head .= $content;
    }

    /**
     * Ajouter un contenu CSS dans head
     * @param string $css Le contenu CSS à ajouter
     *
     * @return void
     */
    public function appendCss($css) {
        $this->head .= "<style>'.$css.'</style>";
    }

    /**
     * Ajouter l'URL d'un script CSS dans head
     * @param string $url L'URL du script CSS
     *
     * @return void
     */
    public function appendCssUrl($url) {
        $this->head .= '<link rel="stylesheet" media="screen" href="'.$url.'">';
    }

    /**
     * Ajouter un contenu JavaScript dans head
     * @param string $js Le contenu JavaScript à ajouter
     *
     * @return void
     */
    public function appendJs($js) {
        $this->head .= '<script>'.$js.'</script>';
    }

    /**
     * Ajouter l'URL d'un script JavaScript dans head
     * @param string $url L'URL du script JavaScript
     *
     * @return void
     */
    public function appendJsUrl($url) {
        $this->head .= '<script src="'.$url.'"></script>';
    }

    /**
     * Ajouter un contenu dans body
     * @param string $content Le contenu à ajouter
     *
     * @return void
     */
    public function appendContent($content) {
        $this->body .= $content;
    }

    /**
     * Produire la page Web complète
     *
     * @return string
     * @throws Exception si title n'est pas défini
     */
    public function toHTML(){
        if($this->title == null){
            throw new Exception('Le titre doit être indiqué');
        }
        $html = $this->head.$this->title.'</head>'.$this->body;
        return $html;
    }
}
