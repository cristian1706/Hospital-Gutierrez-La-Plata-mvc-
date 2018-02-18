<?php  

class GraficosView extends TwigView 
{
	protected static $instance;
    
    public static function getInstance()
    {
        if (!isset(self::$instance)) 
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function showPeso($pesoPorFecha,$fechaNacimiento,$rol,$user)
	{
		echo self::getTwig()->render('graficoPeso.html', array('pesoPorFecha' => $pesoPorFecha, 'fechaNacimiento' => $fechaNacimiento, 'rol' => $rol, 'user' => $user));
	}

	public function showTalla($tallaPorFecha,$fechaNacimiento,$rol,$user)
	{
		echo self::getTwig()->render('graficoTalla.html', array('tallaPorFecha' => $tallaPorFecha, 'fechaNacimiento' => $fechaNacimiento, 'rol' => $rol, 'user' => $user));
	}

	public function showPercentil($percentilPorFecha,$fechaNacimiento,$rol,$user)
	{
		echo self::getTwig()->render('graficoPercentil.html', array('percentilPorFecha' => $percentilPorFecha, 'fechaNacimiento' => $fechaNacimiento, 'rol' => $rol, 'user' => $user));
	}

	public function showHeladera($tienenHeladera,$noTienenHeladera,$rol,$user)
	{
		echo self::getTwig()->render('tortaHeladera.html', array('tienenHeladera' => $tienenHeladera, 'noTienenHeladera' => $noTienenHeladera, 'rol' => $rol, 'user' => $user));
	}

	public function showElectricidad($tienenElectricidad,$noTienenElectricidad,$rol,$user)
	{
		echo self::getTwig()->render('tortaElectricidad.html', array('tienenElectricidad' => $tienenElectricidad, 'noTienenElectricidad' => $noTienenElectricidad, 'rol' => $rol, 'user' => $user));
	}

	public function showMascota($tienenMascota,$noTienenMascota,$rol,$user)
	{
		echo self::getTwig()->render('tortaMascota.html', array('tienenMascota' => $tienenMascota, 'noTienenMascota' => $noTienenMascota, 'rol' => $rol, 'user' => $user));
	}

	public function showAgua($aguaCorriente,$aguaPozo,$rol,$user)
	{
		echo self::getTwig()->render('tortaAgua.html', array('aguaCorriente' => $aguaCorriente, 'aguaPozo' => $aguaPozo, 'rol' => $rol, 'user' => $user));
	}

	public function showVivienda($material,$chapa,$madera,$rol,$user)
	{
		echo self::getTwig()->render('tortaVivienda.html', array('material' => $material, 'chapa' => $chapa, 'madera' => $madera, 'rol' => $rol, 'user' => $user));
	}

	public function showCalefaccion($gas,$lenia,$electrica,$rol,$user)
	{
		echo self::getTwig()->render('tortaCalefaccion.html', array('gas' => $gas, 'lenia' => $lenia, 'electrica' => $electrica, 'rol' => $rol, 'user' => $user));
	}
}
?>