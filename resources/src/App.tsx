
import MyQuiz from './components/MyQuiz'
import {velozesEFuriosos, tituloESubtitulo, personality, results, imagens} from './Mocks/questions/velozesEFuriosos';
import {calculateOcurrencesResult} from './assets/coreFunctions/calculateResults';

import ReactDOM from 'react-dom/client';
ReactDOM.createRoot(document.getElementById('app')).render(

  <MyQuiz
    quizName={velozesEFuriosos}
    titleAndSubtitle={tituloESubtitulo}
    personality={personality}
    images={imagens}
    results={results}
    calculateResultsFunction={calculateOcurrencesResult}
  />
);


