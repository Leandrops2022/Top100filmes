
interface Answer {
  option: string;
  value: string;
}

interface Question {
  question: string;
  answers: Answer[];
}

const quiz: Question[] = [
  {
    question: 'What is the capital of France?',
    answers: [
      {option: 'Berlin', value: 'a'},
      {option: 'Paris', value: 'b'},
      {option: 'Madrid', value: 'c'},
      {option: 'Rome', value: 'd'},
    ],
  },
  {
    question: 'What is the capital of Brazil?',
    answers: [
      {option: 'Rio de Janeiro', value: 'a'},
      {option: 'São Paulo', value: 'b'},
      {option: 'Brasília', value: 'c'},
      {option: 'Bahia', value: 'd'},
    ],
  },
];

export default quiz;