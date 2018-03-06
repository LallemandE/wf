<?php
namespace Exception;

// on d�finit la nouvelle exception comme une extension de la RuntimeException
// La RuntimeException a trois propri�t�s ($message, $code, $previous) que je vais retrouver dans mon
// constructeur.

// La m�thode getMessage de la RuntimeException est d�finie comme "final" => on ne peut pas l'overwritter !
// On peut n�anmoins modifier le contenu du message que l'on va envoy� au constructeur de la
// classe du parent (=> RuntimeException).

// Pour obtenir la d�finition d'un "object" auquel on fait r�f�rence, dans Eclipse, il suffit
// de faire CTRL  + CLICK sur l'objet en question dans le code.

class NotAllowedRoleException extends \RuntimeException
{
    protected $allowedRole;
    protected $label;
    
    // je red�finis le constructeur et j'y ajoute mes propres arguments que sont
    // un tableau des r�les autoris�s et la valeur fournie lors de l'appel.
    
    public function __construct(
        array $allowedRoles,
        string $label,
        $message = null,
        $code = null,
        $previous = null)
    {
        $this->allowedRoles = $allowedRoles;
        $this->label = $label;
        
        // on compl�te le message du parent par un message compl�mentaire
        // que l'on obtient gr�ce � la m�thode getNewMessage
        
        $message = $this->getNewMessage() . $message;
        
        // on laisse le contructeur du parent g�rer le message, son code et previous
        parent::__construct($message, $code, $previous);
    }
    
    // on red�finit la fonction getMessage des RuntimeException pour y g�rer les labels
    
    public function getNewMessage (){
        
        // je construis une cha�ne de caract�re qui repr�sente l'array des valeurs autoris�es.
        $allowedReference = '[' . implode (',' , $this->allowedRoles) . ']'; 
        $mismatchingReference = $this->label; // c'est le label du r�le saisi par l'utilisateur et qui pose probl�me
        
        $message = 'Usage of ' . $mismatchingReference . ' is not allowed. ';
        $message .= 'Only ' . $allowedReference . ' are allowed.';

        return $message;
        
    }
}

