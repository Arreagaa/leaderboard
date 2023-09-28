<script setup>
import "swiper/css";
import LCardAthlete from "./utils/LCardAthlete.vue";

const athletes = [
    {
        title: "Haciendo Crossfit desde hace 6 años.",
        name: "Paolo Rossil, 32 años de edad.",
        image: "/athletes/PAOLO ROSSIL.png",
        description: `
            10 años o mas en la selección de Beisbal Guatemala.
            Top 10 crossfit Regional Rio de Janeiro Brazil 2018 individual.`,
        more: `
            Crossfit Semifinals Busan South Korea 2022 teams.
            Crossfit Games 2022 (teams).
            Actualmente vive en Abu dhabi, Emiratos Arabes Unidos.
`,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 8 años.",
        name: "Luis Cacacho, 21 años de edad.",
        image: "/athletes/LUIS CACACHO.png",
        description: `
            21 lugar a nivel mundial categoría teens 2018.
            12 lugar en Wodapalooza categoría RX en equipos 2022.`,
        more: `
            2 lugar fittest in Guatemala 2022.
            1 lugar greatness fit fest 2021
            1 lugar categoría teens RX challenge.
            1 lugar red sky games y wodfest Costa Rica 2017.
            3 lugar Palmawod en parejas Costa Rica 2022.`,
        ig: "https://www.instagram.com/brau.athletics/",
    },

    {
        title: "Haciendo Crossfit desde hace 7 años.",
        name: "Jorge Lemus, 27 años de edad.",
        image: "/athletes/JORGE LEMUS.png",
        description: `
            Competidor con múltiples acciones destacadas,
            de esta forma logrando obtener el Top 20 Open 2022.`,
        more: `
            En busca de nuevos logros y metas en el
            mundo del deporte.`,
        ig: "https://www.instagram.com/orangefitnessgt/",
    },

    {
        title: "Haciendo Crossfit desde hace 9 años.",
        name: "Julio Orellana, 22 años de edad.",
        image: "/athletes/JULIO ORELLANA.png",
        description: `
            Inicio Crossfit siendo Teen.
            2 lugar Red Ski Games Costa Rica Teen 2016.`,
        more: `
            3 lugar The Greatness Games Teen 2016.
            2 lugar Greatness Games Teen 2017.
            2 lugar Unleash Your Fitness Teen 2017.
            3 lugar The Greatness Fit Fest teams RX 2017.
            2 lugar The Greatness Fit Fest RX 2018.
            Top 20 open 2021 y 2022.
            5 lugar The Greatness Fit Fest Elite 2021.
            6 lugar Quaterfinals Guatemala 2022.
            Estudia Ingeniería Civil.`,
        ig: "https://www.instagram.com/brau.athletics/",
    },

    {
        title: "Haciendo Crossfit desde hace 10 años.",
        name: "Marco Herrera, 28 años de edad.",
        image: "/athletes/MARCO HERRERA.png",
        description: `
            Cinta negra en Kenpo Karate.
            Ha practicado otros deportes como natación, fútbol, entre otros.
            `,
        more: `
            1 lugar Costa Rica RX Challenge scaled.
            3 lugar Palma Wod 4.0 Costa Rica Scaled.
            1 lugar Greatness Fit Fest Teams edition Scaled.
            3 lugar triatlón del Pacifico relevos Distancia olímpica.
            Licenciado en Administración de Empresas.
            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 6 años.",
        name: "Stelios Madrid, 31 años de edad.",
        image: "/athletes/STELIOS MADRID.png",
        description: `
            1 lugar Palma Wod 4.0 Escalado 2019.
            2 lugar Wod Slam parejas 2022.
            `,
        more: `
            3 lugar Prove Your Fitness La Grotta El Salvador RX 2022.
            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 10 años.",
        name: "Jose Laguardia, 30 años de edad.",
        image: "/athletes/JOSE LAGUARDIA.png",
        description: `
            1 lugar Unleash Your FitnessTeams RX 2015.
            1 lugar z9 Throwdown 2016.
            `,
        more: `
            Top 5 The Greatness Fit Fest 2016.
            2 lugar Teams Edition RX 2016.
            Crossfit Open 7 Guatemala 2017.
            1 lugar Costa Rica RX Challenge Team RX 2017.
            Top 5 elite champions 2017.
            4 lugar Team edition 2019.
            6 lugar The Greatness Fitfest 2019.
            1 lugar prove your fitness El Salvador 4.0 2021.
            1 lugar Crossfit open 22.2 Guatemala 2022
            Clasificación Quarterfinals 2022.
            1 lugar Prove your fitness El Salvador 5.0 Elite 2022.
            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 7 años.",
        name: "Jose Fernando García, 37 años de edad.",
        image: "/athletes/FERCHO GARCIA.png",
        description: `
            Fittest en Guatemala 2022.
            1 lugar Wodapalooza Teams 2019.
            `,
        more: `
            1 lugar Southfit Argentina Teams RX 2019.
            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 7 años.",
        name: "Santiago Aguilar, 25 años de edad.",
        image: "/athletes/SANTIAGO AGUILAR.png",
        description: `
            1 Unleash Your Fitness RX 2019.
            3 Marina BullFest RX 2022.
            `,
        more: `
            Economista con Especialización en Finanzas.
            Certificación de Crossfit L1.
            `,
        ig: "https://www.instagram.com/brau.athletics/",
    },

    {
        title: "Haciendo Crossfit desde hace 10 años.",
        name: "Erick Salguero, 38 años de edad.",
        image: "/athletes/ERICK SALGUERO.png",
        description: `
            Fundo su Box Fenix Fit Box en el 2015.
            Es el Head Coach en Fenix Fit Box.
            `,
        more: `
            Gymnastics course.
            Weightlifting 1 Course.
            Top 10 Unleash Your Fitness 2019.
            `,
        ig: "https://www.instagram.com/fenixfitbox/",
    },

    {
        title: "Haciendo Crossfit desde hace 5 años.",
        name: "Alejandro Acuña, 25 años de edad.",
        image: "/athletes/ALEJANDRO ACUÑA.png",
        description: `
            2 The Greatness Fit Fest RX 2019.
            8 The Greatness Fit Fest ELITE 2021.
            `,
        more: `
            Top 10 Open 2022.
            Head Coach en PR Fitness.
            `,
        ig: "https://www.instagram.com/prfitnessgt/",
    },

    {
        title: "Haciendo Crossfit desde hace 3 años.",
        name: "Jairo Valenzuela, 25 años de edad.",
        image: "/athletes/JAIRO VALENZUELA.png",
        description: `
            Campeón de Motocross a nivel nacional 50cc y 85 cc.
            Campeón de triatlón categoría Sprint.
            `,
        more: `
            Corredor de la vuelta chica a Guatemala de Ciclismo.
            Estudia Administración de Empresas.
            `,
        ig: "https://www.instagram.com/theboxmz/",
    },

    {
        title: "Haciendo Crossfit desde hace 5 años.",
        name: "Estuardo Ponciano, 25 años de edad.",
        image: "/athletes/CUKI PONCIANO.png",
        description: `
            2014-2017 Jugador fuerzas básicas Antigua G.F.C
            2018 The Greatness Fit Fest 4to lugar categoría Scaled.
            `,
        more: `
            2018 Unleash 5to lugar categoría Scaled.
            2019 The Greatness Fit Fest 5to lugar categoría Rx.
            2020 The Greatness Fit Fest online Rx 5to lugar.
            2021 Open 11vo lugar Guatemala.
            2021 Dry Atlhon Crossfit Xela 1 lugar.
            2021The Greatness Fit Fest categoría Elite 10mo lugar.
            2021 HighGround 3ro lugar categoría Rx.
            2022 Open 8vo lugar Guatemala.
            2022 Miembro activo de junta directiva y asociado en Asociación Guatemalteca De Fisioterapeutas De Guatemala.
            Licenciatura en fisioterapia con grado académico Cum Laude.
            Administrador y representante legal de Rehabi Movement, Sociedad Anónima.
            `,
        ig: "https://www.instagram.com/orangefitnessgt/",
    },

    {
        title: "Haciendo Crossfit desde hace 4 años.",
        name: "José Ruiz, 26 años de edad.",
        image: "/athletes/JOSE ANDRES RUIZ.png",
        description: `
            Atleta destacado, ha logrado conseguir el
            Top 10 Crossfit Open 2021 y 2022.
            Y el Top 900 Quaterfinals North America 2022 con una excelente participación.
            `,
        more: `
            En busca de nuevos logros y metas en el
            mundo del deporte.
            `,
        ig: "https://www.instagram.com/prfitnessgt/",
    },

    {
        title: "Haciendo Crossfit desde hace 9 años.",
        name: "Guillermo Marroquin, 34 años de edad.",
        image: "/athletes/GUILLE MARROQUIN.png",
        description: `
            1 Lugar Greatness Fit Fest Teams edition 2017.
            1 lugar competencia de segunda fuerza en la Federación Nacional de pesas Guatemala categoría 67kg 2017.
            `,
        more: `
            2 lugar greatness Fit Fest Categoría Elite 2018.
            2 lugar The tribe call Z9 Crossfit.
            3 Lugar Prove your Fitness La Grotta Categoría Elite 2022.
            Best run 21K 1:44:53.
            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 8 años.",
        name: "Manuel Pineda, 45 años de edad.",
        image: "/athletes/MANUEL PINEDA.png",
        description: `
            Atleta destacado, que ha conseguido cumplir diferentes logros entre ellos,
            70.3 finisher x 2.
            2 lugar mundial triatlon Cancun 2002 Categoría: 20-22.
            `,
        more: `
            Bronce tae kwon do Washington US open.
            2 lugar greatness fit fest equipos.
            41 worldwide Categoría masters 40-44 2018.
            `,
        ig: "https://www.instagram.com/garagefitculture/",
    },

    {
        title: "Haciendo Crossfit desde hace 8 años.",
        name: "Gustavo Aguilar, 27 años de edad.",
        image: "/athletes/GUSTAVO AGUILAR.png",
        description: `
            2 lugar en Unleash Your Fitness categoría RX.
            9 lugar Categoría Elite The Greatness Fit Fest.
            `,
        more: `
            Licenciado en Administración de Negocios con especialización en Mercadeo.
            `,
        ig: "https://www.instagram.com/brau.athletics/",
    },

    {
        title: "Atleta Practicante.",
        name: "Mario Samperio, 31 años de edad.",
        image: "/athletes/MARIO SAMPERIO.png",
        description: `
            Top 10 WodFest Costa Rica 2018.
            1 lugar Categoría Intermedio Teams Wodapalooza 2019.
            `,
        more: `
            1 lugar categoría RX Teams Southfit Argentina 2019.
            70.3 Ironman Finisher Cozumel 2020.

            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 7 años.",
        name: "Santiago Montenegro, 20 años de edad.",
        image: "/athletes/SANTIAGO MONTENEGRO.png",
        description: `
            Puesto 66 a nivel mundial crossfit open categoría teens 16-17 en el año 2018.
            2 lugar Unleash Your Fitness Categoría Elite 2021.

            `,
        more: `
            1 lugar Marina Bullfest 2022.
            Estudiante de Medicina.


            `,
        ig: "https://www.instagram.com/502fitnessgt/",
    },

    {
        title: "Haciendo Crossfit desde hace 10 años.",
        name: "Estuardo Penagos, 28 años de edad.",
        image: "/athletes/JOSE MIGUEL VALDEZ.png",
        description: `
            Competidor de Regionales Chile 2014 (categoria Teams).
            Competidor de Regionales Brasil 2018 (categoria Teams).
            Primer lugar UYF 2014, 2018, 2019, 2020 y 2021.
            `,
        more: `
            Top 10 open crossfit GT 2012-2021, 28 años.
            `,
        ig: "https://www.instagram.com/502fitnessgt/",
    },

    {
        title: "Haciendo Crossfit desde hace 6 años.",
        name: "Ariana Prem, 17 años de edad.",
        image: "/athletes/ARIANA PREM.png",
        description: `
            3 lugar Unleash your fitness elite 2021.
            39 del mundo quarterfinals teens 16-17.
            1 lugar nacional sub -20 cat. -64 weightlifting.
            1 lugar proove your fitness el salvador categoría elite.
            `,
        more: `
            1 lugar face to face invictus 2022.
            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 5 años.",
        name: "Carol Gonzalez, 31 años de edad.",
        image: "/athletes/CAROL GONZALEZ.png",
        description: `
            1 lugar categoría scaled Crossfit Open 2018.
            1 lugar Unleash your Fitness scaled 2018.
            `,
        more: `
            Participo en Unleash your Fitness RX 2019.
            3 lugar en Unleash your Fitness RX 2020.
            `,
        ig: "https://www.instagram.com/502fitnessgt/",
    },

    {
        title: "Haciendo Crossfit desde hace 3 años.",
        name: "Priscila Valle, 32 años de edad.",
        image: "/athletes/PRISCILA VALLE.png",
        description: `
            Participo en el Triatlón hombre maya 2022.
            2 lugar Unleash Your Fitness RX 2021.
            `,
        more: `
            2 lugar High Ground Fitness RX 2021.
            Participo en la competencia RX Challenge Costa Rica equipos modificado.
            Federada Nacional de Taekwondo.
            Product Manager en la farmacéutica #1 en ventas a nivel Centroamérica.
            `,
        ig: "https://www.instagram.com/orangefitnessgt/",
    },

    {
        title: "Haciendo Crossfit desde hace 4 años.",
        name: "Jennifer Tejeda, 29 años de edad.",
        image: "/athletes/JENNY TEJEDA.png",
        description: `
            Fitness Coach en Futeca.
            Ceritficado Fitness Coach.
            `,
        more: `
            Coach de diferentes Disciplinas como Funtional, TRX, Cycling y Crossfit.
            Licenciada en Nutrición.
            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 4 años.",
        name: "Valeria Santos, 21 años de edad.",
        image: "/athletes/VALERIA SANTOS.png",
        description: `
            Le gustaría promover Crossfit como una disciplina en Guatemala.
            `,
        more: `
            En busca de nuevos logros y metas dentro del
            mundo del deporte.
            `,
        ig: "https://www.instagram.com/amsicrossfit/",
    },

    {
        title: "Haciendo Crossfit desde hace 5 años.",
        name: "Crysta Valle, 30 años de edad.",
        image: "/athletes/CRYSTA VALLE.png",
        description: `
            Formo parte de la selección nacional de gimnasia artística hasta los 13 años.
            4 lugar en Hombre Maya 2022.
            `,
        more: `
            En el 2021 y 2022 entreno en Estados Unidos con atletas en preparación para Crossfit Games y otras competencias importantes de crossfit.
            Ingeniera Industrial.
            `,
        ig: "https://www.instagram.com/orangefitnessgt/",
    },

    {
        title: "Haciendo Crossfit desde hace 5 años.",
        name: "Rubi Gordillo, 29 años de edad.",
        image: "/athletes/RUBI GORDILLO.png",
        description: `
            Médico y Cirujano.
            18 Crossfit Open Rx Guatemala 2022.
            1 lugar Categoria Scaled The Greatness Fit Fest 2021.
            `,
        more: `
            En busca de nuevos logros y metas dentro del
            mundo del deporte.
            `,
        ig: "https://www.instagram.com/crossfit15gt/",
    },

    {
        title: "Haciendo Crossfit desde hace 6 años.",
        name: "Fatima Alfaro, 24 años de edad.",
        image: "/athletes/FATIMA ALFARO.png",
        description: `
            1 lugar Prove your Fitness RX La Grotta 2022.
            3 lugar Greatness Fit Fest RX 2021.
            1 lugar jump dance 2019.
            `,
        more: `
            Crossfit Coach.
            Project Manger.
            Radio Host.
            `,
        ig: "",
    },

    {
        title: "Haciendo Crossfit desde hace 4 años.",
        name: "María Fernanda Arriaza, 31 años de edad.",
        image: "/athletes/MAFER ARRIAZA.png",
        description: `
            Top 5 Open 2021 y 2022.
            5to Lugar Teams Intermedio Wodapalooza, Miami 2022.
            `,
        more: `
            2do Lugar Greatness Elite 2021.
            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit.",
        name: "Michelle Garcia-Salas, 29 años de edad.",
        image: "/athletes/MICHELLE GARCIA SALAS.png",
        description: `
            Crossfit L1 y L2
            Weightlifting Course.
            Licenciada en Nutrición con Maestría en Deporte.
            `,
        more: `
            En busca de nuevos logros y metas dentro del
            mundo del deporte.
            `,
        ig: "https://www.instagram.com/502fitnessgt/",
    },

    {
        title: "Haciendo Crossfit desde hace 4 años.",
        name: "Sofia Mendoza, 25 años de edad.",
        image: "/athletes/SOFIA MENDOZA.png",
        description: `
            2 lugar en quarterfinals 2021 y 2022.
            3 lugar teams elite en Prove your fitness en El Salvador 2022.
            Top 5 open 2021.
            `,
        more: `
            1 lugar en 502 Lifting meet 2021.
            3 lugar en parejas RX Greatness fit fest 2019.
            Gimnasta 7 años a nivel competitivo.
            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 5 años.",
        name: "Monica Guerra, 31 años de edad.",
        image: "/athletes/MONICA GUERRA.png",
        description: `
            2 Lugar en The Greatness Fit Fest Categoría RX.
            1 lugar categoría RX Teams La Grotta.
            `,
        more: `
            Medias Maratones 21K como Coban y Guatemala.
            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 5 años.",
        name: "Ximena Torres, 25 años de edad.",
        image: "/athletes/XIMENA TORRES.png",
        description: `
            1 lugar Greatness Fit Fest en Pareja 2019.
            1 lugar Brau Weightlifting.
            `,
        more: `
            1 lugar Teams La Grotta El Salvador.
            Competidora en Teams Categoría intermedio en Wodapalooza.
            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 10 años.",
        name: "Paola David.",
        image: "/athletes/PAOLA DAVID.png",
        description: `
            En el años 2016 y 2018 obtuvo el reconocimiento de Fittest en Guatemala.
            `,
        more: `
            2014 y 2018 compitió en Regionals en Teams
            fundadora de Da Vida (Fit & compete). Competencias internacionales en Estados Unidos, El Salvador, Costa Rica, Brasil y Chile.

            `,
        ig: "https://www.instagram.com/invictusperformance/",
    },

    {
        title: "Haciendo Crossfit desde hace 9 años.",
        name: "María Andre Navarro, 27 años de edad.",
        image: "/athletes/MARIE NAVARRO.png",
        description: `
            En el año 2021 y 2022 quedo en 4 lugar en el Crossfit Open.
            Clasifico a Regionales como Team en el 2018.
            `,
        more: `
            3 lugar en Unleash Your Fitness Teams edition 2020.
            `,
        ig: "https://www.instagram.com/502fitnessgt/",
    },
];
</script>
<template>
    <div
        class="grid justify-center md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-7"
    >
        <LCardAthlete
            v-for="(item, index) in athletes"
            :key="index"
            :id-item="index"
            :item="item"
        />
    </div>
</template>
