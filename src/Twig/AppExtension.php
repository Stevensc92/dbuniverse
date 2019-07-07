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
        $title = '&lt;ul style=&quot;margin-top: 7px;&quot; &gt;&lt;li&gt;&lt;span style=&quot;float: left;&quot;&gt;Niveau : &lt;span style=&quot;color:blue;&quot;&gt;'.$Stat['level_capsule'].'&lt;/span&gt;&lt;/span&gt; &lt;span style=&quot;float: right;&quot;&gt;Expérience : &lt;span style=&quot;color:blue;&quot;&gt;'.$Stat['experience'].' Xp&lt;/span&gt;&lt;/span&gt;&lt;/li&gt;&lt;br/&gt;';

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

        foreach ($listCarac as $carac) {
            $method = 'get'.ucfirst($carac);

            $$carac = $capsule->$method();
        }

        switch ($capsule->getType()->getId()) {
            case 1:
            case 2:
            default:
                foreach ($listCarac as $carac) {
                    $method = "get".ucfirst($carac);
                    $$carac += ($capsule->$method());
                }

                $stats = [
                    "Force"         => $capsule->getPower(),
                    "Défense"       => $capsule->getDefense(),
                    "Magie"         => $capsule->getMagic(),
                    "Chance"        => $capsule->getLuck(),
                    "Vitesse"       => $capsule->getSpeed(),
                    "Concentration" => $capsule->getConcentration(),
                    "Vie"           => $capsule->getLife(),
                    "Énergie"       => $capsule->getEnergy(),
                    "Prix"          => $capsule->getPrice(),
                ];
            break;

            case 3:
                $stats = [
                    "Dégât"     => $capsule->getDamage(),
                    "Énergie"   => $capsule->getEnergy(),
                    "Prix"      => $capsule->getPrice(),
                ];
            break;
        }

        return $stats;
    }

}