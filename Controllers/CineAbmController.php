<?php
    namespace Controllers;

    use DAO\CineRepository as CineRepository;
    use Models\Cine as Cine;

    class CineAbmController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."cineAbm.php");
        }        


        public function AddCine()
        {
            if($_POST)
            {
                $capacidad = $_POST["capacidad"];
                $nombre = $_POST["nombre"];
                $valorEntrada = $_POST["valorEntrada"];
                $direccion = $_POST["direccion"];

                $cine = new Cine();
                $cine->setCapacidad($capacidad);
                $cine->setNombre($nombre);
                $cine->setValorEntrada($valorEntrada);
                $cine->setDireccion($direccion);

                $cineRepo = new CineRepository();

                $errorAbmCine = $cineRepo->Add($cine);

                if(!empty($errorAbmCine))
                {
                    include_once(VIEWS_PATH."cineAbm.php");
                }else
                {
                    //por si queremos mandarlo a otro lado dsp
                    include_once(VIEWS_PATH."cineAbm.php");
                }
            
            }

        }


    }
?>