const letterGroups = ['AJS', 'BKT', 'CLU', 'DMV', 'ENW', 'FOX', 'GPY', 'HQZ', 'IR'];

export function reduceNumber(number) {
  let current = number;
  while (current > 9 && ![11, 22, 33].includes(current)) {
    current = String(current).split('').reduce((sum, digit) => sum + Number(digit), 0);
  }
  return current;
}

export function lifePathNumber(birthDate) {
  return reduceNumber(birthDate.replace(/\D/g, '').split('').reduce((sum, digit) => sum + Number(digit), 0));
}

export function nameNumber(name, mode = 'all') {
  return reduceNumber(name.toUpperCase().replace(/[^A-Z]/g, '').split('').reduce((sum, letter) => {
    const isVowel = ['A', 'E', 'I', 'O', 'U'].includes(letter);
    if ((mode === 'vowels' && !isVowel) || (mode === 'consonants' && isVowel)) return sum;
    const value = letterGroups.findIndex((group) => group.includes(letter)) + 1;
    return sum + Math.max(value, 0);
  }, 0));
}

export function buildReport(profile) {
  const lifePath = lifePathNumber(profile.birthDate);
  const destiny = nameNumber(profile.fullName);
  const soulUrge = nameNumber(profile.fullName, 'vowels');
  const personality = nameNumber(profile.fullName, 'consonants');
  return {
    lifePath,
    destiny,
    soulUrge,
    personality,
    content: `${profile.fullName} blends Life Path ${lifePath}, Destiny ${destiny}, Soul Urge ${soulUrge}, and Personality ${personality}. Use this as a client-ready coaching summary.`,
  };
}
