
import MyQuiz from './components/MyQuiz'
import {frasesDeFilmes, tituloESubtitulo, personality, results, imagens} from './Mocks/questions/frasesDeFilmes';
import {calculateScoreBasedOnPointSystem} from './assets/coreFunctions/calculateResults';

import ReactDOM from 'react-dom/client';

ReactDOM.createRoot(document.getElementById('app')).render(
  <MyQuiz
    quizName={frasesDeFilmes}
    titleAndSubtitle={tituloESubtitulo}
    personality={personality}
    images={imagens}
    results={results}
    calculateResultsFunction={calculateScoreBasedOnPointSystem}
  />
);


