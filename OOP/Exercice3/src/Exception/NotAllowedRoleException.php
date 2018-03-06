<?php
namespace Exception;

// on définit la nouvelle exception comme une extension de la RuntimeException
// La RuntimeException a trois propriétés ($message, $code, $previous) que je vais retrouver dans mon
// constructeur.

// La méthode getMessage de la RuntimeException est définie comme "final" => on ne peut pas l'overwritter !
// On peut néanmoins modifier le contenu du message que l'on va envoyé au constructeur de la
// classe du parent (=> RuntimeException).

// Pour obtenir la définition d'un "object" auquel on fait référence, dans Eclipse, il suffit
// de faire CTRL  + CLICK sur l'objet en question dans le code.

class NotAllowedRoleException extends \RuntimeException
{
    protected $allowedRole;
    protected $label;
    
    // je redéfinis le constructeur et j'y ajoute mes propres arguments que sont
    // un tableau des rôles autorisés et la valeur fournie lors de l'appel.
    
    public function __construct(
        array $allowedRoles,
        string $label,
        $message = null,
        $code = null,
        $previous = null)
    {
        $this->allowedRoles = $allowedRoles;
        $this->label = $label;
        
        // on complète le message du parent par un message complémentaire
        // que l'on obtient grâce à la méthode getNewMessage
        
        $message = $this->getNewMessage() . $message;
        
        // on laisse le contructeur du parent gérer le message, son code et previous
        parent::__construct($message, $code, $previous);
    }
    
    // on redéfinit la fonction getMessage des RuntimeException pour y gérer les labels
    
    public function getNewMessage (){
        
        // je construis une chaîne de caractère qui représente l'array des valeurs autorisées.
        $allowedReference = '[' . implode (',' , $this->allowedRoles) . ']'; 
        $mismatchingReference = $this->label; // c'est le label du rôle saisi par l'utilisateur et qui pose problème
        
        $message = 'Usage of ' . $mismatchingReference . ' is not allowed. ';
        $message .= 'Only ' . $allowedReference . ' are allowed.';

        return $message;
        
    }
}

