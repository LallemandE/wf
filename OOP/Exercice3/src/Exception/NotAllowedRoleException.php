<?php
namespace Exception;

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

