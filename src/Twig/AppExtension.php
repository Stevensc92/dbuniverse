<?php

namespace App\Twig;

use App\Entity\GameCapsule;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('displayStat', [$this, 'displayStat'])
        ];
    }

    public function displayStat(GameCapsule $capsule)
    {
        $title = '&lt;ul style=&quot;margin-top: 7px;&quot; &gt;&lt;li&gt;&lt;span style=&quot;float: left;&quot;&gt;Niveau : &lt;span style=&quot;color:blue;&quot;&gt;%LEVEL%&lt;/span&gt;&lt;/span&gt; &lt;span style=&quot;float: right;&quot;&gt;Expérience : &lt;span style=&quot;color:blue;&quot;&gt;%EXPERIENCE% Xp&lt;/span&gt;&lt;/span&gt;&lt;/li&gt;&lt;br/&gt;';

        $listCarac = [
            "power",
            "defense",
            "magic",
            "luck",
            "speed",
            "concentration",
            "life",
            "energy"
        ];

        $table = [];

        $write = function($key, $value, $position = "left") {
            $txt = "&lt;li&gt;&lt;span style=&quot;float: {$position};&quot;&gt;{$key} : &lt;span style=&quot;color:blue;&quot;&gt; {$value}";
        };

        foreach ($listCarac as $carac) {
            $method = 'get'.ucfirst($carac);

            $table[$carac] = $capsule->$method();
        }

        switch ($capsule->getType()->getId()) {
            case 1:
            case 2:
            default:
                $stats = [
                    "Force"         => $capsule->getPower() ?? '0',
                    "Défense"       => $capsule->getDefense() ?? '0',
                    "Magie"         => $capsule->getMagic() ?? '0',
                    "Chance"        => $capsule->getLuck() ?? '0',
                    "Vitesse"       => $capsule->getSpeed() ?? '0',
                    "Concentration" => $capsule->getConcentration() ?? '0',
                    "Vie"           => $capsule->getLife() ?? '0',
                    "Énergie"       => $capsule->getEnergy() ?? '0',
                ];
            break;

            case 3:
                $stats = [
                    "Dégât"     => $capsule->getDamage(),
                    "Énergie"   => $capsule->getEnergy(),
                ];
            break;
        }

//        foreach ($stats as $stat) {
//            $title .= ""
//        }

        return $stats;
    }

}