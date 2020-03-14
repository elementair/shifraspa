        //Enter your code here, enjoy!

        function intervaloHora($hora_inicio, $hora_fin, $intervalo = 30) {

            $hora_inicio = new DateTime($hora_inicio);
            $hora_fin = new DateTime($hora_fin);
            $hora_fin - > modify('+1 second'); // Añadimos 1 segundo para que muestre $hora_fin

            // Si la hora de inicio es superior a la hora fin
            // añadimos un día más a la hora fin
            if ($hora_inicio > $hora_fin) {

                $hora_fin - > modify('+1 day');
            }

            // Establecemos el intervalo en minutos

            $intervalo = new DateInterval('PT'.$intervalo.
                'M');

            // Sacamos los periodos entre las horas
            $periodo = new DatePeriod($hora_inicio, $intervalo, $hora_fin);


            foreach($periodo as $hora) {

                // Guardamos las horas intervalos 
                $horas[] = $hora - > format('H:i');
            }

            return $horas;
        }

        print_r(intervaloHora('09:00', '19:00'));