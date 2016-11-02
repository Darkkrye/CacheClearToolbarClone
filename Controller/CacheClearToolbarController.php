<?php

namespace CacheClearToolbar\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CacheClearToolbarController extends Controller
{
    public function cacheClearAction($routeName) {
        $this->remove("dev");

        return $this->redirect($this->generateUrl($routeName));
    }

    public function prodCacheClearAction($routeName) {
        $this->remove("prod");

        return $this->redirect($this->generateUrl($routeName));
    }

    public function bothCacheClearAction($routeName) {
        $this->remove("dev");
        $this->remove("prod");

        return $this->redirect($this->generateUrl('doc_ios'));
    }

    private function remove($env) {
        $path = dirname(getcwd());
        $path = $path . "/var/cache/" . $env;

        if (isset($path)) {
            $this->rmdir_recursive($path);
        }
    }

    private function rmdir_recursive($dir)
    {
        //Liste le contenu du répertoire dans un tableau
        $dir_content = scandir($dir);
        //Est-ce bien un répertoire?
        if($dir_content !== FALSE){
            //Pour chaque entrée du répertoire
            foreach ($dir_content as $entry)
            {
                //Raccourcis symboliques sous Unix, on passe
                if(!in_array($entry, array('.','..'))){
                    //On retrouve le chemin par rapport au début
                    $entry = $dir . '/' . $entry;
                    //Cette entrée n'est pas un dossier: on l'efface
                    if(!is_dir($entry)){
                        unlink($entry);
                    }
                    //Cette entrée est un dossier, on recommence sur ce dossier
                    else{
                        $this->rmdir_recursive($entry);
                    }
                }
            }
        }
        //On a bien effacé toutes les entrées du dossier, on peut à présent l'effacer
        rmdir($dir);
    }
}
