export const calculateOcurrencesResult = (answers: Array<string>, imagens: [], personality: string[], results: string[]) => {
  const counts: {[key: string]: number} = {a: 0, b: 0, c: 0, d: 0, e: 0};
  answers.forEach(element => {
    counts[element] += 1;
  });
  const Ocurrences = [...Object.values(counts)];
  const mostOccurences = Math.max(...Object.values(counts));
  const index = Ocurrences.indexOf(mostOccurences);

  const images = [...imagens];

  const testResult = {text: results[index], image: images[index], description: personality[index]}
  return (testResult)
}

export const calculateScoreBasedOnPointSystem = (answers: Array<string>, imagens: [], personality: string[], results: string[]) => {
  const tableOfScoreValue: {[key: string]: number} = {a: 4, b: 3, c: 2, d: 1, e: 0};

  const score = answers.reduce((acc, elem,) => acc + tableOfScoreValue[elem], 0);
  console.log(score);
  const Ocurrences = [...Object.values(tableOfScoreValue)];

  const mostOccurences = Math.max(...Object.values(tableOfScoreValue));
  const index = Ocurrences.indexOf(mostOccurences);

  const images = [...imagens];

  const testResult = {text: results[index], image: images[index], description: personality[index]}
  return (testResult)
}