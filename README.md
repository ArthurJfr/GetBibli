# Framework Pédagogique MVC6

## Prérequis
- PHP >= 7.4.*
- Composer
- Node - npm
- MySQL avec PDO

## Installation

```bash
  git clone https://gitlab.com/quidelantoine/mvc6.git
  cd mvc6
  composer dump-autoload 
  npm install
```

## Configurations

Par sa simplicité, MVC5 requière peu de configuration pour fonctionner.

### Le fichier de configuration

MVC5 est livré avec un fichier nommé config/config-dist.php.
Ce fichier est destiné à être versionné, et ne doit pas contenir d'informations personnelles ou sensibles.
Le fichier lu par défaut par le framework est <span class="code">config/config.php</span>, qui lui, ne doit pas être versionné, il vous est personnel.

Pour démarrer copier-coller le contenu du fichier config/config-dist.php dans
```php
/* config/config.php */
return array(
    'db_name'   => 'dbname',
    'db_user'   => 'root',
    'db_pass'   => '',
    'db_host'   => 'localhost',
    
    'version' => '1.0.0'
);
```
## Serveur php & Webpack
```bash
// Pour lancer serveur PHP
php -S localhost:2323 -t public
// Pour lancer Webpack
npm run watch
// Pour build Webpack
npm run build
```
## Sécurité et contrôle des accès aux pages

### Restreindre l'accès à une page :

Dans le dossier config à la racine,  se trouve un fichier ``secure-pages.php``,
insérer sous forme de tableau les informations suivantes : 
``array('page','role','redirection vers')``
```php
$page = array(
    //array ('page','role' ,'redirect page')
    //exemple
    array('admin','user','home'),
    
    //en remplacant le role par 'all' on restreint directement l'accès à la page pour les users non connectés
    array('admin','all','home')

);
```
En mettant ``all`` dans le role, cela restreint l'accès à la page ciblé pour tous les utilisateurs non-connectés

#### Il ne reste plus qu'à appeller la méthode dans le controller comme ci dessous :
```php
 public function index(){
       $security = new Security();
       $security->addSecurePage('admin');
        $this->render('app.admin.index',array(
'security'=>$security
        ),'admin');
    }
```

### Get user informations

Il est possible de récupérer les infos de l'utilisateur connecté 
grâce à la fonction provenant de la class Security , getUser

l'Appel se fait dans le controller, de cette manière :
```php
   $myUser = $sec->getUser();
```
Ne pas oublier de faire passer ``$myUser`` dans le render :
```php
       $this->render('app.users.login',array(
            'form' => $form,
            'sec'=>$sec,
            
            'user'=> $myUser
        ),'admin');
```
on peut visualiser toutes les infos du user en faisait un dump de celui ci:
```php
echo $view->dump($user)
```
Si aucun user n'est connecté, le tableau ``$view->dump($user)`` renvoi et affiche``nobody conneted``.


## Authors
- [@quidelantoine](https://www.github.com/quidelantoine)
