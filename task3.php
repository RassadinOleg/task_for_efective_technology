<?php
	/**********************/
	/**Интерфейс 'Фигура'**/
	interface Figure{
		//Метод определения площади фигуры
		public function square();
		
		//Метод вывода данных о фигуре
		public function information();
	}
	

	/****************/
	/**Класс 'круг'**/
	class Circle implements Figure{
		//Радиус круга
		private $radius;
		
		//Конструктор класса
		public function Circle($r){
			$this->radius = $r;
		}
		
		//Meтод определения площади
		public function square(){
			return 3.14159 * $this->radius * $this->radius;
		}
		
		//Метод вывода информации о фигуре
		public function information(){
			printf("Circle radius = %d <br>", $this->radius);
		}
	}
	
	
	/*************************/
	/**Класс 'прямоугольник'**/
	class Rectangle implements Figure{
		//Стороны прямоугольника
		private $a;
		private $b;
		
		//Конструктор класса
		public function Rectangle($A, $B){
			$this->a = $A;
			$this->b = $B;
		} 
		
		//Метод определения площади
		public function square(){
			return $this->a * $this->b;
		}
		
		//Метод вывода информации о фигуре
		public function information(){
			printf("Rectangle %d x %d <br>", $this->a, $this->b);
		}
	}
	
	
	/***********************/
	/**Класс 'треугольник'**/
	class Triangle implements Figure{
		//Стороны треугольника
		private $a;
		private $b;
		private $c;
		
		//Конструктор класса
		public function Triangle($A, $B, $C){
			$this->a = $A;
			$this->b = $B;
			$this->c = $C;
		}
		
		//Метод определения площади
		public function square(){
			$p = ($this->a + $this->b + $this->c)/2;
			return sqrt($p * ($p - $this->a) * ($p - $this->b) * ($p - $this->c));
		}
		
		//Метод вывода информации о фигуре
		public function information(){
			printf("Triangle %d x %d x %d <br>", $this->a, $this->b, $this->c);
		}
	}
	
	
	//Загружаем данные из json-файла в строку
	$string = file_get_contents("figures.json");
	
	//Преобразуем строку в объект
	$obj = json_decode($string);
	
	//Создание и инициализация объектов-фигур
	for ($i = 0; $i < count($obj); $i++){
		switch($obj[$i]->type){
			case "circle":
				$figures[$i] = new Circle($obj[$i]->radius);
				break;
			case "rectangle":
				$figures[$i] = new Rectangle($obj[$i]->a, $obj[$i]->b);
				break;
			case "triangle":
				$figures[$i] = new Triangle($obj[$i]->a, $obj[$i]->b, $obj[$i]->c);
				break;
		}
	}
	
	
	//Сортировка
	for ($i = 0; $i < count($figures) - 1; $i++){
		for ($j = $i + 1; $j < count($figures); $j++){
			if ($figures[$i]->square() < $figures[$j]->square()){
				$var = $figures[$i];
				$figures[$i] = $figures[$j];
				$figures[$j] = $var;
			}
		}
	}
	
	
	//Вывод информации о фигурах
	echo("Figures: <br>");
	for ($i = 0; $i < count($figures); $i++){
		$figures[$i]->information();
	}
	
?>
