## Controlleur Frontal
``` /public/index.php ```
## Routes
``` /config/routes.php ```
### À quoi servent les routes ?
Les routes permettent d'associer simplement des URL virtuelles à des pages spécifiques de votre site.

Plus précisément, elles vous permettent d'exécuter une méthode de contrôleur que vous avez choisie.

### Comment créer une nouvelle route ?
Toutes les routes doivent être définie dans le fichier /config/routes.php dans le tableau $routes

```php
array('single2','default','single2',array('id','slug')),
array('url de la page','Nom du controller','nom de la methode','tableau d\'arguments')),
```
##Controller
```/app/Controller```
### À quoi servent les contrôleurs ?
- Les contrôleurs sont au cœur de nos applications. 
- Ce sont eux qui traitent les requêtes et les formulaires, font appel au "modèle" pour manipuler les données, 
exécutent la logique applicative, et finalement, retournent des réponses (template html, JSON ou redirection) au client.</p>

### Comment créer un contrôleur ?
-Vous pouvez créer autant de contrôleurs que vous le souhaitez. Pour vous donner une idée, il est fréquent d'avoir autant de contrôleurs que vous avez de table dans votre base de données (bien que ce ne soit nullement une règle à appliquer strictement). 
- Ainsi, pour un blog, il y aurait probablement, a minima, un <code>PostController</code>, 
un <code>CommentController</code> et un <code>UserController</code>.

- Toutes vos classes devraient être sous l'espace de nom  ```App\Controller``` et hériter (directement ou non) de la classe ```Core\Kernel\AbstractController```, afin de bénéficier des méthodes fournies.

### La classe Core\Kernel\AbstractController
- Il est essentiel de parcourir vous-même la classe ```Core\Kernel\AbstractController```, afin d'avoir un portrait juste de tout ce qu'elle vous offre. Sachez qu'elle vous permet de gérer les redirections et les urls, l'envoi de réponses, 
de pages d'erreurs et de JSON.</p>

### Créer une page
- Pour chacune des "pages" de vos applications, une méthode de contrôleur devrait être définie.
 C'est notamment pour cette raison que vous ressentirez le besoin de créer plusieurs contrôleurs, 
 afin de "classer" vos méthodes, qui deviendront rapidement nombreuses.
- Ces méthodes doivent être de visibilité ```public```, et devrait normalement se terminer par l'une des actions suivantes : 
```php
/* src/Controller/DefaultController.php */
public function contact()
{
	//affiche un template
	$this->render('app.default.contact');
	//affiche un template, tout en rendant des données disponibles dans celui-ci
	//template disponible dans le dossier template/app/default/contact.php
	$this->render('app.default.contact',['username' => 'michel']);
        //redirige vers une page du site
        $this->redirect('contact');
	//redirige vers un site externe
	$this->redirect('https://weblitzer.com');
	//retourne une réponse JSON
	$this->showJson([]);
	//retourne une erreur 404
	$this->Abort404();
}
```

## Model
```/src/Model```

### À quoi servent les modèles ?
- Les modèles sont les classes responsables d'exécuter <em>les requêtes à votre base de données</em>.
- Concrètement, chaque fois que vous souhaitez faire une requête à la base de données, vous devriez venir y créer une fonction qui s'en chargera (sauf si elle existe déjà dans les modèles de base du framework).</p>

### Comment créer un nouveau modèle ?
- Dans votre application, vous pourriez avoir un modèle par table MySQL (sans obligation). Chacune de ces classes devraient hériter de ```Core\Kernel\Model\```, le modèle de base du framework, qui vous fera profiter de quelques méthodes utiles pour faire les principales requêtes de base à la base de données.

Par exemple, pour créer un modèle relié à une table fictive de commentaires nommées ```Comment``` :

```php
// src/Model/CommentModel.php
namespace App\Model;

use Core\App;
use Core\Kernel\AbstractModel;

class CommentModel extends AbstractModel 
{
    protected static $table = 'comments';
    protected int $id;
    protected string $title;
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }
    public function getTitleAndID() 
    {
        return '<p>'.$this->title.' : '.$this->id.'</p>';
    }
    public static function simpleRequest()
    {
        return App::getDatabase()->query("SELECT * FROM " . self::getTable() . " AS c",get_called_class());
    }
    public static function findOneById($id)
    {
        return App::getDatabase()->prepare("SELECT * FROM " . self::getTable() . " WHERE id = ?",array($id),get_called_class(),true );
    }   
	public static function countPerso()
    {
        return App::getDatabase()->aggregation("SELECT COUNT(id) FROM " . self::getTable());
    }
	public static function insert($post)
    {
        App::getDatabase()->prepareInsert("INSERT INTO " . self::$table . " (title, created_at) VALUES (?,NOW())", array($post['title']]));
    }
}
```
### Les propriétés et méthodes héritées de AbstractModel
- Voici les propriétés et les méthodes les plus utiles, héritées du modèle de base.
- Vous devrez créer vos propres méthodes pour réaliser vos requêtes SQL plus complexes.
```php
/* Core/Kernel/AbstractModel.php */
// Récupère une ligne de la table en fonction d'un identifiant
public function all()
public function findById($id)
public function findByColumn($column,$value)
public function count()
public function delete($id)
```

## Templates & Layout 
```/template```
### À quoi servent les vues ?
<p>Les <em>vues</em> ou <em>templates</em> permettent de séparer le code de présentation du reste de la logique (contrôleur) ou des données (modèles). On y retrouve donc essentiellement des balises HTML et des <span class="code">echo</span> de variables PHP.</p>

<h3>Comment créer un nouveau fichier de vue ?</h3>
<h4>Où placer ses fichiers de vues ?</h4>
<p>Donnée importante à connaître : Le framework vous impose de placer vos fichiers de vues sous le dossier <span class="code">template/app/</span>. Outre cette règle, vous êtes libre de faire comme bon vous semble.</p>
<p>Ceci étant, la plupart des pages de votre application devrait avoir un fichier de vue propre. Ainsi, il devrait y avoir à peu près autant de routes que de méthodes de contrôleur que de fichiers de vue dans votre application. Il est donc important de les classer un minimum, afin de s'y retrouver. Pour cette raison, je vous suggère de placer vos fichiers de vue dans des répertoires portant le même nom que son contrôleur (sans le suffixe Controller, et en minuscule). Ainsi, si vous avez un <span class="code">PostController</span> et un <span class="code">UserController</span> dans votre application, vous devriez avoir un dossier de vues nommé <span class="code">template/app/post/</span> et un autre nommé <span class="code">template/app/user/</span>. Ce n'est toutefois qu'une convention suggérée.</p>
<p>Les fichiers de vue doivent avoir l'extension <span class="code">.php</span>.</p>
<h4>Que contient un fichier de vue ?</h4>
<p>Au plus simple, un fichier de vue ne doit contenir qu'une page HTML complète. Lorsque votre contrôleur déclenchera l'affichage de votre fichier de vue, il enverra le contenu de celui-ci en réponse au client.</p>


## Les images
<h4>Les CSS, les JS et les images</h4>
<p>Tous les fichiers publics de votre application (<em>public</em> dans le sens que vous considérez qu'un internaute doit pouvoir l'afficher directement dans son navigateur) doivent se trouver dans le dossier <span class="code">public/</span>. Autrement, le navigateur n'y aura tout simplement pas accès. Ainsi, vos fichiers .css, .js et vos images (souvent nommés <em>assets</em>) devront nécessairement y être placés.</p>


## Webpack, SCSS, JS
Webpack est implémenter dans le framework.
Les méthodes add_webpack_style() & add_webpack_script() dans Core\Kernel\View vous serons utile pour implémenter vos css et js provenant de Webpack

## Améliorations du framework

Toutes modifications du dossier core est possible en accord avec votre formateur.
Certaines de vos améliorations pourront être intégrées directement au framework