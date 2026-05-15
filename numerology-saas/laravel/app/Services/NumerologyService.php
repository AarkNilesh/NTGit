<?php

namespace App\Services;

class NumerologyService
{
    public function buildReport(string $fullName, string $birthDate): array
    {
        $lifePath = $this->lifePath($birthDate);
        $destiny = $this->nameNumber($fullName);
        $soulUrge = $this->nameNumber($fullName, vowelsOnly: true);
        $personality = $this->nameNumber($fullName, consonantsOnly: true);

        return [
            'life_path' => $lifePath,
            'destiny' => $destiny,
            'soul_urge' => $soulUrge,
            'personality' => $personality,
            'content' => sprintf(
                '%s carries Life Path %d, Destiny %d, Soul Urge %d, and Personality %d. Use this blend to guide positioning, relationship coaching, and timing recommendations.',
                $fullName,
                $lifePath,
                $destiny,
                $soulUrge,
                $personality
            ),
        ];
    }

    private function lifePath(string $birthDate): int
    {
        return $this->reduce(array_sum(array_map('intval', str_split(preg_replace('/\D/', '', $birthDate) ?: '0'))));
    }

    private function nameNumber(string $name, bool $vowelsOnly = false, bool $consonantsOnly = false): int
    {
        $letters = str_split(preg_replace('/[^A-Z]/', '', strtoupper($name)) ?: '');
        $vowels = ['A', 'E', 'I', 'O', 'U'];
        $total = 0;

        foreach ($letters as $letter) {
            $isVowel = in_array($letter, $vowels, true);
            if (($vowelsOnly && ! $isVowel) || ($consonantsOnly && $isVowel)) {
                continue;
            }
            $total += $this->letterValue($letter);
        }

        return $this->reduce($total);
    }

    private function letterValue(string $letter): int
    {
        $groups = ['AJS', 'BKT', 'CLU', 'DMV', 'ENW', 'FOX', 'GPY', 'HQZ', 'IR'];
        foreach ($groups as $index => $group) {
            if (str_contains($group, $letter)) {
                return $index + 1;
            }
        }
        return 0;
    }

    private function reduce(int $number): int
    {
        while ($number > 9 && ! in_array($number, [11, 22, 33], true)) {
            $number = array_sum(array_map('intval', str_split((string) $number)));
        }
        return $number;
    }
}
