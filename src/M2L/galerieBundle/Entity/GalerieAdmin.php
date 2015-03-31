<?php

namespace M2L\galerieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\component\validator\Constraints as Assert;

/**
 * GalerieAdmin
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="M2L\galerieBundle\Entity\GalerieAdminRepository")
 * @ORM\HasLifecycleCallbacks
 */
class GalerieAdmin
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;


    /**
   * @Assert\Image(minWidth=550, maxWidth=950, minHeight=350, maxHeight=700)
   */
    public $file;

    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/uploads/galerie';
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getAssetPath()
    {
        return 'uploads/galerie/'.$this->path;
    }

    /**
     * @ORM\Prepersist()
     * @ORM\Preupdate()
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getPath();
        $this->updateAt = new \DateTime();

        if(null !== $this->file) 
            $this->path = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if(null !== $this->file){
            $this->file->move($this->getUploadRootDir(), $this->path);
            unset($this->file);

            if($this->oldFile != null) unlink($this->tempFile);
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if(file_exists($this->tempFile)) unlink($this->tempFile);
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }
}
?>