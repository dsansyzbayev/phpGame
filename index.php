<?php

class Player
{
    public $name = '';
    public $heroes = [];

    function __construct($name, $heroes)
    {
        $this->name = $name;
        $this->heroes = $heroes;
    }

    public function step($player)
    {
        $heroes =  $this->getAliveHeroes();

        if(count($heroes) == 0){
            return $player;
        }

        echo "Player: " . $this->name . "<br>";

        foreach($heroes as $hero){
            $enemyHeroes = $player->getAliveHeroes();

            if(count($enemyHeroes) == 0){
                return $this;
            }

            foreach($enemyHeroes as $enemyHero){
                $hero->attack($enemyHero);
            }
        }
        echo '<hr>';

        return null;
    }

    public function getAliveHeroes()
    {
        $return = [];
        foreach($this->heroes as $hero){
            if($hero->hp > 0){
                $return[]=$hero;
            }
        }
        return $return;
    }
}

class Hero
{
    public $name = '';
    public $hp = 0;
    public $damage = 0;

    public function __construct($name, $hp, $damage)
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->damage = $damage;
    }

    public function attack($hero)
    {
        echo 'Hero ' . $this->getStats($this) . ' attacks hero ' . $this->getStats($hero) . '<br>';
        $hero->fixDamage($this->damage);

    }

    public function getStats($hero)
    {
        return $hero->name . '(' . $hero->hp . ', ' . $hero->damage . ')';
    }

    public function fixDamage($damage)
    {
        $currentHP = $this->hp;
        $this->hp-= rand(0,$damage);
        if($currentHP < 0){
            echo '<span style = "color:red"> OOO, Nooooooo! ' . $this->name. ' Hero is dead!!! </span> <br>';
        }
    }


}

$heroNames1 = ['Thanos', 'Galactus', 'Dormamu', 'Altron', 'Hitler'];
$heroNames2 = ['Thor', 'Hulk', 'IronMan', 'Dr.Strange', 'Bakhtiar'];

$heroes1 = $heroes2 = [];

for($i = 0; $i < 5; $i++){
    $heroes1[] = new Hero($heroNames1[$i], rand(1000,2500), rand(20,170));
    $heroes2[] = new Hero($heroNames2[$i], rand(1000,2500), rand(20,170));
}

$birzhan = new Player('Birzhan', $heroes1);
$kazyna = new Player('Kazyna', $heroes2);

for($i = 0; $i < 1; $i+=0){
    echo 'Round <hr>';

    $winner=$birzhan->step($kazyna);

    if($winner == null)
    {
        $winner=$kazyna->step($birzhan);
    }

    if($winner != null)
    {
        echo 'Winner ' . $winner->name . '<hr>';
        break;
    }
}



?>