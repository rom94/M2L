<?php

namespace M2L\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="m2l_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
	/**
     * @ORM\Column(name="ligue", type="string", length=255, nullable=true)
     */
    protected $ligue;
	
	public function setLigue($ligue)
    {
        $this->ligue = $ligue;

        return $this;
    }

    /**
     * Get ligue
     *
     * @return string 
     */
    public function getLigue()
    {
        return $this->ligue;
    }
}