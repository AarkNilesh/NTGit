<?php
declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function reduce_number(int $number): int
{
    while ($number > 9 && !in_array($number, [11, 22, 33], true)) {
        $number = array_sum(array_map('intval', str_split((string) $number)));
    }
    return $number;
}

function letter_value(string $letter): int
{
    $map = [
        'A' => 1, 'J' => 1, 'S' => 1,
        'B' => 2, 'K' => 2, 'T' => 2,
        'C' => 3, 'L' => 3, 'U' => 3,
        'D' => 4, 'M' => 4, 'V' => 4,
        'E' => 5, 'N' => 5, 'W' => 5,
        'F' => 6, 'O' => 6, 'X' => 6,
        'G' => 7, 'P' => 7, 'Y' => 7,
        'H' => 8, 'Q' => 8, 'Z' => 8,
        'I' => 9, 'R' => 9,
    ];
    return $map[strtoupper($letter)] ?? 0;
}

function name_number(string $name, bool $vowelsOnly = false, bool $consonantsOnly = false): int
{
    $letters = preg_replace('/[^A-Za-z]/', '', strtoupper($name));
    $vowels = ['A', 'E', 'I', 'O', 'U'];
    $total = 0;
    foreach (str_split($letters ?: '') as $letter) {
        $isVowel = in_array($letter, $vowels, true);
        if (($vowelsOnly && !$isVowel) || ($consonantsOnly && $isVowel)) {
            continue;
        }
        $total += letter_value($letter);
    }
    return reduce_number($total);
}

function life_path_number(string $birthDate): int
{
    $digits = preg_replace('/\D/', '', $birthDate);
    return reduce_number(array_sum(array_map('intval', str_split($digits ?: '0'))));
}

function interpretation(int $number): string
{
    $meanings = [
        1 => 'Leadership, initiative, independence and courage.',
        2 => 'Cooperation, diplomacy, patience and emotional intelligence.',
        3 => 'Creative expression, communication, optimism and social magnetism.',
        4 => 'Structure, reliability, practical work and long-term foundations.',
        5 => 'Freedom, adaptability, travel, curiosity and calculated risk.',
        6 => 'Care, responsibility, beauty, home, family and service.',
        7 => 'Insight, research, spirituality, analysis and inner wisdom.',
        8 => 'Power, management, money, authority and material achievement.',
        9 => 'Compassion, completion, teaching, humanitarian service and artistry.',
        11 => 'Master intuition, inspiration, spiritual messaging and illumination.',
        22 => 'Master builder energy, large-scale vision and practical manifestation.',
        33 => 'Master teacher energy, compassion, healing and selfless leadership.',
    ];
    return $meanings[$number] ?? 'Balanced universal potential.';
}

function build_report(array $client): array
{
    $lifePath = life_path_number($client['birth_date']);
    $destiny = name_number($client['full_name']);
    $soulUrge = name_number($client['full_name'], true);
    $personality = name_number($client['full_name'], false, true);

    $content = sprintf(
        "%s's profile combines Life Path %d (%s), Destiny %d (%s), Soul Urge %d (%s), and Personality %d (%s). Recommended guidance: align daily decisions with the Life Path theme, use the Destiny number for career positioning, and balance inner motivation with public presentation.",
        $client['full_name'],
        $lifePath,
        interpretation($lifePath),
        $destiny,
        interpretation($destiny),
        $soulUrge,
        interpretation($soulUrge),
        $personality,
        interpretation($personality)
    );

    return compact('lifePath', 'destiny', 'soulUrge', 'personality', 'content');
}

function api_response(array $payload, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($payload, JSON_PRETTY_PRINT);
    exit;
}
