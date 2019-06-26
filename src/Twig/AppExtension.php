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
        switch ($capsule->getType()->getId()) {
            case 1:
            case 2:
            default:
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