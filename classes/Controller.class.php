<?php
namespace Classes;

/*
 * Classe Controller
 *
 * Elle permet la gestion des requête clients, afin de renvoyer les pages demandées
 */

include_once 'ACClass.class.php';

class Controller extends ACClass {
	private $page;					//Page à afficher
	private $title; 				//Titre de la page à afficher dans <title></title>
	private $description;   		//Description à afficher dans le <meta description>
	private $keywords;				//Mots clés de la page à afficher;
	private	$base_dir 		= NULL;	//Dossier racine de la page html
	private $header_class	= NULL;	//Classe à mettre dans <header>
	private $body_class		= NULL;	//Classe à mettre dans <body>
	private $footer_class	= NULL;	//Classe à mettre dans <body>

	public function __construct(array $data) {
		$this->mandatory_att = array(
			'page',
			'title',
			'description',
			'keywords',
		);
		parent::__construct($data);
	}

	///////////////SETTERS///////////////
	
	public function setPage(string $page)	{ $this->page = $page; }
	public function setTitle(string $title)	{ $this->title = $title; }
	public function setDescription(string $description)	{ $this->description = $description; }
	public function setKeywords(string $keywords)	{ $this->keywords = $keywords; }
	public function setBaseDir(string $base_dir)	{ $this->base_dir = $base_dir; }

	///////////////GETTERS///////////////

	/*
	 * Get Page
	 *
	 * Fonction qui permet d'initialiser les valeurs des attributs de l'objet,
	 * au regard de la page à affiche.
	 * Elle va aussi aller chercher la page à afficher.
	 */
	public function getPage(array $obj = []) {
		foreach ($obj as $key => $value)
			$$key = unserialize($value);
		$file = PAGES.'/'.lcfirst($this->page).'.php';
		if (file_exists($file)) {
			$body = $this->fileToBuffer($file, $obj);
		} else {
			throw new \Exception($this->page."does not correspond to any page.");
			return (false);
		}
		$html = $this->getHtml();
		$header = $this->fileToBuffer(LAYOUT."/header.php", $obj);
		$footer = $this->fileToBuffer(LAYOUT."/footer.php", $obj);
		$message = $this->fileToBuffer(LAYOUT."/message.php", $obj);
		$html = str_replace("<header></header>", $header, $html);
		$html = str_replace("<body></body>", $body, $html);
		$html = str_replace("<body>", $message , $html);
		echo $html;
		unset($html);
	}

	public function getHtml() {
		ob_start();
		$title = $this->title;
		$description = $this->description;
		$keywords = $this->keywords;
		$baseDir = $this->base_dir;
		include_once(LAYOUT."/html.php");
		return (ob_get_clean());
	}

	public function fileToBuffer(string $file, array $obj = []) {
		foreach ($obj as $key => $value)
			$$key = unserialize($value);
		ob_start();
		include_once($file);
		return (ob_get_clean());
	}
}
