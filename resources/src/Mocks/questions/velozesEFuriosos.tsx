import Question from "../../interfaces/Question";
import toreto from "../../assets/images/toreto.jpg";
import han from "../../assets/images/han.jpg";
import Roman from "../../assets/images/Roman.jpg";
import hobbs from "../../assets/images/hobbs.jpg";
import brian from "../../assets/images/brian.jpg";

export const tituloESubtitulo = {
   "titulo": "Quem você seria no universo de velozes e furiosos?",
   "subtitulo": "Faça o teste e descubra!"
};

const velozesEFuriosos: Question[] = [
   {
      "question": "Qual é a sua abordagem ao lidar com desafios?",
      "answers": [
         {
            option: "Enfrento-os de frente", value: "a"
         },
         {
            option: "Planejo meticulosamente antes de agir", value: "b"
         },
         {
            option: "Confio na minha intuição", value: "c"
         },
         {
            option: "Conto com a ajuda da equipe", value: "d"
         },
         {
            option: "Improviso conforme a situação", value: "e"
         }
      ]
   },
   {
      "question": "Como você descreveria seu estilo de direção?",
      "answers": [
         {
            option: "Agressivo e rápido", value: "a"
         },
         {
            option: "Técnico e calculado", value: "b"
         },
         {
            option: "Instintivo e imprevisível", value: "c"
         },
         {
            option: "Cooperativo e estratégico", value: "d"
         },
         {
            option: "Adaptável a qualquer situação", value: "e"
         }
      ]
   },
   {
      "question": "O que é mais importante para você em uma corrida?",
      "answers": [
         {
            option: "Velocidade pura", value: "a"
         },
         {
            option: "Controle e precisão", value: "b"
         },
         {
            option: "Emoção e adrenalina", value: "c"
         },
         {
            option: "Trabalho em equipe", value: "d"
         },
         {
            option: "Flexibilidade e improvisação", value: "e"
         }
      ]
   },
   {
      "question": "Como você lida com traições ou deslealdade?",
      "answers": [
         {
            option: "Resolvo com confronto direto", value: "a"
         },
         {
            option: "Planejo minha vingança", value: "b"
         },
         {
            option: "Aceito e sigo em frente", value: "c"
         },
         {
            option: "Confio na minha equipe para resolver", value: "d"
         },
         {
            option: "Adapto-me à nova situação", value: "e"
         }
      ]
   },
   {
      "question": "Qual é sua escolha de veículo ideal?",
      "answers": [
         {
            option: "Carro esportivo de alta potência", value: "a"
         },
         {
            option: "Carro modificado para máximo desempenho", value: "b"
         },
         {
            option: "Carro exótico e chamativo", value: "c"
         },
         {
            option: "Veículo robusto e resistente", value: "d"
         },
         {
            option: "Qualquer coisa que eu possa dirigir", value: "e"
         }
      ]
   },
   {
      "question": "Como você se relaciona com sua equipe?",
      "answers": [
         {
            option: "Sou o líder dominante", value: "a"
         },
         {
            option: "Sou o estrategista", value: "b"
         },
         {
            option: "Sou o espírito livre", value: "c"
         },
         {
            option: "Confio e colaboro", value: "d"
         },
         {
            option: "Sou o membro versátil", value: "e"
         }
      ]
   },
   {
      "question": "O que você valoriza mais em um plano de fuga?",
      "answers": [
         {
            option: "Velocidade extrema", value: "a"
         },
         {
            option: "Detalhes precisos", value: "b"
         },
         {
            option: "Elemento surpresa", value: "c"
         },
         {
            option: "Coordenação de equipe", value: "d"
         },
         {
            option: "Flexibilidade", value: "e"
         }
      ]
   },
   {
      "question": "O que te motiva a correr?",
      "answers": [
         {
            option: "Rivalidade intensa", value: "a"
         },
         {
            option: "Busca pela perfeição", value: "b"
         },
         {
            option: "Aventura e emoção", value: "c"
         },
         {
            option: "Proteger a família e amigos", value: "d"
         },
         {
            option: "O desafio em si", value: "e"
         }
      ]
   },
   {
      "question": "Como você lida com situações de perigo iminente?",
      "answers": [
         {
            option: "Encaro de frente sem hesitar", value: "a"
         },
         {
            option: "Avalio cuidadosamente e tomo a melhor decisão", value: "b"
         },
         {
            option: "Confio no meu instinto", value: "c"
         },
         {
            option: "Confio na equipe para encontrar uma solução", value: "d"
         },
         {
            option: "Improviso conforme a necessidade", value: "e"
         }
      ]
   },
   {
      "question": "Qual é sua filosofia de vida?",
      "answers": [
         {
            option: "Ganhar a qualquer custo", value: "a"
         },
         {
            option: "Aperfeiçoar minhas habilidades constantemente", value: "b"
         },
         {
            option: "Viver o momento", value: "c"
         },
         {
            option: "Proteger aqueles que amo", value: "d"
         },
         {
            option: "Adaptar-se às mudanças para sobreviver", value: "e"
         }
      ]
   }
];

const results = [
   "Você é Dominic Toretto",
   "Você é Brian O'Conner",
   "Você é Roman Pearce",
   "Você é Luke Hobbs",
   "Você é Han Lue"
]

const personality = [
   "Você valoriza profundamente os laços familiares e aprecia a honestidade e a transparência em suas relações pessoais. Sua lealdade à família é inabalável, e você faria qualquer coisa para protegê-los, você tem princípios sólidos e um forte senso de ética. Sua capacidade de inspirar e motivar as pessoas ao seu redor é notável, e sua presença é sentida e respeitada.",
   "Você tem uma natureza versátil, capaz de se ajustar a diferentes ambientes e circunstâncias e enfrenta desafios de cabeça erguida, mesmo quando as probabilidades estão contra você, e está disposto a arriscar tudo por aquilo em que acredita. Competitivo por natureza, você está sempre buscando superar desafios e melhorar suas habilidades.",
   "Você é conhecido por seu senso de humor vibrante e extrovertido. Sua capacidade de encontrar humor mesmo nas situações mais sérias é uma característica marcante. Possui uma autoconfiança notável e uma atitude positiva em relação a si mesmo. Tem apreço por coisas finas e um olhar refinado para o estilo. Você é comunicativo, capaz de se expressar de maneira clara e envolvente.",
   "Você é conhecido por sua imensa força, tanto física quanto emocional. Enfrenta os desafios de frente, sem recuar, e é capaz de lidar com situações intensas com coragem. Você tem um forte senso de justiça e é um líder nato, capaz de tomar decisões rápidas e eficazes em situações críticas.",
   "Você é conhecido por sua calma e serenidade, mesmo em situações desafiadoras. Sua capacidade de manter a compostura é uma força fundamental em sua personalidade, valoriza a liberdade, a independência e não se deixa prender por convenções sociais e possui gosto refinado por diferentes formas de expressão artística. Você é misterioso e reservado, revelando apenas o necessário aos outros."
]

const imagens = [toreto, brian, Roman, hobbs, han];

// const calculateResult = (answers: Array<string>) => {
//    const counts: {[key: string]: number} = {a: 0, b: 0, c: 0, d: 0, e: 0};
//    answers.forEach(element => {
//       counts[element] += 1;
//    });
//    const Ocurrences = [...Object.values(counts)];
//    const mostOccurences = Math.max(...Object.values(counts));
//    const index = Ocurrences.indexOf(mostOccurences);

//    const images = [...imagens];

//    const testResult = {text: results[index], image: images[index], description: personality[index]}
//    return (testResult)
// }

export {velozesEFuriosos, personality, results, imagens};