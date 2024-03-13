import React, {useState, useEffect} from 'react';
import estilo from '../Mocks/styles/velozesEFuriosos.module.scss';

const MyQuiz: React.FC = ({quizName, titleAndSubtitle, images, personality, results, calculateResultsFunction}) => {
  const [answers, setAnswers] = useState<Array<string | undefined>>(Array(10).fill(undefined));
  const [showResult, setShoWResult] = useState(false);
  const [result, setResult] = useState({text: "", image: "", description: ""});
  const [activatedButton, setActivatedButton] = useState(false);

  useEffect(() => {
    // Scroll to the top when the component mounts
    window.scrollTo(0, 100)
  }, [showResult]);


  const handleAnswers = (choice: string, index: number) => {
    setAnswers((previousChoices: string[]) => {
      const updatedChoices = [...previousChoices];
      updatedChoices[index] = choice;

      // Check if all questions are answered (no empty strings)
      const allQuestionsAnswered = updatedChoices.every((choice) => typeof choice === 'string' && choice.trim() !== '');

      // Activate the button if all questions are answered
      setActivatedButton(allQuestionsAnswered);

      return updatedChoices;
    });
  };

  const handleReset = () => {
    setActivatedButton(false);
    setAnswers(Array(10).fill(undefined));
    setShoWResult(false);

  };

  return (

    <div className={estilo.container}>
      {showResult ? (
        <div className={estilo.resultado}>
          <div className={estilo.imagem} >
            <img src={result.image} alt="imagem do resultado do teste" />
          </div>
          <h1>{result.text}</h1>
          <p>{result.description}</p>
          <button onClick={handleReset}>Refaça o teste</button>
        </div>
      ) :
        (
          <div className={estilo.quiz}>
            <h1>{titleAndSubtitle.titulo}</h1>
            <h2>{titleAndSubtitle.subtitulo}</h2>
            <ol>
              {quizName.map((element, index1) => (
                <li key={index1}>
                  <h3>{element.question}</h3>
                  {element.answers.map((option, index) => (
                    <div key={index}>
                      <input
                        required
                        type="radio"
                        name={element.question}
                        id={option.option}
                        value={option.value}
                        onChange={() => {
                          handleAnswers(option.value, index1)
                        }}
                      />
                      <label htmlFor={option.option}>{option.option}</label>
                    </div>
                  ))}
                </li>
              ))}
            </ol>

            {activatedButton ?
              <button className={estilo.ativado} onClick={() => {
                setResult(calculateResultsFunction(answers, images, personality, results));
                setShoWResult(true);
              }}>Obter o Resultado?</button> : <button disabled className={estilo.desativado}>Responda todas as perguntas</button>}

          </div>
        )
      }
    </div>

  );
};

export default MyQuiz;