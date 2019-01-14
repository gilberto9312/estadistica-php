   <?php
	//////////////////////////////////////////////////////////////////////////////
	/*@author: Gilberto Asuaje <@gilberto9312, asuajegilberto@gmail.com>        //
	/*@Version: 1.1                                                             //
	/*@Descripcion: Recibe un array() cada función y retorna array()            //
	/*ó valor númerico según la función solicitada                              //
	/*////////////////////////////////////////////////////////////////////////////



    private function calcularMediana($array)
    {
        $cantidad = count($array);
        sort($array);
            $posMediana = ($cantidad + 1) / 2;
            $mediana = $cantidad % 2 != 0 ? ($posMediana - 1) : (($posMediana - 1 )+ $posMediana) / 2;    
        $aux=array();        
        foreach ($array as $key => $value) 
        {
            
            if((intval($mediana)-1)==$key)
            {
                $aux[$key]['mediana']=$value;
            }   
            
        }

        return $aux;
    }


        private function calcularModa($array)
    {

        $cuenta = array_count_values($array);
        
        arsort($cuenta);
        
        if (max($cuenta) == 1)
        {
            return 0;
        }
        else
        {
            return key($cuenta);
        }
    }


    private function calcularFrecuenciaModa($array, $moda)
    {
        $frecuencia = 0;
        foreach($array as $datos)
        {
            if ($datos == $moda)
            {
                $frecuencia++;
            }              
        }
        
        return $frecuencia;
    }


    private function calcularMedia ($array)
    {
        $contador = count($array);
        $suma = 0;
        foreach ($array as $value) {
            $suma = $value + $suma;
            $media = $suma/$contador;
        }
        return $media;
    }

	 private function calcularDesviacion($array, $media)
    {
        $sum = 0;
        $contador = count($array);
        foreach($array as $datos)
        {
            $sum += $datos;
            $potencia = pow($sum, 2);
        }
        
        $varianza = ($potencia / $contador) - (pow($media,2)) ;
        
        //return $varianza;
        return sqrt($varianza);
    }

    private function calcularVarianza($array, $media)
    {
        $sum = 0;
        $contador = count($array);
        foreach($array as $datos)
        {
            $sum += $datos;
            $potencia = pow($sum, 2);
        }
        
        $varianza = ($potencia / $contador) - (pow($media,2)) ;
        
        return $varianza;
       
    }


    private function distribucionFrecuencias($array)
    {
        $totalAlumnos = count($array);
        $result = array();
         $cuenta = array_count_values($array);
         $frecuencia = array();
         $notas= array();
         $aux = 0;
        
         foreach($cuenta as $key => $fi){
            $aux += $fi;
            $frecuencia[$key]['n'] = $key;
            $frecuencia[$key]['F'] = $fi;
            $frecuencia[$key]['FR'] = $aux;
            $frecuencia[$key]['FRAA'] = $fi / $totalAlumnos;
            $frecuencia[$key]['FRAD'] = $aux / $totalAlumnos;
         }    
        
        return $frecuencia;
    }


    private function calcularPercentiles($data) 
    {
        $result = array();
        $result['10'] = $this->percentile($data, 10);
        $result['20'] = $this->percentile($data, 20);
        $result['30'] = $this->percentile($data, 30);
        $result['40'] = $this->percentile($data, 40);
        $result['50'] = $this->percentile($data, 50);
        $result['60'] = $this->percentile($data, 60);
        $result['70'] = $this->percentile($data, 70);
        $result['80'] = $this->percentile($data, 80);
        $result['90'] = $this->percentile($data, 90);
        $result['100'] = $this->percentile($data, 100);
        
        return $result;
    }

        private function percentile($data, $percentile) 
    { 

        

      if (0 < $percentile && $percentile < 1) { 
            $p = $percentile; 
        } else if (1 <= $percentile && $percentile <= 100) { 
            $p = $percentile * .01; 
        } else { 
            return ""; 
        } 
        $count = count($data); 
        $allindex = ($count - 1) * $p; 
        $intvalindex = intval($allindex); 
        $floatval = $allindex - $intvalindex; 
        sort($data); 
        if (!is_float($floatval)) { 
            $result = $data[$intvalindex]; 
        } else { 
            if($count > $intvalindex+1) 
                $result = $floatval*($data[$intvalindex+1] - $data[$intvalindex]) + $data[$intvalindex]; 
            else 
                $result = $data[$intvalindex]; 
        }
        return $result; 
    }


     private function coeficienteCorrelacion($results,$desviacion){
        $ar = array();

        $acierto = 0;
        $error = 0;
        foreach ($results as $key => $postulante){
            $postul[$postulante['username']][$key]=$postulante['username'];
        }
        foreach ($results as $key => $value) {
        $cantidadPostulante = count($postul);



            //$ar[$value['username']]['cedula']=$value['username'];
            $ar[$value['name']]['pregunta'][$key]=$value['name'];
            $ar[$value['name']]['fraction'][$key]=intval($value['fraction']);
            $ar[$value['name']]['nompregunta']=$value['name'];
            if (intval($value['fraction'])){
                $acierto++;
                $ar[$value['name']]['acierto'] = $acierto;
            }else
            {
                $error++;
                $ar[$value['name']]['error'] = $error;
            }
            $ar[$value['name']]['mediaAcierto']=$acierto/($acierto+$error);
            if (!isset($ar[$value['name']]['error'])) {
                $ar[$value['name']]['error']=0;
            }
            if($ar[$value['name']]['error']==0)
            {
                $ar[$value['name']]['mediaError']=0;
            }
            else
            {
            $ar[$value['name']]['mediaError']=$error/($acierto+$error);
            }
            if ($cantidadPostulante > 1) {
            $ar[$value['name']]['correlacionPuntoBiserial']= (((($acierto/($acierto+$error))-($error/($acierto+$error)))/$desviacion) * sqrt(($acierto * $error)/($cantidadPostulante*($cantidadPostulante - 1))));
            }else{
                $ar[$value['name']]['correlacionPuntoBiserial']=0;
            }

            

        }

        return $ar;
    }



?>
